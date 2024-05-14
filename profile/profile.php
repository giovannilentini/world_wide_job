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
            <p>Biografia: <?php echo $_SESSION['session_bio'] ?></p>
            <p>Nome: <?php echo $_SESSION['session_name'] . ' ' . $_SESSION['session_surname'] ?></p>
            <p>Email: <?php echo $_SESSION['session_email'] ?></p>
            <p>Età: <?php echo checkAge($_SESSION['session_birthdate']) ?></script></p>

        </div> <!-- Chiusura div "profile" -->
        
        <div class="posts">
            <h2>I Miei Post</h2>
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
                                    echo '<form id="formEdit' . $row['id'] . '" name="formEdit" action="" method="POST">';
                                    echo '<input type="hidden" name="post_id" value="' . $row['id'] . '">';
                                    echo '<button type="submit" class="edit-btn"><i class="bx bx-edit"></i>Edit</button>';
                                    echo '</form>';
                                    echo '<form id="formDelete' . $row['id'] . '" name="formDelete" action="delete.php" method="POST">';
                                    echo '<input type="hidden" name="post_id" value="' . $row['id'] . '">';
                                    echo '<button type="submit" class="delete-btn"><i class="bx bx-trash"></i>Delete</button>';
                                    echo '</form>';
                                echo '</div>'; // Chiusura div "post-actions"
                            echo '</div>'; // Chiusura div "post-header"               
                            echo '<div class="post-content">';
                                echo '<p>' . htmlspecialchars($row['campo']) . '</p>';
                            echo '</div>';
                        echo '</div>'; //Chiusura div "post"
                    }
                }
                $pdo = null;
            ?>
        </div> <!-- Chiusura div "posts" -->
    </div> <!-- Chiusura div "container" -->

    <div id="myModal" class="modal delete-modal">
        <div class="modal-content">
            <p>Vuoi eliminare il post?</p>
            <div>
                <button id="btnYes">Si</button>
                <button id="btnNo">No</button>
            </div>
        </div>
    </div>

    <div id="editModal" class="edit-modal">
        <div class="modal-content">
            <h2>Edit Post</h2>
            <form id="editForm" action="" method="POST">
                <input type="text" id="editTitle" name="editTitle" placeholder="Inserisci titolo..." required>
                <textarea class="textwin" id="editContent" name="editContent" rows="4" placeholder="Inserisci testo..." required></textarea>
                <input type="hidden" id="editPostId" name="post_id">
            </form> 
            <button type="submit">Save</button>
            <button id="editModalClose">Cancel</button>
        </div>
    </div>


    
</section>
</div>

<script>
    /* ===== Inizio Finestra Modale Delete ===== */
    var modal = document.getElementById("myModal");

    var btnsOpenModal = document.querySelectorAll(".delete-btn");
    var btnCloseModal = document.getElementById("btnNo");

    btnsOpenModal.forEach(function(btn) {
    btn.onclick = function(event) {
        event.preventDefault();
        modal.style.display = "block";
        var postId = this.parentNode.querySelector('input[name="post_id"]').value;
        document.getElementById("btnYes").setAttribute("data-post-id", postId);
    }
    });

    btnCloseModal.onclick = function() {
    modal.style.display = "none";
    }

    var btnYes = document.getElementById("btnYes");
    btnYes.onclick = function() {
    var postId = this.getAttribute("data-post-id");
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "delete.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
        location.reload();
        }
    };
    xhr.send("post_id=" + postId);
    modal.style.display = "none";
    }
    /* ===== Inizio Finestra Modale Delete ===== */



    /* ===== Inizio Modale Edit  ===== */
    var editModal = document.getElementById("editModal");
    var editModalClose = document.getElementById("editModalClose");

    var editBtns = document.querySelectorAll(".edit-btn");
    editBtns.forEach(function(btn) {
        btn.onclick = function(event) {
            event.preventDefault();
            var postId = this.parentNode.querySelector('input[name="post_id"]').value;
            document.getElementById("editPostId").value = postId;
            editModal.style.display = "block";
        }
    });

    editModalClose.onclick = function() {
        editModal.style.display = "none";
    }
    /* ===== Fine Modale Edit  ===== */

</script>


<script src="script.js"></script>

</body>
</html>