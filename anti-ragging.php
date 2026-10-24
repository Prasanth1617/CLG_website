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
    <meta name="description" content="Anti-Ragging at Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:title" content="Anti-Ragging – Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:description" content="Anti-Ragging at Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:image" content="https://www.tkscas.com/assets/img/logo/logo.jpg">
    <meta name="keywords" content="">

    <!-- title -->
    <title>Anti-Ragging – Theni Kammavar Sangam College of Arts &amp; Science</title>

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
    <link rel="stylesheet" href="assets/css/polish.css">
</head>

<body>


    <!-- preloader -->
    <div class="preloader">
        <div class="loader-book">
            <div class="loader-book-page"></div>

        </div>
    </div>
    <!-- preloader end -->




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



          <?php include('scroll.php'); ?>

            <!-- Feature Area -->
        <div class="ticker">
            <div class="news-titles">
                
            </div>

            <div class="news-contents">
                <marquee behavior="scroll" direction="left">
                    The Departments of Physics and Chemistry are set to jointly organize the National Conference NCFM’26 on February  20,2026
                <a href="application-form.php" style="color: yellow; text-decoration: underline; margin-left: 20px;">
                        Registration Now
                    </a>
                    <a href="assets/img/campus-life/ConferenceNCFM26.pdf" style="color: yellow; text-decoration: underline; margin-left: 20px;">
                        BROUCHER
                    </a>
                </marquee>
            </div>
        </div>
        <!-- feature area end -->
        <!-- course-single -->
        <div class="course-single-area " style="padding:60">
        <div class="container">
            <div class="course-single-wrapper">
            <div class="row">
                <div class="col-xl-12 col-lg-10">

                <div class="my-4">
                        <h2 class="text-center">
                            ✦ ANTI-RAGGING COMMITTEE(ARC) ✦
                        </h2>
                        <h4 class="mb-3"> About ARC:</h4>
                        <p>Ragging is a non-bailable, cognizable and punishable crime. Both the state and federal governments strictly prohibit ragging to a student in any educational institution. Any student or group of students found guilty of ragging in the campus or even off campus faces one or more of the following punishments/penalties:</p><br><br>
                        <ul>
                            <li><i class="fas fa-check-circle text-success"></i>Debarring from appearing in any sessional test / University Examination</li>
                            <li><i class="fas fa-check-circle text-success"></i>Suspension from attending classes and academic privileges</li>
                            <li><i class="fas fa-check-circle text-success"></i>Withdrawing scholarships and other benefits</li>
                            <li><i class="fas fa-check-circle text-success"></i>Suspension from the college for a period of one month / Dismissal from the college</li>
                            <li><i class="fas fa-check-circle text-success"></i>Imprisonment up to three years and fine of Rs.50,000/-</li>
                        </ul><br/>

                        <p>The Anti-Ragging Committee is responsible for ensuring compliance with the provisions of the Regulations as well as the provisions of any law currently in force concerning ragging; as well as monitoring and overseeing the performance of the Anti-Ragging Squad in the prevention of ragging in the institution. As per the order of Supreme Court of India and subsequent notification from the University Grants Commission (UGC), ragging is any intention by any individual or a group on:</p>
                        <ul>
                            <li><i class="fas fa-check-circle text-success"></i> Any act of immorality, playing practical jokes, teasing, or rude handling.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Any act that hinders or disrupts regular academic activity.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Any activity that has the potential to cause annoyance, hardship, psychological harm, or creates fear or shame or apprehension.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Any form of financial extortion or coerced spending.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Any act of physical abuse those results in assault, harm, or danger to one’s health.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Abuse through spoken words, e-mails, SMS, or public insult, etc.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Any act that injures or violates the fundamental right to human dignity.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Any act of wrongful confinement, kidnapping, molesting or committing unnatural crimes, use of criminal forces, trespass, or intimidation.</li>
                            <li><i class="fas fa-check-circle text-success"></i> Any illegal gathering or ragging conspiracy.</li>
                        </ul>
                        <br/>


                        <h4 class="mb-3">Vision & Mission:</h4>
                        <p>Our mission is to create a secure, inclusive, and respectful educational environment where all students feel respected, empowered, and free of fear or intimidation.</p><br>
                        <ul>
                            <li><i class="fas fa-check-circle text-success"></i>To prevent and eliminate ragging by increased awareness, vigilance, and stringent regulation enforcement.</li>
                            <li><i class="fas fa-check-circle text-success"></i>Promoting a culture of mutual respect, decency, and empathy among pupils.</li>
                            <li><i class="fas fa-check-circle text-success"></i>Provide discreet and responsive help for ragging victims.</li>
                            <li><i class="fas fa-check-circle text-success"></i>Educate students about the legal, psychological, and academic implications of ragging.</li>
                        </ul><br/>

                        <h4 class="mb-3">Objectives:</h4>
                        <ul>
                            <li><i class="fas fa-check-circle text-success"></i>To prohibit, prevent, and eliminate the scourge of ragging, which includes any conduct by any student, whether through words or actions, that has the effect of teasing, treating, or handling with rudeness a fresher or any other student, or engaging in rowdy or undisciplined activities by any student.</li>
                            <li><i class="fas fa-check-circle text-success"></i>To supervise, direct, and monitor the Anti-Ragging Squads’ functions and performance in the prevention and curb the menace of ragging with its zero tolerance in the institution.</li>
                        </ul><br/>


                        <h4 class="mb-3">Responsibilities:</h4>
                        <ul>
                            <li><i class="fas fa-check-circle text-success"></i>To be vigilant at all times throughout the campus and other areas susceptible to ragging incidents and having the potential for ragging, and to have the authority to inspect such areas.</li>
                            <li><i class="fas fa-check-circle text-success"></i>To conduct surprise invasion on dormitories and other locations that is prone to incidents and ragging.</li>
                            <li><i class="fas fa-check-circle text-success"></i>To undertake an on-the-spot investigation into any ragging incidence reported to it by the faculty, student, parent, or guardian, as the case may be, and to submit the investigation report, together with suggestions, to the Head of the Institution for action.</li>
                            <li><i class="fas fa-check-circle text-success"></i>To ensure that availability of ragging complaints box and posters with helpline numbers are displayed on Institution and Department Notice Boards, as well as other noticeable places.</li>
                            <li><i class="fas fa-check-circle text-success"></i>To provide counseling services and create awareness among students.</li>

                        </ul><br/>
                        <h4 class="mb-3"> For Complaints, please post to the mail:</h4>
                        <p>For Complaints please submit the form in the link</p><br>
                        <h5>antiragging@tkscas.com</h5><br>

                        <p>Periodical Reports on Anti-Ragging Measures taken by the Institution are maintained / updated in the website.</p><br>
                    <h4 class="mb-3"><a href="Anti-Ragging-Members-Event.pdf" target="_blank" style="text-decoration: underline;"><i class="fas fa-file-pdf" style="color:#e63946;"></i>Anti Ragging Members & Event</a></h4>

                </div>

                </div>
            </div>
            </div>
        </div>
        </div>
        <!-- course-single end -->

  


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