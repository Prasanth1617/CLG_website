<?php
include 'admin/db.php';
?>
<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback Form - TKS College</title>
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



        .containers {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .containers .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .form-content {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .required {
            color: #e74c3c;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .rating-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .rating-section h2 {
            color: #667eea;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .rating-legend {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }

        .rating-legend p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .question-item {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .question-item:hover {
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
        }

        .question-text {
            font-weight: 500;
            color: #333;
            margin-bottom: 15px;
            font-size: 15px;
        }

        .rating-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .rating-btn {
            flex: 1;
            min-width: 60px;
            padding: 12px;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
        }

        .rating-btn:hover {
            border-color: #667eea;
            background: #f0f3ff;
            transform: translateY(-2px);
        }

        .rating-btn.selected {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .rating-btn .rating-value {
            font-size: 18px;
            display: block;
            margin-bottom: 5px;
        }

        .rating-btn .rating-label {
            font-size: 11px;
            opacity: 0.8;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
            display: none;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
            display: none;
        }

        @media (max-width: 768px) {
            .form-content {
                padding: 20px;
            }

            .rating-buttons {
                flex-direction: column;
            }

            .rating-btn {
                min-width: 100%;
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

      <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/gallery/college-bg.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Student Activities</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Student Activities</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->
     <?php include('scroll.php'); ?>

    <div class="containers">
        <div class="header">
            <h1>Student Feedback Form</h1>
            <p>TKS College of Arts & Science - Academic Year 2024-25</p>
        </div>

        <div class="form-content">
            <div class="success-message" id="successMessage">
                ✓ Thank you! Your feedback has been submitted successfully.
            </div>

            <div class="error-message" id="errorMessage">
                Please fill all required fields and provide ratings for all questions.
            </div>

            <form id="feedbackForm">
                <div class="form-group">
                    <label>Name of the Student <span class="required">*</span></label>
                    <input type="text" name="studentName" required>
                </div>

                <div class="form-group">
                    <label>Degree <span class="required">*</span></label>
                    <select name="degree" required>
                        <option value="">Select Degree</option>
                        <option value="B.Sc Computer Science">B.Sc Computer Science</option>
                        <option value="B.Sc Information Technology">B.Sc Information Technology</option>
                        <option value="BCA">BCA</option>
                        <option value="B.Sc Mathematics">B.Sc Mathematics</option>
                        <option value="B.Com">B.Com</option>
                        <option value="BA English">BA English</option>
                        <option value="M.Sc Computer Science">M.Sc Computer Science</option>
                        <option value="MBA">MBA</option>
                        <option value="MCA">MCA</option>
                    </select>
                </div>

                <div class="rating-section">
                    <h2>Questions on Academics</h2>
                    
                    <div class="rating-legend">
                        <p><strong>Rating Scale:</strong></p>
                        <p>4 - Excellent | 3 - Good | 2 - Satisfactory | 1 - Poor</p>
                    </div>

                    <div id="questionsContainer"></div>
                </div>

                <div class="form-group">
                    <label>Suggestions for Improvements</label>
                    <textarea name="suggestions" placeholder="Please share your suggestions to help us improve..."></textarea>
                </div>

                <button type="submit" class="submit-btn">Submit Feedback</button>
            </form>
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
                            <a href="#" class="footer-logo">
                                <img src="assets/img/logo/logo-light.png" alt="">
                            </a>
                            <p class="mb-3">
TKS College is dedicated to providing quality education through innovative teaching, strong academic foundations, and a supportive learning environment. The institution actively fosters research, critical thinking, and practical learning to prepare students for real-world challenges. We are committed to nurturing students to excel academically, professionally, and ethically by empowering young minds with knowledge, skills, confidence, and strong values that shape responsible and successful individuals.
                            </p>
                            <ul class="footer-contact">
                                <li><a href="tel:+21236547898"><i class="far fa-phone"></i>+2 123 654 7898</a></li>
                                <li><i class="far fa-map-marker-alt"></i>25/B Milford Road, New York</li>
                                <li><a href="https://live.themewild.com/cdn-cgi/l/email-protection#224b4c444d62475a434f524e470c414d4f"><i
                                            class="far fa-envelope"></i><span class="__cf_email__" data-cfemail="81e8efe7eec1e4f9e0ecf1ede4afe2eeec">[email&#160;protected]</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Quick Links</h4>
                            <ul class="footer-list">
                                <li><a href="#"><i class="fas fa-caret-right"></i> About Us</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> FAQ's</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Testimonials</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Terms Of Service</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Privacy policy</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Update News</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Our Campus</h4>
                            <ul class="footer-list">
                                <li><a href="#"><i class="fas fa-caret-right"></i> Campus Safety</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Student Activities</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Academic Department</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Planning & Administration</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Office Of The Chancellor</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i> Facility Services</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Newsletter</h4>
                            <div class="footer-newsletter">
                                <p>Subscribe Our Newsletter To Get Latest Update And News</p>
                                <div class="subscribe-form">
                                    <form action="#">
                                        <input type="email" class="form-control" placeholder="Your Email">
                                        <button class="theme-btn" type="submit">
                                            Subscribe Now <i class="far fa-paper-plane"></i>
                                        </button>
                                    </form>
                                </div>
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
                                &copy; Copyright <span id="date"></span> <a href="#"> Eduka </a> All Rights Reserved.
                            </p>
                        </div>
                        <div class="col-md-6 align-self-center">
                            <ul class="footer-social">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->

    <script>
        const questions = [
            "Extent of syllabi covered in the class",
            "Overall experience with internal assessment",
            "Integration of theory and Practical classes (wherever applicable)",
            "Opportunity to participate in activities beyond the classroom (Workshops/ Projects / Fieldwork)",
            "Student Teacher Interaction",
            "Extracurricular Activities",
            "Involvement in Clubs & Committee",
            "Collection of books, journals and reading material of the college Library",
            "Fulfilling the duties and responsibilities of Complaint Redressal Committees in the college",
            "Fulfilling the duties and responsibilities of Discipline Committee of college",
            "Wi-Fi and Internet facility",
            "Canteen facilities: Food Quality, Ambience",
            "Support staff",
            "Class room Infrastructure",
            "Girls Common Room (only for female students)",
            "Drinking water facility",
            "Greenery in the college campus",
            "Cleanliness and maintenance of college premises, washrooms",
            "Physical Infrastructure of the college Library",
            "Amenities and Assistance provided at the Sports ground"
        ];

        const ratingLabels = {
            1: "Poor",
            2: "Satisfactory",
            3: "Good",
            4: "Excellent"
        };

        const ratings = {};

        function renderQuestions() {
            const container = document.getElementById('questionsContainer');
            
            questions.forEach((question, index) => {
                const questionNum = index + 1;
                const questionDiv = document.createElement('div');
                questionDiv.className = 'question-item';
                questionDiv.innerHTML = `
                    <div class="question-text">${questionNum}. ${question} <span class="required">*</span></div>
                    <div class="rating-buttons" data-question="${questionNum}">
                        ${[1, 2, 3, 4].map(rating => `
                            <button type="button" class="rating-btn" data-rating="${rating}" onclick="selectRating(${questionNum}, ${rating})">
                                <span class="rating-value">${rating}</span>
                                <span class="rating-label">${ratingLabels[rating]}</span>
                            </button>
                        `).join('')}
                    </div>
                `;
                container.appendChild(questionDiv);
            });
        }

        function selectRating(questionNum, rating) {
            ratings[questionNum] = rating;
            
            const buttons = document.querySelectorAll(`[data-question="${questionNum}"] .rating-btn`);
            buttons.forEach(btn => {
                btn.classList.remove('selected');
                if (parseInt(btn.dataset.rating) === rating) {
                    btn.classList.add('selected');
                }
            });
        }

        document.getElementById('feedbackForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const successMsg = document.getElementById('successMessage');
            const errorMsg = document.getElementById('errorMessage');
            
            successMsg.style.display = 'none';
            errorMsg.style.display = 'none';
            
            const studentName = this.studentName.value.trim();
            const degree = this.degree.value;
            const suggestions = this.suggestions.value.trim();
            
            if (!studentName || !degree) {
                errorMsg.textContent = 'Please fill in your name and select your degree.';
                errorMsg.style.display = 'block';
                errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            
            if (Object.keys(ratings).length !== questions.length) {
                errorMsg.textContent = 'Please provide ratings for all questions.';
                errorMsg.style.display = 'block';
                errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            
            const formData = {
                studentName,
                degree,
                ratings,
                suggestions,
                timestamp: new Date().toISOString()
            };
            
            console.log('Feedback submitted:', formData);
            
            successMsg.style.display = 'block';
            successMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            setTimeout(() => {
                this.reset();
                Object.keys(ratings).forEach(key => delete ratings[key]);
                document.querySelectorAll('.rating-btn.selected').forEach(btn => {
                    btn.classList.remove('selected');
                });
                successMsg.style.display = 'none';
            }, 3000);
        });

        renderQuestions();
    </script>

    <script>
        document.getElementById('feedbackForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const successMsg = document.getElementById('successMessage');
            const errorMsg = document.getElementById('errorMessage');
            const submitBtn = this.querySelector('.submit-btn');
            
            successMsg.style.display = 'none';
            errorMsg.style.display = 'none';
            
            const studentName = this.studentName.value.trim();
            const degree = this.degree.value;
            const suggestions = this.suggestions.value.trim();
            
            if (!studentName || !degree) {
                errorMsg.textContent = 'Please fill in your name and select your degree.';
                errorMsg.style.display = 'block';
                errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            
            if (Object.keys(ratings).length !== questions.length) {
                errorMsg.textContent = 'Please provide ratings for all questions.';
                errorMsg.style.display = 'block';
                errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            
            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
            
            // Prepare form data
            const formData = new FormData();
            formData.append('studentName', studentName);
            formData.append('degree', degree);
            formData.append('suggestions', suggestions);
            formData.append('ratings', JSON.stringify(ratings));
            
            // Submit via AJAX
            fetch('submit_student_feedback.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    successMsg.style.display = 'block';
                    successMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    setTimeout(() => {
                        this.reset();
                        Object.keys(ratings).forEach(key => delete ratings[key]);
                        document.querySelectorAll('.rating-btn.selected').forEach(btn => {
                            btn.classList.remove('selected');
                        });
                        successMsg.style.display = 'none';
                    }, 3000);
                } else {
                    errorMsg.textContent = data.message || 'Error submitting feedback. Please try again.';
                    errorMsg.style.display = 'block';
                    errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorMsg.textContent = 'Network error. Please check your connection and try again.';
                errorMsg.style.display = 'block';
                errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Feedback';
            });
        });
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
    <script src="assets/js/navbar-fix.js"></script><script src="assets/js/main.js"></script>                                           <script src="assets/js/sidebar.js"></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>