<?php 

require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';

$conn = getDB();
//echo "Connected successfully.";
if (isset($_GET['id'])) {
    
    $article = getArticle($conn, $_GET['id']);

    if ($article) {

        $id = $article['id'];
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    } else {
        die("article not found");
    }


} else {
    //$article = null;
    die("id not supplied, article not found");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    //var_dump($errors); exit;

    if(empty($errors)) {
        
        //$conn = getDB();

        $sql = "UPDATE article 
                SET title = ?,
                    content = ?, 
                    published_at = ?
                WHERE id = ?";

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
            mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);
            
            if(mysqli_stmt_execute($stmt)) {
                
                $workingDirectory = '';

                if (strpos(getcwd(), '\\')) {
          
                    $workingDirectory = str_replace('\\', '/', getcwd());

                } else {
                    $workingDirectory = getcwd();
                }

                $directory = str_replace($_SERVER['DOCUMENT_ROOT'], '', $workingDirectory);
                // echo '<br>Directory<br>';
                // echo $directory;
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

<h2>Edit article</h2>

<?php require 'includes/article-form.php' ?>

<?php require 'includes/footer.php'; ?>