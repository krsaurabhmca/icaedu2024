<?php require_once('temp/sidebar.php'); 
$table ='student';
$arr = decode($_GET['link']);
$data  = get_data($table, $arr['id'])['data'];
$isedit = 'yes';
extract($data);
$sid = $id;
$rid =resultid($sid);
$paperlist =paperlist($sid);
//print_r($paperlist);
$fullmarks =fullmarks($sid);
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
                                    <h4 class="mb-sm-0 font-size-18">Manage Student</h4>
                                    <div class="page-title-right">
                                    
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                         <div class="col-lg-12">
                          <!--   <div class="card">
                              <div class="card-header bg-white font-weight-bold">
                                Information of  <?php echo $student_name; ?>
                               <p class='text-danger small'> Kindly fill zero (0) if filed is not applicable. </p>
                              </div> -->
                            </div>
                         <div class="card-body">
              <div class='row'>
                <div class='col-md-3'>        
                        <div class="form-group mb-3">
                            
                            <label>Student Name</label>
                            <input class="form-control" name='student_name' value='<?php echo studentinfo($sid,'student_name');?>' readonly >
                        </div>
                        
                        <div class="form-group mb-3">
                            <label> Study Center </label>
                            <input class="form-control" name='student_name' value='<?php echo centerinfo($sid,'center_name');?>' readonly >
                        </div>
                        
                        <div class="form-group mb-3">
                            <label> Course Name </label>
                            <input class="form-control"  name='course_name' value='<?php echo courseinfo($sid,'course_name');?>' readonly>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label> Roll Number</label>
                            <input class="form-control" name='student_name' value='<?php echo studentinfo($sid,'student_roll');?>' readonly >
                        </div>
                        
                        <div class="form-group mb-3">
                            <label> Reg. Mobile No.</label>
                            <input class="form-control" name='student_name' value='<?php echo studentinfo($sid,'student_mobile');?>' readonly >
                        </div>
                        
                        </div>  
                        <div class="col-md-3 mb-3"> 
                            <form action ='result_edit' method ='post' enctype='multipart/form-data' id='update_frm'>
                                
                            <input type='hidden' value ='<?php echo $rid; ?>' name='result_id' >
                            <input type='hidden' value='<?php echo $sid; ?>' name='student_id'>
                                
                            <?php  if($paperlist != null) {
                                $i=1;
                                foreach($paperlist as $paper) { 
                                    ;?>
                                <div class="form-group">
                                    <label> <?php echo $paper; ?>   </label>
                                    <input class="marks form-control" id='<?php echo 'p'.$i; ?>' name='<?php echo 'paper'.$i; ?>' 
                                    value='<?php echo resultinfo($sid, 'paper'.$i); ?>'  type='number' required > 
                                </div>
                            <?php $i =$i+1; } }?>   
                                
                    
                        </div>  
        <div class="col-md-3">              
                <div class="form-group mb-3">
                    <label>  Total <span class='badge badge-danger'><?php echo fullmarks($sid); ?></span></label>
                    <input class="form-control" id='max_marks' type='hidden' value='<?php echo fullmarks($sid); ?>' readonly >
                    <input class="form-control" id='total' type='number' value='<?php echo resultinfo($sid,'total');?>' name='total' readonly >
                </div>
                <div class="form-group mb-3">
                    <label>Percentage (%) </label>
                    <input class="form-control" id='per' type='number' value='<?php echo resultinfo($sid,'percentage');?>' name='percentage' readonly >
                </div>
                
                <div class="form-group mb-3">
                    <label> Grade  </label>
                    <input class="form-control" id='grade' name='grade' value='<?php echo resultinfo($sid,'grade');?>' type='text' readonly>
                </div>
                
                <!--<div class="form-group">
                    <label> Remarks  </label>
                    <input class="form-control"  name='remarks'  type='text' value='<?php echo resultinfo($rid,'remarks');?>' required>
                </div>-->
                <?php if($user_type <> 'ADMIN') { ?>
                <button  class="btn btn-primary" id='update_btn' > Update Result </button>
                <?php } ?>
            
        </div>
                <div class="col-md-3 mb-3">              
                    <?php if($user_type == 'ADMIN') { ?>
                    <div class="form-group mb-3">
                        <label>Serial Number  <span class='badge bg-success'><?= get_all( 'result','*', ["student_id not in ('0')"] ,'id DESC')['data'][0]['ms_no'] ?></span></label>
                        <input class="form-control"  name='ms_no' value='<?php echo resultinfo($sid,'ms_no');?>' type='text' required>
                    </div>
                    <div class="form-group mb-3">
                    <label>Date of Issue </label>
                    <input class="form-control"  type='date' value='<?php echo (get_data('result',$sid,'ms_date')['count'] !==NULL) ? resultinfo($sid,'ms_date') : date("Y-m-d");?>' name='ms_date' >
                    </div>
                    
                    <input type='checkbox' name='send_wa' value='SEND' checked> 
                    <label>Send Whatsapp </label> <br>
                    
                    
                </form> 
                    
                    <button class="btn btn-success"  id='update_btn'>Verify Result </button>
                    <?php } ?>
                
                
            </div>
        <!-- /.row -->   
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
<?php require_once('temp/footer.php'); 
$course_type = get_data('course_details',studentinfo($sid,'course_id'),'course_type')['data'];
if($course_type == 9){ ?>
?>
<script>
$(document).on("keyup", ".marks", function() {
    var sum = 0;
    $(".marks").each(function(){
        sum += +$(this).val();
        max_marks += +$(this).attr("max");
    });
    $("#total").val(sum);
   // $("#max_marks").html(max_marks);
    var max_marks = parseFloat($("#max_marks").val());
    var per = (sum/max_marks)*100;
    //alert(per);
    var grade ='F';
    if(per < 100 && per >= 85) { grade ="A+"} 
    else if(per <85 && per >= 70) { grade ="A";} 
    else if(per <70 && per >= 55) { grade ="B";} 
    else if(per <55 && per >= 40) { grade ="C";} 
    else { grade ="FAIL";} 

    $("#per").val(per.toFixed(2));
    $("#grade").val(grade);

});
</script>
<?php }else{ ?>
<script>
$(document).on("keyup", ".marks", function() {
    var sum = 0;
    $(".marks").each(function(){
        sum += +$(this).val();
        max_marks += +$(this).attr("max");
    });
    $("#total").val(sum);
   // $("#max_marks").html(max_marks);
    var max_marks = parseFloat($("#max_marks").val());
    var per = (sum/max_marks)*100;
    //alert(per);
    var grade ='F';
    if(per < 100 && per >= 85) { grade ="A"} 
    else if(per <85 && per >= 70) { grade ="B";} 
    else if(per <70 && per >= 55) { grade ="C";} 
    else if(per <55 && per >= 40) { grade ="D";} 
    else { grade ="FAIL";} 

    $("#per").val(per.toFixed(2));
    $("#grade").val(grade);

});
</script>
<?php } ?>