<?php
require 'config/database.php';
    
    
 
    if(isset($_POST['submit'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $desc = filter_var($_POST['desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       
    }
    if(!$title) {
        $_SESSION['contact-page'] = "Please Enter Title";
     } elseif(!$desc) {
        $_SESSION['contact-page'] = "Please enter your Description";
     } 
     else if(!$email){


        $_SESSION['contact-page'] = "Please enter your Email";

     }
     if(isset($_SESSION['contact-page'])){

     header('location:'.ROOT_URL.'contact.php');
     die();


     }
     else{

     $insert_contact="insert into contact_data SET email='$email' ,title='$title',description='$desc'";
     $result=mysqli_query($connection,$insert_contact);
     if(!mysqli_errno($connection)){

        $_SESSION['contact-page-success']=" You input hase been successfully noted";
     }
    

     }

     header('location:'.ROOT_URL.'contact.php');
     die();

     ?>