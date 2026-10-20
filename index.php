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

    // ✅ Handle download inside same file
    if (isset($_GET['download'])) {
        $file = basename($_GET['download']);
        $path = "admin/uploads/" . $file;

        if (!file_exists($path)) {
            die("File not found.");
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }

    // ✅ Fetch news data from DB
    $news = [];
    if (!$isSearching) {
        $getNews = mysqli_query($conn, "SELECT * FROM newsupdate ORDER BY id DESC");

        while($row = mysqli_fetch_assoc($getNews)) {
            $pdfInfo = null;
            if (!empty($row['pdf'])) {
                $browserPath = "admin/uploads/" . rawurlencode($row['pdf']);
                $serverPath  = "admin/uploads/" . $row['pdf'];
                if (file_exists($serverPath)) {
                    $sizeKB = round(filesize($serverPath) / 1024, 2) . " KB";
                    $pdfInfo = [
                        "name" => $row['pdf'],
                        "size" => $sizeKB,
                        "view" => $browserPath,
                        "download" => $row['pdf']
                    ];
                }
            }

            $news[] = [
                "id" => $row['id'],
                "title" => $row['title'],
                "date" => $row['date'],
                "description" => $row['description'],
                "pdf" => $pdfInfo
            ];
        }
    }

    // Get hero slides
    $slides = mysqli_query($conn, "SELECT * FROM herosection WHERE active=1 ORDER BY id DESC");

    // Get active popup banner (from admin/popup.php)
    $popupRow = null;
    $tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'popup_banner'");
    if ($tableCheck && mysqli_num_rows($tableCheck) > 0) {
        $popupRes = mysqli_query($conn, "SELECT * FROM popup_banner WHERE active = 1 ORDER BY id DESC LIMIT 1");
        if ($popupRes) $popupRow = mysqli_fetch_assoc($popupRes);
    }
?>

<!DOCTYPE html><html lang="en">



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
    <link rel="stylesheet" href="assets/css/style.css?v=2">
    <link rel="stylesheet" href="assets/css/index.css">
  
    <style>

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
    </div>
    <!-- header area end -->

 <!-- Search Modal -->




    <main class="main">

            <div id="aboutCarousel" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicators -->
                <div class="carousel-indicators">
                    <?php 
                    $i = 0;
                    $slides->data_seek(0);
                    while($row = mysqli_fetch_assoc($slides)) { ?>
                        <button type="button" data-bs-target="#aboutCarousel" data-bs-slide-to="<?= $i ?>" class="<?= $i==0?'active':'' ?>"></button>
                    <?php $i++; } ?>
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    <?php 
                    $i = 0;
                    $slides->data_seek(0);
                    while($row = mysqli_fetch_assoc($slides)) { 
                    ?>

                        <?php if ($row['type'] == 'image') { ?>
                            <!-- IMAGE SLIDE -->
                            <div class="carousel-item <?= $i==0?'active':'' ?>">
                                <img src="admin/uploads/<?= $row['file_path'] ?>" class="d-block w-100" alt="Slide Image">
                            </div>

                        <?php } else if ($row['type'] == 'video') { ?>
                            <!-- VIDEO SLIDE -->
                            <div class="carousel-item <?= $i==0?'active':'' ?>" data-bs-interval="false">
                                <div class="ratio ratio-16x9">
                                    <video class="w-100" autoplay muted loop playsinline>
                                        <source src="admin/uploads/<?= $row['file_path'] ?>" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                        <?php } ?>

                    <?php 
                    $i++; 
                    } 
                    ?>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>




        <!-- Hero Slider -->
        <!-- <div class="hero-section">
            <div class="hero-slider owl-carousel owl-theme" >

                <?php while ($row = mysqli_fetch_assoc($slides)) { ?>

                    <?php if ($row['type'] == 'image') { ?>
                        
                       
                        <div class="hero-single hero-single-img" style="position: relative; background: url('admin/uploads/<?php echo $row['file_path']; ?>') no-repeat center center/cover;">
                            <div class="hero-overlay"></div>
                        </div>

                    <?php } else { ?>

                       
                        <div class="hero-single" style="position: relative;" >
                            <video autoplay muted playsinline loop
                                class="hero-video"
                                style="width:100%; object-fit:cover;">
                                <source src="admin/uploads/<?php echo $row['file_path']; ?>" type="video/mp4">
                            </video>
                            <div class="hero-overlay"></div>
                        </div>

                    <?php } ?>

                <?php } ?>

            </div>
        </div> -->


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




        <!-- about area -->
        <div class="about-area">
            <div class="container">
                <div class="row g-4">

                    <!-- Left Side (Content) -->
                    <div class="col-lg-8">
                        <div class="about-content">
                            <div class="site-heading mb-4">
                                <span class="site-title-tagline">
                                    <i class="far fa-book-open-reader"></i> About Us
                                </span>
                                <h2 class="site-title mb-0">
                                    Welcome to <span>TKS COLLEGE</span>
                                </h2>
                                <div class="title-underline"></div>
                            </div>

                            <div class="content-text">
                                <p class="mb-4">
                                    TKS Arts and Science College is a self-financing, co-educational institution committed to providing quality higher 
                                    education in arts, science, and allied disciplines. The college functions with the vision of nurturing academic 
                                    excellence, ethical values, and social responsibility among students, preparing them for professional and societal 
                                    challenges.
                                </p>

                                <p class="mb-4">
                                    Established with the objective of making higher education accessible to students from rural and semi-urban 
                                    backgrounds, TKS Arts and Science College operates under a dedicated management that emphasizes discipline, 
                                    innovation, and holistic development. The institution is affiliated with a recognized university and follows a 
                                    curriculum aligned with contemporary academic and industry requirements.
                                </p>

                                <p>
                                    TKS Arts and Science College places equal importance on academic achievement and community engagement. Through 
                                    various extension activities, outreach programs, and social initiatives, the institution actively contributes 
                                    to the development of society while instilling a sense of social responsibility and leadership among students.
                                </p>
                            </div>


                            <div class="about-bottom d-flex align-items-center gap-4 mt-5">
                                <!-- Discover Button -->
                                <a href="institution.php" class="theme-btn">
                                    Discover More <i class="fas fa-arrow-right-long"></i>
                                </a>

                                <!-- Phone Section -->
                                <div class="about-phone d-flex align-items-center">
                                    <div class="icon me-2">
                                        <i class="fal fa-headset fa-2x text-danger"></i>
                                    </div>
                                    <div class="number">
                                        <span>Call Now</span>
                                        <h6><a href="tel:+04546250882">04546-250882</a></h6>
                                    </div>
                                </div>

                                <!-- YouTube Video Popup Trigger -->
                                <div class="video-btn d-flex align-items-center justify-content-center"
                                    onclick="openVideoModal()">
                                    <i class="fab fa-youtube"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side (News & Updates) -->
                    <div class="col-lg-4">
                        <div class="news-updates-sidebar">
                            <div class="sidebar-header">
                                <h3>News & <span>Events</span></h3>
                                <div class="header-underline"></div>
                            </div>

                            <div class="news-list" id="newsScroller">
                                <div class="news-scroll-content">
                                    <?php foreach ($news as $index => $item): 
                                        $date = date_create($item['date']);
                                        $day = date_format($date, "d");
                                        $month = date_format($date, "M Y");
                                    ?>
                                    <div class="news-item">
                                        <div class="news-date-circle">
                                            <span class="date-number"><?= $day ?></span>
                                        </div>
                                        
                                        <div class="news-details">
                                            <div class="news-meta">
                                                <?= date_format($date, "d M Y") ?>
                                            </div>
                                            <h4 class="news-item-title">
                                                <?= $item['title'] ?>
                                            </h4>
                                            <p class="news-item-desc">
                                                <?= $item['description'] ?>
                                            </p>
                                            <div class="news-actions">
                                                <?php if (isset($item['link'])): ?>
                                                <a href="<?= $item['link'] ?>" class="news-link">
                                                    More Details <i class="fas fa-arrow-right"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (isset($item['pdf'])): ?>
                                                    <a href="<?= $item['pdf']['view'] ?>" target="_blank" class="pdf-badge">
                                                        <i class="fas fa-file-pdf"></i> View PDF
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- about area end -->



        <script>
            // Duplicate news items for seamless infinite scroll
            document.addEventListener('DOMContentLoaded', function() {
                const newsScroller = document.getElementById('newsScroller');
                const scrollContent = newsScroller.querySelector('.news-scroll-content');
                
                // Clone the content for seamless loop
                const clone = scrollContent.cloneNode(true);
                newsScroller.appendChild(clone);
                
                // Adjust animation duration based on content height
                const contentHeight = scrollContent.offsetHeight;
                const duration = contentHeight / 20; // Adjust speed (lower = faster)
                scrollContent.style.animationDuration = duration + 's';
                clone.style.animationDuration = duration + 's';
            });
        </script>




        <!-- ✅ Video Popup Modal -->
        <div id="videoModal" class="video-modal">
            <div class="video-content">
                <span class="close" onclick="closeVideoModal()">&times;</span>
                <iframe id="youtubeFrame" width="100%" height="400" frameborder="0" allow="autoplay; encrypted-media"
                    allowfullscreen></iframe>
            </div>
        </div>


        <!-- counter area -->
        <div class="counter-area pt-60 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <img src="assets/img/icon/course.svg" alt="">
                            </div>
                            <div>
                                <span class="counter" data-count="+" data-to="22" data-speed="3000">22</span>
                                <h6 class="title"> Total Cources </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <img src="assets/img/icon/graduation.svg" alt="">
                            </div>
                            <div>
                                <span class="counter" data-count="+" data-to="1108" data-speed="3000">1108</span>
                                <h6 class="title"> Our Students</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <img src="assets/img/icon/teacher-2.svg" alt="">
                            </div>
                            <div>
                                <span class="counter" data-count="+" data-to="90" data-speed="3000">90</span>
                                <h6 class="title"> Skilled Lecturers</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <img src="assets/img/icon/award.svg" alt="">
                            </div>
                            <div>
                                <span class="counter" data-count="+" data-to="30" data-speed="3000">30</span>
                                <h6 class="title"> Win Awards</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- counter area end -->




    

        <!-- Modal -->
        <div class="modal" id="newsModal">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close-modal" onclick="closeModal()">&times;</button>
                    <div class="modal-date" id="modalDate"></div>
                    <h2 class="modal-title" id="modalTitle"></h2>
                </div>
                <div class="modal-body">
                    <p class="modal-description" id="modalDescription"></p>
                </div>
                <div class="modal-footer" id="modalFooter"></div>
            </div>
        </div>



        <script>
            let newsData = <?php echo json_encode($news); ?>;

            let autoScrollInterval = null;
            const SCROLL_SPEED = 3000;
            const SCROLL_AMOUNT = 380;





            function scrollNews(direction) {
                const newsGrid = document.getElementById('newsGrid');
                newsGrid.scrollBy({
                    left: direction === 'left' ? -SCROLL_AMOUNT : SCROLL_AMOUNT,
                    behavior: 'smooth'
                });
                setTimeout(updateScrollButtons, 300);
            }

            function updateScrollButtons() {
                const newsGrid = document.getElementById('newsGrid');
                const leftBtn = document.getElementById('scrollLeft');
                const rightBtn = document.getElementById('scrollRight');

                if (leftBtn) leftBtn.disabled = newsGrid.scrollLeft <= 0;
                if (rightBtn) rightBtn.disabled = newsGrid.scrollLeft >= newsGrid.scrollWidth - newsGrid.clientWidth - 10;
            }

            function startAutoScroll() {
                if (autoScrollInterval) clearInterval(autoScrollInterval);

                const newsGrid = document.getElementById('newsGrid');

                autoScrollInterval = setInterval(() => {
                    const maxScroll = newsGrid.scrollWidth - newsGrid.clientWidth;

                    if (newsGrid.scrollLeft >= maxScroll) {
                        newsGrid.scrollTo({ left: 0, behavior: 'smooth' });
                    } else {
                        newsGrid.scrollBy({ left: SCROLL_AMOUNT, behavior: 'smooth' });
                    }
                    setTimeout(updateScrollButtons, 300);
                }, SCROLL_SPEED);
            }

            window.onclick = function (event) {
                const modal = document.getElementById('newsModal');
                if (event.target === modal) closeModal();
            }

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') closeModal();
            });

            document.getElementById('newsGrid').addEventListener('scroll', updateScrollButtons);

        </script>



        <!-- Side Tab Button -->
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
                                        <a href="admin-login.php">Admin Portal</a>
                                    </li>
                                    <li>
                                        <a href="contact.php">Contact us</a>
                                    </li>
                    <li class="translate-mobile"></li>


                </ul>
            </div>
        </div>







        
        <!-- department area -->
        <div class="department-area bg py-120">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">
                                <i class="far fa-book-open-reader"></i> Why Choose Us?
                            </span>
                            <h2 class="site-title">We are providing<span> THE BEST EDUCATIONAL SERVICE</span></h2>
                        </div>
                    </div>
                </div>

                <div class="dept-grid">

                    <!-- Card 1: Hostel -->
                    <div class="dept-card">
                        <div class="department-item">
                            <div class="department-img-top">
                                <img src="assets/img/facility/hostel.jpg" alt="Hostel">
                            </div>
                            <div class="department-info-bottom">
                                <h4 class="department-title"><a href="hostel.php">Hostel</a></h4>
                                <p>Hostel general code of conduct for students in college & hostel, ensuring safe and comfortable living.</p>
                                <div class="department-btn">
                                    <a href="hostel.php">Read More <i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Laboratory -->
                    <div class="dept-card">
                        <div class="department-item">
                            <div class="department-img-top">
                                <img src="assets/img/facility/c1.jpg" alt="Laboratory">
                            </div>
                            <div class="department-info-bottom">
                                <h4 class="department-title"><a href="lab.php">Laboratory</a></h4>
                                <p>Well-equipped labs for Computer, Physics and Chemistry with modern instruments and safety standards.</p>
                                <div class="department-btn">
                                    <a href="lab.php">Read More <i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Library -->
                    <div class="dept-card">
                        <div class="department-item">
                            <div class="department-img-top">
                                <img src="assets/img/facility/l2.jpg" alt="Library">
                            </div>
                            <div class="department-info-bottom">
                                <h4 class="department-title"><a href="library.php">Library</a></h4>
                                <p>All students and teaching staff are members of the library with access to thousands of books and resources.</p>
                                <div class="department-btn">
                                    <a href="library.php">Read More <i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Sports -->
                    <div class="dept-card">
                        <div class="department-item">
                            <div class="department-img-top">
                                <img src="assets/img/facility/sports.avif" alt="Sports">
                            </div>
                            <div class="department-info-bottom">
                                <h4 class="department-title"><a href="sports.php">Sports</a></h4>
                                <p>Extensive sports facilities encouraging students to participate in athletics, games and outdoor activities.</p>
                                <div class="department-btn">
                                    <a href="sports.php">Read More <i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5: Bus Facility -->
                    <div class="dept-card">
                        <div class="department-item">
                            <div class="department-img-top">
                                <img src="assets/img/facility/bus.jpg" alt="Bus Facility">
                            </div>
                            <div class="department-info-bottom">
                                <h4 class="department-title"><a href="bus-facility.php">Bus Facility</a></h4>
                                <p>Safe and reliable transportation covering all major routes to ensure students commute comfortably.</p>
                                <div class="department-btn">
                                    <a href="bus-facility.php">Read More <i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Placement -->
                    <div class="dept-card">
                        <div class="department-item">
                            <div class="department-img-top">
                                <img src="assets/img/facility/placement.avif" alt="Placement">
                            </div>
                            <div class="department-info-bottom">
                                <h4 class="department-title"><a href="placement.php">Placement</a></h4>
                                <p>Active placement cell connecting students with top companies and providing career guidance and training.</p>
                                <div class="department-btn">
                                    <a href="placement.php">Read More <i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- department area end -->


        <!-- quick links & downloads area -->
        <div class="quicklinks-area">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-7 mx-auto text-center">
                        <span class="site-title-tagline">
                            <i class="far fa-link"></i> Quick Access
                        </span>
                        <h2 class="site-title">Quick Links &amp; <span>Downloads</span></h2>
                        <p class="section-description">Find everything you need in one place — forms, portals, and key documents.</p>
                    </div>
                </div>

                <div class="row g-4">

                    <!-- Important Links -->
                    <div class="col-lg-4">
                        <div class="ql-box">
                            <div class="ql-box-header">
                                <i class="fas fa-external-link-alt"></i>
                                <h4>Important Links</h4>
                            </div>
                            <ul class="ql-list">
                                <li><a href="application-form.php"><i class="fas fa-caret-right"></i> Online Application Form</a></li>
                                <li><a href="feesdetail.php"><i class="fas fa-caret-right"></i> Fee Structure 2025–26</a></li>
                                <li><a href="calender.php"><i class="fas fa-caret-right"></i> Academic Calendar</a></li>
                                <li><a href="exam.php"><i class="fas fa-caret-right"></i> Examination Schedule</a></li>
                                <li><a href="iqac.php"><i class="fas fa-caret-right"></i> IQAC Reports</a></li>
                                <li><a href="nirf.php"><i class="fas fa-caret-right"></i> NIRF Data</a></li>
                                <li><a href="annual-reports.php"><i class="fas fa-caret-right"></i> Annual Reports</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Student Portals -->
                    <div class="col-lg-4">
                        <div class="ql-box">
                            <div class="ql-box-header">
                                <i class="fas fa-laptop-code"></i>
                                <h4>Student Portals</h4>
                            </div>
                            <ul class="ql-list">
                                <li><a href="login.php"><i class="fas fa-caret-right"></i> Student Feedback Portal</a></li>
                                <li><a href="alumni.php"><i class="fas fa-caret-right"></i> Alumni Registration</a></li>
                                <li><a href="placement.php"><i class="fas fa-caret-right"></i> Placement Cell</a></li>
                                <li><a href="event.php"><i class="fas fa-caret-right"></i> Events &amp; Achievements</a></li>
                                <li><a href="gallery.php"><i class="fas fa-caret-right"></i> Photo Gallery</a></li>
                                <li><a href="annoncements.php"><i class="fas fa-caret-right"></i> Announcements</a></li>
                                <li><a href="circulars.php"><i class="fas fa-caret-right"></i> Circulars &amp; Notices</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Download Centre -->
                    <div class="col-lg-4">
                        <div class="ql-box ql-box-accent">
                            <div class="ql-box-header">
                                <i class="fas fa-download"></i>
                                <h4>Download Centre</h4>
                            </div>
                            <div class="ql-downloads">
                                <a href="assets/img/campus-life/ConferenceNCFM26.pdf" target="_blank" class="ql-download-item">
                                    <div class="ql-dl-icon"><i class="fas fa-file-pdf"></i></div>
                                    <div class="ql-dl-info">
                                        <span class="ql-dl-name">NCFM'26 Brochure</span>
                                        <span class="ql-dl-type">PDF Document</span>
                                    </div>
                                    <i class="fas fa-arrow-down ql-dl-arrow"></i>
                                </a>
                                <a href="feesdetail.php" class="ql-download-item">
                                    <div class="ql-dl-icon"><i class="fas fa-file-alt"></i></div>
                                    <div class="ql-dl-info">
                                        <span class="ql-dl-name">Admission Prospectus</span>
                                        <span class="ql-dl-type">2025–26 Edition</span>
                                    </div>
                                    <i class="fas fa-arrow-down ql-dl-arrow"></i>
                                </a>
                                <a href="annual-reports.php" class="ql-download-item">
                                    <div class="ql-dl-icon"><i class="fas fa-file-chart-column"></i></div>
                                    <div class="ql-dl-info">
                                        <span class="ql-dl-name">Annual Report</span>
                                        <span class="ql-dl-type">Institutional Report</span>
                                    </div>
                                    <i class="fas fa-arrow-down ql-dl-arrow"></i>
                                </a>
                                <a href="iqac.php" class="ql-download-item">
                                    <div class="ql-dl-icon"><i class="fas fa-file-shield"></i></div>
                                    <div class="ql-dl-info">
                                        <span class="ql-dl-name">IQAC Report</span>
                                        <span class="ql-dl-type">Quality Report</span>
                                    </div>
                                    <i class="fas fa-arrow-down ql-dl-arrow"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- quick links & downloads area end -->


        <!-- testimonial area -->
        <div class="testimonial-area ts-bg pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Testimonials</span>
                            <h2 class="site-title text-white">What Our Students <span>Say</span></h2>
                            <p class="text-white">Hear from our students about their experience, learning environment,
                                and campus life.</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slider owl-carousel owl-theme">

                    <div class="testimonial-item">
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                The college provides excellent facilities and a friendly environment. The faculty
                                members are supportive and always encourage us to achieve our goals.
                            </p>
                        </div>
                        <div class="testimonial-content">

                            <div class="testimonial-author-info">
                                <h4>Deepika R</h4>
                                <p>B.Sc. Physics</p>
                            </div>
                        </div>
                        <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                    </div>

                    <div class="testimonial-item">
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                I am grateful for the practical knowledge I gained here. The labs are well equipped and
                                the regular workshops have boosted my confidence.
                            </p>
                        </div>
                        <div class="testimonial-content">

                            <div class="testimonial-author-info">
                                <h4>Arun Kumar</h4>
                                <p>B.Com</p>
                            </div>
                        </div>
                        <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                    </div>

                    <div class="testimonial-item">
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                The placement cell is very active and provides great opportunities. Thanks to the
                                training sessions, I was able to secure a job during campus recruitment.
                            </p>
                        </div>
                        <div class="testimonial-content">

                            <div class="testimonial-author-info">
                                <h4>Sneha Lakshmi</h4>
                                <p>BA.English</p>
                            </div>
                        </div>
                        <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                    </div>

                    <div class="testimonial-item">
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                Campus life here is vibrant with cultural events, seminars, and competitions. I enjoyed
                                every moment of my student life in this college.
                            </p>
                        </div>
                        <div class="testimonial-content">

                            <div class="testimonial-author-info">
                                <h4>Karthick M</h4>
                                <p>BCA</p>
                            </div>
                        </div>
                        <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                    </div>

                    <div class="testimonial-item">
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                The supportive faculty and well-structured curriculum helped me grow academically and
                                personally. I am proud to be an alumnus of this institution.
                            </p>
                        </div>
                        <div class="testimonial-content">

                            <div class="testimonial-author-info">
                                <h4>Priya S</h4>
                                <p>M.Sc. Computer Science</p>
                            </div>
                        </div>
                        <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                    </div>

                </div>
            </div>
        </div>
        <!-- testimonial area end -->



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


    <!-- js -->

    <script>
        if (!location.hostname.includes('127.0.0.1') && !location.hostname.includes('localhost')) {
            var s = document.createElement('script');
            s.src = '/cdn-cgi/scripts/5c5dd728/email-decode.min.js';
            s.setAttribute('data-cfasync', 'false');
            document.head.appendChild(s);
        }
    </script>

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
    <script src="assets/js/navbar-fix.js"></script>
    <script src="assets/js/main.js"></script>                                           <script src="assets/js/sidebar.js"></script>





    <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper(".feature-swiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                882: {
                    slidesPerView: 4, // desktop view
                    autoplay: false,  // disable auto slider on desktop
                }
            }
        });
    </script>

    <script>
        function openVideoModal() {
            const videoID = "5rvUsNuvvzU"; // Your correct video ID
            document.getElementById("youtubeFrame").src =
                "https://www.youtube.com/embed/" + videoID + "?autoplay=1";

            document.getElementById("videoModal").style.display = "flex";
        }

        function closeVideoModal() {
            document.getElementById("videoModal").style.display = "none";
            document.getElementById("youtubeFrame").src = ""; // stop video
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll("video").forEach(video => {
                video.addEventListener("timeupdate", () => {
                    if (video.currentTime > 16) {
                        video.pause();
                        video.currentTime = 0;
                    }
                });
            });
        });
    </script>


    <!-- JavaScript -->
    
    <script>
        function openSearchModal() {
            document.getElementById('searchModal').classList.add('active');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                document.getElementById('searchInput').focus();
            }, 100);
        }
        
        function closeSearchModal() {
            document.getElementById('searchModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        
        function quickSearch(term) {
            document.getElementById('searchInput').value = term;
            document.getElementById('searchForm').submit();
        }
        
        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSearchModal();
            }
        });
        
        // Close when clicking outside
        document.getElementById('searchModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSearchModal();
            }
        });

        // Auto-open modal if there's a search query
        <?php if ($isSearching): ?>
            window.addEventListener('load', function() {
                openSearchModal();
            });
        <?php endif; ?>
    </script>

    

    <script>
                // Mobile multi-level dropdown fix
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.dropdown-submenu > a.dropdown-toggle').forEach(function (el) {
                el.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var submenu = this.nextElementSibling;
                    // Close all other open submenus
                    document.querySelectorAll('.dropdown-submenu .dropdown-menu.show').forEach(function (m) {
                        if (m !== submenu) m.classList.remove('show');
                    });
                    submenu.classList.toggle('show');
                });
            });

            // Close submenus when main dropdown closes
            document.querySelectorAll('.dropdown').forEach(function (dropdown) {
                dropdown.addEventListener('hidden.bs.dropdown', function () {
                    this.querySelectorAll('.dropdown-menu.show').forEach(function (m) {
                        m.classList.remove('show');
                    });
                });
            });
        });
    </script>



<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<?php if ($popupRow && !empty($popupRow['image'])): ?>
<!-- ===== HOME POPUP – appears 5 s after page load ===== -->
<div id="homePopupOverlay">
    <div id="homePopupBox">
        <button id="homePopupClose" onclick="closeHomePopup()" aria-label="Close">&times;</button>
        <?php if (!empty($popupRow['link'])): ?>
            <a href="<?= htmlspecialchars($popupRow['link']) ?>" target="_blank" rel="noopener noreferrer">
                <img src="admin/uploads/<?= htmlspecialchars($popupRow['image']) ?>" alt="Announcement">
            </a>
        <?php else: ?>
            <img src="admin/uploads/<?= htmlspecialchars($popupRow['image']) ?>" alt="Announcement">
        <?php endif; ?>
    </div>
</div>

<style>
    #homePopupOverlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.68);
        z-index: 999999;
        align-items: center;
        justify-content: center;
        animation: hpFadeIn 0.35s ease forwards;
    }
    #homePopupOverlay.visible {
        display: flex;
    }
    @keyframes hpFadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    #homePopupBox {
        position: relative;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 24px 70px rgba(0, 0, 0, 0.45);
        max-width: 540px;
        width: 92%;
        overflow: hidden;
        animation: hpSlideUp 0.38s cubic-bezier(.22,.68,0,1.2) forwards;
    }
    @keyframes hpSlideUp {
        from { transform: translateY(50px) scale(0.96); opacity: 0; }
        to   { transform: translateY(0)    scale(1);    opacity: 1; }
    }
    #homePopupBox img {
        width: 100%;
        display: block;
        /*max-height: 500px;*/
        object-fit: contain;
        background: #f4f4f4;
    }
    #homePopupBox a {
        display: block;
        line-height: 0;
    }
    #homePopupClose {
        position: absolute;
        top: 10px;
        right: 12px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background: rgba(0, 0, 0, 0.55);
        color: #fff;
        font-size: 22px;
        line-height: 1;
        cursor: pointer;
        z-index: 10;
        transition: background 0.2s, transform 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #homePopupClose:hover {
        background: rgba(0, 0, 0, 0.85);
        transform: scale(1.1);
    }
</style>

<script>
    (function () {
        var overlay = document.getElementById('homePopupOverlay');

        function openHomePopup() {
            overlay.classList.add('visible');
        }

        function closeHomePopup() {
            overlay.style.animation = 'hpFadeIn 0.25s ease reverse forwards';
            setTimeout(function () {
                overlay.classList.remove('visible');
                overlay.style.animation = '';
            }, 240);
        }

        // Expose globally so the inline onclick can reach it
        window.closeHomePopup = closeHomePopup;

        // Show after 5 seconds
        setTimeout(openHomePopup, 5000);

        // Close on backdrop click
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeHomePopup();
        });

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeHomePopup();
        });
    })();
</script>
<!-- ===== END HOME POPUP ===== -->
<?php endif; ?>

</body>


</html>

