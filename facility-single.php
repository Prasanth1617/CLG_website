<?php
include 'admin/db.php';
?>
<!DOCTYPE html><html lang="en">


<!-- Mirrored from live.themewild.com/eduka/facility-single.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:38:03 GMT -->
<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Facility at Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:title" content="Facility – Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:description" content="Facility at Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:image" content="https://www.tkscas.com/assets/img/logo/logo.jpg">
    <meta name="keywords" content="">

    <!-- title -->
    <title>Facility – Theni Kammavar Sangam College of Arts &amp; Science</title>

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
                <h2 class="breadcrumb-title">Facility Single</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Facility Single</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->
        <!-- Feature Area -->
     <?php include('scroll.php'); ?>
        <!-- feature area end -->

        <!-- facility single -->
        <div class="facility-single-area py-120">
            <div class="container">
                <div class="facility-single-wrapper">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="facility-sidebar">
                                <div class="widget category">
                                    <h4 class="widget-title">All Facilities</h4>
                                    <div class="category-list">
                                        <a href="#"><i class="far fa-long-arrow-right"></i>Library Facility</a>
                                        <a href="#"><i class="far fa-long-arrow-right"></i>Hall Facility</a>
                                        <a href="#"><i class="far fa-long-arrow-right"></i>Canteen Food Facility</a>
                                        <a href="#"><i class="far fa-long-arrow-right"></i>Transport Facility</a>
                                        <a href="#"><i class="far fa-long-arrow-right"></i>Lab Facility</a>
                                        <a href="#"><i class="far fa-long-arrow-right"></i>Gymnasium Facility</a>
                                    </div>
                                </div>
                                <div class="widget facility-download">
                                    <h4 class="widget-title">Download</h4>
                                    <a href="#"><i class="far fa-file-pdf"></i> Download Library eBook</a>
                                    <a href="#"><i class="far fa-file-alt"></i> Download Application</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="facility-details">
                                <div class="facility-details-img mb-30">
                                    <img src="assets/img/facility/single.jpg" alt="thumb">
                                </div>
                                <div class="facility-details">
                                    <h3 class="mb-20">Library Facility</h3>
                                    <p class="mb-20">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                        doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                        veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam
                                        voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                        porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                        velit, sed quia non numquam eius modi tempora incidunt ut labore et.
                                    </p>
                                    <p class="mb-20">
                                        But I must explain to you how all this mistaken idea of denouncing pleasure and
                                        praising pain was born and I will give you a complete account of the system, and
                                        expound the actual teachings of the great explorer of the truth, the
                                        master-builder of human happiness. No one rejects, dislikes, or avoids pleasure
                                        itself, because it is pleasure, but because those who do not know how to pursue
                                        pleasure rationally encounter consequences that are extremely painful. Nor again
                                        is there anyone who loves or pursues or desires to obtain pain of itself,
                                        because it is pain, but because occasionally circumstances occur in which toil
                                        and pain can procure him some great pleasure. To take a trivial example
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6 mb-20">
                                            <img src="assets/img/facility/01.jpg" alt="">
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <img loading="lazy" decoding="async" src="assets/img/facility/02.jpg" alt="">
                                        </div>
                                    </div>
                                    <p class="mb-20">
                                        Power of choice is untrammelled and when nothing prevents our being able to do
                                        what we like best, every pleasure is to be welcomed and every pain avoided. But
                                        in certain circumstances and owing to the claims of duty or the obligations of
                                        business it will frequently occur that pleasures have to be repudiated and
                                        annoyances accepted. The wise man therefore always holds in these matters to
                                        this principle of selection.
                                    </p>
                                    <div class="my-4">
                                        <div class="mb-3">
                                            <h3 class="mb-3">Library Features</h3>
                                            <p>Aliquam facilisis rhoncus nunc, non vestibulum mauris volutpat non.
                                                Vivamus tincidunt accumsan urna, vel aliquet nunc commodo tristique.
                                                Nulla facilisi. Phasellus vel ex nulla. Nunc tristique sapien id mauris
                                                efficitur, porta scelerisque nisl dignissim. Vestibulum ante ipsum
                                                primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed at
                                                mollis tellus. Proin consequat, orci nec bibendum viverra, ante orci
                                                suscipit dolor, et condimentum felis dolor ac lectus.</p>
                                        </div>
                                        <ul class="facility-single-list">
                                            <li><i class="far fa-check"></i>Fusce justo risus placerat in risus eget
                                                tincidunt consequat elit.</li>
                                            <li><i class="far fa-check"></i>Nunc fermentum sem sit amet dolor laoreet
                                                placerat.</li>
                                            <li><i class="far fa-check"></i>Nullam rhoncus dictum diam quis ultrices.
                                            </li>
                                            <li><i class="far fa-check"></i>Integer quis lorem est uspendisse eu augue
                                                porta ullamcorper dictum.</li>
                                            <li><i class="far fa-check"></i>Quisque tristique neque arcu ut venenatis
                                                felis malesuada et.</li>
                                        </ul>
                                    </div>
                                    <div class="my-4">
                                        <h3 class="mb-3">Library Benefits Of Our Students</h3>
                                        <p>Quisque a nisl id sem sollicitudin volutpat. Cras et commodo quam, vel congue
                                            ligula. Orci varius natoque penatibus et magnis dis parturient montes,
                                            nascetur ridiculus mus. Cras quis venenatis neque. Donec volutpat tellus
                                            lobortis mi ornare eleifend. Fusce eu nisl ut diam ultricies accumsan.
                                            Integer lobortis vestibulum nunc id porta. Curabitur aliquam arcu sed ex
                                            dictum, a facilisis urna porttitor. Fusce et mattis nisl. Sed iaculis libero
                                            consequat justo auctor iaculis. Vestibulum sed ex et magna tristique
                                            bibendum. Sed hendrerit neque nec est suscipit, id faucibus dolor convallis.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- facility single end-->
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
                                <li><a href="https://live.themewild.com/cdn-cgi/l/email-protection#8ce5e2eae3cce9f4ede1fce0e9a2efe3e1"><i
                                            class="far fa-envelope"></i><span class="__cf_email__" data-cfemail="3d54535b527d58455c504d5158135e5250">[email&#160;protected]</span></a></li>
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


<!-- Mirrored from live.themewild.com/eduka/facility-single.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:38:06 GMT -->
</html>