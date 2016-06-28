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
<br>
<input type="text" id="search" placeholder="search terms">
<input type="submit" value="search" id="getnews">
</div>

<div class="row">
<div class="col-xs-12">
<div id="result">
</div>
</div>

</div>

	
	<br><br><br><br><br><br>


<br><br><br><br><br><br>
<?php require_once('footer.php'); ?>

<script>
$(document).ready(function(){
	var searchResults = [];

	function aggregate(){
		console.log(searchResults);
		$.each(searchResults, function(key, value) {
		$("#result").append('<table class="table table-striped table-bordered">');
		$("#result").append('<tr><td><h4>' + searchResults[0].title + '</h4></td></tr>');
		$("#result").append('<tr><td><p>' + value.searchResults[0].desc + '</p></td></tr>');
		$("#result").append('<tr><td><a href="' + value.searchResults[0].url + '" target="_blank">Read</a></td></tr>');
		$("#result").append('<tr><td><h4>' + searchResults[10].title + '</h4></td></tr>');
		$("#result").append('<tr><td><p>' + value.searchResults[10].desc + '</p></td></tr>');
		$("#result").append('<tr><td><a href="' + value.searchResults[10].url + '" target="_blank">Read</a></td></tr>');
		$("#result").append('<tr><td><h4>' + searchResults[2].title + '</h4></td></tr>');
		$("#result").append('<tr><td><p>' + value.searchResults[2].desc + '</p></td></tr>');
		$("#result").append('<tr><td><a href="' + value.searchResults[2].url + '" target="_blank">Read</a></td></tr>');
		$("#result").append('<tr><td><h4>' + searchResults[11].title + '</h4></td></tr>');
		$("#result").append('<tr><td><p>' + value.searchResults[11].desc + '</p></td></tr>');
		$("#result").append('<tr><td><a href="' + value.searchResults[11].url + '" target="_blank">Read</a></td></tr>');
		$("#result").append('<tr><td><h4>' + searchResults[3].title + '</h4></td></tr>');
		$("#result").append('<tr><td><p>' + value.searchResults[3].desc + '</p></td></tr>');
		$("#result").append('<tr><td><a href="' + value.searchResults[3].url + '" target="_blank">Read</a></td></tr>');
		$("#result").append('<tr><td><h4>' + searchResults[12].title + '</h4></td></tr>');
		$("#result").append('<tr><td><p>' + value.searchResults[12].desc + '</p></td></tr>');
		$("#result").append('<tr><td><a href="' + value.searchResults[12].url + '" target="_blank">Read</a></td></tr>');
		$("#result").append('</table>');

		});
	
	}


	$("#getnews").on("click", function(){

		var nyt = false;
		var guard = false;

		var searchTerms = $("#search").val();

		

		
		$.ajax({
			type:'GET',
			dataType:'jsonp',
			cache: false,
			url: "http://content.guardianapis.com/search?q=" + searchTerms + "&order-by=newest&api-key=af3824b3-0cbb-482c-9d7a-0df1cca0f3d0",
			success: function(r) {
				$.each(r.response.results, function(key, value){
					var res = {
						title: value.webTitle,
						desc: value.sectionId,
						url: value.webUrl,
						date: "date",
						source: "The Guardian"
					};
					searchResults.push(res);
				});
				guard = true;
				if(guard && nyt){
					aggregate();
				}
			}
		});	

		$.ajax({
			type:'GET',
			dataType:'json',
			cache: false,
			url: "https://api.nytimes.com/svc/search/v2/articlesearch.json?q="+ searchTerms +"&api-key=33b85401cda2437c829b4679e0cd3d35",
			success: function(result) {
				$.each(result.response.docs, function(key, value){
					var res = {
						title: value.headline.main,
						desc: value.snippet,
						url: value.web_url,
						date: "date",
						source: "New York Times"
					};
					searchResults.push(res);
				});
				nyt = true;

				//checks if both have been fuffilled then displays 
				if(guard && nyt){
					aggregate();
				}
			}
		});	


	});
});

</script>
 

</body>
</html>