<?php
  require_once('database.php');
	require_once('session.php');
	require_once('crud.php');

  if ( !empty($_POST)) {
      // keep track post values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $location = $_POST['location'];
   
   
    $userCreate = new UserCrud();
    $_SESSION['uid'] = $userCreate->create($username,$email,$password,$location); 
   

	 header('Location: index.php');
    }

  

?>



<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>


<body>

<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>

<div class="container">
<div class="row">
<div class="col-xs-12">
<h1>SITE MAP</h1>
<a href="index.php" alt="index" title="index">Home</a><br>
<a href="blog.php" alt="blog" title="blog">Blog</a><br>
<a href="register.php" alt="register" title="register">Register</a><br>
<a href="login.php" alt="login" title="login">Login</a><br>
<a href="logout.php" alt="logout" title="logout">Logout</a><br>
</div>
</div>
</div>


<?php require_once('footer.php'); ?>
 </body>
</html>
