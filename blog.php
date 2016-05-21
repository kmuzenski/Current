<?php
  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
  Database::connect();

  if ( !empty($_POST)) {
      // keep track post values
    $blogTitle = $_POST['blogTitle'];
    $blogPost = $_POST['blogPost'];
    $user_FK = $_POST['user_FK'];
      
    $blogCreate = new blogCrud();
    $_SESSION['uid'] = $blogCreate->create($blogTitle,$blogPost,$user_FK); 
   
	header('Location: blog.php');
    } 

?>

<!DOCTYPE html>
<html>

<?php require_once('header.php'); ?>

<body>

<?php //require_once('nav.php'); ?>
<br><br><br><br><br><br>

<div class="container">
<div class="row">

<div class="col-xs-6">
<h3>Create a Blog Post</h3>

<form class="form" action="blog.php" method="post">

<div class="control-group <?php echo !empty($blogTitleError)?'error':'';?>">
<label class="control-label">Blog Title</label>
<div class="controls">
<input name="blogTitle" type="text" size="35" placeholder="Blog Title" value="<?php echo !empty($blogTitle)?$blogTitle:'';?>">
<?php if (!empty($blogTitleError)): ?>
<span class="help-inline"><?php echo $blogTitleError;?></span>
<?php endif; ?>
</div>
</div>

<div class="control-group <?php echo !empty($blogPostError)?'error':'';?>">
<label class="control-label">Blog Post</label>
<div class="controls">
<textarea name="blogPost" rows="5" cols="40"><?php echo !empty($blogPost)?$blogPost:'';?></textarea>
<?php if (!empty($blogPostError)): ?>
<span class="help-inline"><?php echo $blogPostError;?></span>
<?php endif;?>
</div>
</div>

<br><br><br>
<?php
/*
// try {
//$pdo = Database::connect();
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT `user`.`id`, `user`.`username` FROM `user`";
$user = query($sql);
echo "<select name='user_FK'>";
foreach ($user as $row) {
echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
}
echo "</select>";
//} catch (PDOException $e) {
//echo $e->getMessage();
//Database::disconnect(); 
//} */
?>
<br><br><br>

<div class="form-actions">
<button type="submit" class="btn btn-success">Create</button>
</div>
</form>
</div> <!--end column -->

<div class="col-xs-6">	
<h3> Recent Blog Posts </h3>
<?php

	$blog = new blogCrud($_SESSION['uid']);
	foreach ($blog->read() as $row) { 
	echo '<table class="table table-striped table-bordered">';
	echo '<p>Date Posted:<br>'.$row['postDate'].'</p><br>';
	echo '<p>Blog Title:<br><a href="viewpost.php?id='.$row['id'].'">'.$row['blogTitle'].'</a></p><br>';
	echo '<p>Blog Post:<br>'.$row['blogPost'].'</p><br><br><br>';
	echo '</table>';
	}

?>
</div>

</div><!--end row -->
</div><!-- end containter -->

<br><br><br>
<?php require_once('footer.php'); 
Database::disconnect();?>

 </body>
</html>
