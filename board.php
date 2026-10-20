<?php 
 include 'admin/db.php';
?>
<?php
include 'admin/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Administration - Theni Kammavar Sangam College of Arts & Science</title>

    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #ff0000;
            --bg-grey: #f5f7f6;
            --bg-black: #201f1d;
            --bg-white: #ffffff;
            --text-color: #212529;
            --text-color-white: #ffffff;
            --font-color: #676767;
            --heading-color: #343a40;
            --border-color: #dee2e6;
        }

        /* =============================================
           MANAGEMENT COMMITTEE REDESIGN
        ============================================= */

        .mgmt-section {
            padding: 80px 0 60px;
            background: #fafaf9;
        }

        .mgmt-section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .mgmt-section-header .eyebrow {
            display: inline-block;
            font-family: 'DM Sans', sans-serif;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #cc0000;
            margin-bottom: 14px;
            position: relative;
            padding: 0 20px;
        }

        .mgmt-section-header .eyebrow::before,
        .mgmt-section-header .eyebrow::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 32px;
            height: 1px;
            background: #cc0000;
            opacity: 0.5;
        }

        .mgmt-section-header .eyebrow::before { right: 100%; margin-right: -16px; }
        .mgmt-section-header .eyebrow::after  { left: 100%;  margin-left: -16px;  }

        .mgmt-section-header h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(30px, 4vw, 44px);
            font-weight: 600;
            color: #1a1a1a;
            margin: 0 0 14px;
            line-height: 1.15;
        }

        .mgmt-section-header p {
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            color: #777;
            max-width: 460px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Grid */
        .mgmt-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        @media (max-width: 991px) {
            .mgmt-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 575px) {
            .mgmt-grid { grid-template-columns: 1fr 1fr; gap: 14px; }
        }

        /* Card */
        .mgmt-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #ebebeb;
            transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
            position: relative;
        }

        .mgmt-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 48px rgba(0,0,0,0.10);
            border-color: transparent;
        }

        /* Color accent stripe at top */
        .mgmt-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            border-radius: 16px 16px 0 0;
            transition: height 0.3s ease;
            z-index: 1;
        }

        .mgmt-card.accent-purple::before { background: linear-gradient(90deg, #7F77DD, #AFA9EC); }
        .mgmt-card.accent-teal::before   { background: linear-gradient(90deg, #1D9E75, #5DCAA5); }
        .mgmt-card.accent-coral::before  { background: linear-gradient(90deg, #D85A30, #F0997B); }
        .mgmt-card.accent-blue::before   { background: linear-gradient(90deg, #185FA5, #85B7EB); }

        /* Image area */
        .mgmt-card-img {
            position: relative;
            width: 100%;
            padding-top: 90%;
            overflow: hidden;
        }

        .mgmt-card-img img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
            transition: transform 0.4s ease;
        }

        .mgmt-card:hover .mgmt-card-img img {
            transform: scale(1.04);
        }

        /* Avatar fallback (shown when no image) */
        .mgmt-avatar-fallback {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0;
        }

        .mgmt-avatar-circle {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .accent-purple .mgmt-avatar-fallback { background: #f3f2fd; }
        .accent-teal   .mgmt-avatar-fallback { background: #edf9f4; }
        .accent-coral  .mgmt-avatar-fallback { background: #fdf1ed; }
        .accent-blue   .mgmt-avatar-fallback { background: #ebf3fc; }

        .accent-purple .mgmt-avatar-circle { background: #CECBF6; color: #3C3489; }
        .accent-teal   .mgmt-avatar-circle { background: #9FE1CB; color: #085041; }
        .accent-coral  .mgmt-avatar-circle { background: #F5C4B3; color: #712B13; }
        .accent-blue   .mgmt-avatar-circle { background: #B5D4F4; color: #0C447C; }

        /* Role pill overlay */
        .mgmt-role-pill {
            position: absolute;
            bottom: 14px;
            left: 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 20px;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 2;
        }

        .accent-purple .mgmt-role-pill { background: rgba(127,119,221,0.18); color: #3C3489; border: 1px solid rgba(127,119,221,0.3); }
        .accent-teal   .mgmt-role-pill { background: rgba(29,158,117,0.15); color: #085041; border: 1px solid rgba(29,158,117,0.28); }
        .accent-coral  .mgmt-role-pill { background: rgba(216,90,48,0.14); color: #712B13; border: 1px solid rgba(216,90,48,0.26); }
        .accent-blue   .mgmt-role-pill { background: rgba(24,95,165,0.13); color: #0C447C; border: 1px solid rgba(24,95,165,0.25); }

        @media (max-width:400px) {
             .mgmt-role-pill {
                display: none;
            }
        }
        /* Card body */
        .mgmt-card-body {
            padding: 18px 20px 20px;
        }

        .mgmt-card-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0 0 4px;
            line-height: 1.25;
        }

        .mgmt-card-sub {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            color: #888;
            margin: 0 0 12px;
        }

        .mgmt-card-divider {
            width: 32px;
            height: 2px;
            border-radius: 2px;
            margin-bottom: 10px;
        }

        .accent-purple .mgmt-card-divider { background: #AFA9EC; }
        .accent-teal   .mgmt-card-divider { background: #5DCAA5; }
        .accent-coral  .mgmt-card-divider { background: #F0997B; }
        .accent-blue   .mgmt-card-divider { background: #85B7EB; }

        .mgmt-card-role {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: #aaa;
            margin: 0;
        }

        /* =============================================
           BOARD OF MANAGEMENT SECTION
        ============================================= */

        .board-section {
            padding: 21px 0;
        }

        /* Table - original style */
        .table-wrapper {
            padding: 20px 0;
        }

        .table-container {
            overflow-x: auto;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .table-container thead {
            background-color: var(--primary-color);
            color: white;
        }

        .table-container th,
        .table-container td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table-container tbody tr:hover {
            background-color: var(--bg-grey);
        }

        .table-container th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-heading h2 {
            font-size: 36px;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 15px;
        }

        .section-heading p {
            font-size: 16px;
            color: var(--font-color);
        }

        /* =============================================
           GENERAL PAGE STYLES (unchanged from original)
        ============================================= */

        .services .card {
            position: relative;
            z-index: 1;
            border-top: 3px solid var(--primary-color);
        }

        .services i { color: #ff0000; }

        .card > .anim-layer {
            position: absolute; top: 0; left: 0;
            width: 100%; height: 0;
            background-color: var(--primary-color);
            transition: height 0.3s ease;
        }

        .card:hover .anim-layer { height: 100%; }

        .card:hover h2, .card:hover i, .card:hover p {
            position: relative; z-index: 1;
            color: var(--text-color-white);
        }

        .card i {
            background-color: var(--bg-white);
            width: 80px; height: 80px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
        }

        .card:hover i { color: var(--primary-color); }

        /* Animation */
        @keyframes fadeUpCard {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .mgmt-card {
            animation: fadeUpCard 0.5s ease both;
        }

        .mgmt-card:nth-child(1) { animation-delay: 0.05s; }
        .mgmt-card:nth-child(2) { animation-delay: 0.15s; }
        .mgmt-card:nth-child(3) { animation-delay: 0.25s; }
        .mgmt-card:nth-child(4) { animation-delay: 0.35s; }
    </style>
</head>

<body>

    <!-- preloader -->
    <div class="preloader">
        <div class="loader-book">
            <div class="loader-book-page"></div>
        </div>
    </div>

    <!-- header area -->
        <?php include('header.php'); ?>    
    <!-- header area end -->

    <!-- Search Modal -->
    <div class="search-modal" id="searchModal">
        <div class="search-modal-content">
            <button class="search-close-btn" onclick="closeSearchModal()">&times;</button>
            <div class="search-form-wrapper">
                <h2 class="search-form-title">What are you looking for?</h2>
                <form method="GET" action="index.php" class="search-form" id="searchForm">
                    <input type="text" name="q" id="searchInput" placeholder="Type to search..."
                           autocomplete="off" value="<?= htmlspecialchars($searchQuery ?? '') ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
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

    <main class="main">
        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/gallery/college-bg.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Administration</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Administration</li>
                </ul>
            </div>
        </div>

          <?php include('scroll.php'); ?>


        <!-- =============================================
             MANAGEMENT COMMITTEE — REDESIGNED
        ============================================= -->
        <section class="mgmt-section">
            <div class="container">

                <div class="mgmt-section-header">
                    <span class="eyebrow">Leadership</span>
                    <h2>Management Committee</h2>
                    <p>Meet the dedicated leaders guiding our institution towards excellence</p>
                </div>

                <div class="mgmt-grid">

                    <!-- President -->
                    <div class="mgmt-card accent-purple">
                        <div class="mgmt-card-img">
                            <img src="assets/img/management/02.jpg" alt="Thiru. S. Namperumalsamy – President"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="mgmt-avatar-fallback" style="display:none;">
                                <div class="mgmt-avatar-circle">SN</div>
                            </div>
                            <span class="mgmt-role-pill">President</span>
                        </div>
                        <div class="mgmt-card-body">
                            <p class="mgmt-card-name">Thiru. S. Namperumalsamy</p>
                            <p class="mgmt-card-sub">Theni Kammavar Sangam</p>
                            <div class="mgmt-card-divider"></div>
                            <p class="mgmt-card-role">President</p>
                        </div>
                    </div>

                    <!-- Secretary -->
                    <div class="mgmt-card accent-teal">
                        <div class="mgmt-card-img">
                            <img src="assets/img/management/DHAMOTHARAN-227x300.jpg" alt="Thiru. B. Dhamotharan – Secretary"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="mgmt-avatar-fallback" style="display:none;">
                                <div class="mgmt-avatar-circle">BD</div>
                            </div>
                            <span class="mgmt-role-pill">Secretary</span>
                        </div>
                        <div class="mgmt-card-body">
                            <p class="mgmt-card-name">Thiru. B. Dhamotharan</p>
                            <p class="mgmt-card-sub">Theni Kammavar Sangam</p>
                            <div class="mgmt-card-divider"></div>
                            <p class="mgmt-card-role">Secretary</p>
                        </div>
                    </div>

                    <!-- General Secretary -->
                    <div class="mgmt-card accent-coral">
                        <div class="mgmt-card-img">
                            <img src="assets/img/management/mahesh-236x300.png" alt="Thiru. D. Mahesh – General Secretary"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="mgmt-avatar-fallback" style="display:none;">
                                <div class="mgmt-avatar-circle">DM</div>
                            </div>
                            <span class="mgmt-role-pill">General Secretary</span>
                        </div>
                        <div class="mgmt-card-body">
                            <p class="mgmt-card-name">Thiru. D. Mahesh</p>
                            <p class="mgmt-card-sub">Theni Kammavar Sangam</p>
                            <div class="mgmt-card-divider"></div>
                            <p class="mgmt-card-role">General Secretary</p>
                        </div>
                    </div>

                    <!-- Treasurer -->
                    <div class="mgmt-card accent-blue">
                        <div class="mgmt-card-img">
                            <img src="assets/img/management/01.jpg" alt="Thiru. R. Vasudevan – Treasurer"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="mgmt-avatar-fallback" style="display:none;">
                                <div class="mgmt-avatar-circle">RV</div>
                            </div>
                            <span class="mgmt-role-pill">Treasurer</span>
                        </div>
                        <div class="mgmt-card-body">
                            <p class="mgmt-card-name">Thiru. R. Vasudevan</p>
                            <p class="mgmt-card-sub">Theni Kammavar Sangam</p>
                            <div class="mgmt-card-divider"></div>
                            <p class="mgmt-card-role">Treasurer</p>
                        </div>
                    </div>

                </div><!-- /.mgmt-grid -->
            </div>
        </section>

        <!-- Board of Management Section -->
        <div class="board-section">
            <div class="container">

                <div class="section-heading">
                    <h2>Board of Management</h2>
                    <p>The governing body overseeing institutional operations and strategic decisions</p>
                </div>

                <div class="table-wrapper">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Thiru. P. Rengaraj @ Kannan</td>
                                    <td>Treasurer, Theni Kammavar Sangam</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Thiru. M. S. K. RamaMoorthy</td>
                                    <td>Member</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Thiru. V. S. S. S. Navaneethan</td>
                                    <td>Member</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <!-- Side Tab Button -->
        <div class="side-tab-btn sidepanel-mobile" id="more-info-btn">More Information</div>

        <!-- Side Panel -->
        <div class="side-panel sidepanel-mobile" id="side-panel">
            <div class="side-panel-content">
                <ul>
                    <li><a href="alumni.php">Alumni</a></li>
                    <li><a href="feesdetail.php">Admission & Fee</a></li>
                    <li><a href="exam.php">Examination</a></li>
                    <li><a href="nirf.php">NIRF</a></li>
                    <li><a href="placement.php">Placement</a></li>
                    <li><a href="gallery.php">Picture Gallery</a></li>
                    <li><a href="contact.php">Contact us</a></li>
                    <li class="translate-mobile"></li>
                </ul>
            </div>
        </div>
    </main>

    <!-- footer area -->
    <footer class="footer-area">
        <div class="footer-shape">
            <img src="assets/img/shape/03.png" alt="">
        </div>

        <div class="footer-header-top">
            <div class="container">
                <div class="footer-header-top-wrapper">
                    <div class="footer-header-top-content">
                        <ul>
                            <li><a href="alumni.php">Alumni</a></li>
                            <li><a href="feesdetail.php">Admission & Fee</a></li>
                            <li><a href="exam.php">Examination</a></li>
                            <li><a href="nirf.php">NIRF</a></li>
                            <li><a href="placement.php">Placement</a></li>
                            <li><a href="gallery.php">Picture Gallery</a></li>
                            <li><a href="contact.php">Contact us</a></li>
                            <li class="translate-desktop">
                                <div id="google_translate_element"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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
                                <li><a href="placement.php"><i class="fas fa-caret-right"></i>Placement</a></li>
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
                                Copyright &copy; 2026 <a href="https://nearlooks.in/">Nearlook - Mart Pvt Ltd,</a> All Rights Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="far fa-arrow-up-from-arc"></i></a>

    <!-- JavaScript -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/jquery.appear.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/counter-up.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/navbar-fix.js"></script>
    <script src="assets/js/main.js"></script>                                           <script src="assets/js/sidebar.js"></script>

</body>
</html>