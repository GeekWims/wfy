<!-- Modal -->
<div class="modal fade" id="popupCreateAccount" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button> -->
				<h4 class="modal-title" id="myModalLabel">Create account</h4>
			</div>
			<div class="modal-body">
				<div class="form-wrapper">
					<div id="form-notice" style="">
						<div class="alert alert-warning" role="alert">
							<p>If not fill nickname, nickname will be 'unknown' </p>
							<p>If not upload profile image, image will be set with default image </p>
						</div>
					</div>
					<form method="post" action="/wordForYou/auth/signup">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="email" placeholder="Email Address" value="" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" placeholder="Password(8~16)" required>
						</div>
						<div class="form-group">
							<label for="re-password">Confirm Password</label>
							<input type="password" class="form-control" name="re-password" placeholder="Repeat Password" required>
						</div>
						<div class="form-group">
							<label for="nickname">Nickname</label>
							<input type="text" class="form-control" name="nickname" required="" maxlength="10" placeholder="nickname(0~10)" value="">
						</div>
						<div class="form-group">
							<label for="profile_img">Profile Image ( ~ 100MB)</label>
							<div class="input-group" style="">
								<img id="preview_img" src="<?php echo set_value('profile_img', base_url('static/img') . '/unknown.png')?>" width="50px" height="50px;" alt="">
								<button type="button" id="btn-chooseImg" class="btn btn-default" style="">
										Choose image
								</button>
							</div>
							<input type="hidden" id="profile_img" name="profile_img" value="">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Create</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
	<?php echo form_open_multipart('upload/tmp_upload', array('id' => 'ajaxImgForm', 'style' => 'display:none;'));?>
	    <?php echo form_upload(array('name' => 'userfile', 'id' => 'real_upload_input')) ?>
	<?php echo form_close() ?>
	<script>
		$('#popupCreateAccount').on('hidden.bs.modal', function(e){
			$(this).remove();
		});
	
	    $(document).ready(function ($) {
	        $('#ajaxImgForm').ajaxForm({
	            success: function (responseText, statusText, xhr, $form) {
	                $('#preview_img').attr('src', responseText);
	                $('#profile_img').attr('value', responseText);
	            },
	            error: function( jqXhr ) {
	                if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
	                    var json = $.parseJSON( jqXhr.responseText );
	                    console.log(json);
	                    $('#error_wrap').append(json['message']);
	                }
	            }
	        });
	        $(document).ajaxStart(function()
	        {
	        	$('loadingModal').modal();
	        });
	        $(document).ajaxStop(function()
	        {
	        	$('loadingModal').modal('hide');
	        });
	    });
	    $('#real_upload_input').change(function() {
	        $('#ajaxImgForm').submit();
	    });
	
	    $('#btn-chooseImg').click(function() {
	        $('#real_upload_input').click();
	    });
	    $(document).ready(function() {
	    });
	</script>
</div>
