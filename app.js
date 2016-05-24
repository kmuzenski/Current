function request() {	
	return $.ajax({
		type:'GET',
		dataType:'jsonp',
		cache: false,


	
		url: "http://content.guardianapis.com/search?q=us-news&order-by=newest&api-key=af3824b3-0cbb-482c-9d7a-0df1cca0f3d0",
		success: function(r) {
			console.log(r);



			$.each(r.response.results, function(key, value){
				$("#app").append('<div class="col-md-4"><table><tr><td><h4><strong>' + value.webTitle + '</strong></h4></td></tr><tr><td>' + value.sectionId + '</td></tr><tr><td><a href="' + value.webUrl + '"target="_blank">View Article</a></td></tr></table></div>');
				



				
			});


			
		
}
})	
}

function nyt () {
	var url ="https://api.nytimes.com/svc/search/v2/articlesearch.json";
	url += '?' + $.param({
	'api-key': "33b85401cda2437c829b4679e0cd3d35"
	});

	$.ajax({
		url: url,
		method: 'GET',
	}).done(function(result) {
		$.each(result.response.docs, function(key, value){ 
		$("#nyt").append('<div class="col-md-4"><table><tr><td><h4><strong>' + value.headline.main + '</strong></h4></td></tr><tr><td>'  + value.snippet + '</td></tr><tr><td><a href="' + value.web_url + '"target="_blank">View Article</a></td></tr></table></div>');

	
		console.log(result);
	});
	}).fail(function(err){
		throw err;
	});
}


request();
nyt();

