<?php require_once('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>
 
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>

	<div id="nyt" class="col-xs-6">
	

	</div>

	



<?php require_once('footer.php'); ?>
<script>
function nyt() {
var $_POST = <?php echo json_encode($_POST) ?>;
//document.write($_POST["searchTerm"]);	
	$.ajax({
		url: "https://api.nytimes.com/svc/search/v2/articlesearch.json?q=" + $_POST["searchTerm"] +"&api-key=33b85401cda2437c829b4679e0cd3d35",
		method: 'POST',
		crossDomain: true,

		success: function(r) {
			console.log(r);



			$.each(r.response.docs, function(key, value){
			$("#nyt").append('<table class="table table-striped table-bordered"><tr><td><h4><strong>' + value.headline.main + '</strong></h4></td></tr><tr><td>'  + value.snippet + '</td></tr><tr><td><a href="' + value.web_url + '"target="_blank">View Article</a></td></tr></table>');
				
		
			});
			
		
}
})	
}


nyt();
</script>

</body>
</html>