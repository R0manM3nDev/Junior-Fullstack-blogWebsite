<?php
require 'config/database.php';

//make sure edit post button was clicked
if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);    
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);    
    $is_featured = isset($_POST['is_featured']) ? filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT) : 0;
    $thumbnail = $_FILES['thumbnail'];
    
    //set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;
    //check and validate input values
    if(!$title){
        $_SESSION['edit-post']="Couldn't update post. Invalid forn fata on edit post page";
    }else if(!$category_id){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid forn fata on edit post page";
    }else if(!$body){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid forn fata on edit post page";
    }else{
        //delete existing thumbnail if new thumbnail is avaible
        if($thumbnail['name']){
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if(file_exists($previous_thumbnail_path)){
                unlink($previous_thumbnail_path);
            }        
            //work on new thumbnail
            //rename image
            $time = time();//make each image name upload unique using current timestamp
            $thumbnail_name = $time . $thumbnail['name'];   
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;
            // make sure file is an image
            $allowd_files = ['png','jpg','jpeg'];
            $extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION); // modificado para obtener la extensión del archivo
            if(in_array(strtolower($extension), $allowd_files)){
                //make sure image is not too big (2mb+)
                if($thumbnail['size'] < 2_000_000){
                    //upload thumbail
                    if(move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path)){
                        // File uploaded successfully
                    }else{
                        $_SESSION['edit-post'] = "Error uploading file";
                    }
                }else{
                    $_SESSION['edit-post'] = "Couldn't update post. File size too big. Should be less than 2mb";
                }
            }else{
                $_SESSION['edit-post'] = "Couldn't update post. File should be png, jpg or jpeg";
            }
        }
    }
    // redirect back (with form data) to edit-post page if there is any problem
    if(isset($_SESSION['edit-post'])){
        $_SESSION['edit-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/edit-post.php');
        die();
    }else{
       //set is_featured of all posts to 0 if is:featured fot this post is 1
        if($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }   
        //set thumbnail if a new one was uploaded, else keep old thumbnail name
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
        // update post into database
        $query = "UPDATE posts SET title=?, body=?, thumbnail=?, category_id=?, is_featured=? WHERE id=?";
        $stmt = $connection->prepare($query);
        if ($stmt === false) {
            die("Failed to prepare SQL query: " . mysqli_error($connection));
        }
        $stmt->bind_param("sssiii", $title, $body, $thumbnail_to_insert, $category_id, $is_featured, $id);
        $result = $stmt->execute();
        if($result){    
            $_SESSION['edit-post-success'] = "The post updated successfully";        
            header('location: ' . ROOT_URL . 'admin/');
            die();
        } else {            
            die("Database query failed: " . $stmt->error);
        }
    }   
    header('location: ' . ROOT_URL . 'admin/edit-post.php');
    die();
}
?>