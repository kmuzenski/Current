function request() {	
	return $.ajax({
		type:'GET',
		dataType:'jsonp',
		cache: false,


	
		url: "http://content.guardianapis.com/search?q=us-news&order-by=newest&api-key=af3824b3-0cbb-482c-9d7a-0df1cca0f3d0",
		success: function(r) {
			console.log(r);



			$.each(r.response.results, function(key, value){
				$("#app").append('<table class="table table-striped table-bordered"><tr><td><h4><strong>' + value.webTitle + '</strong></h4></td></tr><tr><td>' + value.sectionId + '</td></tr><tr><td><a href="' + value.webUrl + '"target="_blank">View Article</a></td></tr></table>');
				



				
			});


			
		
}
})	
}

function nyt() {
 return	$.ajax({
		method:'GET',
		dataType:'json',
		
		//crossDomain: true,
		url: "https://api.nytimes.com/svc/search/v2/articlesearch.json?sort=newest&api-key=33b85401cda2437c829b4679e0cd3d35",
		

		success: function(result) {
		
			
			$.each(result.response.docs, function(key, value){
				console.log(result);

			$("#nyt").append('<table class="table table-striped table-bordered"><tr><td><h4><strong>' + value.headline.main + '</strong></h4></td></tr><tr><td>'  + value.snippet + '</td></tr><tr><td><a href="' + value.web_url + '"target="_blank">View Article</a></td></tr></table>');
				
		
			});
					
}
})	
}



request();
nyt();

