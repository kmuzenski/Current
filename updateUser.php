<?php
 error_reporting(E_ALL);
    require_once 'database.php';
 
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $location = $_POST['location'];
         
      function valid($varname){
        return ( !empty($varname) && isset($varname) );
      }
      if (!valid($username) || !valid($email) || !valid($password) || !valid($location)) {
        header("Location: update.php");
      } else if (!valid($email)) {
        header("Location: update.php");
      } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        header("Location: update.php");
      }
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE user SET username = ?, email = ?, password = ?, location = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username,$email,$password,$location,$id));
      Database::disconnect();
      header("Location: profile.php");
    }