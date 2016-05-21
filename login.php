<?php
require_once('database.php');
require_once('crud.php');
require_once('session.php');

	if(!empty($_POST['username']) && isset ($_POST['username'])) {
		if(!empty($_POST['password']) && isset($_POST['password'])) {




	// Define $username and $password
	$username=$_POST['username'];
	$password=$_POST['password'];

	  $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM user WHERE username = ? AND password = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($username,$password));
	$query = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();


	$username = $query['username'];
	
	$uid = $query['id'];

	$_SESSION['username'] = $username;
	$_SESSION['uid'] = $uid;

	header('Location: index.php');
	
}

}	

