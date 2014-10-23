<div class="row">

	<div class="col-sm-3">
		<div class="panel panel-default">
			<div class="panel-heading">Kategorien</div>
			<div class="panel-body">
				<select data-bind="value: selectedCategoryId, options: categories, optionsText: 'optionLabel', optionsValue: 'id', optionsCaption: 'Keine'" class="form-control"></select><br />
				<div>
					<div data-bind="if: selectedCategory() && selectedCategoryId() != 'all'">
						<span class="pull-right">
							<span data-bind="visible: selectedCategory().saving" class="glyphicon glyphicon-refresh"></span>
							<a href="#" data-bind="click: toggleEditCategory" title="Kategorie bearbeiten"><span class="glyphicon glyphicon-edit"></span></a>
							<a href="#" data-bind="click: disableCategory, visible: $root.selectedCategory().status() == 1" title="Kategorie deaktivieren"><span class="glyphicon glyphicon-ban-circle"></span></a>
							<a href="#" data-bind="click: enableCategory, visible: $root.selectedCategory().status() == 0" title="Kategorie aktivieren"><span class="glyphicon glyphicon-ok-circle"></span></a>
							<a href="#" data-bind="click: removeCategory" title="Kategorie löschen"><span class="glyphicon glyphicon-remove"></span></a>
						</span>
						<div data-bind="visible: !editSelectedCategory()">
							<h4 data-bind="text: selectedCategory().title"></h4>
							<div data-bind="text: selectedCategory().description"></div>
						</div>
						<div data-bind="visible: editSelectedCategory">
							<input data-bind="value: selectedCategory().title" class="form-control"/><br />
							<textarea data-bind="value: selectedCategory().description" class="form-control"></textarea>
						</div>
						<div>
							<h5>Vorschaubilder:</h5>
							<div data-bind="foreach: selectedCategory().thumbnails" class="clearfix">
								<div class="image-wrap small">
									<a href="#" data-bind="click: $root.selectedCategory().toggleThumbnail" title="Vorschaubild abwählen">
										<img data-bind="attr: {src: 'server/php/files/thumbnail/'+name()}" />
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Neue Kategorie</div>
			<div class="panel-body">
				<input data-bind="value: newCategoryTitle" class="form-control" placeholder="Kategorietitel" /><br />
				<textarea data-bind="value: newCategoryDescription" class="form-control" placeholder="Beschreibung der Kategorie"></textarea><br />
				<a href="#" data-bind="click: newCategory" class="btn btn-default btn-block"><span class="glyphicon glyphicon-plus"></span> neue Kategorie anlegen</a>
			</div>
		</div>
	</div>

	<div class="col-sm-9">
		<table class="table table-striped">
			<tbody data-bind="foreach: filteredImages">
				<tr>
					<td width="220">
						<span class="image-wrap">
							<a href="#" title="">
								<img data-bind="attr: {src: 'server/php/files/thumbnail/'+name()}"/>
							</a>
						</span>
					</td>
					<td>
						<div class="form-group">
							<input data-bind="value: title" class="form-control" />
						</div>
						<div class="form-group">
							<textarea data-bind="value: description" class="form-control" rows="4"></textarea>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="dropdown">
									<button class="btn btn-default" id="category-dropdown" role="button" data-toggle="dropdown" href="#">Kategorien bearbeiten <span class="caret"></span></button>
									<ul data-bind="foreach: $root.activeCategories" id="menu1" class="dropdown-menu" role="menu" aria-labelledby="category-dropdown">
										<li role="presentation">
											<a href="#" role="menuitem" tabindex="-1" data-bind="click: $parent.toggleCategory">
												<span data-bind="text: title"></span>
												<span data-bind="visible: $parent.isSelectedCategory($data)" class="glyphicon glyphicon-ok"></span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div data-bind="foreach: categories" class="col-sm-8">
								<span data-bind="text: title" class="badge"></span>
							</div>
						</div>
					</td>
					<td width="50">
						<span data-bind="if: $root.selectedCategory() && $root.selectedCategory().id() != 'all'">
							<a href="#" data-bind="click: $root.selectedCategory().toggleThumbnail, attr: {title: ($root.imageIsThumbnail($data)) ? 'als Vorschaubild abwählen' : 'als Vorschaubild festlegen'}, style: { opacity: $root.imageIsThumbnail($data) ? '1.0' : '0.5' }">
								<span class="glyphicon glyphicon-picture"></span>
							</a>
						</span>
						<span data-bind="visible: saving" class="glyphicon glyphicon-save" title="saving"></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

</div>