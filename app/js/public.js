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
   
        if(catActiveIds.length == 0){
          catActiveIds.push("empty");
        };

        $.ajax({
    		  type: "POST",
    		  url: "index.php?section=home",
    		  data: {catActiveIds: catActiveIds, gal: gal},
          dataType: "html",
    		  success: function(data, textStatus, XHR){
    		      $("body").html(data);              
    		  },
    		  error: function (XHR, textStatus, errorThrown){
              console.log('quel echec');
    		  }
    		});

        $(document).ajaxSuccess(function( event, xhr, settings ) {
          $(".cat-name").removeClass('cat-active').each(function(){
            $cat = $(this)
            id = $cat.attr('id').substring(3);
            if( jQuery.inArray(id, catActiveIds) != -1) {
              $cat.addClass('cat-active');
            };
          })
        });
    });


  // AUTOCOMPLETE ////////////////////////////////////////////////////////////////////////////////////////

  var liste = [
     "chat",
     "tortue",
     "chatortue"
  ];




   $("#search-input").autocomplete({
      source: 'app/modele/autocomplete.php'
   }); 

})
