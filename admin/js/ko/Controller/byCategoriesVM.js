var viewmodelReady = false;

$(document).ready(function () {
	var BackendViewModel = function (categories, images) {
		var self = this;

		this.images = ko.observableArray();
		this.categories = ko.observableArray();

		this.selectedCategoryId = ko.observable();
		this.editSelectedCategory = ko.observable(false);
		this.newCategoryTitle = ko.observable();
		this.newCategoryDescription = ko.observable();
		this.refreshingImages = ko.observable(false);

		init(self, categories, images);

		// computed
		this.filteredImages = ko.computed(function(){
			if(self.selectedCategoryId() != 'all'){
				if(!self.selectedCategoryId()){
					return ko.utils.arrayFilter(self.images(), function(image) {
						return image.categories().length == 0;
					});
				}
				return ko.utils.arrayFilter(self.images(), function(image) {
					category = self.selectedCategoryId();
					categoryIds = image.categoryIds();
					inArray = $.inArray(category, categoryIds);
					return inArray != -1;
				});
			} else return self.images();
		}, this);

		this.activeCategories = ko.computed(function(){
			return ko.utils.arrayFilter(self.categories(), function(category) {
				return category.status() == 1 && category.id() != 'all';
			});
		}, this);

		this.selectedCategory = ko.computed(function(){
			filteredCategories = ko.utils.arrayFilter(self.categories(), function(category) {
				return category.id() == self.selectedCategoryId();
			});
			if(filteredCategories.length > 0){
				return filteredCategories[0];
			} else return false;
		}, this);

		// subscriptions
		this.selectedCategoryId.subscribe(function(){
			self.editSelectedCategory(false);
		});

		// function
		this.newCategory = function(){
			// make ajax call to add new category to database and use id of new category
			data = {
				title: self.newCategoryTitle(),
				description: self.newCategoryDescription()
			}
			newCategoryId = null;
			$.get( "server/php/databaseAccess/addCategory.php", data, function( result ) {
				parsedResult = $.parseJSON(result);
				if(parsedResult && parsedResult.id){
					newCategoryId = parsedResult.id;
					self.categories.push(new Category({
						id: newCategoryId,
						title: self.newCategoryTitle(),
						description: self.newCategoryDescription(),
						status: 1
					}));
					self.newCategoryTitle(null);
					self.newCategoryDescription(null);
				} else {
					alert('Es ist ein Fehler beim Anlegen der Kategorie aufgetreten.');
				}
			});
		}

		this.imageIsThumbnail = function(image){
			return ($.inArray(image, self.selectedCategory().thumbnails()) != -1);
		}

		this.toggleEditCategory = function(){
			if(self.editSelectedCategory()){
				self.editSelectedCategory(false);
			} else {
				self.editSelectedCategory(true);
			}
		}

		this.disableCategory = function(){
			self.selectedCategory().status(0);
		}

		this.enableCategory = function(){
			self.selectedCategory().status(1);
		}

		this.removeCategory = function(){
			$('#removeCategory').modal('show');
		}

		this.confirmRemoveCategory = function(){
			self.refreshingImages(true);
			data = {
				id: self.selectedCategory().id()
			}
			$.get( "server/php/databaseAccess/removeCategory.php", data, function( result ) {
				parsedResult = $.parseJSON(result);
				if(parsedResult && parsedResult.success){
					self.refreshingImages(false);
				} else {
					alert('Es ist ein Fehler beim Löschen der Kategorie aufgetreten.');
				}
			});
			self.categories.remove(self.selectedCategory());
			$('#removeCategory').modal('hide');
		}

		this.updateImages = function(){
			self.refreshingImages(true);
			$.get( "server/php/databaseAccess/getAllImages.php", function( result ) {
				images = $.parseJSON(result);
				if(images){
					viewmodelReady = false;
					self.images([]);
					self.categories([]);
					init(self, categories, images);
					viewmodelReady = true;
					self.refreshingImages(false);
				} else {
					alert('Es ist ein Fehler beim Aktualisieren der Bilder aufgetreten.');
				}
			});
		}

		this.setOptionDisable = function(option, item){
			if(item){
				ko.applyBindingsToNode(option, {enable: item.status}, item);
			}
		}

	};
	var backendViewModel = new BackendViewModel(categories, images);
	ko.applyBindings(backendViewModel);
	viewmodelReady = true;
});