<?php require_once('temp/sidebar.php'); 
// EDIT THIS
    $table ='course_details';
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

                        <!-- start page title -->
                       <!--  <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Add New Course</h4>

                                    <div class="page-title-right">
                                    <button type="button" class="btn btn-primary btn-sm" id='add_course_type' style='float:right'><i class='fa fa-plus' title='Add New Course Type'></i></button>
                                    </div>

                                </div>
                            </div>
                        </div> -->
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                <div class="card-header <?php echo $bgClr ?> font-weight-bold">
                                   Enter Course Details
                                    <span class='float-right' style='float:right'>
                                    <a href='manage_course'>  <button class="btn btn-dark btn-sm" > View All </button></a> 
                                    <button class="btn btn-success btn-sm" id='update_btn' accesskey='s'> SAVE </button>
                                    </span>
                                </div>
                        <div class="card-body">
                        <div class="row">
                        <div class="col-6">
                       <form id='update_frm' action='add_course' enctype='multipart/form-data'>
                        <div class="form-group mb-4">
                            <label>Select Course Type &nbsp<i class='fa fa-plus-circle text-info' id='add_course_type' title='Add New Course Type'></i></label>
                            <input type='hidden' name='id' value='<?php echo $id; ?>'>
                            <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
                            <input type='hidden' name='status' value='ACTIVE'>
                            <select class="form-select form-control" name='course_type' id='course_name'  required>
                                <?php echo dropdown_list('default_course','id','course_type',$course_type); ?>
                            </select>
                            
                        </div>  
                        
                        <div class="form-group mb-4">
                            <label>Enter Course Code </label>
                            <input class="form-control"  name='course_code' autofocus value="<?php echo $course_code ?>" required>
                        </div>  
                        <div class="form-group mb-4">
                            <label>Enter Course Name /Title </label>
                            <input class="form-control" name='course_name' value="<?php echo $course_name ?>" required>
                        </div>                                          
                        <div class="form-group mb-4">
                            <label> Course Eligibility </label>
                            <select class="form-select form-control" name='course_eligibility'  required>
                               <?php echo dropdown($qualification_list,$course_eligibility); ?>
                            </select>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label>Enrollment Fee </label>
                            <input class="form-control" name='course_fee' type='number' value="<?php echo $course_fee ?>" required>
                        </div>
                        <?php if($isedit == 'yes' && $user_type=='ADMIN') {?>
                        <div class="form-group mb-4">
                            <label>Status </label>
                            <select class="form-select" name='status'value="<?php echo $status ?>" >
                                <?php dropdown($status_simple,$status); ?>
                            </select>
                        </div>
                        <?php }else{ ?>
                        <input type='hidden' name='status' value='ACTIVE'>
                        <?php } ?> 
                    </div>
                    <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label>Select Course Duration</label>
                                <input class="form-control" name='course_duration' min='1' type='number' value="<?php echo $course_duration ?>" required>
                            </div>

                            <div class="form-group mb-4">
                                <label>Select Course Unit </label>
                                <select class="form-select form-control" name='course_unit'  required>
                                    <?php echo dropdown($unit_list,$course_unit); ?>
                                </select>
                            </div>
                            
                            
                            <div class="form-group mb-4"> 
                            <label>Syllabus (Select Multiple Topics)&nbsp<i class="fa fa-plus-circle text-info" data-bs-toggle="modal" data-bs-target="#subModal"></i> </label>
                            <select name='course_syllabus[]'  class='form-select select2' multiple="multiple" required>
                                <?php echo dropdown_list_multiple('subject','id','sub_name',explode(',',$course_syllabus)); ?>
                                
                            </select>
                            <input type='hidden' name='course_image' id='targetimg'>
                             </div>  
                              <div class="form-group mb-4">
                            <label>Course Module in Text</label>
                            <textarea class="form-control"  name='course_module'><?php echo $course_module ?></textarea>
                        </div>  
                    </form>
                        <form id='uploadForm' enctype= 'multipart/form-data'>
                            <div class="form-group mb-4">
                                <label>Upload Syllabus <small> Image(PNG Only) </small></label>
                                <input type='file' name='uploadimg' id='uploadimg' accept='image' class='form-control'>
                            </div>
                            <input type="hidden" id='edit_img' value="<?php echo $course_image ?>">
                            <div id='display'></div>
                        </form>
              </div>
                </div>
                <!-- end select2 -->

            </div>

       <!--  <div class="card-footer bg-white">
            <button type="submit" class="btn btn-primary" id='insert_btn'>Add New Course</button>
        </div> -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<!-- Modal -->
<div class="modal fade" id="subModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id='insert_frm' action='add_subject' enctype='multipart/form-data'>
         <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Subject Name</label>
            <input type="text" class="form-control" name="sub_name">
          </div>         
          <!--<div class="mb-3">-->
            <!--<label for="recipient-name" class="col-form-label">Status </label>-->
             <input type="hidden" class="form-control" name="status" value='ACTIVE'>
            <!--<select type="text" class="form-control form-select" name="status">-->
                <?php  //dropdown($status_simple); ?>
            <!--</select>-->
          <!--</div>-->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="insert_btn">Save </button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
<?php require_once('temp/footer.php'); ?>
<script type="text/javascript">
//===========Edited Image ==============//

$( document ).ready(function() {
 var edit_img = $('#edit_img').val();
 var display = $('#display').val();
 if(edit_img !='' || display !=''){
 if(display !=''){
    $("#display").html("<img src='temp/upload/"+obj.id +"' width='100px' height='100px' class='img-thumbnail'>");
}else{
    $("#display").html("<img src='temp/upload/"+edit_img +"' width='100px' height='100px' class='img-thumbnail'>");
}
}
});
</script>