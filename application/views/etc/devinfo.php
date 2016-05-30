<div class="modal fade" id="howtouseModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h4>
					Develop by Man Su Kim in South Korea
					More information, send to e mail  kim.create@gmail.com
				</h4>
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancel
				</button>
			</div>
		</div>
	</div>
	<script>

		$('#howtouseModal').on('hidden.bs.modal', function(e){
			$(this).remove();
		});
	</script>
</div>