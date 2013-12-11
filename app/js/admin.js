
$(document).ready(function() {

	/***************  INDEX  *****************/

	$(document).on("mouseenter", ".gallery-list", function() {
		$(this).css({'cursor':'pointer'});
		$(this).children(".gallery-suppr-button").css('display', 'inline-block');
	});

	$(document).on("mouseleave", ".gallery-list", function() {
		$(this).children(".gallery-suppr-button").css('display', 'none');
	});

	$(document).on("click", ".gallery-list", function() {
		/*console.log($(this));*/
		$('.gallery-active').removeClass('gallery-active').addClass('gallery-list').children(".gallery-suppr-button").css('display', 'none');
		$(".picture-options").css("display", "none");
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
				$(".conteneur-images").children("ul").sortable({ 
					opacity: '0.7',
					containment: "parent",
					cursor: "move",
					update: function() {
						newOrder = $(this).sortable("serialize");
						$.ajax({
							url: "index.php?section=reposition_image",
							type: "POST",
							data: newOrder,
						});
					}
				});
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
							$(".conteneur-images").html("Aucune galerie sélectionnée");
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
							$(".conteneur-images").html("Aucune galerie sélectionnée");
						}
					})
				},
				"Annuler": function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});	

	$(document).on("click", ".picture-div", function() {
		var idLong = $(this).children("img").attr('id');
		var idCourt = idLong.substring(6);
		var lien = "index.php?section=edit_image&id=" + idCourt;
		console.log(lien);
		if(! $(this).hasClass("picture-selected")) {
			$(".picture-div").removeClass("picture-selected");
			$(this).addClass("picture-selected");
			$(".picture-options").css("display", "block");
			$(".edit-picture-button").children("a").attr("href", lien);
		} else {
			$(this).removeClass("picture-selected");
			$(".picture-options").css("display", "none");
		}
	}); 

	$(document).on("click", ".picture-options", function() {

	})

	/***************  NOUVELLE IMAGE  *****************/

	$(document).on("click", ".upload-image-new-category", function() {
		var display = $(".new-category").css("display");
		if (display == "none") {
			$(".new-category").css("display", "block");
		} else {
			$(".new-category").css("display", "none");
		};
		
	});

	$(document).on("click", "#categorySubmit", function(event) {
		event.preventDefault();
		var category = $("#categoryName").val();
		console.log(category);
		$.ajax({
			type: "POST",
			url: "index.php?section=create_category",
			data: {name: category},
			dataType: "html",
			success: function(data) {
				$(".new-category").css("display", "none");
				$(".list-categories").html(data);
			}
		})
	});

}); 
