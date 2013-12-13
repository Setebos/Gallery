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
                'displayDuration' : 5000
            }, options),

          self.$container = $(elem);   // $(diapo)
          self.diapoUL = self.$container.children('ul');
          self.items = self.$container.find('li');
          self.itemWidth = self.params.diaporama_width / self.params.nb_images_per_line;
          self.containerWidth =  self.params.diaporama_width;
          self.nbItems = self.items.length;
          self.totalWidth = self.nbItems * self.itemWidth;
          self.autoplay = false;

          self.navSection = $("#diapo-nav");

          self.current = 0;     // current = index de l'image en tete de ligne

          self.setup();

      },
      // mise en forme des éléments du plugin.
      // Todo : css sans bootstrap
      setup: function(){
            var self = this;

            var navBtn =  
              '<button id="autoplay-btn" type="button" class="btn btn-default autoplay-btn">' +
                'Lancer le diaporama' +
              '</button>' + 
              '<div class="btn-group btn-dir">' +
                '<button data-dir="prev" type="button" class="btn btn-default">' +
                    '<span class="glyphicon glyphicon-chevron-left"></span>' +
                '</button>' +
                '<button data-dir ="next" type="button" class="btn btn-default">' +
                    '<span class="glyphicon glyphicon-chevron-right"></span>'   +
                '</button>'+
              '</div>' ;

            // mise en forme dynamique des éléments de la gallery suivant les options du plugin
            self.navSection.css({
              "width": self.containerWidth,
              "margin": "auto"  
            }).prepend(navBtn);  

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

            self.$btnDir = $('.btn-dir');

            // Attache de fonctionnalités aux éléments partagés du plugin
            $('#autoplay-btn').on('click', function(){

               self.launchSlideshow(this, true);  // true = lancer le slideshow avec defilement automatique
            });

             self.items.on('click', function(){
                self.launchSlideshow(this, false);   // false = lancer le slideshow avec defilement manuel
             });

             // Mise en forme finale variant suivant les params
             self.params.show_entire_gallery ==true? self.setupDisplayAll() :  self.setupDisplayPart();

      },
      // mise en forme specifique pour afficher l'integralite de la gallerie
      setupDisplayAll: function(){
            var self = this;
            
            self.diapoUL.css({
                "width": "inherit"
            });
            self.$btnDir.hide();
      },    
      //mise en forme specifique pour affichage de seulement une ligne avec navigation
      setupDisplayPart: function(){
            var self = this;
            self.$container.css({
                "overflow": "hidden"
            });
            self.diapoUL.css({
                "width": self.totalWidth, 
                "overflow": "hidden"
            });

            // Attache des fonctionnalités de navigation si besoin
             if(self.nbItems  > self.params.nb_images_per_line){
                self.$btnDir.show().find('button').on('click', function(){
                    self.setNavigation(this);  
                });
            }else{
                self.$btnDir.hide()
            };            
      },
      setNavigation: function(buttonClicked){

            var self = this,
            $buttonNav = $(buttonClicked),
            direction = $buttonNav.data('dir'),
            moveShift = self.itemWidth,
            unit;

            direction === 'next' ? ++self.current : --self.current;

            // cas image 1 - click prev :
            if ( self.current === -1 ) {
                self.current = self.nbItems - self.params.nb_images_per_line;
                moveShift = self.totalWidth - self.itemWidth*self.params.nb_images_per_line; 
                direction = 'next';
            // cas image final - click next :
            } else if ( self.current === self.nbItems - (self.params.nb_images_per_line - 1) ) { 
                self.current = 0;
                moveShift = 0;
            }

          // animation de la gallery
            if ( direction && moveShift !== 0 ) {
                unit = ( direction === 'next' ) ? '-=' : '+=';
            };
            self.diapoUL.animate({
                'margin-left': unit ? (unit + moveShift) : moveShift
            });
      },
      launchSlideshow: function(item, autoplay){
            var self = this;
            var slide = Object.create(slideshow);
            slide.init(self, item, autoplay);
      }

    };

    // Slideshow object //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    var slideshow = {
            init: function(gallery, itemClicked, autoplay){
                var self = this;
                self.gallery = gallery;                   //$('#diapo')
                self.autoplay = autoplay;
                self.$item_clicked = $(itemClicked);      // 'li' containing clicked picture
                self.currentImageIndex = 0;
                self.album = [];
                self.createAlbum(self.$item_clicked.find('img'));

                if ($('#lightbox').length > 0) {      // = passage d'une image à une autre quand slideshow ouvert
                    $( "#lb-area" ).fadeIn( "slow", function() {
                        $('#lightbox').fadeIn("slow");
                        self.changeLightbox();
                  });
                } else {                                      // = premier chargement du slideshow
                    self.setup();               
                }

                // fermeture du slideshow
                $('.lb-close').on('click', function(){
                      self.hideLightbox();  
                });
                $('#lb-area').on('click', function(){
                      self.hideLightbox();  
                });

               // gestion de la navigation
               self.setNav();
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
                                '<div class="preloading">' +
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

                    // fixer taille limite des images en fonction de taille de la fenetre
                    var maxHeight = $(window).height() * 70/100;
                    var maxWidth = $(window).width() * 70/100;                        
                    $('.lb-image').css({
                        "max-width": ""+maxWidth+"px",
                        "max-height": ""+maxHeight+"px"
                    });

                    self.gallery.$container.append(lightbox);
                    self.$lightbox = $('#lightbox');
                    self.createLightbox();
            },
            setNav: function(){
              var self = this;

                // boutons nav du slideshow
                self.$lightbox.find('.lb-prev').on('click', function(e) {
                    e.preventDefault();
                    if (self.currentImageIndex === 0) {
                        self.currentImageIndex = self.album.length - 1;
                    } else {
                        self.currentImageIndex --;
                    }
                    self.changeLightbox();
                  });

                self.$lightbox.find('.lb-next').on('click', function(e) {
                    e.preventDefault();
                    if (self.currentImageIndex === self.album.length - 1) {
                        self.currentImageIndex = 0;
                    } else {
                        self.currentImageIndex++;
                    }
                    self.changeLightbox();
                  });


            },
            createAlbum: function(current_img){
                    var self = this;
                    self.gallery.items.each(function(index){
                        var img = $(this).children('img');
                        var source = img.attr('src').split('-miniature');
                        self.album.push({
                            src: ""+source[0]+""+source[1]+"",
                            title: img.attr('title'),
                            desc: img.data('desc')
                          });
                        if( img.attr('src') == current_img.attr('src')) {
                          self.currentImageIndex = index;
                        }
                    })

            },  
            createLightbox: function(){
                    var self = this;
                    
                    $( "#lb-area" ).fadeIn( "slow", function() {
                          self.$lightbox.fadeIn("slow");
                          var currentImg = self.album[self.currentImageIndex];
                          // var src = currentImg.src.split('-miniature');
                          $('.lb-image').attr("src",""+currentImg.src+"");
                          $('.lb-container').width($('.lb-image').width() + 20);
                          $('.lb-nav').height($(".lb-img-container").outerHeight());
                          $(".lb-title h3").html(currentImg.title);
                          $(".lb-desc p").html(currentImg.desc);
                    }); 

                    if (self.autoplay == true){
                          self.autoplayDiaporama();
                    }                 
            },
            autoplayDiaporama: function(){
                  var self = this;

                  $('.lb-nav').hide();

                  // simulation d'un click à interval régulier pour défilement auto
                  setInterval(function(){
                      $('.lb-next').click();
                  }, self.gallery.params.displayDuration)
            },
            changeLightbox: function(){
                    var self = this;

                    // Utilisation d'une Image jquery en preload pour changer contenu ligtbox
                    // Permet de gérer le fadeOut tout en récupérant l'indispensable largeur de l'image.
                     self.$lightbox.fadeOut('slow', function(){
                        var currentImg = self.album[self.currentImageIndex];  
                        var preloadImg = new Image();
                        preloadImg.onload = function(){
                            $(preloadImg).addClass('lb-image');
                            $('.lb-image').replaceWith($(preloadImg));
                            $('.lb-container').width($(preloadImg).width() + 20);
                            $('.lb-nav').height($(preloadImg).outerHeight());
                            $(".lb-title h3").html(currentImg.title);
                            $(".lb-desc p").html(currentImg.desc);
                        }
                        preloadImg.src = currentImg.src;                  
                    });

                    self.$lightbox.fadeIn('slow');            
            },
            hideLightbox: function(){
                  var self = this;
                   self.$lightbox.fadeOut("slow", function(){
                      $('#lb-area').fadeOut("slow", function(){
                          $('#lb-area').remove();
                          $('#lightbox').remove();
                      });
                  }); 
            }

    }

    // Launch plugin //////////////////////////////////////////////////////////////////////////////////////////////////////////////
          return this.each(function(){
            var gal = Object.create(gallery);
            gal.init(options, this);
        });

      };


  })(jQuery);

