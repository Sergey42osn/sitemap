jQuery(document).ready(function($) {

		$( "form" ).submit(function( event ) {
		  	//alert( "Handler for .submit() called." );
		  	event.preventDefault();

		  	var form = $(this);

		  	var input = $("#domain");

		  	var val = input[0].value;

			var val_lenght = input[0].value.length;

			if (val_lenght < 11) {
				alert("Неправильно введен адрес");
			}else{

				$.ajax({
				  method: "GET",
				  url: form[0].action,
				  data: {val:val}
				})
				  .done(function( msg ) {
				   	console.log( msg );


				  });

			}


		});
});