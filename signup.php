<?php

include 'partials/header.php';

//get back form data if registration error

$_firstname=$_SESSION['signup-data']['firstname'] ?? null;
$_lastname=$_SESSION['signup-data']['lastname'] ?? null;
$_username=$_SESSION['signup-data']['username'] ??null;
$_email=$_SESSION['signup-data']['email'] ?? null;
$_createpassword=$_SESSION['signup-data']['createpassword'] ?? null;
$_confirmpassword=$_SESSION['signup-data']['confirmpassword'] ?? null;
unset($_SESSION['signup-data']);
?>






<section class="form__section">
    <div class="container form__section-container" >
    <h2>Sign Up</h2>
     <?php if(isset($_SESSION['signup'])) :?>

    <div class="alret__meassage error">
       <p>

     <?=   
       
           $_SESSION['signup'];
           unset($_SESSION['signup']);

      ?>

       </p>


    </div>


        <?php endif ?>  

     <form action="./signup-logic.php"enctype="multipart/form-data" method="POST">

        <input type="text" value="<?= $_firstname ?>" name="firstname" placeholder="First Name">
        <input type="text" value="<?= $_lastname ?>" name="lastname" placeholder="Last Name">
        <input type="text" value="<?= $_username ?>" name="username" placeholder="User Name">
        <input type="email" value="<?= $_email ?>"  name="email" placeholder="Email">
        <input type="password"value="<?= $_createpassword ?>" name="createpassword" placeholder="Create Password">
        <input type="password" value="<?= $_confirmpassword ?>" name="confirmpassword" placeholder="Confirm Password">
        
        
        <div class="form__control">
            <label for="avatar"></label>
            <input type="file" name="avatar" id="avatar">

        </div>
         
          <button type="submit" name="submit" class="btn">Sign Up </button>
          <small> Already Have An Account?   <a href="signin.php">Sign In </a>  </small>
         

     </form> 
     <br>  
     <a href="./blog.php">  <button type="submit" name="submit" class="btn">Back to Blog </button></a>
   
     
   
    </div>
</section>
<?php
include 'partials/footer.php';
?>
