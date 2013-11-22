
$(document).ready(function() {

	$(".gallery-list").children(".gallery-suppr-button").css('display', 'none');

	$(".gallery-list").click(function() {
		window.location = $(this).find("a").eq(0).attr('href');
	});

	$(".gallery-list").hover(function() {
		$(this).css({'cursor':'pointer'});
		$(this).children(".gallery-suppr-button").css('display', 'inline-block');
	},function(){
		$(this).children(".gallery-suppr-button").css('display', 'none');
	});  

	$(".gallery-list").on(function() {
		$('.gallery-active').removeClass('gallery-active').addClass('gallery-list');
		$(this).removeClass('gallery-list').addClass('gallery-active');
		var idLong = $(this).children(".affichage").attr('id');
		var idCourt = idLong.substring(7);
		$.ajax({
			type: "POST",
			url: "index.php?section=ajax_image",
			data: { id: idCourt },
			dataType: "html",
			success: function(data) {
				$( ".conteneur-images" ).html(data);
			}
		})
	});

	$(".gallery-suppr-button").click(function() {
		var idLong = $(this).siblings(".affichage").attr('id');
		var idCourt = idLong.substring(7);
	 	$("#dialog-confirm").css("display", "block")
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:300,
			width: 300,
			modal: true,
			buttons: {
				"Confirmer": function() {
					$( this ).dialog( "close" );
					$.ajax({
						type: "POST",
						url: "index.php?section=delete_gallery",
						data: { id: idCourt },
						dataType: "html",
						success: function(data) {
							$(".gallery-body").html(data);
						}
					})
				},
				"Annuler": function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
}); 