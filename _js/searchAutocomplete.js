/*
searchAutocomplete.js
--------------------------------------------------------------------------------
This file is the script that enables the autocomplete capabilities of the 
search bar on the home page.  It gets suggestions from the database and then
feeds them into the autocomplete jquery ui function.  
*/
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
