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
		<h3 class="card-title">List of Appointments </h3>
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
                    <col width="20%">
                    <col width="10%">
                    <col width="15%">
                </colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Avatar</th>
						<th>Code</th>
						<th>Doctor Name</th>
						<th>Appointment Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT d.id, d.fullname, d.code, d.date_created, d.date_updated, a.date, a.status  
                                                      from `doctor_list` d 
                                                      JOIN `appointment` a on d.id=a.doctor_id 
                                                      JOIN `enrollment_list` e on e.id = a.enroller_id 
                                                      where d.status =  1 and a.date >= CURRENT_DATE
                                                      order by a.date asc;");
						while($row = $qry->fetch_assoc()):

					?>
						<tr>
							<td ><?php echo $i++; ?></td>
							<td ><img src="<?php echo validate_image(isset($row['id']) ? "uploads/doctors/{$row['id']}.png" : "").(isset($row['date_updated']) ? "?v=".strtotime($row['date_updated']) : "") ?>" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>
							<td><?php echo ($row['code']) ?></td>
							<td><?php echo ucwords($row['fullname']) ?></td>
							<td><?php echo $row['date'] ?></td>
							<td >
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-pill badge-info">UnConfirmed</span>
                                <?php elseif($row['status'] == 2): ?>
                                    <span class="badge badge-pill badge-success">Confirmed</span>
                                <?php elseif($row['status'] == 3): ?>
                                    <span class="badge badge-pill badge-danger">Rejected</span>
                                <?php endif; ?>
							</td>
							<td >
                                <a href="javascript:void(0)" data-date="<?=$row['date']?>" data-name="<?= ucwords($row['fullname']) ?> " data-id="<?php echo $row['id'] ?>" type="button" class="btn Cancel_Appointment btn-danger   btn-sm dropdown-icon" >
                                    &nbsp; Cancel &nbsp;
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
		<h3 class="card-title">List of Doctor's</h3>
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
                    <col width="15%">
                </colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Avatar</th>
						<th>Code</th>
						<th>Doctor Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 1;
						$qry = $conn->query("SELECT * from `doctor_list` where status =  1 order by fullname asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td ><?php echo $i++; ?></td>
							<td ><img src="<?php echo validate_image(isset($row['id']) ? "uploads/doctors/{$row['id']}.png" : "").(isset($row['date_updated']) ? "?v=".strtotime($row['date_updated']) : "") ?>" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>
							<td><?php echo ($row['code']) ?></td>
							<td><?php echo ucwords($row['fullname']) ?></td>
							<td >
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-pill badge-success">Active</span>
                                <?php elseif($row['status'] == 2): ?>
                                    <span class="badge badge-pill badge-primary">Inactive</span>
                                <?php elseif($row['status'] == 3): ?>
                                    <span class="badge badge-pill badge-info">Hired</span>
                                <?php endif; ?>
							</td>
							<td >
                                <a href="javascript:void(0)" data-name="<?= ucwords($row['fullname']) ?> " data-id="<?php echo $row['id'] ?>" type="button" class="btn view_doctor_appointments btn-primary   btn-sm dropdown-icon" >
                                    &nbsp; Appointment &nbsp;
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
    var current =null;
	$(document).ready(function(){

        $('.Cancel_Appointment').click(function(){
            _conf("Are you sure to Cancel Appointment with <b>"+$(this).attr('data-name')+"</b>?","Cancel_Appointment",[$(this).attr('data-id')])
            date=($(this).attr('data-date'));
        });
        $('.view_doctor_appointments').click(function(){
            uni_modal('Doctor Apointment List',"doctor/view_doctor_appointments.php",'mid-large');
            current=this;
        });
		$('.view_details').click(function(){
			uni_modal('Doctor Details',"doctor/view_details.php?id="+$(this).attr('data-id'),'mid-large')
		});
		$('.table').dataTable();

	});
    function Appoint_doctor(id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=Appoint_doctor",
            method:"POST",
            data:{
                id: id,
                date: date
            },
            dataType:"json",
            error:err=>{
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
            }

        })
    }
    function Cancel_Appointment(id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=Cancel_Appointment",
            method:"POST",
            data:{
                id: id,
                date: date
            },
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