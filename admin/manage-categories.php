<?php 
include 'partials/header.php';
// fetch categories from database
$query = "SELECT * FROM categories ORDER BY title ASC";
$categories = mysqli_query($connection, $query);
?>

<!--dashboard-->
<section class="dashboard">
    <?php if(isset($_SESSION['add-category-success'])) {//show if add category was succesful?>
        <div class="alert_messege success container">
            <p>
                <?=$_SESSION['add-category-success'];
                unset($_SESSION['add-category-success']);?>
            </p>
        </div>
    <?php }else if(isset($_SESSION['add-category'])) {//show if add category was NOT succesful?>
        <div class="alert_messege error container">
            <p>
                <?=$_SESSION['add-category'];
                unset($_SESSION['add-category']);?>
            </p>
        </div>
    <?php }else if(isset($_SESSION['edit-category-success'])) {//show if edit category was succesful?>
        <div class="alert_messege success container">
            <p>
                <?=$_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success']);?>
            </p>
        </div>
    <?php }else if(isset($_SESSION['edit-category'])) {//show if edit category was NOT succesful?>
    <div class="alert_messege error container">
        <p>
            <?=$_SESSION['edit-category'];
            unset($_SESSION['edit-category']);?>
        </p>
    </div>
    <?php }else if(isset($_SESSION['delete-category-success'])) {//show if delete category was succesful?>
        <div class="alert_messege success container">
            <p>
                <?=$_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success']);?>
            </p>
        </div>
    <?php }else if(isset($_SESSION['delete-category'])) {//show if delete category was NOT succesful?>
    <div class="alert_messege error container">
        <p>
            <?=$_SESSION['delete-category'];
            unset($_SESSION['delete-category']);?>
        </p>
    </div>
    <?php }?>

    <div class="container dashboard_container">
        <button id="show_sidebar-btn"class="sidebar_toggle">
            <i class="uil uil-angle-right-b"></i>
        </button>
        <button id="hide_sidebar-btn"class="sidebar_toggle">
            <i class="uil uil-angle-left-b"></i>
        </button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php">
                        <i class="uil uil-edit-alt"></i>
                        <h5>Add Post</h5>
                    </a>                        
                </li>
                <?php if(isset($_SESSION['user_is_admin'])){?>
                    <li>
                        <a href="index.php">
                            <i class="uil uil-envelope-share"></i>
                            <h5>Manage Post</h5>
                        </a>                        
                    </li>
                    <li>    
                        <a href="add-user.php">
                            <i class="uil uil-user"></i>
                            <h5>Add User</h5>
                        </a>                        
                    </li>
                    <li>
                        <a href="manage-user.php">
                            <i class="uil uil-users-alt"></i>
                            <h5>Manage Users</h5>
                        </a>                        
                    </li>
                    <li>
                        <a href="add-category.php">
                            <i class="uil uil-edit"></i>
                            <h5>Add Categoy</h5>
                        </a>                        
                    </li>
                    <li>
                        <a href="manage-categories.php"class="active">
                            <i class="uil uil-list-ul"></i>
                            <h5>Manage Categories</h5>
                        </a>                        
                    </li>
                <?php }?>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if(mysqli_num_rows($categories) > 0) {?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($category = mysqli_fetch_assoc($categories)) {?>
                    <tr>
                        <td><?=$category['title']?></td>
                        <td><a href="<?= ROOT_URL?>admin/edit-category.php?id=<?=$category['id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL?>admin/delete-category.php?id=<?=$category['id']?>" class="btn sm danger">Delete</a></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <?php }else{?>
                <div class="alert_message error"><?= "No categories found"?></div>
            <?php }?>
        </main>
    </div>
</section>
    
<?php include'../partials/footer.php';?>