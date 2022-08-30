<?php

require 'config/database.php';

if(isset($_POST['submit'])){
$id=filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
$title=filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$description=filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);




if(!$title||!$description){
    $_SESSION['edit-category']="In valid for input on edit category page";
}


else{

$query="UPDATE categories set title='$title',description='$description' where id=$id LIMIT 1";
$result=mysqli_query($connection,$query);
if(mysqli_errno($connection)){

$_SESSION['edit-category']="Couldn't update category";


}
else{

    $_SESSION['edit-category-success']="Category $title updated successfully";
}

}

header('location:'.ROOT_URL."admin/manage-category.php");
die();



}