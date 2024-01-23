<?php include 'partials/header.php';
//fetch users from database but not current user
$current_admib_id = $_SESSION['user-id'];
$query = "SELECT * FROM users WHERE NOT id=$current_admib_id";
$users = mysqli_query($connection, $query);
?>

    <!--dashboard-->
    <section class="dashboard">

        <?php if(isset($_SESSION['add-user-success'])) {//show if add user was succesful?>
            <div class="alert_messege success container">
                <p>
                    <?=$_SESSION['add-user-success'];
                    unset($_SESSION['add-user-success']);?>
                </p>
            </div>
        <?php }else if(isset($_SESSION['edit-user-success'])) {//show if edit user was succesful?>
            <div class="alert_messege success container">
                <p>
                    <?=$_SESSION['edit-user-success'];
                    unset($_SESSION['edit-user-success']);?>
                </p>
            </div>
        <?php }else if(isset($_SESSION['edit-user'])) {//show if edit user was NOT succesful?>
            <div class="alert_messege error container">
                <p>
                    <?=$_SESSION['edit-user'];
                    unset($_SESSION['edit-user']);?>
                </p>
            </div>
        <?php }else if(isset($_SESSION['delete-user'])) {//show if delete user was succesful?>
            <div class="alert_messege success container">
                <p>
                    <?=$_SESSION['delete-user'];
                    unset($_SESSION['delete-user']);?>
                </p>
            </div>  
        <?php }else if(isset($_SESSION['delete-user'])) {//show if delete user was NOT succesful?>
            <div class="alert_messege error container">
                <p>
                    <?=$_SESSION['delete-user'];
                    unset($_SESSION['delete-user']);?>
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
                    <li>
                        <a href="index.php">
                            <i class="uil uil-envelope-share"></i>
                            <h5>Manage Post</h5>
                        </a>                        
                    </li>                    
                    <?php if(isset($_SESSION['user_is_admin'])){?>
                        <li>    
                            <a href="add-user.php">
                                <i class="uil uil-user"></i>
                                <h5>Add User</h5>
                            </a>                        
                        </li>
                        <li>
                            <a href="manage-user.php" class="active">
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
                            <a href="manage-categories.php">
                                <i class="uil uil-list-ul"></i>
                                <h5>Manage Categories</h5>
                            </a>                        
                        </li>
                    <?php }?>
                </ul>
            </aside>
            <main>
                <h2>Manage Users</h2>
                <?php if(mysqli_num_rows($users) > 0) {?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Userame</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = mysqli_fetch_assoc($users)) { ?>
                            <tr>
                                <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><a href="<?= ROOT_URL?>admin/edit-user.php?id=<?= $user['id']?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL?>admin/delete-user.php?id=<?= $user['id']?>" class="btn sm danger">Delete</a></td>
                                <td><?= $user['is_admin']?'Yes' : 'No' ?></td>
                            </tr>   
                        <?php }?>                                                                
                    </tbody>
                </table>
                <?php }else{?>
                    <div class="alert_message error"><?= "No users found"?></div>
                <?php }?>                    
            </main>
        </div>
    </section>
<!--footer-->

<?php include'../partials/footer.php';?>