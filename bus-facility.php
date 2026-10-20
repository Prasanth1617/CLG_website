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

.pg-course{
    margin-top:-300px;
}

.course-single-list li{
    margin-top: 20px !important;
}

  :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
            --text-dark: #5a5c69;
            --text-light: #858796;
        }
        
     
        
        .pricing-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .pricing-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2rem 0;
        }
        
        .toggle-label {
            margin: 0 1rem;
            font-weight: 600;
        }
        
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .slider {
            background-color: var(--primary-color);
        }
        
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        
        .pricing-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s;
            overflow: hidden;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 2rem;
        }
        
        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
        }
        
        .pricing-card.popular {
            border: 2px solid var(--primary-color);
            position: relative;
        }
        
        .popular-badge {
            position: absolute;
            top: 0;
            right: 20px;
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .price {
            font-size: 2.5rem;
            font-weight: 700;
        }
        
        .period {
            font-size: 1rem;
            color: var(--text-light);
        }
        
        .features-list {
            padding: 0;
            list-style: none;
        }
        
        .features-list li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .features-list li:last-child {
            border-bottom: none;
        }
        
        .bi-check-circle-fill {
            color: #1cc88a;
            margin-right: 0.5rem;
        }
        
        .bi-x-circle-fill {
            color: #e74a3b;
            margin-right: 0.5rem;
        }
        
        .tooltip-icon {
            color: var(--primary-color);
            margin-left: 0.3rem;
            cursor: pointer;
        }
        
        .btn-pricing {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            width: 100%;
        }
        
        .btn-pricing:hover {
            background-color: var(--accent-color);
        }
        
        .feature-comparison {
            margin-top: 3rem;
        }
        
        .comparison-table {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            overflow: hidden;
        }
        
        @media (max-width: 768px) {
            .pricing-card {
                margin-bottom: 2rem;
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

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/gallery/college-bg.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Bus Facility</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Bus Facility</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->
             <?php include('scroll.php'); ?>


        <!-- course-single -->
        <div class="course-single-area py-120">
            <div class="container">
                <div class="course-single-wrapper">
                    <div class="row">
                        <div class="col-xl-12 col-lg-10">
                            <div class="course-details ">
                                <div class="course-details-img mb-30 row justify-content-center">
                                    <div class="col-12 text-center">
                                        <img src="assets/img/facility/bus.jpg" alt="thumb" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
  
        <div class="container py-5">
    
        
        <div class="row">
            <div class="col-lg-4">
                <div class="pricing-card">
                    <div class="card-header">
                        <h3>CHINNAMANUR</h3>
                        
                    </div>
                    <div class="card-body">
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill"></i> SUKKANGALPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> ODAIPATTY</li>
                            <li><i class="bi bi-check-circle-fill"></i> SEEPALAKKOTTAI<i class="bi bi-info-circle tooltip-icon" data-bs-toggle="tooltip" title="Basic analytics includes page views and visitor counts"></i></li>
                            <li><i class="bi bi-check-circle-fill"></i> S.R.PURAM </li>
                        </ul>
                    </div>
                </div>
            </div>
            
                        <div class="col-lg-4">
                <div class="pricing-card popular">
                    <div class="card-header">
                        <h3>ETHAKOVIL</h3>
                        
                    </div>
                    <div class="card-body">
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill"></i> SITHAYAGOWNDANPATTY</li>
                            <li><i class="bi bi-check-circle-fill"></i> MEIKKILARPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> AUNDIPATTI<i class="bi bi-info-circle tooltip-icon" data-bs-toggle="tooltip" title="Advanced analytics includes conversion tracking and user behavior"></i></li>
                            <li><i class="bi bi-check-circle-fill"></i> AUNDIPATTI OUTER</li>
                            <li><i class="bi bi-check-circle-fill"></i> KUNNUR</li>
                        </ul>
                    </div>
                </div>
            </div>
            

            <div class="col-lg-4">
                <div class="pricing-card">
                    <div class="card-header">
                        <h3>GOVINDANAGARAM</h3>
                        
                    </div>
                    <div class="card-body">
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill"></i>V.C.PURAM</li>
                            <li><i class="bi bi-check-circle-fill"></i>KATTUNAYAKKANPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> THAPPUKUNDU<i class="bi bi-info-circle tooltip-icon" data-bs-toggle="tooltip" title="Premium analytics includes custom reports and AI insights"></i></li>
                            <li><i class="bi bi-check-circle-fill"></i> THADICHERY</li>
                            <li><i class="bi bi-check-circle-fill"></i> SIVALINGANAYAKKANPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> KODUVILARPATTI</li>
                           
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="pricing-card">
                    <div class="card-header">
                        <h3>M.SUBBULAPURAM</h3>
                        
                    </div>
                    <div class="card-body">
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill"></i> ERATHIMAKKALPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> OKKARAIPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> MOTTANUTHU<i class="bi bi-info-circle tooltip-icon" data-bs-toggle="tooltip" title="Basic analytics includes page views and visitor counts"></i></li>
                            <li><i class="bi bi-check-circle-fill"></i> KOPPAYAMPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> KANNIAPPAPILLAIPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> PITCHAMPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> SRINIVASA NAGAR</li>
                            <li><i class="bi bi-check-circle-fill"></i> AUNDIPATTI</li>
                           
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="pricing-card popular">
                    <div class="card-header">
                        <h3>CUMBUM</h3>
                        
                    </div>
                    <div class="card-body">
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill"></i> GOVINDHANPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> PALAYAM</li>
                            <li><i class="bi bi-check-circle-fill"></i> CHINNAMANUR<i class="bi bi-info-circle tooltip-icon" data-bs-toggle="tooltip" title="Advanced analytics includes conversion tracking and user behavior"></i></li>
                            <li><i class="bi bi-check-circle-fill"></i> KOVILPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> SEELAYAMPATTI</li>
                            <li><i class="bi bi-x-circle-fill"></i> KOTTUR</li>
                            <li><i class="bi bi-check-circle-fill"></i> VEERAPANDIR</li>
                            <li><i class="bi bi-check-circle-fill"></i> VAYALPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> CHATHIRAPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> ARANMANAIPUDU</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="pricing-card">
                    <div class="card-header">
                        <h3>USILAMPATTI</h3>
                    </div>
                    <div class="card-body">
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill"></i>CHETTIYAPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> THIMMARASANAYAKKANUR</li>
                            <li><i class="bi bi-check-circle-fill"></i> BOMMINAYAKKANPATTI<i class="bi bi-info-circle tooltip-icon" data-bs-toggle="tooltip" title="Premium analytics includes custom reports and AI insights"></i></li>
                            <li><i class="bi bi-check-circle-fill"></i> KONDAMANAYAKKANPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> AUNDIPATTI OUTER</li>
                            <li><i class="bi bi-check-circle-fill"></i> KARUVELNAYAKKANPATTI</li>
                        </ul>
                    </div>
                </div>
            </div>

        <div class="col-lg-4">
                <div class="pricing-card">
                    <div class="card-header">
                        <h3>BALAKOMBAI</h3>
                        
                    </div>
                    <div class="card-body">
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill"></i>ALAGAPURI</li>
                            <li><i class="bi bi-check-circle-fill"></i>RAJAKKALPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i>THEPPAMPATTI<i class="bi bi-info-circle tooltip-icon" data-bs-toggle="tooltip" title="Premium analytics includes custom reports and AI insights"></i></li>
                            <li><i class="bi bi-check-circle-fill"></i>SEVANILAYAM</li>
                            <li><i class="bi bi-check-circle-fill"></i>K.K.PURAM,RAJADHAANI</li>
                            <li><i class="bi bi-check-circle-fill"></i>MANJINAYAKKANPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i>CHITHARPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i>GANESAPURAM</li>
                            <li><i class="bi bi-check-circle-fill"></i>GANDAMANUR</li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="pricing-card">
                    <div class="card-header">
                        <h3>PERIYAKULAM</h3>
                        
                    </div>
                    <div class="card-body">
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill"></i>SCHOOL STOP</li>
                            <li><i class="bi bi-check-circle-fill"></i> SOCIETY STOP</li>
                            <li><i class="bi bi-check-circle-fill"></i> MALLIGAI MAHAL<i class="bi bi-info-circle tooltip-icon" data-bs-toggle="tooltip" title="Premium analytics includes custom reports and AI insights"></i></li>
                            <li><i class="bi bi-check-circle-fill"></i> NEW BUS STAND</li>
                            <li><i class="bi bi-check-circle-fill"></i> MUNDRANTHAL</li>
                            <li><i class="bi bi-check-circle-fill"></i> THAMARAIKULAM</li>
                            <li><i class="bi bi-check-circle-fill"></i> VADUGAPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> KALLIPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> RTO OFFICE</li>
                            <li><i class="bi bi-check-circle-fill"></i> KAILASAPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> LAKSHMIPURAM BANK STOP</li>
                        </ul>
                    </div>
                </div>
            </div>





            <div class="col-lg-4">
                <div class="pricing-card">
                    <div class="card-header">
                        <h3>AUNDIPATTI</h3>
                        
                    </div>
                    <div class="card-body">
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill"></i>KONDAMANAYAKKANPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> JAKKAMPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> S.S.PURAM <i class="bi bi-info-circle tooltip-icon" data-bs-toggle="tooltip" title="Premium analytics includes custom reports and AI insights"></i></li>
                            <li><i class="bi bi-check-circle-fill"></i> RENGANATHAPURAM</li>
                            <li><i class="bi bi-check-circle-fill"></i> MUTHANAMPATTI</li>
                            <li><i class="bi bi-check-circle-fill"></i> K.VILAKKU</li>
                            <li><i class="bi bi-check-circle-fill"></i> ANNAI INDRA NAGAR</li>
                            <li><i class="bi bi-check-circle-fill"></i> THIRUMALAPURAM</li>
                            <li><i class="bi bi-check-circle-fill"></i> ARAPADITHEVANPATTI</li>
                        </ul>
                    </div>
                </div>
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

</body>


<!-- Mirrored from live.themewild.com/eduka/about.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Aug 2025 12:37:27 GMT -->
</html>