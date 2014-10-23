var Category = function(data) {
	var self = this;

	// observables
	this.id = ko.observable(data.id);
	this.title = ko.observable(data.title);
	this.description = ko.observable(data.description);
	this.status = ko.observable(data.status);

	this.saving = ko.observable(false);

	// observable arrays
	this.thumbnails = ko.observableArray();

	// computed observables
	this.optionLabel = ko.computed(function(){
		if(self.status() == 0)
			return self.title() + ' (disabled)';
		else return self.title()
	});

	this.thumbnailsJson = ko.computed(function(){
		return ko.toJSON($.map( self.thumbnails(), function( value, index ) {
			return value.id();
		}));
	});

	// subscriptions
	this.title.subscribe(function(){
		self.updateDB();
	});
	this.description.subscribe(function(){
		self.updateDB();
	});
	this.status.subscribe(function(){
		self.updateDB();
	});
	this.thumbnails.subscribe(function(){
		self.updateDB();
	});

	// functions
	this.toggleThumbnail = function(image){
		if (self.thumbnails.indexOf(image) < 0) {
			self.thumbnails.push(image);
		} else {
			self.thumbnails.remove(image);
		}
	}

	this.updateDB = function(){
		if(viewmodelReady){
			self.saving(true);
			data = {
				id: self.id(),
				title: self.title(),
				description: self.description(),
				status: self.status(),
				thumbnails: self.thumbnailsJson()
			}
			$.get( "server/php/databaseAccess/updateCategory.php", data, function( result ) {
				parsedResult = $.parseJSON(result);
				if(parsedResult && parsedResult.success){
					self.saving(false);
				} else {
					alert('Es ist ein Fehler beim Aktualisieren der Kategorie aufgetreten.');
				}
			});
		}
	}

};