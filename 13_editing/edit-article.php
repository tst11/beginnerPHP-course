<?php 

require 'includes/database.php';
require 'includes/article.php';

$conn = getDB();
//echo "Connected successfully.";
if (isset($_GET['id'])) {
    
    $article = getArticle($conn, $_GET['id']);

} else {
    $article = null;
}

var_dump($article);