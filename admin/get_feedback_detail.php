<?php
include 'db.php';

header('Content-Type: application/json');

$type = isset($_GET['type']) ? $_GET['type'] : 'student';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id === 0) {
    echo json_encode(['error' => 'Invalid ID']);
    exit;
}

// Define questions based on type
$studentQuestions = [
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

$staffQuestions = [
    "Teachers monitor complete academic performance of students and adopt teaching methodologies that suit different learners.",
    "Teachers are facilitated with Laptops, LCD projectors and WIFI to enhance ICT teaching learning method",
    "Teachers blend additional certification and skill development programs in delivering curriculum and facilitate to learn new skills for employability and enhance life-long learning.",
    "Teachers mentoring the students in regular basis on both academic and non-academics for their Carrier development.",
    "Academics, co and extra-curricular opportunities and facilities and ambience shaped the personality of students in terms of values, ethics, and attitudes.",
    "Institute has enabled on-line information systems which provides up to date information to students, parents and faculty",
    "Institute promotes sponsored research, research publications, consultancy, faculty developments, patents etc., though faculty motivation and financial support.",
    "Class rooms and Laboratory ambience are good for effective instructional delivery and practice.",
    "Library facilities are good with enormous number of books, eBooks, e-Journals etc., for self-learning and research.",
    "The initiatives towards co-curricular activities helped in nurturing natural talents and achieving accolades.",
    "Sports and games helped in maintaining good health and in participating in inter institutional events.",
    "Canteen, Mess, Dinning, and Hostel Facilities are adequate and hygienic.",
    "Inclusive infrastructure meeting the needs of differently-abled stake-holders",
    "Clean and Green Plastic-free campus; promotes healthy interaction of students, teachers and other stake-holders."
];

if ($type === 'student') {
    $table = 'student_feedback';
    $questions = $studentQuestions;
    $questionCount = 20;
} else {
    $table = 'staff_feedback';
    $questions = $staffQuestions;
    $questionCount = 14;
}

// Get feedback data
$query = "SELECT * FROM $table WHERE id = " . $id;
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $feedback = mysqli_fetch_assoc($result);
    
    // Extract ratings
    $ratings = [];
    for ($i = 1; $i <= $questionCount; $i++) {
        $ratings["q{$i}"] = intval($feedback["q{$i}_rating"]);
    }
    
    // Prepare response
    $response = [
        'id' => $feedback['id'],
        'average_rating' => $feedback['average_rating'],
        'suggestions' => $feedback['suggestions'],
        'status' => $feedback['status'],
        'created_at' => $feedback['created_at'],
        'updated_at' => $feedback['updated_at'],
        'ratings' => $ratings,
        'questions' => $questions
    ];
    
    if ($type === 'student') {
        $response['student_name'] = $feedback['student_name'];
        $response['degree'] = $feedback['degree'];
    } else {
        $response['teacher_name'] = $feedback['teacher_name'];
        $response['email'] = $feedback['email'];
        $response['designation'] = $feedback['designation'];
    }
    
    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Feedback not found']);
}

mysqli_close($conn);
?>