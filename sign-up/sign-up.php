<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>WorldWideJob Sign Up</title>

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
            <form name="reg" action="../database/registration.php" method="POST" onsubmit="return checkAge()">
    
                <h1>Sign Up</h1>
    
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
                <div class="input-box">
                    <input type="text" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope' ></i>
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

        <div id="message" style="display: none;"></div>

    </div>
    
    <script>
        function checkAge() {
            var today = new Date();
            var birthdate = new Date(document.reg.birthdate.value);
            var age = today.getFullYear() - birthdate.getFullYear();
            var m = today.getMonth() - birthdate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            if (age < 18) {
                alert("Devi avere almeno 18 anni per registrarti.");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>