function init(self, categories, images){
	// init
	self.categories.push(new Category({id: 'all', title: 'Alle'}));
	self.indexedCategories = {};
	$.each(categories, function(key, value){
		newCategory = new Category(value);
		self.categories.push(newCategory);
		self.indexedCategories[value.id] = newCategory;
	});
	//console.log('categories', self.indexedCategories);

	self.indexedImages = {};
	$.each(images, function(key, value){
		newImage = new Image(value);
		if(value.categories){
			parsedCategories = $.parseJSON(value.categories);
			if(parsedCategories){
				for(i=0; i<parsedCategories.length; i++){
					id = parsedCategories[i];
					newImage.toggleCategory(self.indexedCategories[id]);
				}
			}
		}
		self.images.push(newImage);
		self.indexedImages[value.id] = newImage;
	});
	//console.log('images', self.indexedImages);

	// add image reference for each thumbnail in each category
	$.each(categories, function(key, value){
		parsedThumbnails = $.parseJSON(value.thumbnails);
		if(parsedThumbnails){
			for(i=0; i<parsedThumbnails.length; i++){
				id = parsedThumbnails[i];
				self.indexedCategories[value.id].toggleThumbnail(self.indexedImages[id]);
			}
		}
	});
}