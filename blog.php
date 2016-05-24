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
    $response = $blogCreate->create($blogTitle,$blogPost,$user_FK); 
   
	header('Location: blog.php');
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


$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT `user`.`id`, `user`.`username` FROM `user`";
$user = $pdo->query($sql);
echo "<select name='user_FK'>";
foreach ($user as $row) {
echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
}
echo "</select>";

Database::disconnect();  
?>
<br><br><br>

<div class="form-actions">
<button type="submit" class="btn btn-success">Create</button>
</div>
</form>
</div> <!--end column -->
</div>



<div class="row">
<div class="col-xs-12">	
<h3> Recent Blog Posts </h3>
<input type="hidden" id="current_page"/>
<input type="hidden" id ="show_per_page"/>
<div id ="content">
<?php

	$blog = new blogCrud($_SESSION['uid']);
	foreach ($blog->read() as $row) { 
	echo '<table class="table table-striped table-bordered>';
	echo '<tr><td>Date Posted:<br>'.$row['postDate'].'<br></td></tr>';
	echo '<tr><td>Blog Title:<br><a href="viewpost.php?id='.$row['id'].'">'.$row['blogTitle'].'</a><br></td></tr>';
	echo '<tr><td>Blog Post:<br>'.$row['blogPost'].'</td></tr>';
	echo '</table>';
	}

?>
</div>
</div>

<div id ="page_navigation"></div>
</div>

</div>
</div>

<br><br><br>
<center>

<form action="search.php" method="POST">
<input type="text" name="search">
<input type="submit" value="submit">
</form>

<br><br><br>
<?php require_once('footer.php'); 
Database::disconnect();?>
<script>
$(document).ready(function() {
 
var show_per_page = 5;
var number_of_items = $("#content").children().size();
var number_of_pages = Math.ceil(number_of_items/show_per_page);

$("#current_page").val(0);
$("#show_per_page").val(show_per_page);

var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
var current_link = 0;
while (number_of_pages > current_link) {
  navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link + ')" longdesc"' + current_link + '">' + (current_link + 1) + '</a>';
  current_link++;
}
navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';

$("#page_navigation").html(navigation_html);

$('#page_navigation .page_link:first').addClass('active_page');

$("#content").children().css('display', 'none');
$("#content").children().slice(0, show_per_page).css('display', 'block');


});

function previous() {
  new_page = parseInt($("#current_page").val()) - 1;
  if ($(".active_page").previous('.page_link:first').length == true) {
    go_to_page(new_page);
  }
}

function next(){
  new_page = parseInt($("#current_page").val()) + 1;
  if ($(".active_page").next('.page_link').length == true) {
    go_to_page(new_page);
  }


}

function go_to_page (page_num) {
  var show_per_page = parseInt($("#show_per_page").val());
  start_from = page_num * show_per_page;
  end_on = start_from + show_per_page;

  $("#content").children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
  $('.page_link[longdesc' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass('active_page');
  $('#current_page').val(page_num);
}
</script>
 </body>
</html>
