<!DOCTYPE html>
<html lang="en" ng-app="PhotoBlog">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Photo Blog</title>

		<!-- Font -->
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
		<!-- Bootstrap -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/slate/bootstrap.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet">
		<!-- blueimp Gallery styles -->
		<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<?php include 'admin/templates/nav.php' ?>

		<script type="text/javascript">
			images = <?php include 'admin/server/php/databaseAccess/getAllImages.php' ?>;
			categories = <?php include 'admin/server/php/databaseAccess/getAllCategories.php' ?>;
			currentCategory = <?php echo $_REQUEST['categoryId'] ?>;
		</script>

		<div class="container">
			<h1>Photo Blog</h1>
			<div class="row">
				<div class="col-xs-10">
					<h2 data-bind="text: indexedCategories[currentCategory].title"></h2>
				</div>
				<div class="col-xs-2">
					<a href="index.php" class="btn btn-link pull-right"><span class="glyphicon glyphicon-arrow-left"></span> Zurück</a>
				</div>
			</div>
			<div data-bind="foreach: filteredImages">
				<div class="image-wrap">
					<a href="#" data-bind="click: $root.selectImage">
						<img data-bind="attr: {src: 'admin/server/php/files/thumbnail/'+name()}" />
					</a>
				</div>
			</div>
		</div>

		<div data-bind="if: selectedImage() || nextSelectedImage()">
			<div id="imageOverlay" data-bind="click: deselectImage">
				<div data-bind="if: selectedImage" class="imageLargeWrap">
					<img data-bind="attr: {src: 'admin/server/php/files/'+selectedImage().name()}, click: function(){return true}, clickBubble: false" id="currentImage" />
				</div>
				<div data-bind="if: nextSelectedImage" class="imageLargeWrap nextImage">
					<img data-bind="attr: {src: 'admin/server/php/files/'+nextSelectedImage().name()}, click: function(){return true}, clickBubble: false" id="nextImage" />
				</div>

				<div id="hud">

					<a href="#" data-bind="click: previousImage, clickBubble: false" class="left big"><span class="glyphicon glyphicon-chevron-left"></span></a>
					<a href="#" data-bind="click: nextImage, clickBubble: false" class="right big"><span class="glyphicon glyphicon-chevron-right"></span></a>
					<a href="#"  data-bind="click: deselectImage, clickBubble: false" class="closeLightbox big"><span class="glyphicon glyphicon-remove"></span></a>

					<div id="thumbnailsPagebrowser">
						<div data-bind="foreach: filteredImages, style: {width: filteredImages().length*115+'px'}" class="clearfix thumbnailsWrapper">
							<div data-bind="css: {active: $data == $root.selectedImage()}, click: $root.selectImage, clickBubble: false" class="image-wrap small">
								<img data-bind="attr: {src: 'admin/server/php/files/thumbnail/'+name()}" />
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<!-- knockout -->
		<script src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-3.0.0.js"></script>
		<!-- view model -->
		<script src="admin/js/ko/Service/initService.js"></script>
		<script src="admin/js/ko/Model/Image.js"></script>
		<script src="admin/js/ko/Model/Category.js"></script>
		<script src="admin/js/ko/Controller/frontendViewModel.js"></script>
	</body>
</html>

