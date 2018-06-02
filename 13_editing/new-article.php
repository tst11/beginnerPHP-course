<?php 

require 'includes/database.php';

$errors = [];
$title = '';
$content = '';
$published_at = '';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    if ($title == '') {
        $errors[] = 'Title is required';
        //die('Title is required');
    }

    if ($content == '') {
        $errors[] = 'Content is required';
        //die('Title is required');
    }

    if ($published_at != '') {
        $date_time = date_create_from_format('Y-m-d H:i:s', $published_at);

        if($date_time === false) {
            $errors[] = "Invalid date and time: $published_at";
        } else {
            $date_errors = date_get_last_errors();

            if ($date_errors['warning_count'] > 0) {
                $errors[] = 'Invalid date and time';
            }
            //echo date_format($date_time, 'Y-m-d H:i:s'); exit;
        }
    }

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

                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                    $protocol = 'https';
                } else {
                    $protocol = 'http';
                }

                $directory = str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd());
                
                header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "$directory/article.php?id=$id");
                
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