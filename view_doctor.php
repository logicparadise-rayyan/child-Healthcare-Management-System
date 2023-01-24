<?php
require_once('config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `doctor_list` where id ='{$_GET['id']}' ");
    if($qry->num_rows > 0 ){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k=$v;
            }
        }
        $meta_qry = $conn->query("SELECT * FROM `doctor_details` where doctor_id = '{$_GET['id']}' ");
        if($meta_qry->num_rows > 0 ){
            while($row= $meta_qry->fetch_assoc()){
                ${$row['meta_field']} = $row['meta_value'];
            }
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none !important;
    }
    #bs-img-modal{
        width:10em;
        height:10em;
        object-fit:cover;
        object-position:center center;
    }
</style>
<div class="container-fluid ">
    <div class="row">
        <div class="col-md-4">
            <center>
                <img id="bs-img-modal" src="<?= validate_image(isset($id) ? "uploads/doctors/{$id}.png" : "").(isset($date_updated) ? "?v=".strtotime($date_updated) : "") ?>" alt="D Image" class="bg-gradient-dark">
            </center>
        </div>
        <div class="col-md-8">
            <dl>
                <dt class="text-primary">Doctor's Code</dt>
                <dd class="pl-4"><?= isset($code) ? $code : "" ?></dd>
                <dt class="text-primary">Fullname</dt>
                <dd class="pl-4"><?= isset($fullname) ? $fullname : "" ?></dd>
                <dt class="text-primary">Gender</dt>
                <dd class="pl-4"><?= isset($gender) ? $gender : "" ?></dd>
                <dt class="text-primary">Email</dt>
                <dd class="pl-4"><?= isset($email) ? $email : "" ?></dd>
                <dt class="text-primary">Contact #</dt>
                <dd class="pl-4"><?= isset($contact) ? $contact : "" ?></dd>
                <dt class="text-primary">Address</dt>
                <dd class="pl-4"><?= isset($address) ? $address : "" ?></dd>
                <dt class="text-primary">Skills</dt>
                <dd class="pl-4"><?= isset($skills) ? $skills : "" ?></dd>
                <dt class="text-primary">Year of Experience</dt>
                <dd class="pl-4"><?= isset($years_experience) ? $years_experience : "" ?></dd>
                <dt class="text-primary">Achievements</dt>
                <dd class="pl-4"><?= isset($achievement) ? $achievement : "" ?></dd>
                <dt class="text-primary">Other Information</dt>
                <dd class="pl-4"><?= isset($other) ? $other : "" ?></dd>
            </dl>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            <a  href="<?=base_url?>enroller/?page=Doctor" class="btn rounded btn-sm btn-success" type="button" > Appointment</a>
            &nbsp;
            <button class="btn rounded btn-sm btn-danger" type="button" data-dismiss="modal"> Close</button>
        </div>
    </div>
</div>