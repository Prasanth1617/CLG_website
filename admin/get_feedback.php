<?php
define('ADMIN_JSON', true);
require_once __DIR__ . '/auth.php';
include 'db.php';

header('Content-Type: application/json');

$type = isset($_GET['type']) ? $_GET['type'] : 'student';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

if ($type === 'student') {
    $table = 'student_feedback';
    $nameField = 'student_name';
} else {
    $table = 'staff_feedback';
    $nameField = 'teacher_name';
}

// Build query
$query = "SELECT * FROM $table";

// Add status filter
if ($status !== '') {
    $query .= " WHERE status = '" . mysqli_real_escape_string($conn, $status) . "'";
}

// Add sorting
switch ($sort) {
    case 'oldest':
        $query .= " ORDER BY created_at ASC";
        break;
    case 'highest':
        $query .= " ORDER BY average_rating DESC";
        break;
    case 'lowest':
        $query .= " ORDER BY average_rating ASC";
        break;
    case 'newest':
    default:
        $query .= " ORDER BY created_at DESC";
        break;
}

$result = mysqli_query($conn, $query);

$feedbackList = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $feedbackList[] = $row;
    }
}

echo json_encode($feedbackList);

mysqli_close($conn);
?>