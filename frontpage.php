<?php
session_start();

if (isset($_SESSION['session_id'])) {
    header('Location: ../home/main.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WorldWideJob</title>

    <link rel="icon" href="images/nuovologopiccolo.png" type="image/icon type">
    <link rel="stylesheet" href="frontpage_style/style.css">

    
</head>
<body>

<video autoplay loop muted plays-inline class="back-video">
        <source src="images/video.mp4" type="video/mp4">
    </video>
    <div class="container">
        <div class="logo-container"><img src="images/nuovologopiccolomanontroppo.png" class="logo" alt="WorldWideJob Logo"></div>       
        <div class="content">
            <h1>WorldWideJob</h1>
            <a href="./sign-in/sign-in.php">Sign In</a>
            <a href="./sign-up/sign-up.php">Sign Up</a>
        </div>
    </div>

</body>
</html>