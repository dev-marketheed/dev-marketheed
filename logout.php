<?php
session_start();
unset($_SESSION['user_id']);
session_destroy();
header("Location: https://app.instaspiel.com/dev/");
?>
