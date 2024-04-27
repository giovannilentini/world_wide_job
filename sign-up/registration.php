<?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: /");
    } else {
        $db_conn = pg_connect("host=localhost port=8080 dbname=WorldWideJob user=postgres password=password")
         or die("Connesione fallita: " . pg_last_error());
    }
?>

<!DOCTYPE html>
<html>
<head></head>
<body>
    <?php
        if ($db_conn) {
            $email = $_POST["email"];
            $query = "SELECT * from utente where email=$1";
            $q_result = pg_query_params($db_conn, $query, array($email));

            if ($tuple = pg_fetch_array($q_result, null, PGSQL_ASSOC)) {
                echo "<h1>Indirizzo email già registrato</h1>
                      <a href=../sign-in/sign-in.html> clicca qui oer il login </a>";
            } else {
                $nome = $_POST["nome"];
                $cognome = $_POST["cognome"];
                $pswd = $_POST["pswd"];
                $query2 = "INSERT INTO utente (nome, cognome, email, pswd) 
                        VALUES ($1, $2, $3, $4)";
                $q_result = pg_query_params($db_conn, $query2, array($nome, $cognome, $email, $pswd));
                if ($q_result) { 
                    "Registrazione avvenuta con successo.";
                }
            }   
        }

    ?>
</body>
</html>