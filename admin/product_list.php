<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-danger">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-danger" href="./index.php?page=new_product"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="10%">
					<col width="25%">
					<col width="25%">
					<col width="20%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Item Code</th>
						<th>product</th>
						<th>Name</th>
						<th>Price</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT p.*, c.name as cname FROM products p inner join categories c on c.id = p.category_id order by p.name asc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo $row['item_code']?></b></td>
						<td><b><?php echo ucwords($row['cname']) ?></b></td>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td class="text-right"><b><?php echo number_format($row['price']) ?></b></td>
						<td class="text-center">
		                    <div class="btn-group">
		                        <a href="./index.php?page=edit_product&id=<?php echo $row['id'] ?>" class="btn btn-danger btn-flat">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                         <a href="./index.php?page=view_product&id=<?php echo $row['id'] ?>" class="btn btn-info btn-flat">
		                          <i class="fas fa-eye"></i>
		                        </a>
		                        <button type="button" class="btn btn-danger btn-flat delete_product" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button>
	                      </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.delete_product').click(function(){
	_conf("Are you sure to delete this product?","delete_product",[$(this).attr('data-id')])
	})
	})
	function delete_product($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_product',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>