<?php
    session_start();
    if (isset($_FILES['profileImage'])) {
        $errors = array();
        $file_name = $_FILES['profileImage']['name'];
        $file_size = $_FILES['profileImage']['size'];
        $file_tmp = $_FILES['profileImage']['tmp_name'];
        $file_type = $_FILES['profileImage']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        $extensions = array("jpeg", "jpg", "png");
        
        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Estensione non consentita, scegliere un file JPEG o PNG.";
            print_r($errors);
            exit;
        }

        if ($file_size > 2000000) {
            $errors[] = 'Dimensione del file troppo grande';
            print_r($errors);
            exit;
        }
        
        if (empty($errors) == true) {
            $session_id = $_SESSION['session_id'];
            $profile_image_folder = '../profileimages/';
            $newFileName = $session_id . "." . $file_ext;
            $uploadPath = "../profileimages/" . $newFileName;
            foreach ($extensions as $ext) {
                $profile_image_path = $profile_image_folder . $session_id . '.' . $ext;
                if (file_exists($profile_image_path)) {
                    unlink($profile_image_path);
                    break;
                }
            }
            move_uploaded_file($file_tmp, $uploadPath);
            echo "Immagine caricata con successo.";
            // Puoi aggiornare il percorso dell'immagine nel database per l'utente loggato
        }
    }
?>