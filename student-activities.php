<?php
include 'admin/db.php';
?>
<!DOCTYPE html><html lang="en">


<!-- Mirrored from live.themewild.com/eduka/student-activities.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:37:48 GMT -->
<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Student Activities at Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:title" content="Student Activities – Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:description" content="Student Activities at Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:image" content="https://www.tkscas.com/assets/img/logo/logo.jpg">
    <meta name="keywords" content="">

    <!-- title -->
    <title>Student Activities – Theni Kammavar Sangam College of Arts &amp; Science</title>

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
                <h2 class="breadcrumb-title">Student Activities</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Student Activities</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- Feature Area -->
     <?php include('scroll.php'); ?>
        <!-- feature area end -->
        <!-- student activity -->
        <div class="activity pt-120 pb-80">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content-info wow fadeInUp" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Student Activity</span>
                                <h2 class="site-title">
                                    Details About <span>Recent Eduka</span> Student Activity.
                                </h2>
                            </div>
                            <p class="content-text">
                                There are many variations of passages available but the majority have suffered
                                alteration in some form by injected humour randomised words which don't look even
                                slightly believable. If you are going to use passage you need sure there anything
                                embarrassing first true generator on the Internet.
                            </p>
                            <p class="content-text mt-2">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="content-img wow fadeInLeft" data-wow-delay=".25s">
                            <img src="assets/img/activity/01.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- student activity end-->


        <!-- activity details -->
        <div class="activity-details pb-80">
            <div class="container">
                <div class="details-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="details-item">
                                <div class="details-item-img">
                                    <img src="assets/img/activity/02.jpg" alt="">
                                </div>
                                <h3 class="my-3">Our Student Becomes Champion in Soccer</h3>
                                <p>
                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. 
                                </p>
                                <p class="mt-2">
                                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here content here making it look like readable English.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="details-item">
                                <div class="details-item-img">
                                    <img loading="lazy" decoding="async" src="assets/img/activity/03.jpg" alt="">
                                </div>
                                <h3 class="my-3">Our Student Becomes Champion in Soccer</h3>
                                <p>
                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. 
                                </p>
                                <ul class="content-list mt-2">
                                    <li><i class="fas fa-check-circle"></i>Sed ut perspiciatis unde omnis iste natus error sit doloremque laudantium.</li>
                                    <li><i class="fas fa-check-circle"></i>Totam rem aperiam eaque ipsa quae ab illo inventore veritatis.</li>
                                    <li><i class="fas fa-check-circle"></i>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit.</li>
                                    <li><i class="fas fa-check-circle"></i>Dolores eos qui ratione voluptatem sequi nesciunte porro quisquam est.</li>
                                    <li><i class="fas fa-check-circle"></i>Etos qui ratione voluptatem sequi nesciunte porro quisquam est.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="details-item">
                                <div class="details-item-img">
                                    <img loading="lazy" decoding="async" src="assets/img/activity/04.jpg" alt="">
                                </div>
                                <h3 class="my-3">Our Student Becomes Champion in Soccer</h3>
                                <p>
                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. 
                                </p>
                                <p class="mt-2">
                                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here content here making it look like readable English.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="details-item">
                                <div class="details-item-img">
                                    <img loading="lazy" decoding="async" src="assets/img/activity/05.jpg" alt="">
                                </div>
                                <h3 class="my-3">Our Student Becomes Champion in Soccer</h3>
                                <p>
                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. 
                                </p>
                                <p class="mt-2">
                                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here content here making it look like readable English.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- activity details end -->
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
                                        </li>
                                        <li>
                                            <a href="contact.php">Contact us</a>
                                        </li>
                                    <li class="translate-mobile"></li>

                                    
                                    </ul>
            </div>
        </div>
    </main>



    <!-- footer area -->
    <footer class="footer-area">
        <div class="footer-shape">
            <img loading="lazy" decoding="async" src="assets/img/shape/03.png" alt="">
        </div>
        <div class="footer-widget">
            <div class="container">
                <div class="row footer-widget-wrapper pt-100 pb-70 align-items-start">
                    <div class="col-md-6 col-lg-4">
                        <div class="footer-widget-box about-us">
                            <a href="#" class="footer-logo">
                                <img src="assets/img/logo/logo-light.png" alt="">
                            </a>
                            <p class="mb-3">
TKS College is dedicated to providing quality education through innovative teaching, strong academic foundations, and a supportive learning environment. The institution actively fosters research, critical thinking, and practical learning to prepare students for real-world challenges. We are committed to nurturing students to excel academically, professionally, and ethically by empowering young minds with knowledge, skills, confidence, and strong values that shape responsible and successful individuals.
                            </p>
                            <ul class="footer-contact">
                                <li><a href="tel:+21236547898"><i class="far fa-phone"></i>+2 123 654 7898</a></li>
                                <li><i class="far fa-map-marker-alt"></i>25/B Milford Road, New York</li>
                                <li><a href="https://live.themewild.com/cdn-cgi/l/email-protection#224b4c444d62475a434f524e470c414d4f"><i
                                            class="far fa-envelope"></i><span class="__cf_email__" data-cfemail="81e8efe7eec1e4f9e0ecf1ede4afe2eeec">[email&#160;protected]</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Quick Links</h4>
                            <ul class="footer-list">
                                <li><a href="#"><i class="fas fa-caret-right"></i> About Us</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> FAQ's</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Testimonials</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Terms Of Service</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Privacy policy</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Update News</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Our Campus</h4>
                            <ul class="footer-list">
                                <li><a href="#"><i class="fas fa-caret-right"></i> Campus Safety</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Student Activities</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Academic Department</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Planning & Administration</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Office Of The Chancellor</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Facility Services</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Newsletter</h4>
                            <div class="footer-newsletter">
                                <p>Subscribe Our Newsletter To Get Latest Update And News</p>
                                <div class="subscribe-form">
                                    <form action="#">
                                        <input type="email" class="form-control" placeholder="Your Email">
                                        <button class="theme-btn" type="submit">
                                            Subscribe Now <i class="far fa-paper-plane"></i>
                                        </button>
                                    </form>
                                </div>
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
                                &copy; Copyright <span id="date"></span> <a href="#"> Eduka </a> All Rights Reserved.
                            </p>
                        </div>
                        <div class="col-md-6 align-self-center">
                            <ul class="footer-social">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            </ul>
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


<!-- Mirrored from live.themewild.com/eduka/student-activities.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:37:59 GMT -->
</html>