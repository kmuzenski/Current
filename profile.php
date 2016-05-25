<?php 
require_once('session.php');
require_once('database.php');
require_once('crud.php'); 
	Database::connect();
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>
 
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>

<h1>this is your profile page </h1>

<div class="container">
<div class="row">
<div class="col-md-6">

<table class="table table-striped table-bordered">
<thead>
<h3>Update User Info</h3>
</thead>
<tbody>
<?php
  $user = new UserCrud($_SESSION['uid']);
                
 	foreach ($user->read() as $row) {
	
  echo '<form method="POST" action="updateUser.php">';
  echo '<input type="hidden" name="id" value="'.$row['id'].'">';
  echo '<tr><td><input type="text" name="username" value="'.$row['username'].'"></td></tr>'; 
  echo '<tr><td><input type="text" name="email" value="'.$row['email'].'"></td></tr>';
  echo '<tr><td><input type="text" name="password" value="'.$row['password'].'"></td></tr>';
  echo '<tr><td><input type="text" name="location" value="'.$row['location'].'"></td></tr>';
  echo '<tr><td><input type="submit" value="Update"></td></tr>';
  echo '</form>';

  
  }
?>
</tbody>
</table>
</div>

<div class="col-md-6">


<?php

  $blog = new blogCrud($_SESSION['uid']);
                
  foreach ($blog->readUserBlog() as $row) {
    echo '<table class="table table-striped table-bordered">';
    echo '<tr><td><p>' .$row['blogTitle']. '</p><br></td></tr>';
    echo '<tr><td><p>' .$row['postDate']. '</p><br><tr><td>';
    echo '<tr><td><p>' .$row['blogPost']. '</p><br><tr><td>';
    echo '</table>';
   

  }


?>

<?php require_once('footer.php');
Database::disconnect();
?>
</div>
</div>
</div>

</body>
</html>