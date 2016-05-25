<?php require_once('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>
 
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>
<div class="container">
<div class="row">
	<div id="app" class="col-xs-6">
	<form action="searchGaurd.php" method="POST">
	<input type="text" name="searchTerm">
	<input type="submit" value="submit">
	</form>

	</div>

	
	<div id="nyt" class="col-xs-6">
	<form action="nytSearch.php" method="POST">
	<input type="text" name="searchTerm">
	<input type="submit" value="submit">
	</form>
	</div>

</div>
</div>
<?php require_once('footer.php'); ?>

</body>
</html>