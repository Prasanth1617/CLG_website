<?php
require_once __DIR__ . '/auth.php';
include "db.php";

// 🔹 Change table name here
$query = mysqli_query($conn, "SELECT * FROM adimission ORDER BY id DESC");

$data = [];
while($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo "<script>let applicationsData = ".json_encode($data).";</script>";
?>
<?php
include "db.php";

$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM adimission");
$row = mysqli_fetch_assoc($result);
$totalApplications = $row['total'];
?>



<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Management - College Portal</title>
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-info h3 {
            font-size: 32px;
            color: #1e3c72;
            margin-bottom: 5px;
        }

        .stat-info p {
            color: #666;
            font-size: 14px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .icon-blue { background: #e3f2fd; color: #2196F3; }
        .icon-green { background: #e8f5e9; color: #4CAF50; }
        .icon-orange { background: #fff3e0; color: #FF9800; }
        .icon-red { background: #ffebee; color: #f44336; }

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

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px;
            background: #f8f9fa;
            color: #666;
            font-weight: 600;
            font-size: 13px;
            white-space: nowrap;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending { background: #fff3e0; color: #FF9800; }
        .status-approved { background: #e8f5e9; color: #4CAF50; }
        .status-rejected { background: #ffebee; color: #f44336; }
        .status-reviewing { background: #e3f2fd; color: #2196F3; }

        .btn-small {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s;
            margin-right: 5px;
        }

        .btn-view {
            background: #e3f2fd;
            color: #2196F3;
        }

        .btn-view:hover {
            background: #2196F3;
            color: white;
        }

        .btn-approve {
            background: #e8f5e9;
            color: #4CAF50;
        }

        .btn-approve:hover {
            background: #4CAF50;
            color: white;
        }

        .btn-reject {
            background: #ffebee;
            color: #f44336;
        }

        .btn-reject:hover {
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
            max-width: 800px;
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

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .detail-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .detail-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .detail-value {
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 25px;
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

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 64px;
            color: #e0e0e0;
            margin-bottom: 20px;
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

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
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
                <a href="admission.php" class="nav-link active">
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
                <h1>Admission Management</h1>
                <div class="breadcrumb">
                    <a href="#">Home</a> / <span>Admissions</span>
                </div>
            </div>
            <div class="user-info">
                <div class="avatar">AD</div>
                <div>
                    <strong>Admin User</strong>
                </div>
            </div>
        </div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h3><?php echo $totalApplications; ?></h3>
            <p>Total Applications</p>
        </div>
        <div class="stat-icon icon-blue">
            <i class="fas fa-file-alt"></i>
        </div>
    </div>
</div>


        <div class="action-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search by name, email, or ID..." onkeyup="filterApplications()">
            </div>

            <select class="filter-select" id="courseFilter" onchange="filterApplications()">
                <option value="">All Courses</option>
                <option value="B.A.(TAMIL)">B.A.(TAMIL)</option>
                <option value="B.A.(ENGLISH)">B.A.(ENGLISH)</option>
                <option value="BBA">BBA</option>
                <option value="BCA">BCA</option>
                <option value="B.Sc.(COMPUTER SCIENCE)">B.Sc.(COMPUTER SCIENCE)</option>
                <option value="B.Sc.(INFORMATION TECHNOLOGY)">B.Sc.(INFORMATION TECHNOLOGY)</option>
                <option value="B.Com.(GENERAL)">B.Com.(GENERAL)</option>
                <option value="B.Com.(CA)">B.Com.(CA)</option>
                <option value="B.Com.(Banking)">B.Com.(Banking)</option>
                <option value="B.Com.(PROFESSIONAL ACCOUNTING)">B.Com.(PROFESSIONAL ACCOUNTING)</option>
                <option value="B.Sc.(Physics)">B.Sc.(Physics)</option>
                <option value="B.Sc.(CHEMISTRY)">B.Sc.(CHEMISTRY)</option>
                <option value="B.Sc.(MATHEMATICS)">B.Sc.(MATHEMATICS)</option>
                <option value="B.Sc.(PHYSICAL EDUCATION)">B.Sc.(PHYSICAL EDUCATION)</option>
                <option value="M.A.(TAMIL)">M.A.(TAMIL)</option>
                <option value="M.A.(ENGLISH)">M.A.(ENGLISH)</option>
                <option value="M.COM (COMPUTER APPLICATION)">M.COM (COMPUTER APPLICATION)</option>
                <option value="M.Com">M.Com</option>
                <option value="M.Sc.(Physics)">M.Sc.(Physics)</option>
                <option value="M.Sc.(CHEMISTRY)">M.Sc.(CHEMISTRY)</option>
                <option value="M.Sc.(MATHEMATICS)">M.Sc.(MATHEMATICS)</option>
                <option value="M.Sc.(COMPUTER SCIENCE)">M.Sc.(COMPUTER SCIENCE)</option>
                <!-- Add remaining -->
            </select>

            <button class="btn btn-primary" onclick="exportData()">
                <i class="fas fa-download"></i> Export Data
            </button>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Recent Applications</h2>
            </div>
            <div class="table-container">
                <table id="applicationsTable">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date Of Birth</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Qualification</th>
                            <th>Year of Passing</th>
                            <th>Program Applied</th>
                            <th>Mark</th>
                            <th>Applied Date</th>
                        </tr>
                    </thead>
                    <tbody id="applicationsBody"></tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Application Detail Modal -->
 <div class="modal" id="detailModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Application Details</h2>
            <button class="close-btn" onclick="closeModal()">&times;</button>
        </div>

        <div class="modal-body" id="modalData"></div>
    </div>
</div>

<script>
    function displayApplications(data = applicationsData) {
        const tbody = document.getElementById('applicationsBody');
        
        tbody.innerHTML = data.map(app => `
            <tr>
                <td>${app.name}</td>
                <td>${app.email}</td>
                <td>${app.phone}</td>
                <td>${new Date(app.dob).toLocaleDateString()}</td>
                <td>${app.gender}</td>
                <td>${app.permanent_address}</td>
                <td>${app.qualification}</td>
                <td>${app.year_of_passing || '-'}</td>
                <td>${app.program}</td>
                <td>${app.total_marks || '-'}</td>
                <td>${new Date(app.date).toLocaleDateString()}</td>
            </tr>
        `).join('');
    }

    displayApplications();

    function filterApplications() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const course = document.getElementById('courseFilter').value.toLowerCase();

        let filtered = applicationsData.filter(app =>
            (search === "" ||
                app.name.toLowerCase().includes(search) ||
                app.email.toLowerCase().includes(search) ||
                app.id.toString().includes(search)
            )
            &&
            (course === "" || app.program.toLowerCase() === course)
        );

        displayApplications(filtered);
    }

    
    function viewDetails(id) {
        const app = applicationsData.find(a => a.id == id);
        
        document.getElementById('modalData').innerHTML = `
            <p><strong>Name:</strong> ${app.name}</p>
            <p><strong>Email:</strong> ${app.email}</p>
            <p><strong>Phone:</strong> ${app.phone}</p>
            <p><strong>DOB:</strong> ${app.dob}</p>
            <p><strong>Gender:</strong> ${app.gender}</p>
            <p><strong>Address:</strong> ${app.permanent_address}</p>
            <p><strong>Program:</strong> ${app.program}</p>
            <p><strong>Marks:</strong> ${app.total_marks}</p>
            <p><strong>Applied Date:</strong> ${app.date}</p>
        `;

        document.getElementById('detailModal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('detailModal').classList.remove('active');
    }

    function exportData() {
        const headers = ['Name','Email','Phone','Program','DOB','Gender','Address','Marks','Date'];
        const csvContent = [
            headers.join(','),
            ...applicationsData.map(app => [
                `"${app.name}"`,
                app.email,
                app.phone,
                `"${app.program}"`,
                app.dob,
                app.gender,
                `"${app.address}"`,
                app.total_marks,
                app.appliedDate
            ].join(','))
        ].join('\n');

        const link = document.createElement('a');
        link.href = URL.createObjectURL(new Blob([csvContent], {type:'text/csv'}));
        link.download = `Admissions_${new Date().toISOString().split('T')[0]}.csv`;
        link.click();
    }

    window.onclick = e => {
        if (e.target === document.getElementById('detailModal')) closeModal();
    };
</script>
</body>
</html>