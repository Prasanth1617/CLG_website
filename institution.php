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
    <meta name="description" content="About Theni Kammavar Sangam College of Arts &amp; Science, Theni: the institution and its history.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:title" content="About Institution – Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:description" content="About Theni Kammavar Sangam College of Arts &amp; Science, Theni: the institution and its history.">
    <meta property="og:image" content="https://www.tkscas.com/assets/img/logo/logo.jpg">
    <meta name="keywords" content="">

    <!-- title -->
    <title>About Institution – Theni Kammavar Sangam College of Arts &amp; Science</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.jpg">

    <!-- css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/institution.css">

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

 <!-- Search Modal -->

        <!-- breadcrumb -->
        <div id="main-content" class="site-breadcrumb" style="background: url(assets/img/gallery/college-bg.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">About Institution</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">About Institution</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->
         <!-- Feature Area -->
     <?php include('scroll.php'); ?>
        <!-- feature area end -->
    <!-- Stats Bar -->
    <div class="institution-container">
        <div class="stats-bar">
            <div class="stat-item">
                <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="stat-number">14</div>
                <div class="stat-label">UG Programs</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                <div class="stat-number">08</div>
                <div class="stat-label">PG Programs</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="stat-number">90+</div>
                <div class="stat-label">Faculty Members</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fas fa-trophy"></i></div>
                <div class="stat-number">47</div>
                <div class="stat-label">University Ranks</div>
            </div>
        </div>
    </div>

    <!-- Add this after the stats bar section and before the main content section -->

    <!-- Vision & Mission Section -->
    <section class="services py-5">
        <div class="container py-5">        
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow p-5 d-flex flex-column justify-content-center align-items-center">
                        <div class="anim-layer"></div>
                        <i class="display-5 mb-3">
                            <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" fill="#000000" width="60" height="60">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css"> .st0{fill:none;stroke:#ff0000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;} </style>
                                    <line class="st0" x1="16" y1="16" x2="22" y2="10"></line>
                                    <polygon class="st0" points="30,6 26,6 26,2 22,6 22,10 26,10 "></polygon>
                                    <circle class="st0" cx="16" cy="16" r="6"></circle>
                                    <path class="st0" d="M27,9c1.3,2,2,4.4,2,7c0,7.2-5.8,13-13,13S3,23.2,3,16S8.8,3,16,3c2.6,0,5,0.7,7,2"></path>
                                </g>
                            </svg>
                        </i>
                        <h2>Our Mission</h2>
                        <p class="text-center mb-0">To offer state of the art teaching and learning environment by maintaining right academic ambiance. To make our students globally responsible citizen by practicing values in life. <br></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow p-5 d-flex flex-column justify-content-center align-items-center">
                        <div class="anim-layer"></div>
                        <i class="display-5 mb-3">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="60" height="60">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z" fill="#ff0000"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 13.6394 2.42496 14.1915 3.27489 15.2957C4.97196 17.5004 7.81811 20 12 20C16.1819 20 19.028 17.5004 20.7251 15.2957C21.575 14.1915 22 13.6394 22 12C22 10.3606 21.575 9.80853 20.7251 8.70433C19.028 6.49956 16.1819 4 12 4C7.81811 4 4.97196 6.49956 3.27489 8.70433C2.42496 9.80853 2 10.3606 2 12ZM12 8.25C9.92893 8.25 8.25 9.92893 8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25Z" fill="#ff0000"></path>
                                </g>
                            </svg>
                        </i>
                        <h2>Our Vision</h2>
                        <p class="text-center mb-0">To establish our institution as a hub of excellence in arts, science, commerce and management studies giving equal focus to teaching, research and extension activities. <br><br></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow p-5 d-flex flex-column justify-content-center align-items-center">
                        <div class="anim-layer"></div>
                        <i class="display-5 mb-3">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="60" height="60">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 8L18 10L22 6" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                            </svg>
                        </i>
                        <h2 class="text-center">BEHAVIORAL POLICY</h2>
                        <p class="text-center mb-0">Our graduates are conscious of their responsibilities in nation building and they excel in their vocation by being globally responsible citizens.</p><br>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- department-single -->
    <!-- Main Content -->
    <div class="institution-container">
        <section class="content-section">
            <!-- Image Gallery -->
            <div class="image-gallery">
                <div class="gallery-item">
                    <img src="assets/img/gallery/admin-ajax (7).jpg" alt="College Campus">
                   
                </div>
                <div class="gallery-item">
                    <img src="assets/img/gallery/admin-ajax (6).jpg" alt="College Building">
                    
                </div>
            </div>

            <!-- Introduction -->
            <div class="content-box">
                <h2 class="section-title">Welcome to TKS College</h2>
                <p class="intro-text">
                    Theni Kammavar Sangam College of Arts and Science is an off shoot of Theni Kammavar Sangam. 
                    The institution was established with the noble objective of providing high quality education to
                    the socially and the economically challenged sections of the Theni district. The management nurtures
                    the vision of making the institution a hub of academic excellence in arts, science, commerce and management
                    studies giving equal focus to teaching, research and extension activities. In order to accomplish these,
                    the institution offers state of the art teaching and learning environment by maintaining right academic ambiance. 
                    The college was established in 2009 with 04 undergraduate courses, 247 students and 10 teaching faculty members.
                    Now it has leapfrogged to 12UG, 08 PG and 01 M.Phil courses 2 diploma courses. 
                    There are 110 well qualified teaching faculty members and adequate number of supporting staff.
                    Among them, there are 10 Ph.D holders and near about 15 members pursuing Ph.D. 
                    The college maintains excellent academic record and produces university ranks every year. In the year 2014-15, 
                    the institution was able to secure 05 university ranks (02 UG and 03 PG ranks). The institution is housed in a 
                    sprawling campus against sylvan settings overlooking the imposing mountains. There are well aerated and ventilated 
                    classrooms, state of the art laboratories, fully equipped computer laboratories, recycled drinking water facility 
                    and a modern library. The institution has a modern cafeteria with separate dining facilities for boys, girls and 
                    staff members. A fleet of buses enable the college students commute from their homes to the college and back.
                    There are well laid football and hockey grounds as well as basket ball courts. There are exclusive hostels for men and women.
                    In the academic year 2015-16, the major recruiters of the institution were Infosys BPO, Premier Mills and Muthoot Finance.
                    The college gives equal focus to aesthetic aspects of its learners. 
                    For this, there are several associations and clubs formed to serve as springboards for these kinds of activities.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-building"></i></div>
                    <h3 class="feature-title">World-Class Infrastructure</h3>
                    <p class="feature-text">Well aerated and ventilated classrooms, state of the art laboratories, fully equipped computer labs, and modern facilities.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-bus"></i></div>
                    <h3 class="feature-title">Transportation</h3>
                    <p class="feature-text">A fleet of buses enables students to commute safely from their homes to the college and back.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-utensils"></i></div>
                    <h3 class="feature-title">Modern Cafeteria</h3>
                    <p class="feature-text">Separate dining facilities for boys, girls, and staff members with hygienic food service.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-bed"></i></div>
                    <h3 class="feature-title">Hostel Facilities</h3>
                    <p class="feature-text">Exclusive hostels for men and women with comfortable accommodation and security.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-running"></i></div>
                    <h3 class="feature-title">Sports Facilities</h3>
                    <p class="feature-text">Well laid football and hockey grounds, basketball courts for overall development.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-briefcase"></i></div>
                    <h3 class="feature-title">Placement Support</h3>
                    <p class="feature-text">Strong placement support with recruiters like Infosys BPO, Premier Mills, and Sakthi Knitting Ltd.</p>
                </div>
            </div>

            <!-- College Profile -->
            <div class="profile-section">
                <div class="profile-header">
                    <div class="profile-icon"><i class="fas fa-university"></i></div>
                    <h2 class="section-title">College Profile</h2>
                </div>
                <ul class="profile-list">
                    <li>
                        <i class="far fa-check-circle"></i>
                        <p>Theni Kammavar Sangam College of Arts and Science is an off shoot of Theni Kammavar Sangam. 
                            The institution was established with the noble objective of providing high quality education to the
                            socially and the economically challenged sections of the Theni district. The management nurtures the vision of making 
                            the institution a hub of academic excellence in arts, science, and commerce and management studies giving equal focus to teaching,
                            research and extension activities. In order to accomplish these, the institution offers state of the art teaching and learning 
                            environment by maintaining right academic ambience. The college was established in 2009 with 04 undergraduate courses, 
                            247 students and 10 teaching faculty members. Now it has leapfrogged to 12 UG, 08 PG and 01 M.Phil courses. There are 110 well 
                            qualified teaching faculty members and adequate number of supporting staff. Among them, there are 10 Ph.D holders and near 
                            about 15 members pursuing Ph.D. The college maintains excellent academic record and produces university ranks every year.</p>
                    </li>
                    <li>
                        <i class="far fa-check-circle"></i>
                        <p>In the year 2014-15, the institution was able to secure 05 university ranks (02 UG and 03 PG ranks). The institution is housed in
                            a sprawling campus against sylvan settings overlooking the imposing mountains. There are well aerated and ventilated classrooms,
                            state of the art laboratories, fully equipped computer laboratories, recycled drinking water facility and a modern library.
                            The institution has a modern cafeteria with separate dining facilities for boys, girls and staff members.</p>
                    </li>
                    <li>
                        <i class="far fa-check-circle"></i>
                        <p>A fleet of buses enable the college students commute from their homes to the college and back.
                            There are well laid football and hockey grounds as well as basket ball courts. There are exclusive hostels for men and women. 
                            In the academic year 2015-16, the major recruiters of the institution were Infosys BPO, Premier Mills and Sakthi Knitting Ltd. 
                            The college gives equal focus to aesthetic aspects of its learners.
                            For this, there are several associations and clubs formed to serve as springboards for these kinds of activities.</p>
                    </li>
                </ul>
            </div>
        </section>
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
        <img loading="lazy" decoding="async" src="assets/img/shape/03.png" alt="">
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

    <script>
        
    </script>
</body>


<!-- Mirrored from live.themewild.com/eduka/about.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:37:27 GMT -->
</html>