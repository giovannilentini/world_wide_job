<?php
session_start();

$profile_image_folder = '../profileimages/';
$session_id = $_SESSION['session_id'];
$allowed_extensions = ['png', 'jpg', 'jpeg'];
$profile_image_src = '';
foreach ($allowed_extensions as $extension) {
    $profile_image_path = $profile_image_folder . $session_id . '.' . $extension;
    if (file_exists($profile_image_path)) {
        $profile_image_src = $profile_image_path;
        break;
    }
}

if (empty($profile_image_src)) {
    $profile_image_src = '../images/default-profile-image.png';
}

function checkAge($birthdate) {
    $today = new DateTime();
    $birthdate = new DateTime($birthdate); 
    $age = $today->diff($birthdate)->y;
    return $age; 
}
?>

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="../images/nuovologopiccolo.png" type="image/icon type">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="style.css">

    <!-- ===== Boxicons ===== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Personal Profile</title>

</head>
<body>
<span class="icon-mobile mobile-toggle"><i class='bx bx-menu'></i></span>

<nav class="sidebar close">
    <header>
        <div class="image-text">
                <span class="image">
                    <img src="../images/nuovologopiccolo.png" width="40" height="40">
                </span>

            <div class="text header-text">
                <span class="name">WorldWideJob</span>
                <span class="profession">Welcome, <?php echo $_SESSION['session_name'] ?></span>
            </div>
            <span class="exitbutton mobile-toggle"><i class='bx bx-x'></i></span>
        </div>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <li class="search-box">
                <i class='bx bx-search-alt-2 icon' ></i>
                <input type="search" placeholder="Search...">
            </li>
            <li class="nav-link">
                <a href="../home/main.php">
                    <i class="bx bx-home icon"></i>
                    <span class="text vav-text">Home</span>
                </a>
            </li>
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="../profile/profile.php">
                        <i class='bx bx-user icon'></i>
                        <span class="text vav-text">Profile</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="../chat/chat.htm">
                        <i class='bx bx-chat icon'></i>
                        <span class="text vav-text">Chat</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="../settings/settings.php">
                        <i class="bx bx-cog icon"></i>
                        <span class="text vav-text">Settings</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="../database/logout.php ">
                    <i class="bx bx-log-out icon"></i>
                    <span class="text vav-text">Logout</span>
                </a>
            </li>

            <li class="mode">
                <div class="moon-sun">
                    <i class="bx bx-moon icon moon"></i>
                    <i class="bx bx-sun icon sun"></i>
                </div>
                <span class="mode-text text">Dark Mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>

    </div>
</nav>

<section class="home">
    <div class="container">
        <div class="profile">
            <img src="<?php echo $profile_image_src?>" alt="Immagine Profilo" id="profile-image">
            <h2>Dati del Profilo</h2>
            <p>Biografia: </p>
            <p>Nome: <?php echo $_SESSION['session_name'] ?></p>
            <p>Email: <?php echo $_SESSION['session_email'] ?></p>
            <p>Età: <?php echo checkAge($_SESSION['session_birthdate']) ?>;</script></p>

        </div>
        <div class="posts">
            <h2>I Miei Post</h2>
            <div class="post">
                <h3>Titolo del Post 1</h3>
                <p>Cerco qualcuno che mi coachi su lol, offro ben 23,67$</p>
            </div>
            <div class="post">
                <h3>Titolo del Post 2</h3>
                <p>Offro 28,39$ a chi mi aiuta a pulire il bagno di casa mia</p>
            </div>
            <div class="post">
                <h3>Titolo del Post 3</h3>
                <p>Per 50$ chi mi fa un decision tree</p>
            </div>
        </div>
    </div>
</section>

<script src="script.js"></script>

</body>
</html>