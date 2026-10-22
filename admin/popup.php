<?php
require_once __DIR__ . '/auth.php';
include "db.php";

$message = '';
$messageType = '';

// Handle Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    // Upload new popup image
    if ($_POST['action'] === 'upload') {
        if (isset($_FILES['popup_image']) && $_FILES['popup_image']['error'] === 0) {
            $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileType = $_FILES['popup_image']['type'];

            if (in_array($fileType, $allowed)) {
                $ext = pathinfo($_FILES['popup_image']['name'], PATHINFO_EXTENSION);
                $filename = 'popup_' . time() . '.' . $ext;
                $uploadPath = 'uploads/' . $filename;

                if (move_uploaded_file($_FILES['popup_image']['tmp_name'], $uploadPath)) {
                    // Deactivate all existing popups
                    mysqli_query($conn, "UPDATE popup_banner SET active = 0");

                    // Insert new popup
                    $link = mysqli_real_escape_string($conn, $_POST['popup_link'] ?? '');
                    $stmt = mysqli_prepare($conn, "INSERT INTO popup_banner (image, link, active) VALUES (?, ?, 1)");
                    mysqli_stmt_bind_param($stmt, 'ss', $filename, $link);
                    mysqli_stmt_execute($stmt);

                    $message = 'Popup image uploaded successfully!';
                    $messageType = 'success';
                } else {
                    $message = 'Failed to upload image. Check folder permissions.';
                    $messageType = 'error';
                }
            } else {
                $message = 'Invalid file type. Only JPG, PNG, GIF, WEBP allowed.';
                $messageType = 'error';
            }
        } else {
            $message = 'Please select an image to upload.';
            $messageType = 'error';
        }
    }

    // Toggle active/inactive
    if ($_POST['action'] === 'toggle') {
        $id = (int)$_POST['id'];
        $current = (int)$_POST['current'];
        $newStatus = $current ? 0 : 1;

        if ($newStatus === 1) {
            // Deactivate all first
            mysqli_query($conn, "UPDATE popup_banner SET active = 0");
        }
        mysqli_query($conn, "UPDATE popup_banner SET active = $newStatus WHERE id = $id");

        $message = $newStatus ? 'Popup activated!' : 'Popup deactivated!';
        $messageType = 'success';
    }

    // Delete
    if ($_POST['action'] === 'delete') {
        $id = (int)$_POST['id'];
        $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM popup_banner WHERE id = $id"));
        if ($row) {
            $imgPath = 'uploads/' . $row['image'];
            if (file_exists($imgPath)) unlink($imgPath);
            mysqli_query($conn, "DELETE FROM popup_banner WHERE id = $id");
            $message = 'Popup deleted successfully!';
            $messageType = 'success';
        }
    }
}

// Fetch all popups
$popups = [];
$result = mysqli_query($conn, "SELECT * FROM popup_banner ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($result)) {
    $popups[] = $row;
}

$activePopup = null;
foreach ($popups as $p) {
    if ($p['active']) { $activePopup = $p; break; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Banner Management - College Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; color: #333; }

        /* ── Sidebar (same as admission.php) ── */
        .sidebar {
            position: fixed; left: 0; top: 0; width: 260px; height: 100vh;
            background: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%);
            padding: 20px 0; overflow-y: auto; z-index: 1000;
        }
        .logo { text-align: center; padding: 20px; color: white; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
        .logo i { font-size: 40px; margin-bottom: 10px; }
        .logo h2 { font-size: 20px; font-weight: 600; }
        .nav-menu { list-style: none; padding: 0 15px; }
        .nav-item { margin-bottom: 5px; }
        .nav-link {
            display: flex; align-items: center; padding: 12px 15px;
            color: rgba(255,255,255,0.8); text-decoration: none;
            border-radius: 8px; transition: all 0.3s;
        }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.15); color: white; }
        .nav-link i { margin-right: 12px; width: 20px; text-align: center; }

        /* ── Main ── */
        .main-content { margin-left: 260px; padding: 20px; }
        .top-bar {
            background: white; padding: 20px 30px; border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;
        }
        .page-title h1 { font-size: 28px; color: #1e3c72; margin-bottom: 5px; }
        .breadcrumb { color: #666; font-size: 14px; }
        .breadcrumb a { color: #2196F3; text-decoration: none; }
        .avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;
        }
        .user-info { display: flex; align-items: center; gap: 15px; }

        /* ── Alert ── */
        .alert {
            padding: 14px 20px; border-radius: 8px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px; font-weight: 500;
        }
        .alert-success { background: #e8f5e9; color: #2e7d32; border-left: 4px solid #4caf50; }
        .alert-error   { background: #ffebee; color: #c62828; border-left: 4px solid #f44336; }

        /* ── Cards ── */
        .card {
            background: white; border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07); margin-bottom: 30px; overflow: hidden;
        }
        .card-header {
            padding: 20px 25px; border-bottom: 1px solid #f0f0f0;
            display: flex; align-items: center; gap: 10px;
        }
        .card-header h2 { font-size: 18px; color: #1e3c72; }
        .card-header .badge {
            background: #e3f2fd; color: #1565c0; font-size: 12px;
            padding: 3px 10px; border-radius: 20px; font-weight: 600;
        }
        .card-body { padding: 25px; }

        /* ── Upload Form ── */
        .upload-zone {
            border: 2px dashed #c5cae9; border-radius: 12px;
            padding: 40px; text-align: center; cursor: pointer;
            transition: all 0.3s; background: #fafbff;
        }
        .upload-zone:hover { border-color: #3f51b5; background: #f0f4ff; }
        .upload-zone i { font-size: 48px; color: #7986cb; margin-bottom: 12px; }
        .upload-zone p { color: #666; margin-bottom: 5px; }
        .upload-zone small { color: #999; }
        #imagePreview {
            margin-top: 15px; display: none;
        }
        #imagePreview img {
            max-width: 100%; max-height: 220px; border-radius: 8px;
            border: 2px solid #e0e0e0; object-fit: contain;
        }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 7px; color: #444; font-size: 14px; }
        .form-control {
            width: 100%; padding: 11px 14px; border: 1px solid #ddd;
            border-radius: 8px; font-size: 14px; outline: none; transition: border 0.2s;
        }
        .form-control:focus { border-color: #3f51b5; }
        .btn {
            padding: 11px 24px; border: none; border-radius: 8px;
            cursor: pointer; font-size: 14px; font-weight: 600; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-primary { background: #1e3c72; color: white; }
        .btn-primary:hover { background: #2a5298; }
        .btn-danger  { background: #f44336; color: white; }
        .btn-danger:hover { background: #d32f2f; }
        .btn-success { background: #4caf50; color: white; }
        .btn-success:hover { background: #388e3c; }
        .btn-warning { background: #ff9800; color: white; }
        .btn-warning:hover { background: #f57c00; }
        .btn-sm { padding: 7px 14px; font-size: 13px; }

        /* ── Active Preview ── */
        .active-preview {
            display: flex; gap: 20px; align-items: flex-start; flex-wrap: wrap;
        }
        .active-preview img {
            width: 220px; height: 160px; object-fit: cover;
            border-radius: 10px; border: 3px solid #4caf50;
            box-shadow: 0 4px 15px rgba(76,175,80,0.3);
        }
        .active-info { flex: 1; min-width: 200px; }
        .active-info .status-badge {
            display: inline-block; background: #e8f5e9; color: #2e7d32;
            padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; margin-bottom: 12px;
        }
        .active-info p { color: #666; font-size: 14px; margin-bottom: 6px; }
        .active-info strong { color: #333; }

        /* ── Table ── */
        .table-container { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        thead th {
            background: #f8f9ff; padding: 12px 15px; text-align: left;
            color: #1e3c72; font-weight: 600; border-bottom: 2px solid #e8eaf6;
        }
        tbody td { padding: 12px 15px; border-bottom: 1px solid #f5f5f5; vertical-align: middle; }
        tbody tr:hover { background: #fafbff; }
        .thumb { width: 80px; height: 55px; object-fit: cover; border-radius: 6px; border: 1px solid #eee; }
        .status-on  { background: #e8f5e9; color: #2e7d32; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-off { background: #fafafa; color: #999;    padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .actions { display: flex; gap: 8px; }

        /* ── Empty state ── */
        .empty { text-align: center; padding: 50px 20px; color: #aaa; }
        .empty i { font-size: 50px; margin-bottom: 12px; color: #ddd; }
        .empty p { font-size: 16px; }

        /* ── Popup Preview Modal ── */
        .preview-modal {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.7); z-index: 9999;
            align-items: center; justify-content: center;
        }
        .preview-modal.show { display: flex; }
        .preview-modal img { max-width: 90vw; max-height: 85vh; border-radius: 10px; object-fit: contain; }
        .preview-close {
            position: absolute; top: 20px; right: 30px;
            color: white; font-size: 36px; cursor: pointer; line-height: 1;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <i class="fas fa-graduation-cap"></i>
        <h2>College Portal</h2>
    </div>
    <ul class="nav-menu">
        <li class="nav-item"><a href="faculty.php" class="nav-link"><i class="fas fa-chalkboard-teacher"></i><span>Faculty</span></a></li>
        <li class="nav-item"><a href="herosection.php" class="nav-link"><i class="fas fa-image"></i><span>Hero Section</span></a></li>
        <li class="nav-item"><a href="news&update.php" class="nav-link"><i class="fas fa-newspaper"></i><span>News & Updates</span></a></li>
        <li class="nav-item"><a href="admission.php" class="nav-link"><i class="fas fa-user-plus"></i><span>Admission</span></a></li>
        <li class="nav-item"><a href="gallery.php" class="nav-link"><i class="fas fa-images"></i><span>Gallery</span></a></li>
        <li class="nav-item"><a href="manage_users.php" class="nav-link"><i class="fas fa-users-cog"></i><span>Manage Users</span></a></li>
        <li class="nav-item"><a href="feedback_management.php" class="nav-link"><i class="fas fa-comments"></i><span>Feedback</span></a></li>
        <li class="nav-item"><a href="popup.php" class="nav-link active"><i class="fas fa-window-restore"></i><span>Popup Banner</span></a></li>
    </ul>
</div>

<!-- Main -->
<div class="main-content">
    <div class="top-bar">
        <div class="page-title">
            <h1>Popup Banner</h1>
            <div class="breadcrumb"><a href="#">Home</a> / <span>Popup Banner Management</span></div>
        </div>
        <div class="user-info">
            <div class="avatar">AD</div>
            <div><strong>Admin User</strong></div>
        </div>
    </div>

    <?php if ($message): ?>
    <div class="alert alert-<?= $messageType ?>">
        <i class="fas fa-<?= $messageType === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i>
        <?= htmlspecialchars($message) ?>
    </div>
    <?php endif; ?>

    <!-- Active Popup Preview -->
    <?php if ($activePopup): ?>
    <div class="card">
        <div class="card-header">
            <i class="fas fa-eye" style="color:#4caf50"></i>
            <h2>Currently Active Popup</h2>
            <span class="badge">LIVE</span>
        </div>
        <div class="card-body">
            <div class="active-preview">
                <img src="uploads/<?= htmlspecialchars($activePopup['image']) ?>"
                     alt="Active Popup"
                     onclick="previewImage('uploads/<?= htmlspecialchars($activePopup['image']) ?>')"
                     style="cursor:zoom-in;" title="Click to preview">
                <div class="active-info">
                    <span class="status-badge"><i class="fas fa-circle" style="font-size:8px"></i> Active</span>
                    <p><strong>Image:</strong> <?= htmlspecialchars($activePopup['image']) ?></p>
                    <?php if ($activePopup['link']): ?>
                    <p><strong>Link:</strong> <a href="<?= htmlspecialchars($activePopup['link']) ?>" target="_blank"><?= htmlspecialchars($activePopup['link']) ?></a></p>
                    <?php endif; ?>
                    <p><strong>Added:</strong> <?= date('d M Y, h:i A', strtotime($activePopup['created_at'])) ?></p>
                    <p style="margin-top:10px;color:#888;font-size:13px;"><i class="fas fa-info-circle"></i> This popup appears on the website homepage after 5 seconds.</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Upload Form -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-upload" style="color:#1e3c72"></i>
            <h2>Upload New Popup Image</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" id="uploadForm">
                <input type="hidden" name="action" value="upload">

                <div class="form-group">
                    <label>Popup Image <span style="color:red">*</span></label>
                    <div class="upload-zone" onclick="document.getElementById('popup_image').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to browse or drag & drop image here</p>
                        <small>Supported: JPG, PNG, GIF, WEBP &nbsp;|&nbsp; Recommended: 600×400 px or larger</small>
                        <div id="imagePreview">
                            <img id="previewImg" src="" alt="Preview">
                        </div>
                    </div>
                    <input type="file" id="popup_image" name="popup_image" accept="image/*" style="display:none" onchange="showPreview(this)">
                </div>

                <div class="form-group">
                    <label>Popup Link (optional)</label>
                    <input type="url" name="popup_link" class="form-control" placeholder="https://example.com/admission">
                    <small style="color:#999">If set, clicking the popup image will open this URL.</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Upload & Activate Popup
                </button>
            </form>
        </div>
    </div>

    <!-- All Popups Table -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-list" style="color:#1e3c72"></i>
            <h2>All Popup Images</h2>
            <span class="badge"><?= count($popups) ?> total</span>
        </div>
        <div class="table-container">
            <?php if (empty($popups)): ?>
            <div class="empty">
                <i class="fas fa-images"></i>
                <p>No popup images uploaded yet.</p>
            </div>
            <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Preview</th>
                        <th>Filename</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($popups as $i => $p): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td>
                            <img src="uploads/<?= htmlspecialchars($p['image']) ?>"
                                 class="thumb" alt="Popup"
                                 onclick="previewImage('uploads/<?= htmlspecialchars($p['image']) ?>')"
                                 style="cursor:zoom-in;" title="Click to zoom">
                        </td>
                        <td><?= htmlspecialchars($p['image']) ?></td>
                        <td>
                            <?php if ($p['link']): ?>
                                <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank" style="color:#2196F3;font-size:13px;">
                                    <?= strlen($p['link']) > 35 ? substr($p['link'], 0, 35) . '…' : $p['link'] ?>
                                </a>
                            <?php else: ?>
                                <span style="color:#bbb;font-size:13px;">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($p['active']): ?>
                                <span class="status-on"><i class="fas fa-circle" style="font-size:8px"></i> Active</span>
                            <?php else: ?>
                                <span class="status-off">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td style="font-size:13px;color:#666;"><?= date('d M Y', strtotime($p['created_at'])) ?></td>
                        <td>
                            <div class="actions">
                                <!-- Toggle -->
                                <form method="POST" style="margin:0">
                                    <input type="hidden" name="action" value="toggle">
                                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                    <input type="hidden" name="current" value="<?= $p['active'] ?>">
                                    <button type="submit" class="btn btn-sm <?= $p['active'] ? 'btn-warning' : 'btn-success' ?>" title="<?= $p['active'] ? 'Deactivate' : 'Activate' ?>">
                                        <i class="fas fa-<?= $p['active'] ? 'toggle-off' : 'toggle-on' ?>"></i>
                                        <?= $p['active'] ? 'Deactivate' : 'Activate' ?>
                                    </button>
                                </form>
                                <!-- Delete -->
                                <form method="POST" style="margin:0" onsubmit="return confirm('Delete this popup image?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="preview-modal" id="previewModal" onclick="closePreview()">
    <span class="preview-close" onclick="closePreview()">&times;</span>
    <img id="previewModalImg" src="" alt="Preview">
</div>

<script>
    // Show image preview before upload
    function showPreview(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Drag & drop support
    const zone = document.querySelector('.upload-zone');
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.style.borderColor = '#3f51b5'; });
    zone.addEventListener('dragleave', ()  => { zone.style.borderColor = '#c5cae9'; });
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.style.borderColor = '#c5cae9';
        const input = document.getElementById('popup_image');
        input.files = e.dataTransfer.files;
        showPreview(input);
    });

    // Image zoom preview
    function previewImage(src) {
        document.getElementById('previewModalImg').src = src;
        document.getElementById('previewModal').classList.add('show');
    }
    function closePreview() {
        document.getElementById('previewModal').classList.remove('show');
    }
</script>
</body>
</html>