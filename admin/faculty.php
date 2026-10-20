<?php
        session_start();
        if (!isset($_SESSION['email'])) {
            header("Location: ../login.php");
            exit();
        }

        include 'db.php';

        // -------------------------------------------
        // GET TOTAL FACULTY COUNT
        // -------------------------------------------
        $totalApplications = 0;
        $countRes = $conn->query("SELECT COUNT(*) AS total FROM `faculty-details`");
        if ($countRes) {
            $details = $countRes->fetch_assoc();
            $totalApplications = $details['total'] ?? 0;
        }

        // -------------------------------------------
        // ADD NEW FACULTY
        // -------------------------------------------
        if (isset($_POST['action']) && $_POST['action'] === "add") {

            $name = $_POST['name'];
            $staff_type = $_POST['staff-type'] ?? '';
            $department = $_POST['department'];
            $email = $_POST['email'] ?? '';
            $experience = $_POST['experience'] ?? '';
            $education = $_POST['education-details'] ?? '';
            $publications = $_POST['publication-details'] ?? '';
            $description = $_POST['description'] ?? '';

            // Upload Image
            $image = $_FILES['staff-image']['name'];
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
            $target_file = $target_dir . basename($image);

            if (move_uploaded_file($_FILES['staff-image']['tmp_name'], $target_file)) {

                $sql = "INSERT INTO `faculty-details` 
                (`name`, `staff-type`, `department`, `email`, `education-details`, `experience`, `publication-details`, `description`, `faculty-image`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssssss", 
                    $name, 
                    $staff_type, 
                    $department, 
                    $email, 
                    $education, 
                    $experience, 
                    $publications, 
                    $description, 
                    $target_file
                );

                $stmt->execute();
                echo "<script>alert('Faculty added successfully!'); window.location.href='faculty.php';</script>";
                exit;
            }
        }

        // -------------------------------------------
        // UPDATE FACULTY
        // -------------------------------------------
        if (isset($_POST['action']) && $_POST['action'] === "update") {

            $id = $_POST['id'];
            $name = $_POST['name'];
            $staff_type = $_POST['staff_type'];
            $department = $_POST['department'];
            $email = $_POST['email'];
            $experience = $_POST['experience'];
            $education = $_POST['education'];
            $publications = $_POST['publications'];
            $description = $_POST['description'];

            // Check image uploaded
            if (!empty($_FILES['image']['name'])) {

                $image = $_FILES['image']['name'];
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
                $target_file = $target_dir . basename($image);

                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

                $sql = "UPDATE `faculty-details` SET 
                `name`=?, 
                `staff-type`=?, 
                `department`=?, 
                `email`=?, 
                `education-details`=?, 
                `experience`=?, 
                `publication-details`=?, 
                `description`=?, 
                `faculty-image`=? 
                WHERE `id`=?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssssssi", 
                    $name, 
                    $staff_type, 
                    $department, 
                    $email, 
                    $education, 
                    $experience, 
                    $publications, 
                    $description, 
                    $target_file, 
                    $id
                );
            } 
            else {

                $sql = "UPDATE `faculty-details` SET 
                `name`=?, 
                `staff-type`=?, 
                `department`=?, 
                `email`=?, 
                `education-details`=?, 
                `experience`=?, 
                `publication-details`=?, 
                `description`=? 
                WHERE `id`=?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssssi", 
                    $name, 
                    $staff_type, 
                    $department, 
                    $email, 
                    $education, 
                    $experience, 
                    $publications, 
                    $description, 
                    $id
                );
            }

            $stmt->execute();
            echo "<script>alert('Faculty updated successfully!'); window.location.href='faculty.php';</script>";
            exit;
        }

        // -------------------------------------------
        // DELETE FACULTY
        // -------------------------------------------
        if (isset($_POST['action']) && $_POST['action'] === "delete") {

            $id = $_POST['delete_id'];

            $query = "DELETE FROM `faculty-details` WHERE `id`=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            echo "<script>window.location.href='faculty.php';</script>";
            exit;
        }

        // -------------------------------------------
        // FETCH DATA
        // -------------------------------------------
        $result = $conn->query("SELECT * FROM `faculty-details` ORDER BY id DESC");
        $dept_query = $conn->query("SELECT DISTINCT `department` FROM `faculty-details`");

?>



<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Management - College Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .faculty-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        @media (max-width: 1200px) {
            .faculty-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .faculty-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .faculty-grid {
                grid-template-columns: 1fr;
            }
        }

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
            color: #2196F3;
            text-decoration: none;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .action-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px 15px;
            flex: 1;
            max-width: 400px;
        }

        .search-box i {
            color: #999;
            margin-right: 10px;
        }

        .search-box input {
            border: none;
            background: none;
            outline: none;
            width: 100%;
            font-size: 14px;
        }

        .filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            font-size: 14px;
            cursor: pointer;
            outline: none;
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
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .icon-blue { background: #e3f2fd; color: #2196F3; }

        .stat-info h3 {
            font-size: 24px;
            color: #1e3c72;
            margin-bottom: 3px;
        }

        .stat-info p {
            color: #666;
            font-size: 13px;
        }

        .faculty-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .faculty-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .faculty-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }

        .faculty-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 15px;
        }

        .faculty-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.3);
        }

        .faculty-name {
            color: white;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .faculty-position {
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
        }

        .faculty-body {
            padding: 20px;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .info-row i {
            width: 20px;
            color: #2196F3;
            margin-right: 10px;
            margin-top: 3px;
        }

        .info-row span {
            color: #666;
            flex: 1;
        }

        .faculty-footer {
            padding: 15px 20px;
            border-top: 1px solid #f0f0f0;
            display: flex;
            gap: 10px;
        }

        .btn-small {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-edit {
            background: #fff3e0;
            color: #FF9800;
        }

        .btn-edit:hover {
            background: #FF9800;
            color: white;
        }

        .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-active {
            background: rgba(76, 175, 80, 0.2);
            color: #4CAF50;
        }

        .conditional-field {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .logo h2, .nav-link span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                max-width: 100%;
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
                <a href="faculty.php" class="nav-link active">
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
                    <i class="fas fa-user-plus"></i>
                    <span>Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="manage_users.php" class="nav-link">
                    <i class="fas fa-user-plus"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="feedback_management.php" class="nav-link">
                    <i class="fas fa-comments"></i>
                    <span>Feedback</span>
                </a>
            </li>
                    <li class="nav-item"><a href="popup.php" class="nav-link "><i class="fas fa-window-restore"></i><span>Popup Banner</span></a></li>

        </ul>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1>Faculty Management</h1>
                <div class="breadcrumb">
                    <a href="#">Home</a> / <span>Faculty</span>
                </div>
            </div>
            <div class="user-info">
                <div class="avatar">AD</div>
                <div>
                    <strong>Admin User</strong>
                </div>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-icon icon-blue">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $totalApplications ?></h3>
                    <p>Total Faculty</p>
                </div>
            </div>
        </div>

        <div class="action-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterCards()">
            </div>

            <div class="filters">
                <select class="filter-select" id="deptFilter" onchange="filterCards()">
                    <option value="">All Departments</option>
                    <?php while($d = $dept_query->fetch_assoc()): ?>
                        <option value="<?= $d['department']; ?>"><?= $d['department']; ?></option>
                    <?php endwhile; ?>
                </select>

                <select class="filter-select" id="staffFilter" onchange="filterCards()">
                    <option value="">All Staff</option>
                    <option value="TEACHING STAFF">Teaching</option>
                    <option value="NON-TEACHING STAFF">Non-Teaching</option>
                </select>
            </div>
            
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFacultyModal">
                <i class="fas fa-plus"></i>
                Add Faculty
            </button>
        </div>

        <div class="faculty-grid">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="faculty-card"
                    data-name="<?= strtolower($row['name']); ?>"
                    data-department="<?= strtolower($row['department']); ?>"
                    data-staff="<?= strtolower($row['staff-type']); ?>">

                    <div class="faculty-header">
                        <span class="status-badge badge-active">Active</span>
                        <div class="faculty-avatar">
                            <?php 
                            $image = !empty($row['faculty-image']) ? $row['faculty-image'] : "default.jpg";
                            ?>
                            <img src="<?= $image; ?>" alt="Faculty Photo">
                        </div>
                        <div class="faculty-name"><?= htmlspecialchars($row['name']); ?></div>
                        <div class="faculty-position"><?= htmlspecialchars($row['staff-type']); ?></div>
                    </div>

                    <div class="faculty-body">
                        <div class="info-row">
                            <i class="fas fa-building"></i>
                            <span><?= htmlspecialchars($row['department']); ?></span>
                        </div>
                        <div class="info-row">
                            <i class="fas fa-envelope"></i>
                            <span><?= htmlspecialchars($row['email']); ?></span>
                        </div>
                        <div class="info-row">
                            <i class="fas fa-briefcase"></i>
                            <span><?= htmlspecialchars($row['experience']); ?></span>
                        </div>
                        <?php if ($row['staff-type'] === 'TEACHING STAFF' && !empty($row['education-details'])): ?>
                        <div class="info-row">
                            <i class="fas fa-graduation-cap"></i>
                            <span><?= htmlspecialchars($row['education-details']); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="faculty-footer">
                        <button class="btn btn-sm btn-primary btn-edit"
                            data-id="<?= $row['id']; ?>"
                            data-name="<?= htmlspecialchars($row['name']); ?>"
                            data-staff="<?= htmlspecialchars($row['staff-type']); ?>"
                            data-department="<?= htmlspecialchars($row['department']); ?>"
                            data-email="<?= htmlspecialchars($row['email']); ?>"
                            data-education="<?= htmlspecialchars($row['education-details']); ?>"
                            data-experience="<?= htmlspecialchars($row['experience']); ?>"
                            data-publications="<?= htmlspecialchars($row['publication-details']); ?>"
                            data-description="<?= htmlspecialchars($row['description']); ?>"
                            data-image="<?= htmlspecialchars($row['faculty-image']); ?>">
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this faculty member?');" style="display: inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Add Faculty Modal -->
        <div class="modal fade" id="addFacultyModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Faculty</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Full Name *</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                                <label>Staff Type *</label>
                                <select class="form-control" name="staff-type" id="addStaffType" required onchange="toggleFields('add')">
                                    <option value="">Select Staff Type</option>
                                     <option value="Assistant Professor & HOD">Assistant Professor & HOD</option>
                                    <option value="Assistant Professor">Assistant Professor</option>
                                    <option value="NON-TEACHING STAFF">Non-Teaching Staff</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Department *</label>
                                <input type="text" class="form-control" name="department" required>
                            </div>

                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            <!-- Teaching Staff Only -->
                            <div class="form-group conditional-field" id="addEducationField">
                                <label>Education Details *</label>
                                <textarea class="form-control" name="education-details" rows="2" placeholder="e.g., M.Sc., Ph.D. in Computer Science"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Experience Details *</label>
                                <textarea class="form-control" name="experience" rows="2" required placeholder="e.g., 10 years of teaching experience"></textarea>
                            </div>

                            <!-- Teaching Staff Only -->
                            <div class="form-group conditional-field" id="addPublicationField">
                                <label>Publication Details</label>
                                <textarea class="form-control" name="publication-details" rows="3" placeholder="Research papers, journals, conferences, etc."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="2" placeholder="Additional information"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Faculty Image *</label>
                                <input type="file" class="form-control-file" name="staff-image" accept="image/*" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Faculty</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Faculty Modal -->
        <div class="modal fade" id="editFacultyModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Faculty</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" id="editId">

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Full Name *</label>
                                <input type="text" class="form-control" name="name" id="editName" required>
                            </div>

                            <div class="form-group">
                                <label>Staff Type *</label>
                                <select class="form-control" name="staff_type" id="editStaffType" required onchange="toggleFields('edit')">
                                    <option value="">Select Staff Type</option>
                                    <option value="Assistant Professor & HOD">Assistant Professor & HOD</option>
                                    <option value="Assistant Professor">Assistant Professor</option>
                                    <option value="NON-TEACHING STAFF">Non-Teaching Staff</option>
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label>Department *</label>
                                <input type="text" class="form-control" name="department" id="editDepartment" required>
                            </div>

                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" class="form-control" name="email" id="editEmail" required>
                            </div>

                            <!-- Teaching Staff Only -->
                            <div class="form-group conditional-field" id="editEducationField">
                                <label>Education Details *</label>
                                <textarea class="form-control" name="education" id="editEducation" rows="2"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Experience Details *</label>
                                <textarea class="form-control" name="experience" id="editExperience" rows="2" required></textarea>
                            </div>

                            <!-- Teaching Staff Only -->
                            <div class="form-group conditional-field" id="editPublicationField">
                                <label>Publication Details</label>
                                <textarea class="form-control" name="publications" id="editPublications" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="editDescription" rows="2"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Change Image (optional)</label><br>
                                <img id="editPreview" src="default.jpg" alt="Faculty Photo" style="width:100px; height:100px; border-radius:8px; object-fit:cover; margin-bottom:10px;"><br>
                                <input type="file" name="image" class="form-control-file" accept="image/*">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Faculty</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Toggle conditional fields based on staff type
        function toggleFields(mode) {
            const staffType = document.getElementById(mode + 'StaffType').value;
            const educationField = document.getElementById(mode + 'EducationField');
            const publicationField = document.getElementById(mode + 'PublicationField');
            
            if (staffType === 'TEACHING STAFF') {
                educationField.style.display = 'block';
                publicationField.style.display = 'block';
                educationField.querySelector('textarea').setAttribute('required', 'required');
            } else {
                educationField.style.display = 'none';
                publicationField.style.display = 'none';
                educationField.querySelector('textarea').removeAttribute('required');
            }
        }

        // Filter cards
        function filterCards() {
            const search = document.getElementById("searchInput").value.toLowerCase();
            const dept = document.getElementById("deptFilter").value.toLowerCase();
            const staff = document.getElementById("staffFilter").value.toLowerCase();

            document.querySelectorAll(".faculty-card").forEach(card => {
                const name = card.dataset.name;
                const department = card.dataset.department;
                const stafftype = card.dataset.staff;

                const matchSearch = search === "" || name.includes(search) || department.includes(search);
                const matchDept = dept === "" || department.includes(dept);
                const matchStaff = staff === "" || stafftype.includes(staff);

                card.style.display = (matchSearch && matchDept && matchStaff) ? "block" : "none";
            });
        }

        // Edit button click handler
        $(document).on('click', '.btn-edit', function () {
            let data = $(this).data();

            $('#editId').val(data.id);
            $('#editName').val(data.name);
            $('#editStaffType').val(data.staff);
            $('#editDepartment').val(data.department);
            $('#editEmail').val(data.email);
            $('#editEducation').val(data.education);
            $('#editExperience').val(data.experience);
            $('#editPublications').val(data.publications);
            $('#editDescription').val(data.description);

            // Image preview
            let imagePath = data.image;
            if (imagePath) {
                $('#editPreview').attr('src', imagePath);
            } else {
                $('#editPreview').attr('src', 'default.jpg');
            }

            // Toggle fields based on staff type
            toggleFields('edit');

            $('#editFacultyModal').modal('show');
        });
    </script>
</body>
</html>