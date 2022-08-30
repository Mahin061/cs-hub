<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}



?>













<section class="dashboard">

    <?php if (isset($_SESSION['add-user-success'])) : ?>
        <div class="alert__message-success container ">
            <p>
                <?= $_SESSION['add-user-success'];
                unset($_SESSION['add-user-success']);
                ?>

            </p>
        </div>

    <?php elseif (isset($_SESSION['edit-user-success'])) : ?>
        <div class="alert__message-success container">
            <p>
                <?= $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']);
                ?>

            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-user'])) : ?>
        <div class="alert__message-error container">
            <p>
                <?= $_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
                ?>

            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user'])) : ?>
        <div class="alert__message-error container">
            <p>
                <?= $_SESSION['delete-user'];
                unset($_SESSION['delete-user']);
                ?>

            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user-success'])) : ?>
        <div class="alert__message-success container">
            <p>
                <?= $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success']);
                ?>

            </p>
        </div>
    <?php endif ?>


    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-left-right-b"></i></button>
        <aside>
            <ul>

                <li> <a href="add-post.php"><i class="uil uil-pen"> </i>

                        <h5> Add Post </h5>
                    </a>
                </li>




                <li> <a href="index.php"><i class="uil uil-postcard"></i>
                        <h5>Manage Posts</h5>
                    </a></li>




                <?php if (isset($_SESSION['user_is_admin'])) : ?>


                    <li> <a href="add-user.php"><i class="uil uil-user-plus"></i>
                            <h5> Add User </h5>
                        </a></li>



                    <li> <a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i>
                            <h5>Manage Users</h5>
                        </a></li>




                    <li> <a href="add-category.php"><i class="uil uil-edit"></i>
                            <h5> Add Category </h5>
                        </a></li>




                    <li> <a href="manage-category.php"><i class="uil uil-list-ul"></i>
                            <h5> Manage Categories </h5>
                        </a></li>

                <?php endif ?>
            </ul>



        </aside>

        <main>
            <h2>Edit User</h2>

            <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">


                <input type="hidden" value="<?= $user['id'] ?>" name="id">
                <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="First Name">
                <input type="text" value="<?= $user['lastname'] ?>" name="lastname" placeholder="Last Name">



                <select name="userrole">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>



                <button type="submit" name="submit" class="btn">Update User </button>


            </form>


        </main>
    </div>


    <?php
    include '../partials/footer.php';
    ?>