<?php
    session_start();
    require_once('database.php');

    if (isset($_SESSION['session_id'])) {
        header('Location: ../home/main.php');
        exit;
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $query = "
            SELECT *
            FROM users
            WHERE email = :email
        ";
            
        $check = $pdo->prepare($query);
        $check->bindParam(':email', $email, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || password_verify($password, $user['password']) === false) {
            $msg = 'Incorrect credentials, please try again'; 
            echo $msg;
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = $user['id'];
            $_SESSION['session_email'] = $user['email'];
            $_SESSION['session_name'] = $user['name'];
            $_SESSION['session_surname'] = $user['surname'];
            $_SESSION['session_birthdate'] = $user['birthdate'];
            $_SESSION['session_bio'] = $user['bio'];
            $msg = 'Successfully logged in, you will be automatically redirected to the login page within 3 seconds!';   
            echo $msg;
        }
    }
?>