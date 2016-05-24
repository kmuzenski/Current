function request() {	
	return $.ajax({
		type:'GET',
		dataType:'jsonp',
		cache: false,


	
		url: "http://content.guardianapis.com/search?q=us-news&order-by=newest&api-key=af3824b3-0cbb-482c-9d7a-0df1cca0f3d0",
		success: function(r) {
			console.log(r);



			$.each(r.response.results, function(key, value){
				$("#app").append('<div class="col-md-4"><center><table><tr><td>' + value.sectionName + '</td></tr><tr><td>' + value.webTitle + '</tr></td><tr><td><a href="' + value.webUrl + '">View Article</a></tr></td></table></center></div>');
				



				
			});


			
		
}
})	
}


request();