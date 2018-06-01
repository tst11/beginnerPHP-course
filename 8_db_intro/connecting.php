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

echo "Connected successfully.";

$sql = "SELECT *
        FROM article
        ORDER BY published_at;";

$results = mysqli_query($conn, $sql);
//phpinfo();
// if ($results === false) {
//     echo mysqli_error($conn);
// } else {
//     $articles = $results->fetch_assoc();
//     //$articles = mysqli_fetch_all($results, MYSQLI_ASSOC);

//     var_dump($articles);
// }
$mysqlnd = function_exists('mysqli_fetch_all');

if ($mysqlnd) {
    echo 'mysqlnd enabled!';
} else {
    echo 'doesn\'t exists';
}
// if ($results === false) {
//     echo mysqli_error($conn);
// } else {
//     //$articles = $results->fetch_assoc();
//     $articles = mysqli_result::fetch_all($results);
    
// }
// var_dump($articles);