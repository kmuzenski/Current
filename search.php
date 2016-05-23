<?php
require_once('database.php');
require_once('session.php');
?>
<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>
 
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>

<h1>search results</h1>
 
 
<?php
$search = $_POST['user_search'];

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM `blog` WHERE `blog`.`blogTitle` LIKE :search OR `blog`.`blogPost` LIKE :search";
$q = $pdo->prepare($sql);
$q->bindValue(':search', '%' . $search . '%');
$q->execute();
$results = $q->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row) {
	echo '<p>' . $row['blogTitle'] . '<br>';
	echo $row['blogPost'] . '</p>';
}

Database::disconnect();

?>

<?php require_once('footer.php');?>

</body>
</html>