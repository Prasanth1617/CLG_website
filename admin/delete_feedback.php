<?php
define('ADMIN_JSON', true);
require_once __DIR__ . '/auth.php';
include 'db.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$type = isset($input['type']) ? $input['type'] : '';
$id = isset($input['id']) ? intval($input['id']) : 0;

if ($id === 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

if ($type === 'student') {
    $table = 'student_feedback';
} else {
    $table = 'staff_feedback';
}

$query = "DELETE FROM $table WHERE id = " . $id;

if (mysqli_query($conn, $query)) {
    echo json_encode(['success' => true, 'message' => 'Feedback deleted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting feedback: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?>