<?php 
require_once('session.php');
require_once('database.php');
require_once('crud.php'); 

?>

<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>
 
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>

<h1>story page </h1>
<div class="container">
  <div class="row">
    <div class="col-md-12">
<?php
try{
      $pdo = Database::connect();
      $sql = 'SELECT * FROM blog WHERE id = :id';
      $q = $pdo->prepare($sql);
      $q->execute(array(':id' => $_GET['id']));

      $data = $q->fetch();
     // print_r($data);

  echo '<table class="table table-striped table-bordered">';
  echo '<tr><td><p>Date Posted:<br>'.$data['postDate'].'</p><br></td></tr>';
  echo '<tr><td><p>Blog Title:<br>'.$data['blogTitle'].'</a></p><br></td></tr>';
  echo '<tr><td><p>Blog Post:<br>'.$data['blogPost'].'</p><br><br><br></td></tr>';
  echo '</table>';


      Database::disconnect();
     // return $data;
      } catch (PDOException $error){
      echo $error->getMessage();
    }
?>

<?php require_once('footer.php');

?>
</div>
</div>
</div>
</body>
</html>