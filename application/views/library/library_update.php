<div class="modal fade" id="popupLibraryView" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button> -->
				<h4 class="modal-title" id="myModalLabel"><input id="title_input" class="form-control" name="title" type="text" value="<?=$lib->title?>" requried/></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<form action="" onsubmit="alert('not implement');return false;">
							<div class="input-group">
								<input id="" type="text" class="form-control"/>
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-search" onclick="WordLoad(1,event,'words','wordInput')"></span>
								</div>
							</div>
						</form>
						<div ondrop="addWordToLib(event)" ondragover="allowDrop(event)">
							<ul id="libraryItemList" class="list-group scroll-able" data-id="<?=$lib->lid?>">
							<?
							foreach ($items as $key => $value) {
								?>
								<li id="libItem<?=$value->wid?>" class="list-group-item" draggable="true" ondragstart="dragLibWord(event)" data-id=<?=$value->id?> ondblclick="popupItem(event)">
									<img src="<?=$value->img?>" style="width:25px;height:25px;" alt="" />
									<?=$value->word?>
									<div class="pull-right">
										<audio id="audio_<?=$value->wid?>" src="<?=$value->sound?>">TEST</audio>
				 						<button class="btn btn-default btn-sm" onclick="playAudio(<?=$value->wid?>, event)">
											<span class="glyphicon glyphicon-play"></span>
										</button>
										<!-- <button class="btn btn-danger btn-sm" onclick="deleteItemBtn('libItem<?=$value->wid?>')">
											<span class="glyphicon glyphicon-trash"></span>
										</button> -->
									</div>
									<div class="clearfix"></div>
								</li>
								<?
							}
							?>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						
						<form action="" onsubmit="WordLoad(1,event,'words','wordInput');return false;">
							<div class="input-group">
								<input id="wordInput" type="text" class="form-control"/>
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-search" onclick="WordLoad(1,event,'words','wordInput')"></span>
								</div>
							</div>
						</form>
						<div ondrop="deleteItem(event)" ondragover="allowDrop(event)">
							<ul id="words" class="list-group scroll-able" data-id="<?=$lib->lid?>">
								
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer"><!-- 
				<button type="button" class="btn btn-success">Save</button> -->
				<button type="button" class="btn btn-danger" onclick="deleteLibrary(<?=$lib->lid?>)">Delete</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
	<div style="display:none;">
		
	</div>
	<script>
		$('#popupLibraryView').on('hidden.bs.modal', function(e){
			$(this).remove();
		});
		
		WordLoad(1,event,'words','wordInput');
				
		function dragLibWord(ev) {
			var dragItem = new DragItem(ev.target.id, TYPE_LIB_WORD);
			ev.dataTransfer.setData("text", JSON.stringify(dragItem));
		}
				
		function addWordToLib(ev) {
			ev.preventDefault();
			var dragItem = $.parseJSON(ev.dataTransfer.getData("text"));
			if (dragItem.type != TYPE_WORD) return;
			var targetID = dragItem.id;
			var target = $('#'+targetID);
			var list = $(ev.target);
			var targetClone = target.clone();
			
			var response = reqProc('/library/addWordToLib/' + target.data('id') + '/' + list.data('id'), null);
			
			if (response.status == 'error') {
				alert(response.msg);
				return;
			}
			
			targetClone.attr("ondragstart", 'dragLibWord(event)');
			list.append(targetClone);
		}
		
		function deleteItem(ev) {
			ev.preventDefault();
			var dragItem = $.parseJSON(ev.dataTransfer.getData("text"));
			if (dragItem.type != TYPE_LIB_WORD) return;
			var targetID = dragItem.id;
			var target = $('#' + targetID);
			var list = $(ev.target);
			
			var response = reqProc('/library/delItem/' + target.data('id'), null);
			
			if (response.status == 'error') {
				alert(response.msg);
				return;
			}
			
			target.remove();
		}
		
		function deleteItemBtn(targetID) {
			var target = $('#'+targetID);
			
			var response = reqProc('/library/delItem/' + target.data('id'), null);
			
			if (response.status == 'error') {
				alert(response.msg);
				return;
			}
			target.remove();
		}
		
		function deleteLibrary($lid) {
			
			if (!confirm("정말로 삭제하시겠습니까?")) {
				return;
			}
			
			var response = reqProc('/library/delete/' + $lid, null);
			
			if (response.status == 'error') {
				console.log(response.msg);
				alert(response.msg);
				return;
			}
			
			$('#popupLibraryView').modal('hide');
						
			PLibraryLoad(1);
			MLibraryLoad(1);
		}
	</script>
</div>
