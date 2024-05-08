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
                <span class="profession">Welcome, <?php echo $_SESSION['session_name']?></span>
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
                <a href="../database/logout.php">
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
                <div id="uploadResult"></div>
            </div>
            <div>
                <div class="title">
                   <h2>Personal Information</h2> 
                </div>
                
                <div class="info-box">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="inserire qui il tuo nome...">
                </div>
                
                <div class="info-box">
                    <label for="cognome">Cognome:</label>
                    <input type="text" id="cognome" name="cognome" placeholder="inserire qui il tuo cognome...">
                </div>

                <div class="info-box">
                    <label for="cognome">Biografia:</label>
                    <textarea id="bio" name="bio" rows="4" placeholder="inserire qui la tua bio..."></textarea>
                </div>

                <div class="title">
                    <h2>Profile Information</h2> 
                </div>

                <div class="info-box">
                    <label for="email">E-mail:</label>
                    <input type="text" id="email" name="email" placeholder="inserire qui la tua mail...">
                </div>

                <div class="info-box">
                    <label for="oldpassword">Vecchia Password:</label>
                    <input type="password" id="oldpassword" name="oldpassword" placeholder="inserire qui la vecchia password...">
                </div>

                <div class="info-box">
                    <label for="newpassword">Nuova Password:</label>
                    <input type="password" id="newpassword" name="newpassword" placeholder="inserire qui la nuova password...">
                </div>

                <div class="info-box">
                    <label for="confpassword">Conferma Password:</label>
                    <input type="password" id="confpassword" name="confpassword" placeholder="inserire qui la nuova password...">
                </div>
            
                <!--
                <label for="cognome">Cognome:</label>
                <input type="text" id="cognome" name="cognome" required>
            
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                -->
            </div>
                   
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const profilePic = document.getElementById('profile-image');
    profilePic.addEventListener('click', function() {
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*'; 
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; 
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                profilePic.src = reader.result;
            }
            uploadImage(file);
        });
        fileInput.click();
    });
});

function uploadImage(imageFile) {
    var formData = new FormData();
    formData.append("profileImage", imageFile);
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "upload_image.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("uploadResult").innerHTML=xhr.responseText;
        } else {
            document.getElementById("uploadResult").innerHTML="Errore durante l'upload dell'immagine.";
        }
    };
    xhr.send(formData);
}

function getFileExtension(filename) {
    return filename.split('.').pop().toLowerCase();
}
</script>

<script src="script.js"></script>

</body>
</html>