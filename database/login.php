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
        
        if (empty($email) || empty($password)) {
            $msg = 'Inserisci email e password %s';
        } else {
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
                $msg = 'Credenziali utente errate %s'; 
            } else {
                session_regenerate_id();
                $_SESSION['session_id'] = $user['id'];
                $_SESSION['session_email'] = $user['email'];
                $_SESSION['session_name'] = $user['name'];
                $_SESSION['session_surname'] = $user['surname'];
                $_SESSION['session_birthdate'] = $user['birthdate'];
                $_SESSION['session_bio'] = $user['bio'];
                $_SESSION['session_pw'] = $user['pw'];
                            
                header('Location: ../home/main.php');
                exit;
            }
        }
        
        printf($msg);
    }
?>