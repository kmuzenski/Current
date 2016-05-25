<?php
 
require_once 'database.php';
require_once 'session.php';
require_once 'crud.php';
error_reporting(E_ALL);
    
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $postDate = $_POST['postDate'];
      $blogTitle = $_POST['blogTitle'];
      $blogPost = $_POST['blogPost'];
      $user_fk = $_POST['user_fk'];
      
         
      $blog = new blogCrud($_SESSION['uid']);
      $response = $blog->update($postDate,$blogTitle,$blogPost,$user_fk);

      if($response) {
        header('Location: profile.php');
      }
      else {
        header('Location: update.php')
      }

    }

