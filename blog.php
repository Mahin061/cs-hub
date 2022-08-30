<?php
include 'partials/header.php';

$query = "SELECT * FROM posts ORDER BY date_time DESC";
$posts = mysqli_query($connection, $query);
?>

  <section class="search_bar">
    <form class="container search_bar-container " method="GET" action="./search.php">
       <div>
        <i class="uil uil-search"></i>
        <input type="search" name="search" placeholder="search">
       </div>
       <button type="submit" name="submit"  class="btn">Go</button>

    </form>   


  </section>   



  <section class="posts <?=$featured ? '' : 'section__extra-margin' ?>">
    <div class="container posts__container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>

            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post__info">
                    <?php
                    // fetch category from category table 
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories where id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    $category_title = $category['title'];

                    ?>
                    <a href="<?=ROOT_URL ?>category-posts.php?id=<?= $featured['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <h3 class="post__title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    </h3>
                    <p class="post__body">
                        <?= substr($post['body'], 0, 150) ?>...
                    </p>
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

                </div>
            </article>
        <?php endwhile ?>
    </div>
</section>



<section class="category__buttons">
    <div class="container category__buttons-container">
        <?php
        $all_categories_query = "SELECT *from categories";
        $all_categories = mysqli_query($connection, $all_categories_query);


        ?>

        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?> </a>
        <?php endwhile ?>

    </div>
</section>
<!-- ****END OF CATEGORY BUTTONS**** -->

<?php
include 'partials/footer.php';
?>