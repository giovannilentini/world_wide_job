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
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="../images/nuovologopiccolo.png" type="image/icon type">

    <link rel="stylesheet" href="style.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <title>WorldWideJob Settings</title>

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
                <span class="profession">Welcome, <?php echo $_SESSION['session_name']?></span>
            </div>
            <span class="exitbutton mobile-toggle"><i class='bx bx-x'></i></span>
        </div>
    </header>

    <div class="menu-bar">
        <div class="menu">

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
        </div>

    </div>
</nav>

<section class="home">
    <div class="container">
        <div class="settings">
            <div class="title">
                <h1>Profile Settings</h1>
            </div>
            <h2>Profile Picture</h2>
            <div class="pic-container" id="profile-pic-container">
                <img class="pic" src="<?php echo $profile_image_src; ?>" alt="Immagine Profilo" id="profile-image">
                <div class="edit-box" id="edit-box">
                    <i class='bx bxs-edit-alt'></i>
                    <span>Edit</span>
                </div>
                <div id="uploadResult" style="color: green"></div>
            </div>
            <div>
                <div class="title">
                   <h2>Personal Information</h2> 
                </div>
                
                <form name="" action="methods/upload_personal.php" method="POST">
                    <div class="info-box">
                        <label for="nome">Name</label>
                        <input class="input-text" type="text" id="nome" name="nome" placeholder="enter your name here...">
                    </div>
                    
                    <div class="info-box">
                        <label for="cognome">Surname:</label>
                        <input class="input-text" type="text" id="cognome" name="cognome" placeholder="enter your last name here...">
                    </div>

                    <div class="info-box">
                            <label for="bio">Biography:</label>
                            <textarea id="bio" name="bio" rows="4" placeholder="enter your bio here..."></textarea>
                            <button type="submit" class="sub">Submit</button>
                    </div>
                </form>

                <div class="title">
                    <h2>Profile Information</h2> 
                </div>

                <form name="" action="methods/upload_profile.php" method="POST">
                    <div class="info-box">
                        <label for="email">E-mail:</label>
                        <input type="text" id="email" name="email" placeholder="insert your email here...">
                    </div>

                    <div class="info-box">
                        <label for="oldpassword">Old Password:</label>
                        <input type="password" id="oldpassword" name="oldpassword" placeholder="enter the old password here...">
                    </div>

                    <div class="info-box">
                        <label for="newpassword">New Password:</label>
                        <input type="password" id="newpassword" name="newpassword" placeholder="enter the new password here...">
                    </div>

                    <div class="info-box">
                        <label for="confpassword">Confirm Password:</label>
                        <input type="password" id="confpassword" name="confpassword" placeholder="enter the new password here...">
                        <button type="submit" class="sub">Submit</button>
                    </div>
                </form>
            </div>
                   
        </div>
    </div>
</section>

<script src="script.js"></script>

</body>
</html>