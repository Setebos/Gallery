 $(document).ready(function(){

    // gestion des categories (class active + tri ajax)
    $(".cat-name").on('click', function(){
        var $cat = $(this);
        $(this).toggleClass('cat-active');
        var gal = $('#hidden-gallery-id').val();
        var catActiveIds = [];
        var id = "";

        $(".cat-active").each(function(){
          id = $(this).attr('id').substring(3);
          catActiveIds.push(id);
        })
        console.log("begin");
        console.log(catActiveIds);
        

        $.ajax({
    		  type: "POST",
    		  url: "index.php?section=home",
    		  data: {catActiveIds: catActiveIds, gal: gal},
          dataType: "html",
    		  success: function(data, textStatus, XHR){
    		      $("body").html(data).promise().done(function(){
                $cat.removeClass('cat-active');
              });
              console.log("this 2 :"+$cat.html());
              // console.log($cat);
              
    		  },
    		  error: function (XHR, textStatus, errorThrown){
              console.log('quel echec');
    		  }
    		});

        $(document).ajaxSuccess(function( event, xhr, settings ) {
          console.log("ajaxSucess event");
          console.log("cat active : " + catActiveIds);
          $(".cat-name").removeClass('cat-active').each(function(){
            $cat = $(this)
            id = $cat.attr('id').substring(3);
            if( jQuery.inArray(id, catActiveIds) != -1) {
              console.log("id : " + id);
              console.log(jQuery.inArray( id, catActiveIds) != -1);
              $cat.addClass('cat-active');
            };
          })
        });
    });

})
