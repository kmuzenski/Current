<?php
  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
 
  if ( !empty($_POST['id']) && isset($_POST['id'])) {
    
    $blogDelete = new blogCrud($_SESSION['uid']);
    $response = $blogDelete->delete($_POST['id']);
    if($response){
    //  echo "success";
	header("Location: profile.php");
    } else {
      echo "failure";
    }
  } else {
    // redirect
    echo "didn't get param";
  }
