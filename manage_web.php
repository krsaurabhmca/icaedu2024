<?php require_once('temp/sidebar.php'); 
        $center_code = get_data('user',$user_id,'user_name')['data'];
        $data  = get_data('center_details', $center_code,'','center_code')['data'];
        extract($data);
?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Manage Your Website</h4>
                                    <div class="page-title-right">
                                    
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                         <div class="col-lg-12">
                            <div class="card">
                               
                                 <div class="card-body">
            <form id='update_frm' action='manage_web' > 
            <div class='row'>
            <div class="col-md-2 mb-3"></div>
            <div class="col-md-6 mb-3">
                <input type='hidden' value='<?php echo $id;?>' name='id'>
                
                <div class="form-group mb-3">
                    <label>Enter About us  Detaiils </label>
                    <textarea class='form-control' name='web_about' required style="min-height: 200px;"><?php echo $web_about ?></textarea>
                   
                </div>  
               
               <input type='hidden' id='targetimg' name='web_upload_logo' value='<?php echo $web_upload_logo ?>'>
               <input type='hidden' id='target_id_proof' name='qr_pay' value='<?php echo $qr_pay ?>'>
            </form>  
             <form id='uploadForm' enctype= 'multipart/form-data'>
                <div id='display'></div>
                <div class="form-group">
                    <label>Upload logo (Max 50 KB) </label>
                    <input class="form-control" type='file' name='uploadimg' id='uploadimg' accept='image'>
                    <br><small> Only Jpg and Png image upto 50KB. </small>
                </div>
                
            </form>
            <hr> 
            </form>  
             <form id='id_proof' enctype= 'multipart/form-data'>
                <div id='student_id_display'></div>
                <div class="form-group">
                    <label>Upload QR Code Photograph (Max 50 KB) </label>
                    <input class="form-control" type='file' name='uploadimg' id='upload_id_proof' accept='image'>
                    <br><small> Only Jpg and Png image upto 50KB. </small>
                </div>
                
            </form>
            <hr> 
             <center><div class="col-3 mb-3">
                <button class="btn btn-success btn-md" id="update_btn" accesskey="s"> SAVE </button>
                </div></center>
            </div>
              </div>
                </div>
                <!-- end select2 -->

            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script type="text/javascript">
//===========Edited Image ==============//

$( document ).ready(function() {
 var targetimg = $('#targetimg').val();
 var target_id_proof = $('#target_id_proof').val();

 var student_id_display = $('#student_id_display').val();
 var display = $('#display').val();
 if (targetimg !='' ){
 if(display !=''){
    $("#display").html("<img src='temp/upload/"+obj.id +"' width='100px' height='100px' class='img-thumbnail'>");
   
}else{
    $("#display").html("<img src='temp/upload/"+targetimg +"' width='100px' height='100px' class='img-thumbnail'>");
}
}
if (target_id_proof !='' ){
 if(display !=''){
    $("#student_id_display").html("<img src='temp/upload/"+obj.id +"' width='100px' height='100px' class='img-thumbnail'>");
   
}else{
    $("#student_id_display").html("<img src='temp/upload/"+target_id_proof +"' width='100px' height='100px' class='img-thumbnail'>");
}
}
});
</script>
