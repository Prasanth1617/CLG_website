<?php
require_once __DIR__ . '/auth.php';
include "db.php";

// ✅ INSERT (Image / Video)
if(isset($_POST['save'])){
    $type = $_POST['type'];
    $duration = "NULL"; // default

    if($type == "image"){
        $file = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "uploads/".$file);
    }

    if($type == "video"){
        $file = $_FILES['video']['name'];
        $tmp = $_FILES['video']['tmp_name'];
        move_uploaded_file($tmp, "uploads/".$file);
        $duration = $_POST['duration'];  // from JS
    }

    // ✅ Insert with status default = 1 (active)
    mysqli_query($conn, "
        INSERT INTO herosection (type, file_path, duration, status) 
        VALUES ('$type', '$file', '$duration', 1)
    ");

    echo "<script>alert('Hero Slide Added!');window.location='herosection.php';</script>";
}


// ✅ DELETE
if(isset($_GET['action']) && $_GET['action'] == "delete"){
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM herosection WHERE id=$id");
    echo "<script>alert('Deleted Successfully');window.location='herosection.php';</script>";
}


// ✅ DEACTIVATE
if(isset($_GET['action']) && $_GET['action'] == "deactivate"){
    $id = intval($_GET['id']);
    mysqli_query($conn, "UPDATE herosection SET status=0 WHERE id=$id");
    echo "<script>alert('Deactivated!');window.location='herosection.php';</script>";
}


// ✅ ACTIVATE
if(isset($_GET['action']) && $_GET['action'] == "activate"){
    $id = intval($_GET['id']);
    mysqli_query($conn, "UPDATE herosection SET status=1 WHERE id=$id");
    echo "<script>alert('Activated!');window.location='herosection.php';</script>";
}
?>


<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Section Management - College Portal</title>
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

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-header h2 {
            color: #1e3c72;
            font-size: 20px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }

        .hero-item {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            position: relative;
        }

        .hero-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .hero-preview {
            width: 100%;
            height: 200px;
            background: #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        .hero-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-preview video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-type-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.9);
        }

        .badge-image {
            color: #2196F3;
        }

        .badge-video {
            color: #f44336;
        }

        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-active {
            background: rgba(76, 175, 80, 0.9);
            color: white;
        }

        .badge-inactive {
            background: rgba(158, 158, 158, 0.9);
            color: white;
        }

        .video-duration {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            background: rgba(0, 0, 0, 0.7);
            color: white;
        }

        .hero-info {
            padding: 20px;
        }

        .hero-info h3 {
            color: #333;
            margin-bottom: 8px;
            font-size: 18px;
        }

        .hero-info p {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .hero-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn-small {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-toggle {
            background: #e3f2fd;
            color: #2196F3;
        }

        .btn-toggle:hover {
            background: #2196F3;
            color: white;
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
            min-height: 100px;
        }

        .type-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .type-option {
            padding: 20px;
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
            font-size: 32px;
            margin-bottom: 10px;
            color: #667eea;
        }

        .type-option h4 {
            color: #333;
            margin-bottom: 5px;
        }

        .type-option p {
            color: #666;
            font-size: 13px;
        }

        .upload-area {
            border: 2px dashed #e0e0e0;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-area:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .upload-area i {
            font-size: 48px;
            color: #667eea;
            margin-bottom: 15px;
        }

        .upload-area input[type="file"] {
            display: none;
        }

        .preview-container {
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
            max-height: 300px;
        }

        .preview-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        .preview-container video {
            width: 100%;
            height: auto;
            display: block;
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

        .help-text {
            font-size: 13px;
            color: #999;
            margin-top: 5px;
        }

        .warning-text {
            font-size: 13px;
            color: #f44336;
            margin-top: 5px;
            font-weight: 600;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-warning {
            background: #fff3e0;
            color: #e65100;
            border: 1px solid #ffb74d;
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

            .hero-grid {
                grid-template-columns: 1fr;
            }

            .type-selector {
                grid-template-columns: 1fr;
            }
        }
        .hero-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .hero-item {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #eee;
            transition: 0.3s;
            position: relative;
        }

        .hero-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        }

        .hero-item img,
        .hero-item video {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .type-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff5722;
            color: #fff;
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: bold;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            padding: 12px;
            border-top: 1px solid #eee;
        }

        .actions a {
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .active-btn {
            background: #28a745;
            color: #fff;
        }

        .active-btn:hover {
            background: #1f7e34;
        }

        .deactive-btn {
            background: #ffc107;
            color: #000;
        }

        .deactive-btn:hover {
            background: #d09b00;
        }

        .delete-btn {
            background: #dc3545;
            color: #fff;
        }

        .delete-btn:hover {
            background: #b52a34;
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
                <a href="herosection.php" class="nav-link active">
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
                <h1>Hero Section Management</h1>
                <div class="breadcrumb">
                    <a href="#">Home</a> / <span>Hero Section</span>
                </div>
            </div>
            <button class="btn btn-primary" onclick="openModal()">
                <i class="fas fa-plus"></i>
                Add Hero Slide
            </button>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Homepage Hero Slides</h2>
                <span style="color: #666; font-size: 14px;">Manage images and videos for homepage carousel</span>
            </div>

            <?php
            include "db.php";
            $slides = mysqli_query($conn, "SELECT * FROM herosection ORDER BY id DESC");
            ?>

            <div class="hero-grid">
            <?php while($h = mysqli_fetch_assoc($slides)){ ?>
                <div class="hero-item">

                    <?php if($h['type'] == 'image'){ ?>
                        <img src="uploads/<?php echo $h['file_path']; ?>">
                    <?php } else { ?>
                        <video src="uploads/<?php echo $h['file_path']; ?>" autoplay loop muted></video>
                        <span class="type-badge">Video (<?php echo $h['duration']; ?>s)</span>
                    <?php } ?>

                    <div class="actions">
                <?php if($h['status'] == 1){ ?>
                    <a href="herosection.php?action=deactivate&id=<?php echo $h['id']; ?>" class="deactive-btn">
                        <i class="fa fa-ban"></i> Deactivate
                    </a>
                <?php } else { ?>
                    <a href="herosection.php?action=activate&id=<?php echo $h['id']; ?>" class="active-btn">
                        <i class="fa fa-check"></i> Activate
                    </a>
                <?php } ?>

                <a href="herosection.php?action=delete&id=<?php echo $h['id']; ?>" 
                onclick="return confirm('Delete this slide?')" class="delete-btn">
                    <i class="fa fa-trash"></i> Delete
                </a>
            </div>


        </div>
        <?php } ?>
        </div>


        </div>
    </div>

    <!-- Add/Edit Hero Modal -->
    <div class="modal" id="heroModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add Hero Slide</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
        <form id="heroForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="save" value="1">
            <input type="hidden" name="type" id="typeValue">
            <input type="hidden" name="duration" id="durationField">


            <div class="form-group">
                <label>Select Type *</label>
                <div class="type-selector">
                    <div class="type-option active" onclick="selectType('image', event)">
                        <i class="fas fa-image"></i>
                        <h4>Image</h4>
                        <p>Upload an image</p>
                    </div>
                    <div class="type-option" onclick="selectType('video', event)">
                        <i class="fas fa-video"></i>
                        <h4>Video</h4>
                        <p>Upload video (15s max)</p>
                    </div>
                </div>
            </div>

            <!-- Image Upload Section -->
            <div class="form-group" id="imageSection">
                <label>Upload Image *</label>
                <div class="upload-area" onclick="document.getElementById('imageUpload').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <h4>Click to upload image</h4>
                    <p class="help-text">Recommended size: 1920x800px (PNG, JPG)</p>
                </div>
                <input type="file" name="image" id="imageUpload" accept="image/*" onchange="previewImage(event)">
                <div id="imagePreview" class="preview-container" style="display: none;"></div>
            </div>

            <!-- Video Upload Section -->
            <div class="form-group" id="videoSection" style="display: none;">
                <label>Upload Video *</label>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Video must be 15 seconds or less. Longer videos will be rejected.</span>
                </div>
                <div class="upload-area" onclick="document.getElementById('videoUpload').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <h4>Click to upload video</h4>
                    <p class="help-text">Max duration: 15 seconds (MP4, WebM, max 50MB)</p>
                </div>
                <input type="file" name="video" id="videoUpload" accept="video/mp4,video/webm" onchange="previewVideo(event)">
                <div id="videoPreview" class="preview-container" style="display: none;"></div>
                <p id="videoDuration" class="warning-text" style="display: none;"></p>
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 25px;">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn btn-success" id="submitBtn">
                    <i class="fas fa-save"></i> Save Hero Slide
                </button>
            </div>
        </form>

        </div>
    </div>

  <script>
    // Select type (image or video)
    function selectType(type, event) {
        document.getElementById("typeValue").value = type;

        document.querySelectorAll('.type-option').forEach(opt => opt.classList.remove('active'));
        event?.target.closest('.type-option').classList.add('active');

        document.getElementById("imageSection").style.display = (type === "image") ? "block" : "none";
        document.getElementById("videoSection").style.display = (type === "video") ? "block" : "none";
    }

    // Preview uploaded image
    function previewImage(event) {
        let file = event.target.files[0];
        if (!file) return;

        let reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById("imagePreview");
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }

    // Preview video & check duration
    function previewVideo(event) {
        let file = event.target.files[0];
        if (!file) return;

        // Check size limit (50MB)
        if (file.size > 50 * 1024 * 1024) {
            alert("Video must be under 50MB!");
            event.target.value = "";
            return;
        }

        let video = document.createElement("video");
        video.src = URL.createObjectURL(file);

        video.onloadedmetadata = function() {
            let duration = Math.round(video.duration);
            let durationText = document.getElementById("videoDuration");
            let submitBtn = document.getElementById("submitBtn");

            if (duration > 15) {
                durationText.textContent = `⚠ Video is ${duration}s (Max allowed: 15s)`;
                durationText.style.display = "block";
                submitBtn.disabled = true;
            } else {
                durationText.textContent = `✓ ${duration}s valid`;
                durationText.style.display = "block";
                submitBtn.disabled = false;
                document.getElementById("durationField").value = duration;

                document.getElementById("videoPreview").innerHTML =
                    `<video src="${video.src}" controls></video>`;
                document.getElementById("videoPreview").style.display = "block";
            }
        };
    }

    // Open modal
    function openModal() {
        document.getElementById('heroModal').classList.add('active');
        document.getElementById('modalTitle').textContent = 'Add Hero Slide';
        document.getElementById('heroForm').reset();
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('videoPreview').style.display = 'none';
        document.getElementById('videoDuration').style.display = 'none';
        document.getElementById('submitBtn').disabled = false;

        selectType('image');
    }

    // Close modal
    function closeModal() {
        document.getElementById('heroModal').classList.remove('active');
    }

    // Allow closing modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('heroModal');
        if (event.target === modal) closeModal();
    }
</script>

</body>
</html>