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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  
    if ($article->delete($conn)) {
          //$id = mysqli_insert_id($conn);

          $workingDirectory = '';
          
          if (strpos(getcwd(), '\\')) {
      
              $workingDirectory = str_replace('\\', '/', getcwd());

          } else {
              $workingDirectory = getcwd();
          }
          $directory = str_replace($_SERVER['DOCUMENT_ROOT'], '', $workingDirectory);
          redirect("$directory/1index.php");
          
      } 
  
  }

?>


<?php require 'includes/header.php'; ?>

<h2>Delete article</h2>
<p>Are you sure?</p>

<form method="post">
    <button>Delete</button>
</form>
<a href="article.php?id=<?= $article->id; ?>">Cancel</a>

<?php require 'includes/footer.php'; ?>