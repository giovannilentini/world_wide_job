<?php
    require_once('database.php');
    if (isset($_POST['register'])) {
        $name = $_POST['name'] ?? '';
        $surname = $_POST['surname'] ?? '';
        $birthdate = $_POST['birthdate'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = "
            INSERT INTO users
            VALUES (0, :name, :surname, :birthdate, :email, :password, NULL, '')
        ";

        $check = $pdo->prepare($query);
        $check->bindParam(':name', $name, PDO::PARAM_STR);
        $check->bindParam(':surname', $surname, PDO::PARAM_STR);
        $check->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
        $check->bindParam(':email', $email, PDO::PARAM_STR);
        $check->bindParam(':password', $password_hash, PDO::PARAM_STR);
        $check->execute();
        
        if ($check) {
            $msg = 'Successfully registered, you will be automatically redirected to the login page within 3 seconds!';
            echo $msg;
        } else {
            $msg = 'A problem occurred during registration. Please try again later.';
            echo $msg;
        }
    }
?>