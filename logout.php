<?php
    session_start();
    session_unset();
    session_destroy();
    header("Location: logowanie.php?message=Zostałeś%20wylogowany.");
    exit();
?>
