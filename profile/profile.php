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
            
            <div class="toggle-switch"></div>
        </div>

    </div>
</nav>

<section class="home">
    <div class="container">
        <div class="profile">
            <img src="<?php echo $profile_image_src?>" alt="Immagine Profilo" id="profile-image">
            <h2>Profile Data</h2>
            <p>Biography: <?php echo $_SESSION['session_bio'] ?></p>
            <p>Name: <?php echo $_SESSION['session_name'] . ' ' . $_SESSION['session_surname'] ?></p>
            <p>Email: <?php echo $_SESSION['session_email'] ?></p>
            <p>Age: <?php echo checkAge($_SESSION['session_birthdate']) ?></script></p>
        </div>
        
        <div class="posts">
            <h2>My Posts</h2>
            <?php
                require_once('../database/database.php');
                                                
                $query = "SELECT id, campo, title
                        FROM posts 
                        WHERE user_id = :id";
                $check = $pdo->prepare($query);
                            
                $check->bindParam(':id', $_SESSION["session_id"], PDO::PARAM_INT);
                $check->execute();

                if ($check->rowCount() > 0) {
                    while ($row = $check->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="post">';
                            echo '<div class="post-header">';
                            echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                                echo '<div class="post-actions">';
                                    echo '<form id="formEdit' . $row['id'] . '" name="formEdit" action="edit.php" method="POST">';
                                    echo '<input type="hidden" name="post_id" value="' . $row['id'] . '">';
                                    echo '<input type="hidden" name="post_title" value="' . htmlspecialchars($row['title']) . '">';
                                    echo '<input type="hidden" name="post_campo" value="' . htmlspecialchars($row['campo']) . '">';
                                    echo '<button type="submit" class="edit-btn"><i class="bx bx-edit"></i>Edit</button>';
                                    echo '</form>';
                                    echo '<form id="formDelete' . $row['id'] . '" name="formDelete" action="delete.php" method="POST">';
                                    echo '<input type="hidden" name="post_id" value="' . $row['id'] . '">';
                                    echo '<button type="submit" class="delete-btn"><i class="bx bx-trash"></i>Delete</button>';
                                    echo '</form>';
                                echo '</div>'; 
                            echo '</div>';         
                            echo '<div class="post-content">';
                                echo '<p>' . htmlspecialchars($row['campo']) . '</p>';
                            echo '</div>';
                        echo '</div>';
                    }
                }
                $pdo = null;
            ?>
        </div>
    </div> 

    <div id="myModal" class="modal delete-modal">
        <div class="modal-content">
            <p>Do you want to delete the post?</p>
            <div>
                <button id="btnYes">Yes</button>
                <button id="btnNo">No</button>
            </div>
        </div>e
    </div>

    <div id="editModal" class="edit-modal">
        <div class="modal-content">
            <h2>Edit Post</h2>
            <form id="editForm" action="edit.php" method="POST">
                <input type="text" id="editTitle" name="editTitle" placeholder="Enter title...">
                <textarea class="textwin" id="editContent" name="editContent" rows="4" placeholder="Insert text..."></textarea>
                <input type="hidden" id="editPostId" name="post_id">
                <button class="submit" id="savePost">Save</button>
                <button id="editModalClose">Cancel</button>
            </form> 
        </div>
    </div>


    
</section>
</div>

<script src="script.js"></script>

</body>
</html>