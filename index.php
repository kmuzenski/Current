<?php require_once('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>
 
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>
<div class="container">
	<div class="row">
<h1>Current<img src="assets/images/wave.png" alt="logo" title="logo" width="100px"></h1>
<br>
<p>Search for the news stories you want to see</p>
<br><br>
</div>
</div>	

	<form action="newsSearch.php" method="POST">
	<input type="text" name="searchTerm" placeholder="Search News">
	<input type="submit" value="submit">
	</form>

	<br><br><br><br><br><br>

<div class="container">
<div class="row">
	<div id="app" class="col-xs-6">
	<form action="searchGuard.php" method="POST">
	<input type="text" name="searchTerm" placeholder="Search The Guardian">
	<input type="submit" value="submit">
	</form>

	</div>

	
	<div id="nyt" class="col-xs-6">
	<form action="nytSearch.php" method="POST">
	<input type="text" name="searchTerm" placeholder="Search The New York Times">
	<input type="submit" value="submit">
	</form>
	</div>

</div>
</div>
<?php require_once('footer.php'); ?>

</body>
</html>