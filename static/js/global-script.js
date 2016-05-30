
var target = $("#popupWrap");
var SERVER_ROOT_URL = '/wordForYou';

function loadPopup(argUrl) {
	var jqueryData;
	
	if (argUrl != null) {
	}
	
	$.ajax({
		url : argUrl,
		async : false,
		success : function(data, txt, jqXHR) {
			jqueryData = $(data);
			$('#popup-container').append(jqueryData);
		},
		error : function(response) {
			console.log(response.responseText);
		}
	});
			
	jqueryData.modal();
}


// request server action and get response to act
function reqProc(serverURL, args) {
	var response = {msg : 'did not loaded', status : 'error'};

	$.ajax({
		async : false,
		url: SERVER_ROOT_URL + serverURL,
		data: args,
		beforesend : function() {
			loadingModal("show");
		},
		success : function(result,status,xhr) {
			console.log(result);
			if (!isJsonType(result)) {
				response.status = 'error';
				response.msg = 'Server returned Empty data';
				console.log(result);
			}
			else response = $.parseJSON(result);
		},
		error : function(xhr,status,error) {
			response.status = 'error';
			response.msg = xhr.responseText;
			console.log(xhr.responseText);
		},
		complete : function() {
			loadingModal("hide");
		}
	});
	
	return response;
}

function isJsonType(str) {
	try {
		$.parseJSON(str);
	} catch (e) {
		return false;
	}
	return true;
}

// show or hide
function loadingModal(action) {
	if (action == "show")
		$('#loadingModal').modal("show");
	else
		$('#loadingModal').modal("hide");	
}
