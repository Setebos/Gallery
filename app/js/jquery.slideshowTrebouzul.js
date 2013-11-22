(function($)
{
    $.fn.slideshowPlugin=function(options)
    {
    	var defauts={
    		'nbPic': 3,
    		'categories' : null,
    		'images' : null,
    		'callback' : null
    	};

    	var params=$.extend(defauts, options);

    	// recuperation de donnees issues des requetes php
    	var nbCat = params.categories.length;

       this.each(function()
       {
           var container = $(this);

           //creation de la liste de categories
           var sectionCat = $( document.createElement('sectionCaton'));
           sectionCat.addClass('categories'); 
           var divCatRow = $( document.createElement('div') ); 
           divCatRow.addClass('row added');
           var divCat = $( document.createElement('div') ); 
           divCat.addClass('col-md-8 col-md-offset-2');

           sectionCat.append(divCatRow);
           divCatRow.append(divCat);
           container.append(sectionCat);

           	var ulCat = $( document.createElement('ul') ); 
           	ulCat.addClass('list-inline');
           	divCat.append(ulCat);
           	for (var i = 0 ; i < nbCat ; i++){
	           	var liCat = $( document.createElement('li') ); 
	           	var link = $("<a href='#'>"+  params.categories[i].name +"</a>");
	           	liCat.append(link);
	           	ulCat.append(liCat);
           	}



           // creation de la liste d'images
           var section = $( document.createElement('section'));
           var divRow = $( document.createElement('div') ); 
           divRow.addClass('row added');
           var div_left = $( document.createElement('div') ); 
           div_left.addClass('col-md-2');
           var div_center = $( document.createElement('div') ); 
           div_center.addClass('col-md-8');
           var div_right = $( document.createElement('div') ); 
           div_right.addClass('col-md-2');


           section.append(divRow);
           divRow.append(div_left).append(div_center).append(div_right);
           container.append(section);

           var ul = $( document.createElement('ul') ); 
           ul.addClass('list-inline');
           div_center.append(ul);

           for (var i = 0 ; i < params.nbPic ; i++){
           	var li = $( document.createElement('li') ); 
           	var image = $("<img src='http://placehold.it/250x150'>");
           	li.append(image);
           	ul.append(li);
           }
       });

       return this;
    };






})(jQuery);
