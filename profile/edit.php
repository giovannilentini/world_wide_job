<?php
session_start();
require_once('../database/database.php');

if (isset($_POST['post_id']) && isset($_POST['editTitle']) && isset($_POST['editContent']) && $_POST['editTitle'] != '' && $_POST['editContent'] != '') {
    $post_id = $_POST['post_id'];
    $editTitle = $_POST['editTitle'];
    $editContent = $_POST['editContent'];

    $query = "UPDATE posts SET title = :title, campo = :content WHERE id = :post_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':title', $editTitle, PDO::PARAM_STR);
    $stmt->bindParam(':content', $editContent, PDO::PARAM_STR);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../profile/profile.php");
        exit();
    } else {
        echo "Error updating post.";
    }
} else {
    echo "All fields are required.";
}
?>
