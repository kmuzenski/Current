<?php require_once('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>
 
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>

	<div id="guardSearch" class="col-xs-6">
	

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

</body>
</html>