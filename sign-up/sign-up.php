<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WorldWideJob Sign Up</title>
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
            <form name="reg" action="../database/registration.php" method="POST" onsubmit="return submitForm(event)">
                <h1>Sign Up</h1>
                <div class="message message-login" id="login-message"></div>
                <div class="input-box">
                    <input type="text" name="name" placeholder="Nome" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="surname" placeholder="Cognome" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="date" name="birthdate" placeholder="Data di nascita" required>
                    <i class="bx bx-calendar"></i>
                </div>
                <div class="input-box" id="email-box">
                    <input type="text" name="email" placeholder="Email" id="email-form" required>
                    <i class='bx bxs-envelope' ></i>
                    <div class="message" id="email-message"></div>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
    
                <button type="submit" id="submit-btn" name="register" class="btn">Register</button>

    
                <div class="login-link">
                    <p>Already have an account?<a href="../sign-in/sign-in.php"> Sign In</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>

</body>
</html>