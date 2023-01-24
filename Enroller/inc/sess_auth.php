<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $link = "https";
    else
        $link = "http";
    $link .= "://";
    $link .= $_SERVER['HTTP_HOST'];
    $link .= $_SERVER['REQUEST_URI'];
    if(!isset($_SESSION['EnrollerData']) && !strpos($link, 'login.php') && !strpos($link, 'register.php')){
        redirect('enroller/login.php');
    }
    if(isset($_SESSION['EnrollerData']) && strpos($link, 'login.php')){
        redirect('enroller/index.php');
    }

