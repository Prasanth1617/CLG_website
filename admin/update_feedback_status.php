<?php
define('ADMIN_JSON', true);
require_once __DIR__ . '/auth.php';
include 'db.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$type = isset($input['type']) ? $input['type'] : '';
$id = isset($input['id']) ? intval($input['id']) : 0;
$status = isset($input['status']) ? $input['status'] : '';

if ($id === 0 || $status === '') {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

// Validate status
$validStatuses = ['pending', 'reviewed', 'archived'];
if (!in_array($status, $validStatuses)) {
    echo json_encode(['success' => false, 'message' => 'Invalid status']);
    exit;
}

if ($type === 'student') {
    $table = 'student_feedback';
} else {
    $table = 'staff_feedback';
}

$query = "UPDATE $table SET status = '" . mysqli_real_escape_string($conn, $status) . "' WHERE id = " . $id;

if (mysqli_query($conn, $query)) {
    echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating status: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?>