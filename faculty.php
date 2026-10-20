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





    <main class="main">
        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/gallery/college-bg.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Our Faculty</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Our Faculty</li>
                </ul>
            </div>
        </div>
                 <!-- Feature Area -->
     <?php include('scroll.php'); ?>
        <!-- feature area end -->
      
        <!-- UG PROGRAMMES -->
        <div class="table-wrapper">
        <div class="table-container">
       <!-- PRINCIPAL -->
        <div class="row mt-50">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                <span class="site-title-tagline"><i class="far fa-user-graduate"></i> PRINCIPAL</span>
                </div>
            </div>
        </div>

        <table border="1" cellspacing="0" cellpadding="8" width="100%">
            <thead>
                <tr>
                <th>NAME</th>
                <th>QUALIFICATION</th>
                <th>YEARS OF EXP.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>Dr. R. S. VETRIVEL<br><small>Principal</small></td>
                <td>M.C.A., M.Phil., Ph.D., M.B.A.</td>
                <td>23 YEARS</td>
                </tr>
            </tbody>
        </table>


        <!-- DEPARTMENT OF TAMIL -->
        <div class="row mt-50">
        <div class="col-lg-6 mx-auto">
            <div class="site-heading text-center">
            <span class="site-title-tagline"><i class="far fa-book-open"></i> DEPARTMENT OF TAMIL</span>
            </div>
        </div>
        </div>

        <table border="1" cellspacing="0" cellpadding="8" width="100%">
            <thead>
                <tr>
                <th>NAME</th>
                <th>QUALIFICATION</th>
                <th>YEARS OF EXP.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>P. RATHIDEVI<br><small>Head of The Department</small></td>
                <td>M.A., M.Phil., M.Ed., SET, (Ph.D)., PGDCA</td>
                <td>14 YEARS 1 MONTH</td>
                </tr>
                <tr><td>S. MUTHUVEL</td><td>M.A., M.Phil.</td><td>2 YEARS 2 MONTHS</td></tr>
                <tr><td>S. THANALAKSHMI</td><td>M.A., M.Phil., M.Ed., NET., (Ph.D)., DCM</td><td>3 YEARS</td></tr>
                <tr><td>Dr. V. MAGALAKSHMI</td><td>M.A., M.Ed., M.Phil., SET., Ph.D.</td><td>6 YEARS 4 MONTHS</td></tr>
                <tr><td>R. RATHIKA</td><td>M.A., M.Ed., M.Phil., NET</td><td>5 YEARS</td></tr>
                <tr><td>M. KANMANI</td><td>M.A., B.Ed., M.Phil.</td><td>9 YEARS</td></tr>
                <tr><td>M. SATHIYA BAMA</td><td>M.A., M.Ed., M.Phil., D.T.Ed., (Ph.D)</td><td>11 YEARS</td></tr>
                <tr><td>G. PRADEEPA</td><td>M.A., M.Phil., B.Ed., M.Sc (Yoga)</td><td>2 YEARS</td></tr>
                <tr><td>M. HUSSAIN BANU</td><td>M.A., B.Ed.</td><td>FRESHER</td></tr>
            </tbody>
        </table>

        <!-- DEPARTMENT OF ENGLISH -->
        <div class="row mt-50">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                <span class="site-title-tagline"><i class="far fa-book"></i> DEPARTMENT OF ENGLISH</span>
                </div>
            </div>
        </div>

        <table border="1" cellspacing="0" cellpadding="8" width="100%">
            <thead>
                <tr>
                <th>NAME</th>
                <th>QUALIFICATION</th>
                <th>YEARS OF EXP.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>K. ARCHANA<br><small>Head of The Department</small></td>
                <td>M.A., B.Ed., Dip (Communicative English)</td>
                <td>12 YEARS 7 MONTHS</td>
                </tr>
                <tr><td>S. T. KANCHANAMALA</td><td>M.A., M.Phil.</td><td>7 YEARS 7 MONTHS</td></tr>
                <tr><td>R. KARTHIKA</td><td>M.A., NET., (Ph.D)</td><td>3 YEARS 2 MONTHS</td></tr>
                <tr><td>K. RAGANANTHINI</td><td>M.A., M.Phil., D.T.Ed., B.Ed., PGDELT., PGDCA</td><td>9 YEARS</td></tr>
                <tr><td>M. VIVEK</td><td>M.A., M.Phil., B.Ed.</td><td>6 YEARS 7 MONTHS</td></tr>
                <tr><td>N. SATHYA KRISHNA SUNDAR</td><td>M.A., M.Phil., B.Ed., PGDELT, PGCTE</td><td>8 YEARS 6 MONTHS</td></tr>
                <tr><td>P. YASOTHAIPRIYA</td><td>M.A., M.Phil., B.Ed., DCA., (Ph.D)</td><td>8 YEARS 3 MONTHS</td></tr>
                <tr><td>V. PREETHI</td><td>M.A.</td><td>1 YEAR 1 MONTH</td></tr>
                <tr><td>P. GOWRISELVI</td><td>M.A., B.Ed., (Ph.D)</td><td>8 MONTHS</td></tr>
                <tr><td>R. VIKRAMAN</td><td>M.A.</td><td>1 YEAR 4 MONTHS</td></tr>
                <tr><td>M. KAMALIVENI</td><td>M.A.</td><td>FRESHER</td></tr>
            </tbody>
        </table>

        <!-- DEPARTMENT OF BUSINESS ADMINISTRATION -->
        <div class="row mt-50">
            <div class="col-lg-8 mx-auto">
                <div class="site-heading text-center">
                <span class="site-title-tagline"><i class="fas fa-briefcase"></i> DEPARTMENT OF BUSINESS ADMINISTRATION</span>
                </div>
            </div>
        </div>

        <table border="1" cellspacing="0" cellpadding="8" width="100%">
            <thead>
                <tr>
                <th>NAME</th>
                <th>QUALIFICATION</th>
                <th>YEARS OF EXP.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>Dr. R. VIJAYA RAJYA SYNTHIA<br><small>Head of The Department</small></td>
                <td>MBA., M.Phil., Ph.D.</td>
                <td>14 YEARS 8 MONTHS</td>
                </tr>
                <tr>
                <td>R. JEYA</td>
                <td>MBA., M.Phil.</td>
                <td>10 YEARS 2 MONTHS</td>
                </tr>
                <tr>
                <td>Dr. C. PRABAKARAN</td>
                <td>MBA., M.Phil., Ph.D.</td>
                <td>3 YEARS 6 MONTHS</td>
                </tr>
                <tr>
                <td>D. PRIYANKA</td>
                <td>MBA., M.Phil.</td>
                <td>FRESHER</td>
                </tr>
            </tbody>
        </table>


        <!-- DEPARTMENT OF COMMERCE, BANKING AND PROFESSIONAL ACCOUNTING -->
        <div class="row mt-50">
        <div class="col-lg-10 mx-auto">
            <div class="site-heading text-center">
            <span class="site-title-tagline"><i class="fas fa-coins"></i> DEPARTMENT OF COMMERCE, BANKING AND PROFESSIONAL ACCOUNTING</span>
            </div>
        </div>
        </div>

        <table border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead>
            <tr>
            <th>NAME</th>
            <th>QUALIFICATION</th>
            <th>YEARS OF EXP.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>Dr. L. MYTHILI<br><small>Head of The Department</small></td>
            <td>M.Com., M.Phil., B.Ed., Ph.D., PGDCA.</td>
            <td>15 YEARS</td>
            </tr>
            <tr>
            <td>M. RAVEENDRAN</td>
            <td>M.Com., M.Phil.</td>
            <td>6 YEARS</td>
            </tr>
            <tr>
            <td>N. VIJAYAANANTH</td>
            <td>M.Com., M.Phil., SET</td>
            <td>16 YEARS</td>
            </tr>
            <tr>
            <td>Dr. R. VAIRAM</td>
            <td>M.A., M.Phil., Ph.D., PGDCA</td>
            <td>6 YEARS</td>
            </tr>
            <tr>
            <td>G. KARTHICKKUMAR</td>
            <td>M.Com., B.Lib., D.Co-Op</td>
            <td>9 MONTHS</td>
            </tr>
            <tr>
            <td>T. KRISHNAPRIYA</td>
            <td>M.Com(CA), M.Phil., B.Ed.</td>
            <td>4 YEARS 5 MONTHS</td>
            </tr>
            <tr>
            <td>R. SELVANATCHIYAR</td>
            <td>M.Com., M.Phil., B.Ed., (Ph.D)</td>
            <td>6 YEARS</td>
            </tr>
            <tr>
            <td>R. NAGANANDHINI</td>
            <td>M.Com., M.Phil.</td>
            <td>5 YEARS</td>
            </tr>
        </tbody>
        </table>

        <!-- DEPARTMENT OF COMMERCE WITH COMPUTER APPLICATION -->
        <div class="row mt-50">
        <div class="col-lg-10 mx-auto">
            <div class="site-heading text-center">
            <span class="site-title-tagline"><i class="fas fa-laptop-code"></i> DEPARTMENT OF COMMERCE WITH COMPUTER APPLICATION</span>
            </div>
        </div>
        </div>

        <table border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead>
            <tr>
            <th>NAME</th>
            <th>QUALIFICATION</th>
            <th>YEARS OF EXP.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>Dr. R. KANNIKA PARAMESWARI<br><small>Head of The Department</small></td>
            <td>M.A., M.Com(CA)., M.Phil., Ph.D.</td>
            <td>16 YEARS 7 MONTHS</td>
            </tr>
            <tr>
            <td>Dr. S. JEYALAKSHMI</td>
            <td>M.Com., M.Phil., PGDCA., Ph.D.</td>
            <td>12 YEARS 3 MONTHS</td>
            </tr>
            <tr>
            <td>V. PRABUKUMAR</td>
            <td>M.Com(CA)., M.Phil., (Ph.D)</td>
            <td>8 YEARS 2 MONTHS</td>
            </tr>
            <tr>
            <td>C. SUNDARAM</td>
            <td>M.Com(CA)., M.Phil., (Ph.D)</td>
            <td>10 YEARS 10 MONTHS</td>
            </tr>
            <tr>
            <td>A. SUGANYADEVI</td>
            <td>M.Com., M.Phil.</td>
            <td>2 YEARS 6 MONTHS</td>
            </tr>
            <tr>
            <td>V. SIVASANKAR</td>
            <td>M.Com (CA), M.Phil., M.Ed.</td>
            <td>3 YEARS 3 MONTHS</td>
            </tr>
            <tr>
            <td>Dr. P. RAMYA</td>
            <td>MBA., M.Com., M.Phil., Ph.D., SET</td>
            <td>4 YEARS 4 MONTHS</td>
            </tr>
            <tr>
            <td>P. NANDHINI</td>
            <td>M.Com (CA).</td>
            <td>1 YEAR 3 MONTHS</td>
            </tr>
            <tr>
            <td>S. SARARVANAPRIYA</td>
            <td>M.Com., DCA.</td>
            <td>4 MONTHS</td>
            </tr>
            <tr>
            <td>M. SARAN</td>
            <td>M.Com(CA).</td>
            <td>3 MONTHS 15 DAYS</td>
            </tr>
            <tr>
            <td>Dr. K. VELMURUGAIYA</td>
            <td>M.Com., M.Phil., Ph.D.</td>
            <td>18 YEARS 6 MONTHS</td>
            </tr>
        </tbody>
        </table>


        <!-- DEPARTMENT OF MATHEMATICS -->
        <div class="row mt-50">
        <div class="col-lg-10 mx-auto">
            <div class="site-heading text-center">
            <span class="site-title-tagline"><i class="fas fa-square-root-alt"></i> DEPARTMENT OF MATHEMATICS</span>
            </div>
        </div>
        </div>

        <table border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead>
            <tr>
            <th>NAME</th>
            <th>QUALIFICATION</th>
            <th>YEARS OF EXP.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>Dr. C. SUGANYA<br><small>Head of The Department</small></td>
            <td>M.Sc., M.Phil., Ph.D.</td>
            <td>7 YEARS 3 MONTHS</td>
            </tr>
            <tr>
            <td>M. PADMAPRIYA</td>
            <td>M.Sc., M.Phil., PGDCA.</td>
            <td>13 YEARS</td>
            </tr>
            <tr>
            <td>K. PANDILAKSHMI</td>
            <td>M.Sc., M.Phil., M.Ed., PGDCA.</td>
            <td>18 YEARS</td>
            </tr>
            <tr>
            <td>J. PREMA</td>
            <td>M.Sc., M.Phil., B.Ed.</td>
            <td>5 YEARS</td>
            </tr>
            <tr>
            <td>R. SURYAKALA</td>
            <td>M.Sc., B.Ed., M.Phil.</td>
            <td>7 YEARS 6 MONTHS</td>
            </tr>
            <tr>
            <td>M. MURUGAN</td>
            <td>M.Sc., M.Phil., SET.</td>
            <td>7 YEARS</td>
            </tr>
            <tr>
            <td>R. RATHINAM</td>
            <td>M.Sc., M.Phil.</td>
            <td>6 YEARS 4 MONTHS</td>
            </tr>
            <tr>
            <td>M. VINOTHKUMAR</td>
            <td>M.Sc., B.Ed., M.Phil.</td>
            <td>3 MONTHS</td>
            </tr>
        </tbody>
        </table>

        <!-- DEPARTMENT OF PHYSICS -->
        <div class="row mt-50">
        <div class="col-lg-10 mx-auto">
            <div class="site-heading text-center">
            <span class="site-title-tagline"><i class="fas fa-atom"></i> DEPARTMENT OF PHYSICS</span>
            </div>
        </div>
        </div>

        <table border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead>
            <tr>
            <th>NAME</th>
            <th>QUALIFICATION</th>
            <th>YEARS OF EXP.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>Dr. S. SHRIPRASAD<br><small>Head of The Department</small></td>
            <td>M.Sc., M.Phil., Ph.D.</td>
            <td>18 YEARS</td>
            </tr>
            <tr>
            <td>C. AMBIKA</td>
            <td>M.Sc., B.Ed., M.Phil.</td>
            <td>11 YEARS</td>
            </tr>
            <tr>
            <td>R. SANGARI</td>
            <td>M.Sc., B.Ed.</td>
            <td>9 YEARS</td>
            </tr>
            <tr>
            <td>K. ARCHANA</td>
            <td>M.Sc.</td>
            <td>1 YEAR 9 MONTHS</td>
            </tr>
            <tr>
            <td>P. PAVITHRA</td>
            <td>M.Sc., D.Y.Ed., B.Ed., DTP.</td>
            <td>4 MONTHS</td>
            </tr>
        </tbody>
        </table>

        <!-- DEPARTMENT OF CHEMISTRY -->
        <div class="row mt-50">
        <div class="col-lg-10 mx-auto">
            <div class="site-heading text-center">
            <span class="site-title-tagline"><i class="fas fa-vial"></i> DEPARTMENT OF CHEMISTRY</span>
            </div>
        </div>
        </div>

        <table border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead>
            <tr>
            <th>NAME</th>
            <th>QUALIFICATION</th>
            <th>YEARS OF EXP.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>Dr. S. SELVARAJAN<br><small>Head of The Department</small></td>
            <td>M.Sc., Ph.D.</td>
            <td>7 YEARS 3 MONTHS</td>
            </tr>
            <tr>
            <td>Dr. S. KALIDASS</td>
            <td>M.Sc., M.Phil., B.Ed., Ph.D., M.I.S.T.E.</td>
            <td>16 YEARS 5 MONTHS</td>
            </tr>
            <tr>
            <td>Dr. R. SIVAPERUMAL</td>
            <td>M.Sc., M.Phil., CIS., Ph.D.</td>
            <td>10 YEARS 10 MONTHS</td>
            </tr>
            <tr>
            <td>Dr. M. CHINNASAMY</td>
            <td>M.Sc., M.Phil., B.Ed., Ph.D.</td>
            <td>5 YEARS 5 MONTHS</td>
            </tr>
            <tr>
            <td>R. JEYAPRIYA</td>
            <td>M.Sc., M.Ed.</td>
            <td>3 YEARS</td>
            </tr>
            <tr>
            <td>K. UDHAYARANI</td>
            <td>M.Sc., M.Phil., B.Ed., DMLT.</td>
            <td>7 YEARS 5 MONTHS</td>
            </tr>
        </tbody>
        </table>


        <!-- DEPARTMENT OF COMPUTER SCIENCE & INFORMATION TECHNOLOGY -->
        <div class="row mt-50">
            <div class="col-lg-10 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline">
                        <i class="fas fa-laptop-code"></i> DEPARTMENT OF COMPUTER SCIENCE & INFORMATION TECHNOLOGY
                    </span>
                </div>
            </div>
        </div>

            <table border="1" cellspacing="0" cellpadding="8" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">QUALIFICATION</th>
                        <th scope="col">YEARS OF EXP.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>A. KOTTAICHAMY<br><small>Head of The Department</small></td>
                        <td>MCA, M.Phil., M.Sc., B.Ed., (Ph.D.)</td>
                        <td>20 YEARS</td>
                    </tr>
                    <tr>
                        <td>S. KALAISELVI</td>
                        <td>M.Sc., M.Phil., B.Ed.</td>
                        <td>16 YEARS 6 MONTHS</td>
                    </tr>
                    <tr>
                        <td>K. SELVARAJ</td>
                        <td>M.Sc., M.Phil., M.Com</td>
                        <td>15 YEARS</td>
                    </tr>
                    <tr>
                        <td>M. KOKILA</td>
                        <td>MCA, M.Phil., B.Ed.</td>
                        <td>16 YEARS</td>
                    </tr>
                    <tr>
                        <td>A. ARUN</td>
                        <td>M.Sc (S.E.)</td>
                        <td>7 YEARS 2 MONTHS</td>
                    </tr>
                    <tr>
                        <td>C. ANNALAKSHMI</td>
                        <td>M.Sc., M.Phil., M.Com</td>
                        <td>11 YEARS 6 MONTHS</td>
                    </tr>
                    <tr>
                        <td>J. UMA MAHESHWARI</td>
                        <td>M.Sc., M.Phil., B.Ed.</td>
                        <td>11 YEARS</td>
                    </tr>
                    <tr>
                        <td>R. PADMAPRIYA</td>
                        <td>MCA, M.Phil.</td>
                        <td>22 YEARS 9 MONTHS</td>
                    </tr>
                    <tr>
                        <td>M. SHOBIKA</td>
                        <td>M.Sc [IT], B.Ed.</td>
                        <td>9 MONTHS</td>
                    </tr>
                    <tr>
                        <td>R. SUBHULAKSMI</td>
                        <td>MCA, M.Phil.</td>
                        <td>9 YEARS</td>
                    </tr>
                </tbody>
            </table>


        <!-- DEPARTMENT OF COMPUTER APPLICATION -->
        <div class="row mt-50">
            <div class="col-lg-10 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline">
                        <i class="fas fa-desktop"></i> DEPARTMENT OF COMPUTER APPLICATION
                    </span>
                </div>
            </div>
        </div>

        
            <table border="1" cellspacing="0" cellpadding="8" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">QUALIFICATION</th>
                        <th scope="col">YEARS OF EXP.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. M. GOKILADEVI<br><small>Head of The Department</small></td>
                        <td>MCA, B.Ed., M.Phil., Ph.D.</td>
                        <td>16 YEARS</td>
                    </tr>
                    <tr>
                        <td>R. RAJAREKA</td>
                        <td>M.Sc., M.Phil.</td>
                        <td>17 YEARS</td>
                    </tr>
                    <tr>
                        <td>K. NALAMBIKA</td>
                        <td>MCA, M.Phil.</td>
                        <td>11 YEARS</td>
                    </tr>
                    <tr>
                        <td>P. MOUNISHA</td>
                        <td>MCA</td>
                        <td>1 YEAR 25 DAYS</td>
                    </tr>
                    <tr>
                        <td>E. BRINDHA</td>
                        <td>M.Sc., B.Ed.</td>
                        <td>6 MONTHS</td>
                    </tr>
                    <tr>
                        <td>S. SOWDEESWARI</td>
                        <td>M.Sc., B.Ed.</td>
                        <td>11 MONTHS 29 DAYS</td>
                    </tr>
                </tbody>
            </table>

        
        <!-- DEPARTMENT OF PHYSICAL EDUCATION -->
        <div class="row mt-50">
            <div class="col-lg-10 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline">
                        <i class="fas fa-futbol"></i> DEPARTMENT OF PHYSICAL EDUCATION
                    </span>
                </div>
            </div>
        </div>

        <table border="1" cellspacing="0" cellpadding="8" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">QUALIFICATION</th>
                    <th scope="col">YEARS OF EXP.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>N. SIVAKUMAR<br><small>Head of The Department</small></td>
                    <td>B.Sc., M.P.Ed., M.Phil., PGD.P.P.T.</td>
                    <td>22 YEARS 8 MONTHS</td>
                </tr>
                <tr>
                    <td>P. MAGESWARI</td>
                    <td>M.A., M.P.Ed., NIS</td>
                    <td>16 YEARS</td>
                </tr>
                <tr>
                    <td>G. GURUHULAHEMA</td>
                    <td>B.Sc., M.P.Ed., M.Phil., NET</td>
                    <td>15 YEARS</td>
                </tr>
            </tbody>
        </table>

    <!-- DEPARTMENT OF LIBRARY -->
    <div class="row mt-50">
        <div class="col-lg-10 mx-auto">
            <div class="site-heading text-center">
                <span class="site-title-tagline">
                    <i class="fas fa-book"></i> DEPARTMENT OF LIBRARY
                </span>
            </div>
        </div>
    </div>

    
        <table border="1" cellspacing="0" cellpadding="8" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">QUALIFICATION</th>
                    <th scope="col">YEARS OF EXP.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>R. SENTHIL KUMARAN<br><small>Librarian</small></td>
                    <td>B.Sc., M.A., M.L.I.Sc., NET, D.C.A.</td>
                    <td>23 YEARS</td>
                </tr>
                <tr>
                    <td>R. CHITRAKALA<br><small>Librarian</small></td>
                    <td>M.A., B.L.I.Sc.</td>
                    <td>7 YEARS 4 MONTHS</td>
                </tr>
            </tbody>
        </table>
        

        <!-- NON-TEACHING STAFF MEMBERS - DEPARTMENT OF COMPUTER SCIENCE -->
        <div class="row mt-50">
            <div class="col-lg-10 mx-auto">
                <div class="site-heading text-center">
                     <span class="site-title-tagline">
                         NON-TEACHING STAFF MEMBERS
                    </span><br>
                    <span class="site-title-tagline">
                        <i class="fas fa-users-cog"></i>  DEPARTMENT OF COMPUTER SCIENCE
                    </span>
                </div>
            </div>
        </div>

            <table border="1" cellspacing="0" cellpadding="8" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">ROLE</th>
                        <th scope="col">QUALIFICATION</th>
                        <th scope="col">YEARS OF EXP.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>R. MANICKAM</td>
                        <td>LAB ADMIN</td>
                        <td>M.Sc (S.E.)</td>
                        <td>7 YEARS</td>
                    </tr>
                    <tr>
                        <td>M. PANDIYARAJ</td>
                        <td>LAB ADMIN</td>
                        <td>M.Sc (CS)</td>
                        <td>5 MONTHS</td>
                    </tr>
                </tbody>
            </table>


            <!-- NON-TEACHING STAFF - DEPARTMENT OF CHEMISTRY -->
<div class="row mt-50">
    <div class="col-lg-10 mx-auto">
        <div class="site-heading text-center">
            <span class="site-title-tagline">
                <i class="fas fa-flask"></i> NON-TEACHING STAFF - DEPARTMENT OF CHEMISTRY
            </span>
        </div>
    </div>
</div>

    <table  border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead class="thead-dark">
            <tr>
                <th scope="col">NAME</th>
                <th scope="col">ROLE</th>
                <th scope="col">QUALIFICATION</th>
                <th scope="col">YEARS OF EXP.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>C. AYYAPPARAJ</td>
                <td>LAB ADMIN</td>
                <td>B.Sc., B.Ed (Che)</td>
                <td>1 YEAR 9 MONTHS</td>
            </tr>
        </tbody>
    </table>

<!-- OFFICE ADMINISTRATION -->
<div class="row mt-50">
    <div class="col-lg-10 mx-auto">
        <div class="site-heading text-center">
            <span class="site-title-tagline">
                <i class="fas fa-building"></i> OFFICE ADMINISTRATION
            </span>
        </div>
    </div>
</div>

    <table  border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead class="thead-dark">
            <tr>
                <th scope="col">NAME</th>
                <th scope="col">ROLE</th>
                <th scope="col">QUALIFICATION</th>
                <th scope="col">YEARS OF EXP.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>T. SARAVANAKUMAR</td>
                <td>ACCOUNTANT</td>
                <td>M.Com., D-CO.OP</td>
                <td>10 YEARS</td>
            </tr>
            <tr>
                <td>T. MEKALA</td>
                <td>CASHIER</td>
                <td>M.Com., M.L.I.Sc</td>
                <td>12 YEARS 5 MONTHS</td>
            </tr>
            <tr>
                <td>D.JEYALAKSHMI</td>
                <td>OFFICE ASST</td>
                <td>B.Com</td>
                <td>14 YEARS</td>
            </tr>
            <tr>
                <td>R. SUGANTHI</td>
                <td>OFFICE ASST</td>
                <td>B.Com</td>
                <td>9 YEARS</td>
            </tr>
            <tr>
                <td>B. JEYARAJ</td>
                <td>OFFICE ASST</td>
                <td>-</td>
                <td>14 YEARS</td>
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