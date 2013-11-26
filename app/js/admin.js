
$(document).ready(function() {

	// $(".gallery-list").children(".gallery-suppr-button").css('display', 'none');

/*	$(".gallery-list").click(function() {
		window.location = $(this).find("a").eq(0).attr('href');
	});*/

/*	$(document).on("click", ".gallery-list", function(event) {
		$('.gallery-active').removeClass('gallery-active').addClass('gallery-list');
		$('.gallery-list').removeClass('gallery-list').addClass('gallery-active');
		console.log($(this));
	});*/

	$(document).on("mouseenter", ".gallery-list", function() {
		$(this).css({'cursor':'pointer'});
		$(this).children(".gallery-suppr-button").css('display', 'inline-block');
	});

	$(document).on("mouseleave", ".gallery-list", function() {
		$(this).children(".gallery-suppr-button").css('display', 'none');
	});

/*	,function(){
		$(this).children(".gallery-suppr-button").css('display', 'none');
	});  */

	$(document).on("click", ".gallery-list", function() {
		/*console.log($(this));*/
		$('.gallery-active').removeClass('gallery-active').addClass('gallery-list').children(".gallery-suppr-button").css('display', 'none');
		$(this).removeClass('gallery-list').addClass('gallery-active');
		var idLong = $(this).children(".affichage").attr('id');
		var idCourt = idLong.substring(7);
		$.ajax({
			type: "POST",
			url: "index.php?section=admin_ajax_image",
			data: { id: idCourt },
			dataType: "html",
			success: function(data) {
				$( ".conteneur-images" ).html(data);
			}
		})
	});

	$(document).on("click", ".gallery-suppr-button", function() {
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
							$(".conteneur-images").html("Galerie supprimée");
						}
					})
				},
				"Annuler": function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});

	$(document).on("click", ".gallery-delete-button", function() {
		var idLong = $(this).attr('id');
		var idCourt = idLong.substring(14);
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
							$(".conteneur-images").html("Galerie supprimée");
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
