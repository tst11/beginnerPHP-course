<?php 

require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';
require 'includes/auth.php';

session_start();

if (! isLoggedIn()) {
    die("unauthorised");
}

$title = '';
$content = '';
$published_at = '';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    //var_dump($errors); exit;

    if(empty($errors)) {
        $conn = getDB();

        $sql = "INSERT INTO article (title, content, published_at)
                VALUES (?,?,?)";

        //var_dump($sql); exit;;
        $stmt = mysqli_prepare($conn, $sql);
        //$results = mysqli_query($conn, $sql);
        //phpinfo();
        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            if ($published_at == '') {
                $published_at = null;
            }

            //$article = mysqli_fetch_assoc($results);
            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);
            
            if(mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conn);

                // if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                //     $protocol = 'https';
                // } else {
                //     $protocol = 'http';
                // }

                $workingDirectory = '';
                
                if (strpos(getcwd(), '\\')) {
            
                    $workingDirectory = str_replace('\\', '/', getcwd());

                } else {
                    $workingDirectory = getcwd();
                }

                $directory = str_replace($_SERVER['DOCUMENT_ROOT'], '', $workingDirectory);

                redirect("$directory/article.php?id=$id");
                //header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "$directory/article.php?id=$id");
                
            } else {
                echo mysqli_stmt_error($stmt);
            }
            
            
        }
    }
    
}

?>

<?php require 'includes/header.php'; ?>

<h2>New article</h2>

<?php require 'includes/article-form.php' ?>

<?php require 'includes/footer.php'; ?>