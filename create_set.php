<?php require_once('temp/sidebar.php'); 
if(isset($_GET['link']))
{
    $arr = decode($_GET['link']);
    $data  = get_data('set_details',$arr['id'])['data'];
    $isedit = 'yes';
    extract($data);
}
else{
    $res1  =insert_row('set_details');
    $id1 = $res1['id'];
    $data  = get_data('set_details',$id1)['data'];
    $isedit = 'no';
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
                                    <h4 class="mb-sm-0 font-size-18">Create Exam Set</h4>
                                    <div class="page-title-right">
		                            	
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
		<div class="card-header <?php echo $bgClr ?> font-weight-bold">
           Set Details 
              <button type="submit" class="btn btn-sm btn-success btn-sm" id='update_btn' style="float:right">Save Set </button>
             </span>
        </div>
        <div class="card-body">
			  <form id='update_frm'  action='create_set' enctype='multipart/form-data'>
                <div class='row'>
                   
                    <div class="col-md-4">
                              <input type='hidden' class="form-control" name='isedit' value='<?php echo $isedit;?>' >
                        <div class="form-group mb-3">
                            <label>Select Course Name </label>
                            <input type='hidden' value ='<?php echo $id; ?>' name='id' >
                            <select class="form-select select2" name='course_id'  required>
                                <?php echo dropdown_list('course_details','id','course_code',$course_id); ?>
                            </select>
                            
                        </div>  
                        <div class="form-group mb-3">
                            <label>Set Name</label>
                            <input class="form-control" name='set_name' value='<?php echo $set_name;?>' required>
                        </div>                                          
                        <div class="form-group mb-3">
                            <label>Start Date & Time </label>
                            <input class="form-control" type="datetime-local"  value='<?php echo date('Y-m-d\TH:i:s', strtotime($start_date));?>'  name='start_date' required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label>End Date & Time </label>
                            <input class="form-control" type="datetime-local" min ='<?php echo date('Y-m-d\TH:i:s'); ?>' value='<?php echo date('Y-m-d\TH:i:s', strtotime($end_date));?>' name='end_date' required>
                        </div>
                    </div>
                    <div class="col-md-4">
                           
                        <div class='row'>
                        <div class="form-group col-6 mb-3">
                            <label>Marks/Question <small>(Right)</small>  </label>
                            <input class="form-control" type ='number' min ='0'  step ='0.25' name='marks_plus' value='<?php echo $marks_plus;?>' >
                        </div>
                     
                        <div class="form-group col-6 mb-3">
                            <label>Marks/Question  <small>(Wrong)</small>  </label>
                            <input class="form-control" type ='number' max ='0'  step ='-0.25' name='marks_minus' value='<?php echo $marks_minus;?>'  placeholder='Must be negative'>
                            
                        </div>
                        </div>
                    <!-- </div> -->
                    
                    <!-- <div class="col-md-4"> -->
                                <div class="form-group mb-3">
                                    <label>Duration (in Minutes) </label>
                                    <input class="form-control" type='number'  value='<?php echo $duration;?>' placeholder='in Minutes'   name='duration' min='1'  required>
                                </div>
                                    <div class="form-group mb-3">
                                    <label>Total No. of Questions </label>
                                    <input class="form-control" type='number' min='1' value='<?php echo $question;?>' placeholder='Total'  name='question'  required>
                                </div>
                            <div class="form-group mb-3">
                            <label> Status </label>
                            <select class="form-select select2" name='status'  required>
                               <?php echo dropdown($status_exam, $status); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                           
                        
                        <div class="form-group mb-3">
                            <label>Auto Skip Question <small>(in Second)</small>  </label>
                            <input class="form-control" type ='number' min ='0'  step ='5' name='auto_skip' value='<?php echo $auto_skip;?>' placeholder='Default 0 Means Not Skip' >
                           
                        </div>
                        
                        <div class="form-group mb-3">
                            <label>Number of Attempt </label>
                            <input class="form-control" type ='number' min ='0'  step ='1' name='no_of_attempt' value='<?php echo $no_of_attempt;?>' placeholder='Default 1' >
                        </div>
                        
                        <div class="form-group mb-3">
                            <label>Auto Capture Photo Interval (in Minutes) </label>
                            <input class="form-control" type='number'  value='<?php echo $auto_capture_photo;?>' placeholder='default 30 Minutes'  name='auto_capture_photo' min='1'  required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label>Restart Exam </label>
                            <select class="form-select select2" name='restart_exam'  >
                               <?php echo dropdown($permission_list, $restart_exam); ?>
                            </select>
                        </div>
                        
                    </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

	<script>
      $('#summernote').summernote({
        placeholder: 'Type your text here',
        tabsize: 2,
        height:100
      });
   
      $('#summernote1').summernote({
        placeholder: 'Type your text here',
        tabsize: 2,
        height:100
      });
    </script>
