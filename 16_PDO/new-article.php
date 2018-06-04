<?php 

require 'classes/Database.php';
require 'classes/Article.php';
require 'includes/url.php';
require 'includes/auth.php';

session_start();

if (! isLoggedIn()) {
    die("unauthorised");
}

$article = new Article();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $db = new Database();
    $conn = $db->getConn();
    
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];
        
    if ($article->create($conn)) {
            
        $workingDirectory = '';

        if (strpos(getcwd(), '\\')) {
    
            $workingDirectory = str_replace('\\', '/', getcwd());

        } else {
            $workingDirectory = getcwd();
        }

        $directory = str_replace($_SERVER['DOCUMENT_ROOT'], '', $workingDirectory);
        // echo '<br>Directory<br>';
        // echo $directory;
        redirect("$directory/article.php?id={$article->id}");
        //header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "$directory/article.php?id=$id");
        
    } 
    
}

?>

<?php require 'includes/header.php'; ?>

<h2>New article</h2>

<?php require 'includes/article-form.php' ?>

<?php require 'includes/footer.php'; ?>