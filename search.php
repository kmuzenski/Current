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
$query = $pdo->prepare("SELECT * FROM blog WHERE blogTitle LIKE '%$search%' ORDER BY postDATE DESC");
$query->bindValue(':search', '%' . $search . '%');
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row) {

	echo '<table class="table table-striped table-bordered">';
	echo '<tr><td><p>' . $row['blogTitle'] . '</p></td></tr>';
	echo '<tr><td><p>' . $row['blogPost'] . '</p><br></td></tr>';
	echo '</table>';

}


Database::disconnect();

?>

<?php require_once('footer.php');?>

</body>
</html>