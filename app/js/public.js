 $(document).ready(function(){

    $(".cat-name").on('click', function(){
        var $cat = $(this);
        $cat.toggleClass('cat-active');
        var gal = $('#hidden-gallery-id').val();
        var catActiveIds = [];
        var id = "";

        if($cat.attr('id') == "all-cat"){
          console.log("all cat");
          $(".cat-bdd").find(".cat-active").each(function(){
              $(this).removeClass('cat-active');
          })
        }

        $(".cat-bdd").find(".cat-active").each(function(){
          id = $(this).attr('id').substring(3);
          catActiveIds.push(id);
        })
   
        if(catActiveIds.length == 0){
          $(".cat-bdd").find(".cat-name").each(function(){
            id = $(this).attr('id').substring(3);
            catActiveIds.push(id);
          })
        };

        $.ajax({
    		  type: "POST",
    		  url: "index.php?section=home",
    		  data: {catActiveIds: catActiveIds, gal: gal},
            dataType: "html",
    		  success: function(data, textStatus, XHR){
    		      $("body").html(data);  
              // location.reload( true );            
    		  },
    		  error: function (XHR, textStatus, errorThrown){
              console.log('quel echec');
    		  }
    		});

        $(document).ajaxSuccess(function( event, xhr, settings ) {
          if(catActiveIds.length == $(".cat-bdd li").length){
            $(".cat-name").removeClass('cat-active');
            $("#all-cat").addClass('cat-active');
          }else {
            $(".cat-name").removeClass('cat-active').each(function(){
              $cat = $(this)
              id = $cat.attr('id').substring(3);
              if( jQuery.inArray(id, catActiveIds) != -1) {
                $cat.addClass('cat-active');
              };
            })
          }
        });
      });


  // AUTOCOMPLETE ////////////////////////////////////////////////////////////////////////////////////////

  $("#search-input").autocomplete( {
    source: function(request,response) {
        $.ajax ( {
          url: "index.php?section=autocomplete",
          type:"get",
          data: {term: request.term},
          dataType: "json",
          success: function(data) {
            console.log('quel succes');
            response($.map(data, function(item){
              console.log(item.value);
              return {
                label: item.value,
                value: item.value
              }
            }));
          },
          error: function (XHR, textStatus, errorThrown){
            console.log(XHR);
            console.log(textStatus);
            console.log(errorThrown);
              console.log('quel echec');
          }
        })
    }
  });

})
