<?php
  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');

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



<body>


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

<br><br><br>


 </body>
</html>
