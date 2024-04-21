<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline rounded-0">
	<div class="card-header">
		<h3 class="card-title">List of Room</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-sm btn-primary"> Add New Room</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
            <table id="example" class="display" style="width:100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Room</th>
						<th>Room Type</th>
						<th>Descriptiom</th>
                        <th>Date Created</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT r.*,rt.room from `room_list` r inner join room_type_list rt on r.room_type_id = rt.id where r.delete_flag = 0 order by r.`name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo ($row['name']) ?></td>
							<td><?php echo ($row['room']) ?></td>
							<td class=""><?php echo $row['description'] ?></td>
                            <td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td align="center">
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

<div class="modal fade rounded-0" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header rounded-0">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body rounded-0">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function(){
        $('#create_new').click(function(){
			uni_modal("Add New Room","rooms/manage_room.php")
		})
        $('.edit_data').click(function(){
			uni_modal("Update Room Details","rooms/manage_room.php?id="+$(this).attr('data-id'))
		})
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Room permanently?","delete_room",[$(this).attr('data-id')])
		})
		$('.view_data').click(function(){
			uni_modal("Room Details","rooms/view_room.php?id="+$(this).attr('data-id'))
		})
        $('.table td,.table th').addClass('py-1 px-2 align-middle')
        $('.table').dataTable();

	})
	function delete_room($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_room",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
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