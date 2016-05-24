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

<table class="table table-striped table-bordered">
<thead>
<tr>
  <th>username</th>
  <th>email</th>
  <th>password</th>
  <th>location</th>
  <th>Action</th>
  <th>Action</th>
</tr>
</thead>
<tbody>
<?php
  $user = new UserCrud($_SESSION['uid']);
                
 	foreach ($user->read() as $row) {
	echo '<tr>';
  echo '<form method="POST" action="updateUser.php">';
  echo '<input type="hidden" name="id" value="'.$row['id'].'">';
  echo '<td><input type="text" name="username" value="'.$row['username'].'"></td>'; 
  echo '<td><input type="text" name="email" value="'.$row['email'].'"></td>';
  echo '<td><input type="text" name="password" value="'.$row['password'].'"></td>';
  echo '<td><input type="text" name="location" value="'.$row['location'].'"></td>';
  echo '<td><input type="submit" value="Update"></td>';
  echo '</form>';
  echo '<form method="POST" action="userDelete.php">';
  echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
  echo '<td><input type="submit" value="Delete"></td>';
  echo '</form>';
  echo '</tr>';
  }
?>
</tbody>
</table>
</div>
</div>

<?php

  $blog = new blogCrud($_SESSION['uid']);
                
  foreach ($blog->readUserBlog() as $row) {
    echo '<p>' .$row['blogTitle']. '</p><br>';
    echo '<p>do this</p>';

  }


?>

<?php require_once('footer.php');
Database::disconnect();
?>

</body>
</html>