<?php
    require_once '../../database/database.php';

    $email = $_GET['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Email is not valid, enter a valid email address"; 
        exit;
    }

    $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $check->bindParam(':email', $email);
    $check->execute();

    $count = $check->fetchColumn();

    if ($count > 0) {
        echo "Email is used, enter a new email address";
    } else {
        echo "Email is available";
    }
?>