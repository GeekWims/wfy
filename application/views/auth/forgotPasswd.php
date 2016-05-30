<!-- Modal -->
<div class="modal fade" id="forgotPasswdModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-keyboard="true" data-backdrop="static">
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
						<div class="alert alert-info" role="alert">
							<p>If you are facebook user, we don't support password service</p>
							<p>Please type your account email. And we send new password</p>
						</div>
					</div>
						<form id="reqNewPassword" method="post" action="" onsubmit="return false;">
							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="email" id="email" class="form-control" name="email" placeholder="Email Address" required="required" />
							</div>
							<div class="form-group">
								<button type="button" class="btn btn-success btn-lg btn-block" onclick="reqNewPassword()">
									<span class="glyphicon glyphicon-send"></span>
									&nbsp;New Password
								</button>
								<button type="button" class="btn btn-default btn-lg btn-block"  data-dismiss="modal">
									<span class="glyphicon glyphicon-remove"></span>
									&nbsp;Close
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
	function reqNewPassword() {
		var email = $('#email').val();

		if (!validateEmail(email)) {
			alert('not validated email!');
			return false;
		}

		var data = 'email=' +  email;

		var response = reqProc('/auth/sendNewPassword', data);

		if (response.status == 'success') {
			alert('New password is sent');
		} else {
			alert(response.msg);
		}
		return false;
	};

	$('#forgotPasswdModal').on('hidden.bs.modal', function(e){
		$(this).remove();
	});

	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}
</script>