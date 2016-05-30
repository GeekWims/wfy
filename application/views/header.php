<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 합쳐지고 최소화된 최신 CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<style>
		.remove-margin {
			margin: 0px;
		}
	
		.row {
			margin-bottom: 10px;
		}

		.pagination {
			padding: 0;
			margin: 0;
		}
		#library_item_list img {
			width: 150px;
			height: 100px;
		}
		
		.word-img {
			width: 150px;
			height: 100px;
		}
		</style>
		<link rel="stylesheet" href="<?=CSS_URL?>/game.css" />
		<!-- 부가적인 테마 -->
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="<?echo JS_URL?>/ajaxform.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

		<title><? echo $title ?></title>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">WordForYou</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="<?echo $home_nav?>">
							<a href="<?echo ROOT_URL?>/main">Main</a>
						</li>
						<li class="<?echo $game_nav?>">
							<a href="<?echo ROOT_URL?>/game">Game</a>
						</li>
						<li class="<?echo $lib_nav?>">
							<a href="<?echo ROOT_URL?>/library">Library</a>
						</li>
						<li class="<?echo $dic_nav?>">
							<a href="<?echo ROOT_URL?>/dictionary">Dictionary</a>
						</li>
						<li class="<?echo $qna_nav?>">
							<a href="<?echo ROOT_URL?>/#">QnA</a>
						</li>
						<li class="<?echo $contact_nav?>">
							<a href="<?echo ROOT_URL?>/#">Contact us</a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if (!isset($_SESSION['userID'])) { ?>
						<li>
							<a href="<?echo ROOT_URL?>/auth/signinpage"><span class="glyphicon glyphicon-log-in"></span> Sign In</a>
						</li>
						<li>
							<a href="<?echo ROOT_URL?>/auth/signuppage"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
						</li>
						<?php } else { ?>
						<li><img style="width: 50px; height: 50px;" src="<? echo $_SESSION['profile_img'] ?>"/></li>
						<li><a><?php echo $_SESSION['nickname']?></a></li>
						<li>
							<a href="<?echo ROOT_URL?>/auth/signOut"><span class="glyphicon glyphicon-log-out"></span> Sign out</a>
						</li>
						<?php } ?>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>

		<div class="cotainer-fluid" style="padding-bottom: 30px;">
			<div class="row">

				<div class="jumbotron text-center">
					<h1><?echo $hTitle?></h1>
					<p>
						<? echo $hSubTitle ?>
					</p>
				</div>
			</div>
