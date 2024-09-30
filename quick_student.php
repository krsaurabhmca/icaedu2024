<?php 
 require_once('temp/sidebar.php'); 
 $table ='student';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
        $walletid  = get_data('wallet',$center_id,'id','center_id')['data'];
    } 
    
    else if (isset($_GET['reg_no'])) {
        $reg_no = $_GET['reg_no'];
        $data  = get_data($table, $reg_no,null,'student_roll')['data'];
        $isedit = 'no';
        extract($data);
        //creating New ID
        $ires  = insert_row($table);
        $id = $ires['id']; //Overwrite ID
        $course_id = ""; //Change Course to Blank 
        $student_roll = ""; //Change Student Roll to Blank 
        $status ="VERIFIED"; // AUTO Verified 
        
        $walletid  = get_data('wallet',$center_id,'id','center_id')['data'];
    } 
    else {
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
                        <form>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Quick Registration</h4>
                                   
                                </div>
                            </div>
                            <div class="col-md-2">
                                 <input type='text' placeholder='Enter Reg No.' name='reg_no' maxlength='12'  value='<?= $reg_no?>'>
                                 
                            </div>
                             <div class="col-md-1">
                                &nbsp; <button class='btn btn-danger btn-sm float-end' > Clone </button>
                            </div>
                        </div>
                        </form>
                        <!-- end page title -->

                        <div class="row">
                         <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header <?php echo $bgClr ?> font-weight-bold">
                                    Student Registration
                                 <span class='float-right' style='float:right'>
                                        <a href='manage_student'>  <button class="btn btn-dark btn-sm" > View All </button></a> 
                                        <?php 
                                        if($user_type =='CLIENT' and $wallet < $docs_fee and $isedit =='no')
                                        {
                                            echo "<span class='btn btn-danger btn-sm'>Your wallet amount is $wallet kindly recharge. </span>";
                                        }
                                        else{
                                            echo '<button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> NEXT </button>';
                                        }
                                        ?>
                                    </span>
                                     </div>
                                  <div class="card-body">
            <form id='update_frm' action='quick_student' > 
            <div class='row'>
            <div class="col-md-4 mb-3">
                <input type='hidden' value='<?php echo $id;?>' name='id'>
                <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
                <input type='hidden' name='status' value='VERIFIED'>
                <?php if($user_type<>'ADMIN') { ?>
                <input type='hidden' value ='<?php echo centerid($_SESSION['user_name']); ?>' name='center_id'>
                <?php } else {?>
                <div class="form-group mb-3">
                    <label>Select Study Center 
                        <!-- <span class='badge bg-danger' id='wallet_amount' style='display:none'> </span>   -->
                    </label>
                    <select class="form-select select2" name='center_id' id='center_id' onChange='centerName(this)'  required>
                       
                        <?php echo dropdown_list('center_details','id','center_name',$center_id,'center_code'); ?>
                    </select>
                    
                </div>  
                <?php } ?>
                <div class="form-group mb-3">
                    <label>Select Course Name  <span class='badge bg-success' id='course_data' style='display:none'> </span></label>
                    <select class="form-select select2" name='course_id' id='course_id'  required   >
                         <option value=''> Select Course </option>
                        <?php echo dropdown_list('course_details','id','course_code',$course_id,'course_duration'); ?>
                    </select>
                   
                </div>  
                <div class="form-group mb-3">
                    <label> Reg. No.
                     <?php if($user_type != 'ADMIN' && $isedit != 'yes'){ ?>
                    <B>
                         <?php
                         if($user_type=='CLIENT') echo substr(lastid(centerid($user_name)),-4); ?> </B>
                         <?php } ?>
                          <span id='rollNo'></span>
                     </label>
                    <input class="form-control" type='number' id='student_roll' placeholder="Valid 4 Digit" name='student_roll' value='<?php echo substr($student_roll,-4) ?>' minlength='4' maxlength='4' required>
                </div>
                <div class="form-group mb-3">
                    <label>Enter Student Name</label>
                    <input class="form-control cp" placeholder="Student Name Here" name='student_name' value='<?php echo $student_name ?>' required>
                </div>
                    <div class="form-group mb-3">
                    <label>Enter Mother's Name</label>
                    <input class="form-control cp" placeholder="Mother's Name" name='student_mother' value='<?php echo $student_mother ?>' >
                </div>
                <div class="form-group mb-3">
                    <label>Enter Father's Name</label>
                    <input class="form-control cp" placeholder="Father's Name" name='student_father' value='<?php echo $student_father ?>' required>
                </div>
                
               
               
            </div>
            <div class="col-md-4 mb-3">
                
                <div class="form-group mb-3">
                    <label>Date of Birth</label>
                    <input class="form-control"  type='date' name='date_of_birth' max='2015-01-01' value='<?php echo $date_of_birth ?>'>
                </div>

                <div class="form-group mb-3">
                    <label>Select Sex</label>
                    <select class="form-select" name='student_sex' required>
                        <?php echo dropdown($gender_list,$student_sex); ?>
                    </select>
                </div>
            
                <div class="form-group mb-3">
                    <label>Address </label>
                    <textarea class="form-control cp" rows="3" name='student_address'><?php echo $student_address ?></textarea>
                </div>
                
                
                 <div class="form-group mb-3">
                    <label>Enter Mobile No.  </label>
                    <input class="form-control"  type='number' minlength='10' name='student_mobile' maxlength='10' value='<?php echo $student_mobile ?>' required>
                </div>
              <div class="form-group mb-3">
                    <label>Enter Email Id. </label>
                    <input class="form-control" placeholder="someone@email.com" name='student_email' type='email' value='<?php echo $student_email ?>' >
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="form-group mb-3">
                    <label>Select Qualification </label>
                    <select class="form-select select2 " name='student_qualification'>
                        <?php echo dropdown($qualification_list,$student_qualification); ?>
                    </select>
                </div>
                 
                <input type='hidden' name='student_photo' id='targetimg' value='<?php echo $student_photo ?>'>
                <input type='hidden' name='student_id_proof' id='target_id_proof' value='<?php echo $student_id_proof ?>'>
                <input type='hidden' name='student_edu_proof' id='target_edu_proof' value='<?php echo $student_edu_proof ?>'>
             </form>
             <form id='uploadForm' enctype= 'multipart/form-data'>
                <div id='display'></div>
                <div class="form-group">
                    <label>Upload Photograph (Max 50 KB) </label>
                    <input class="form-control" type='file' name='uploadimg' id='uploadimg' accept='image'>
                    <br><small> Only Jpg and Png image upto 50KB. </small>
                </div>
                
            </form>
             <hr> 
            <form id='id_proof' enctype= 'multipart/form-data'>
                <div id='student_id_display'></div>
                <div class="form-group">
                    <label>Upload Identity Card </label><br>
                    <input class="form-control" type='file' name='uploadimg' id='upload_id_proof' accept='image'>
                    <br><small> Scan copy of VIC, Aadhar, PAN, DL etc. </small>
                </div>
                
            </form>
            <hr>
            <form id='edu_proof' enctype= 'multipart/form-data'>
                <div id='student_edu_display'></div>
                <div class="form-group">
                    <label>Upload Educational Certificate</label>
                    <input class="form-control" type='file' name='uploadimg' id='upload_edu_proof' accept='image'>
                    <br><small> Marks Sheet, Certificate etc.</small>
                </div>
                
            </form>
            
            <hr> 
          
          
            
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
        
       // $('#rollNo').html("<span class='badge bg-success'>"+obj.roll_no+"</span>");
       var lastFive = obj.roll_no.substr(obj.roll_no.length - 4); // => "Tabs1"
        $('#rollNo').html("<b class='text-danger'>- "+lastFive+"</b>");
    }
});
}
</script>