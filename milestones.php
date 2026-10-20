<?php
    include ('admin/db.php');

    // ✅ Handle search on same page
    $searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
    $searchResults = [];
    $isSearching = !empty($searchQuery);

    if ($isSearching) {
        // Define page keywords for matching
        $pages = [
            ['title' => 'Admission & Fee', 'url' => 'feesdetail.php', 'keywords' => 'admission fee fees structure payment'],
            ['title' => 'Application Form', 'url' => 'application-form.php', 'keywords' => 'apply application form register'],
            ['title' => 'Contact Us', 'url' => 'contact.php', 'keywords' => 'contact phone email address location'],
            ['title' => 'Institution', 'url' => 'institution.php', 'keywords' => 'about institution college history'],
            ['title' => 'Vision & Mission', 'url' => 'vission&mission.php', 'keywords' => 'vision mission goals objectives'],
            ['title' => 'Library', 'url' => 'library.php', 'keywords' => 'library books resources'],
            ['title' => 'Hostel', 'url' => 'hostel.php', 'keywords' => 'hostel accommodation residence'],
            ['title' => 'Placement', 'url' => 'placement.php', 'keywords' => 'placement jobs career recruitment'],
            ['title' => 'Examination', 'url' => 'exam.php', 'keywords' => 'exam examination test results'],
            ['title' => 'Alumni', 'url' => 'alumni.php', 'keywords' => 'alumni graduates former students'],
            ['title' => 'Faculty', 'url' => 'faculty.php', 'keywords' => 'faculty teachers professors staff'],
            ['title' => 'UG Courses', 'url' => 'ug.php', 'keywords' => 'ug undergraduate courses programs bachelor'],
            ['title' => 'PG Courses', 'url' => 'pg.php', 'keywords' => 'pg postgraduate masters courses'],
            ['title' => 'Laboratory', 'url' => 'lab.php', 'keywords' => 'laboratory lab facilities equipment'],
            ['title' => 'Sports', 'url' => 'sports.php', 'keywords' => 'sports games athletics'],
            ['title' => 'NCC/NSS', 'url' => 'ncc-nss.php', 'keywords' => 'ncc nss national service'],
            ['title' => 'Events & News', 'url' => 'event.php', 'keywords' => 'events news achievements updates'],
            ['title' => 'Gallery', 'url' => 'gallery.php', 'keywords' => 'gallery photos images pictures'],
            ['title' => 'Principal', 'url' => 'principal.php', 'keywords' => 'principal head director'],
            ['title' => 'Management', 'url' => 'management.php', 'keywords' => 'management committee board'],
            ['title' => 'IQAC', 'url' => 'iqac.php', 'keywords' => 'iqac quality assurance'],
            ['title' => 'Research', 'url' => 'research.php', 'keywords' => 'research forum projects'],
            ['title' => 'Bus Facility', 'url' => 'bus-facility.php', 'keywords' => 'bus transport facility'],
            ['title' => 'Academic Calendar', 'url' => 'calender.php', 'keywords' => 'calendar schedule dates'],
            ['title' => 'NIRF', 'url' => 'nirf.php', 'keywords' => 'nirf ranking'],
            ['title' => 'Annual Reports', 'url' => 'annual-reports.php', 'keywords' => 'annual reports documents'],
        ];
        
        $lowerQuery = strtolower($searchQuery);
        
        // Check for direct page match first (for instant redirect)
        $directMatch = false;
        foreach ($pages as $page) {
            $keywords = strtolower($page['keywords']);
            // Check if search query exactly matches any keyword
            if (in_array($lowerQuery, explode(' ', $keywords))) {
                // Redirect directly to the page
                header("Location: " . $page['url']);
                exit;
            }
        }
        
        // Search pages for partial matches
        foreach ($pages as $page) {
            $titleLower = strtolower($page['title']);
            $keywordsLower = strtolower($page['keywords']);
            
            // Check if search query matches title or keywords
            if (stripos($titleLower, $lowerQuery) !== false || 
                stripos($keywordsLower, $lowerQuery) !== false) {
                $searchResults[] = [
                    'type' => 'page',
                    'title' => $page['title'],
                    'url' => $page['url'],
                    'description' => 'Navigate to ' . $page['title']
                ];
            }
        }
        
        // Search in database (news updates)
        $searchTerm = mysqli_real_escape_string($conn, $searchQuery);
        $newsQuery = "SELECT id, title, description, date, pdf 
                    FROM newsupdate 
                    WHERE title LIKE '%$searchTerm%' 
                    OR description LIKE '%$searchTerm%' 
                    ORDER BY date DESC LIMIT 10";
        
        $newsResults = mysqli_query($conn, $newsQuery);
        
        while($row = mysqli_fetch_assoc($newsResults)) {
            $pdfInfo = null;
            if (!empty($row['pdf'])) {
                $browserPath = "admin/uploads/" . rawurlencode($row['pdf']);
                $serverPath  = "admin/uploads/" . $row['pdf'];
                if (file_exists($serverPath)) {
                    $pdfInfo = [
                        "view" => $browserPath,
                        "download" => $row['pdf']
                    ];
                }
            }
            
            $searchResults[] = [
                'type' => 'news',
                'title' => $row['title'],
                'description' => $row['description'],
                'date' => $row['date'],
                'pdf' => $pdfInfo
            ];
        }
    }



?>
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
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- title -->
    <title>Theni Kammavar Sangam College of Arts & Science</title>

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

        .card:hover i {
        color: var(--primary-color);
        }
    </style>
</head>

<body>


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




    <main class="main">
        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/gallery/college-bg.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Our Milestones</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Our Milestones</li>
                </ul>
            </div>
        </div>
                 <!-- Feature Area -->
     <?php include('scroll.php'); ?>
        <!-- feature area end -->

        <!-- breadcrumb end -->
          <div class="row">
                    <div class="col-lg-6 mx-auto mt-50">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline mt-50"><i class="far fa-book-open-reader"></i>UG PROGRAMMES</span>                          
                        </div>
                    </div>
        </div>

        <!-- UG PROGRAMMES -->
        <div class="table-wrapper">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                        <th>S.NO</th>
                        <th>Programmes</th>
                        <th>Major</th>
                        <th>Year of Affiliation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>1</td><td>B.A. (ENGLISH)</td><td>English Literature</td><td>2009</td></tr>
                        <tr><td>2</td><td>BBA</td><td>Business Administration</td><td>2009</td></tr>
                        <tr><td>3</td><td>B.COM</td><td>Commerce</td><td>2009</td></tr>
                        <tr><td>4</td><td>B.COM. (CA)</td><td>Commerce With Computer Applications</td><td>2009</td></tr>
                        <tr><td>5</td><td>B.Sc. (CS)</td><td>Computer Science</td><td>2009</td></tr>
                        <tr><td>6</td><td>BCA</td><td>Computer Applications</td><td>2009</td></tr>
                        <tr><td>7</td><td>B.Sc. (PHYSICS)</td><td>Physics</td><td>2010</td></tr>
                        <tr><td>8</td><td>B.Sc. (CHEMISTRY)</td><td>Chemistry</td><td>2010</td></tr>
                        <tr><td>9</td><td>B.Sc. (IT)</td><td>Information Technology</td><td>2013</td></tr>
                        <tr><td>10</td><td>B.Sc. (MATHS)</td><td>Mathematics</td><td>2013</td></tr>
                        <tr><td>11</td><td>B.COM. (BANKING)</td><td>Commerce (Banking)</td><td>2014</td></tr>
                        <tr><td>12</td><td>B.Sc. (PHY.EDU)</td><td>Physical Education</td><td>2017</td></tr>
                        <tr><td>13</td><td>B.COM. (PA)</td><td>Professional Accounting</td><td>2021</td></tr>
                        <tr><td>14</td><td>B.A. (TAMIL)</td><td>Tamil</td><td>2023</td></tr>
                    </tbody>
                </table>

                
                <div class="row">
                    <div class="col-lg-6 mx-auto mt-50">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline mt-50"><i class="far fa-book-open-reader"></i>PG PROGRAMMES</span>                          
                        </div>
                    </div>
                </div>
                <!-- PG PROGRAMMES -->
    
                <table border="1" cellspacing="0" cellpadding="8">
                <thead>
                    <tr>
                    <th>S.NO</th>
                    <th>Programmes</th>
                    <th>Major</th>
                    <th>Year of Affiliation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>15</td><td>M.A. (ENGLISH)</td><td>English Literature</td><td>2012</td></tr>
                    <tr><td>16</td><td>M.Sc. (MATHS)</td><td>Mathematics</td><td>2012</td></tr>
                    <tr><td>17</td><td>M.Sc. (CS)</td><td>Computer Science</td><td>2012</td></tr>
                    <tr><td>18</td><td>M.COM. (CA)</td><td>Commerce With Computer Applications</td><td>2012</td></tr>
                    <tr><td>19</td><td>M.Sc. (CHEMISTRY)</td><td>Chemistry</td><td>2014</td></tr>
                    <tr><td>20</td><td>M.Sc. (PHYSICS)</td><td>Physics</td><td>2014</td></tr>
                    <tr><td>21</td><td>M.COM</td><td>Commerce</td><td>2017</td></tr>
                    <tr><td>22</td><td>M.A. (TAMIL)</td><td>Tamil</td><td>2024</td></tr>
                </tbody>
                </table>

                <div class="row">
                    <div class="col-lg-6 mx-auto mt-50">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline mt-50"><i class="far fa-book-open-reader"></i>CERTIFICATE PROGRAMMES</span>                          
                        </div>
                    </div>
                </div>
                <!-- PG PROGRAMMES -->
        
                <table border="1" cellspacing="0" cellpadding="8">
                    <thead>
                        <tr>
                        <th>S.NO</th>
                        <th>PROGRAMMES</th>
                        <th>MAJOR</th>
                        <th>YEAR OF AFFILIATION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>23</td>
                        <td>Certificate Course</td>
                        <td>Diploma on Computer Application (DCA)</td>
                        <td>2013</td>
                        </tr>
                        <tr>
                        <td>24</td>
                        <td>Certificate Course</td>
                        <td>Post Graduate Diploma in Computer Application (PGDCA)</td>
                        <td>2014</td>
                        </tr>
                        <tr>
                        <td>25</td>
                        <td>Certificate Course</td>
                        <td>Library Science</td>
                        <td>2017</td>
                        </tr>
                    </tbody>
                </table>
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



        <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>


<!-- Mirrored from live.themewild.com/eduka/about.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:37:27 GMT -->
</html>