<?php
/**
 * Shared admin gate.
 * Include at the very top of every admin page, before any other code:
 *
 *     require_once __DIR__ . '/auth.php';
 *
 * For JSON/AJAX endpoints, add this line BEFORE the include so they get a
 * 401 response instead of a redirect:
 *
 *     define('ADMIN_JSON', true);
 *
 * To restrict a page to super admins only, add this BEFORE the include:
 *
 *     define('ADMIN_REQUIRE_SUPER', true);
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Logged in as an admin? (set by admin-login.php)
$__isAdmin = !empty($_SESSION['admin_id']) && !empty($_SESSION['admin_email']);

// Optional super-admin restriction
if ($__isAdmin && defined('ADMIN_REQUIRE_SUPER') && ADMIN_REQUIRE_SUPER) {
    $__isAdmin = (($_SESSION['admin_role'] ?? '') === 'super_admin');
}

if (!$__isAdmin) {
    if (defined('ADMIN_JSON') && ADMIN_JSON) {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    } else {
        header('Location: ../admin-login.php');
    }
    exit;
}

unset($__isAdmin);
