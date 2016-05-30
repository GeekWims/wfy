<!-- Modal -->
<div class="modal fade" id="popupLogin" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button> -->
				<h4 class="modal-title" id="myModalLabel">Create account</h4>
			</div>
			<div class="modal-body">
				<div class="">
					<div id="form-notice" style="">
						<div class="alert alert-warning" role="alert">
							<p>This site require login for service.</p>
						</div>
					</div>
						<form id="loginForm" method="post" action="<?= ROOT_URL?>/auth/signin">
							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="email" class="form-control" name="email" placeholder="Email Address" required="required" />
							</div>
							<div class="form-group">
								<label for="email">Password</label>
								<input type="password" class="form-control" name="password" placeholder="Password" required="required" />
							</div>
							<div class="form-group">
								<label for="">
								<input type="checkbox" name="isWillSave" id="isWillSave"/>
									Remember email address </label>
							</div>
							<div class="row">
								<div class="col-md-6">
									<small><a href="#" onclick="loadPopup('/wordForYou/auth/popupCreate'); return false;">Create free acoount</a></small>
								</div>
								<div class="col-md-6">
									<small><a href="#" onclick="loadPopup('/wordForYou/auth/forgotPasswdView')">Forgot your password?</a></small>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success btn-lg btn-block">
									<span class="glyphicon glyphicon-ok"></span>
									&nbsp;Sign in
								</button>
								<button type="button" class="btn btn-info btn-lg btn-block" onclick="fb_login();"><img src="<?=IMG_URL ?>/facebook.png" alt="" style="width:25px" />&nbsp;Facebook
								</button>
								<button type="button" class="btn btn-warning btn-lg btn-block" data-dismiss="modal">
									Guest Mode
								</button>
							</div>
						</form>
				</div>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>
<script>
	$('#popupLogin').on('hidden.bs.modal', function(e){
		$(this).remove();
	});
	var options = {
		success : function(response) {
			location.reload();
		},
		error : function(response) {
			alert(response.responseText);
		}
	}
	$('#loginForm').ajaxForm(options);
	function reqLogin() {
		$('#loginForm').submit();
	}
</script>
<script src="/wordForYou/static/js/fb-sdk.js"></script>