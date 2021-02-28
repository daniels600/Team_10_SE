<?php


session_start();
//Logout Admin and destroy all sessions 
if(isset($_GET['logout'])){
    session_destroy();

    unset($_SESSION['user_id']);
    unset($_SESSION['user_loggedIn']);
    unset($_SESSION['admin_email']);
    unset($_SESSION['admin_id']);


    //redirect admin to the login page
    header('Location: index.php');
    
} 