<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<div class="card card-outline card-info rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">List of Meal Plan Chart</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Add New Meal Plan Chart</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="40%">
					<col width="20%">
					<col width="20%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>From</th>
						<th>To</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `mealplanchart`order by `id` asc ");
						while($row = $qry->fetch_assoc()):

					?>
						<tr>
							<td class=""><?php echo $i++; ?></td>
                            <td class=""><a target="_blank" href="<?=base_url."uploads/mealcharts/". $row['id'] .'.pdf'?>"><?=base_url."uploads/mealcharts/". $row['id'] .'.pdf'?></a></td>
							<td class=""><?php echo $row['fromC'] ?></td>
							<td class=""><?php echo $row['toC'] ?></td>
							<td >
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
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
        $('#create_new').click(function(){
			uni_modal("Add New Meal Plan Chart","mealplanechart/manage_service.php", 'mid-large')
		})
        $('.edit_data').click(function(){
			uni_modal("Update Meal Plan Chart","mealplanechart/manage_service.php?id="+$(this).attr('data-id'), 'mid-large')
		})
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Meal Plan Chart permanently?","delete_meal_plane_chart",[$(this).attr('data-id')])
		})
		$('.view_data').click(function(){
			uni_modal("Meal Plan Chart","mealplanechart/view_service.php?id="+$(this).attr('data-id'), 'mid-large')
		})
		$('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });

		$("#uni_modal").on('show.bs.modal',function(e){
			$('.summernote').summernote({
		        height: '15vh',
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
					['insert', ['link', 'picture']],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
		})
	})
	function delete_meal_plane_chart($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=deletemealplanechart",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
                console.log(resp)
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>