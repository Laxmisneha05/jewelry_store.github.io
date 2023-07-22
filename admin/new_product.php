<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-product">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <input type="hidden" name="item_code" value="<?php echo isset($item_code) ? $item_code : '' ?>">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Category</label>
              <select name="category_id" id="category_id" class="form-control select2">
                <option value=""></option>
                <?php
                  $qry = $conn->query("SELECT * FROM categories order by name asc");
                  while($row = $qry->fetch_assoc()):
                ?>
                <option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>
        </div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Name</label>
							<input type="text" class="form-control form-control-sm" name="name" value="<?php echo isset($name) ? $name : '' ?>">
						</div>
					</div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Price</label>
              <input type="text" class="form-control form-control-sm text-right number" name="price" value="<?php echo isset($price) ? number_format($price) : '' ?>">
            </div>
          </div>
				</div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Available Size</label>
            </div>
            <?php if(isset($id) && $id > 0): ?>
            <?php 
            $sizes = $conn->query("SELECT * FROM sizes where product_id = $id");
                  if($sizes->num_rows > 0): 
            while($row = $sizes->fetch_assoc()):
            ?>
            <div class="form-group">
              <div class="input-group mb-3">
                  <input type="hidden" class="form-control" name="sid[]" value="<?php echo $row['id'] ?>">
                  <input type="text" class="form-control" name="size[]" value='<?php echo $row['size'] ?>'>
                  <div class="input-group-append">
                    <span class="input-group-text"><a href="javascript:void(0)" onclick="$(this).closest('.form-group').remove()"><i class="fas fa-times"></i></a></span>
                  </div>
              </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <div class="form-group">
              <div class="input-group mb-3">
                  <input type="hidden" class="form-control" name="sid[]">
                  <input type="text" class="form-control" name="size[]">
                  <div class="input-group-append">
                    <span class="input-group-text"><a href="javascript:void(0)" onclick="$(this).closest('.form-group').remove()"><i class="fas fa-times"></i></a></span>
                  </div>
              </div>
            </div>
            <?php endif; ?>
            <?php else: ?>
             <div class="form-group">
              <div class="input-group mb-3">
                  <input type="hidden" class="form-control" name="sid[]">
                  <input type="text" class="form-control" name="size[]">
                  <div class="input-group-append">
                    <span class="input-group-text"><a href="javascript:void(0)" onclick="$(this).closest('.form-group').remove()"><i class="fas fa-times"></i></a></span>
                  </div>
              </div>
            </div>
            <?php endif; ?>
           
            <div class="form-group">
              <div class="d-flex justify-content-end w-100">
                <button class="btn btn-flat bg-light border" type="button" id="add_size"><i class="fa fa-plus"></i> Add Size</button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Available Color</label>
            </div>
            <?php if(isset($id) && $id > 0): ?>
            <?php 
            $colours = $conn->query("SELECT * FROM colours where product_id = $id");
                  if($colours->num_rows > 0): 
            while($row = $colours->fetch_assoc()):
            ?>
            <div class="form-group">
              <div class="input-group mb-3">
                  <input type="hidden" class="form-control" name="cid[]" value="<?php echo $row['id'] ?>">
                  <input type="text" class="form-control" name="color[]" value='<?php echo $row['color'] ?>'>
                  <div class="input-group-append">
                    <span class="input-group-text"><a href="javascript:void(0)" onclick="$(this).closest('.form-group').remove()"><i class="fas fa-times"></i></a></span>
                  </div>
              </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <div class="form-group">
              <div class="input-group mb-3">
                  <input type="hidden" class="form-control" name="cid[]">
                  <input type="text" class="form-control" name="color[]">
                  <div class="input-group-append">
                    <span class="input-group-text"><a href="javascript:void(0)" onclick="$(this).closest('.form-group').remove()"><i class="fas fa-times"></i></a></span>
                  </div>
              </div>
            </div>
            <?php endif; ?>
            <?php else: ?>
             <div class="form-group">
              <div class="input-group mb-3">
                  <input type="hidden" class="form-control" name="cid[]">
                  <input type="text" class="form-control" name="color[]">
                  <div class="input-group-append">
                    <span class="input-group-text"><a href="javascript:void(0)" onclick="$(this).closest('.form-group').remove()"><i class="fas fa-times"></i></a></span>
                  </div>
              </div>
            </div>
            <?php endif; ?>
            <div class="form-group">
              <div class="d-flex justify-content-end w-100">
                <button class="btn btn-flat bg-light border" type="button" id="add_color"><i class="fa fa-plus"></i> Add Color</button>
              </div>
            </div>
          </div>
        </div>
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							<label for="" class="control-label">Description</label>
							<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
								<?php echo isset($description) ? $description : '' ?>
							</textarea>
						</div>
					</div>
				</div>
				<div id="f-inputs" class="d-none"></div>

			<div class="callout callout-info">
            <div id="actions" class="row">
              <div class="col-lg-6">
                <div class="btn-group w-100" id="upload_btns">
                  <span class="btn btn-success btn-flat col-sm-4 col fileinput-button dz-clickable">
                    <i class="fas fa-plus"></i>
                    <span>Add files</span>
                  </span>
                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center">
                <div class="fileupload-process w-100">
                  <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table table-striped files" id="previews">
              <div id="template" class="row mt-2">
                <div class="col-auto">
                    <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                </div>
                <div class="col d-flex align-items-center">
                    <p class="mb-0">
                      <span class="lead" data-dz-name></span>
                      (<span data-dz-size></span>)
                    </p>
                    <strong class="error text-danger" data-dz-errormessage></strong>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                </div>
                <div class="col-auto d-flex align-items-center">
                  <div class="btn-group">
                  	  <button class="btn btn-danger start d-none">
                      <i class="fas fa-upload"></i>
                      <span>Start</span>
                    </button>
                    <button  class="btn btn-danger delete" type="button">
                      <i class="fas fa-trash"></i>
                      <span>Delete</span>
                    </button>
                  </div>
                </div>
              </div>
              <div id="default-preview">
          <?php
            if(isset($item_code) && !empty($item_code)):
            if(is_dir('../assets/uploads/products/'.$item_code)):
                $_fs = scandir('../assets/uploads/products/'.$item_code);
              foreach($_fs as $k => $v):
                if(is_file('../assets/uploads/products/'.$item_code.'/'.$v) && !in_array($v,array('.','..'))):
                $dname = explode('_', $v);
           ?>
           <div class="def-item">
            <input type="hidden" class="inp-file" name="dname[]" value="<?php echo $item_code.'/'.$v ?>" data-uuid="<?php echo $k ?>">
                  <div id="" class="row mt-2 dz-processing dz-success dz-complete">
                      <div class="col-auto">
                          <span class="preview"><img src="<?php echo '../assets/uploads/products/'.$item_code.'/'.$v ?>" alt="" data-dz-thumbnail="" style="max-width: 100px"></span>
                      </div>
                      <div class="col d-flex align-items-center">
                          <p class="mb-0">
                            <span class="lead"><?php echo $dname[1] ?></span>
                            (<span><strong><?php echo filesize('../assets/uploads/products/'.$item_code.'/'.$v) ?></strong> Bytes</span>)
                          </p>
                          <strong class="error text-danger" data-dz-errormessage=""></strong>
                      </div>
                      <div class="col-4 d-flex align-items-center">
                          <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
                          </div>
                      </div>
                      <div class="col-auto d-flex align-items-center">
                        <div class="btn-group">
                          <button class="btn btn-danger delete" type="button" data-uuid="<?php echo $k ?>">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                          </button>
                        </div>
                      </div>
                    </div>
              </div>
         <?php endif; ?>
         <?php endforeach; ?>
         <?php endif; ?>
         <?php endif; ?>
            </div>
            </div>
          </div>
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-product">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
  $('#default-preview .delete').click(function(){
      var uuid = $(this).attr('data-uuid');
      var _this = $(this)
      start_load()
      if($('.inp-file[data-uuid="'+uuid+'"]').length > 0){
          var fname = $('.inp-file[data-uuid="'+uuid+'"]').val()
          $.ajax({
            url:'ajax.php?action=remove_file',
            method:'POST',
            data:{fname:fname},
            success:function(resp){
              if(resp == 1){
                $('.inp-file[data-uuid="'+uuid+'"]').remove()
                _this.closest('.def-item').remove()
                end_load()
                
              }
            }
          })
        }
  })

$(function () {

  $('#add_size').click(function(){
    var fg_inp = $('<div class="form-group"><div class="input-group mb-3">'+
                  '<input type="hidden" class="form-control" name="sid[]">'+
                 ' <input type="text" class="form-control" name="size[]">'+
                  '<div class="input-group-append">'+
                    '<span class="input-group-text"><a href="javascript:void(0)" onclick="$(this).closest(\'.form-group\').remove()"><i class="fas fa-times"></i></a></span>'+
                  '</div>'+
              '</div></div>')
    $(this).closest('.form-group').before(fg_inp)
  })
  $('#add_color').click(function(){
    var fg_inp = $('<div class="form-group"><div class="input-group mb-3">'+
                  '<input type="hidden" class="form-control" name="cid[]">'+
                 ' <input type="text" class="form-control" name="color[]">'+
                  '<div class="input-group-append">'+
                    '<span class="input-group-text"><a href="javascript:void(0)" onclick="$(this).closest(\'.form-group\').remove()"><i class="fas fa-times"></i></a></span>'+
                  '</div>'+
              '</div></div>')
    $(this).closest('.form-group').before(fg_inp)
  })

  Dropzone.autoDiscover = false;
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "ajax.php?action=upload_file", // Set the url,
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    acceptedFiles:'image/*',
    autoQueue: true, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  });

  myDropzone.on("addedfile", function(file) {
		    document.querySelector("#total-progress .progress-bar").style.width = "0%";
    setTimeout(function(){
    myDropzone.enqueueFile(file);
    },500)
    file.previewElement.querySelector(".delete").onclick = function() { 
		start_load()
    		if($('.inp-file[data-uuid="'+file.upload.uuid+'"]').length > 0){
    			var fname = $('.inp-file[data-uuid="'+file.upload.uuid+'"]').val()
    			$.ajax({
    				url:'ajax.php?action=remove_file',
    				method:'POST',
    				data:{fname:fname},
    				success:function(resp){
    					if(resp == 1){
    						$('.inp-file[data-uuid="'+file.upload.uuid+'"]').remove()
    						end_load()
    						myDropzone.removeFile(file);
    					}
    				}
    			})
    		}
    	 };
    myDropzone.on("error",function(resp){
  })
      myDropzone.on("totaluploadprogress", function(progress) {
  	console.log(progress)
		    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
		  });
  });

 

  myDropzone.on("sending", function(file,xhr,fdata) {
    document.querySelector("#total-progress").style.opacity = "1";
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
  });
  myDropzone.on("success",function(file,resp){
  	if(resp){
  		resp = JSON.parse(resp)
  		if(resp.status == 1){
  			var inp = $('<input type="hidden" class="inp-file" name="fname[]" value="'+resp.fname+'" data-uuid="'+file.upload.uuid+'">')
  			$('#f-inputs').append(inp)
        $('[name="pcode"]').val(resp.item_code)
  		}
  	}
  })
 
  })
	$('#manage-product').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_product',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp > 0){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=view_product&id='+resp
					},2000)
				}
			}
		})
	})
</script>