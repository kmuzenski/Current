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
$search = $_POST['search'];
$pdo = Database::connect();

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//$search = $_POST['search'];
$query = $pdo->prepare("SELECT * FROM blog WHERE blogTitle LIKE '%$search%' LIMIT 0, 10 ORDER BY postDATE DESC");
$query->bindValue(':search', '%' . $search . '%');
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row) {


	echo "<p>" . $row['blogTitle'] . "</p>";
	echo "<p>" . $row['blogPost'] . "</p><br>";

}


Database::disconnect();

?>

<?php require_once('footer.php');?>

</body>
</html>