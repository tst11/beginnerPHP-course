<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {

    require 'includes/database.php';

    $sql = "INSERT INTO article (title, content, published_at)
            VALUES (?,?,?)";

    //var_dump($sql); exit;;
    $stmt = mysqli_prepare($conn, $sql);
    //$results = mysqli_query($conn, $sql);
    //phpinfo();
    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        //$article = mysqli_fetch_assoc($results);
        mysqli_stmt_bind_param($stmt, "sss", $_POST['title'], $_POST['content'], $_POST['published_at']);
        
        if(mysqli_stmt_execute($stmt)) {
            $id = mysqli_insert_id($conn);
            echo "Inserted record with ID: $id";
        } else {
            echo mysqli_stmt_error($stmt);
        }
        
        
    }
}

?>

<?php require 'includes/header.php'; ?>

<h2>New article</h2>

<form method="post">
    <div>
        <label for="title">Title</label>
        <input name="title" id="title" type="text" placeholder="Article title">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" type="text" placeholder="Article content"></textarea>
    </div>

    <div>
        <label for="published_at">Publication date and time</label>
        <input id="published_at" name="published_at" type="datetime-local">
    </div>

    <button>Add</button>
    
</form>

<?php require 'includes/footer.php'; ?>