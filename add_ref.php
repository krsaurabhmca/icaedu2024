<?php require_once('temp/sidebar.php'); 
 $table ='ref_user';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
        $walletid  = get_data('wallet',$center_id,'id','center_id')['data'];
    } else {
        $res  = insert_row($table);
        // print_r($res);
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

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <!--<h4 class="mb-sm-0 font-size-18">New Student Registration</h4>-->
                                    <div class="page-title-right">
                                    
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                         <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header <?php echo $bgClr ?> font-weight-bold">
                                    Referral Details
                                 <span class='float-right' style='float:right'>
                                        <a href='manage_ref'>  <button class="btn btn-dark btn-sm" > View All </button></a> 
                                       
                                       <button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> SAVE </button>
                                    </span>
                                     </div>
                                  <div class="card-body">
            <form id='update_frm' action='add_ref' > 
            <div class='row'>
            <div class="col-md-4 mb-3"></div>
            <div class="col-md-4 mb-3">
                <input type='hidden' value='<?php echo $id;?>' name='id'>
                <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
                
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input class="form-control" placeholder="Enter Name" name='ref_name' value='<?php echo $ref_name ?>' required>
                </div>
                   
                <div class="form-group mb-3">
                    <label>Contact No.</label>
                    <input type='text' class="form-control" placeholder="Enter Contact No." maxlength='10' minlength='10' name='ref_mobile' value='<?php echo $ref_mobile ?>' required>
                </div> 
                <div class="form-group mb-3">
                    <label>Email Id</label>
                    <input type='email' class="form-control" placeholder="Enter Email Id" name='ref_email' value='<?php echo $ref_email ?>' required>
                </div>
                <div class="form-group mb-3">
                    <label>Full Address</label>
                    <textarea class="form-control" placeholder="Enter Full Address" name='ref_address' value='' required><?php echo $ref_address ?></textarea>
                </div>
                 <div class="form-group mb-3">
                    <label>Status</label>
                    <select class="form-select"  name='status' value='' required>
                        <?php dropdown($status_simple,$status) ?>
                    </select>
                </div>
                
               
            </div>
          
            </form>
            
            
              </div>
                </div>
                <!-- end select2 -->

            </div>

        <!-- <div class="card-footer bg-white">
        <hr>
        
        <hr>
        </div> -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script type="text/javascript">
//===========Edited Image ==============//

$( document ).ready(function() {
 var student_photo = $('#targetimg').val();
 // alert(student_photo);
 var student_id_display = $('#target_id_proof').val();
 var student_edu_display = $('#target_edu_proof').val();
 var display = $('#display').val();
 if(student_id_display !='' || student_photo !='' || student_edu_display !='' ){
 if(display !=''){
    $("#display").html("<img src='temp/upload/"+obj.id +"' width='100px' height='100px' class='img-thumbnail'>");
    $("#student_id_display").html("<img src='temp/upload/"+obj.id +"' width='100px' height='100px' class='img-thumbnail'>");
    $("#student_edu_display").html("<img src='temp/upload/"+obj.id +"' width='100px' height='100px' class='img-thumbnail'>");
}else{
    $("#display").html("<img src='temp/upload/"+student_photo +"' width='100px' height='100px' class='img-thumbnail'>");
    $("#student_id_display").html("<img src='temp/upload/"+student_id_display +"' width='100px' height='100px' class='img-thumbnail'>");
    $("#student_edu_display").html("<img src='temp/upload/"+student_edu_display +"' width='100px' height='100px' class='img-thumbnail'>");
}
}
});
</script>
<script>
function centerName(ele){
var center_id = $(ele).val();
 $.ajax({
    type: 'post', 
    url: 'temp/master_process?task=rollNo', 
    data: {
        'center_id': center_id 
    },
    success: function(data) { 
        obj = JSON.parse(data);
        $('#rollNo').html("<span class='badge bg-success'>"+obj.roll_no+"</span>");
    }
});
}
</script>