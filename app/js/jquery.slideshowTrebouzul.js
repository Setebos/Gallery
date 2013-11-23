(function($)
{



/*
Pour permettre affichage de tous les formats d'image, 
les images sont stockees dans des div de 250px. 
Pour le moment, le fontionnement du plugin se base sur ces 250px.
*/

  $.fn.slideshowPlugin=function(options)
  {

        var defauts={
            'show_entire_gallery' : false,
            'nbPic': 3,
            'interval' : 4000,
            'autoplay' : false
          };

        var params=$.extend(defauts, options);


        this.each(function()
         {
            var container = $(this);
            var totalImages=container.find('img').length;

            // gestion de l'affichage : galerie entiere ou 3 images
            if(params.show_entire_gallery == true){
              $('.diapo').find('ul').css('width', 'inherit');
            }else{
              $('.diapo').css('overflow', 'hidden').find('ul').css('width', '10000px')
            }

            // affichage des boutons de navigation seulement si nécessaire
            if(totalImages > params.nbPic && params.show_entire_gallery == false ){
              $(".diapo-nav").show();
            } else {
                $(".diapo-nav").hide();
            }

         });

         return this;
  };



})(jQuery);

