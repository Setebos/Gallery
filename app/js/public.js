 $(document).ready(function(){

    $(".cat-name").on('click', function(){
        var $cat = $(this);
        $cat.toggleClass('cat-active');
        var gal = $('#hidden-gallery-id').val();
        var catActiveIds = [];
        var id = "";

        if($cat.attr('id') == "all-cat"){
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
    		  },
    		  error: function (XHR, textStatus, errorThrown){
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

      var filter_img_by_category = function(imgs_src, width) {
          $("#diapo").find('img').each(function(){

                var src = $(this).attr('src');
                var imgLi = $(this).parent();
                if( $.inArray(src, imgs_src) == -1 && !imgLi.hasClass('filtered')) {
                    imgLi.addClass('filtered');
                    imgLi.animate({
                          'width': 'toggle',
                          'opacity': 0
                      }, 750);
                 };
                 if( $.inArray(src, imgs_src) != -1 && imgLi.hasClass('filtered')) {
                    imgLi.removeClass('filtered');
                    imgLi.animate({
                          'width': 'toggle',
                          'opacity': 1
                      }, 750);
                 };


          })
      }


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


  // AUTOCOMPLETE ////////////////////////////////////////////////////////////////////////////////////////

  $("#search-input").autocomplete( {
    source: function(request,response) {
        $.ajax ( {
          url: "index.php?section=autocomplete",
          type:"get",
          data: {term: request.term},
          dataType: "json",
          success: function(data) {
            response($.map(data, function(item){
              return {
                label: item.value,
                value: item.value
              }
            }));
          },
          error: function (XHR, textStatus, errorThrown){
          }
        })
    }
  });

})
