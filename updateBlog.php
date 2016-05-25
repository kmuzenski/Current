<?php
 
require_once 'database.php';
require_once 'session.php';
require_once 'crud.php';
error_reporting(E_ALL);
    
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      
      $blogTitle = $_POST['blogTitle'];
      $blogPost = $_POST['blogPost'];
     
      
         
      $blog = new blogCrud($_SESSION['uid']);
      $response = $blog->update($blogTitle,$blogPost,$id);

      if($response) {
        header('Location: profile.php');
      }
      else {
        header('Location: update.php')
      }

    }

