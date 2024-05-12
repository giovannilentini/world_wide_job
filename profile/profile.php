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

        </div>
        
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
                                echo '<form id="formDelete' . $row['id'] . '" name="formDelete" action="delete.php" method="POST">';
                                echo '<input type="hidden" name="post_id" value="' . $row['id'] . '">';
                                echo '<button type="submit" class="delete-btn"><i class="bx bx-trash"></i>Delete</button>';
                                echo '</form>';
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

    <div id="myModal" class="modal">
    <div class="modal-content">
        <p>Vuoi eliminare il post?</p>
        <div>
            <button id="btnYes">Si</button>
            <button id="btnNo">No</button>
        </div>
    </div>
    
</section>
</div>

<script>
    // Ottieni la finestra modale
    var modal = document.getElementById("myModal");

    // Ottieni i pulsanti per aprire e chiudere la finestra modale
    var btnsOpenModal = document.querySelectorAll(".delete-btn");
    var btnCloseModal = document.getElementById("btnNo");

    // Quando un pulsante per aprire la finestra modale viene cliccato
    btnsOpenModal.forEach(function(btn) {
    btn.onclick = function(event) {
        event.preventDefault(); // Impedisce il comportamento predefinito del pulsante
        modal.style.display = "block";
        var postId = this.parentNode.querySelector('input[name="post_id"]').value;
        document.getElementById("btnYes").setAttribute("data-post-id", postId);
    }
    });

    // Quando il pulsante "No" nella finestra modale viene cliccato, chiudi la finestra modale
    btnCloseModal.onclick = function() {
    modal.style.display = "none";
    }

    // Quando il pulsante "Si" nella finestra modale viene cliccato, esegui lo script PHP per eliminare il post
    var btnYes = document.getElementById("btnYes");
    btnYes.onclick = function() {
    var postId = this.getAttribute("data-post-id");
    // Invia una richiesta AJAX per eliminare il post
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "delete.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
        // Se il post è stato eliminato con successo, aggiorna la pagina o fai qualcos'altro se necessario
        location.reload(); // Aggiorna la pagina
        }
    };
    xhr.send("post_id=" + postId); // Invia l'ID del post da eliminare
    modal.style.display = "none";
    }

</script>


<script src="script.js"></script>

</body>
</html>