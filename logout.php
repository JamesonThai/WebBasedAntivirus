<?php
session_start();

// Destroy the current session and go back to the home page
if(session_destroy()) header("Location: Home.php");
?>