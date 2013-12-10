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
        console.log(catActiveIds);

        $.ajax({
    		  type: "POST",
    		  url: "index.php?section=home",
    		  data: {catActiveIds: catActiveIds, gal: gal},
          dataType: "html",
    		  success: function(data, textStatus, XHR){
    		      $("body").html(data);
              console.log("this 2 :"+$cat.html());
              // console.log($cat);
              $cat.removeClass('cat-active');
    		  },
    		  error: function (XHR, textStatus, errorThrown){
              console.log('quel echec');
    		  }
    		});
        
        console.log("fin ajax?");

    });

})
