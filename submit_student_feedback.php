<?php
include 'admin/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $studentName = mysqli_real_escape_string($conn, $_POST['studentName']);
    $degree = mysqli_real_escape_string($conn, $_POST['degree']);
    $suggestions = mysqli_real_escape_string($conn, $_POST['suggestions']);
    
    // Get all ratings
    $ratings = json_decode($_POST['ratings'], true);
    
    // Calculate average rating
    $totalRating = 0;
    $ratingCount = count($ratings);
    
    $ratingFields = [];
    $ratingValues = [];
    
    for ($i = 1; $i <= 20; $i++) {
        $rating = isset($ratings[$i]) ? intval($ratings[$i]) : 0;
        $ratingFields[] = "q{$i}_rating";
        $ratingValues[] = $rating;
        $totalRating += $rating;
    }
    
    $averageRating = $ratingCount > 0 ? round($totalRating / $ratingCount, 2) : 0;
    
    // Prepare SQL
    $fields = implode(', ', $ratingFields);
    $placeholders = implode(', ', array_fill(0, count($ratingValues), '?'));
    
    $sql = "INSERT INTO student_feedback 
            (student_name, degree, $fields, suggestions, average_rating) 
            VALUES (?, ?, $placeholders, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        // Create types string for bind_param
        $types = 'ss' . str_repeat('i', 20) . 'sd';
        
        // Create array of values to bind
        $bindValues = array_merge(
            [$studentName, $degree],
            $ratingValues,
            [$suggestions, $averageRating]
        );
        
        // Bind parameters
        $bindParams = [$stmt, $types];
        foreach ($bindValues as $key => $value) {
            $bindParams[] = &$bindValues[$key];
        }
        call_user_func_array('mysqli_stmt_bind_param', $bindParams);
        
        // Execute
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode([
                'success' => true,
                'message' => 'Feedback submitted successfully!',
                'feedbackId' => mysqli_insert_id($conn)
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error submitting feedback: ' . mysqli_error($conn)
            ]);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error preparing statement: ' . mysqli_error($conn)
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}

mysqli_close($conn);
?>