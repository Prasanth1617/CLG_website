<?php

    // Local Credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tks";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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