<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `mealplanchart` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <dl class="col-6">
            <dt class="text-muted">link</dt>
            <dd class='pl-4 fs-4 fw-bold'><a target="_blank" href="<?=base_url."uploads/mealcharts/". $id.'.pdf'?>"><?=base_url."uploads/mealcharts/". $id .'.pdf'?></a></dd>
            <dt class="text-muted">From</dt>
            <dd class='pl-4'>
                <?=$fromC?>
            </dd>
            <dt class="text-muted">To</dt>
            <dd class='pl-4'>
                <?=$toC?>
            </dd>
        </dl>
        <div class="col-6">
            <iframe src="<?=base_url?>/uploads/mealcharts/<?=$id?>.pdf" ></iframe>
        </div>
    </div>
    <div class="col-12 text-right">
        <button class="btn btn-flat btn-sm btn-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>