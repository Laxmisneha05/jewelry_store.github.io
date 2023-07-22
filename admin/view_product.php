<?php
include 'db_connect.php';
$qry = $conn->query("SELECT p.*, c.name as cname,c.description as cdesc FROM products p inner join categories c on c.id = p.category_id where p.id = '{$_GET['id']}' ")->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'ftitle';
	$$k = $v;
}
$img = array();
if(isset($item_code) && !empty($item_code)):
            if(is_dir('../assets/uploads/products/'.$item_code)):
                $_fs = scandir('../assets/uploads/products/'.$item_code);
              foreach($_fs as $k => $v):
	                if(is_file('../assets/uploads/products/'.$item_code.'/'.$v) && !in_array($v,array('.','..'))):
	                	$img[] = '../assets/uploads/products/'.$item_code.'/'.$v;
					endif;
				endforeach;
			endif;
endif;
?>
<div class="col-lg-12">
    <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?php echo $name ?></h3>
              <div class="col-12">
                <img src="<?php echo isset($img[0]) ? $img[0] : '' ?>" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
              	<?php 
          			foreach($img as $k => $v): 

  				?>
                <div class="product-image-thumb <?php echo $k == 0 ? 'active' : '' ?>"><img src="<?php echo $v ?>" alt="Product Image"></div>
            	<?php endforeach; ?>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?php echo ucwords($name) ?></h3>
              <p>Category: <?php echo ucwords($cname) ?></p>

              <hr>
              <h4>Available Sizes</h4>
              <?php 
              $sizes = $conn->query("SELECT * FROM sizes where product_id = $id");
              $size_arr = array();
              while($row = $sizes->fetch_assoc()){
              	$size_arr[] = $row['size'];
              }
              ?>
              <p><i><?php echo implode(', ',$size_arr) ?></i></p>

               <h4>Available Colors</h4>
              <?php 
              $colours = $conn->query("SELECT * FROM colours where product_id = $id");
              $colour_arr = array();
              while($row = $colours->fetch_assoc()){
              	$colour_arr[] = $row['color'];
              }
              ?>
              <p><i><?php echo implode(', ',$colour_arr) ?></i></p>

              <div class="bg-gray disabled py-2 px-3 mt-4">
                <h2 class="mb-0">
                  <?php echo number_format($price,2) ?>
                </h2>
                
              </div>

              

            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-cat-desc" role="tab" aria-controls="product-cat-desc" aria-selected="false">Category Description</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><?php echo html_entity_decode($description) ?></div>
              <div class="tab-pane fade" id="product-cat-desc" role="tabpanel" aria-labelledby="product-cat-desc-tab"> <?php echo html_entity_decode($cdesc) ?></div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
</div>