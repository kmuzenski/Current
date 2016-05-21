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

<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>


    <div class="container">

                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Blog Post</h3>
                    </div>


     <form class="form-horizontal" action="blog.php" method="post">

        <div class="control-group <?php echo !empty($blogTitleError)?'error':'';?>">
<label class="control-label">Blog Title</label>
         <div class="controls">
 <input name="blogTitle" type="text"  placeholder="blogTitle" value="<?php echo !empty($blogTitle)?$blogTitle:'';?>">

          <?php if (!empty($blogTitleError)): ?>
          <span class="help-inline"><?php echo $blogTitleError;?></span>
          <?php endif; ?>
          </div>
          </div>




        <div class="control-group <?php echo !empty($blogPostError)?'error':'';?>">
        <label class="control-label">Blog Post</label>
        <div class="controls">
       <input name="blogPost" type="text" placeholder="blogPost" value="<?php echo !empty($blogPost)?$blogPost:'';?>">

       <?php if (!empty($blogPostError)): ?>
        <span class="help-inline"><?php echo $blogPostError;?></span>
        <?php endif;?>
       </div>
       </div>



  <br><br><br>
		
		<?php
            try {
              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "SELECT `user`.`id`, `user`.`username` FROM `user`";
              $user = $pdo->query($sql);
              echo "<select name='user_FK'>";
              foreach ($user as $row) {
                echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
              }
              echo "</select>";
	//	Database::disconnect();
            } catch (PDOException $e) {
              echo $e->getMessage();
             Database::disconnect(); 
            }
          ?>
	<br><br><br>

      
  	  <div class="form-actions">
      <button type="submit" class="btn btn-success">Create</button>
      
       </div>
       </form>

         </div>
         </div> <!-- /container -->
<br><br><br><br><br><br>

 <div class="row">
 	<center>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>blog title</th>
            <th>blog post</th>
            <th>user_FK</th>
            <th>Action</th>
          
          </tr>
        </thead>
        <tbody>
          <?php
               $blog = new blogCrud($_SESSION['uid']);
                
 		foreach ($blog->read() as $row) {
		echo '<tr>';
                echo '<form method="POST" action="updateBlog.php">';
                echo '<input type="hidden" name="id" value="'.$row['id'].'">';
                echo '<td><input type="text" name="blogTitle" value="'.$row['blogTitle'].'"></td>'; 
                echo '<td><input type="text" name="blogPost" value="'.$row['blogPost'].'"></td>';
                echo '<td><input type="text" name="user_FK" value="'.$row['user_FK'].'"></td>';
                echo '<br><br>';
                echo '<td><input type="submit" value="Update">';
                echo '</form>';
                echo '<form method="POST" action="blogDelete.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<input type="submit" value="Delete"></td>';

                echo '</form>';
                echo '</tr>';
             }
		?>
        </tbody>
      </table>
  </center>
    </div>
</div>

<br><br><br>
<?php require_once('footer.php'); 
Database::disconnect();?>

 </body>
</html>