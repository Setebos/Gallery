(function($)
{



  $.fn.slideshowPlugin=function(options)
  {

        var defauts={
            'nbPic': 3,
            'interval' : 4000,
            'autoplay' : false
          };

        var params=$.extend(defauts, options);


        this.each(function()
         {
            var container = $(this);
            var totalImages=container.find('img').length;

            if(totalImages > params.nbPic){
              console.log("ça roule !");
            } else {
                $(".nav-chevron").each(function(){
                    $(this).hide();
                });
            }

         });

         return this;
  };



})(jQuery);

