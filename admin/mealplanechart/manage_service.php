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

<div class="container-fluid">
    <form action="" id="mealplanchart">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
            <div class="form-group col-6">
                <label for="MealPlanChart" class="control-label">Meal Plan Chart From Calories</label>
                <input class="form-control"  min="500" value="100" required name="fromC" type="number" placeholder="Meal Plan Chart From Calories" <?php echo isset($formC) ? $formC : '' ?>>
            </div>
            <div class="form-group col-6">
                <label for="MealPlanChart" class="control-label">Meal Plan Chart To Calories</label>
                <input class="form-control" min="100" name="toC" value="200" type="number" placeholder="Meal Plan Chart To Calories" <?php echo isset($toC) ? $toC : '' ?>>
            </div>
        </div>
        <div class="form-group mt-5">
            <label for="name" class="control-label">Name: &nbsp;</label>
            <label style="min-width: 45%;"><?php echo isset($id) ? base_url.'uploads/mealcharts/'. $id.'.pdf': '' ?> &nbsp;</label>
            <input type="file" name="img" required placeholder="Meal Plan Chart Name">
        </div>

    </form>
</div>
<script>
    $(function(){
        $('#uni_modal #mealplanchart').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=mealplanchart",
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
                    end_loader();
                }
            })
        })
    })
</script>