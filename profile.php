<?php 
require_once('session.php');
require_once('database.php');
require_once('crud.php'); 
	Database::connect();
?>

<!DOCTYPE html>
<html>
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
  echo '<tr><td>Username:<br><input type="text" name="username" value="'.$row['username'].'"></td></tr>'; 
  echo '<tr><td>Email:<br><input type="text" name="email" value="'.$row['email'].'"></td></tr>';
  echo '<tr><td>Password:<br><input type="text" name="password" value="'.$row['password'].'"></td></tr>';
  echo '<tr><td>Location:<br><input type="text" name="email" value="'.$row['location'].'"></td></tr>';
  echo '<tr><td><input type="submit" value="Update"></td></tr>';
  echo '</form>';

  
  }
?>
</tbody>
</table>
</div>
</div>
</div>


<div class="container">
<input type="hidden" id="current_page"/>
<input type="hidden" id ="show_per_page"/>

<div id="content">
<?php

  $blog = new blogCrud($_SESSION['uid']);
                
  foreach ($blog->readUserBlog() as $row) {

    echo '<form method="POST" action="updateBlog.php">';
    echo '<input type="hidden" name="id" value="'.$row['id'].'">';
    echo '<table class="table table-striped table-bordered">';
  //  echo '<tr><td><p>Blog Title:</p><br><input type="text" name="postDate" value="'.$row['postDate'].'"></td></tr>'; 
    echo '<tr><td><p>Blog Title: </p><br><input type="text" name="blogTitle" value="'.$row['blogTitle'].'"></td></tr>';
    echo '<tr><td><p>Blog Post: </p><br><input type="text" name="blogPost" value="'.$row['blogPost'].'"></td></tr>';
    echo '<tr><td><input type="submit" value="Update">';
    echo '</form></td></tr>';
/*    echo '<tr><td><form method="POST" action="blogDelete.php">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<input type="submit" value="Delete">';
    echo '</form></td></tr>';
*/    
    echo '</table>';
   
   

  }


?>
</div>

<div id ="page_navigation">
</div>

</div>



<br><br><br>
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