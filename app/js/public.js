 $(document).ready(function(){

	

    // gestion des galeries (class active + tri ajax)
    $(".gallery-desc").on('click', function(){
        $(".gal-active").removeClass('gal-active');
        $(this).addClass('gal-active');
        var idGallery = $(this).attr('id').substring(7);

        $.ajax({
		  type: "POST",
		  url: "index.php?section=home",
		  data: {idGallery: idGallery},
		  success: function(data, textStatus, XHR){
		  		$('#ajax-image').html(data);
		  },
		  error: function (XHR, textStatus, errorThrown){

		  }
		});

    });


    // gestion des categories (class active + tri ajax)
    $(".cat-name").on('click', function(){
        $(".cat-active").removeClass('cat-active');
        $(this).addClass('cat-active');
        var id = 2;

  //       $.ajax({
		//   type: "POST",
		//   url: "index.php?section=home",
		//   data: {idGallery: id},
		//   success: function(data, textStatus, XHR){
		//   		$('#ajax-image').html(data);
		//   },
		//   error: function (XHR, textStatus, errorThrown){

		//   }
		// });

    });

})