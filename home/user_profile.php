<?php
    session_start();
    if ($_POST['other_user_id'] == $_SESSION['session_id']) {
        header("refresh:0;url=../profile/profile.php");
    } else {
        $_SESSION['session_visit'] = $_POST['other_user_id'];
        header("refresh:0;url=../other_user/profile.php");
    }
?>