function request() {	
	return $.ajax({
		type:'GET',
		dataType:'jsonp',
		cache: false,


	
		url: "http://content.guardianapis.com/tags?q=apple&section=technology&show-references=all&api-key=af3824b3-0cbb-482c-9d7a-0df1cca0f3d0",
		success: function(r) {
			console.log(r);

			$.each(r.response.results, function(key, value){
				$("#app").append('<div class=col-md-4><p>' + value.sectionName + '<br>' + value.webTitle + '<br>' + value.webUrl + '<br></p></div>');
				



				
			});


			
		
}
})	
}


request();