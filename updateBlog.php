<?php
 
require_once 'database.php';
require_once 'session.php';
require_once 'crud.php';
error_reporting(E_ALL);
    try {
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      
      $blogTitle = $_POST['blogTitle'];
      $blogPost = $_POST['blogPost'];
     
      
         
      $updateblog = new blogCrud($_SESSION['uid']);
      $response = $updateblog->update($blogTitle,$blogPost,$id);

    /*  if($response) {
        header('Location: profile.php');
      }
      */
      }
    } catch(Exception $e) {
      echo $e->getMessage();
      
    }

