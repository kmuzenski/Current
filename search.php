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

$pdo = Database::connect();

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$search = $_POST['search'];
$query = $pdo->prepare("SELECT * FROM blog WHERE blogTitle LIKE '%$search%' LIMIT 0, 10");
$query->bindValue(1, "%$search%", PDO::PARAM_STR);
$query->execute();

if ($query > 0){
	echo "<p>Search Results</p>";
	echo "<p>" . $query['blogTitle'] . "</p>";

}
else {
	echo 'No Results Match Search';
}

Database::disconnect();

?>

<?php require_once('footer.php');?>

</body>
</html>