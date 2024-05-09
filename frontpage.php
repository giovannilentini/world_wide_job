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

    <link rel="stylesheet" href="frontpage_style/stylelittle.css" media="screen and (max-width: 768px)">
    <link rel="stylesheet" href="frontpage_style/style.css" media="screen and (min-width:769px)">

    <script>
        window.addEventListener('keydown', function(event) {
            if ((event.ctrlKey || event.metaKey) && (event.key === '+' || event.key === '-' || event.key === '0')) {
                event.preventDefault();
            }
        });
    
        window.addEventListener('wheel', function(event) {
            if (event.ctrlKey || event.metaKey) {
                event.preventDefault();
            }
        });

        function resetZoom() {
        document.body.style.zoom = '90%';
    }
    </script>
    
</head>
<body>

    <div class="hero">
        <!--  <img src="images/sfondo.jpg" class="back-video">   -->
        
        <video autoplay loop muted plays-inline class="back-video">
            <source src="images/video.mp4" type="video/mp4">
        </video>
    

        <nav>
            <img src="images/nuovologopiccolomanontroppo.png" class="logo" alt="WorldWideJob Logo">
           
        </nav>

        <div class="content">
            <h1>WorldWideJob</h1>
            <a href="./sign-in/sign-in.php">Sign In</a>
            <a href="./sign-up/sign-up.php">Sign Up</a>
        </div>
    </div>

</body>
</html>