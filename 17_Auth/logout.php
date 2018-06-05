<?php

require 'includes/url.php';

session_start();

//$_SESSION['is_logged_in'] = false;

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

$workingDirectory = '';

if (strpos(getcwd(), '\\')) {

    $workingDirectory = str_replace('\\', '/', getcwd());

} else {
    $workingDirectory = getcwd();
}

$directory = str_replace($_SERVER['DOCUMENT_ROOT'], '', $workingDirectory);

redirect("$directory/1index.php");