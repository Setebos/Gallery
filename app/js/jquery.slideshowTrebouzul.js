(function($)
{

/*
Pour permettre affichage de tous les formats d'image, 
les images sont stockees dans des div de 250px. 
Pour le moment, le fontionnement du plugin se base sur ces 250px.

To do : initialiser le diapo en enveloppant les images ds des div de 250 ?
*/

$.fn.slideshowPlugin=function(options)
{

  var defauts={
    'show_entire_gallery' : false,
    'interval' : 4000,
    'autoplay' : false
};

var params=$.extend(defauts, options);

// variables utiles definies à partir de la div de lancement du plugin

this.each(function()
{
    var container = $(this),
        diapoUL = container.children('ul'),
        imgsLi = diapoUL.find('li'),
        imgWidth = $(imgsLi[0]).outerWidth(), // 250
        nbImgs = imgsLi.length,
        current = 1,
        totalWidth = nbImgs * imgWidth;
    var nbImgDisplayed = 3;

        // console.log($(imgsLi[5]).outerWidth());

            // gestion de l'affichage : galerie entiere ou 3 images
            if(params.show_entire_gallery == true){
              $('.diapo').find('ul').css('width', 'inherit');
          }else{
              $('.diapo').css('overflow', 'hidden').find('ul').css('width', '10000px');
          }

            // affichage des boutons de navigation seulement si nécessaire
            // + gestion de la navigation
            // !!!! régler ce putain de pb de 3 inscrit en dur ! (récup #diapo width malgré overflow hidden)
            if(nbImgs  > nbImgDisplayed && params.show_entire_gallery == false ){
              $(".diapo-nav").show().find('button').on('click', function(){
                    var direction = $(this).data('dir'),
                    loc = imgWidth; // 250

                // update current value
                ( direction === 'next' ) ? ++current : --current;

                // cas image 1 - click prev
                if ( current === 0 ) {
                    current = nbImgs -2;
                    loc = totalWidth - imgWidth*nbImgDisplayed; 
                    direction = 'next';
                } else if ( current +1=== nbImgs ) { // cas image final - click next
                    current = 1;
                    loc = 0;
                }
                console.log(current)
                transition(diapoUL, loc, direction);
              });
          } else {
              $(".diapo-nav").hide();
          }

          function transition( container, loc, direction ) {
                var unit; // -= +=

                if ( direction && loc !== 0 ) {
                    unit = ( direction === 'next' ) ? '-=' : '+=';
                }

                container.animate({
                    'margin-left': unit ? (unit + loc) : loc
                });
            }

      });

return this;
};



})(jQuery);

