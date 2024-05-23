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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">

</head>
<body>
        <video autoplay loop muted plays-inline class="back-video">
            <source src="../images/video.mp4" type="video/mp4">
        </video>
    <div class="container">


        <div class="logo-container">
            <img src="../images/nuovologopiccolomanontroppo.png" class="logo" alt="WorldWideJob Logo">
        </div> 

        <div class="wrapper">
        
            <form name="reg" action="../database/login.php" method="post" onsubmit="return submitForm(event)">
    
                <h1>Login</h1>
                <div class="message message-login" id="login-message"></div>
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
    
                <button type="submit" id="login-btn" name="login" class="btn" >Login</button>
    
                <div class="register-link">
                    <p>Don't have an account?<a href="../sign-up/sign-up.php"> Sign Up</a></p>
                </div>
            </form>
        </div>

    </div>
    <script src="script.js"></script>
</body>
</html>
