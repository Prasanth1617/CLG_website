<?php
    session_start();

    // Security headers
    header("X-Frame-Options: DENY");
    header("X-Content-Type-Options: nosniff");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");

    include "db.php";

    // Generate CSRF token
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    // CSRF validation function
    function validateCSRF($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    // Password validation function
    function validatePassword($password) {
        $errors = [];
        
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        }
 
        return $errors;
    }

    // Sanitize input
    function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }

    // Handle Excel Upload
    if(isset($_POST['upload_excel'])){
        if (!validateCSRF($_POST['csrf_token'] ?? '')) {
            die("Security token validation failed!");
        }

        // Check if PhpSpreadsheet is available
        if(!file_exists('vendor/autoload.php')){
            echo "<script>alert('PhpSpreadsheet library not installed. Please run: composer require phpoffice/phpspreadsheet');</script>";
        } else {
            require_once 'vendor/autoload.php';

            if(isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0){
                $allowed = ['xlsx', 'xls', 'csv'];
                $filename = $_FILES['excel_file']['name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                if(in_array($ext, $allowed)){
                    $file = $_FILES['excel_file']['tmp_name'];
                    
                    try {
                        // Load the spreadsheet
                        if($ext == 'csv'){
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                        } else {
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        }
                        
                        $spreadsheet = $reader->load($file);
                        $worksheet = $spreadsheet->getActiveSheet();
                        $rows = $worksheet->toArray();
                        
                        $success_count = 0;
                        $error_count = 0;
                        $errors = [];
                        
                        // Process rows (skip header row)
                        for($i = 1; $i < count($rows); $i++){
                            $row = $rows[$i];
                            
                            // Skip empty rows
                            if(empty(array_filter($row))) continue;
                            
                            // Expected columns: Name, Email, Password, Department, User Type
                            if(count($row) >= 5){
                                $name = sanitize(trim($row[0]));
                                $email = filter_var(trim($row[1]), FILTER_VALIDATE_EMAIL);
                                $password = trim($row[2]);
                                $department = sanitize(trim($row[3]));
                                $user_type = sanitize(strtolower(trim($row[4])));
                                
                                // Validate data
                                $row_errors = [];
                                
                                if(empty($name) || strlen($name) < 2){
                                    $row_errors[] = "Invalid name";
                                }
                                
                                if(!$email){
                                    $row_errors[] = "Invalid email: " . $row[1];
                                }
                                
                                if(empty($password) || strlen($password) < 8){
                                    $row_errors[] = "Password must be at least 8 characters";
                                }
                                
                                $valid_departments = ['Computer Science', 'Electronics', 'Mechanical', 'Civil', 'MBA', 'MCA'];
                                if(!in_array($department, $valid_departments)){
                                    $row_errors[] = "Invalid department: $department";
                                }
                                
                                $valid_user_types = ['student', 'parent', 'faculty'];
                                if(!in_array($user_type, $valid_user_types)){
                                    $row_errors[] = "Invalid user type: $user_type";
                                }
                                
                                if(empty($row_errors)){
                                    // Check if email exists
                                    $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
                                    $check_stmt->bind_param("s", $email);
                                    $check_stmt->execute();
                                    $check_result = $check_stmt->get_result();
                                    
                                    if($check_result->num_rows > 0){
                                        $errors[] = "Row " . ($i + 1) . ": Email already exists ($email)";
                                        $error_count++;
                                    } else {
                                        // Insert user
                                        $insert_stmt = $conn->prepare("INSERT INTO users (name, email, password, department, user_type, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
                                        $insert_stmt->bind_param("sssss", $name, $email, $password, $department, $user_type);
                                        
                                        if($insert_stmt->execute()){
                                            $success_count++;
                                        } else {
                                            $errors[] = "Row " . ($i + 1) . ": Database error for $name";
                                            $error_count++;
                                        }
                                        $insert_stmt->close();
                                    }
                                    $check_stmt->close();
                                } else {
                                    $errors[] = "Row " . ($i + 1) . ": " . implode(", ", $row_errors);
                                    $error_count++;
                                }
                            } else {
                                $errors[] = "Row " . ($i + 1) . ": Insufficient columns";
                                $error_count++;
                            }
                        }
                        
                        // Build result message
                        $message = "Import completed!\\n✓ $success_count users added successfully";
                        if($error_count > 0){
                            $message .= "\\n✗ $error_count errors occurred\\n\\n";
                            $message .= implode("\\n", array_slice($errors, 0, 5));
                            if(count($errors) > 5){
                                $message .= "\\n... and " . (count($errors) - 5) . " more errors.";
                            }
                        }
                        echo "<script>alert('" . addslashes($message) . "');window.location='manage_users.php';</script>";
                        
                    } catch(Exception $e){
                        echo "<script>alert('Error reading file: " . addslashes($e->getMessage()) . "');</script>";
                    }
                } else {
                    echo "<script>alert('Invalid file format. Please upload Excel (.xlsx, .xls) or CSV file.');</script>";
                }
            } else {
                echo "<script>alert('Please select a file to upload.');</script>";
            }
        }
    }

    // Add new user
    if(isset($_POST['add_user'])){
        if (!validateCSRF($_POST['csrf_token'] ?? '')) {
            die("Security token validation failed!");
        }
        
        $name = sanitize($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $department = sanitize($_POST['department']);
        $user_type = sanitize($_POST['user_type']);
        
        $errors = [];
        
        if (empty($name) || strlen($name) < 2) {
            $errors[] = "Name must be at least 2 characters long";
        }
        
        if (!$email) {
            $errors[] = "Invalid email format";
        }
        
        $password_errors = validatePassword($password);
        if (!empty($password_errors)) {
            $errors = array_merge($errors, $password_errors);
        }
        
        $valid_departments = ['Computer Science', 'Electronics', 'Mechanical', 'Civil', 'MBA', 'MCA'];
        if (!in_array($department, $valid_departments)) {
            $errors[] = "Invalid department selected";
        }
        
        $valid_user_types = ['student', 'parent', 'faculty'];
        if (!in_array($user_type, $valid_user_types)) {
            $errors[] = "Invalid user type selected";
        }
        
        if (empty($errors)) {
            $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
            $check_stmt->bind_param("s", $email);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
            
            if($check_result->num_rows > 0){
                echo "<script>alert('Email already exists!');</script>";
            } else {
                $insert_stmt = $conn->prepare("INSERT INTO users (name, email, password, department, user_type, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
                $insert_stmt->bind_param("sssss", $name, $email, $password, $department, $user_type);
                
                if ($insert_stmt->execute()) {
                    echo "<script>alert('User added successfully!');window.location='manage_users.php';</script>";
                } else {
                    echo "<script>alert('Error adding user. Please try again.');</script>";
                }
                $insert_stmt->close();
            }
            $check_stmt->close();
        } else {
            $error_msg = implode("\\n", $errors);
            echo "<script>alert('$error_msg');</script>";
        }
    }

    // Delete user
    if(isset($_GET['action']) && $_GET['action'] == "delete"){
        if (!validateCSRF($_GET['csrf_token'] ?? '')) {
            die("Security token validation failed!");
        }
        
        $id = intval($_GET['id']);
        
        if ($id > 0) {
            $delete_stmt = $conn->prepare("DELETE FROM users WHERE id = ? LIMIT 1");
            $delete_stmt->bind_param("i", $id);
            
            if ($delete_stmt->execute()) {
                echo "<script>alert('User deleted successfully!');window.location='manage_users.php';</script>";
            } else {
                echo "<script>alert('Error deleting user.');</script>";
            }
            $delete_stmt->close();
        }
    }

    // Edit user
    if(isset($_POST['edit_user'])){
        if (!validateCSRF($_POST['csrf_token'] ?? '')) {
            die("Security token validation failed!");
        }
        
        $id = intval($_POST['user_id']);
        $name = sanitize($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $department = sanitize($_POST['department']);
        $user_type = sanitize($_POST['user_type']);
        
        $errors = [];
        
        if (empty($name) || strlen($name) < 2) {
            $errors[] = "Name must be at least 2 characters long";
        }
        
        if (!$email) {
            $errors[] = "Invalid email format";
        }
        
        $valid_departments = ['Computer Science', 'Electronics', 'Mechanical', 'Civil', 'MBA', 'MCA'];
        if (!in_array($department, $valid_departments)) {
            $errors[] = "Invalid department selected";
        }
        
        $valid_user_types = ['student', 'parent', 'faculty'];
        if (!in_array($user_type, $valid_user_types)) {
            $errors[] = "Invalid user type selected";
        }
        
        if(!empty($_POST['password'])){
            $password_errors = validatePassword($_POST['password']);
            if (!empty($password_errors)) {
                $errors = array_merge($errors, $password_errors);
            }
        }
        
        if (empty($errors)) {
            if(!empty($_POST['password'])){
                $update_stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, department = ?, user_type = ?, password = ? WHERE id = ? LIMIT 1");
                $update_stmt->bind_param("sssssi", $name, $email, $department, $user_type, $_POST['password'], $id);
            } else {
                $update_stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, department = ?, user_type = ? WHERE id = ? LIMIT 1");
                $update_stmt->bind_param("ssssi", $name, $email, $department, $user_type, $id);
            }
            
            if ($update_stmt->execute()) {
                echo "<script>alert('User updated successfully!');window.location='manage_users.php';</script>";
            } else {
                echo "<script>alert('Error updating user.');</script>";
            }
            $update_stmt->close();
        } else {
            $error_msg = implode("\\n", $errors);
            echo "<script>alert('$error_msg');</script>";
        }
    }

    // Get filter
    $filter = isset($_GET['filter']) ? sanitize($_GET['filter']) : 'all';
    $valid_filters = ['all', 'student', 'parent', 'faculty'];
    if (!in_array($filter, $valid_filters)) {
        $filter = 'all';
    }

    // Build query
    if($filter != 'all'){
        $users_stmt = $conn->prepare("SELECT * FROM users WHERE user_type = ? ORDER BY created_at DESC");
        $users_stmt->bind_param("s", $filter);
        $users_stmt->execute();
        $users = $users_stmt->get_result();
    } else {
        $users = mysqli_query($conn, "SELECT * FROM users ORDER BY created_at DESC");
    }

    // Get statistics
    $total_users = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users"));
    $total_students = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE user_type='student'"));
    $total_parents = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE user_type='parent'"));
    $total_faculty = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE user_type='faculty'"));
?>


<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - College Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%);
            padding: 20px 0;
            overflow-y: auto;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .logo {
            text-align: center;
            padding: 20px;
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .logo i {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .logo h2 {
            font-size: 20px;
            font-weight: 600;
        }

        .nav-menu {
            list-style: none;
            padding: 0 15px;
            flex: 1;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .logout-section {
            padding: 0 15px;
            padding-bottom: 20px;
            margin-top: auto;
        }

        .logout-link {
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            background: rgba(244, 67, 54, 0.2);
        }

        .logout-link:hover {
            background: rgba(244, 67, 54, 0.4);
            color: white;
            transform: translateX(5px);
        }

        .logout-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title h1 {
            font-size: 28px;
            color: #1e3c72;
            margin-bottom: 5px;
        }

        .breadcrumb {
            color: #666;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .action-buttons-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: #4CAF50;
            color: white;
        }

        .btn-warning {
            background: #ff9800;
            color: white;
        }

        .btn-danger {
            background: #f44336;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .stat-icon.total { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-icon.students { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .stat-icon.parents { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .stat-icon.faculty { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }

        .stat-info h3 {
            font-size: 32px;
            color: #1e3c72;
            margin-bottom: 5px;
        }

        .stat-info p {
            color: #666;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-header h2 {
            color: #1e3c72;
            font-size: 20px;
        }

        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 8px 16px;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #666;
            transition: all 0.3s;
            text-decoration: none;
        }

        .filter-tab:hover {
            border-color: #667eea;
            color: #667eea;
        }

        .filter-tab.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background: #f8f9fa;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #1e3c72;
            font-size: 14px;
            border-bottom: 2px solid #e0e0e0;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            font-weight: bold;
            margin-right: 10px;
        }

        .user-type-badge {
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-student { background: #e3f2fd; color: #1976d2; }
        .badge-parent { background: #f3e5f5; color: #7b1fa2; }
        .badge-faculty { background: #e8f5e9; color: #388e3c; }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-small {
            padding: 6px 12px;
            font-size: 12px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            padding: 30px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .modal-header h2 {
            color: #1e3c72;
            font-size: 24px;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }

        .close-btn:hover {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #667eea;
        }

        .user-type-selector {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .type-option {
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .type-option:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .type-option.active {
            border-color: #667eea;
            background: #f0f3ff;
        }

        .type-option i {
            font-size: 24px;
            margin-bottom: 8px;
            color: #667eea;
        }

        .type-option h4 {
            color: #333;
            font-size: 14px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            color: #e0e0e0;
        }

        .password-requirements {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
            margin-top: 8px;
            font-size: 12px;
            color: #666;
        }

        .password-requirements ul {
            margin: 5px 0 0 20px;
            padding: 0;
        }

        .info-box {
            background: #e8f5e9;
            border-left: 4px solid #4CAF50;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .info-box h4 {
            color: #2e7d32;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .info-box p, .info-box ol {
            color: #1b5e20;
            font-size: 14px;
            line-height: 1.6;
        }

        .info-box ol {
            margin: 10px 0 0 20px;
        }

        .upload-area {
            border: 2px dashed #667eea;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            background: #f8f9ff;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .upload-area:hover {
            border-color: #4facfe;
            background: #f0f3ff;
        }

        .upload-area i {
            font-size: 48px;
            color: #667eea;
            margin-bottom: 15px;
            display: block;
        }

        .upload-area h3 {
            color: #1e3c72;
            margin-bottom: 10px;
        }

        .upload-area p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            cursor: pointer;
        }

        .template-link {
            margin-top: 15px;
            display: inline-block;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .template-link:hover {
            text-decoration: underline;
            color: #4facfe;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .logo h2, .nav-link span, .logout-link span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 12px;
            }

            .top-bar {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <h2>College Portal</h2>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="faculty.php" class="nav-link">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Faculty</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="herosection.php" class="nav-link">
                    <i class="fas fa-image"></i>
                    <span>Hero Section</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="news&update.php" class="nav-link">
                    <i class="fas fa-newspaper"></i>
                    <span>News & Updates</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="admission.php" class="nav-link">
                    <i class="fas fa-user-plus"></i>
                    <span>Admission</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="gallery.php" class="nav-link">
                    <i class="fas fa-images"></i>
                    <span>Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="manage_users.php" class="nav-link active">
                    <i class="fas fa-users-cog"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="feedback_management.php" class="nav-link">
                    <i class="fas fa-star"></i>
                    <span>Reviews</span>
                </a>
            </li>
                    <li class="nav-item"><a href="popup.php" class="nav-link"><i class="fas fa-window-restore"></i><span>Popup Banner</span></a></li>

        </ul>
        
        <div class="logout-section">
            <a href="../logout.php" class="logout-link" onclick="return confirm('Are you sure you want to logout?')">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1>User Management</h1>
                <div class="breadcrumb">
                    <a href="faculty.php">Home</a> / <span>Manage Users</span>
                </div>
            </div>
            <div class="action-buttons-group">
                <button class="btn btn-info" onclick="openUploadModal()">
                    <i class="fas fa-file-excel"></i>
                    Bulk Upload
                </button>
                <button class="btn btn-primary" onclick="openAddModal()">
                    <i class="fas fa-plus"></i>
                    Add New User
                </button>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $total_users; ?></h3>
                    <p>Total Users</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon students">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $total_students; ?></h3>
                    <p>Students</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon parents">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $total_parents; ?></h3>
                    <p>Parents</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon faculty">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $total_faculty; ?></h3>
                    <p>Faculty</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>All Users</h2>
            </div>
            
            <div class="filter-tabs">
                <a href="manage_users.php?filter=all" class="filter-tab <?php echo $filter == 'all' ? 'active' : ''; ?>">
                    All Users
                </a>
                <a href="manage_users.php?filter=student" class="filter-tab <?php echo $filter == 'student' ? 'active' : ''; ?>">
                    Students
                </a>
                <a href="manage_users.php?filter=parent" class="filter-tab <?php echo $filter == 'parent' ? 'active' : ''; ?>">
                    Parents
                </a>
                <a href="manage_users.php?filter=faculty" class="filter-tab <?php echo $filter == 'faculty' ? 'active' : ''; ?>">
                    Faculty
                </a>
            </div>

            <?php if(mysqli_num_rows($users) > 0){ ?>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Type</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = mysqli_fetch_assoc($users)){ ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <div class="user-avatar">
                                            <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                                        </div>
                                        <strong><?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($user['department'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <span class="user-type-badge badge-<?php echo $user['user_type']; ?>">
                                        <?php echo ucfirst($user['user_type']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M j, Y', strtotime($user['created_at'])); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-warning btn-small" onclick='openEditModal(<?php echo json_encode($user, JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'>
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <a href="manage_users.php?action=delete&id=<?php echo $user['id']; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>" 
                                           onclick="return confirm('Delete this user? All their reviews will be deleted too.')" 
                                           class="btn btn-danger btn-small">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="empty-state">
                    <i class="fas fa-users-slash"></i>
                    <h3>No Users Found</h3>
                    <p>No users match your current filter.</p>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Excel Upload Modal -->
    <div class="modal" id="uploadModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-file-excel"></i> Bulk Upload Users</h2>
                <button class="close-btn" onclick="closeUploadModal()">&times;</button>
            </div>

            <div class="info-box">
                <h4><i class="fas fa-info-circle"></i> Excel Format Requirements</h4>
                <p>Your Excel file must have the following columns in order:</p>
                <ol>
                    <li><strong>Name</strong> - Full name (minimum 2 characters)</li>
                    <li><strong>Email</strong> - Valid email address</li>
                    <li><strong>Password</strong> - Minimum 8 characters</li>
                    <li><strong>Department</strong> - One of: Computer Science, Electronics, Mechanical, Civil, MBA, MCA</li>
                    <li><strong>User Type</strong> - One of: student, parent, faculty</li>
                </ol>
            </div>

            <form method="POST" action="" enctype="multipart/form-data" id="uploadForm">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                
                <div class="upload-area">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <h3>Upload Excel or CSV File</h3>
                    <p>Drag and drop or click to select file</p>
                    
                    <div class="file-input-wrapper">
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-folder-open"></i> Choose File
                        </button>
                        <input type="file" name="excel_file" id="excelFile" accept=".xlsx,.xls,.csv" required onchange="displayFileName()">
                    </div>
                    
                    <p id="fileName" style="margin-top: 15px; font-weight: 600; color: #4CAF50;"></p>
                </div>

                <a href="download_template.php" class="template-link" target="_blank">
                    <i class="fas fa-download"></i> Download Sample Template
                </a>

                <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 25px;">
                    <button type="button" class="btn btn-secondary" onclick="closeUploadModal()">Cancel</button>
                    <button type="submit" name="upload_excel" class="btn btn-success">
                        <i class="fas fa-upload"></i> Upload & Import
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal" id="addModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New User</h2>
                <button class="close-btn" onclick="closeAddModal()">&times;</button>
            </div>

            <form method="POST" action="" id="addUserForm">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                
                <div class="form-group">
                    <label>User Type *</label>
                    <div class="user-type-selector">
                        <div class="type-option active" onclick="selectType('student', 'add')">
                            <i class="fas fa-user-graduate"></i>
                            <h4>Student</h4>
                        </div>
                        <div class="type-option" onclick="selectType('parent', 'add')">
                            <i class="fas fa-user-friends"></i>
                            <h4>Parent</h4>
                        </div>
                        <div class="type-option" onclick="selectType('faculty', 'add')">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <h4>Faculty</h4>
                        </div>
                    </div>
                    <input type="hidden" name="user_type" id="addUserType" value="student">
                </div>

                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" placeholder="Enter full name" required minlength="2">
                </div>

                <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" placeholder="Enter email address" required>
                </div>

                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" id="addPassword" placeholder="Enter password" required minlength="8">
                    <div class="password-requirements">
                        <strong>Password must contain:</strong>
                        <ul>
                            <li>At least 8 characters</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label>Department *</label>
                    <select name="department" required>
                        <option value="">Select Department</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Mechanical">Mechanical</option>
                        <option value="Civil">Civil</option>
                        <option value="MBA">MBA</option>
                        <option value="MCA">MCA</option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 25px;">
                    <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Cancel</button>
                    <button type="submit" name="add_user" class="btn btn-success">
                        <i class="fas fa-save"></i> Add User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit User</h2>
                <button class="close-btn" onclick="closeEditModal()">&times;</button>
            </div>

            <form method="POST" action="" id="editUserForm">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <input type="hidden" name="user_id" id="editUserId">

                <div class="form-group">
                    <label>User Type *</label>
                    <div class="user-type-selector">
                        <div class="type-option" id="editTypeStudent" onclick="selectType('student', 'edit')">
                            <i class="fas fa-user-graduate"></i>
                            <h4>Student</h4>
                        </div>
                        <div class="type-option" id="editTypeParent" onclick="selectType('parent', 'edit')">
                            <i class="fas fa-user-friends"></i>
                            <h4>Parent</h4>
                        </div>
                        <div class="type-option" id="editTypeFaculty" onclick="selectType('faculty', 'edit')">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <h4>Faculty</h4>
                        </div>
                    </div>
                    <input type="hidden" name="user_type" id="editUserType">
                </div>

                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" id="editName" placeholder="Enter full name" required minlength="2">
                </div>

                <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" id="editEmail" placeholder="Enter email address" required>
                </div>

                <div class="form-group">
                    <label>New Password (leave blank to keep current)</label>
                    <input type="password" name="password" id="editPassword" placeholder="Enter new password" minlength="8">
                    <div class="password-requirements">
                        <strong>If changing password, it must contain:</strong>
                        <ul>
                            <li>At least 8 characters</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label>Department *</label>
                    <select name="department" id="editDepartment" required>
                        <option value="">Select Department</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Mechanical">Mechanical</option>
                        <option value="Civil">Civil</option>
                        <option value="MBA">MBA</option>
                        <option value="MCA">MCA</option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 25px;">
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" name="edit_user" class="btn btn-success">
                        <i class="fas fa-save"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openUploadModal() {
            document.getElementById('uploadModal').classList.add('active');
        }

        function closeUploadModal() {
            document.getElementById('uploadModal').classList.remove('active');
            document.getElementById('uploadForm').reset();
            document.getElementById('fileName').textContent = '';
        }

        function displayFileName() {
            const input = document.getElementById('excelFile');
            const fileNameDisplay = document.getElementById('fileName');
            
            if(input.files.length > 0) {
                const fileName = input.files[0].name;
                const fileSize = (input.files[0].size / 1024).toFixed(2);
                fileNameDisplay.textContent = `✓ Selected: ${fileName} (${fileSize} KB)`;
            } else {
                fileNameDisplay.textContent = '';
            }
        }

        function openAddModal() {
            document.getElementById('addModal').classList.add('active');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.remove('active');
            document.getElementById('addUserForm').reset();
        }

        function openEditModal(user) {
            document.getElementById('editModal').classList.add('active');
            document.getElementById('editUserId').value = user.id;
            document.getElementById('editName').value = user.name;
            document.getElementById('editEmail').value = user.email;
            document.getElementById('editDepartment').value = user.department;
            document.getElementById('editUserType').value = user.user_type;

            document.querySelectorAll('#editModal .type-option').forEach(opt => {
                opt.classList.remove('active');
            });
            const typeElement = document.getElementById('editType' + user.user_type.charAt(0).toUpperCase() + user.user_type.slice(1));
            if (typeElement) {
                typeElement.classList.add('active');
            }
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
            document.getElementById('editUserForm').reset();
        }

        function selectType(type, mode) {
            if(mode === 'add') {
                document.querySelectorAll('#addModal .type-option').forEach(opt => {
                    opt.classList.remove('active');
                });
                event.target.closest('.type-option').classList.add('active');
                document.getElementById('addUserType').value = type;
            } else {
                document.querySelectorAll('#editModal .type-option').forEach(opt => {
                    opt.classList.remove('active');
                });
                event.target.closest('.type-option').classList.add('active');
                document.getElementById('editUserType').value = type;
            }
        }

        window.onclick = function(event) {
            const addModal = document.getElementById('addModal');
            const editModal = document.getElementById('editModal');
            const uploadModal = document.getElementById('uploadModal');
            
            if (event.target === addModal) {
                closeAddModal();
            }
            if (event.target === editModal) {
                closeEditModal();
            }
            if (event.target === uploadModal) {
                closeUploadModal();
            }
        }
    </script>
</body>
</html>