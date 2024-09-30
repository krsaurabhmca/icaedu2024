<?php require_once('temp/sidebar.php'); ?>
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
                                    <h4 class="mb-sm-0 font-size-18">Add New Course</h4>
                                    <div class="page-title-right">
		                           
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-header <?php echo $bgClr ?> font-weight-bold">
                        
                           Details of Exam Paper 
        </div>
        <div class="card-body">
			       <div class="row">
							<div class="col-lg-3">
                <form action ='add_paper' id='insert_frm' >
				
						<div class="form-group">
                            <div class="form-group mb-3">
								<label>Select Course Name <span class='badge bg-success' id='course_data' style='display:none'> </span></label>
								<select class="form-control" name='course_id' id='course_id' required>
									<?php dropdown_list('course_details','id','course_code',null, 'course_name'); ?>
								</select>
								
							</div>	
                        </div>
						<div class="form-group mb-3">
                          <label>Paper Name</label>   
                            <input class="form-control" value='' name='paper_name' type='text' required >
                        </div>
						<div class="form-group mb-3">
                            <label class="control-label" for="inputError">Full Marks</label>
                            <input type="number" class="form-control" name='full_marks' required>
                        </div>
						<div class="form-group mb-3">
                            <label class="control-label" for="inputError">Pass Marks</label>
                            <input type="number" class="form-control" name='pass_marks' required>
                        </div>
						<button type="submit" class="btn btn-primary" id='insert_btn'>Add New Paper</button>
					</div>

					
					<div class="col-lg-9">
						<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="data_tbl">
                                
                                    <thead >
                                        <tr>
                                            <th>Course</th>
                                            <th>Duration</th>
                                            <th>Paper Name</th>
                                            <th>Full Marks</th>
                                            <th>Pass Marks</th>
                                            <th>#</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql ="select * from paper_list order by paper_name desc";
									$res = direct_sql($sql);
									foreach($res['data'] as $row)
									{
											$paper_id =$row['id'];
											$c_id = $row['course_id'];
											echo "<tr>";
											
										echo "<td> <a href='#' title ='".get_data('course_details',$c_id,'course_name','id')['data']."'>". get_data('course_details',$c_id,'course_code','id')['data'] ."[".get_data('course_details',$c_id,'course_name','id')['data'] ."]</a></td>";
											
										echo "<td>". get_data('course_details',$c_id,'course_duration')['data'] . " ".get_data('course_details',$c_id,'course_unit')['data'] ." </td>";
											
											
											echo "<td> ". $row['paper_name'] ."</td>";
											echo "<td> ". $row['full_marks'] ."</td>";
											echo "<td> ". $row['pass_marks'] ."</td>";
									?>
									<td>
									    <?php echo btn_delete('paper_list',$paper_id); ?>
									</td>
									<?php		
											echo "</tr>";
									}
									?>
                                       
                                    </tbody>
                                </table>
                            </div>
					</div>
				</form>
					</div>	
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script>
        $(document).ready(function () {

			$('#course_tbl').dataTable();
		});
		
    </script>