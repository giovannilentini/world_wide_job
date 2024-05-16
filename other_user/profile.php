<?php
    session_start();

    require_once('../database/database.php');

    $profile_image_folder = '../profileimages/';
    $session_id = $_SESSION['session_visit'];
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

    $query = "  SELECT *
                FROM users 
                WHERE id = :id";
    $check = $pdo->prepare($query);            
    $check->bindParam(':id', $_SESSION['session_visit'], PDO::PARAM_INT);
    $check->execute();

    $user_id = '';
    $name = '';
    $surname = '';
    $bd = '';
    $email = '';
    $bio = '';

    while ($row = $check->fetch(PDO::FETCH_ASSOC)) {
        $name = $row['name'];
        $surname = $row['surname'];
        $bd = $row['birthdate'];
        $email = $row['email'];
        $bio = $row['bio'];
        break;
    }

    function checkAge($birthdate) {
        $today = new DateTime();
        $birthdate = new DateTime($birthdate); 
        $age = $today->diff($birthdate)->y;
        return $age; 
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
                <a href="../database/logout.php ">
                    <i class="bx bx-log-out icon"></i>
                    <span class="text vav-text">Logout</span>
                </a>
            </li>
        </div>

    </div>
</nav>

<section class="home">
    <div class="container">
        <div class="profile">
            <img src="<?php echo $profile_image_src ?>" alt="Immagine Profilo" id="profile-image">
            <h2>Dati del Profilo</h2>
            <p>Biografia: <?php echo $bio ?></p>
            <p>Nome: <?php echo $name . ' ' . $surname ?></p>
            <p>Email: <?php echo $email ?></p>
            <p>Età: <?php echo checkAge($bd) ?></script></p>

            <button class="contact-btn">
                <i class='bx bx-chat bx-sm'></i> <span> Contact Me <span>
            </button>
        </div> <!-- Chiusura div "profile" -->
        
        <div class="posts">
            <h2>Tutti i post di <?php echo $name . ' ' . $surname ?></h2>
            <?php
                require_once('../database/database.php');
                                                
                $query = "SELECT id, campo, title
                        FROM posts 
                        WHERE user_id = :id";
                $check = $pdo->prepare($query);
                            
                $check->bindParam(':id', $_SESSION["session_visit"], PDO::PARAM_INT);
                $check->execute();

                if ($check->rowCount() > 0) {
                    while ($row = $check->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="post">';
                            echo '<div class="post-header">';
                                echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                            echo '</div>'; // Chiusura div "post-header"               
                            echo '<div class="post-content">';
                                echo '<p>' . htmlspecialchars($row['campo']) . '</p>';
                            echo '</div>'; // Chiusura div "post-content"
                        echo '</div>'; //Chiusura div "post"
                    }
                }
                $pdo = null;
            ?>
        </div> <!-- Chiusura div "posts" -->
    </div> <!-- Chiusura div "container" -->

    
</section>
</div>

<script src="script.js"></script>

</body>
</html>