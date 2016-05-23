<?php
require_once('database.php');
  require_once('session.php');
 
 

$key = $_GET['key'];
$array = array();
$pdo = Database::connect();
$sql = "SELECT * FROM blog WHERE blogTitle LIKE '%{$key}%'";
while ($row = mysql_fetch_assoc($sql)) {
	$array[] = $row['title'];
}

echo json_encode($array);

?>
