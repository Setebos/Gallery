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
           var divCatRow = $( document.createElement('div') ); 
           divCatRow.addClass('row');
           var divCat = $( document.createElement('div') ); 
           divCat.addClass('col-md-8 col-md-offset-2');
           divCatRow.append(divCat);
           container.append(divCatRow);

           	var ulCat = $( document.createElement('ul') ); 
           	ulCat.addClass('list-inline');
           	divCatRow.append(ulCat);
           	for (var i = 0 ; i < nbCat ; i++){
	           	var liCat = $( document.createElement('li') ); 
	           	var link = $("<a href='#'>"+  params.categories[i].name +"</a>");
	           	liCat.append(link);
	           	ulCat.append(liCat);
           	}



           // creation de la liste d'images
           var ul = $( document.createElement('ul') ); 
           ul.addClass('list-inline');
           container.append(ul);

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