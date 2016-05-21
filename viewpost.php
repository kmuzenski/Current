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

<?php
try{
       Database::connect();
      $sql = 'SELECT * FROM blog WHERE id = :id';
      $q = $pdo->prepare($sql);
      $q->execute(array(':id' => $_GET['id']));


      $data = $q->fetch();
      print_r($data);
      Database::disconnect();
     // return $data;
      } catch (PDOException $error){

     // header( "Location: 500.php" );
      echo $error->getMessage();
    }
?>

<?php require_once('footer.php');

?>

</body>
</html>