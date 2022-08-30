<?php

include 'partials/header.php';
if (isset($_GET['id'])) {
     $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
     $query = "SELECT * FROM posts WHERE id=$id";
     $result = mysqli_query($connection, $query);
     $post = mysqli_fetch_assoc($result);
} else {


     header('location:' . ROOT_URL . 'blog.php');
     die();
}
?>

<section class="singlepost">
     <div class="container singlepost__container">
          <h2><?= $post['title'] ?></h2>
          <div class="post__author">
               <?php
               //fetch author from user table using author id
               $author_id = $post['author_id'];
               $author_query = "SELECT * FROM users where id=$author_id";
               $author_result = mysqli_query($connection, $author_query);
               $author = mysqli_fetch_assoc($author_result);



               ?>
               <div class="post__author-avatar">
                    <img src="./images/<?= $author['avatar'] ?>">
               </div>
               <div class="post__author-info">
                    <h5>By: <?= "{$author['firstname']}{$author['lastname']}" ?></h5>
                    <small><?= date("M d,Y - H:i", strtotime($post['date_time']))   ?></small>
               </div>
          </div>
          <div class="singlepost__thumbnail">
               <img src="./images/<?=$post['thumbnail']?>">

          </div>
          <p><?= $post['body']?></p>


</section>

<!-- ****End of single post*** -->





<section class="category__buttons">
    <div class="container category__buttons-container">
        <?php
        $all_categories_query="SELECT *from categories";
        $all_categories=mysqli_query($connection,$all_categories_query);

                
         ?>

         <?php while($category=mysqli_fetch_assoc($all_categories)) :?>
        <a href="<?=ROOT_URL?>category-posts.php?id=<?=$category['id']?>" class="category__button"><?=$category['title'] ?> </a>
         <?php endwhile?>
     
    </div>
</section>
<!-- ****END OF CATEGORY BUTTONS**** -->







<?php
include 'partials/footer.php';
?>