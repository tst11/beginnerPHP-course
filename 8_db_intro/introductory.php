<?php 

$db_host = "localhost";
$db_name = "cms";
$db_user = "tadasdev";
$db_pass = "tadasdev";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}

//echo "Connected successfully.";

$sql = "SELECT *
        FROM article
        ORDER BY published_at;";

$results = mysqli_query($conn, $sql);
//phpinfo();
if ($results === false) {
    echo mysqli_error($conn);
} else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Blog</h1>

    <?php if (empty($articles)): ?>
    <p>No articles found.</p>
    <?php else: ?>
    <ul>        
        <?php foreach($articles as $article): ?>
        <li>
            
            <article>
                <h2><?= $article['title']; ?></h2>
                <p><?= $article['content']; ?></p>
            </article>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</body>
</html>