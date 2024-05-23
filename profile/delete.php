<?php
    try {
        if(isset($_POST['post_id']) && !empty($_POST['post_id'])) {
            require_once('../database/database.php');
            $query = "DELETE FROM posts WHERE id = :post_id";
            $check = $pdo->prepare($query);
            $check->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_INT);
            $check->execute();
            if ($check->rowCount() > 0) {
                header("Location: ".$_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "No posts have been deleted.";
            }
            $pdo = null;
        } else {
            echo "Post ID not provided.";
        }
    } catch (PDOException $e) {
        echo "Error while deleting post: " . $e->getMessage();
    }
?>
