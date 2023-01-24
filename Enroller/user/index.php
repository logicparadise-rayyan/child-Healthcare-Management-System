<?php 
$user = $conn->query("SELECT * FROM enrollment_details where enrollment_id ='".$_settings->EnrollerData('id')."'");
while ($row = $user->fetch_assoc()){
    $meta[$row['meta_field']] = $row['meta_value'];
}


?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form action="" id="manage-user">	
				<input type="hidden" name="id" value="<?php echo $_settings->EnrollerData('id') ?>">
				<div class="row">
                    <div class="form-group col-4">
                        <label for="child_firstname">Child First Name</label>
                        <input type="text" name="child_firstname" id="child_firstname" class="form-control" value="<?php echo isset($meta['child_firstname']) ? $meta['child_firstname']: '' ?>" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="child_middlename">Child Middle Name</label>
                        <input type="text" name="child_middlename" id="child_middlename" class="form-control" value="<?php echo isset($meta['child_middlename']) ? $meta['child_middlename']: '' ?>" >
                    </div>
                    <div class="form-group col-4">
                        <label for="child_lastname">Child Last Name</label>
                        <input type="text" name="child_lastname" id="child_lastname" class="form-control" value="<?php echo isset($meta['child_lastname']) ? $meta['child_lastname']: '' ?>" required>
                    </div>
                </div>
				<div class="row">
                    <div class="form-group col-4">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required  autocomplete="off">
                    </div>
                    <div class="form-group col-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
                        <small><i>Leave this blank if you dont want to change the password.</i></small>
                    </div>
                    <div class="form-group col-2">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <small class="text-muted">Gender</small>
                            </div>
                            <div class="form-group col-auto">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" <?= ($meta['gender'] == "Male") ? "checked" : "" ?> type="radio" id="genderMale" name="gender"  value="Male" required="" >
                                    <label for="genderMale" class="custom-control-label">Male</label>
                                </div>
                            </div>
                            <div class="form-group col-auto">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" <?= ($meta['gender'] == "Female") ? "checked" : "" ?> id="genderFemale" name="gender" value="Female">
                                    <label for="genderFemale" class="custom-control-label">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-2">
                        <label for="child_dob">Child DOB</label>
                        <input type="date" name="child_dob" id="child_dob" class="form-control" value="<?php echo isset($meta['child_dob']) ? $meta['child_dob']: '' ?>" >
                    </div>
                </div>
                    <br>
                    <br>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="parent_firstname">Parent First Name</label>
                        <input type="text" name="parent_firstname" id="parent_firstname" class="form-control" value="<?php echo isset($meta['parent_firstname']) ? $meta['parent_firstname']: '' ?>" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="parent_middlename">Parent Middle Name</label>
                        <input type="text" name="parent_middlename" id="parent_middlename" class="form-control" value="<?php echo isset($meta['parent_middlename']) ? $meta['parent_middlename']: '' ?>" >
                    </div>
                    <div class="form-group col-4">
                        <label for="parent_lastname">Parent Last Name</label>
                        <input type="text" name="parent_lastname" id="parent_lastname" class="form-control" value="<?php echo isset($meta['parent_lastname']) ? $meta['parent_lastname']: '' ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="parent_contact">Parent Contact</label>
                        <input type="number" name="parent_contact" id="parent_contact" class="form-control" value="<?php echo isset($meta['parent_contact']) ? $meta['parent_contact']: '' ?>" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="parent_email">Parent Email</label>
                        <input type="email" name="parent_email" id="parent_email" class="form-control" value="<?php echo isset($meta['parent_email']) ? $meta['parent_email']: '' ?>" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="<?php echo isset($meta['address']) ? $meta['address']: '' ?>" required>
                    </div>
                </div>
				<div class="row">
                    <div class="col-3 form-group d-flex justify-content-center">
                        <img src="<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] :'') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                    </div>
                    <div class=" col-3 form-group">
                        <label for="" class="control-label">Avatar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                </div>
			</form>
		</div>
	</div>
	<div class="card-footer">
			<div style="margin-left: 95%" class="col-1 ">
				<div class="row">
					<button class="btn btn-sm btn-primary" form="manage-user">Update</button>
				</div>
			</div>
		</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage-user').submit(function(e){
		e.preventDefault();
        var _this = $(this)
		start_loader()
		$.ajax({
			url:_base_url_+'classes/Master.php?f=update',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp !=''){
					location.reload()
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_loader()
				}
				console.log(resp);
			}
		})
	})

</script>