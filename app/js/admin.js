
$(document).ready(function() {

	/***************  INDEX  *****************/

/** Gestion partie filtre par catégorie **/
	$(".cat-filters").each(function() {
	  $.data(this, "realHeight", $(this).height());
	}).css({ display: "none" });

	$(document).on("click", "#filter-cat-btn", function(){
		var div = $(this).parents(".cat-filters");
		$(".cat-filters").toggle(function() {
		  div.animate({ height: div.data("realHeight") }, 600);
		}, function() {
		  div.animate({ height: 0 }, 600);
		});
	});


/** Gestion partie nouvelle catégorie **/
	$(".new-cat").each(function() {
	  $.data(this, "realHeight", $(this).height());
	}).css({ display: "none" });

	$(document).on("click", "#new-cat-btn", function(){
		var div = $(this).parents(".new-cat");
		$(".new-cat").toggle(function() {
		  div.animate({ height: div.data("realHeight") }, 600);
		}, function() {
		  div.animate({ height: 0 }, 600);
		});
	});


/** Affichage images par gallery + sortable **/
	$(document).on("click", ".gal-vign-container", function() {
		// TODO classes à revoir
		$('.gallery-active').removeClass('gallery-active').addClass('gallery-list').children(".gallery-suppr-button").css('display', 'none');
		$(".picture-options").css("display", "none");
		$(this).removeClass('gallery-list').addClass('gallery-active');
		var idLong = $(this).attr('id');
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



	$(document).on("click", ".gal-suppr-btn", function() {
		var idLong = $(this).parents(".gal-vign-container").attr('id');
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

	$(document).on("click", ".gal-edit-btn", function() {
		console.log($(this).parent());
		var idLong = $(this).parents(".gal-vign-container").attr('id');
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

	/***************  AFFICHAGE INFO IMAGE  *****************/

	$(document).on("click", ".picture-div", function(event) {
		event.preventDefault();
		var idLong = $(this).children("img").attr('id');
		var idCourt = idLong.substring(6);
		var lien = "index.php?section=edit_image&id=" + idCourt;
		console.log(lien);
		show_modal( lien, 'modal_info_pic');
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

	var show_modal = function(path, element, params) {
	  // $('#'+element+' .loading_content').show();
	  $('#'+element+' .ajax_content').html('');
	  // $('#'+element+' img.loader').hide();
	  $('#'+element+'').modal();
	  $.ajax({
	    url: path,
	    data: params,
	    type: "get",
	    dataType: "html",
	    success: function(html) {
	      $('#'+element+' .ajax_content').html(html);
	    },
	    error: function(){
	      $('#'+element+' .ajax_content').html("<p class='alert alert-error'>Une erreur est survenue.</p>");
	    },
	    complete: function(){
	      $('#'+element+' .loading_content').hide();
	    }
	  });
	}

	

	/***************  NOUVELLE IMAGE  *****************/

	$(document).on("click", ".upload-image-new-category", function() {
		var display = $(".new-category").css("display");
		if (display == "none") {
			$(".new-category").css("display", "block");
		} else {
			$(".new-category").css("display", "none");
		};
		
	});


	/***************  NOUVELLE CATEGORIE  *****************/

	$(document).on("click", "#categorySubmit", function(event) {
		event.preventDefault();
		var category = $("#categoryName").val();
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

/* dans l'entete image */
	$(document).on("click", "#new-cat-submit", function(event) {
		event.preventDefault();
		var categoryInput = $(this).parent().find('input');
		$.ajax({
			type: "POST",
			url: "index.php?section=create_category_from_header",
			data: {name: categoryInput.val()},
			dataType: "html",
			success: function(data) {
				$(".picture-header-option-part").html(data);
				categoryInput.val("");
			}
		})
	});



	



}); 
