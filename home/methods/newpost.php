<?php

    session_start();
    require_once('../../database/database.php');

    if (!isset($_SESSION['session_id'])) {
        header("Location: login.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $query = "INSERT INTO posts VALUES (0, :user_id, :post, :title)";
        
            $check = $pdo->prepare($query);
            $check->bindParam(':user_id', $_SESSION['session_id'], PDO::PARAM_STR);
            $check->bindParam(':post', $_POST['postContent'], PDO::PARAM_STR);
            $check->bindParam(':title', $_POST['postTitle'], PDO::PARAM_STR);
            $check->execute();
        
            header("refresh:0;url=../main.php");
        } catch (PDOException $e) {
            echo "Errore nell'esecuzione della query: " . $e->getMessage();
        }
        
    } else {
        echo 'impossibile connettersi al db';
    }

?>