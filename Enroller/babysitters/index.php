<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<div class="card card-outline card-info rounded-0">
    <div class="card-header">
        <h3 class="card-title">List of Hired Baby Sitters</h3>

    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                     <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="20%">
                        <col width="20%">
                        <col width="10%">
                        <col width="12%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>Code</th>
                        <th>FullName</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * from `babysitter_list` where status = 3  order by fullname asc ");
                    while($row = $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <td ><?php echo $i++; ?></td>
                            <td ><img src="<?php echo validate_image(isset($row['id']) ? "uploads/babysitters/{$row['id']}.png" : "").(isset($row['date_updated']) ? "?v=".strtotime($row['date_updated']) : "") ?>" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>
                            <td><?php echo ($row['code']) ?></td>
                            <td><?php echo ucwords($row['fullname']) ?></td>
                            <td class="">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-pill badge-success">Active</span>
                                <?php elseif($row['status'] == 2): ?>
                                    <span class="badge badge-pill badge-primary">Inactive</span>
                                <?php elseif($row['status'] == 3): ?>
                                    <span class="badge badge-pill badge-info">Hired</span>
                                <?php endif; ?>
                            </td>
                            <td >
                                <a href="javascript:void(0)" data-name="<?php echo ($row['code']); echo " "; echo ucwords($row['fullname']) ?> " data-id="<?php echo $row['id'] ?>" type="button" class="btn fire_babysitter btn-danger   btn-sm dropdown-icon" >
                                    &nbsp; Fire &nbsp;
                                </a>
                                <a  href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" class="btn btn-secondary view_details btn-sm ">
                                    <span class="fa fa-eye text-light"></span>
                                    View
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card card-outline card-info rounded-0">
	<div class="card-header">
		<h3 class="card-title">List of Baby Sitters</h3>

	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
                <colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="20%">
                    <col width="20%">
                    <col width="10%">
                    <col width="12%">
                </colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Avatar</th>
						<th>Code</th>
						<th>FullName</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `babysitter_list` where status = 1  order by fullname asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class=""><?php echo $i++; ?></td>
							<td class=""><img src="<?php echo validate_image(isset($row['id']) ? "uploads/babysitters/{$row['id']}.png" : "").(isset($row['date_updated']) ? "?v=".strtotime($row['date_updated']) : "") ?>" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>
							<td><?php echo ($row['code']) ?></td>
							<td><?php echo ucwords($row['fullname']) ?></td>
							<td class="">
								<?php if($row['status'] == 1): ?>
									<span class="badge badge-pill badge-success">Active</span>
								<?php elseif($row['status'] == 2): ?>
								<span class="badge badge-pill badge-primary">Inactive</span>
								<?php endif; ?>
							</td>
							<td >
								 <a  href="javascript:void(0)" data-name="<?php echo ($row['code']); echo " "; echo ucwords($row['fullname']) ?> " data-id="<?php echo $row['id'] ?>" type="button" class="btn hire_babysitter btn-primary   btn-sm dropdown-icon" >
                                    &nbsp; Hire &nbsp;
                                </a>
                                <a  href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" class="btn btn-secondary view_details btn-sm ">
                                    <span class="fa fa-eye text-light"></span>
                                    View
                                </a>

                            </td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.hire_babysitter').click(function(){
			_conf("Are you sure to hire <b>"+$(this).attr('data-name')+"</b>  babysitter ?","hire_babysitter",[$(this).attr('data-id')])
		});
        $('.fire_babysitter').click(function(){
            _conf("Are you sure to fire <b>"+$(this).attr('data-name')+"</b>  babysitter ?","fire_babysitter",[$(this).attr('data-id')])
        });
        $('.view_details').click(function(){
            uni_modal('Babysitter Details',"babysitters/view_details.php?id="+$(this).attr('data-id'),'mid-large')
        });
	});
	function hire_babysitter(id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=hire_babysitter ",
			method:"POST",
			data:{id: id},
			dataType:"json",
			error:err=>{
                console.log(err);
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
                    alert_toast(resp.msg,'success');
                    end_loader();
				}else{
					alert_toast(resp.msg,'error');
					end_loader();
				}
                setTimeout(function () {
                   location.reload();
                },1000);
                console.log(resp);
			}

		})
	}
    function fire_babysitter(id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=fire_babysitter ",
            method:"POST",
            data:{id: id},
            dataType:"json",
            error:err=>{
                console.log(err);
                alert_toast("An error occured.",'error');
                end_loader();
            },
            success:function(resp){
                if(typeof resp== 'object' && resp.status == 'success'){
                    alert_toast(resp.msg,'success');
                    end_loader();
                }else{
                    alert_toast(resp.msg,'error');
                    end_loader();
                }
                setTimeout(function () {
                     location.reload();
                },1000);
                console.log(resp);
            }

        })
    }
</script>