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


<?php
/*
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: /"); // Se non è una richiesta POST, reindirizza altrove
        exit;
    }

    $db_conn = pg_connect("host=localhost port=8080 dbname=WorldWideJob user=postgres password=password")
                or die("Connessione fallita: " . pg_last_error());

    // Verifica la connessione al database
    if (!$db_conn) {
        die("Connessione al database fallita");
    }

    // Verifica che i dati POST siano stati inviati e non siano vuoti
    if (empty($_POST["nome"]) || empty($_POST["cognome"]) || empty($_POST["email"]) || empty($_POST["pswd"])) {
        die("Per favore, completa tutti i campi del modulo.");
    }

    // Sanificazione dei dati POST
    $nome = pg_escape_string($_POST["nome"]);
    $cognome = pg_escape_string($_POST["cognome"]);
    $email = pg_escape_string($_POST["email"]);
    $pswd = pg_escape_string($_POST["pswd"]);

    // Query per verificare se l'email è già registrata
    $query = "SELECT * FROM utente WHERE email=$1";
    $result = pg_query_params($db_conn, $query, array($email));

    if (!$result) {
        die("Errore durante la verifica dell'email nel database.");
    }

    // Se l'email è già registrata, mostra un messaggio appropriato
    if (pg_num_rows($result) > 0) {
        echo "<h1>Indirizzo email già registrato</h1>
              <a href='../sign-in/sign-in.html'>Clicca qui per il login</a>";
    } else {
        // Se l'email non è già registrata, esegui l'inserimento nel database
        $insert_query = "INSERT INTO utente (nome, cognome, email, pswd) VALUES ($1, $2, $3, $4)";
        $insert_result = pg_query_params($db_conn, $insert_query, array($nome, $cognome, $email, $pswd));

        if ($insert_result) {
            echo "Registrazione avvenuta con successo.";
        } else {
            echo "Errore durante la registrazione. Si prega di riprovare.";
        }
    }

    // Chiudi la connessione al database
    pg_close($db_conn);
    */
?>