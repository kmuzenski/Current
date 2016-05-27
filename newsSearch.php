<?php require_once('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>
 
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>
<h1>News Search Results</h1>
<div class="container">
	<div class="row">

	<div id="nytSearch" class="col-xs-6">
	

	</div>

	<div id="guardSearch" class="col-xs-6">
	

	</div>

</div>
</div>

<?php require_once('footer.php'); ?>
<script>

function request() {
var $_POST = <?php echo json_encode($_POST) ?>;
//document.write($_POST["searchTerm"]);	
	return $.ajax({
		type:'GET',
		dataType:'jsonp',
		cache: false,


	
		url: "http://content.guardianapis.com/search?q=" + $_POST["searchTerm"] + "&order-by=newest&api-key=af3824b3-0cbb-482c-9d7a-0df1cca0f3d0",
		success: function(r) {
			console.log(r);



			$.each(r.response.results, function(key, value){
				$("#guardSearch").append('<table class="table table-striped table-bordered"><tr><td><h4><strong>' + value.webTitle + '</strong></h4></td></tr><tr><td>' + value.sectionId + '</td></tr><tr><td><a href="' + value.webUrl + '"target="_blank">View Article</a></td></tr></table>');
				


				
			});


			
		
}
})	
}
request();
</script>
<script>
function nytSearch() {
var $_POST = <?php echo json_encode($_POST) ?>;

 return	$.ajax({
		method:'GET',
		dataType:'json',
		
		//crossDomain: true,
		url: "https://api.nytimes.com/svc/search/v2/articlesearch.json?q="+ $_POST["searchTerm"] +"&api-key=33b85401cda2437c829b4679e0cd3d35",
		

		success: function(result) {
		
			
			$.each(result.response.docs, function(key, value){
				console.log(result);

			$("#nytSearch").append('<table class="table table-striped table-bordered"><tr><td><h4><strong>' + value.headline.main + '</strong></h4></td></tr><tr><td>'  + value.snippet + '</td></tr><tr><td><a href="' + value.web_url + '"target="_blank">View Article</a></td></tr></table>');
				
		
			});
					
}
})	
}

nytSearch();
</script>

</body>
</html>