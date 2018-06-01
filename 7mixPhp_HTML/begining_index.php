<?php 
    $name = 'Tadas';
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
    <h1>Lorem ipsum</h1>

    <p>Hello, <?php echo $name; ?></p>
    <p>Hello, <?= $name; ?></p><!-- to echo a value, short tag -->
</body>
</html>