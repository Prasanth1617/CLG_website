<?php
session_start();
include "admin/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email      = trim($_POST['email'] ?? '');
    $password   = trim($_POST['password'] ?? '');
    $department = trim($_POST['department'] ?? '');

    if (empty($email) || empty($password)) {
        $error = "Email and Password are required!";
    } elseif (empty($department)) {
        $error = "Please select your department!";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND department=?");
        $stmt->bind_param("ss", $email, $department);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if ($password === $user['password']) {
                $_SESSION['user_id']    = $user['id'];
                $_SESSION['user_name']  = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_type']  = $user['user_type'];
                $_SESSION['department'] = $user['department'];
                $_SESSION['login_time'] = time();

                $redirect = "user-dashboard.php";
                switch ($user['user_type']) {
                    case 'student': $redirect = "https://docs.google.com/forms/d/e/1FAIpQLSf82FXyJS962ytcZNbybP4wOl164zhUJ0jVnmc0JhyGyVlskw/viewform";  break;
                    case 'parent':  $redirect = "parent-dashboard.php";   break;
                    case 'faculty': $redirect = "staff-dashboard.php";    break;
                    case 'alumni':  $redirect = "alumni-dashboard.php";   break;
                }

                header("Location: $redirect");
                exit();
            } else {
                $error = "Invalid Email, Password, or Department!";
            }
        } else {
            $error = "Invalid Email, Password, or Department!";
        }
        $stmt->close();
    }
    $conn->close();
}

// User type tabs
$roles = [
    'student' => ['label' => 'Student',  'icon' => 'fa-user-graduate', 'color' => '#1a73e8'],
    'parent'  => ['label' => 'Parent',   'icon' => 'fa-users',         'color' => '#0f9d58'],
    'faculty' => ['label' => 'Faculty',  'icon' => 'fa-chalkboard-teacher', 'color' => '#f4511e'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Login – TKS College</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        :root {
            --navy: #0F2545;
            --red:  #8B1A1A;
            --gold: #C8921A;
        }

        body {
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .portal-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        /* ── Card ── */
        .portal-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
        }

        /* ── Header ── */
        .portal-header {
            background: var(--navy);
            padding: 28px 36px 22px;
            text-align: center;
        }
        .portal-header img {
            height: 64px;
            width: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto 12px;
        }
        .portal-header h2 {
            color: #fff;
            font-size: 19px;
            font-weight: 700;
            margin: 0 0 3px;
        }
        .portal-header p {
            color: rgba(255,255,255,0.55);
            font-size: 12.5px;
            margin: 0;
        }

        /* ── Role selector tabs ── */
        .role-tabs {
            display: flex;
            background: #f8f9fb;
            border-bottom: 1px solid #eee;
        }
        .role-tab {
            flex: 1;
            padding: 14px 6px;
            text-align: center;
            cursor: pointer;
            border: none;
            background: transparent;
            font-size: 12px;
            font-weight: 600;
            color: #888;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }
        .role-tab i { font-size: 18px; }
        .role-tab.active {
            color: var(--navy);
            border-bottom-color: var(--gold);
            background: #fff;
        }
        .role-tab:hover:not(.active) { color: #555; background: #f0f0f0; }

        /* ── Body ── */
        .portal-body {
            padding: 28px 36px 36px;
        }

        /* ── Alert ── */
        .alert-error {
            background: #fff0f0;
            color: #c62828;
            border-left: 4px solid #c62828;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
        }

        /* ── Form ── */
        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #333;
            margin-bottom: 6px;
        }
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 14px;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(15,37,69,0.1);
            outline: none;
        }
        .mb-18 { margin-bottom: 18px; }

        .input-icon { position: relative; }
        .input-icon i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: 14px;
            pointer-events: none;
        }
        .input-icon .form-control { padding-left: 38px; }

        /* ── Role welcome banner ── */
        .role-welcome {
            border-radius: 8px;
            padding: 10px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── Submit ── */
        .btn-portal {
            width: 100%;
            padding: 13px;
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 6px;
        }
        .btn-portal:hover { background: #17356A; transform: translateY(-1px); }

        /* ── Links ── */
        .portal-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 18px;
            font-size: 13px;
        }
        .portal-links a {
            color: var(--navy);
            font-weight: 600;
            text-decoration: none;
        }
        .portal-links a:hover { text-decoration: underline; }

        /* ── Divider ── */
        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
            color: #bbb;
            font-size: 12px;
        }
        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 42%;
            height: 1px;
            background: #eee;
        }
        .divider::before { left: 0; }
        .divider::after  { right: 0; }

        /* ── Admin link at bottom ── */
        .admin-link-box {
            background: #f8f9fb;
            border-top: 1px solid #eee;
            padding: 14px 36px;
            text-align: center;
            font-size: 13px;
            color: #888;
        }
        .admin-link-box a {
            color: var(--red);
            font-weight: 700;
            text-decoration: none;
        }
        .admin-link-box a:hover { text-decoration: underline; }

        @media (max-width: 480px) {
            .portal-header, .portal-body { padding-left: 20px; padding-right: 20px; }
            .role-tab { font-size: 10.5px; padding: 11px 4px; }
            .role-tab i { font-size: 16px; }
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>


    <div class="search-modal" id="searchModal">
        <div class="search-modal-content">
            <button class="search-close-btn" onclick="closeSearchModal()">&times;</button>
            
            <div class="search-form-wrapper">
                <h2 class="search-form-title">What are you looking for?</h2>
                
                <form method="GET" action="index.php" class="search-form" id="searchForm">
                    <input 
                        type="text" 
                        name="q" 
                        id="searchInput"
                        placeholder="Type to search..." 
                        autocomplete="off"
                        value="<?= htmlspecialchars($searchQuery) ?>"
                    >
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <!-- Search Results -->
                <div id="searchResultsContainer" class="search-results-container" style="display: <?= $isSearching ? 'block' : 'none' ?>;">
                    <?php if ($isSearching): ?>
                        <div class="search-stats">
                            Found <strong><?= count($searchResults) ?></strong> result<?= count($searchResults) != 1 ? 's' : '' ?> for "<strong><?= htmlspecialchars($searchQuery) ?></strong>"
                        </div>

                        <?php if (count($searchResults) > 0): ?>
                            <?php foreach ($searchResults as $result): ?>
                                <?php if ($result['type'] === 'page'): ?>
                                    <!-- Page Result - Click to Redirect -->
                                    <a href="<?= $result['url'] ?>" class="search-result-item" style="display: block; text-decoration: none; color: inherit;">
                                        <span class="search-result-type">Page</span>
                                        
                                        <div class="search-result-title">
                                            <?= htmlspecialchars($result['title']) ?>
                                        </div>
                                        
                                        <div class="search-result-desc">
                                            <?= htmlspecialchars($result['description']) ?>
                                        </div>
                                        
                                        <div style="color: #667eea; font-size: 12px; margin-top: 8px;">
                                            <i class="fas fa-arrow-right"></i> Click to visit page
                                        </div>
                                    </a>
                                <?php else: ?>
                                    <!-- News Result -->
                                    <div class="search-result-item">
                                        <span class="search-result-type">News</span>
                                        
                                        <div class="search-result-title">
                                            <?= htmlspecialchars($result['title']) ?>
                                        </div>
                                        
                                        <div class="search-result-desc">
                                            <?= htmlspecialchars(substr($result['description'], 0, 150)) ?>...
                                        </div>
                                        
                                        <?php if (isset($result['date'])): ?>
                                            <div class="search-result-date">
                                                <i class="far fa-calendar"></i> <?= date('F d, Y', strtotime($result['date'])) ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (isset($result['pdf'])): ?>
                                            <div class="search-result-meta">
                                                <a href="<?= $result['pdf']['view'] ?>" target="_blank" class="search-pdf-link" onclick="event.stopPropagation();">
                                                    <i class="fas fa-file-pdf"></i> View PDF
                                                </a>
                                                <a href="?download=<?= urlencode($result['pdf']['download']) ?>" class="search-pdf-link" onclick="event.stopPropagation();">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-search-results">
                                <i class="fas fa-search" style="font-size: 48px; color: #e0e0e0; margin-bottom: 15px;"></i>
                                <h4>No Results Found</h4>
                                <p>Try different keywords or browse popular pages below</p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                
                <div class="search-suggestions">
                    <p>Popular searches:</p>
                    <div class="search-tags">
                        <span class="search-tag" onclick="quickSearch('admission')">Admission</span>
                        <span class="search-tag" onclick="quickSearch('courses')">Courses</span>
                        <span class="search-tag" onclick="quickSearch('placement')">Placement</span>
                        <span class="search-tag" onclick="quickSearch('library')">Library</span>
                        <span class="search-tag" onclick="quickSearch('hostel')">Hostel</span>
                        <span class="search-tag" onclick="quickSearch('faculty')">Faculty</span>
                        <span class="search-tag" onclick="quickSearch('exam')">Examination</span>
                        <span class="search-tag" onclick="quickSearch('principal')">Principal</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        <!-- header area end -->
        <div class="site-breadcrumb" style="background: url(assets/img/gallery/college-bg.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Feedback Login</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Feedback Login</li>
                </ul>
            </div>
        </div>
        <!-- header area end -->
              <?php include('scroll.php'); ?>

    <div class="portal-wrapper">
        <div class="portal-card">

            <!-- Header -->
            <div class="portal-header">
                <img src="assets/img/facility/logo.png" alt="TKS College Logo">
                <h2>TKS College Portal</h2>
                <p>Student &bull; Parent &bull; Faculty &bull; Staff Login</p>
            </div>

            <!-- Role Tabs -->
            <div class="role-tabs" id="roleTabs">
                <button class="role-tab active" onclick="setRole('student', this)">
                    <i class="fas fa-user-graduate"></i> Student
                </button>
                <button class="role-tab" onclick="setRole('parent', this)">
                    <i class="fas fa-users"></i> Parent
                </button>
                <button class="role-tab" onclick="setRole('faculty', this)">
                    <i class="fas fa-chalkboard-teacher"></i> Faculty
                </button>
            
            </div>

            <!-- Body -->
            <div class="portal-body">

                <!-- Role welcome banner -->
                <div class="role-welcome" id="roleWelcome"
                    style="background:#e8f0fe; color:#1a73e8;">
                    <i class="fas fa-user-graduate"></i>
                    <span id="roleWelcomeText">Sign in as Student</span>
                </div>

                <?php if (isset($error)): ?>
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="login_type" value="user">
                    <input type="hidden" name="user_role" id="userRoleInput" value="student">

                    <div class="mb-18">
                        <label class="form-label">Department</label>
                        <div class="input-icon">
                            <i class="far fa-building"></i>
                            <select name="department" class="form-control" required>
                                <option value="">— Select Department —</option>
                                <option>Tamil</option>
                                <option>English</option>
                                <option>Mathematics</option>
                                <option>Physics</option>
                                <option>Chemistry</option>
                                <option>Computer Science</option>
                                <option>Commerce</option>
                                <option>Management</option>
                                <option>History</option>
                                <option>BCA</option>
                                <option>MCA</option>
                                <option>MBA</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-18">
                        <label class="form-label">Email Address</label>
                        <div class="input-icon">
                            <i class="far fa-envelope"></i>
                            <input type="email" name="email" class="form-control"
                                placeholder="your@email.com" autocomplete="email" required>
                        </div>
                    </div>

                    <div class="mb-18">
                        <label class="form-label">Password</label>
                        <div class="input-icon">
                            <i class="far fa-lock"></i>
                            <input type="password" name="password" class="form-control"
                                placeholder="Enter your password"
                                autocomplete="current-password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-portal" id="submitBtn">
                        <i class="far fa-sign-in"></i>
                        <span id="submitLabel">Sign In as Student</span>
                    </button>
                </form>

            

            </div>

        

        </div>
    </div>

            <!-- footer area -->
    <footer class="footer-area">
        <div class="footer-shape">
            <img src="assets/img/shape/03.png" alt="">
        </div>
        

        
        <div class="footer-widget">
            <div class="container">
                <div class="row footer-widget-wrapper pt-100 pb-70 align-items-start">
                    <div class="col-md-6 col-lg-4">
                        <div class="footer-widget-box about-us">


                            <p class="mb-3">
                                 TKS College is dedicated to providing quality education through innovative teaching, strong academic foundations, and a supportive learning environment. The institution actively fosters research, critical thinking, and practical learning to prepare students for real-world challenges. We are committed to nurturing students to excel academically, professionally, and ethically by empowering young minds with knowledge, skills, confidence, and strong values that shape responsible and successful individuals.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Quick Links</h4>
                            <ul class="footer-list">
                                <li><a href="index.php"><i class="fas fa-caret-right"></i>Home</a></li>
                                <li><a href="institution.php"><i class="fas fa-caret-right"></i>About Us</a></li>
                                <li><a href="ug.php"><i class="fas fa-caret-right"></i>Departments</a></li>
                                <li><a href="application-form.php"><i class="fas fa-caret-right"></i>Admissions</a></li>
                                <li><a href="library.php"><i class="fas fa-caret-right"></i>Library</a></li>
                                <li><a href="placement.php"><i class="fas fa-caret-right"></i>placement</a></li>
                                <li><a href="event.php"><i class="fas fa-caret-right"></i>Events</a></li>
                                <li><a href="contact.php"><i class="fas fa-caret-right"></i>Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Our Campus</h4>
                            <div class="footer-campus-gallery">
                                <a href="#"><img src="assets/img/facility/c1.jpg" alt="Main Campus"></a>
                                <a href="#"><img src="assets/img/facility/chem2-1536x1024.jpg" alt="Library"></a>
                                <a href="#"><img src="assets/img/facility/hostel.jpg" alt="Hostel"></a>
                                <a href="#"><img src="assets/img/facility/l2.jpg" alt="Canteen"></a>
                                <a href="#"><img src="assets/img/gallery/New folder/ICON7194.JPG" alt="Computer Lab"></a>
                                <a href="#"><img src="assets/img/gallery/1st Year Inagural/New/DSC_1857.JPG" alt="Sports Ground"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Contact</h4>
                            <div class="footer-newsletter">
                                <ul class="footer-contact">
                                    <li><i class="far fa-map-marker-alt"></i> TKS College of Arts & Science, Kammavar Nagar, Koduvilarpatti, Theni - 625531</li>
                                    <li><a href="tel:+04546-250882"><i class="far fa-phone"></i>04546-250882</a></li>
                                    <li><a href="#"><i class="far fa-envelope"></i>tksclgas@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="copyright-wrapper">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <p class="copyright-text">
                                Copyright © 2026 <a href="https://nearlooks.in/"> Nearlook - Mart Pvt Ltd,</a> All Rights Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        const roleConfig = {
            student: { label: 'Student',  icon: 'fa-user-graduate',        bg: '#e8f0fe', color: '#1a73e8' },
            parent:  { label: 'Parent',   icon: 'fa-users',                 bg: '#e6f4ea', color: '#0f9d58' },
            faculty: { label: 'Faculty',  icon: 'fa-chalkboard-teacher',    bg: '#fce8e6', color: '#d93025' },
        };

        function setRole(role, el) {
            // Update tabs
            document.querySelectorAll('.role-tab').forEach(t => t.classList.remove('active'));
            el.classList.add('active');

            // Update hidden input
            document.getElementById('userRoleInput').value = role;

            // Update welcome banner
            const cfg = roleConfig[role];
            const banner = document.getElementById('roleWelcome');
            banner.style.background = cfg.bg;
            banner.style.color = cfg.color;
            banner.querySelector('i').className = 'fas ' + cfg.icon;
            document.getElementById('roleWelcomeText').textContent = 'Sign in as ' + cfg.label;

            // Update button label
            document.getElementById('submitLabel').textContent = 'Sign In as ' + cfg.label;
        }
    </script>
</body>
</html>