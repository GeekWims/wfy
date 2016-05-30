<!doctype html>
<!-- Github test -->
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Word For You</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="<?echo JS_URL?>/ajaxform.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="<?echo CSS_URL?>/style.css">
		<link rel="stylesheet" href="<?echo CSS_URL?>/game.css">
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<img src="<?=IMG_URL ?>/unknown.png" style="width:50px;" alt="" />
					<span id="userinfo-nickname" class="label label-info">Guest</span>
					<span id="userinfo-bestRecord" class="label label-info">Best Record</span>
					<span id="userinfo-totalTimes" class="label label-info">Total Study Times</span>
					<button class="btn btn-default btn-sm" onclick="
			loadPopup('/wordForYou/auth/popupLogin');">
						<span class="glyphicon glyphicon-log-in"></span> Sign in</button>
					<button class="btn btn-default" onclick="loadGamePopup()">
						Game Start
					</button>
				</div>
			</div>
			<div class="row"></div>
			<div class="row">
				<div class="col-md-4 main-component">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">People Library</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-10">
								<div class="row">
									<form action="">
										<div class="input-group">
											<input type="text" class="form-control"/>
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-search" onclick=""></span>
											</div>
										</div>
									</form>
								</div>
								<div class="row scroll-able" ondrop="PLDrop(event)" ondragover="allowDrop(event)">
									<ul id="myLibreryList" class="list-group">
										<li class="list-group-item" draggable="true" ondragstart="PLDrag(event)">Drag Test</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 main-component">
					<div class="panel panel-default">
						<div class="panel-heading" ondrop="testDrop(event)" ondragover="allowDrop(event)">
							<h3 class="panel-title">My Library</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-10">
								<div class="row">
									<form action="">
										<div class="input-group">
											<input type="text" class="form-control"/>
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-search" onclick=""></span>
											</div>
										</div>
									</form>
								</div>
								<div class="row scroll-able" ondrop="MLDrop(event)" ondragover="allowDrop(event)">
									<ul id="myLibreryList" class="list-group">
										<li class="list-group-item">1</li>
										<li class="list-group-item">2</li>
										<li class="list-group-item">3</li>
										<li class="list-group-item">4</li>
										<li class="list-group-item">5</li>
										<li class="list-group-item">6</li>
										<li class="list-group-item">7</li>
										<li class="list-group-item">8</li>
										<li class="list-group-item">9</li>
										<li class="list-group-item">10</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 main-component">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Word Storage</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-10">
								<div class="row">
									<form action="">
										<div class="input-group">
											<input type="text" class="form-control"/>
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-search" onclick=""></span>
											</div>
										</div>
									</form>
								</div>
								<div class="row scroll-able">
									<ul id="wordList" class="list-group">
										<li class="list-group-item">1</li>
										<li class="list-group-item">2</li>
										<li class="list-group-item">3</li>
										<li class="list-group-item">4</li>
										<li class="list-group-item">5</li>
										<li class="list-group-item">6</li>
										<li class="list-group-item">7</li>
										<li class="list-group-item">8</li>
										<li class="list-group-item">9</li>
										<li class="list-group-item">10</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<small class="pull-left"><a href="#" onclick="loadPopup('/wordForYou/etc/devinfo')">Developer Information</a></small>
				<small class="pull-right"><a href="#" onclick="loadPopup('/wordForYou/etc/howtouse')">How to enjoy &#38; study</a></small>
			</div>
		</div>
		<!-- loadingModal -->
		<div id="loadingModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
			<div class="modal-dialog modal-sm">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
					</div>
					<div class="modal-body" style="background-color: RGBA(0,0,0,0)">
						<div class="col-md-6 col-md-offset-3">
							<img class="img-responsive" src="<?=IMG_URL?>/loadingL.gif" alt="" />
						</div>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<div id="popup-container" style="">
			
		</div>
		<!-- wrapper of checked Item -->
		<div style="display:none">
			<div id="wrapPlayLib">
				<li id="MLItem35" class="list-group-item cursor_pointer" draggable="true" ondragstart="MLDrag(event)" data-id="35" ondblclick="popLibItem(event)">
					<input type="checkbox" class="MLItemCheckbox" name="toPlayLib[]" value="35" ondblclick="event.stopPropagation();" onchange="checkMLItem(event)">
					aaaaa	</li>
			</div>
		</div>
		<script src="<?=JS_URL ?>/global-script.js"></script>
		<script src="<?=JS_URL ?>/guest-script.js"></script>
		<script>
			loadPopup('/wordForYou/auth/popupLogin');

			function loadGamePopup() {
				var wrap = $('#wrapPlayLib');
				var clone = wrap.children();

				if (!clone.length) {
					alert('Please check at least one library');
					return;
				}

				loadPopup('/wordForYou/game');

			}
		</script>
	</body>
</html>