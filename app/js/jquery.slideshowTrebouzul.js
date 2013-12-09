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

    // Gallery object //////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    // Slide show object //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    var slideshow = {
            init: function(options, container, item){
                var self = this;
                self.container = container;
                self.$item = $(item);
                self.currentImageIndex = 0;
                var current_img = self.$item.find('img');
                self.src =  current_img.attr('src'); 
                self.title = current_img.attr('title'); 
                self.desc = current_img.data('desc');
                
                if ($('#lightbox').length > 0) {
                    self.showLightbox();
                } else {
                    self.setup();
                }

                $('.lb-close').on('click', function(){
                      self.hideLightbox();  
                });

                self.$lightbox.find('.lb-prev').on('click', function(e) {
                    console.log("1st pic");
                    e.preventDefault();
                    // if (self.currentImageIndex === 0) {
                    //     console.log("1st pic");
                    //   // _this.changeImage(_this.album.length - 1);
                    // } else {
                    //     console.log("else pic");
                    //   // _this.changeImage(_this.currentImageIndex - 1);
                    // }
                    return false;
                  });


            },
            setup: function(){
                    var self = this;
                    var lightbox =
                        '<div id="lb-area">' +
                        '</div>'+
                        '<div id="lightbox" class="lightbox">' +
                            '<div class="lb-container">' +
                                '<div class="lb-img-container">' + 
                                    '<img class="lb-image" src="" />' +
                                    '<div class="lb-nav">' +
                                        '<a class="lb-prev" href="" ></a>'+
                                        '<a class="lb-next" href="" ></a>'+
                                    '</div>'+
                                '</div>' +
                                 '<div class="lb-data-container">' + 
                                    '<div class="lb-details">' +
                                        '<div class="lb-title"><h3></h3></div>' +
                                        '<div class="lb-desc"><p></p></div>'+
                                    '</div>'+
                                    '<div class="lb-close-container">' +
                                        '<a class="lb-close"></a>' +
                                    '</div>'+
                                '</div>' +
                            '</div>' +
                        '</div>';

                    self.container.append(lightbox);
                    self.$lightbox = $('#lightbox');
                    self.showLightbox();    

            },
            showLightbox: function(){
                    var self = this;
                    
                    $( "#lb-area" ).fadeIn( "slow", function() {
                        $('#lightbox').fadeIn("1000");
                        
                        // mise en forme dynamique suivant l'image affichée
                        $('.lb-image').attr("src",""+self.src+"");
                        var maxHeight = $(window).height() * 70/100;
                        var maxWidth = $(window).width() * 70/100;                        
                        $('.lb-image').css({
                            "max-width": ""+maxWidth+"px",
                            "max-height": ""+maxHeight+"px"
                        });
                        $('.lb-container').width($('.lb-image').width() + 20);
                        $('.lb-nav').height($(".lb-img-container").outerHeight());
                        $(".lb-title h3").html(self.title);
                         $(".lb-desc p").html(self.desc);
                      });

                    
            },
            hideLightbox: function(){
                    var self = this;
                    $('#lightbox').fadeOut();
                    $('#lb-area').fadeOut();
            }

    }

    // Launch plugin //////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // $.fn.slideshowPlugin=function(options)
      // {
          return this.each(function(){
            var gal = Object.create(gallery);
            gal.init(options, this);
            // (this).data('gallery', gal);
        });

      };



  })(jQuery);

