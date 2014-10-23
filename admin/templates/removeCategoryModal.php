<!-- Modal -->
<div class="modal fade" id="removeCategory" tabindex="-1" role="dialog" aria-labelledby="removeCategoryLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Schließen</span></button>
				<h4 class="modal-title" id="myModalLabel">Kategorie löschen</h4>
			</div>
			<div class="modal-body">
				Soll die Kategorie <span data-bind="text: selectedCategory().title"></span> wirklich gelöscht werden?<br />
				(Zuordnungen zu
				<span data-bind="visible: filteredImages().length != 1"><span data-bind="text: filteredImages().length"></span> Bildern werden</span>
				<span data-bind="visible: filteredImages().length == 1">einem Bild wird</span>
				 aufgehoben)
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
				<button type="button" data-bind="click: confirmRemoveCategory" class="btn btn-primary">Kategorie löschen</button>
			</div>
		</div>
	</div>
</div>