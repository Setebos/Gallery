 $(document).ready(function(){

    // gestion des galeries (class active + tri ajax)
      // $(".gallery-desc").on('click', function(){
      //     $(".gal-active").removeClass('gal-active');
      //     $(this).find(':first-child').addClass('gal-active');
      //     var idGallery = $(this).attr('id').substring(7);
      // });


    // gestion des categories (class active + tri ajax)
    $(".cat-name").on('click', function(){
        $(this).toggleClass('cat-active');


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
