<?php
include 'partials/header.php';
$title=$_SESSION['add-category-data']['title'] ?? null;
$description=$_SESSION['add-category-data']['description'] ?? null;
unset($_SESSION['add-category-data']);

?>













<section class="dashboard">

    <?php if (isset($_SESSION['add-category-success'])) : ?>
        <div class="alert__message-success container ">
            <p>
                <?= $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success']);
                ?>

            </p>
        </div>

    <?php elseif (isset($_SESSION['add-category'])) : ?>
        <div class="alert__message-error container">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>

            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-category'])) : ?>
        <div class="alert__message-error container">
            <p>
                <?= $_SESSION['edit-category'];
                unset($_SESSION['edit-category']);
                ?>

            </p>
        </div>
        <?php elseif (isset($_SESSION['edit-category-success'])) : ?>
        <div class="alert__message-success container">
            <p>
                <?= $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success']);
                ?>

            </p>
        </div>


        <?php elseif (isset($_SESSION['delete-category'])) : ?>
        <div class="alert__message-error container">
            <p>
                <?= $_SESSION['delete-category'];
                unset($_SESSION['delete-category']);
                ?>

            </p>
        </div>
        <?php elseif (isset($_SESSION['delete-category-success'])) : ?>
        <div class="alert__message-success container">
            <p>
                <?= $_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success']);
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




                    <li> <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage Users</h5>
                        </a></li>




                    <li> <a href="add-category.php" class="active"><i class="uil uil-edit"></i>
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

        <h2>Add Category</h2>
          <?php if(isset($_SESSION['add-category'])) :?>
            <div class="alert__message-error">

            <p>
             <?=
              $_SESSION['add-category'];
              unset($_SESSION['add-category']);
             
             ?>

            </p>
            </div>
            <?php endif?>

    
        <form action="./add-category-logic.php" method="POST">

            <input type="text" name="title" placeholder="Title">
            <textarea rows="4" name ="description" placeholder="Description"></textarea>



            <button type="submit" name="submit" class="btn">Add Category</button>


        </form>




        </main>




</section>

<?php
include '../partials/footer.php';
?>