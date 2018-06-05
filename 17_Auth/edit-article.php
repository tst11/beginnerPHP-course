<?php 

require 'classes/Database.php';
require 'classes/Article.php';
require 'includes/url.php';

$db = new Database();
$conn = $db->getConn();
//echo "Connected successfully.";
if (isset($_GET['id'])) {
    
    $article = Article::getByID($conn, $_GET['id']);

    if (!$article)  {
        die("article not found");
    }


} else {
    //$article = null;
    die("id not supplied, article not found");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];
        
        if ($article->update($conn)) {
                
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

<h2>Edit article</h2>

<?php require 'includes/article-form.php' ?>

<?php require 'includes/footer.php'; ?>