var viewmodelReady = false;

$(document).ready(function () {
	var FrontendViewModel = function (categories, images) {
		var self = this;

		this.selectedCategoryId = ko.observable(currentCategory);
		this.selectedImage = ko.observable();
		this.nextSelectedImage = ko.observable();

		this.images = ko.observableArray();
		this.categories = ko.observableArray();

		init(self, categories, images);

		// computed
		this.activeCategories = ko.computed(function(){
			return ko.utils.arrayFilter(self.categories(), function(category) {
				return category.status() == 1 && category.id() != 'all';
			});
		}, this);

		this.filteredImages = ko.computed(function(){
			if(self.selectedCategoryId() != 'all'){
				if(!self.selectedCategoryId()){
					return ko.utils.arrayFilter(self.images(), function(image) {
						return image.categories().length == 0;
					});
				}
				return ko.utils.arrayFilter(self.images(), function(image) {
					category = self.selectedCategoryId();
					categories = image.categoryIds();
					inArray = $.inArray(category, categories);
					return inArray != -1;
				});
			} else return self.images();
		}, this);

		// functions
		this.getNumberOfImagesInCategory = function(category){
			images = ko.utils.arrayFilter(self.images(), function(image) {
				categories = image.categoryIds();
				inArray = $.inArray(category.id(), categories);
				return inArray != -1;
			});
			return images.length;
		}

		this.selectImage = function(image){
			overlay = $('#imageOverlay');
			if(image){
				if(!self.selectedImage()){
					self.nextSelectedImage(image);
					overlay.css('opacity', 0).animate({'opacity': 1}, 500);
				} else {
					self.nextSelectedImage(image);
				}
				nextImage = $('#nextImage');
				nextImage.css('opacity', 0);
				$('#currentImage').animate({'opacity': 0}, 500);
				nextImage.animate({'opacity': 1}, 500, function(){
					self.selectedImage(image);
					$('#currentImage').css('opacity', 1);
					self.nextSelectedImage(null);
				});
			} else {
				overlay.animate({'opacity': 0}, 500, function(){
					self.selectedImage(null);
					self.nextSelectedImage(null);
				});
			}
		}

		this.deselectImage = function(){
			self.selectImage(null);
		}

		this.previousImage = function(image){
			filteredImages = self.filteredImages();
			currentIndex = filteredImages.indexOf(self.selectedImage());
			prevIndex = currentIndex - 1;
			prevImage = filteredImages[prevIndex];
			if(!prevImage){
				prevImage = filteredImages[filteredImages.length-1];
			}
			self.selectImage(prevImage);
		}

		this.nextImage = function(image){
			filteredImages = self.filteredImages();
			currentIndex = filteredImages.indexOf(self.selectedImage());
			nextIndex = currentIndex + 1;
			nextImage = filteredImages[nextIndex];
			if(!nextImage){
				nextImage = filteredImages[0];
			}
			self.selectImage(nextImage);
		}

	};
	var frontendViewModel = new FrontendViewModel(categories, images);
	ko.applyBindings(frontendViewModel);
	viewmodelReady = true;
});