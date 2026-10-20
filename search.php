<?php
include('admin/db.php');

$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];

// Define page keywords for direct redirection
$pageRedirects = [
    'admission' => 'feesdetail.php',
    'fee' => 'feesdetail.php',
    'fees' => 'feesdetail.php',
    'apply' => 'application-form.php',
    'application' => 'application-form.php',
    'contact' => 'contact.php',
    'about' => 'institution.php',
    'institution' => 'institution.php',
    'library' => 'library.php',
    'hostel' => 'hostel.php',
    'placement' => 'placement.php',
    'exam' => 'exam.php',
    'examination' => 'exam.php',
    'alumni' => 'alumni.php',
    'faculty' => 'faculty.php',
    'courses' => 'ug.php',
    'ug' => 'ug.php',
    'pg' => 'pg.php',
    'laboratory' => 'lab.php',
    'lab' => 'lab.php',
    'sports' => 'sports.php',
    'ncc' => 'ncc-nss.php',
    'nss' => 'ncc-nss.php',
    'principal' => 'principal.php',
    'management' => 'management.php',
    'iqac' => 'iqac.php',
    'research' => 'research.php',
    'event' => 'event.php',
    'events' => 'event.php',
    'news' => 'event.php',
    'gallery' => 'gallery.php',
    'calendar' => 'calender.php',
    'bus' => 'bus-facility.php',
    'transport' => 'bus-facility.php',
];

// Check if search query matches any page keyword
if (!empty($searchQuery)) {
    $lowerQuery = strtolower($searchQuery);
    
    // Check for exact match first
    if (isset($pageRedirects[$lowerQuery])) {
        header("Location: " . $pageRedirects[$lowerQuery]);
        exit;
    }
    
    // Check for partial match
    foreach ($pageRedirects as $keyword => $page) {
        if (strpos($lowerQuery, $keyword) !== false) {
            header("Location: " . $page);
            exit;
        }
    }
    
    // If no page match, search in database
    $searchTerm = mysqli_real_escape_string($conn, $searchQuery);
    
    // Search in news updates
    $newsQuery = "SELECT 'news' as type, id, title, description, date, pdf 
                  FROM newsupdate 
                  WHERE title LIKE '%$searchTerm%' 
                  OR description LIKE '%$searchTerm%' 
                  ORDER BY date DESC";
    
    $newsResults = mysqli_query($conn, $newsQuery);
    
    while($row = mysqli_fetch_assoc($newsResults)) {
        $results[] = $row;
    }
}
?>

<?php
include 'admin/db.php';
?>
<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - TKS College</title>
    
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.jpg">
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
        
        .search-header {
            background: linear-gradient(135deg, #667eea 0%, rgba(1, 39, 88, .85) 100%);
            padding: 120px 0 60px;
            color: white;
            margin-top: 0;
        }
        
        .search-box-wrapper {
            max-width: 700px;
            margin: 0 auto;
        }
        
        .search-input-group {
            position: relative;
            margin-top: 30px;
        }
        
        .search-input {
            width: 100%;
            padding: 18px 60px 18px 25px;
            border-radius: 50px;
            border: none;
            font-size: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        
        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
        }
        
        .search-results-section {
            padding: 60px 0;
            min-height: 60vh;
            background: #f5f7fa;
        }
        
        .result-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }
        
        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .result-type {
            display: inline-block;
            padding: 5px 15px;
            background: #667eea;
            color: white;
            border-radius: 20px;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .result-title {
            font-size: 24px;
            color: #1e3c72;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .result-title a {
            color: #1e3c72;
            text-decoration: none;
        }
        
        .result-title a:hover {
            color: #667eea;
        }
        
        .result-date {
            color: #999;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .result-date i {
            margin-right: 5px;
        }
        
        .result-description {
            color: #666;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        
        .result-meta {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .pdf-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: #ffebee;
            color: #f44336;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .pdf-link:hover {
            background: #f44336;
            color: white;
        }
        
        .no-results {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }
        
        .no-results i {
            font-size: 64px;
            color: #e0e0e0;
            margin-bottom: 20px;
        }
        
        .no-results h3 {
            color: #666;
            margin-bottom: 15px;
            font-size: 28px;
        }
        
        .no-results p {
            color: #999;
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        .no-results a {
            color: #667eea;
            font-weight: 600;
        }
        
        .search-stats {
            color: rgba(255,255,255,0.9);
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }
        
        .search-stats strong {
            color: white;
            font-weight: 700;
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 25px;
            background: rgba(255,255,255,0.2);
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .back-btn:hover {
            background: rgba(255,255,255,0.3);
            color: white;
        }

        .quick-links {
            margin-top: 30px;
            text-align: center;
        }

        .quick-links p {
            color: rgba(255,255,255,0.9);
            margin-bottom: 15px;
        }

        .page-suggestions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 15px;
        }

        .page-link-btn {
            padding: 8px 20px;
            background: rgba(255,255,255,0.2);
            color: white;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            backdrop-filter: blur(10px);
        }

        .page-link-btn:hover {
            background: white;
            color: #667eea;
        }
        
        @media (max-width: 768px) {
            .search-header {
                padding: 100px 0 40px;
            }
            
            .result-title {
                font-size: 20px;
            }
            
            .result-card {
                padding: 20px;
            }
            
            .search-header h1 {
                font-size: 28px;
            }
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
        <div class="search-header">
            <div class="container">
                <div class="search-box-wrapper">
                    <a href="index.php" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                    <h1 class="text-center mb-3">Search Results</h1>
                    <form method="GET" action="search.php">
                        <div class="search-input-group">
                            <input 
                                type="text" 
                                name="q" 
                                class="search-input" 
                                placeholder="Search for news, events, courses..." 
                                value="<?= htmlspecialchars($searchQuery) ?>"
                                required
                            >
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <?php if (!empty($searchQuery)): ?>
                        <div class="search-stats">
                            Found <strong><?= count($results) ?></strong> result<?= count($results) != 1 ? 's' : '' ?> for "<strong><?= htmlspecialchars($searchQuery) ?></strong>"
                        </div>
                    <?php endif; ?>

                    <div class="quick-links">
                        <p>Quick Access to Popular Pages:</p>
                        <div class="page-suggestions">
                            <a href="feesdetail.php" class="page-link-btn">Admission & Fees</a>
                            <a href="application-form.php" class="page-link-btn">Apply Now</a>
                            <a href="ug.php" class="page-link-btn">UG Courses</a>
                            <a href="pg.php" class="page-link-btn">PG Courses</a>
                            <a href="library.php" class="page-link-btn">Library</a>
                            <a href="hostel.php" class="page-link-btn">Hostel</a>
                            <a href="placement.php" class="page-link-btn">Placement</a>
                            <a href="event.php" class="page-link-btn">Events</a>
                            <a href="contact.php" class="page-link-btn">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="search-results-section">
            <div class="container">
                <?php if (!empty($searchQuery)): ?>
                    <?php if (count($results) > 0): ?>
                        <?php foreach ($results as $result): ?>
                            <div class="result-card">
                                <span class="result-type">
                                    <i class="fas fa-newspaper"></i> News Update
                                </span>
                                
                                <h3 class="result-title">
                                    <?= htmlspecialchars($result['title']) ?>
                                </h3>
                                
                                <?php if (isset($result['date'])): ?>
                                    <div class="result-date">
                                        <i class="far fa-calendar"></i>
                                        <?= date('F d, Y', strtotime($result['date'])) ?>
                                    </div>
                                <?php endif; ?>
                                
                                <p class="result-description">
                                    <?= htmlspecialchars($result['description']) ?>
                                </p>
                                
                                <div class="result-meta">
                                    <?php if (!empty($result['pdf'])): ?>
                                        <?php
                                        $pdfPath = "admin/uploads/" . rawurlencode($result['pdf']);
                                        $serverPath = "admin/uploads/" . $result['pdf'];
                                        if (file_exists($serverPath)):
                                        ?>
                                            <a href="<?= $pdfPath ?>" target="_blank" class="pdf-link">
                                                <i class="fas fa-file-pdf"></i> View PDF
                                            </a>
                                            <a href="?download=<?= urlencode($result['pdf']) ?>" class="pdf-link">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-results">
                            <i class="fas fa-search"></i>
                            <h3>No Results Found</h3>
                            <p>We couldn't find any results matching "<strong><?= htmlspecialchars($searchQuery) ?></strong>"</p>
                            <p>Try the quick links above or browse our <a href="index.php">homepage</a></p>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="no-results">
                        <i class="fas fa-search"></i>
                        <h3>Start Your Search</h3>
                        <p>Enter keywords above to search for news, events, courses, and more</p>
                        <p>Or use the quick access links above to navigate directly to popular pages</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- footer area -->
    <footer class="footer-area">
        <div class="footer-widget">
            <div class="container">
                <div class="row footer-widget-wrapper pt-100 pb-70 align-items-start">
                    <div class="col-md-6 col-lg-4">
                        <div class="footer-widget-box about-us">


                            <p class="mb-3">
                                TKS College is dedicated to providing quality education, fostering research,
                                and nurturing students to excel academically and professionally.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Quick Links</h4>
                            <ul class="footer-list">
                                <li><a href="index.php"><i class="fas fa-caret-right"></i>Home</a></li>
                                <li><a href="institution.php"><i class="fas fa-caret-right"></i>About Us</a></li>
                                <li><a href="contact.php"><i class="fas fa-caret-right"></i>Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Contact</h4>
                            <ul class="footer-contact">
                                <li><i class="far fa-map-marker-alt"></i> TKS College of Arts & Science, Kammavar Nagar, Koduvilarpatti, Theni - 625531</li>
                                <li><a href="tel:+04546-250882"><i class="far fa-phone"></i>04546-250882</a></li>
                                <li><a href="mailto:tksclgas@gmail.com"><i class="far fa-envelope"></i>tksclgas@gmail.com</a></li>
                            </ul>
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
                                Copyright © 2024 <a href="https://nearlooks.in/">Nearlook - Mart Pvt Ltd,</a> All Rights Reserved.
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
    
    <script src="assets/js/jquery-3.7.1.min.js"></script>
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
</body>
</html>