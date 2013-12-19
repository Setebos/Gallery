
$(document).ready(function() {

	$.fn.sorting = function() {
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
		return this;
	};

	//Initialisation du tri des images


	$(document).sorting();
	

	/***************  INDEX  *****************/

/** Gestion partie galleries options **/
	$(".display-gal-opt").each(function() {
	  $.data(this, "realHeight", $(this).height());
	}).css({ display: "none" });

	$(document).on("click", "#display-options", function(){
		var div = $(this).parents(".display-gal-opt");
		$(".display-gal-opt").toggle(function() {
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
				$( ".picture-part" ).html(data);
				$(".new-cat").css({ display: "none" });
				$(this).sorting();
			}
		})
	});


/** Suppression galerie **/
	$(document).on("click", ".gal-suppr-btn", function() {
		var idLong = $(this).parents(".gal-vign-container").attr('id');
		var idCourt = idLong.substring(7);
	 	$("#dialog-confirm").css("display", "block");
		$("#dialog-confirm").dialog({
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

	/* Edition de galerie */
	$(document).on("click", ".gal-edit-btn", function() {
		console.log($(this).parent());
		var idLong = $(this).parents(".gal-vign-container").attr('id');
		var idCourt = idLong.substring(7);
	 	$("#dialog-confirm").css("display", "block");
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
					// $( this ).dialog( "close" );
				}
			}
		});
	});

	// Obsolète
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
		show_modal( lien, 'modal_info_pic');
		// if(! $(this).hasClass("picture-selected")) {
		// 	$(".picture-div").removeClass("picture-selected");
		// 	$(this).addClass("picture-selected");
		// 	$(".picture-options").css("display", "block");
		// 	$(".edit-picture-button").children("a").attr("href", lien);
		// } else {
		// 	$(this).removeClass("picture-selected");
		// 	$(".picture-options").css("display", "none");
		// }
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
		var newCatBlock = $(".new-category");
		var display = newCatBlock.css("display");
		if (display == "none") {
			newCatBlock.css("display", "block");
			newCatBlock.find('input').focus();
		} else {
			newCatBlock.css("display", "none");
		};
		
	});


	/***************  NOUVELLE CATEGORIE  *****************/

/* dans page nouvelle image et dans modal edit image */
	$(document).on("click", ".categorySubmit", function(event) {
		event.preventDefault();
		var category = $(this).parent().find('.categoryName');
		var id = $(this).parent().find('.imageId');
		$.ajax({
			type: "POST",
			url: "index.php?section=create_category",
			data: {id: id.val(), name: category.val()},
			dataType: "html",
			success: function(data) {
				$(".new-category").css("display", "none");
				$(".list-categories").html(data);
				category.val("");
			},
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

	/***************  SUPPRESSION IMAGE  *****************/

$("#modal_info_pic").on("click", ".btn-del-img", function(event) {
	event.preventDefault();
})


$("#modal_info_pic").on("click", ".del-img-confirm", function(event) {
	event.preventDefault();
	var idLong = $(".btn-del-img").attr('id');
	var idCourt = idLong.substring(8);
	$.ajax({
		type: "POST",
		url: "index.php?section=delete_image",
		data: { id: idCourt },
		dataType: "html",
		success: function(data) {
			$(".conteneur-images").html(data);
			$("#modal_info_pic").modal('hide');
			$(document).sorting();
		},
		error: function() {
		}
	})
})


/***************  MODIFICATION OPTIONS GALERIES *****************/

$(document).on("click", "#gal-options-submit", function(event) {
		event.preventDefault();
	  // var div = $(this).parents(".display-gal-opt");
		
		$.ajax({
			type: "POST",
			url: "index.php?section=update_option",
			data: {
				show_entire_gallery: $(".displayGallery:checked").val(),
				diaporama_width: $('#diaporamaWidth').val(),
				nb_images_per_line: $('#nbImagesPerLine').val(),
				display_duration: $('#displayDuration').val()
				},
			dataType: "html",
			success: function(data) {
				$("#display-gal-opt-msg").html("<div class='alert alert-success'>Vos options ont bien été mises à jour</div>");
				setTimeout(function () {
			    $("#display-gal-opt-msg").html("");
			    $("#display-options").trigger("click");
				}, 3000);
				 // $("#display-gal-opt-msg").html("<div class='alert alert-success'>Vos options ont bien été mises à jour</div>").delay(5000).html("");
				 // div.delay(2000).animate({ height: 0 }, 600);
				 // $("#display-gal-opt-msg").html("").delay(5000);
				// $("#display-options").delay(5000).trigger("click");
			},
			error: function(){
				$("#display-gal-opt-msg").html("<div class='alert alert-danger'>Désolée, problème !</div>");
			}
		})
	});

/***************  SUPRESSION CATEGORIE  *****************/
$(".picture-header-option-part").on("click", ".span-del-cat", function() {
	var idLong = $(this).attr('id');
	var idCourt = idLong.substring(7);
 	$("#dial-del-cat").css("display", "block");
	$( "#dial-del-cat" ).dialog({
		resizable: false,
		height:300,
		width: 300,
		modal: true,
		buttons: {
			"Confirmer": function() {
				$( this ).dialog( "close" );
				$.ajax({
					type: "POST",
					url: "index.php?section=delete_category",
					data: { id: idCourt },
					dataType: "html",
					success: function(data) {
						$(".picture-header-option-part").html(data);
					},
					error: function(){
					}
				})
			},
			"Annuler": function() {
				$( this ).dialog( "close" );
			}
		}
	});
});

	/***************  VALIDATION FORMULAIRE  *****************/

	// Formulaire de création de galerie
	$("#galleryName").keyup(function() {
		var validateGalleryName = $('#validateGalleryName');
		var t = this; 
		if (this.value != this.lastValue) {
		  	if (this.timer) {
		  		clearTimeout(this.timer);	
		  	} 
		  	validateGalleryName.removeClass("form-error");
		  	validateGalleryName.removeClass("form-ok");
		  	validateGalleryName.html('<img src="app/img/ajax-spinner.gif" height="16" width="16" /> Vérification...');
		  
		  	this.timer = setTimeout(function () {
		    	$.ajax({
		      		url: 'index.php?section=check_form',
		      		data: {action: "checkGallery", galleryName: t.value},
		      		dataType: 'json',
		      		type: 'post',
		      		success: function(data) {
		      			if(data.ok == true) {
		        			validateGalleryName.addClass("form-ok");
		        		} else if (data.ok == false) {
		        			validateGalleryName.addClass("form-error");
		        		}
		        		validateGalleryName.html(data.msg);
		      		}
		    	});
		  	}, 200);
		  
		  	this.lastValue = this.value;
		}
	});

	//  Formulaire d'édition de galerie (différence : le nom initial de la galerie doit être considéré comme valide malgré sa présence dans la bdd)
	$("#editGallery").keyup(function() {
		var validateGalleryName = $('#validateGalleryName');
		var t = this; 
		var editGallery = $(this).attr("class");
		if (this.value != this.lastValue) {
		  	if (this.timer) {
		  		clearTimeout(this.timer);	
		  	} 
		  	validateGalleryName.removeClass("form-error");
		  	validateGalleryName.removeClass("form-ok");
		  	validateGalleryName.html('<img src="app/img/ajax-spinner.gif" height="16" width="16" /> Vérification...');
		  
		  	this.timer = setTimeout(function () {
		    	$.ajax({
		      		url: 'index.php?section=check_form',
		      		data: {action: "checkGallery", galleryName: t.value, editGallery: editGallery},
		      		dataType: 'json',
		      		type: 'post',
		      		success: function(data) {
		      			if(data.ok == true) {
		        			validateGalleryName.addClass("form-ok");
		        		} else if (data.ok == false) {
		        			validateGalleryName.addClass("form-error");
		        		}
		        		validateGalleryName.html(data.msg);
		      		}
		    	});
		  	}, 200);
		  
		  	this.lastValue = this.value;
		}
	});

	// Formulaire de création de catégorie
	$(document).on("input", ".categoryName", function(event) {
		if(! $(event.target).is(".categoryNameModal")) {
			var validateCategoryName = $('.validateCategoryName');
			var t = this; 
			if (this.value != this.lastValue) {
			  	if (this.timer) {
			  		clearTimeout(this.timer);	
			  	} 
			  	validateCategoryName.removeClass("form-error");
			  	validateCategoryName.removeClass("form-ok");
			  	validateCategoryName.html('<img src="app/img/ajax-spinner.gif" height="16" width="16" /> Vérification...');
			  
			  	this.timer = setTimeout(function () {
			    	$.ajax({
			      		url: 'index.php?section=check_form',
			      		data: {action: "checkCategory", categoryName: t.value},
			      		dataType: 'json',
			      		type: 'post',
			      		success: function(data) {
			        		validateCategoryName.html(data.msg);
			        		if(data.ok == true) {
			        			validateCategoryName.addClass("form-ok");
			        		} else if (data.ok == false) {
			        			validateCategoryName.addClass("form-error");
			        		}
			      		}
			    	});
			  	}, 200);
			  
			  	this.lastValue = this.value;
			}
		}
	});

	// Formulaire de création de catégorie dans le modal
	$(document).on("input", ".categoryNameModal", function() {
		var validateCategoryName = $('.validateCategoryNameModal');
		var t = this; 
		if (this.value != this.lastValue) {
		  	if (this.timer) {
		  		clearTimeout(this.timer);	
		  	} 
		  	validateCategoryName.removeClass("form-error");
		  	validateCategoryName.removeClass("form-ok");
		  	validateCategoryName.html('<img src="app/img/ajax-spinner.gif" height="16" width="16" /> Vérification...');
		  
		  	this.timer = setTimeout(function () {
		    	$.ajax({
		      		url: 'index.php?section=check_form',
		      		data: {action: "checkCategory", categoryName: t.value},
		      		dataType: 'json',
		      		type: 'post',
		      		success: function(data) {
		        		validateCategoryName.html(data.msg);
		        		if(data.ok == true) {
		        			validateCategoryName.addClass("form-ok");
		        		} else if (data.ok == false) {
		        			validateCategoryName.addClass("form-error");
		        		}
		      		}
		    	});
		  	}, 200);
		  
		  	this.lastValue = this.value;
		}
	});

	// Formulaire de connexion
	$("#loginForm").submit(function(event) {
		event.preventDefault();
		var login = $("#inputLogin").val();
		var password = $("#inputPassword").val();
		console.log(login);

		$.ajax({
			type: 'post',
			url: 'index.php?section=login_controller',
			data: {login: login, password: password},
			dataType: 'json',
			success: function(data) {
				if(data.valid == false) {
					$("#loginError").css("display", "inline");
					$(".form-group").addClass("has-error");
				}
				else {
					window.location.href = data.redirect;
				}
			}
		})
	});

	// Validation de nouvelle image
	$('#newImageForm').submit(function(event) {
		var accepted = new RegExp(/^[a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+$/);
		var acceptedFiles = new RegExp(/^.*\.(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG)$/);
		var title = $('#imageName').val();
		var image = $('#imageUpload').val();
		if(title == "") {
			$('.validateImageName').html("L'image doit avoir un titre");
		} else if(!title.match(accepted)) {
			$('.validateImageName').html("Utilisez uniquement des caractères alphanumériques");
		} else {
			$('.validateImageName').html("");
		}
		if(image == "") {
			$('.validateImageUpload').html("Choisissez une image");
		} else if(!image.match(acceptedFiles)) {
			$('.validateImageUpload').html("Format de fichier incorrect");
		} else {
			$('.validateImageUpload').html("");
		}

		if($('.validateImageUpload').html() != "" || $('.validateImageName').html() != "") {
			return false;
		}
	});

	// Validation d'édition d'image
	$("#modal_info_pic").on("click", ".editImageSubmit", function(event) {
		var accepted = new RegExp(/^[a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+$/);
		var title = $('#imageName').val();
		if(title == "") {
			$('.validateImageName').html("L'image doit avoir un titre");
		} else if(!title.match(accepted)) {
			$('.validateImageName').html("Utilisez uniquement des caractères alphanumériques");
		} else {
			$('.validateImageName').html("");
		}

		if($('.validateImageName').html() != "") {
			return false;
		}
	});

	// Validation de création et édition de galerie
	$("#newGalleryForm, #editGalleryForm").submit(function(event) {
		var accepted = new RegExp(/^[a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+$/);
		var galleryName = $('#galleryName').val();
		var ok = true;
		if(galleryName == "") {
			$('#validateGalleryName').addClass("form-error");
			$('#validateGalleryName').html("La galerie doit avoir un nom");
			ok = false;
		} else if (!galleryName.match(accepted)) {
			$('#validateGalleryName').addClass("form-error");
			$('#validateGalleryName').html("Utilisez uniquement des caractères alphanumériques");
			ok = false;
		} else if ($('#validateGalleryName').text() == "Ce nom est déjà utilisé"){
			$('#validateGalleryName').addClass("form-error");
			$('#validateGalleryName').html("Ce nom est déjà utilisé");
			ok = false;
		} else {
			$('#validateGalleryName').html("")
		}

		if(!ok) {
			return false;
		}
	});

}); 
