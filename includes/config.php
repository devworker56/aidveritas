<?php
// AidVeritas Web Portal Configuration
session_start();

// Environment Configuration
define('SITE_NAME', 'AidVeritas');
define('SITE_URL', 'https://aidveritas.com');
define('DEFAULT_LANGUAGE', 'fr');
define('SUPPORTED_LANGUAGES', ['fr', 'en']);

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'u834808878_db_aidveritas');
define('DB_USER', 'u834808878_AidveritasAdm');
define('DB_PASS', 'Ossouka@1968');
define('DB_CHARSET', 'utf8mb4');

// Pusher Configuration
define('PUSHER_APP_ID', 'your_pusher_app_id');
define('PUSHER_KEY', 'your_pusher_key');
define('PUSHER_SECRET', 'your_pusher_secret');
define('PUSHER_CLUSTER', 'mt1');

// Security Configuration
define('ENCRYPTION_KEY', 'your_encryption_key_here');
define('HASH_ALGO', 'sha256');

// File Paths
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('RECEIPTS_PATH', __DIR__ . '/../receipts/');

// CRA Receipt Settings
define('CRA_RECEIPT_PREFIX', 'AVR');
define('CRA_RECEIPT_YEAR', date('Y'));

// Error Reporting
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Auto-load classes
spl_autoload_register(function ($class_name) {
    $file = __DIR__ . '/../classes/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Set language
$current_language = DEFAULT_LANGUAGE;
if (isset($_GET['lang']) && in_array($_GET['lang'], SUPPORTED_LANGUAGES)) {
    $current_language = $_GET['lang'];
    $_SESSION['language'] = $current_language;
    
    // Handle redirect after language change
    if (isset($_GET['redirect'])) {
        header('Location: ' . $_GET['redirect']);
        exit;
    }
} elseif (isset($_SESSION['language'])) {
    $current_language = $_SESSION['language'];
}