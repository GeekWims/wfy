<div class="modal fade" id="popupLibraryCreate" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button> -->
				<h4 class="modal-title" id="myModalLabel"><input id="input-lib-title" class="form-control" name="title" type="text" value="" placeholder="Type title of library" requried/></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<form action="">
							<div class="input-group">
								<input id="" type="text" class="form-control"/>
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-search" onclick=""></span>
								</div>
							</div>
						</form>
						<div ondrop="addWordToLib(event)" ondragover="allowDrop(event)">
							<ul id="libraryItemList" class="list-group scroll-able" data-id="">
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						
						<form action="" onsubmit="WordLoad(1,event,'words','wordInput'); return false;">
							<div class="input-group">
								<input id="wordInput" type="text" class="form-control"/>
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-search" onclick="WordLoad(1,event,'words','wordInput')"></span>
								</div>
							</div>
						</form>
						<div ondrop="deleteItem(event)" ondragover="allowDrop(event)">
							<ul id="words" class="list-group scroll-able" data-id="">
								
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer"> 
				<button type="button" class="btn btn-success" onclick="save()">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
	<div style="display:none;">
		<form id="lib-form" action="/wordForYou/library/create_proc" method="post">
			
		</form>
	</div>
	<script>
		$('#popupLibraryCreate').on('hidden.bs.modal', function(e){
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
			if ($(ev.target).attr('id') != 'libraryItemList') return;
			var targetID = dragItem.id;
			var target = $('#'+targetID);
			var list = $(ev.target);
			var targetClone = target.clone();
			
			targetClone.attr("ondragstart", 'dragLibWord(event)');
			targetClone.attr('id', 'newLibItem' + targetClone.data('id'));
			targetClone.addClass('new-lib-item');
			list.append(targetClone);
		}
		
		function deleteItem(ev) {
			ev.preventDefault();
			var dragItem = $.parseJSON(ev.dataTransfer.getData("text"));
			if (dragItem.type != TYPE_LIB_WORD) return;
			var targetID = dragItem.id;
			var target = $('#' + targetID);
			var list = $(ev.target);
			
			
			target.remove();
		}
		
		function deleteItemBtn(targetID) {
			var target = $('#'+targetID);
			
			target.remove();
		}
		
		function save() {
			var newItems = $('.new-lib-item');
			var target = $('#lib-form');
			var input_tag = $('<input type="text" name="create_wid[]" />');
			var jEle = null;
			var lib_title = $('#input-lib-title');
			var title_val = (typeof lib_title.val() == "undefined") ? "" : String(lib_title.val()); 
			var errorMsg = '';
			var isErrorOccued = false;
			
			target.empty();
			
			title_val = title_val.trim();
			lib_title.val(title_val);
			
			if (!newItems.length) {
				errorMsg += 'Be required to add at least one word\n';
				isErrorOccued = true;
			}
			
			if (title_val == '') {
				errorMsg += 'Title is requred\n';
				isErrorOccued = true;
			}
			
			if (isErrorOccued) {
				alert(errorMsg);
				return;
			}
			
			newItems.each(function(index, element) {
				//input_tag.attr('name', 'wid_' + index);
				jEle = $(element);
				input_tag.attr('value', jEle.data('id'));
				target.append(input_tag.clone());
			});
			
			target.append(lib_title);
			
			target.submit();
		}
		
		$(document).ready(function() {
			$('#lib-form').ajaxForm({
				success : function(response) {
					console.log(response);
					alert("library is created");
					location.reload();
				},
				error : function(response) {
					console.log(response.responseText);
					alert('error occured');
				}
			});
		})
	</script>
</div>
