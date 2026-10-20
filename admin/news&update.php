<?php
include "db.php";

// ✅ ADD NEWS
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    $pdf = $_FILES['pdf']['name'];
    $tmp = $_FILES['pdf']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $pdf);

    mysqli_query($conn, "INSERT INTO newsupdate(title, date, description, pdf) VALUES('$title', '$date', '$description', '$pdf')");
    echo "<script>alert('News Added!');window.location='news&update.php';</script>";
}

// ✅ DELETE NEWS
if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM newsupdate WHERE id='$id'");
    echo "<script>alert('Deleted!');window.location='news&update.php';</script>";
}

// ✅ FETCH DATA FOR EDIT
if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $id = $_GET['id'];
    $editData = mysqli_query($conn, "SELECT * FROM newsupdate WHERE id='$id'");
    $edit = mysqli_fetch_assoc($editData);
}

// ✅ UPDATE NEWS
if (isset($_POST['update'])) {
    $id = $_POST['news_id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    if (!empty($_FILES['pdf']['name'])) {
        $pdf = $_FILES['pdf']['name'];
        $tmp = $_FILES['pdf']['tmp_name'];
        move_uploaded_file($tmp, "uploads/" . $pdf);

        mysqli_query($conn, "UPDATE newsupdate SET title='$title', date='$date', description='$description', pdf='$pdf' WHERE id='$id'");
    } else {
        mysqli_query($conn, "UPDATE newsupdate SET title='$title', date='$date', description='$description' WHERE id='$id'");
    }

    echo "<script>alert('Updated!');window.location='news&update.php';</script>";
}
?>


<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Updates Management - College Portal</title>
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

        .btn-success {
            background: #4CAF50;
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

        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: border 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #667eea;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .news-list {
            display: grid;
            gap: 20px;
        }

        .news-item {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: grid;
            grid-template-columns: 80px 1fr auto;
            gap: 20px;
            align-items: start;
            transition: all 0.3s;
        }

        .news-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .news-date {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .news-date .day {
            display: block;
            font-size: 28px;
            font-weight: bold;
            line-height: 1;
        }

        .news-date .month {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            margin-top: 5px;
        }

        .news-content h3 {
            color: #1e3c72;
            margin-bottom: 8px;
            font-size: 18px;
        }

        .news-content p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .news-meta {
            display: flex;
            gap: 15px;
            font-size: 13px;
            color: #999;
        }

        .news-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .category-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
        }

        .badge-academic { background: #e3f2fd; color: #2196F3; }
        .badge-event { background: #f3e5f5; color: #9C27B0; }
        .badge-achievement { background: #fff3e0; color: #FF9800; }
        .badge-announcement { background: #ffebee; color: #f44336; }
        .badge-placement { background: #e8f5e9; color: #4CAF50; }

        .news-actions {
            display: flex;
            gap: 10px;
            flex-direction: column;
        }

        .btn-small {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 5px;
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

        .btn-delete {
            background: #ffebee;
            color: #f44336;
        }

        .btn-delete:hover {
            background: #f44336;
            color: white;
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
            border-radius: 10px;
            padding: 30px;
            max-width: 700px;
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

        .search-filter-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
            display: flex;
            align-items: center;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 10px 15px;
        }

        .search-box i {
            color: #999;
            margin-right: 10px;
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
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

            .form-row {
                grid-template-columns: 1fr;
            }

            .news-item {
                grid-template-columns: 1fr;
            }

            .news-actions {
                flex-direction: row;
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
                <a href="faculty.php" class="nav-link ">
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
                <a href="news&update.php" class="nav-link active">
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
                    <li class="nav-item"><a href="popup.php" class="nav-link"><i class="fas fa-window-restore"></i><span>Popup Banner</span></a></li>

        </ul>
    </div>
    <div class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1>News & Updates Management</h1>
                <div class="breadcrumb">
                    <a href="#">Home</a> / <span>News & Updates</span>
                </div>
            </div>
            <button class="btn btn-primary" onclick="openModal()">
                <i class="fas fa-plus"></i>
                Add News
            </button>
        </div>

        <div class="search-filter-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search news..." onkeyup="filterNews()">
            </div>
           
        </div>

        <div class="news-list" id="newsList">
            <?php
                $newsData = mysqli_query($conn, "SELECT * FROM newsupdate ORDER BY date DESC");
                while ($n = mysqli_fetch_assoc($newsData)) { 
                    $date = date("d", strtotime($n['date']));
                    $month = date("M", strtotime($n['date']));
            ?>
                <div class="news-item">
                    <div class="news-date">
                        <span class="day"><?= $date ?></span>
                        <span class="month"><?= $month ?></span>
                    </div>
                    <div class="news-content">
                        <h3><?= $n['title'] ?></h3>
                        <p><?= $n['description'] ?></p>
                        <a href="uploads/<?= $n['pdf'] ?>" target="_blank" class="pdf-link">
                            <i class="fa fa-file-pdf"></i> View PDF
                        </a>
                    </div>
                    <div class="news-actions">
                        <a href="news&update.php?action=edit&id=<?= $n['id'] ?>" class="btn-small btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <a href="news&update.php?action=delete&id=<?= $n['id'] ?>" 
                        onclick="return confirm('Delete this news?')" class="btn-small btn-delete">
                            <i class="fas fa-trash"></i> Delete
                        </a>

                    </div>

                </div>
            <?php } ?>
        </div>

    </div>

    <!-- Add/Edit News Modal -->
    <div class="modal" id="newsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add News</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <form id="newsForm" method="POST" enctype="multipart/form-data" action="">

            <input type="hidden" name="news_id" id="newsId">

                <input type="hidden" id="newsId">
                
                <div class="form-group">
                    <label for="newsTitle">News Title *</label>
                    <input type="text" name="title" id="newsTitle" required>
                </div>

                <div class="form-row">
                   

                    <div class="form-group">
                        <label for="newsDate">Date *</label>
                        <input type="date" name="date" id="newsDate" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="newsDescription">Description *</label>
                    <textarea name="description" id="newsDescription" required></textarea>
                </div>
                <div class="form-group">
                    <label for="newspdf">Upload pdf *</label>
                    <input type="file" name="pdf" id="newspdf" accept=".pdf" required>
                </div>
              
                <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 25px;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <?php if(isset($edit)) { ?>
                        <button type="submit" name="update" class="btn btn-success">
                            <i class="fas fa-save"></i> Update News
                        </button>
                    <?php } else { ?>
                        <button type="submit" name="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Save News
                        </button>
                    <?php } ?>


                </div>
            </form>
        </div>
    </div>

    <script>
        let editingId = null;

        // Set today's date as default
        document.getElementById('newsDate').valueAsDate = new Date();


    

        // Open modal
        function openModal() {
            document.getElementById('newsModal').classList.add('active');
            document.getElementById('modalTitle').textContent = 'Add News';
            document.getElementById('newsForm').reset();
            document.getElementById('newsDate').valueAsDate = new Date();
            editingId = null;
        }

        // Close modal
        function closeModal() {
            document.getElementById('newsModal').classList.remove('active');
            document.getElementById('newsForm').reset();
            editingId = null;
        }

      

       
        // Load news on page load
        loadNews();

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('newsModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
    <script>
    <?php if(isset($edit)){ ?>
        document.addEventListener("DOMContentLoaded", function(){
            openModal();
            document.getElementById('modalTitle').textContent = 'Edit News';
            document.getElementById('newsTitle').value = "<?= $edit['title'] ?>";
            document.getElementById('newsDate').value = "<?= $edit['date'] ?>";
            document.getElementById('newsDescription').value = "<?= $edit['description'] ?>";
            document.getElementById('newsForm').action = "news&update.php?id=<?= $edit['id'] ?>";
            editingId = <?= $edit['id'] ?>;
        });
    <?php } ?>
    </script>

</body>
</html>