<?php
include 'admin/db.php';
?>
<!DOCTYPE html><html lang="en">


<!-- Mirrored from live.themewild.com/eduka/about.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:37:27 GMT -->
<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Research Forum at Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:title" content="Research Forum – Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:description" content="Research Forum at Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:image" content="https://www.tkscas.com/assets/img/logo/logo.jpg">
    <meta name="keywords" content="">

    <!-- title -->
    <title>Research Forum – Theni Kammavar Sangam College of Arts &amp; Science</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.jpg">

    <!-- css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

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

.services .card {
  position: relative;
  z-index: 1;
  border-top: 3px solid var(--primary-color);
}

.services i {
  color: #ff0000;
}

.card > .anim-layer {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 0;
  background-color: var(--primary-color);
  transition: height 0.3s ease;
}

.card:hover .anim-layer {
  height: 100%;
}

.card:hover h2, .card:hover i, .card:hover p {
  position: relative;
  z-index: 1;
  color: var(--text-color-white);
}

.card i {
  background-color: var(--bg-white);
  width: 80px;
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
}

.pg-course{
    margin-top:-300px;
}

.course-single-list li{
    margin-top: 20px !important;
}
</style>

<style>
    .container-content {
    padding: 60px 20px;
    }

    .section-title {
        text-align: center;
        color: #2c3e50;
        font-size: 2rem;
        margin-bottom: 50px;
        font-weight: 600;
    }

    .pdf-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr); /* 4 columns per row */
        gap: 40px;
        justify-items: center;
        max-width: 1800px;
        margin: 0 auto;
    }

    .pdf-item {
        text-align: center;
        transition: transform 0.3s ease;
        width: 100%;
    }

    .pdf-item:hover {
        transform: translateY(-5px);
    }

    .pdf-icon-wrapper {
        position: relative;
        width: 120px;
        height: 140px;
        margin: 0 auto 15px;
    }

    .pdf-icon {
        width: 100%;
        height: 100%;
        background: white;
        border: 3px solid #e74c3c;
        border-radius: 8px;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .pdf-icon:hover {
        border-color: #c0392b;
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
    }

    .pdf-icon::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 25px 25px 0;
        border-color: transparent #e74c3c transparent transparent;
        border-radius: 0 6px 0 0;
    }

    .pdf-symbol {
        font-size: 3rem;
        color: #e74c3c;
        margin-bottom: 10px;
        font-weight: 300;
    }

    .pdf-text {
        font-size: 1.1rem;
        color: #e74c3c;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .pdf-year {
        font-size: 1rem;
        color: #34495e;
        font-weight: 500;
    }

    /* Tablet - 2 columns */
    @media (max-width: 992px) {
        .pdf-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }
    }

    /* Mobile - 1 column */
    @media (max-width: 576px) {
        .pdf-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .pdf-icon-wrapper {
            width: 100px;
            height: 120px;
        }

        .section-title {
            font-size: 1.5rem;
        }
    }
    
    .course-single-area{
        padding: 30px;
    }
</style>
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


        <!-- breadcrumb -->
        <div id="main-content" class="site-breadcrumb" style="background: url(assets/img/gallery/college-bg.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Research Forum</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Research Forum</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->
        <!-- Feature Area -->
     <?php include('scroll.php'); ?>
        <!-- feature area end -->
        <!-- course-single -->
        <div class="course-single-area ">
        <div class="container">
            <div class="course-single-wrapper">
            <div class="row">
                <div class="col-xl-12 col-lg-10">

                <div class="my-4">
                        <h2 class="text-center">
                            ✦ Research Forum ✦
                        </h2>
                    <h4 class="mb-3">Objectives:</h4>
                    <ul>
                        <li><i class="fas fa-check-circle text-success"></i>Research Forum help in inculcating research aptitude among the faculties and research scholars.</li>
                        <li><i class="fas fa-check-circle text-success"></i>It encourages research interest among faculties and the exchange of information regarding various aspects of educational research.</li>
                        <li><i class="fas fa-check-circle text-success"></i>To provide an opportunity to faculty members and research scholars to present and discuss their research work.</li>
                        <li><i class="fas fa-check-circle text-success"></i>To bring  research ambiance among the faculty members and their research scholars.</li>
                        <li><i class="fas fa-check-circle text-success"></i>To create awareness regarding the research work carried out / Guided by Faculties</li>
                        <li><i class="fas fa-check-circle text-success"></i>To motivate the faculties to undertake innovative research projects</li>
                    </ul><br/>

                        <h4 class="mb-3">The activities to be done:</h4>
                        <ul>
                            <li><i class="fas fa-check-circle text-success"></i> Technical skill enhancement of the students and faculty.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Motivating the students to undertake innovative projects.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Create awareness amongst staff about funding agencies for lab modernization, research work, and attending international conferences abroad.</li>
                            <li><i class="fas fa-check-circle text-success"></i> How to convert research ideas into proposals for funded projects.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Creating Online Research Forum Link on TKS website to help the students and researchers.</li>
                            <li><i class="fas fa-check-circle text-success"></i> To create a bridge among researchers, industries, and academic institutions through exchange of knowledge and ideas.</li>
                            <li><i class="fas fa-check-circle text-success"></i> How to write a good technical paper?</li>
                            <li><i class="fas fa-check-circle text-success"></i> Presentations of research ideas by PhD scholars.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Providing opportunities for students to present their research works at college or University level paper presentation.</li>
                            <li><i class="fas fa-check-circle text-success"></i> The ultimate aim of the forum is to provide opportunities for both students and teachers to publish their research papers in international journals.</li>
                        </ul>
                        <br/>

                  
                </div>

                </div>
            </div>
            </div>
        </div>
        </div>
        <!-- course-single end -->

  
         <div class="container-content">
           
            
            <div class="pdf-grid">
                <!-- 2024-2025 -->
                <div class="pdf-item">
                    <div class="pdf-icon-wrapper">
                        <a href="Research-fORUM-COUNCIL.pdf" target="_blank" class="pdf-icon">
                            <div class="pdf-symbol">📄</div>
                            <div class="pdf-text">PDF</div>
                        </a>
                    </div>
                    <div class="pdf-year">RESEARCH FORUM – MEMBERS</div>
                </div>
                            <!-- 2024-2025 -->
                <div class="pdf-item">
                    <div class="pdf-icon-wrapper">
                        <a href="RESEARCH-FORUM-FDP.pdf" target="_blank" class="pdf-icon">
                            <div class="pdf-symbol">📄</div>
                            <div class="pdf-text">PDF</div>
                        </a>
                    </div>
                    <div class="pdf-year">RESEARCH FORUM FDP</div>
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


<!-- Mirrored from live.themewild.com/eduka/about.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:37:27 GMT -->
</html>