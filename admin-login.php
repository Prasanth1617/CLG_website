<?php
    session_start();
    include "admin/db.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            $error = "Email and Password are required!";
        } else {
            $stmt = $conn->prepare("SELECT id, email, role FROM login WHERE email=? AND password=?");
            if (!$stmt) {
                die("SQL Error: " . $conn->error); // This will show if the table 'login' is missing or has an error
            }
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            
            // Store result to check row count
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                // Use bind_result instead of get_result() for GoDaddy compatibility
                $stmt->bind_result($admin_id, $admin_email, $admin_role);
                $stmt->fetch();
                
                $_SESSION['admin_id']    = $admin_id;
                $_SESSION['admin_email'] = $admin_email;
                $_SESSION['email']       = $admin_email;
                $_SESSION['admin_role']  = $admin_role ? $admin_role : 'admin';
                $_SESSION['login_success'] = true;

                $redirect = ($_SESSION['admin_role'] === 'super_admin')
                    ? "admin/super-admin-dashboard.php"
                    : "admin/faculty.php";

                header("Location: $redirect");
                exit();
            } else {
                $error = "Invalid Admin Email or Password!";
            }
            $stmt->close();
        }
        $conn->close();
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – TKS College</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        :root {
            --navy:  #0F2545;
            --red:   #8B1A1A;
            --gold:  #C8921A;
        }

        body {
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Page wrapper ── */
        .admin-login-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        /* ── Card ── */
        .admin-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
        }

        /* ── Card header strip ── */
        .admin-card-header {
            background: var(--navy);
            padding: 32px 36px 24px;
            text-align: center;
        }
        .admin-card-header img {
            height: 72px;
            width: auto;
            object-fit: contain;
            margin-bottom: 14px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .admin-card-header h2 {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 4px;
            letter-spacing: 0.5px;
        }
        .admin-card-header p {
            color: rgba(255,255,255,0.55);
            font-size: 13px;
            margin: 0;
        }

        /* ── Badge pill ── */
        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--red);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 4px 14px;
            border-radius: 20px;
            margin-top: 10px;
        }

        /* ── Card body ── */
        .admin-card-body {
            padding: 32px 36px 36px;
        }

        /* ── Alert ── */
        .alert-error {
            background: #fff0f0;
            color: #c62828;
            border-left: 4px solid #c62828;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        /* ── Form ── */
        .form-label {
            font-weight: 600;
            font-size: 13.5px;
            color: #333;
            margin-bottom: 6px;
        }
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 14.5px;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(15,37,69,0.1);
            outline: none;
        }
        .mb-20 { margin-bottom: 20px; }

        /* ── Input icon wrapper ── */
        .input-icon {
            position: relative;
        }
        .input-icon i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 15px;
            pointer-events: none;
        }
        .input-icon .form-control {
            padding-left: 40px;
        }

        /* ── Submit button ── */
        .btn-admin {
            width: 100%;
            padding: 13px;
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 8px;
        }
        .btn-admin:hover {
            background: #17356A;
            transform: translateY(-1px);
        }

        /* ── Back link ── */
        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #888;
        }
        .back-link a {
            color: var(--navy);
            font-weight: 600;
            text-decoration: none;
        }
        .back-link a:hover { text-decoration: underline; }

        /* ── Footer strip ── */
        .admin-card-footer {
            background: #f8f9fb;
            border-top: 1px solid #eee;
            padding: 14px 36px;
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }

        @media (max-width: 480px) {
            .admin-card-header, .admin-card-body { padding-left: 22px; padding-right: 22px; }
        }
    </style>
</head>
<body>

    <!-- header area -->
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
                <h2 class="breadcrumb-title">Admin Login</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Admin Login</li>
                </ul>
            </div>
        </div>
                  <?php include('scroll.php'); ?>

    <!-- header area end -->
    <div class="admin-login-wrapper">
        <div class="admin-card">

            <!-- Header -->
            <div class="admin-card-header">
                <img src="assets/img/facility/logo.png" alt="TKS College Logo">
                <h2>TKS College</h2>
                <p>Theni Kammavar Sangam College of Arts & Science</p>
                <span class="admin-badge"><i class="fas fa-shield-alt"></i> Admin Portal</span>
            </div>

            <!-- Body -->
            <div class="admin-card-body">

                <?php if (isset($error)): ?>
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="login_type" value="admin">

                    <div class="mb-20">
                        <label class="form-label">Admin Email Address</label>
                        <div class="input-icon">
                            <i class="far fa-envelope"></i>
                            <input type="email" name="email" class="form-control"
                                placeholder="admin@tkscollege.edu.in"
                                autocomplete="email" required>
                        </div>
                    </div>

                    <div class="mb-20">
                        <label class="form-label">Password</label>
                        <div class="input-icon">
                            <i class="far fa-lock"></i>
                            <input type="password" name="password" class="form-control"
                                placeholder="Enter your password"
                                autocomplete="current-password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-admin">
                        <i class="far fa-sign-in"></i> Sign In as Admin
                    </button>
                </form>

                <div class="back-link">
                    <a href="login.php"><i class="far fa-arrow-left"></i> Back to Portal Login</a>
                </div>

            </div>

            <!-- Footer -->
            <div class="admin-card-footer">
                Restricted access &mdash; Authorised personnel only
            </div>

        </div>
    </div>


        <!-- Side Tab Button -->
    <div class="side-tab-btn sidepanel-mobile" id="more-info-btn">More Information</div>

    <!-- Side Panel -->
    <div class="side-panel sidepanel-mobile" id="side-panel">
        <div class="side-panel-content">
        
                                <ul>
                                    <li>
                                        <a href="alumni.php">Alumni</a>
                                    </li>
                                    <li>
                                    <a href="feesdetail.php">Admission & Fee</a>
                                    </li>
                                    <li>
                                        <a href="exam.php">Examination</a>
                                    </li>
                                    <li>
                                        <a href="nirf.php">NIRF</a>
                                    </li>
                                
                                    <li>
                                        <a href="placement.php">Placement</a>
                                    </li>
                                    <li>
                                        <a href="gallery.php">Picture Gallery</a>
                                    </li>                                    <li>
                                        <a href="admin-login.php">Admin Portal</a>
                                    </li>
                                    <li>
                                        <a href="contact.php">Contact us</a>
                                    </li><li class="translate-mobile"></li>

                                
                                </ul>
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


      <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="far fa-arrow-up-from-arc"></i></a>
    <!-- scroll-top end -->

        <!-- JavaScript -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
<!-- Google Translate Script -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- js -->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/jquery.appear.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/counter-up.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/navbar-fix.js"></script><script src="assets/js/main.js"></script>                                           <script src="assets/js/sidebar.js"></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



        <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- footer area end -->
</body>
</html>