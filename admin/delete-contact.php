<?php

require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);}


    $delete_contact = "DELETE FROM contact_data where id=$id LIMIT 1";
    $delete_contact_result = mysqli_query($connection, $delete_contact);

    header('location:'.ROOT_URL.'admin/view-contact.php');
    die();