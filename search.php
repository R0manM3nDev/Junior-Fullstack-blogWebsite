<?php
require 'partials/header.php';
require 'config/database.php';
if(isset($_GET['search']) && isset($_GET['submit'])){
    $search = filter_var($_GET['search'].FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY id DESC";
    $posts = mysqli_query($connection, $query);
}else{
    header('location: '. ROOT_URL . 'blog.php');
}
?>
<!--posts-->
<?php if(mysqli_num_rows($posts) > 0){ ?>
<section class="post">
    <div class="container posts_container">
    <?php while($post = mysqli_fetch_assoc($posts)){ ?>
        <article class="post">
            <div class="post_thumbnail">
                <img src="./images/<?=$post['thumbnail'] ?>">                    
            </div>
            <div class="post_info">
                <?php
                    //fetch category from categories table using category_id of post
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                ?>
                <a href="<?=ROOT_URL?>category-posts.php?id=<?= $post['category_id'] ?>" class="category_button"><?= $category['title'] ?></a>
                <h3 class="post_title">
                    <a href="<?=ROOT_URL?>post.php?id=<?= $post['id'] ?>">
                        <?=$post['title'] ?>
                    </a>
                </h3>
                <p class="post_body">
                <?= substr($post['body'], 0,150) ?>...
                </p>
                <div class="post_author">
                    <?php
                        //fetch author from users table using author_id
                        $author_id = $post['author_id'];
                        $author_query = "SELECT * FROM users WHERE id=$author_id";
                        $author_result = mysqli_query($connection, $author_query);
                        $author = mysqli_fetch_assoc($author_result);
                    ?>
                    <div class="post_author-avatar">
                        <img src="./images/<?= $author['avatar'] ?>">
                    </div>
                    <div class="post_author-info">
                    <h5>By: <?= "{$author['firstname']} {$author['lastname']}"?></h5>
                        <small>
                        <?= date("M d, Y - H:i", strtotime($post['date_time']))?>
                        </small>
                    </div>                        
                </div>
            </div>
        </article> 
    <?php }?>
    </div>
</section>
<?php }else{?>
    <div class="alert_messege error lg section_extra-margin">
        <p>No posts found for this search</p>
    </div>   
<?php }?>
<!--Category-->
<section class="category_buttons">
    <div class="container category_buttons-container">
        <?php 
            $all_categories_query = "SELECT * FROM categories";
            $all_categories = mysqli_query($connection, $all_categories_query);        
        ?>
        <?php while($category = mysqli_fetch_assoc($all_categories)) {?> 
            <a href="<?= ROOT_URL?>category-posts.php?id=<?= $category['id'] ?>"class="category_button"><?= $category['title'] ?></a>                              
        <?php } ?>
    </div>
</section>
<?php require 'partials/footer.php'; ?>