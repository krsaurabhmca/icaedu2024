<?php require_once('temp/sidebar.php'); 
 $table ='product';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
    } else {
        $res  = insert_row($table);
        $id = $res['id'];
        $isedit = 'no';
        $data  = get_data($table, $id)['data'];
        extract($data);
    }
?>
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                     <!-- <div class="content p-4"> -->
                     	 <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Manage Product</h4>
                                    <div class="page-title-right">
		                           <a href="add_product" class="btn btn-primary btn-sm" >
									Add Product
									</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			      <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <!--<th>Image</th>-->
                                            <th>Name</th>
                                            <th>Price</th>
											<th>Status</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                   <tbody>
										<?php $sql ="select * from product where status not in ('AUTO','DELETED')"; 
										// where student_status='ACTIVE' order by student_id desc";
										$res = direct_sql($sql);
										if($res['data']){
										foreach($res['data'] as $row )
										{
										$prd_id = $row['id'];
										$img = $row['prd_image'];
								// 		echo"<td><img src='temp/upload/$img' width='50px' height='50px'  class='img-thumbnail' style ='border-radius:50%'></td>";
										echo"<td>".$row['prd_name']."</td>";
										echo"<td>".$row['prd_price']."</td>";
                                        echo"<td>".$row['status']."</td>";
                                        echo"<td width='105'>";
										echo btn_edit('add_product',$prd_id);
										echo btn_delete('product',$prd_id);
										?>
										</td>
										
										<?php
									    echo "</tr>";
										}
										}
                                       ?>
                                     </tr> 
                                    </tbody>
                                </table>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
      <!-- Start Modal -->
<div class="modal fade" id="prdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="row">
       <form action ='add_prd' id='update_frm' enctype='multipart/form-data'>
       	<div class="row">
       		 <input type='hidden' value='<?php echo $id;?>' name='id'>
             <input type='hidden' id="isedit" name='isedit' value='<?php echo $isedit; ?>'>
		  <div class="col-5 mb-3">
		    <label for="prd_name" class="form-label">Product name</label>
		    <input type="text" class="form-control" name="prd_name" value='<?php echo $prd_name; ?>' required>
		  </div>
		  <div class="col-4 mb-3">
		    <label for="prd_price" class="form-label">Price</label>
		    <input type="number" class="form-control" name="prd_price" min='1' value='<?php echo $prd_price; ?>' required>
		  </div>
		  <div class="col-3 mb-3">
		    <label for="status" class="form-label" required>Status</label>
		    <select class="form-select" name="status" >
		    	<?php dropdown($status_simple,$status); ?>
		    </select>
		  </div>
		  <div class="mb-3 ">
		  	<input type='hidden' name='prd_image' id='targetimg' value='<?php echo $prd_image ?>'>
		  </div>
		  </div>
		</form>
		<!--<div class="mb-3 col-12">-->
		 <!--<form id='uploadForm' enctype= 'multipart/form-data'>-->
   <!--         <div id='display'></div>-->
   <!--         <div class="form-group">-->
   <!--             <label>Upload Photograph (Max 50 KB) </label>-->
   <!--             <input class="form-control" type='file' name='uploadimg' id='uploadimg' accept='image'>-->
   <!--             <br><small> Only Jpg and Png image upto 50KB. </small>-->
   <!--         </div>-->
   <!--       </div>-->
   <!--     </form>-->
      </div>
      </div>
      <div class="modal-footer">
      	<button class="btn btn-primary btn-sm" id="update_btn" accesskey="s"> Save </button>
      </div>
    </div>
  </div>
</div>
      <!-- End Modal -->
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>

<script type="text/javascript">
    
//===========Edited Image ==============//

$( document ).ready(function() {
 $('#prdModal').modal('show');
 var edit_img = $('#targetimg').val();
 var display = $('#display').val();
  if(edit_img !=''){
 if(display !=''){
    $("#display").html("<img src='temp/upload/"+obj.id +"' width='100px' height='100px' class='img-thumbnail'>");
}else{
    $("#display").html("<img src='temp/upload/"+edit_img +"' width='100px' height='100px' class='img-thumbnail'>");
}
}
});
</script>