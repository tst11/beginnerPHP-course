<?php

require 'includes/url.php';
require 'classes/User.php';
require 'classes/Database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $db = new Database();
    $conn = $db->getConn();

    if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {
        

        session_regenerate_id(true);
        
        $workingDirectory = '';
        
        if (strpos(getcwd(), '\\')) {
    
            $workingDirectory = str_replace('\\', '/', getcwd());

        } else {
            $workingDirectory = getcwd();
        }

        $directory = str_replace($_SERVER['DOCUMENT_ROOT'], '', $workingDirectory);
        $_SESSION['is_logged_in'] = true;
        redirect("$directory/1index.php");
    } else {
        $error = "login incorrect";
    }

}

?>

<?php require 'includes/header.php'; ?>

<h1>Login</h1>

<?php if (! empty($error)): ?>
    <p><?= $error; ?></p>
<?php endif; ?>

<form method="post">
    <div>
        <label for="username">Username</label>
        <input name="username" id="username" type="text">
    </div>

    <div>
        <label for="username">Password</label>
        <input name="password" id="password" type="password">
    </div>

    <button>Log in</button>
</form>

<?php require 'includes/footer.php'; ?>