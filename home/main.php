<?php
    session_start();

    $profile_image_folder = '../profileimages/';
    $session_id = $_SESSION['session_id'];
    $allowed_extensions = ['png', 'jpg', 'jpeg'];
    $profile_image_src = '../images/default-profile-image.png';
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

    <title>Home </title>

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

        <div class="search-container">
            <li class="search-box">
                <i class='bx bx-search-alt-2 icon' ></i>
                <input type="search" id="search-input" placeholder="Search...">
            </li>
        </div>
        
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
                    <a href="../chat/chat.php">
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
                <a href="../database/logout.php">
                    <i class="bx bx-log-out icon"></i>
                    <span class="text vav-text">Logout</span>
                </a>
            </li>
            
            <div class="toggle-switch"></div>
        </div>

    </div>
</nav>

<section class="home">
    <div class="container">
        <div class="homepage">
            <button id="openModalBtn" class="fb-btn">
            <img class="fb-profile-img" src="<?php echo $profile_image_src?>" alt="Profilo">
            <span>Do you want to create a new post?</span>
            </button>
            <div id="myModal" class="modal">
                    <div class="modal-content">
                    <form name="" action="methods/newpost.php" method="POST">
                        <span class="close-win">&times;</span>
                        <h2>Create a Post</h2>
                        <input type="text" name="postTitle" placeholder="Post title" required>
                        <textarea class="textwin" name="postContent" rows="16" placeholder="Write something down..."required></textarea>
                        <button id="postBtn">Post</button>
                    </form>
                    </div>
            </div>
            <div class="posts" id="posts-container">

            </div>


        </div>
  </div>
</section>

<script src="script.js"></script>

</body>

</html>