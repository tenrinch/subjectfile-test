<div wire:ignore.self class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content border border-danger">
			<div class="modal-body">
				<h1 class="text-center text-danger my-0">
					<i class="fas fa-exclamation-circle"></i><br>
				</h1>
				<h4 class="text-center my-0">Delete Confirmation!</h4>
				<p class="text-center text-gray-500 my-0">Are you sure you want to delete this data?</p>
			</div>
			
			<div class="button-container mx-auto mb-4">
				<button type="button" class="btn btn-danger" wire:click.prevent = "delete">Delete</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="$set('delete_id',null)">Cancel</button>
			</div>
		</div>
	</div>
</div>
