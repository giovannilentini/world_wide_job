<?php
    session_start();
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

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

    <title>WorldWideJob Chat</title>

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
        <div class="chat-div">
            
        <nav>
            <div class="nav-container">
                <span class="title">Messages</span>
            </div>
        </nav>

        <ul class="conversations">

            <?php
            include "../database/database.php";

            $user_id = $_SESSION['session_id'];

            $query = "SELECT * FROM users WHERE id != :user_id";
            $statement = $pdo->prepare($query);
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $statement->execute();

            if ($statement->rowCount() > 0) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $profile_pic_extensions = ['.jpg', '.jpeg', '.png'];
                    $profile_pic = false;

                    foreach ($profile_pic_extensions as $ext) {
                        $filename = $row['id'] . $ext;
                        if (file_exists("../profileimages/" . $filename)) {
                            $profile_pic = $filename;
                            break; 
                        }
                    }

                    echo "<li class='chat'>";

                        if ($profile_pic) {
                            echo "<img src='../profileimages/$profile_pic' alt='' class='profile-picture' />";
                        } else {
                            echo "<img src='../images/default-profile-image.png' alt='' class='profile-picture' />";
                        }
                        echo "<div class='chat-info'>";
                        echo "<span class='chat-name'>" . $row['name'] . ' ' . $row['surname'] . ": </span>";
                        echo '<span class="chat-message">Hello there!</span>';
                        echo "</div>";
                        echo "</li>";
                    }
            } else {
                echo "Nessun utente trovato nel database.";
            }
            ?>

        </ul>

        </div>
    </div>
    
</section>

<script src="script.js"></script>

</body>
</html>