<?php
    session_start();
    require_once('../../database/database.php');

    if (!isset($_SESSION['session_id'])) {
        header("Location: login.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if($_POST['email'] != '') {
            $query = "UPDATE users SET email = :email WHERE id = :user_id";
            $check = $pdo->prepare($query);
                
            $check->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $check->bindParam(':user_id', $_SESSION["session_id"], PDO::PARAM_INT);
            $check->execute();

            $_SESSION['session_email'] = $_POST['email'];
        } 
        
        header("refresh:0;url=../settings/settings.php");
    }

?>
