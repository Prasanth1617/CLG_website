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
    <meta name="description" content="Our Association at Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:title" content="Our Association – Theni Kammavar Sangam College of Arts &amp; Science">
    <meta property="og:description" content="Our Association at Theni Kammavar Sangam College of Arts &amp; Science, Theni.">
    <meta property="og:image" content="https://www.tkscas.com/assets/img/logo/logo.jpg">
    <meta name="keywords" content="">

    <!-- title -->
    <title>Our Association – Theni Kammavar Sangam College of Arts &amp; Science</title>

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

        .table-container {
            max-height: 600px;
            overflow-y: auto;
            overflow-x: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .table-container table tbody tr {
            border-bottom: 1px solid #dee2e6;
            transition: background-color 0.2s ease;
        }

        .table-container table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table-container table td {
            padding: 12px 15px;
            text-align: left;
        }

        .table-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .table-container::-webkit-scrollbar-track {
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .table-container {
                max-height: 400px;
            }
            .positions-held-section {
                padding: 20px;
            }
            .positions-held-section .content-list li {
                min-width: 100%;
            }
        }

        /* ── POSITIONS HELD — redesigned ───────────────────── */
        .positions-held-section {
            margin: 40px 12px 40px;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 32px rgba(92, 107, 192, 0.10);
            border: 1px solid #e8e6f5;
        }

        .positions-held-header {
            background: linear-gradient(135deg, #5c6bc0 0%, #7c4dff 100%);
            padding: 28px 36px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .positions-held-header-icon {
            width: 52px;
            height: 52px;
            background: rgba(255,255,255,0.18);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
            flex-shrink: 0;
            border: 1.5px solid rgba(255,255,255,0.25);
        }

        .positions-held-header-text h4 {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 4px;
            letter-spacing: 0.3px;
        }

        .positions-held-header-text p {
            font-size: 13.5px;
            color: rgba(255,255,255,0.75);
            margin: 0;
        }

        .positions-held-body {
            padding: 32px 36px 36px;
            background: #f8f7ff;
        }

        .positions-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .position-card {
            background: #ffffff;
            border: 1px solid #e0ddf5;
            border-radius: 14px;
            padding: 18px 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            transition: box-shadow 0.25s ease, transform 0.25s ease, border-color 0.25s ease;
            cursor: default;
        }

        .position-card:hover {
            box-shadow: 0 8px 28px rgba(92, 107, 192, 0.18);
            transform: translateY(-3px);
            border-color: #b3b0e8;
        }

        .position-card-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ede7f6, #e8eaf6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #5c6bc0;
            flex-shrink: 0;
            transition: background 0.25s, color 0.25s;
        }

        .position-card:hover .position-card-icon {
            background: linear-gradient(135deg, #5c6bc0, #7c4dff);
            color: #ffffff;
        }

        .position-card-label {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a2e;
            line-height: 1.45;
            margin: 0;
        }

        .position-card-sub {
            font-size: 12px;
            color: #7c76a8;
            margin: 3px 0 0;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .positions-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 576px) {
            .positions-grid { grid-template-columns: 1fr; gap: 12px; }
            .positions-held-header { padding: 20px 22px; }
            .positions-held-body  { padding: 20px 18px 24px; }
            .positions-held-header-text h4 { font-size: 18px; }
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
    </div>





    <main id="main-content" class="main">
        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/gallery/college-bg.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Our Association</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Our Association</li>
                </ul>
            </div>
        </div>
             <?php include('scroll.php'); ?>

         

    <div class="inside-container">
        
        <!-- UG PROGRAMMES -->
        <div class="table-wrapper">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>COMMITTEE / COUNCILS / CLUB / CELL</th>
                            <th>FACULTY NAME / MEMBERS</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Grievance Redressal Committee</td>
                            <td>Mr. K. Selvaraj (BCA)<br>P. Pavithra (Physics)</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Internal Compliant Committee (ICC)</td>
                            <td>
                                Dr. L. Mythili (Commerce)<br>
                                Members:<br>
                                Mr. A. Kottaichamy (CS & IT HOD)<br>
                                Dr. R. Vijaya Rajya Synthia (BBA HOD)
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Anti-Ragging Committee</td>
                            <td>Mr. N. Sivakumar (Phy. Edu HOD)</td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Committee for SC / ST</td>
                            <td>Mrs. C. Ambika (Physics)</td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>Disciplinary Committee</td>
                            <td>All HODs & Physical Education Department</td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>Institution Innovation Council (IIC)</td>
                            <td>Dr. R. Vijaya Rajya Synthia (BBA HOD)</td>
                        </tr>

                        <tr>
                            <td>7</td>
                            <td>Event Management Committee</td>
                            <td>Dr. S. Sriprasad (Physics HOD)</td>
                        </tr>

                        <tr>
                            <td>8</td>
                            <td>NSS Advisory Committee</td>
                            <td>Mr. M. Murugan (Maths)</td>
                        </tr>

                        <tr>
                            <td>9</td>
                            <td>Minority Student Committee</td>
                            <td>Dr. V. Mahalakshmi (Tamil)</td>
                        </tr>

                        <tr>
                            <td>10</td>
                            <td>Anti Ragging Cell</td>
                            <td>
                                Mr. N. Sivakumar (Phy. Edu HOD)<br>
                                Dr. R. Kannika Parameswari (Commerce CA)
                            </td>
                        </tr>

                        <tr>
                            <td>11</td>
                            <td>Scholarship Cell</td>
                            <td>
                                Coordinator: Mr. C. Sundaram (Commerce CA)<br><br>

                                SC/ST Scholarship: Mrs. C. Ambika (Physics)<br>
                                Pudhumai Penn: Ms. M. Kanmani (Tamil)<br>
                                Tamil Pudhalvan: Mr. N. Sathya Krishna Sundhar (English)<br>
                                Ulzavar Attai: Mrs. G. Pradeeba (Tamil)<br>
                                Minority Scholarship: Mrs. M. Hussain Banu (Tamil)<br>
                                National Scholarship: Mr. M. Saran (Commerce CA)<br>
                                Office: Mr. T. Saravanakumar
                            </td>
                        </tr>

                        <tr>
                            <td>12</td>
                            <td>Anti-Drug Committee</td>
                            <td>
                                Mr. R. Rathinam (Maths)<br>
                                Dr. S. Selvarajan (Chemistry HOD)
                            </td>
                        </tr>

                        <tr>
                            <td>13</td>
                            <td>Magazine / Newsletter Committee</td>
                            <td>
                                Chief Editor: Mrs. K. Archana (English HOD)<br>
                                Chief Designer: Mrs. M. Kokila (CS & IT)<br><br>

                                Members:<br>
                                Dr. L. Mythili, Mr. N. Sivakumar, Mr. A. Kottaichamy,<br>
                                Dr. S. Sriprasad, Dr. S. Selvarajan, Dr. M. Gokila Devi,<br>
                                Dr. R. Vijaya Rajya Synthia, Dr. C. Suganya,<br>
                                Dr. R. Kannika Parameswari<br><br>

                                Student Coordinator: G. D. Madhumitha
                            </td>
                        </tr>

                        <tr>
                            <td>14</td>
                            <td>Academic Development Committee</td>
                            <td>
                                Dr. L. Mythili (Commerce HOD)<br>
                                All Department HODs
                            </td>
                        </tr>

                        <tr>
                            <td>15</td>
                            <td>OBC Cell</td>
                            <td>Mrs. K. Pandilakshmi (Maths)</td>
                        </tr>

                        <tr>
                            <td>16</td>
                            <td>Examination Cell</td>
                            <td>Mr. K. Selvaraj (CS & IT)</td>
                        </tr>

                        <tr>
                            <td>17</td>
                            <td>IQAC</td>
                            <td>
                                Mrs. C. Annalakshmi, Mrs. S. Kalaiselvi,<br>
                                Dr. M. Gokila Devi, Mrs. M. Padma Priya,<br>
                                Dr. C. Suganya, Dr. S. Kalidass,<br>
                                Ms. R. Karthika, Mrs. A. Sugaya Devi,<br>
                                Dr. R. Vairam, Dr. R. Sivaperumal,<br>
                                Mrs. P. Pavithra, Dr. C. Prabakaran
                            </td>
                        </tr>

                        <tr>
                            <td>18</td>
                            <td>NIRF Cell</td>
                            <td>Mr. K. Selvaraj (CS & IT)</td>
                        </tr>

                        <tr>
                            <td>19</td>
                            <td>Alumni Cell</td>
                            <td>
                                Mr. V. Prabukumar (Commerce CA)<br>
                                Mrs. K. Ragananthini (English)
                            </td>
                        </tr>

                        <tr>
                            <td>20</td>
                            <td>Parents Teachers Association Cell</td>
                            <td>Mr. S. Muthuvel (Tamil)</td>
                        </tr>

                        <tr>
                            <td>21</td>
                            <td>Placement Training & Career Guidance</td>
                            <td>
                                Mrs. M. Kokila (CS & IT)<br>
                                Mr. R. Vikraman (English)
                            </td>
                        </tr>

                        <!-- remaining rows same pattern -->

                        <tr>
                            <td>57</td>
                            <td>SEDG Cell</td>
                            <td>
                                Coordinator: Mrs. C. Ambika (Physics)<br>
                                Members:<br>
                                Dr. V. Mahalakshmi<br>
                                Mr. M. Raveendran<br>
                                Dr. C. Prabakaran
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- ── POSITIONS HELD — redesigned ── -->
            <div class="positions-held-section">

                <div class="positions-held-header">
                    <div class="positions-held-header-icon">
                        <i class="fas fa-building-columns"></i>
                    </div>
                    <div class="positions-held-header-text">
                        <h4>Department-wise Associations</h4>
                    </div>
                </div>

                <div class="positions-held-body">
                    <div class="positions-grid">

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-language"></i></div>
                            <div>
                                <p class="position-card-label">Department of Tamil</p>
                                <span class="position-card-sub">Language &amp; Literature</span>
                            </div>
                        </div>

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-book-open"></i></div>
                            <div>
                                <p class="position-card-label">Department of English</p>
                                <span class="position-card-sub">Language &amp; Literature</span>
                            </div>
                        </div>

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-briefcase"></i></div>
                            <div>
                                <p class="position-card-label">Department of Business Administration</p>
                                <span class="position-card-sub">Management Studies</span>
                            </div>
                        </div>

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-chart-line"></i></div>
                            <div>
                                <p class="position-card-label">Department of Commerce</p>
                                <span class="position-card-sub">Commerce &amp; Finance</span>
                            </div>
                        </div>

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-calculator"></i></div>
                            <div>
                                <p class="position-card-label">Department of Commerce with CA</p>
                                <span class="position-card-sub">Commerce &amp; Accountancy</span>
                            </div>
                        </div>

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-square-root-variable"></i></div>
                            <div>
                                <p class="position-card-label">Department of Maths</p>
                                <span class="position-card-sub">Science &amp; Mathematics</span>
                            </div>
                        </div>

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-atom"></i></div>
                            <div>
                                <p class="position-card-label">Department of Physics</p>
                                <span class="position-card-sub">Eigen's Club</span>
                            </div>
                        </div>

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-flask"></i></div>
                            <div>
                                <p class="position-card-label">Department of Chemistry</p>
                                <span class="position-card-sub">Chemistry Association</span>
                            </div>
                        </div>

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-laptop-code"></i></div>
                            <div>
                                <p class="position-card-label">Department of CS &amp; IT</p>
                                <span class="position-card-sub">RUANZHI</span>
                            </div>
                        </div>

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-desktop"></i></div>
                            <div>
                                <p class="position-card-label">Department of Computer Application</p>
                                <span class="position-card-sub">VERONICA</span>
                            </div>
                        </div>

                        <div class="position-card">
                            <div class="position-card-icon"><i class="fas fa-person-running"></i></div>
                            <div>
                                <p class="position-card-label">Department of Physical Education</p>
                                <span class="position-card-sub">ALTIUS Club</span>
                            </div>
                        </div>
                         
                    </div>
                </div>
            </div>
            <!-- positions held end -->

        </div>

    </div><!-- inside-container end -->


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

    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
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
    <script src="assets/js/sidebar.js"></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>

</html>