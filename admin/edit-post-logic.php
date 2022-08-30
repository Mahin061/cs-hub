<?php
require 'config/database.php';
if (isset($_POST['submit'])) {

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    $_isfeatured = $is_featured == 1 ?: 0;

     
    //$_SESSION['edit-post'] = "".$previous_thumbnail_name;
    if (!$title) {


        $_SESSION['edit-post'] = "Couldn't update post. Insuffecient form data";
    } elseif (!$category_id) {


        $_SESSION['edit-post'] = "Couldn't update category id. Insuffecient form data";
    } elseif (!$body) {



        $_SESSION['edit-post'] = "Couldn't update body. Insuffecient form data";
    } else {
        // delete existing thumbnail if new thumbnail is available

        if ($thumbnail['name']) {

            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if ($previous_thumbnail_path) {

                unlink($previous_thumbnail_path);
            }
        
        
         
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);
        
        if(in_array($extension,$allowed_files))
        { //make sure 2mb
  
           if($thumbnail['size'] < 2000000)
               {
                 //$_SESSION['add-post']="  ".$thumbnai_destination_path."  ".$thumbnail_tmp_name;
               move_uploaded_file($thumbnail_tmp_name,$thumbnail_destination_path);
          
  
               }
               else
               {      
                 $_SESSION['edit-post']="File size to big should be less than 2 mb";
  
               }
             
                    
        }
        else {
  
            $_SESSION['edit-post']="File should be png,jpeg or jpeg";
  
        }
        
        
        }
        //work on new thumbnail





  

     


 









    }

    if (isset($_SESSION['edit-post'])) {

        header('location:' . ROOT_URL . 'admin/');
        die();
    } else {
        if ($is_featured == 1) {

            $zero_featured_query = "update posts is_featured=0";
            $zero_featured_result = mysqli_query($connection, $zero_featured_query);
        }

        //set new thumbnail if was updates else keep same

        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
        
        


        $query =  "UPDATE posts SET title='$title',body='$body',thumbnail='$thumbnail_to_insert',
   category_id=$category_id,is_featured=$is_featured where id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
       // $_SESSION['edit-post-success'] = "Post updates successfully" . $id;
        if (!mysqli_errno($connection)) {

            $_SESSION['edit-post-success'] = "Post updates successfully";
        }
    }

    header('location:' . ROOT_URL . 'admin/');
    die();
}
