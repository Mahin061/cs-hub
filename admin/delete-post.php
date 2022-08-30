<?php

require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * from posts where id=$id";
    $result = mysqli_query($connection, $query);


    // make sure only 1 record

    if (mysqli_num_rows($result)) {

        $post = mysqli_fetch_assoc($result);
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
            //delte post from databse

            $delte_post = "DELETE FROM posts where id=$id LIMIT 1";
            $delete_post_result = mysqli_query($connection, $delte_post);

            if (!mysqli_errno($connection)) {

                $_SESSION['delte-post-success'] = "Post has been successfully deleted";
            }
        }
    }
}
header('location:' . ROOT_URL . 'admin/');
die();