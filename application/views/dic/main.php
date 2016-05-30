<div class="col-md-10 col-md-offset-1">
	<div class="row">
		<div class="row">
			<div class="col-md-12">
				<h3>Word</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form id="word-search-form" action="" onsubmit="return false;">
					<div class="input-group">
						<input class="form-control" type="text" id="search_word" placeholder="Search word" aria-describedby="word-addon" />
						<span class=" input-group-btn" id="word-addon">
							<button id="btn-search" class="btn btn-defualt">
								<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							</button> </span>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group" id="word-list-group">
					<li class="list-group-item">
						<p id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Cras justo odio
							<span class="caret"></span>
						</p>
						<div class="dropdown-menu" role="menu" aria-labelledby="dLabe2">
							<div class="thumbnail text-center">
								<img src="http://placehold.it/150x100" alt="" />
								<div class="caption">
									<h3>Label</h3>
									<p>
										explain
									</p>
									<button class="btn btn-primary btn-sm">
										ADD
									</button>
								</div>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<p id="dLabe2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Cras justo odio
							<span class="caret"></span>
						</p>
						<div class="dropdown-menu" role="menu" aria-labelledby="dLabe2">
							<div class="thumbnail text-center">
								<img src="http://placehold.it/150x100" alt="" />
								<div class="caption">
									<h3>Label</h3>
									<p>
										explain
									</p>
								</div>
								<button class="btn btn-primary bnt-sm">
									ADD
								</button>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						Dapibus ac facilisis in
						<span class="caret"></span>
					</li>
					<li class="list-group-item">
						Morbi leo risus
						<span class="caret"></span>
					</li>
					<li class="list-group-item">
						Porta ac consectetur ac
						<span class="caret"></span>
					</li>
					<li class="list-group-item">
						Vestibulum at eros
						<span class="caret"></span>
					</li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<ul id="pagination" class="pagination">
					<li>
						<a href="#" aria-label="Previous"> <span aria-hidden="true">&laquo;</span> </a>
					</li>
					<li>
						<a href="#">1</a>
					</li>
					<li>
						<a href="#">2</a>
					</li>
					<li>
						<a href="#">3</a>
					</li>
					<li>
						<a href="#">4</a>
					</li>
					<li>
						<a href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
					Create word
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="wordCreateCancel()">
					Close
				</button>
				<button type="button" class="btn btn-primary" onclick="wordCreateSave()">
					Save
				</button>

				<form id="word_create_form" action="<?echo ROOT_URL?>/library/create_word"
				method="post" accept-charset="utf-8" style="display: none;"  enctype="multipart/form-data"></form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
function getWord(search_word, isAll, offset) {
	if (offset == null) offset = 0;
	$.getJSON( "<? echo ROOT_URL ?>/library/getword/" + search_word + "/10/"+offset+"/" + isAll, function( data ) {
		// list tags
		var target = $('#word-list-group');
		var li = $('<li class="list-group-item word-list-item"></li>');
		//var p = $('<p data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></p>');
		var p = $('<p aria-haspopup="true" aria-expanded="false"></p>');
		var caret = $('<span class="caret"></span>');
		var dropdown_menu = $('<div class="dropdown-menu" role="menu" aria-labelledby=""></div>');
		var thumbnail = $('<div class="thumbnail text-center"></div>');
		var img = $('<img src="" alt="" />');
		var caption = $('<div class="caption"></div>');
		var word = $('<h3></h3>');
		var mean = $('<p></p>');
		var example = $('<p></p>');
		//var btn_add = $('<button class="btn btn-primary btn-sm btn-dic-word-add">Add</button>');
		var sound = $('<audio></audio>');
		var sound_play_btn = $('<button id="" style="z-index:1000;" class="btn btn-default btn-sound-play"><span class="glyphicon glyphicon-play"></span></button>');
		var sound_pause_btn = $('<button id="" class="btn btn-default btn-sound-pause"><span class="glyphicon glyphicon-pause"></span></button>');
		var sound_stop_btn = $('<button id="" class="btn btn-default btn-sound-stop"><span class="glyphicon glyphicon-stop"></span></button>');
	
		// target variable
		var audio_target = '';
		var dropdown_target = '';
	
		// pagination tags
		var pagination = $('#pagination');
		var prev = $('<li><a href="#" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a></li>');
		var next = $('<li><a href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a></li>');
		var page = $('<li></li>');
		var aTag = $('<a href=""></a>');
		var page_size = data.length / 10 + 1;
	
		target.empty();
		pagination.empty();
		pagination.append(prev);
		$.each( data, function( key, val ) {
		page.empty();
		li.empty();
		caption.empty();
		thumbnail.empty();
		dropdown_menu.empty();
		p.empty();
	
		// targets
		audio_target = 'audio' + key;
		dropdown_target = 'dLabel' + key;
	
		// generate word item
		p.attr('onclick', 'dropdown(this);');
		p.attr('id', 'dLabel' + key);
		p.text(val['word']);
		dropdown_menu.attr('id', dropdown_target);
		dropdown_menu.attr('aria-labelledby', 'dLabel' + key);
		img.attr('src', val['img']);
		word.text(val['word']);
		mean.text(val['mean']);
		example.text(val['example']);
		sound.attr('id', audio_target);
		sound.attr('src', val['sound']);
		sound.hide();
		sound_play_btn.attr('data-target', audio_target);
		sound_play_btn.attr('onclick', 'sound_control("' + audio_target + '", "play")');
		sound_pause_btn.attr('data-target', audio_target);
		sound_pause_btn.attr('onclick', 'sound_control("' + audio_target + '", "pause")');
		sound_stop_btn.attr('data-target', audio_target);
		sound_stop_btn.attr('onclick', 'sound_control("' + audio_target + '", "stop")');
		//
		// btn_add.attr('data-wid', val['wid']);
		// btn_add.attr('data-word', val['word']);
		// btn_add.attr('data-mean', val['mean']);
		// btn_add.attr('data-sound', val['sound']);
		// btn_add.attr('data-img', val['img']);
		// btn_add.attr('data-example', val['example']);
		//
		// btn_add.attr('onclick', 'add_item_to_lib(this)');
		//
		p.append(caret);
		li.append(p);
		thumbnail.append(img);
		caption.append(sound);
		caption.append(sound_play_btn);
		caption.append(sound_pause_btn);
		caption.append(sound_stop_btn);
		caption.append(word);
		caption.append(mean);
		caption.append(example);
		//caption.append(btn_add);
		thumbnail.append(caption);
		dropdown_menu.append(thumbnail);
		li.append(dropdown_menu);
		target.append(li.clone());
	});

	for (var i = 1; i <= page_size; i++) {
		page.empty();
	
		// generate pagination
		aTag.text(i);
		aTag.attr('onclick', 'getWord(' + search_word + ', false, ' + i +'); return false;');
		page.append(aTag);
		pagination.append(page.clone());
		}
	
		pagination.append(next);
	});
}

getWord("null", "true");

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

	console.log("test");

	if(btn_icon.hasClass('glyphicon-play')) {
	audio.play();

	console.log("test2");

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
	console.log($.get('<?echo ROOT_URL?>
		/upload/emptyTmp'));
		}

		function wordCreateSave() {
		var form = $('#word_create_form');
		var img = $('#word_img_input');
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

		wordCreateCancel();
		}
</script>