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
    <meta name="description" content="Examination information for students of Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:title" content="Examination – Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:description" content="Examination information for students of Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:image" content="https://www.tkscas.com/assets/img/logo/logo.jpg">
    <meta name="keywords" content="">

    <!-- title -->
    <title>Examination – Theni Kammavar Sangam College of Arts &amp; Science</title>

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
        grid-template-columns: repeat(3, 1fr); /* 4 columns per row */
        gap: 40px;
        justify-items: center;
        max-width: 1200px;
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
    .shadow-sm .card-header{
        background-color: #6baebb !important;
    }
    
    .row{
        --bs-gutter-x: -2.5rem !important;
    }
    
   .row .site-title-tagline{
        --bs-gutter-x: -2.5rem !important;
    }
    
    .col-lg-6{
        width:100% !important;
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
                <h2 class="breadcrumb-title">Examination</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Examination</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- Feature Area -->
     <?php include('scroll.php'); ?>
        <!-- feature area end -->
                                        <!-- course-single -->
        <div class="course-single-area py-120">
            <div class="container">
                <div class="course-single-wrapper">
                    <div class="row">
                    
                    <div class="my-5">
                        <h3 class="text-center mb-5" style="font-weight: 700; color: #2c3e50;">EXAMINATION CELL</h3>

                        <!-- INTERNAL ASSESSMENT -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header text-white" style="background-color: #f2f2f2; text-align: center;">
                                <h5 class="mb-0">Internal Assessment</h5>
                            </div>
                            <div class="card-body">
                                <ul class="mb-0" style="list-style-type: disc; padding-left: 20px;">
                                    <li>✨ Two tests will be conducted (10 marks each). Average of the two is taken – <strong>10 marks</strong>.</li>
                                    <li>✨ 3rd test may be conducted for absentees of any one of the two tests.</li>
                                    <li>✨ Group Discussion / Seminar / Quiz – <strong>5 marks</strong>.</li>
                                    <li>✨ 2 assignments: 5 marks each; average – <strong>5 marks</strong>.</li>
                                    <li>✨ Peer team teaching / Peer group learning / Attendance – <strong>5 marks</strong>. <br>
                                        Students should be grouped into 5–6 members. 10% of each subject shall be taught via peer teaching and learning.
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- EXTERNAL EXAMINATION -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header text-white" style="background-color: #f2f2f2; text-align: center;">
                                <h5 class="mb-0">External Examination</h5>
                            </div>
                            <div class="card-body">
                                <p>There is external examination at the end of the semester-ODD semesters in the month of November and EVEN semester in the month April.</p><br>

                                <p>A candidate who does not pass the examination may be permitted to appear in the failed subjects in the subsequent examinations. Candidate should get his name registered with Madurai Kamaraj University at the time of appearing for the first semester examinations.</p><br>
                                
                                <p>Those students who have attended the classes for 68 days (75%) and above will be permitted to appear for the ensuing university examinations without any preconditions. Those students who have attended the classes for 67 days and less, but 59 days (65%) and above will be permitted to apply for exemption in the prescribed form to the university along with fess prescribed by the University with the specific remarks of the principal for condonation of attendance. Those students who have attended the classes for 58 days and less, but 45 days (50%) and above cannot appear for university examinations provided they can appear for next examinations by paying the fees prescribed by the university with special permission along with proper documents for sufficient reasons for their absence. Those students who have put in 44 days of attendance and less have to repeat the whole semester.</p>
                            </div>
                        </div>

                        <!-- QUESTION PAPER PATTERN -->
                        <!-- UG PROGRAMMES -->
                        <div class="table-wrapper my-4">
                            <div class="table-container"> 
                                    <div class="row mt-50">
                                        <div class="col-lg-6 mx-auto">
                                            <div class="site-heading text-center">
                                                <span class="site-title-tagline"><i class="far fa-user-graduate"></i> Question Paper Pattern <small>(Time: 3 Hrs)</small></span>
                                            </div>
                                        </div>
                                    </div>
                                <table border="1" cellspacing="0" cellpadding="8" >
                                    <thead>
                                        <tr style="background-color: #f2f2f2; text-align: center;">
                                            <th>Section</th>
                                            <th>Marks</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center;">SECTION – A</td>
                                            <td style="text-align: center;">10</td>
                                            <td>
                                                i) Choose the correct answer (Q1–Q5)<br>
                                                ii) One question from each unit<br>
                                                iii) Fill in the blanks (Q6–Q10)<br>
                                                iv) One question from each unit
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">SECTION – B</td>
                                            <td style="text-align: center;">35</td>
                                            <td>
                                                i) Either (a) or (b) type questions (Q11–Q15)<br>
                                                ii) One question from each unit
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">SECTION – C</td>
                                            <td style="text-align: center;">30</td>
                                            <td>
                                                i) Open choice questions (Q16–Q20)<br>
                                                ii) Answer any three questions out of five<br>
                                                iii) One question from each unit
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><br>


                        <!-- PASSING MINIMUM -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header text-white" style="background-color: #f2f2f2; text-align: center;">
                                <h5 class="mb-0">Scheme for Evaluation</h5>
                            </div>
                            <div class="card-body">
                                <ul style="list-style-type: square; padding-left: 20px;">
                                    <li>Theory examination evaluated by examiners appointed by Madurai Kamaraj University.</li>
                                   
                                </ul>
                            </div>
                        </div>

                        <!-- PASSING MINIMUM -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header text-white" style="background-color: #f2f2f2; text-align: center;">
                                <h5 class="mb-0">Passing Minimum:</h5>
                            </div>
                            <div class="card-body">
                                <ul style="list-style-type: square; padding-left: 20px;">
                                    <li>✨ There is no passing minimum for internal examination</li>
                                    <li>✨ he passing minimum for external examination is 27 out of 75 marks.</li>
                                    <li>✨ A candidate should be declared to have passed in each paper / practical if he/she secures not less than 40% (aggregate of Internal and External) of the marks prescribed for the examination.</li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    </div>

                </div>

                </div>
            </div>
        </div>

        <div class="container-content">
            
            <div class="pdf-grid">
                <div class="pdf-item">
                    <div class="pdf-icon-wrapper">
                        <a href="Exam-Cell-members.pdf" target="_blank" class="pdf-icon">
                            <div class="pdf-symbol">📄</div>
                            <div class="pdf-text">PDF</div>
                        </a>
                    </div>
                    <div class="pdf-year">Exam Cell Members</div>
                </div>
                           
                <div class="pdf-item">
                    <div class="pdf-icon-wrapper">
                        <a href="Instituitons-SOPs.pdf" target="_blank" class="pdf-icon">
                            <div class="pdf-symbol">📄</div>
                            <div class="pdf-text">PDF</div>
                        </a>
                    </div>
                    <div class="pdf-year">Instituitons-SOPs</div>
                </div>

                 <div class="pdf-item">
                    <div class="pdf-icon-wrapper">
                        <a href="Pattern-of-Semester-Exam.pdf" target="_blank" class="pdf-icon">
                            <div class="pdf-symbol">📄</div>
                            <div class="pdf-text">PDF</div>
                        </a>
                    </div>
                    <div class="pdf-year">Pattern of Semester Exam</div>
                </div>
            </div>
            
        </div>


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