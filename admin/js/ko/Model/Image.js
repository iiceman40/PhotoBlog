var Image = function(data) {
	var self = this;

	// observables
	this.id = ko.observable(data.id);
	this.url = ko.observable(data.url);
	this.urlThumbnail = ko.observable(data.urlThumbnail);
	this.name = ko.observable(data.name);
	this.title = ko.observable(data.title);
	this.description = ko.observable(data.description);

	this.saving = ko.observable(false);

	// observable arrays
	this.categories = ko.observableArray();

	// computed observables
	this.categoriesJson = ko.computed(function(){
		return ko.toJSON($.map( self.categories(), function( value, index ) {
			return value.id();
		}));
	});

	this.categoryIds = ko.computed(function(){
		return $.map( self.categories(), function( value, index ) {
			return value.id();
		});
	});

	// subscriptions
	this.title.subscribe(function(){
		self.updateDB();
	});
	this.description.subscribe(function(){
		self.updateDB();
	});
	this.categories.subscribe(function(){
		self.updateDB();
	});

	// functions
	this.toggleCategory = function(category){
		if (self.categories.indexOf(category) < 0) {
			self.categories.push(category);
		} else {
			self.categories.remove(category);
		}
	}

	this.isSelectedCategory = function(category){
		return (self.categories.indexOf(category) >= 0);
	}

	this.updateDB = function(){
		if(viewmodelReady){
			self.saving(true);
			data = {
				id: self.id(),
				title: self.title(),
				description: self.description(),
				categories: self.categoriesJson()
			}
			$.get( "server/php/databaseAccess/updateImage.php", data, function( result ) {
				parsedResult = $.parseJSON(result);
				if(parsedResult && parsedResult.success){
					self.saving(false);
				} else {
					alert('Es ist ein Fehler beim Aktualisieren des Bildes aufgetreten.');
				}
			});
		}
	}

};