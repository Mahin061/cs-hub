<?php
require '../partials/header.php';
if(!isset($_SESSION['user-id']))
{


    header('loation: '.ROOT_URL.'signin.php');
    die();
}






