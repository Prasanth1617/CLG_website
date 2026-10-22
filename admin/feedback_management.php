<?php require_once __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management - College Portal</title>
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
        .icon-purple { background: #f3e5f5; color: #9C27B0; }
        .icon-orange { background: #fff3e0; color: #FF9800; }

        .action-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .tabs {
            display: flex;
            gap: 10px;
        }

        .tab-btn {
            padding: 10px 20px;
            border: none;
            background: #f8f9fa;
            color: #666;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            font-size: 14px;
            cursor: pointer;
        }

        .feedback-table {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .rating-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
        }

        .rating-excellent { background: #e8f5e9; color: #4CAF50; }
        .rating-good { background: #e3f2fd; color: #2196F3; }
        .rating-average { background: #fff3e0; color: #FF9800; }
        .rating-poor { background: #ffebee; color: #f44336; }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending { background: #fff3e0; color: #FF9800; }
        .status-reviewed { background: #e8f5e9; color: #4CAF50; }
        .status-archived { background: #f5f5f5; color: #666; }

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            margin-right: 5px;
            transition: all 0.3s;
        }

        .btn-view {
            background: #e3f2fd;
            color: #2196F3;
        }

        .btn-view:hover {
            background: #2196F3;
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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            position: relative;
            background: white;
            margin: 2% auto;
            padding: 0;
            width: 90%;
            max-width: 900px;
            max-height: 90vh;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s;
            overflow: hidden;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 24px;
            margin: 0;
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 30px;
            max-height: calc(90vh - 180px);
            overflow-y: auto;
        }

        .feedback-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .info-value {
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        .ratings-section {
            margin-bottom: 30px;
        }

        .ratings-section h3 {
            color: #1e3c72;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .rating-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: white;
            border: 2px solid #f0f0f0;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }

        .rating-item:hover {
            border-color: #667eea;
            transform: translateX(5px);
        }

        .question-text {
            flex: 1;
            color: #333;
            font-size: 14px;
            margin-right: 15px;
        }

        .rating-value {
            display: flex;
            gap: 5px;
        }

        .rating-star {
            color: #FFD700;
            font-size: 18px;
        }

        .rating-star.empty {
            color: #e0e0e0;
        }

        .suggestions-section {
            margin-bottom: 20px;
        }

        .suggestions-section h3 {
            color: #1e3c72;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .suggestions-text {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            color: #666;
            line-height: 1.8;
        }

        .modal-footer {
            padding: 20px 30px;
            background: #f8f9fa;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #666;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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

            .modal-content {
                width: 95%;
                margin: 5% auto;
            }

            .feedback-info {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 10px 5px;
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
                <a href="feedback_management.php" class="nav-link active">
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
                <h1>Feedback Management</h1>
                <div class="breadcrumb">
                    <a href="#">Home</a> / <span>Feedback</span>
                </div>
            </div>
        </div>

        <div class="stats-grid" id="statsGrid">
            <!-- Stats will be loaded here -->
        </div>

        <div class="action-bar">
            <div class="tabs">
                <button class="tab-btn active" onclick="switchTab('student')">Student Feedback</button>
                <button class="tab-btn" onclick="switchTab('staff')">Staff Feedback</button>
            </div>
            <select class="filter-select" id="statusFilter" onchange="loadFeedback()">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="reviewed">Reviewed</option>
                <option value="archived">Archived</option>
            </select>
            <select class="filter-select" id="sortFilter" onchange="loadFeedback()">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="highest">Highest Rating</option>
                <option value="lowest">Lowest Rating</option>
            </select>
        </div>

        <div class="feedback-table">
            <table>
                <thead id="tableHead">
                    <!-- Table headers will be loaded here -->
                </thead>
                <tbody id="feedbackTableBody">
                    <!-- Feedback data will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Feedback Detail Modal -->
    <div id="feedbackModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Feedback Details</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Feedback details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal()">Close</button>
                <button class="btn btn-primary" onclick="markAsReviewed()">Mark as Reviewed</button>
            </div>
        </div>
    </div>

    <script>
        let currentTab = 'student';
        let currentFeedbackId = null;

        // Load stats
        function loadStats() {
            fetch(`get_feedback_stats.php?type=${currentTab}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('statsGrid').innerHTML = `
                        <div class="stat-card">
                            <div class="stat-info">
                                <h3>${data.total || 0}</h3>
                                <p>Total Feedback</p>
                            </div>
                            <div class="stat-icon icon-blue">
                                <i class="fas fa-comments"></i>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-info">
                                <h3>${data.pending || 0}</h3>
                                <p>Pending Review</p>
                            </div>
                            <div class="stat-icon icon-orange">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-info">
                                <h3>${data.reviewed || 0}</h3>
                                <p>Reviewed</p>
                            </div>
                            <div class="stat-icon icon-green">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-info">
                                <h3>${data.average_rating || 0}</h3>
                                <p>Average Rating</p>
                            </div>
                            <div class="stat-icon icon-purple">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    `;
                });
        }

        // Switch tab
        function switchTab(tab) {
            currentTab = tab;
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            loadStats();
            loadFeedback();
        }

        // Load feedback
        function loadFeedback() {
            const status = document.getElementById('statusFilter').value;
            const sort = document.getElementById('sortFilter').value;

            fetch(`get_feedback.php?type=${currentTab}&status=${status}&sort=${sort}`)
                .then(response => response.json())
                .then(data => {
                    updateTable(data);
                });
        }

        // Update table
        function updateTable(data) {
            const tableHead = document.getElementById('tableHead');
            const tableBody = document.getElementById('feedbackTableBody');

            if (currentTab === 'student') {
                tableHead.innerHTML = `
                    <tr>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Degree</th>
                        <th>Avg Rating</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                `;
            } else {
                tableHead.innerHTML = `
                    <tr>
                        <th>ID</th>
                        <th>Teacher Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Avg Rating</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                `;
            }

            if (data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="8" style="text-align: center; padding: 40px;">No feedback found</td></tr>';
                return;
            }

            tableBody.innerHTML = data.map(feedback => {
                const ratingClass = feedback.average_rating >= 3.5 ? 'rating-excellent' :
                                  feedback.average_rating >= 2.5 ? 'rating-good' :
                                  feedback.average_rating >= 1.5 ? 'rating-average' : 'rating-poor';

                if (currentTab === 'student') {
                    return `
                        <tr>
                            <td>#${feedback.id}</td>
                            <td>${feedback.student_name}</td>
                            <td>${feedback.degree}</td>
                            <td><span class="rating-badge ${ratingClass}">${feedback.average_rating}/4</span></td>
                            <td>${new Date(feedback.created_at).toLocaleDateString()}</td>
                            <td><span class="status-badge status-${feedback.status}">${feedback.status}</span></td>
                            <td>
                                <button class="action-btn btn-view" onclick="viewFeedback(${feedback.id})">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="action-btn btn-delete" onclick="deleteFeedback(${feedback.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                } else {
                    return `
                        <tr>
                            <td>#${feedback.id}</td>
                            <td>${feedback.teacher_name}</td>
                            <td>${feedback.email}</td>
                            <td>${feedback.designation}</td>
                            <td><span class="rating-badge ${ratingClass}">${feedback.average_rating}/4</span></td>
                            <td>${new Date(feedback.created_at).toLocaleDateString()}</td>
                            <td><span class="status-badge status-${feedback.status}">${feedback.status}</span></td>
                            <td>
                                <button class="action-btn btn-view" onclick="viewFeedback(${feedback.id})">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="action-btn btn-delete" onclick="deleteFeedback(${feedback.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                }
            }).join('');
        }

        // View feedback detail
        function viewFeedback(id) {
            currentFeedbackId = id;
            fetch(`get_feedback_detail.php?type=${currentTab}&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    displayFeedbackDetail(data);
                    document.getElementById('feedbackModal').style.display = 'block';
                });
        }

        // Display feedback detail
        function displayFeedbackDetail(data) {
            const modalBody = document.getElementById('modalBody');
            
            let infoHTML = '';
            let ratingsHTML = '';
            
            if (currentTab === 'student') {
                infoHTML = `
                    <div class="feedback-info">
                        <div class="info-item">
                            <span class="info-label">Student Name</span>
                            <span class="info-value">${data.student_name}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Degree</span>
                            <span class="info-value">${data.degree}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Average Rating</span>
                            <span class="info-value">${data.average_rating}/4</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Submission Date</span>
                            <span class="info-value">${new Date(data.created_at).toLocaleString()}</span>
                        </div>
                    </div>
                `;
                
                const questions = data.questions;
                ratingsHTML = Object.keys(data.ratings).map((key, index) => {
                    const rating = data.ratings[key];
                    const stars = Array(4).fill(0).map((_, i) => 
                        `<i class="fas fa-star rating-star ${i < rating ? '' : 'empty'}"></i>`
                    ).join('');
                    
                    return `
                        <div class="rating-item">
                            <span class="question-text">${index + 1}. ${questions[index]}</span>
                            <div class="rating-value">${stars}</div>
                        </div>
                    `;
                }).join('');
            } else {
                infoHTML = `
                    <div class="feedback-info">
                        <div class="info-item">
                            <span class="info-label">Teacher Name</span>
                            <span class="info-value">${data.teacher_name}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">${data.email}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Designation</span>
                            <span class="info-value">${data.designation}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Average Rating</span>
                            <span class="info-value">${data.average_rating}/4</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Submission Date</span>
                            <span class="info-value">${new Date(data.created_at).toLocaleString()}</span>
                        </div>
                    </div>
                `;
                
                const questions = data.questions;
                ratingsHTML = Object.keys(data.ratings).map((key, index) => {
                    const rating = data.ratings[key];
                    const stars = Array(4).fill(0).map((_, i) => 
                        `<i class="fas fa-star rating-star ${i < rating ? '' : 'empty'}"></i>`
                    ).join('');
                    
                    return `
                        <div class="rating-item">
                            <span class="question-text">${index + 1}. ${questions[index]}</span>
                            <div class="rating-value">${stars}</div>
                        </div>
                    `;
                }).join('');
            }
            
            modalBody.innerHTML = `
                ${infoHTML}
                <div class="ratings-section">
                    <h3>Detailed Ratings</h3>
                    ${ratingsHTML}
                </div>
                ${data.suggestions ? `
                    <div class="suggestions-section">
                        <h3>Suggestions for Improvement</h3>
                        <div class="suggestions-text">${data.suggestions || 'No suggestions provided'}</div>
                    </div>
                ` : ''}
            `;
        }

        // Close modal
        function closeModal() {
            document.getElementById('feedbackModal').style.display = 'none';
            currentFeedbackId = null;
        }

        // Mark as reviewed
        function markAsReviewed() {
            if (!currentFeedbackId) return;
            
            fetch('update_feedback_status.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    type: currentTab,
                    id: currentFeedbackId,
                    status: 'reviewed'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Feedback marked as reviewed');
                    closeModal();
                    loadStats();
                    loadFeedback();
                }
            });
        }

        // Delete feedback
        function deleteFeedback(id) {
            if (!confirm('Are you sure you want to delete this feedback?')) return;
            
            fetch('delete_feedback.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    type: currentTab,
                    id: id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Feedback deleted successfully');
                    loadStats();
                    loadFeedback();
                }
            });
        }

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('feedbackModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Initialize
        loadStats();
        loadFeedback();
    </script>
<body>
</html>