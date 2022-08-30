<?php
include 'partials/header.php';

$current_admin_id=$_SESSION['user-id'];
$query="select * from contact_data";
$contacts= mysqli_query($connection,$query);



?>













<section class="dashboard">

<?php if (isset($_SESSION['add-user-success'])) :?>
  <div class="alert__message-success container ">
    <p>
    <?=$_SESSION['add-user-success'];
     unset($_SESSION['add-user-success']);
    ?>
     
    </p>           
</div>

<?php elseif (isset($_SESSION['edit-user-success'])):?>
  <div class="alert__message-success container">
    <p>
    <?=$_SESSION['edit-user-success'];
     unset($_SESSION['edit-user-success']);
    ?>
     
    </p>           
</div>
<?php elseif (isset($_SESSION['edit-user'])):?>
  <div class="alert__message-error container">
    <p>
    <?=$_SESSION['edit-user'];
     unset($_SESSION['edit-user']);
    ?>
     
    </p>           
</div>
<?php elseif (isset($_SESSION['delete-user'])):?>
  <div class="alert__message-error container">
    <p>
    <?=$_SESSION['delete-user'];
     unset($_SESSION['delete-user']);
    ?>
     
    </p>           
</div>
<?php elseif (isset($_SESSION['delete-user-success'])):?>
  <div class="alert__message-success container">
    <p>
    <?=$_SESSION['delete-user-success'];
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



                    <li> <a href="manage-users.php" ><i class="uil uil-users-alt"></i>
                            <h5>Manage Users</h5>
                        </a></li>




                    <li> <a href="add-category.php"><i class="uil uil-edit"></i>
                            <h5> Add Category </h5>
                        </a></li>




                    <li> <a href="manage-category.php"><i class="uil uil-list-ul"></i>
                            <h5> Manage Categories </h5>
                        </a></li>
                        <li> <a href="view-contact.php" class="active"><i class="uil uil-list-ul"></i>
                            <h5> Manage Contacts </h5>
                        </a></li>

                <?php endif ?>
            </ul>



        </aside>

        <main>
            <h2>Manage Contacts</h2>
            <?php if(mysqli_num_rows($contacts)>0): ?>
            <table>
                <thead>
                  
                    <th>Title</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Delete</th>
                

                </thead>
                <tbody>
                    <?php while($contact= mysqli_fetch_assoc($contacts)):?>
                    <tr>
                        <td><?=$contact['title']?></td>
                        <td><?=$contact['email']?></td>

                         <td><?=$contact['description']?></td>
                        <td><a href="<?=ROOT_URL?>admin/delete-contact.php? id=<?= $contact['id']?>" class="btn sm danger">Delete</a></td>
                        
                    </tr>
                    <?php endwhile?>

                </tbody>

            </table>
          <?php else :?>
            <div class="alert__message-error"  >No contacts dound</div>  
            <?php endif ?> 
             
        </main>
    </div>


    <?php
    include '../partials/footer.php';
    ?>