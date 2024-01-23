<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);    
    $is_featured = isset($_POST['is_featured']) ? filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT) : 0;
    $thumbnail = $_FILES['thumbnail'];
    
    //set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;
    //validate form data
    if(!$title){
        $_SESSION['add-post']="Enter post title";
    }else if(!$category_id){
        $_SESSION['add-post'] = "Select post category";
    }else if(!$body){
        $_SESSION['add-post'] = "Enter post body";
    }else if(!$thumbnail['name']){
        $_SESSION['add-post'] = "Choose post thumbnail";
    }else{
        //work on thumbnail
        //rename the image
        $time = time();//make each image name unique
        $thumbnail_name = $time . $thumbnail['name'];   
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;
        // make sure file is an image
        $allowd_files = ['png','jpg','jpeg']; // corregido 'jpn' a 'jpg'
        $extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION); // modificado para obtener la extensión del archivo
        if(in_array(strtolower($extension), $allowd_files)){
            //make sure image is not too big (2mb+)
            if($thumbnail['size'] < 2000000){
                //upload thumbail
                if(move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path)){
                    // File uploaded successfully
                }else{
                    $_SESSION['add-post'] = "Error uploading file";
                }
            }else{
                $_SESSION['add-post'] = "File size too big. Should be less than 2mb";
            }
        }else{
            $_SESSION['add-post'] = "File should be png, jpg or jpeg";
        }
    }
    // redirect back (with form data) to add-post page if there is any problem
    if(isset($_SESSION['add-post'])){
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    }else{
       //set is_featured of all posts to 0 if is:featured fot this post is 1
       if($is_featured == 1) {
        $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
        $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
       }       
        // insert post into database
        $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        if ($stmt === false) {
            die("Failed to prepare SQL query: " . mysqli_error($connection));
        }
        $stmt->bind_param("sssiii", $title, $body, $thumbnail_name, $category_id, $author_id, $is_featured);
        $result = $stmt->execute();
        if($result){    
            $_SESSION['add-post-success'] = "New post added successfully";        
            header('location: ' . ROOT_URL . 'admin/');
            die();
        } else {            
            die("Database query failed: " . $stmt->error);
        }
    }   
    header('location: ' . ROOT_URL . 'admin/add-post.php');
    die();
}
?>
