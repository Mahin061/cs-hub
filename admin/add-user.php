<?php
include 'partials/header.php';

$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
$userrole = $_SESSION['add-user-data']['userrole'] ?? null;



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


                    <li> <a href="add-user.php" class="active"> <i class="uil uil-user-plus"></i>
                            <h5> Add User </h5>
                        </a></li>



                    <li> <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Users</h5>
                        </a></li>




                    <li> <a href="add-category.php"><i class="uil uil-edit"></i>
                            <h5> Add Category </h5>
                        </a></li>




                    <li> <a href="manage-category.php"><i class="uil uil-list-ul"></i>
                            <h5> Manage Categories </h5>
                        </a></li>


                        <li> <a href="view-contact.php"><i class="uil uil-list-ul"></i>
                            <h5> Manage Contacts </h5>
                        </a></li>

                <?php endif ?>
            </ul>



        </aside>

        <main>

            <h2>Add User</h2>
            <?php if (isset($_SESSION['add-user'])) :  ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-user'];

                        unset($_SESSION['add-user']);
                        ?>


                    </p>
                </div>
            <?php endif ?>

            <form action="./add-user-logic.php" enctype="multipart/form-data" method="POST">

                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
                <input type="text" name="username" value="<?= $username ?>" placeholder="User Name">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">

                <select name="userrole">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>

                <div class="form__control">
                    <label for="avatar"></label>
                    <input type="file" name="avatar" id="avatar">

                </div>

                <button type="submit" name="submit" class="btn">Add User </button>


            </form>

        </main>
    </div>


    <?php
    include '../partials/footer.php';
    ?>