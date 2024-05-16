<?php
    try {
        // Verifica che sia stato ricevuto un ID valido
        if(isset($_POST['post_id']) && !empty($_POST['post_id'])) {
            // Connettiti al database
            require_once('../database/database.php');

            // Prepara la query per eliminare il post
            $query = "DELETE FROM posts WHERE id = :post_id";
            $stmt = $pdo->prepare($query);

            // Associa i valori ai parametri e esegui la query
            $stmt->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_INT);
            //$stmt->bindParam(':user_id', $_SESSION['session_id'], PDO::PARAM_INT);
            $stmt->execute();

            // Controlla se qualche riga è stata effettivamente eliminata
            if ($stmt->rowCount() > 0) {
                // Reindirizza alla pagina di origine o esegui altre azioni necessarie dopo l'eliminazione
                header("Location: ".$_SERVER['HTTP_REFERER']);
                exit();
            } else {
                // Nessun post eliminato
                echo "Nessun post è stato eliminato.";
            }

            // Chiudi la connessione al database
            $pdo = null;
        } else {
            // Se l'ID del post non è stato fornito
            echo "ID del post non fornito.";
        }
    } catch (PDOException $e) {
        // Gestisci eventuali eccezioni durante l'esecuzione della query
        echo "Errore durante l'eliminazione del post: " . $e->getMessage();
    }
?>
