<?php include 'db_connect.php' ?>
<?php 
$qry = $conn->query("SELECT * FROM orders where id = {$_GET['id']}")->fetch_array();
foreach ($qry as $key => $value) {
	$$key = $value;
}
?>
<div class="container-fluid">
	<form action="" id="update-order">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<div class="form-group">
			<label for="">Order Status</label>
			<select name="status" id="status" class="custom-select custom-select-sm">
				<option value="0">Pending</option>
				<option value="1">Verified</option>
				<option value="2">Shipped</option>
				<option value="3">Delivered</option>
				<option value="4">Cancelled</option>
			</select>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){

	
	$('#update-order').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=update_order',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})
	})

</script>