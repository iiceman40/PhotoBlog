<!DOCTYPE HTML>
<!--
/*
 * jQuery File Upload Plugin AngularJS Demo 2.1.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2013, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
-->
<html lang="en">
<head>
	<!-- Force latest IE rendering engine or ChromeFrame if installed -->
	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta charset="utf-8">
	<title>PhotoBlog Backend</title>
	<meta name="description" content="File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for AngularJS. Supports cross-domain, chunked and resumable file uploads and client-side image resizing. Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Font -->
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
	<!-- Bootstrap styles -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/slate/bootstrap.min.css" rel="stylesheet">
	<!-- Generic page styles -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="../css/style.css">
	<!-- blueimp Gallery styles -->
	<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="css/jquery.fileupload.css">
	<link rel="stylesheet" href="css/jquery.fileupload-ui.css">

	<script type="text/javascript">
		var images = <?php include 'server/php/databaseAccess/getAllImages.php' ?>;
		var categories = <?php include 'server/php/databaseAccess/getAllCategories.php' ?>;
	</script>

	<!-- CSS adjustments for browsers with JavaScript disabled -->
	<noscript>
		<link rel="stylesheet" href="css/jquery.fileupload-noscript.css">
	</noscript>
	<noscript>
		<link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css">
	</noscript>
	<style>
		/* Hide Angular JS elements before initializing */
		.ng-cloak {
			display: none;
		}
	</style>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-fixed-top .navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Photo Blog - Upload</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="../">zurück zum Photo Blog</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="container">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="active">
			<a href="#categories" role="tab" data-toggle="tab" data-bind="click: updateImages">
				Kategorien <span class="glyphicon glyphicon-refresh" data-bind="visible: refreshingImages"></span>
			</a>
		</li>
		<li><a href="#sessions" role="tab" data-toggle="tab">Sessions</a></li>
		<li><a href="#upload" role="tab" data-toggle="tab">Upload</a></li>
	</ul>
	<br />
	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="categories"><?php include 'templates/byCategories.php' ?></div>
		<div class="tab-pane" id="sessions">Sessions</div>
		<div class="tab-pane" id="upload"><?php include 'templates/upload.php' ?></div>
	</div>

</div>

<?php include 'templates/removeCategoryModal.php' ?>

<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
	<div class="slides"></div>
	<h3 class="title"></h3>
	<a class="prev">‹</a>
	<a class="next">›</a>
	<a class="close">×</a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.12/angular.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/upload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/upload/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/upload/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="js/upload/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="js/upload/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="js/upload/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="js/upload/jquery.fileupload-validate.js"></script>
<!-- The File Upload Angular JS module -->
<script src="js/upload/jquery.fileupload-angular.js"></script>
<!-- The main application script for the upload-->
<script src="js/upload/app.js"></script>
<!-- ViewModel for byCategories view -->

<script src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-3.0.0.js"></script>
<script src="js/ko/Service/initService.js"></script>
<script src="js/ko/Model/Image.js"></script>
<script src="js/ko/Model/Category.js"></script>
<script src="js/ko/Controller/byCategoriesVM.js"></script>
</body>
</html>
