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
			currentCategory = 'all';
		</script>

		<div class="container">
			<h1>Photo Blog</h1>
			<div class="row">

				<div class="col-sm-10" data-bind="foreach: activeCategories">
					<div>
						<a data-bind="attr: {href: 'category.php?categoryId='+id()}">
							<h3 data-bind="text: title"></h3>
						</a>
						<div class="clearfix">
							<!-- ko foreach: thumbnails -->
							<div class="image-wrap">
								<a data-bind="attr: {href: 'category.php?categoryId='+$parent.id()+'&imageId='+id()}">
									<img data-bind="attr: {src: 'admin/server/php/files/thumbnail/'+name()}" />
								</a>
							</div>
							<!-- /ko -->
							<div data-bind="if: $root.getNumberOfImagesInCategory($data)>thumbnails().length">
								<div class="image-wrap">
									<a data-bind="attr: {href: 'category.php?categoryId='+id()}">
										<span class="more">
											(<span data-bind="text: $root.getNumberOfImagesInCategory($data)"></span>)
										</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="panel panel-default">
						<div class="panel-heading">Neue Photos</div>
						<div class="panel-body">
							TODO
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

