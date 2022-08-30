
<?php

require 'config/database.php';

if (isset($_GET['id'])) {

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //update category id of posts of same category
    $update_query = "UPDATE posts SET category_id=6 where category_id=$id";
    $update_result = mysqli_query($connection, $update_query);


    if (!mysqli_errno($connection)) {
        //delete category
        $query = "DELETE from categories where id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        $_SESSION['delete-category-success'] = "Category deleted successfully";
    }
}


header('location:' . ROOT_URL . 'admin/manage-category.php');
die();
