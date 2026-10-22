<?php
define('ADMIN_JSON', true);
require_once __DIR__ . '/auth.php';
include 'db.php';

header('Content-Type: application/json');

$type = isset($_GET['type']) ? $_GET['type'] : 'student';

if ($type === 'student') {
    $table = 'student_feedback';
} else {
    $table = 'staff_feedback';
}

// Get total count
$totalQuery = "SELECT COUNT(*) as total FROM $table";
$totalResult = mysqli_query($conn, $totalQuery);
$total = mysqli_fetch_assoc($totalResult)['total'];

// Get pending count
$pendingQuery = "SELECT COUNT(*) as pending FROM $table WHERE status = 'pending'";
$pendingResult = mysqli_query($conn, $pendingQuery);
$pending = mysqli_fetch_assoc($pendingResult)['pending'];

// Get reviewed count
$reviewedQuery = "SELECT COUNT(*) as reviewed FROM $table WHERE status = 'reviewed'";
$reviewedResult = mysqli_query($conn, $reviewedQuery);
$reviewed = mysqli_fetch_assoc($reviewedResult)['reviewed'];

// Get average rating
$avgQuery = "SELECT AVG(average_rating) as avg_rating FROM $table";
$avgResult = mysqli_query($conn, $avgQuery);
$avgRating = mysqli_fetch_assoc($avgResult)['avg_rating'];

$stats = [
    'total' => $total,
    'pending' => $pending,
    'reviewed' => $reviewed,
    'average_rating' => $avgRating ? number_format($avgRating, 2) : '0.00'
];

echo json_encode($stats);

mysqli_close($conn);
?>