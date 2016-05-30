<!doctype html>
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
		<script src="<?echo JS_URL?>/infiniteScroll.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<img src="<?=$_SESSION['profile_img']?>" style="width:50px;" alt="" />
					<span id="userinfo-nickname" class="label label-info" onclick="loadPopup('/wordForYou/auth/updateView')"><?=$_SESSION['nickname']?></span>
					<span id="userinfo-bestRecord" class="label label-info" onclick="loadPopup('/wordForYou/Game/userRank')">Best Record</span>
					<span id="userinfo-totalTimes" class="label label-info">Total Study Times</span>
					<a href="<?echo ROOT_URL?>/auth/signOut" class="btn btn-default btn-sm">
						<span class="glyphicon glyphicon-log-out"></span> Sign out</a>
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
									<form action="" onsubmit="PLibraryLoad(1); return false;">
										<div class="input-group">
											<input id="peopleLibraryTitle" type="text" class="form-control"/>
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-search" onclick="PLibraryLoad(1)"></span>
											</div>
										</div>
									</form>
								</div>
								<div class="row" ondrop="PLDrop(event)" ondragover="allowDrop(event)">
									<ul id="peopleLibraryList" class="list-group scroll-able" onload="">

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
									<form action="" onsubmit="MLibraryLoad(1); return false;">
										<div class="input-group">
											<input id="myLibraryListTitle" type="text" class="form-control"/>
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-search" onclick="MLibraryLoad(1)"></span>
											</div>
										</div>
									</form>
								</div>
								<div class="row scroll-able" ondrop="MLDrop(event)" ondragover="allowDrop(event)">
									<ul id="myLibraryList" class="list-group">
									</ul>
								</div>
							</div>
							<button class="btn btn-default" onclick="loadPopup('/wordForYou/Library/create')">
								Create library
							</button>
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
									<form action="" onsubmit="WordLoad(1); return false;">
										<div class="input-group">
											<input id="wordListSearchInput" type="text" class="form-control"/>
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-search" onclick="WordLoad(1)"></span>
											</div>
										</div>
									</form>
								</div>
								<div class="row scroll-able">
									<ul id="wordList" class="list-group">
									</ul>
								</div>
							</div>
							<div>
								<button class="btn btn-default" onclick="loadPopup('/wordForYou/Library/createWord')">
									Create word
								</button>
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
		<!-- Modal -->
		<div id="popup-container" style="">
			
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
		<!-- wrapper of checked Item -->
		<div style="display:none">
			<div id="wrapPlayLib">
				
			</div>
		</div>
		<script src="<?=JS_URL ?>/global-script.js"></script>
		<script src="<?=JS_URL ?>/script.js"></script>
	</body>
</html>