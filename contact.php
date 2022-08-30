<?php
//index.php

$error = '';
$name = '';
$email = '';
$phonenumber = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["phonenumber"]))
 {
  $error .= '<p><label class="text-danger">phonenumber is required</label></p>';
 }
 else
 {
  $phonenumber = clean_text($_POST["phonenumber"]);
 }
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }

 if($error == '')
 {
  $file_open = fopen("DATA_STORE.csv", "a");
  $no_rows = count(file("DATA_STORE.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'phonenumber' => $phonenumber,
   'message' => $message
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Thank you for contacting us</label>';
  $name = '';
  $email = '';
  $phonenumber = '';
  $message = '';
 }
 

}

?>



<?php
include 'partials/header.php';
?>


<section class="form__section">

   
        <div class="container form__section-container">
            <h1>Contact Us</h1>
            <h2>Please use this form to give us any suggestions !</h2>
          
            <?php if (isset($_SESSION['contact-page'])) : ?>
        <div class="alert__message-error container ">
            <p>
                <?= $_SESSION['contact-page'];
                unset($_SESSION['contact-page']);
                ?>

            </p>
        </div>
        <?php endif ?>
            <form action="./contact-page-logic.php" method="POST">

                <input type="email" name="email"   placeholder="email">
                <input type="text" name="title"   placeholder="title">
                <textarea name="desc" rows="5" placeholder="description"></textarea>

             

               
                

                <button type="submit" name="submit" class="btn">Submit </button>
               

            </form>


        </div>
    </section>


<?php
include 'partials/footer.php';
?>