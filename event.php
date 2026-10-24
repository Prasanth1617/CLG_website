<?php
include 'admin/db.php';
?>
<!DOCTYPE html><html lang="en">


<!-- Mirrored from live.themewild.com/eduka/course-single-2.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:37:25 GMT -->
<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="News, events and achievements from Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:title" content="News, Events &amp; Achievements – Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:description" content="News, events and achievements from Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:image" content="https://www.tkscas.com/assets/img/logo/logo.jpg">
    <meta name="keywords" content="">

    <!-- title -->
    <title>News, Events &amp; Achievements – Theni Kammavar Sangam College of Arts &amp; Science</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.jpg">

    <!-- css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/polish.css">
</head>

<body>
    <a class="skip-link" href="#main-content">Skip to main content</a>


    <!-- preloader -->
    <div class="preloader">
        <div class="loader-book">
            <div class="loader-book-page"></div>

        </div>
    </div>
    <!-- preloader end -->



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
    </div>    <!-- header area end -->

    





    <main id="main-content" class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/gallery/college-bg.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">News , Events & Achievements</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">News , Events & Achievements</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->
        <!-- Feature Area -->
     <?php include('scroll.php'); ?>
        <!-- feature area end -->

        <div class="course-single-area py-120">
        <div class="container">
            <div class="course-single-wrapper">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                <div class="course-details">
                    <h2 class="text-center mb-30">
                    ✦ ACHIEVEMENTS ✦
                    </h2>
                            <h4 class="mb-3 text-center"><a href="assets/img/campus-life/Tks-Rank-holders-1.pdf" target="_blank" style="text-decoration: underline;"><i class="fas fa-file-pdf" style="color:#e63946;"></i>RANK HOLDERS LIST 2009-2025</a></h4>

                    <!-- Flex layout -->
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                    <div style="flex: 1 1 45%; max-width: 45%;">
                        <img src="assets/img/campus-life/news.png" 
                            class="img-fluid rounded shadow w-100" 
                            alt="">
                    </div>
                    
                    </div>
                    <!-- Flex end -->

                </div>
                </div>
            </div>
            </div>
        </div>
        </div>



    </main>



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
                                <a href="#"><img loading="lazy" decoding="async" src="assets/img/facility/c1.jpg" alt="Main Campus"></a>
                                <a href="#"><img loading="lazy" decoding="async" src="assets/img/facility/chem2-1536x1024.jpg" alt="Library"></a>
                                <a href="#"><img loading="lazy" decoding="async" src="assets/img/facility/hostel.jpg" alt="Hostel"></a>
                                <a href="#"><img loading="lazy" decoding="async" src="assets/img/facility/l2.jpg" alt="Canteen"></a>
                                <a href="#"><img loading="lazy" decoding="async" src="assets/img/gallery/New folder/ICON7194.JPG" alt="Computer Lab"></a>
                                <a href="#"><img loading="lazy" decoding="async" src="assets/img/gallery/1st Year Inagural/New/DSC_1857.JPG" alt="Sports Ground"></a>
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
    <!-- footer area end -->




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


</body>


<!-- Mirrored from live.themewild.com/eduka/course-single-2.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:37:25 GMT -->
</html>