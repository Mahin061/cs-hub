<?php require 'config/database.php';
if (isset($_GET['id'])) {


    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    //fetch user from database
    $query = "Select * from users where id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        //delete avatar
        if ($avatar_path)
            unlink($avatar_path);
    }


    //for later delete thumbnails and posts

    $thumbnail_query = "SELECT thumbnail from posts where author_id=$id";
    $thumbnail_result = mysqli_query($connection, $thumbnail_query);


    if (mysqli_num_rows($thumbnail_result) > 0) {
        while ($thumbnail = mysqli_fetch_assoc($thumbnail_result)) {
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
            //delete thumbnail from images folder

            if ($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }
    }












    $delete_user_query = "Delete from users where id=$id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if (mysqli_errno($connection)) {

        $_SESSION['delete-user'] = "Coludnt '{$user['firstname']}' delete user ";
    } else {

        $_SESSION['delete-user-success'] = " '{$user['firstname']}' deleted successfully    ";
    }
    header('location:' . ROOT_URL . 'admin/manage-users.php');

    die();
}
