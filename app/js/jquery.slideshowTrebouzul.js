if ( typeof Object.create !== 'function' ) {
    Object.create = function( obj ) {
        function F() {};
        F.prototype = obj;
        return new F();
    };
}

(function($)
{

 $.fn.slideshowPlugin=function(options)
 {

      var gallery = {
      init: function(options, elem){

            var self = this;      // gallery

            self.params = $.extend({
                'show_entire_gallery' : false,
                'diaporama_width' : 750,
                'nb_images_per_line' : 3,
                'interval' : 4000,
                'autoplay' : false
            }, options),

          self.container = elem;         // div diapo    
          self.$container = $(elem);   // $(diapo)
          self.diapoUL = self.$container.children('ul');
          self.items = self.$container.find('li');
          self.nbItemsDisplayed =  self.params.nb_images_per_line;
          self.itemWidth = self.params.diaporama_width / self.nbItemsDisplayed;
          self.containerWidth =  self.params.diaporama_width;
          self.nbItems = self.items.length;
          self.totalWidth = self.nbItems * self.itemWidth;

          self.navSection = $(".diapo-nav");

          self.current = 0;     // current = index de l'image en tete de ligne

          self.setup();

      },
      // mise en forme des éléments du plugin.
      // A prevoir : generation de la navigation ?
      setup: function(){
            var self = this;

            self.$container.css({
                "width": self.containerWidth,
                "margin": "auto"
            });

            self.diapoUL.css({
                "width": self.totalWidth,
                "margin": "auto", 
                "text-align": "center",
                "padding-left": "0",
                "list-style": "none",
            });

            self.items.each(function(){
                var item = $(this);
                item.css({
                    "margin": "10px 0 0 0",
                    "width": self.itemWidth, 
                    "padding": "5px",
                    "list-style": "none",
                    "float" : "left",
                    "overflow" : "hidden"
                }).children('img').css({
                     "max-width": "inherit", 
                     "max-height": self.itemWidth/2
                })

            })
             self.params.show_entire_gallery ==true? self.setupDisplayAll() :  self.setupDisplayPart();
             self.items.on('click', function(){
                self.launchSlideshow(this); 
             });

      },
      // mise en forme specifique pour afficher l'integralite de la gallerie
      setupDisplayAll: function(){
            var self = this;
            
            self.diapoUL.css({
                "width": "inherit"
            });
            self.navSection.hide();
      },    
      //mise en forme specifique pour affichage de seulement une ligne avec navigation
      setupDisplayPart: function(){
            var self = this;
            self.$container.css({
                "overflow": "hidden "
            });
            self.diapoUL.css({
                "width": self.totalWidth
            });
             if(self.nbItems  > self.nbItemsDisplayed){
               // = je lie la méthode setNavigation au click sur les boutons
                self.navSection.show().find('button').on('click', function(){
                  self.setNavigation(this);  
              });
            }else{
                self.navSection.hide()
            };            
      },
      setNavigation: function(button){

            var self = this,
            $buttonNav = $(button),
            direction = $buttonNav.data('dir'),
            moveShift = self.itemWidth,
            unit;

            direction === 'next' ? ++self.current : --self.current;

            // cas image 1 - click prev
            if ( self.current === -1 ) {
                self.current = self.nbItems - self.nbItemsDisplayed;
                moveShift = self.totalWidth - self.itemWidth*self.nbItemsDisplayed; 
                direction = 'next';
            } else if ( self.current === self.nbItems - (self.nbItemsDisplayed - 1) ) { // cas image final - click next
                self.current = 0;
                moveShift = 0;
          }

          // animation du diaporama
            if ( direction && moveShift !== 0 ) {
                unit = ( direction === 'next' ) ? '-=' : '+=';
            };
            self.diapoUL.animate({
                'margin-left': unit ? (unit + moveShift) : moveShift
            });
      },
      launchSlideshow: function(item){
            var self = this;
            var slide = Object.create(slideshow);
            slide.init(self.params, self.$container, item);
      }

    };

    var slideshow = {
            init: function(options, container, item){
                // console.log(image);
                var self = this;
                self.container = container;
                self.$item = $(item);
                self.src = self.$item.find('img').attr('src');
                if ($('#lightbox').length > 0) {
                    self.showLightbox();
                } else {
                    self.setup();
                    
                }
            },
            setup: function(){
                    var self = this;
                    var lightbox =
                    '<div id="lightbox">' +
                        '<p>Click to close</p>' +
                        '<div id="content">' + //insert clicked link's href into img src
                            '<img src="' + self.src +'" />' +
                        '</div>' +
                    '</div>';

                    self.container.append(lightbox);

                    console.log($('#lightbox').find('img'));
                    $('#lightbox').css({
                        "position":"fixed", /* keeps the lightbox window in the current viewport */
                        "top":"0",
                        "left":"0",
                        "width":"100%",
                        "height":"100%",
                        // "background":"url(overlay.png) repeat",
                        "background": "rgba(0,0,0,.8)",
                        "text-align":"center"
                    }).find('img').css({
                        "max-width": "800px", 
                        "box-shadow":"0 0 25px #111",
                        "-webkit-box-shadow":"0 0 25px #111",
                        "-moz-box-shadow":"0 0 25px #111"
                })
            },
            showLightbox: function(){
                    var self = this;
                    $('#content').html('<img src="' + self.src + '" />');
                    $('#lightbox').show();
            }
    }

      // $.fn.slideshowPlugin=function(options)
      // {
          return this.each(function(){
            var gal = Object.create(gallery);
            gal.init(options, this);
            // (this).data('gallery', gal);
        });

      };



  })(jQuery);

