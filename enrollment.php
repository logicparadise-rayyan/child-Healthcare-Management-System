<div class="content py-3">
    <div class="container-fluid fr-head-color">
        <br>
        <h3 class="fr-head-color"><b>Enrollment Form</b></h3>
        <hr class="bg-navy">
        <?php if($_settings->chk_flashdata('pop_msg')): ?>
            <div class="alert alert-success">
                <i class="fa fa-check mr-2"></i> <?= $_settings->flashdata('pop_msg') ?>
            </div>
            <script>
                $(function(){
                    $('html, body').animate({scrollTop:0})
                })
            </script>
        <?php endif; ?>
        <div class="card card-outline card-info rounded-0 shadow bg-compo">
            <div class="card-body rounded-0">
                <div class="container-fluid">
                    <form action="" id="enrollment-form">
                        <input type="hidden" name="id" value="">
                        <fieldset>
                            <legend class="">Child's Information</legend>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="text" id="child_firstname" name="child_firstname" autofocus class="form-control form-control-sm fr-head-color form-control-border bg-compo" placeholder="Firstname" required>
                                    <small class="text-muted px-4">First Name</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" id="child_middlename" name="child_middlename" class="form-control form-control-sm form-control-border bg-compo fr-head-color " placeholder="(optional)">
                                    <small class="text-muted px-4">Middle Name</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" id="child_lastname" name="child_lastname" class="form-control form-control-sm form-control-border bg-compo fr-head-color " placeholder="Last Name" required>
                                    <small class="text-muted px-4">Last Name</small>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-3 form-group">
                                    <input type="text" id="child_dob" name="username" class="form-control form-control-sm form-control-border bg-compo fr-head-color " required>
                                    <small class="text-muted px-4">Username</small>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="password" id="child_dob" name="password" class="form-control form-control-sm form-control-border bg-compo fr-head-color " required>
                                    <small class="text-muted px-4">Password</small>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <small class="text-muted">Gender</small>
                                        </div>
                                        <div class="form-group col-auto">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input bg-compo" type="radio" id="genderMale" name="gender" value="Male" required checked>
                                                <label for="genderMale" class="custom-control-label">Male</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-auto">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input bg-compo" type="radio" id="genderFemale" name="gender" value="Female">
                                                <label for="genderFemale" class="custom-control-label">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="date" id="child_dob" name="child_dob" class="form-control form-control-sm form-control-border bg-compo fr-head-color " required>
                                    <small class="text-muted px-4">Date of Birthday</small>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="">Parent/Guardian's Information</legend>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="text" id="parent_firstname" name="parent_firstname" class="form-control form-control-sm form-control-border bg-compo fr-head-color " placeholder="Firstname" required>
                                    <small class="text-muted px-4">First Name</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" id="parent_middlename" name="parent_middlename" class="form-control form-control-sm form-control-border bg-compo fr-head-color " placeholder="Middlname" placeholder="(optional)">
                                    <small class="text-muted px-4">Middle Name</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" id="parent_lastname" name="parent_lastname" class="form-control form-control-sm form-control-border bg-compo fr-head-color " placeholder="Lastname" required>
                                    <small class="text-muted px-4">Last Name</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="text" id="parent_contact" name="parent_contact" class="form-control form-control-sm form-control-border bg-compo fr-head-color " placeholder="Contact" required>
                                    <small class="text-muted px-4">Contact #</small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" id="parent_email" name="parent_email" class="form-control form-control-sm form-control-border bg-compo fr-head-color " placeholder="Email" required>
                                    <small class="text-muted px-4">Email</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <small class="text-muted">Address</small>
                                    <textarea name="address" id="address" rows="3" style="resize:none" class="form-control form-control-sm rounded-0 bg-compo fr-head-color " placeholder="Here Street, There City, Anywhere State, 2306"></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <hr class="">
                        <center>
                            <button class="btn btn-lg bg-navy rounded-pill mx-2 col-3">Submit Enrollment</button>
                            <a class="btn btn-lg btn-light border rounded-pill mx-2 col-3" href="./">Cancel</a>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#enrollment-form').submit(function(e){
            e.preventDefault()
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_enrollment",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    console.log(resp);
                    if(resp.status == 'success'){
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html, body').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>