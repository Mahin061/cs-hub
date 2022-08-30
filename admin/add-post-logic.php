<?php
require 'config/database.php';
if(isset($_POST['submit'])){


$author_id=$_SESSION['user-id'];
$title=filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$body=filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$category_id=filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
$is_featured=filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT);
 $thumbnail=$_FILES['thumbnail'];
 ////set is_featured to 0 if uncheked
 $is_featured=$is_featured== 1?:0;
 if(!$title)
 {
 $_SESSION['add-post']="Enter post title";

 }
 elseif(!$category_id)
 {

    $_SESSION['add-post']="Select Post Category";
 }
 elseif(!$body)
 {
    $_SESSION['add-post']="Enter post body";


 }
 elseif(!$thumbnail['name'])
 {

  $_SESSION['add-post']="Choose post thumbnail";
     
 }
else {


    $time=time();
    $thumbnail_name=$time . $thumbnail['name'];
    $thumbnail_tmp_name = $thumbnail['tmp_name'];
    $thumbnail_destination_path='../images/' . $thumbnail_name;
    $allowed_files=['png','jpg','jpeg'];
    $extension=explode('.',$thumbnail_name);
    $extension=end($extension);

        
   if(in_array($extension,$allowed_files))
      { //make sure 2mb

         if($thumbnail['size']<2_000_000)
             {
               //$_SESSION['add-post']="  ".$thumbnai_destination_path."  ".$thumbnail_tmp_name;
             move_uploaded_file($thumbnail_tmp_name,$thumbnail_destination_path);
        

             }
             else
             {      
               $_SESSION['add-post']="File size to big should be less than 2 mb";

             }
           
                  
      }
      else {

          $_SESSION['add-post']="File should be png,jpeg or jpeg";

      }

}



 

///redirect back if problem

if(isset($_SESSION['add-post'])){

$_SESSION['add-post-data']=$_POST;
header('location:'.ROOT_URL.'admin/add-post.php');
die();

}
else {
if($is_featured==1){

   $zero_query="update posts set is_featured=0";
   $zero_result=mysqli_query($connection,$zero_query);
}
   
$query="INSERT INTO posts (title,body,thumbnail,category_id,author_id,is_featured) values
      ('$title','$body','$thumbnail_name',$category_id,$author_id,$is_featured)";

$result=mysqli_query($connection,$query);

if(!mysqli_errno($connection)){

$_SESSION['add-post-success']="new post added successfully";
header('location:'.ROOT_URL.'admin/');
die();
echo'eikhne ashe nai'; // CHECK KRTE HBE!!

}



}







}
header('location:'.ROOT_URL.'admin/add-post.php');
die();