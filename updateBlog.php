<?php
 error_reporting(E_ALL);
require_once 'database.php';
require_once 'session.php';
require_once 'crud.php';
 
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $postDate = $_POST['postDate'];
      $blogTitle = $_POST['blogTitle'];
      $blogPost = $_POST['blogPost'];
      
         
      $blog = new blogCrud($_SESSION['uid']);
      $response = $blog->update($blogTitle,$postDate,$blogPost,$id);

    }

