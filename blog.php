<?php
  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
  Database::connect();

  if ( !empty($_POST)) {
      // keep track post values
    $blogTitle = $_POST['blogTitle'];
    $blogPost = $_POST['blogPost'];
    $user_FK = $_SESSION['uid'];
      
    $blogCreate = new blogCrud($_SESSION['uid']);
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
<center>
<form action="search.php" method="POST">
<input type="text" name="search" placeholder="Search Blog Posts">
<input type="submit" value="submit">
</form>
</center>

<div class="container">
<div class="row">
<div class="col-xs-6">
<h3><p id="title"><strong>Create a Blog Post</strong></p></h3>

<form class="form" action="blog.php" method="post">

<div class="control-group <?php echo !empty($blogTitleError)?'error':'';?>">
<label class="control-label"><p>Blog Title</p></label>
<div class="controls">
<input name="blogTitle" type="text" size="35" placeholder="Blog Title" value="<?php echo !empty($blogTitle)?$blogTitle:'';?>">
<?php if (!empty($blogTitleError)): ?>
<span class="help-inline"><?php echo $blogTitleError;?></span>
<?php endif; ?>
</div>
</div>

<div class="control-group <?php echo !empty($blogPostError)?'error':'';?>">
<label class="control-label"><p>Blog Post</p></label>
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
*/
?>
<br><br><br>

<div class="form-actions">
<button type="submit" class="btn btn-success"><p>Create</p></button>
</div>
</form>
</div>



<div class="col-xs-6">	
<h3><p id="title"> <strong>Recent Blog Posts</strong> </p></h3>
<input type="hidden" id="current_page"/>
<input type="hidden" id ="show_per_page"/>
<div id ="content">
<?php

	$blog = new blogCrud($_SESSION['uid']);
	foreach ($blog->read() as $row) { 
	echo '<table class="table table-striped table-bordered" id="blog">';
	echo '<tr><td><p>Date Posted:<br>'.$row['postDate'].'<br></p></td></tr>';
	echo '<tr><td><p>Blog Title:<br><a href="viewpost.php?id='.$row['id'].'">'.$row['blogTitle'].'</a></p><br></td></tr>';
	echo '<tr><td><p>Blog Post:<br>'.$row['blogPost'].'</p></td></tr>';
  echo '<tr><td><div id="fb-root"></div>';
  echo '<div class="fb-share-button" data-href="http://ec2-52-32-48-99.us-west-2.compute.amazonaws.com/Current/viewpost.php?id='.$row['id'].'" data-layout="button" data-mobile-iframe="true"></div></td></tr>';
  echo '<tr><td><a href="https://twitter.com/intent/tweet?text=Hello%20world" class="twitter-share-button" data-show-count="false">Tweet</a></td></tr>';
	echo '</table>';
	}

?>
</div>

<div id ="page_navigation"></div>
</div>

</div>
</div>


<br><br><br>




<br><br><br>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>

<?php require_once('footer.php'); 
Database::disconnect();?>
<script>

$(document).ready(function() {
 
var show_per_page = 3;
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
