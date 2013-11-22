
$(document).ready(function() {

	$(".gallery-list").click(function() {
		window.location = $(this).find("a").eq(0).attr('href');
	});

	$(".gallery-list").hover(function() {
		$(this).css({'cursor':'pointer'});
	},function(){
	// Ici, annuler les modifications CSS du survol.
	// Le curseur reprend sa forme automatiquement
	});  

	$(".gallery-list").click(function() {
		var idLong = $(this).children(".affichage").attr('id');
		var idCourt = idLong.substring(7);
		$.ajax({
			type: "POST",
			url: "index.php?section=ajax_image",
			data: { id: idCourt },
			dataType: "html",
			success: function(data) {
				$( ".testAjax" ).html(data);
			}
		})
		/*.done(function(data) {
			$( ".testAjax" ).load(data);
		});*/
		/* .done(function( data ) {
			alert( "Data Loaded: " + data );
		});*/
	});
}); 
/*
		$.post( "app/modele/test2.php", { id:1 }, function( data ) {
			var nom = $(data).find("_nom");
			console.log(nom);
			$('#display').html(nom);
		}, "json");*/