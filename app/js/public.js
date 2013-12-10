 $(document).ready(function(){

    // gestion des galeries (class active + tri ajax)
      // $(".gallery-desc").on('click', function(){
      //     $(".gal-active").removeClass('gal-active');
      //     $(this).find(':first-child').addClass('gal-active');
      //     var idGallery = $(this).attr('id').substring(7);
      // });


    // gestion des categories (class active + tri ajax)
    $(".cat-name").on('click', function(){
        var $cat = $(this);
        $(this).toggleClass('cat-active');
        var catActiveIds = []

        $(".cat-active").each(function(){
          var id = $(this).attr('id').substring(3);
          catActiveIds.push(id);
        })
        console.log(catActiveIds);

        var cat = "test";

        $.ajax({
    		  type: "POST",
    		  url: "index.php?section=home",
    		  data: {catActiveIds: catActiveIds},
          dataType: "html",
    		  success: function(data, textStatus, XHR){
              // console.log(data);
    		  		$("body").html(data);
              // location.reload(true);
              console.log($cat);
              $cat.toggleClass('cat-active');
    		  },
    		  error: function (XHR, textStatus, errorThrown){
              console.log('quel echec');
    		  }
    		});
        
        console.log("fin ajax?");

    });

})
