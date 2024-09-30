<?php require_once('student_temp/sidebar.php'); 
$sid =$_SESSION['user_id'];
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
                                    <h4 class="mb-sm-0 font-size-18">Registration Details</h4>
                                    <div class="page-title-right">
		                           
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			      <div class='row'>
				        <div class='col-md-8'>
                                 <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
									
									<tr>
									<td> <label> Name </label> </td> <td> : </td>
                                    <td> <b> <?php echo studentinfo($sid,'student_name'); ?> </b> </td>
									
									</tr>
									
									<tr>
									<td> <label> Mother's Name </label> </td> <td> : </td>
									<td> <?php echo studentinfo($sid,'student_mother'); ?> </td>
                                    
                                    </tr>
									
									<tr>
									<td> <label> Father's Name </label> </td> <td> : </td>
									<td> <?php echo studentinfo($sid,'student_father'); ?> </td>
                                    
                                    </tr>
									
									<tr>
									<td> <label> Date of Birth </label> </td> <td> : </td>
                                    <td> <?php echo date('d-M-Y',strtotime(studentinfo($sid,'date_of_birth'))); ?> </td>
									</tr>
									<tr>
									<td> <label> Course Title</label> </td> <td> : </td>
                                    <td> <?php echo courseinfo($sid,'course_name'); ?> 
									 ( <?php echo courseinfo($sid,'course_code'); ?> )
									</td>
									</tr>
									<tr>
									<td> <label> Course Duration</label> </td> <td> : </td>
                                    <td> <?php echo courseinfo($sid,'course_duration'); ?> Months </td>
									</tr>
									
									<tr>
									<td width='190'> <label> Center Code </label> </td> <td> : </td>
									<td> <?php echo centerinfo($sid,'center_code'); ?> </td>
									</tr>
									<tr>
									<td width='190'> <label> Center Name </label> </td> <td> : </td>
									<td> <?php echo centerinfo($sid,'center_name'); ?> </td>
									</tr>
									<tr>
									<td width='190'> <label> Center Address </label> </td> <td> : </td>
									<td> <?php echo centerinfo($sid,'center_address'); ?>, <?php echo distinfo(centerinfo($sid,'dist_code'),'dist_name'); ?> </td>
									
									</tr>
							
									
								    </table>
						</div>
						<div class='col text-center'>
						        <img src='../temp/upload/<?php  echo studentinfo($sid,'student_photo'); ?>' alt ='<?php echo studentinfo($sid,'student_photo'); ?>' width ='150' height='180' /> <br>
						        <?php echo "Reg. No. <b>" .studentinfo($sid,'student_roll') ."</b>"; ?>
						</div>
				</div>
              </div>
            </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('student_temp/footer.php'); ?>