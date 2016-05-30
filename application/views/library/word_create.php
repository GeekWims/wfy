
<div class="modal fade" id="word_create_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Create Word</h4>
			</div>
			<div class="modal-body">
				<div class="thumbnail text-center">
					<div class="row">
						<img id="word_img" style="width:300px; height: 200px;" src="http://placehold.it/300x200" alt="" />
						<form id="word_img_form" action="<?echo ROOT_URL ?>/upload/tmp_upload"
						method="post" accept-charset="utf-8" style="display: none;" >
							<input id="word_img_input" type="file" name="userfile" enctype="multipart/form-data"/>
							<input id="word_img_text" type="text" name="img"/>
						</form>
					</div>
					<div class="row">
						<div style="display:none">
							<form id="word_sound_form" action="<?echo ROOT_URL?>/upload/tmp_sound_upload" method="post" accept-charset="utf-8">
								<input id="word_sound_input" name="userfile" type="file" />
							</form>
							<audio id="word_sound_tag" src=""></audio>
						</div>
						<div class="col-md-2 col-md-offset-2">
							<label for="">Sound :</label>
						</div>
						<div class="col-md-4">
							<input id="word_sound_text" type="text" class="form-control" name="sound" readonly="readonly"/>
						</div>
						<div class="col-md-1">
							<button id="word_sound_play" class="btn btn-default">
								<span class="glyphicon glyphicon-play"></span>
							</button>
						</div>
						<div class="col-md-1">
							<button id="word_sound_eject" class="btn btn-default">
								<span class="glyphicon glyphicon-eject"></span>
							</button>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label for="" class="col-md-2 col-md-offset-2">word : </label>
							<div class="col-md-4">
								<input id="word_create_word" name="word" type="text" class="form-control" placeholder="(Required)"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label for="" class="col-md-2 col-md-offset-2">mean : </label>
							<div class="col-md-4">
								<textarea class="form-control" name="mean" id="word_create_mean" cols="15" rows="5">(Required)</textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label for="" class="col-md-2 col-md-offset-2">Example : </label>
							<div class="col-md-4">
								<textarea class="form-control" name="example" id="word_create_example" cols="15" rows="5"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="wordCreateSave()">
					Save
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="wordCreateCancel()">
					Close
				</button>
				<form id="word_create_form" action="<?echo ROOT_URL?>/library/create_word_proc"
				method="post" accept-charset="utf-8" style="display: none;"  enctype="multipart/form-data"></form>
			</div>
		</div>
	</div>
	
<script type="text/javascript" charset="utf-8">

	$('#word_create_modal').on('hidden.bs.modal', function(e){
		$(this).remove();
	});


	function sound_control(target, stat) {
	var audio = document.getElementById(target);

	switch (stat) {
		case "play" :
			audio.play();
			break;
		case "pause" :
			audio.pause();
			break;
		case "stop" :
			audio.load();
			break;
		}
	}

	$('#search_word').keyup(function(e) {
		if (e.which == 13) {
			if ($('#search_word').val() == null)
				getWord('null', false);
			else
				getWord($('#search_word').val(), false);
		}
	});

	$('#btn-search').click(function(e) {
			if ($('#search_word').val() == '')
				getWord('null', true);
			else
				getWord($('#search_word').val(), false);
	});

	function dropdown(target) {
		$('.word-list-item').each(function() {
			if(!$(this).is($(target).parent())) $(this).removeClass('open');
			});
		$(target).parent().toggleClass('open');
	}

	$(function() {
	/*
	// dropdown open/close function on button
	$('.word-list-item').on('click', function (event) {
	console.log('clicked');
	$(this).toggleClass('open');
	});

	// dropdown open/close function in page
	$('body').on('click', function (e) {
	console.log(e.target);
	});

	*/
	//폼전송
	$('#word_img_form').ajaxForm({
		//보내기전 validation check가 필요할경우
		beforeSubmit : function(data, frm, opt) {
			return true;
		},
		//submit이후의 처리
		success : function(responseText, statusText) {
			$('#word_img').attr('src', responseText);
			$('#word_img_text').attr('value', responseText);
		},
		//ajax error
		error : function(responseText, statusText) {
			alert(responseText['responseText']);
		//			console.log(responseText);
		}
	});
	
	$('#word_sound_form').ajaxForm({
		//보내기전 validation check가 필요할경우
		beforeSubmit : function(data, frm, opt) {
			return true;
		},
	//submit이후의 처리
		success : function(responseText, statusText) {
			$('#word_sound_text').attr('value', responseText);
			$('#word_sound_tag').attr('src', responseText);
		},
	//ajax error
		error : function(responseText, statusText) {
			alert(responseText['responseText']);
			//			console.log(responseText);
		}
	});

	$('#word_create_form').ajaxForm({
		//보내기전 validation check가 필요할경우
		beforeSubmit : function(data, frm, opt) {
			return true;
		},
		//submit이후의 처리
		success : function(responseText, statusText) {
			console.log('responseText:' + responseText);
			console.log('responseText:' + responseText['responseText']);
		},
		//ajax error
		error : function(responseText, statusText) {
			alert(responseText);
			alert(responseText['responseText']);
			console.log('responseText:' + responseText);
			console.log('responseText:' + responseText['responseText']);
		}
	});

	$('#word_sound_play').click(function() {
		var btn_icon = $('#word_sound_play>span');
		var audio = document.getElementById("word_sound_tag");
	
	
		if(btn_icon.hasClass('glyphicon-play')) {
			audio.play();
			
			btn_icon.removeClass('glyphicon-play');
			btn_icon.addClass('glyphicon-pause');
		} else {
			audio.pause();
		
			btn_icon.removeClass('glyphicon-pause');
			btn_icon.addClass('glyphicon-play');
		}
	});

	});

	$('#word_sound_input').change(function() {
		$('#word_sound_form').submit();
	});

	$('#word_sound_eject').click(function() {
		$('#word_sound_input').click();
	});

	$('#word_img_input').change(function() {
		$('#word_img_form').submit();
	});

	$('#word_img').click(function() {
		$('#word_img_input').click();
	});

	function wordCreateClean() {
		$('#word_img').attr('src', 'http://placehold.it/300x200');
		$('#word_sound').attr('src', '');
		$('#word_create_word').val('');
		$('#word_create_mean').val('required');
		$('#word_sound_text').val('');
	}

	function wordCreateCancel() {
		wordCreateClean();
	}

	function wordCreateSave() {
		var form = $('#word_create_form');
		var img = $('#word_img_text');
		var word = $('#word_create_word');
		var mean = $('#word_create_mean');
		var sound = $('#word_sound_text');
		var example = $('#word_create_example');
		var mean_val = mean.val();

		if (word.val() == '' || mean.val() == '') {
			alert('There is blank item. Fill all item');
			return;
		}

		// Clone the "real" input element
		var cloned = img.clone(true);
		// Put the cloned element directly after the real element
		// (the cloned element will take the real input element's place in your UI
		// after you move the real element in the next step)
		img.hide();
		cloned.insertAfter(img);
		// Move the real element to the hidden form - you can then submit it
		form.append(img);

		cloned = word.clone(true);
		word.hide();
		cloned.insertAfter(word);
		// Move the real element to the hidden form - you can then submit it
		form.append(word);

		cloned = mean.clone(true);
		mean.hide();
		cloned.insertAfter(mean);
		// Move the real element to the hidden form - you can then submit it
		form.append(mean);

		mean.val(mean_val);
		cloned.val(mean_val);

		cloned = sound.clone(true);
		sound.hide();
		cloned.insertAfter(sound);
		form.append(sound);

		cloned = example.clone(true);
		example.hide();
		cloned.insertAfter(example);
		form.append(example);

		form.submit();
		form.empty();

		alert('word Created');

		wordCreateCancel();
	}
</script>
</div>