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
<h1>story page </h1>
<?php
try{
      
      $sql = 'SELECT * FROM blog WHERE id = :id';
      $q = $pdo->prepare($sql);
      $q->execute(array(':id' => $_GET['id']));
      $data = $q->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {  
    echo '<table class="table table-striped table-bordered">';
    echo '<p>Date Posted:<br>'.$row['postDate'].'</p><br>';
    echo '<p>Blog Title:<br>'.$row['blogTitle'].'</p><br>';
    echo '<p>Blog Post:<br>'.$row['blogPost'].'</p><br><br><br>';
    echo '</table>';
}
      return $data;
      } catch (PDOException $error){

      header( "Location: 500.php" );
      //echo $error->getMessage();
    }
?>

<?php require_once('footer.php');
 Database::disconnect();
  ?>

</body>
</html>