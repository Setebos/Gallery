 $(document).ready(function(){


 	// gestion des categories (class active + tri ajax)
    $(".cat-name").on('click', function(){
        $(".cat-active").removeClass('cat-active');
        $(this).addClass('cat-active');
        var id = 2;

        $.ajax({
		  type: "POST",
		  url: "index.php?section=home",
		  data: {idGallery: id},
		  success: function(data, textStatus, XHR){
		  		$('#ajax-gallery').html(data);
		  },
		  error: function (XHR, textStatus, errorThrown){

		  }
		});

    });

    // gestion des categories (class active + tri ajax)
    $(".gallery-desc").on('click', function(){
        $(".gal-active").removeClass('gal-active');
        $(this).addClass('gal-active');

  //       $.ajax({
		//   type: "POST",
		//   url: "index.php?section=home",
		//   data: {idGallery: id},
		//   success: function(data, textStatus, XHR){
		//   		$('#ajax-gallery').html(data);
		//   },
		//   error: function (XHR, textStatus, errorThrown){

		//   }
		// });

    });

})