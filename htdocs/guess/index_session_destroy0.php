<?php
namespace Peal\Dice100;

/**
 * Destroy session
 */
 include(__DIR__ . '/config.php');
 include(__DIR__ . '/../../vendor/autoload.php');

session_name('Dice100');
session_start();

// Unset session variables
$_SESSION = [];

// Delete the session cookie
// Destroys session, not just session data
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() -42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Finally destroy the session
session_destroy();
echo 'The session is destroyed';
