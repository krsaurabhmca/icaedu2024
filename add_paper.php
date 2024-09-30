<?php require_once('temp/sidebar.php'); 

// EDIT THIS
    $table_name ='paper_list';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table_name, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
    } else {
        $res  = insert_row($table_name);
        $id = $res['id'];
        $isedit = 'no';
        $data  = get_data($table_name, $id)['data'];
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
                                    <h4 class="mb-sm-0 font-size-18">Add Exam Paper</h4>
                                    <div class="page-title-right">
                                        <form>
		                           <select name='course_id' onchange='submit()' class='form-select select2'>
		                               <?= dropdown_list('course_details','id','course_code', $_GET['course_id'], 'course_name' ); ?> 
		                           </select>
		                           </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-header <?php echo $bgClr ?> font-weight-bold">
                        
                           Details of Exam Paper 
                           
                           <a href='add_paper' class='btn btn-primary btn-sm float-end'> Show All </a>
        </div>
        <div class="card-body">
			       <div class="row">
							<div class="col-lg-3">
                <!--<form action ='add_paper' id='insert_frm' >-->
				 <form id='update_frm' action='add_paper' enctype='multipart/form-data'>
				      <input type='hidden' name='id' value='<?php echo $id; ?>'>
                      <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
                            
						<div class="form-group">
                            <div class="form-group mb-3">
								<label>Select Course Name </label>
								<select class="form-control select2" name='course_id' id='course_id' required>
									<?php dropdown_list('course_details','id','course_code',@$course_id, 'course_name'); ?>
								</select>
								
							</div>	
                        </div>
						<div class="form-group mb-3">
                          <label>Paper Name</label>   
                            <input class="form-control" name='paper_name' type='text' value='<?= $paper_name ?>' required >
                        </div>
                      
						<div class="form-group mb-3">
                            <label class="control-label" for="inputError">Full Marks</label>
                            <input type="number" class="form-control" name='full_marks' value='<?= $full_marks ?>' required>
                        </div>
						<div class="form-group mb-3">
                            <label class="control-label" for="inputError">Pass Marks</label>
                            <input type="number" class="form-control" name='pass_marks' value='<?= $pass_marks ?>' required>
                        </div>
						<button type="submit" class="btn btn-primary" id='update_btn'>Add New Paper</button>
					</div>

					
					<div class="col-lg-9">
						<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="data_tbl">
                                
                                    <thead >
                                        <tr>
                                            <th>Course</th>
                                            <th>Paper Name</th>
                                            <th>Full Marks</th>
                                            <th>Pass Marks</th>
                                            <th>#</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									if(isset($_GET['course_id']) and $_GET['course_id'] !='')
									{
									    $res  = get_all($table_name, '*',['course_id'=>$_GET['course_id']]);
									}
									else{
									    $res  = get_all($table_name);
									}
								
									foreach($res['data'] as $row)
									{
											$paper_id =$row['id'];
											$c_id = $row['course_id'];
											$course_code = get_data('course_details',$c_id,'course_code')['data'];
											$course_name = get_data('course_details',$c_id,'course_name')['data'];
											echo "<tr>";
											echo "<td> <a href='add_paper?course_id=$c_id' title ='$course_name'>$course_code</a></td>";
											echo "<td> ". $row['paper_name'] ."</td>";
											echo "<td> ". $row['full_marks'] ."</td>";
											echo "<td> ". $row['pass_marks'] ."</td>";
									?>
									<td>
									    <?php 
									   // echo btn_edit($table_name,$paper_id,'add_paper'); 
									    echo btn_edit('add_paper',$paper_id); 
									    
									    ?>
									    
									    <?php echo btn_delete($table_name,$paper_id); ?>
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
