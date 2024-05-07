<?php
session_start();
session_destroy();
header('Location: ../sign-in/sign-in.php');
exit;