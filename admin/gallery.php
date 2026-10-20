<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include 'db.php';

// ✅ ADD CATEGORY
if (isset($_POST['action']) && $_POST['action'] === "add_category") {
    $category = $_POST['category_name'];
    $stmt = $conn->prepare("INSERT INTO `gallery_categories` (`category_name`) VALUES (?)");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    echo "<script>alert('Category added successfully!'); window.location.href='gallery.php';</script>";
    exit;
}

// ✅ EDIT CATEGORY
if (isset($_POST['action']) && $_POST['action'] === "edit_category") {
    $id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $stmt = $conn->prepare("UPDATE `gallery_categories` SET `category_name`=? WHERE `id`=?");
    $stmt->bind_param("si", $category_name, $id);
    $stmt->execute();
    echo "<script>alert('Category updated successfully!'); window.location.href='gallery.php';</script>";
    exit;
}

// ✅ ADD IMAGE
if (isset($_POST['action']) && $_POST['action'] === "add_image") {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'] ?? '';

    $image = $_FILES['gallery_image']['name'];
    $target_dir = "uploads/gallery/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['gallery_image']['tmp_name'], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO `gallery_images` (`title`, `category_id`, `description`, `image_path`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $title, $category_id, $description, $target_file);
        $stmt->execute();
        echo "<script>alert('Image added successfully!'); window.location.href='gallery.php';</script>";
        exit;
    }
}

// ✅ EDIT IMAGE
if (isset($_POST['action']) && $_POST['action'] === "edit_image") {
    $id = $_POST['image_id'];
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'] ?? '';

    if (!empty($_FILES['gallery_image']['name'])) {
        $image = $_FILES['gallery_image']['name'];
        $target_dir = "uploads/gallery/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $target_file = $target_dir . basename($image);
        if (move_uploaded_file($_FILES['gallery_image']['tmp_name'], $target_file)) {
            $stmt = $conn->prepare("UPDATE `gallery_images` SET `title`=?, `category_id`=?, `description`=?, `image_path`=? WHERE `id`=?");
            $stmt->bind_param("sissi", $title, $category_id, $description, $target_file, $id);
        }
    } else {
        $stmt = $conn->prepare("UPDATE `gallery_images` SET `title`=?, `category_id`=?, `description`=? WHERE `id`=?");
        $stmt->bind_param("sisi", $title, $category_id, $description, $id);
    }
    
    if (isset($stmt) && $stmt->execute()) {
        echo "<script>alert('Image updated successfully!'); window.location.href='gallery.php';</script>";
    } else {
        echo "<script>alert('Failed to update image.');</script>";
    }
    exit;
}

// ✅ DELETE CATEGORY
if (isset($_POST['action']) && $_POST['action'] === "delete_category") {
    $id = $_POST['category_id'];
    $conn->query("DELETE FROM `gallery_images` WHERE category_id='$id'");
    $conn->query("DELETE FROM `gallery_categories` WHERE id='$id'");
    echo "<script>window.location.href='gallery.php';</script>";
    exit;
}

// ✅ DELETE IMAGE
if (isset($_POST['action']) && $_POST['action'] === "delete_image") {
    $id = $_POST['image_id'];
    $query = "DELETE FROM `gallery_images` WHERE id='$id'";
    mysqli_query($conn, $query);
    echo "<script>window.location.href='gallery.php';</script>";
    exit;
}

// ✅ FETCH DATA
$categories = $conn->query("SELECT * FROM `gallery_categories`");
$images = $conn->query("SELECT gi.*, gc.category_name FROM `gallery_images` gi LEFT JOIN `gallery_categories` gc ON gi.category_id = gc.id ORDER BY gi.created_at DESC");
$total_images = $conn->query("SELECT COUNT(*) as total FROM `gallery_images`")->fetch_assoc()['total'];
$total_categories = $conn->query("SELECT COUNT(*) as total FROM `gallery_categories`")->fetch_assoc()['total'];
?>


<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Management - College Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
        .icon-green { background: #e8f5e9; color: #4CAF50; }
        .icon-purple { background: #f3e5f5; color: #9c27b0; }

        .stat-info h3 {
            font-size: 24px;
            color: #1e3c72;
            margin-bottom: 3px;
        }

        .stat-info p {
            color: #666;
            font-size: 13px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .btn-custom {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .gallery-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            position: relative;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .gallery-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .gallery-info {
            padding: 15px;
        }

        .gallery-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e3c72;
            margin-bottom: 5px;
        }

        .gallery-category {
            display: inline-block;
            padding: 4px 10px;
            background: #e3f2fd;
            color: #2196F3;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .gallery-actions {
            display: flex;
            gap: 8px;
            padding: 10px 15px;
            border-top: 1px solid #f0f0f0;
        }

        .btn-sm-custom {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-edit-custom {
            background: #fff3e0;
            color: #FF9800;
        }

        .btn-edit-custom:hover {
            background: #FF9800;
            color: white;
        }

        .btn-delete-custom {
            background: #ffebee;
            color: #f44336;
        }

        .btn-delete-custom:hover {
            background: #f44336;
            color: white;
        }

        .category-badge {
            display: inline-block;
            padding: 8px 16px;
            background: white;
            border-radius: 20px;
            margin: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            position: relative;
        }

        .category-badge .delete-cat {
            margin-left: 10px;
            color: #f44336;
            cursor: pointer;
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

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
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
                <a href="gallery.php" class="nav-link active">
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
                <h1>Gallery Management</h1>
                <div class="breadcrumb">
                    <a href="#">Home</a> / <span>Gallery</span>
                </div>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-icon icon-blue">
                    <i class="fas fa-images"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $total_images ?></h3>
                    <p>Total Images</p>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon icon-green">
                    <i class="fas fa-folder"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $total_categories ?></h3>
                    <p>Categories</p>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <button class="btn-custom btn-primary-custom" data-toggle="modal" data-target="#addCategoryModal">
                <i class="fas fa-folder-plus"></i> Add Category
            </button>
            <button class="btn-custom btn-success-custom" data-toggle="modal" data-target="#addImageModal">
                <i class="fas fa-plus"></i> Add Image
            </button>
        </div>

        <!-- Categories Display -->
        <div style="background: white; padding: 20px; border-radius: 10px; margin-bottom: 30px;">
            <h5 style="margin-bottom: 15px; color: #1e3c72;">Categories</h5>
            <?php 
            $categories_display = $conn->query("SELECT * FROM `gallery_categories`");
            while($cat = $categories_display->fetch_assoc()): ?>
                <span class="category-badge">
                    <?= htmlspecialchars($cat['category_name']) ?>
                    
                    <a href="#" class="edit-cat" style="margin-left: 10px; color: #FF9800;" data-toggle="modal" data-target="#editCategoryModal" data-id="<?= $cat['id'] ?>" data-name="<?= htmlspecialchars($cat['category_name']) ?>">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this category and all its images?');">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="category_id" value="<?= $cat['id'] ?>">
                        <button type="submit" class="delete-cat" style="border:none; background:none; margin-left: 5px;">
                            <i class="fas fa-times"></i>
                        </button>
                    </form>
                </span>
            <?php endwhile; ?>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid">
            <?php while($img = $images->fetch_assoc()): ?>
                <div class="gallery-card">
                    <img src="<?= htmlspecialchars($img['image_path']) ?>" alt="<?= htmlspecialchars($img['title']) ?>" class="gallery-image">
                    <div class="gallery-info">
                        <h6 class="gallery-title"><?= htmlspecialchars($img['title']) ?></h6>
                        <span class="gallery-category"><?= htmlspecialchars($img['category_name']) ?></span>
                        <?php if(!empty($img['description'])): ?>
                            <p style="font-size: 13px; color: #666; margin: 0;"><?= htmlspecialchars($img['description']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="gallery-actions">
                        <button type="button" class="btn-sm-custom btn-edit-custom" data-toggle="modal" data-target="#editImageModal" 
                                data-id="<?= $img['id'] ?>" 
                                data-title="<?= htmlspecialchars($img['title']) ?>"
                                data-category="<?= $img['category_id'] ?>"
                                data-desc="<?= htmlspecialchars($img['description']) ?>"
                                style="flex: 1; margin-right: 5px;">
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <form method="POST" onsubmit="return confirm('Delete this image?');" style="flex: 1;">
                            <input type="hidden" name="action" value="delete_image">
                            <input type="hidden" name="image_id" value="<?= $img['id'] ?>">
                            <button type="submit" class="btn-sm-custom btn-delete-custom" style="width: 100%;">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST">
                    <input type="hidden" name="action" value="add_category">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Category</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="category_name" placeholder="e.g., Events, Sports, Cultural" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Image Modal -->
    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add_image">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Image</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Image Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter image title" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id" required>
                                <option value="">Select Category</option>
                                <?php 
                                $categories_modal = $conn->query("SELECT * FROM `gallery_categories`");
                                while($cat = $categories_modal->fetch_assoc()): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description (Optional)</label>
                            <textarea class="form-control" name="description" rows="2" placeholder="Enter image description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Select Image</label>
                            <input type="file" class="form-control-file" name="gallery_image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST">
                    <input type="hidden" name="action" value="edit_category">
                    <input type="hidden" name="category_id" id="edit_category_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="category_name" id="edit_category_name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Image Modal -->
    <div class="modal fade" id="editImageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit_image">
                    <input type="hidden" name="image_id" id="edit_image_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Image</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Image Title</label>
                            <input type="text" class="form-control" name="title" id="edit_image_title" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id" id="edit_image_category" required>
                                <option value="">Select Category</option>
                                <?php 
                                $categories_modal = $conn->query("SELECT * FROM `gallery_categories`");
                                while($cat = $categories_modal->fetch_assoc()): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description (Optional)</label>
                            <textarea class="form-control" name="description" id="edit_image_description" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Replace Image (Leave blank to keep current)</label>
                            <input type="file" class="form-control-file" name="gallery_image" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Populate Edit Category Modal
            $('.edit-cat').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                $('#edit_category_id').val(id);
                $('#edit_category_name').val(name);
            });

            // Populate Edit Image Modal
            $('.btn-edit-custom').on('click', function() {
                var id = $(this).data('id');
                var title = $(this).data('title');
                var category = $(this).data('category');
                var desc = $(this).data('desc');

                $('#edit_image_id').val(id);
                $('#edit_image_title').val(title);
                $('#edit_image_category').val(category);
                $('#edit_image_description').val(desc);
            });
        });
    </script>
</body>
</html>