/*$(document).ready(function(){
	$.get('_Controller/autocompleteFill.php', function(data) {
	  alert(data);
	});
});*/


$(function() {
	var test = ["TEST"];
        $( "#search" ).autocomplete({
			source: function(request, response){
				$.ajax({
                    url: "_Controller/autocompleteFill.php?term="+(request.term),
                    dataType: "json",
                    success: function( data ) {
                        response(data);}
				});	
		}
    });
});
