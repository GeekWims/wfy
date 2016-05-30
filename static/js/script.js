
function DragItem(id, type) {
	this.id = id;
	this.type = type;
}

var TYPE_PEOPLE_LIB = 'peopleLib';
var TYPE_MY_LIB = 'myLib';
var TYPE_WORD = 'word';
var TYPE_LIB_WORD = 'lib_word';

function allowDrop(ev) {
	ev.preventDefault();
}

function PLDrag(ev) {
	var dragItem = new DragItem(ev.target.id, TYPE_PEOPLE_LIB);
	ev.dataTransfer.setData("text", JSON.stringify(dragItem));
}

function MLDrop(ev) {
	ev.preventDefault();
	var dragItem = $.parseJSON(ev.dataTransfer.getData("text"));
	if (dragItem.type != TYPE_PEOPLE_LIB) return;
	var targetID = dragItem.id;
	var target = $('#'+targetID);
	
	var response = reqProc('/library/addMylibrary/' + target.data('id'), null);
	
	if (response.status == 'error') {
		alert(response.msg);
		return;
	}
	
	var myLibraryList = $('#myLibraryList');
	var targetClone = target.clone();
	
	targetClone.attr("ondragstart", 'MLDrag(event)');
	myLibraryList.append(targetClone);
}

function MLDrag(ev) {
	var dragItem = new DragItem(ev.target.id, TYPE_MY_LIB);
	ev.dataTransfer.setData("text", JSON.stringify(dragItem));
}

function PLDrop(ev) {
	ev.preventDefault();
	var dragItem = $.parseJSON(ev.dataTransfer.getData("text"));
	if (dragItem.type != TYPE_MY_LIB) return;
	var targetID = dragItem.id;
	var target = $('#'+targetID);
	
	var response = reqProc('/library/removeMylibrary/' + target.data('id'), null);
	
	if (response.status == 'error') {
		alert(response.msg);
		return;
	}
	
	target.remove();
}

function testDrop(ev) {
	ev.preventDefault();
}

function popLibItem(ev) {
	target = $('#'+ev.target.id);
	loadPopup('/wordForYou/library/view/'+target.data('id'));
}

function wordDrag(ev) {
	var dragItem = new DragItem(ev.target.id, TYPE_WORD);
	ev.dataTransfer.setData("text", JSON.stringify(dragItem));
	console.log('wordDrag Done;');
}

/*
 *  infinite Scroll
 */

function PLibraryLoad(page, ev) {
	var target = $('#peopleLibraryList');
	var title = $('#peopleLibraryTitle').val();
	if (page == 'next') {
		page = target.data('nextPage');
		$.ajax({
			url :'/wordForYou/library/getLibraryList/'+page+'/' + title,
			success :  function(response) {
				$(ev.target).parent().replaceWith(response); 
			}
		});
	} else {
		target.load('/wordForYou/library/getLibraryList/'+page+'/' + title);
	}
	target.data('nextPage',page * 1 + 1);
};

function MLibraryLoad(page, ev) {
	var target = $('#myLibraryList');
	var title = $('#myLibraryListTitle').val();
	var nextPage = target.data('page',page * 1 + 1);
	
	if (page == 'next') {
		page = target.data('nextPage');
		$.ajax({
			url :'/wordForYou/library/getMyLibraryList/'+page+'/' + title,
			success :  function(response) {
				$(ev.target).parent().replaceWith(response); 
			}
		});
	} else {
		target.load('/wordForYou/library/getMyLibraryList/'+page+'/' + title, function() {
			preCheckItem();
		});
	}
	target.data('nextPage',page * 1 + 1);
}

function WordLoad(page, ev, target, searchData) {
	if (target == null) {
		target = $('#wordList');
	} else {
		target = $('#'+target);
	}
	if (searchData == null) {
		searchData = $('#wordListSearchInput').val();		
	} else {
		searchData = $('#'+searchData).val();
	}
	
	var nextPage = target.data('page',page * 1 + 1);
	
	if (page == 'next') {
		page = target.data('nextPage');
		$.ajax({
			url :'/wordForYou/library/getWord/'+page+'/10/' + searchData,
			success :  function(response) {
				$(ev.target).parent().replaceWith(response); 
			},
			error : function(response) {
				console.log(response.responseText);
			}
		});
	} else {
		target.load('/wordForYou/library/getWord/'+page+'/10/' + searchData);
	}
	target.data('nextPage',page * 1 + 1);
}

PLibraryLoad(1);
MLibraryLoad(1);
WordLoad(1);

/*
 * 
 * 
 * 
 */

function playAudio(targetID, ev) {
	var btn = $(ev.target);
	var audio = document.getElementById('audio_' + targetID);
	audio.play();
	audio = $(audio);
	var icon = btn.children();
	console.log(btn);
	icon.removeClass('glyphicon-play');
	icon.addClass('glyphicon-stop');
	btn.attr('onclick', 'stopAudio(' + targetID + ', event)');
	
}

function stopAudio(targetID, ev) {
	var btn = $(ev.target);
	var audio = document.getElementById('audio_' + targetID);
	audio.load();
	audio = $(audio);
	var icon = btn.children('span');
	icon.removeClass('glyphicon-stop');
	icon.addClass('glyphicon-play');
	btn.attr('onclick', 'playAudio(' + targetID + ', event)');
} 


function popupItem(ev) {
	target = $(ev.target);
	loadPopup('/wordForYou/library/wordView/'+target.data('id'));
}



/*
 * 
 *  function for game
 * 
 * 
 */

function preCheckItem() {
	var myLibList = $('#myLibraryList');
	var myLibListItems = myLibList.children('li');
	var gameList = $('#wrapPlayLib');
	
	myLibListItems.each(function(){
		if (gameList.children('#' + $(this).attr('id')).length == 1) {
			listId = $(this).attr('id');
			console.log($('#'+listId+' input'));
			$('#'+listId+' input').prop('checked', true);
			return false;
		};
	});
}

function checkMLItem(ev) {
	var target = $(ev.target);
	var listItem = $(ev.target).parent();
	var isChecked = target.is(':checked');
	var wrap = $('#wrapPlayLib');
	var clone = wrap.children('#MLItem'+target.val());
	
	if (isChecked && clone.length) {
		alert('already checked');
		target.attr('checked', ':checked');
		return;
	} else if (isChecked && !clone.length) {
		wrap.append(listItem.clone());
	} else if (!isChecked && clone.length) {
		clone.remove();
	} else {
		return;
	}
} 


function loadGamePopup() {
	var wrap = $('#wrapPlayLib');
	var clone = wrap.children();
	
	if (!clone.length) {
		alert('Please check at least one library');
		return;
	}
	
	loadPopup('/wordForYou/game');
	
}

function getBestRecord() {
	$('#userinfo-bestRecord').load('/wordForYou/game/getTopScore');
}

function getPlayTime() {
	$('#userinfo-totalTimes').load('/wordForYou/game/getPlayTime');
}

getBestRecord();
getPlayTime();
