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

    <title>WorldWideJob Sign In</title>

    <link rel="icon" href="../images/nuovologopiccolo.png" type="image/icon type">

    <!-- ===== Boxicons ===== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="style.css">

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
        <video autoplay loop muted plays-inline class="back-video">
            <source src="../images/video.mp4" type="video/mp4">
        </video>

        <nav>
            <img src="../images/nuovologopiccolo.png" class="logo" alt="WorldWideJob Logo">
        </nav>

        <div class="wrapper">
        
            <form action="../database/login.php" method="post">
    
                <h1>Login</h1>
    
                <div class="input-box">
                    <input type="text" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope' ></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
    
                <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
    
                <button type="submit" name="login" class="btn">Login</button>
    
                <div class="register-link">
                    <p>Don't have an account?<a href="../sign-up/sign-up.php"> Sign Up</a></p>
                </div>
            </form>
        </div>

    </div>

</body>
</html>
