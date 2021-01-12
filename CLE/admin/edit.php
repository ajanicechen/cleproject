<?php
/** @var mysqli $db */
require_once "includes/database.php";

//checks if logged in
if(!isset($_SESSION['username'])){
    //redirects to login page
    header("Location: login.php");
}

?>
