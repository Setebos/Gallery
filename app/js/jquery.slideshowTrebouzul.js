(function($)
{
    $.fn.slideshowPlugin=function(options)
    {
    	var defauts={
    		'nbPic': 3,
    		'data' : null,
    		'callback' : null
    	};

    	var params=$.extend(defauts, options);

    	console.log("in plugin : " );
    	console.log(params.data[0].name);
    	var nbCat = params.data.length;

       this.each(function()
       {
           var container = $(this);

           //creation de la liste de categories
            var ulCat = $( document.createElement('ul') ); 
           ulCat.addClass('list-inline');
           container.append(ulCat);
           for (var i = 0 ; i < nbCat ; i++){
           	var liCat = $( document.createElement('li') ); 
           	var link = $("<a href='#'>"+  params.data[i].name +"</a>");
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