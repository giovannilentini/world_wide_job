<?php
require_once('database.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $isEmailValid = filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    );
    $pwdLenght = mb_strlen($password);
    
    if (empty($email) || empty($password) || empty($name) || empty($surname) || empty($birthdate)) {
        $msg = 'Compila tutti i campi %s';
    } elseif (false === $isEmailValid) {
        $msg = "L'indirizzo email non è valido";
    } elseif ($pwdLenght < 8) {
        $msg = 'Lunghezza minima password 8 caratteri.';
    } 
    else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "
            SELECT id
            FROM users
            WHERE email = :email
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':email', $email, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($user) > 0) {
            $msg = 'Email già in uso %s';
        } else {
            $query = "
                INSERT INTO users
                VALUES (0, :name, :surname, :birthdate, :email, :password, NULL)
            ";
        
            $check = $pdo->prepare($query);
            $check->bindParam(':name', $name, PDO::PARAM_STR);
            $check->bindParam(':surname', $surname, PDO::PARAM_STR);
            $check->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
            $check->bindParam(':email', $email, PDO::PARAM_STR);
            $check->bindParam(':password', $password_hash, PDO::PARAM_STR);
            $check->execute();
            
            if ($check->rowCount() > 0) {
                $msg = 'Registrazione eseguita con successo, verrai reindirizzato automaticamente alla pagina di login entro 3 secondi!';
                header("refresh:3;url=../sign-in/sign-in.php");
            } else {
                $msg = 'Problemi con l\'inserimento dei dati %s';
                header("refresh:3;url=../sign-up/sign-up.php");
            }
        }
    }
    
    printf($msg, '<a href="../sign-up/sign-up.htm">Ritorno alla registrazione</a>');
}
