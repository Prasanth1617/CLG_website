<?php
include 'admin/db.php';

$order = [
    "PRINCIPAL",
    "DEPARTMENT OF TAMIL",
    "DEPARTMENT OF ENGLISH",
    "DEPARTMENT OF BUSINESS ADMINISTRATION",
    "DEPARTMENT OF COMMERCE, BANKING AND PROFESSIONAL ACCOUNTING",
    "DEPARTMENT OF COMMERCE WITH COMPUTER APPLICATION",
    "DEPARTMENT OF MATHEMATICS",
    "DEPARTMENT OF PHYSICS",
    "DEPARTMENT OF CHEMISTRY",
    "DEPARTMENT OF COMPUTER SCIENCE & INFORMATION TECHNOLOGY",
    "DEPARTMENT OF COMPUTER SCIENCE , INFORMATION TECHNOLOGY & DATA SCIENCE",
    "DEPARTMENT OF COMPUTER APPLICATION",
    "DEPARTMENT OF PHYSICAL EDUCATION",
    " DEPARTMENT OF CHEMISTRY",

    "NON-TEACHING STAFF MEMBERS - LIBRARIAN",
    "NON-TEACHING STAFF MEMBERS - OFFICE ASSISTANT",

    "NON-TEACHING STAFF MEMBERS - OFFICE ADMINISTRATION"
];

$all = mysqli_query($conn, "SELECT * FROM `faculty-details`");
$departments = [];

while ($r = mysqli_fetch_assoc($all)) {
    $dbDeptRaw = isset($r['department']) ? $r['department'] : '';
    $key = strtolower(trim(preg_replace('/\s+/', ' ', $dbDeptRaw)));
    if (!isset($departments[$key])) $departments[$key] = [];
    $departments[$key][] = $r;
}

function norm($s){
    return strtolower(trim(preg_replace('/\s+/', ' ', $s)));
}
?>

<?php
include 'admin/db.php';
?>
<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Theni Kammavar Sangam College of Arts & Science</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Turret+Road:wght@200;300;400;500;700;800&display=swap');

        /* Bamini Tamil Fonts */
        @font-face {
            font-family: 'Bamini';
            src: url('assets/fonts/Bamini.TTF') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Bamini';
            src: url('assets/fonts/BAMINI-Tamil01.ttf') format('truetype');
            font-weight: 100;
            font-style: normal;
        }

        @font-face {
            font-family: 'Bamini';
            src: url('assets/fonts/BAMINI-Tamil10.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        :root {
            --first-color: #4D49BF;
            --second-color: #05DBF2;
            --body-color: #DFE9F2;
            --title-color: #1C1C22;
            --text-color: #58576B;
            --body-font: 'Montserrat', sans-serif;
            --tamil-font: 'Bamini', serif;
            --normal-font-size: 0.938rem;
            --h3-font-size: 1.125rem;
            --small-font-size: 0.75rem;
        }

        @media screen and (min-width: 968px) {
            :root {
                --normal-font-size: 1rem;
                --h3-font-size: 1.25rem;
                --small-font-size: 0.813rem;
            }
        }
        
        body {
 
        font-size: 13px;
    
        }

        *, ::before, ::after { box-sizing: border-box; }
        body { margin: 0; padding: 0; font-family: var(--body-font); }
        h3 { margin: 0; }
        a { text-decoration: none; }
        img { max-width: 100%; }

        .bd-container { 
            max-width: 1400px; 
            width: calc(100% - 3rem); 
            margin-left: auto; 
            margin-right: auto; 
        }

        .card { 
            position: relative; 
            overflow: hidden; 
            padding: 3rem 0; 
            background-color: var(--body-color); 
        }

        /* Department Block Structure */
        .department-block {
            width: 100%;
            margin-bottom: 50px;
        }

        /* Department Title */
        .dept-title {
            font-size: 22px;
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;
            margin: 40px auto 30px;
            color: #2d4b7a;
            font-family: 'Poppins', sans-serif;
            position: relative;
            width: 100%;
            padding: 15px 25px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 10px;
        }

        .dept-title::before,
        .dept-title::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #2d4b7a, transparent);
        }

        .dept-title::before { left: 20px; }
        .dept-title::after { right: 20px; }

        /* Cards Container */
        .department-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            width: 100%;
            padding: 0 1rem;
            justify-items: center;
            align-items: start;
        }

        /* Single card centering */
        .department-cards:has(.card-glass:only-child) {
            grid-template-columns: 1fr;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Card Styles */
        .card-glass { 
            position: relative; 
            text-align: center;
            padding: 2rem 1.5rem;
            overflow: hidden; 
            background: linear-gradient(130deg, rgba(251, 251, 254, 0.6), rgba(251, 251, 254, 0.2)); 
            box-shadow: inset 2px 2px 1px rgba(251, 251, 254, 0.3), inset -2px -2px 1px rgba(251, 251, 254, 0.2); 
            border-radius: 1.5rem;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 320px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            min-height: 320px;
        }

        .card-glass:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Image Container */
        .card-img-container {
            width: 120px;
            height: 120px;
            margin: 0 auto 1rem;
            position: relative;
            overflow: hidden;
            border-radius: 50%;
            border: 3px solid #F4F4FB;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .card-img { 
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        /* Fallback for missing images */
        .card-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 48px;
            font-weight: bold;
        }

        .card-data { 
            margin-bottom: 1rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-title { 
            font-size: var(--h3-font-size); 
            color: var(--title-color); 
            font-weight: 600; 
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .card-profession { 
            font-size: var(--small-font-size); 
            color: var(--text-color); 
            font-weight: 500;
            line-height: 1.4;
            padding: 0 0.5rem;
        }

        .card-button { 
            display: inline-block;
            background: linear-gradient(130deg, rgba(251, 251, 254, 0.9), rgba(251, 251, 254, 0.2));
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            color: var(--title-color);
            font-weight: 500;
            transition: 0.4s;
            margin-top: 0.5rem;
        }

        .card-button:hover { 
            background: linear-gradient(130deg, rgba(251, 251, 254, 1), rgba(251, 251, 254, 0.4)); 
            transform: translateY(-2px);
        }

        .card-circle { 
            position: absolute; 
            width: 250px; 
            height: 250px; 
            background: linear-gradient(130deg, rgba(77, 73, 191, 0.8), rgba(255, 255, 255, 0.2)); 
            border-radius: 50%; 
        }

        .card-circle1 { top: 20%; left: -20%; }
        .card-circle2 { 
            bottom: -5%; 
            right: -25%; 
            background: linear-gradient(130deg, rgba(5, 219, 242, 0.8), rgba(255, 255, 255, 0.2)); 
        }

        /* ===== Enhanced Modal Styles ===== */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.75);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 20px;
        }

        .modal-content-enhanced {
            background: white;
            border-radius: 15px;
            width: 100%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: slideDown 0.4s ease;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 32px;
            cursor: pointer;
            color: #666;
            transition: all 0.3s;
            z-index: 10;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
        }

        .close-btn:hover {
            color: #fff;
            background: #e74c3c;
            transform: rotate(90deg);
        }

        .modal-header-section {
            background: linear-gradient(135deg, #4D49BF 0%, #764ba2 100%);
            padding: 40px 30px;
            display: flex;
            align-items: center;
            gap: 25px;
            border-radius: 15px 15px 0 0;
        }

        #modalImage {
            width: 120px;
            height: 120px;
            object-fit: cover;
            object-position: center;
            border-radius: 50%;
            border: 5px solid rgba(255, 255, 255, 0.3);
            flex-shrink: 0;
            background: white;
        }

        .modal-header-info {
            flex: 1;
            text-align: left;
        }

        #modalName {
            font-size: 26px;
            color: white;
            margin: 0 0 8px 0;
            font-weight: 700;
        }

        .modal-role {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.95);
            margin: 0 0 8px 0;
            font-weight: 500;
        }

        .modal-email {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
            margin: 0;
            word-break: break-word;
        }

        .modal-body-section {
            padding: 30px;
        }

        .modal-section {
            margin-bottom: 25px;
            border-left: 4px solid #4D49BF;
            padding-left: 20px;
        }

        .modal-section:last-child {
            margin-bottom: 0;
        }

        .modal-section h3 {
            font-size: 18px;
            color: #4D49BF;
            margin: 0 0 12px 0;
            font-weight: 700;
        }

        .modal-section div {
            font-size: 15px;
            color: #333;
            line-height: 1.7;
            text-align: left;
        }

        .modal-section ul {
            margin: 0;
            padding-left: 20px;
        }

        .modal-section li {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-content-enhanced::-webkit-scrollbar {
            width: 8px;
        }

        .modal-content-enhanced::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .modal-content-enhanced::-webkit-scrollbar-thumb {
            background: #4D49BF;
            border-radius: 10px;
        }

        .modal-content-enhanced::-webkit-scrollbar-thumb:hover {
            background: #3a3590;
        }

        /* Responsive */
        @media screen and (min-width: 568px) {
            .department-cards { 
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media screen and (min-width: 768px) {
            .department-cards { 
                grid-template-columns: repeat(3, 1fr);
            }
            .card { padding: 0; }
            .card-circle1 { left: 5%; top: 12%; }
            .card-circle2 { right: 8%; bottom: 15%; }
        }

        @media screen and (min-width: 1200px) {
            .department-cards { 
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 768px) {
            .dept-title {
                font-size: 18px;
                padding: 10px 15px;
            }
            
            .dept-title::before,
            .dept-title::after {
                width: 40px;
            }
            
            .dept-title::before { left: 5px; }
            .dept-title::after { right: 5px; }
            
            .department-cards {
                grid-template-columns: 1fr;
                padding: 0 0.5rem;
            }

            .card-glass {
                max-width: 100%;
            }

            .modal-content-enhanced {
                max-width: 95%;
            }

            .modal-header-section {
                flex-direction: column;
                text-align: center;
                padding: 30px 20px;
            }

            .modal-header-info {
                text-align: center;
            }

            #modalImage {
                width: 100px;
                height: 100px;
            }

            #modalName {
                font-size: 22px;
            }

            .modal-body-section {
                padding: 20px;
            }

            .modal-section h3 {
                font-size: 16px;
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
                <h2 class="breadcrumb-title">Our Faculities</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Our Faculities</li>
                </ul>
            </div>
        </div>
         
        <!-- Feature Area -->
     <?php include('scroll.php'); ?>

        <!-- Faculty Cards Section -->
        <section class="card">
            <div class="card-circle card-circle1"></div>
            <div class="card-circle card-circle2"></div>

            <div class="card-container bd-container">
                <?php
                foreach ($order as $deptLabel) {
                    $k = norm($deptLabel);

                    if (empty($departments[$k])) {
                        foreach ($departments as $dbKey => $list) {
                            if (strpos($dbKey, $k) !== false || strpos($k, $dbKey) !== false) {
                                $departments[$k] = $list;
                                break;
                            }
                        }
                    }

                    if (!empty($departments[$k])) {
                        echo "<div class='department-block'>";
                        echo "<h2 class='dept-title'>{$deptLabel}</h2>";
                        echo "<div class='department-cards'>";

                        foreach ($departments[$k] as $staff) {
                            // Get image path and check if file exists
                            $imgPath = isset($staff['faculty-image']) ? 'admin/'.$staff['faculty-image'] : '';
                            $imageExists = !empty($imgPath) && file_exists($imgPath);
                            
                            $name = $staff['name'];
                            $staffType = $staff['staff-type'] ?? '';
                            $dept = $staff['department'];
                            $email = $staff['email'] ?? '';
                            $qual = $staff['education-details'] ?? '';
                            $exp = $staff['experience'] ?? '';
                            $pub = $staff['publication-details'] ?? '';
                            $desc = $staff['description'] ?? '';
                            
                            // Get first letter of name for placeholder
                            $firstLetter = !empty($name) ? strtoupper(substr($name, 0, 1)) : 'F';
                            
                            // Create a unique ID for this faculty member
                            $facultyId = 'faculty_' . $staff['id'];
                            ?>

                            <div class="card-glass">
                                <div class="card-img-container">
                                    <?php if ($imageExists): ?>
                                        <img src="<?php echo htmlspecialchars($imgPath); ?>" class="card-img" alt="<?php echo htmlspecialchars($name); ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="card-img-placeholder" style="display: none;"><?php echo $firstLetter; ?></div>
                                    <?php else: ?>
                                        <div class="card-img-placeholder"><?php echo $firstLetter; ?></div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="card-data">
                                    <h3 class="card-title" style="margin-bottom: 5px;"><?php echo htmlspecialchars($name); ?></h3>
                                    <span class="card-profession" style="font-size: 0.75rem; opacity: 0.8; margin-bottom: 10px;"><?php echo htmlspecialchars($staffType); ?></span>
                                    <span class="card-profession"><?php echo htmlspecialchars($dept); ?></span>
                                </div>
                            
                                <a href="javascript:void(0)" class="card-button" onclick="showPopup('<?php echo $facultyId; ?>')">
                                    Know More
                                </a>
                            </div>

                            <!-- Hidden data storage -->
                            <script type="application/json" id="<?php echo $facultyId; ?>">
                            {
                                "img": <?php echo json_encode($imgPath); ?>,
                                "name": <?php echo json_encode($name); ?>,
                                "staffType": <?php echo json_encode($staffType); ?>,
                                "dept": <?php echo json_encode($dept); ?>,
                                "email": <?php echo json_encode($email); ?>,
                                "qual": <?php echo json_encode($qual); ?>,
                                "exp": <?php echo json_encode($exp); ?>,
                                "pub": <?php echo json_encode($pub); ?>,
                                "desc": <?php echo json_encode($desc); ?>,
                                "firstLetter": <?php echo json_encode($firstLetter); ?>
                            }
                            </script>

                        <?php }
                        echo "</div>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </section>

        <!-- Enhanced Modal -->
        <div class="modal" id="facultyModal">
            <div class="modal-content-enhanced">
                <span class="close-btn" onclick="closePopup()">&times;</span>
                
                <div class="modal-header-section">
                    <div class="card-img-container" style="border: 5px solid rgba(255, 255, 255, 0.3); margin: 0;">
                        <img id="modalImage" alt="Faculty Photo" style="border: none; width: 100%; height: 100%;">
                        <div id="modalImagePlaceholder" class="card-img-placeholder" style="display: none;"></div>
                    </div>
                    <div class="modal-header-info">
                        <h2 id="modalName"></h2>
                        <p class="modal-role" id="modalStaffType"></p>
                        <p class="modal-email" id="modalEmail"></p>
                    </div>
                </div>

                <div class="modal-body-section">
                    <div class="modal-section" id="educationSection">
                        <h3>Education Details</h3>
                        <div id="modalQual"></div>
                    </div>

                    <div class="modal-section" id="experienceSection">
                        <h3>Experience Details</h3>
                        <div id="modalExp"></div>
                    </div>

                    <div class="modal-section" id="publicationSection">
                        <h3>Publication Details</h3>
                        <div id="modalPub"></div>
                    </div>

                    <div class="modal-section" id="departmentSection">
                        <h3>Department</h3>
                        <div id="modalDept"></div>
                    </div>

                    <div class="modal-section" id="descriptionSection">
                        <h3>Additional Information</h3>
                        <div id="modalDesc"></div>
                    </div>
                </div>
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

    <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="far fa-arrow-up-from-arc"></i></a>

    <!-- js -->
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
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script>
        function showPopup(facultyId) {
            const dataElement = document.getElementById(facultyId);
            if (!dataElement) {
                console.error('Faculty data not found for ID:', facultyId);
                return;
            }
            
            let data;
            try {
                data = JSON.parse(dataElement.textContent);
            } catch (e) {
                console.error('Error parsing faculty data:', e);
                return;
            }
            
            // Handle image display in modal
            const modalImage = document.getElementById("modalImage");
            const modalPlaceholder = document.getElementById("modalImagePlaceholder");
            
            if (data.img && data.img.trim() !== '') {
                modalImage.src = data.img;
                modalImage.style.display = "block";
                modalPlaceholder.style.display = "none";
                
                // Handle image error
                modalImage.onerror = function() {
                    this.style.display = "none";
                    modalPlaceholder.textContent = data.firstLetter || 'F';
                    modalPlaceholder.style.display = "flex";
                };
            } else {
                modalImage.style.display = "none";
                modalPlaceholder.textContent = data.firstLetter || 'F';
                modalPlaceholder.style.display = "flex";
            }
            
            // Set header information
            document.getElementById("modalName").innerText = data.name || 'N/A';
            document.getElementById("modalStaffType").innerText = data.staffType || 'N/A';
            document.getElementById("modalEmail").innerText = data.email || 'Email not available';
            
            // Education Details
            const educationSection = document.getElementById("educationSection");
            if (data.qual && data.qual.trim() !== '') {
                document.getElementById("modalQual").innerHTML = formatMultilineText(data.qual);
                educationSection.style.display = "block";
            } else {
                educationSection.style.display = "none";
            }
            
            // Experience Details
            const experienceSection = document.getElementById("experienceSection");
            if (data.exp && data.exp.trim() !== '') {
                document.getElementById("modalExp").innerHTML = formatMultilineText(data.exp);
                experienceSection.style.display = "block";
            } else {
                experienceSection.style.display = "none";
            }
            
            // Publication Details
            const publicationSection = document.getElementById("publicationSection");
            if (data.pub && data.pub.trim() !== '') {
                document.getElementById("modalPub").innerHTML = formatMultilineText(data.pub);
                publicationSection.style.display = "block";
            } else {
                publicationSection.style.display = "none";
            }
            
            // Department
            const departmentSection = document.getElementById("departmentSection");
            if (data.dept && data.dept.trim() !== '') {
                document.getElementById("modalDept").innerText = data.dept;
                departmentSection.style.display = "block";
            } else {
                departmentSection.style.display = "none";
            }
            
            // Additional Information
            const descriptionSection = document.getElementById("descriptionSection");
            if (data.desc && data.desc.trim() !== '') {
                document.getElementById("modalDesc").innerHTML = formatMultilineText(data.desc);
                descriptionSection.style.display = "block";
            } else {
                descriptionSection.style.display = "none";
            }
            
            document.getElementById("facultyModal").style.display = "flex";
            document.body.style.overflow = "hidden";
        }

        function formatMultilineText(text) {
            let formatted = text.replace(/\n/g, '<br>');
            
            if (formatted.includes('•') || /^\d+\./.test(formatted)) {
                return formatted;
            }
            
            if (formatted.includes('.') && formatted.split('.').length > 2) {
                const items = formatted.split(/\.\s+/).filter(item => item.trim() !== '');
                if (items.length > 1) {
                    return '<ul>' + items.map(item => '<li>' + item.trim() + (item.endsWith('.') ? '' : '.') + '</li>').join('') + '</ul>';
                }
            }
            
            return formatted;
        }

        function closePopup() {
            document.getElementById("facultyModal").style.display = "none";
            document.body.style.overflow = "auto";
        }

        window.onclick = function(event) {
            const modal = document.getElementById("facultyModal");
            if (event.target == modal) {
                closePopup();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closePopup();
            }
        });
    </script>
</body>
</html>