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
                        <col width="15%">
                        <col width="10%">
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
                        <th>Patient View</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT   d.id, d.fullname, d.code, d.date_created, d.date_updated, a.date, a.status , a.id as aid , e.id as eid
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
                            <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">

                                    <a class="dropdown-item confirm_Appointment" href="javascript:void(0)" data-date="<?php echo $row['date'] ?>" data-id="<?php echo $row['aid'] ?>"  data-name="<?= $row['fullname'] .' '. $row['code'] ?>">
                                        <i class="fas fa-check text-success"></i>
                                        Confirm
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item reject_Appointment" href="javascript:void(0)" data-date="<?php echo $row['date'] ?>" data-id="<?php echo $row['aid'] ?>"  data-name="<?= $row['fullname'] .' '.$row['code'] ?>">
                                        <i class="fas fa-times text-danger"></i>
                                        Reject
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item view_doctor" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>

                                </div>
                            </td>
                            <td >
                                <a  href="javascript:void(0)" data-id="<?php echo $row['eid'] ?>" class="btn btn-secondary view_patent btn-sm ">
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
    var date =null;
    $(document).ready(function(){

        $('.reject_Appointment').click(function(){
            _conf("Are you sure to Reject Appointment Of <b>"+$(this).attr('data-name')+"</b>?","Reject_Appointment",[$(this).attr('data-id')])
            date=($(this).attr('data-date'));
        });
        $('.confirm_Appointment').click(function(){
            _conf("Are you sure to Confirm Appointment Of <b>"+$(this).attr('data-name')+"</b>?","Confirm_Appointment",[$(this).attr('data-id')])
            date=($(this).attr('data-date'));
        });
        $('.view_doctor').click(function(){
            uni_modal('Doctor Details',"doctor/view_details.php?id="+$(this).attr('data-id'),'mid-large')
        });
        $('.view_patent').click(function(){
            uni_modal('Patient Details',"enrollment/view_details.php?id="+$(this).attr('data-id'),'mid-large')
        });
        $('.table').dataTable();

    });
    function Confirm_Appointment(id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=Confirm_Appointment",
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
    function Reject_Appointment(id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=Reject_Appointment",
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