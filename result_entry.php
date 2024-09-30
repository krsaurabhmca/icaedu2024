<?php require_once('temp/sidebar.php'); 
 $table ='student';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
        $paperlist =paperlist($id);
        //print_r($paperlist);
        $fullmarks =fullmarks($id);
    } 
    // else {
    //     $res  = insert_row($table);
    //     $id = $res['id'];
    //     $isedit = 'no';
    //     $data  = get_data($table, $id)['data'];
    //     extract($data);
    // }
    $sid = $id;
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
                                    <h4 class="mb-sm-0 font-size-18">Result Entry</h4>
                                    <div class="page-title-right">
                                    
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                         <div class="col-lg-12">
                            <div class="card">
                              <div class="card-header bg-white font-weight-bold">
                                Information of  <?php echo $student_name; ?>
                               <p class='text-danger small'> Kindly fill zero (0) if filed is not applicable. </p>
                              </div>
                            </div>
                         <div class="card-body">
                <div class='row'>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Student Name</label>
                            <input class="form-control" name='student_name' value='<?php echo $student_name;?>' readonly >
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
                                                
                        </div>  
                        <div class="col-md-4 mb-3"> 
                            <form action ='result_entry' id='insert_frm' method ='post' enctype='multipart/form-data'>
                                <input type='hidden' value='<?php echo $sid; ?>' name='student_id'>
                                
                            <?php if($paperlist != null) {
                                $i=1;
                                foreach($paperlist as $paper) { ;?>
                                <div class="form-group mb-3">
                                    <label> <?php echo $paper; ?>  </label>
                                    <input class="marks form-control" id='<?php echo 'p'.$i; ?>' name='<?php echo 'paper'.$i; ?>'  type='number' required >
                                </div>
                            <?php $i =$i+1; } } ?>  
                                
                        </div>  
                            
                        <div class="col-md-4 mb-3">              
                                        <div class="form-group mb-3">
                                            <label>  Total <span class='badge bg-danger'><?php echo fullmarks($sid); ?></span></label>
                                        <input class="form-control" id='max_marks' type='hidden' value='<?php echo fullmarks($sid); ?>' readonly >
                                            <input class="form-control" id='total' type='number' name='total' readonly >
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Percentage (%) </label>
                                            <input class="form-control" id='per' type='number' name='percentage' readonly >
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label> Grade  </label>
                                            <input class="form-control" id='grade' name='grade'  type='text' readonly>
                                        </div>
                                        
                                        <div class="form-group">
                                           
                                            <input class="form-control"  name='remarks' value='PASS'  type='hidden' required>
                                        </div>
                                        
                                        <input type="button" class="btn btn-primary" id='insert_btn' value='Submit Result' >
                                        
                                    </form>
                
                        </div>
                        
        
        <!-- /.row -->
                
        
        </div>
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