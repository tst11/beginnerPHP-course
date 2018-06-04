<?php 

require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';

$conn = getDB();
//echo "Connected successfully.";
if (isset($_GET['id'])) {
    
    $article = getArticle($conn, $_GET['id'], 'id');

    if ($article) {

        $id = $article['id'];
        
    } else {
        die("article not found");
    }


} else {
    //$article = null;
    die("id not supplied, article not found");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $sql = "DELETE FROM article 
        WHERE id = ?";

  //var_dump($sql); exit;;
  $stmt = mysqli_prepare($conn, $sql);
  //$results = mysqli_query($conn, $sql);
  //phpinfo();
  if ($stmt === false) {
      echo mysqli_error($conn);
  } else {
      // if ($published_at == '') {
      //     $published_at = null;
      // }

      //$article = mysqli_fetch_assoc($results);
      mysqli_stmt_bind_param($stmt, "i", $id);
      
      if(mysqli_stmt_execute($stmt)) {
          //$id = mysqli_insert_id($conn);

          $workingDirectory = '';
          
          if (strpos(getcwd(), '\\')) {
      
              $workingDirectory = str_replace('\\', '/', getcwd());

          } else {
              $workingDirectory = getcwd();
          }
          $directory = str_replace($_SERVER['DOCUMENT_ROOT'], '', $workingDirectory);
          redirect("$directory/1index.php");
          //header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "$directory/article.php?id=$id");
          
      } else {
          echo mysqli_stmt_error($stmt);
      }
      
      
  }
}
?>


<?php require 'includes/header.php'; ?>

<h2>Delete article</h2>
<p>Are you sure?</p>

<form method="post">
    <button>Delete</button>
</form>
<a href="article.php?id=<?= $id; ?>">Cancel</a>

<?php require 'includes/footer.php'; ?>