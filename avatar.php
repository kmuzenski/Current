<?php
  require_once('database.php');
	require_once('session.php');
	require_once('crud.php');

	if ( !empty($_POST)) {
      // keep track post values
    $type = $_POST['type'];
    $avi = $_POST['avi'];
    $size = $_POST['size'];
    $user_FK = $_POST['user_FK'];
   
   
    $aviCreate = new aviCrud();
    $_SESSION['uid'] = $aviCreate->create($type,$avi,$size,$user_FK); 
   

  header('Location: index.php');
    }
  

?>


<!DOCTYPE html>
<html>



<body>


<br><br><br><br><br><br>

    <div class="container">

                <div class="span10 offset1">
                    <div class="row">
                        <h3>Upload Avatar</h3>
                    </div>


     <form class="form-horizontal" action="avatar.php" method="post" enctype="multipart/form-data">

        <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
<label class="control-label">type</label>
         <div class="controls">
 <input name="type" type="text"  placeholder="type" value="<?php echo !empty($type)?$type:'';?>">

          <?php if (!empty($typeError)): ?>
          <span class="help-inline"><?php echo $typeError;?></span>
          <?php endif; ?>
          </div>
          </div>




        <div class="control-group <?php echo !empty($aviError)?'error':'';?>">
        <label class="control-label">Avatar</label>
        <div class="controls">
       <input name="avatar" type="file" placeholder="avatar" value="<?php echo !empty($avi)?$avi:'';?>">

       <?php if (!empty($aviError)): ?>
        <span class="help-inline"><?php echo $aviError;?></span>
        <?php endif;?>
       </div>
       </div>



  <div class="control-group <?php echo !empty($sizeError)?'error':'';?>">
        <label class="control-label">image size</label>
        <div class="controls">
       <input name="size" type="text" placeholder="size" value="<?php echo !empty($size)?$size:'';?>">

       <?php if (!empty($sizeError)): ?>
        <span class="help-inline"><?php echo $sizeError;?></span>
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
      <button type="submit" class="btn btn-success" name="btn-upload">Create</button>
     
       </div>
       </form>

         </div>
         </div> <!-- /container -->
<br><br><br><br><br><br>

<br><br><br>


 </body>
</html>
