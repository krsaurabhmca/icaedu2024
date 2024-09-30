<?php require_once('temp/sidebar.php'); 
if(isset($_GET['set_id']))
{
	$set_id = $_GET['set_id'];
}
else{
	$set_id= null;
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
                                    <h4 class="mb-sm-0 font-size-18">Performance Report
                                    </h4>
                                    <div class="page-title-right">
		                             <form action ='' method='get'>
										<select name='set_id' onblur='submit()' onchange='submit()' class='h6'>
											<option value=''> Select Set </option>
											<?php dropdown_list('set_details','id','set_name',$set_id); ?>
										</select>
										</form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
		<div class="card-header <?php echo $bgClr ?>  font-weight-bold">
          Performance Report
            <button class='btn btn-danger btn-sm' style='float:right;' onClick ='exportxls()'> Export </button>
			
        </div>
        <div class="card-body">
		
                       <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Exam Date</th>
                                            <th>Course </th>
                                            <th>Roll</th>
											<th>Name</th>
                                            <th>Set Name</th>
                                           
                                            <th>Total</th>
                                            <th>Correct</th>
                                            <th>Wrong  </th>
                                            <th>Unsolved </th>
                                            <th>Marks </th>
                                            <th>Analysis</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										if(isset($set_id))
										{
										
										if($user_type =='ADMIN')
										{
											$res = get_all('answer','*',array('set_id'=>$set_id));
										}else{
										 $center_id = centerid($_SESSION['user_name']);
										$sql ="SELECT answer.*, student.course_id, student.center_id FROM answer, student  where answer.student_id = student.id and center_id = '$center_id' and set_id = '$set_id'";
										    $res = direct_sql($sql);
										    
										}
										if($res['count']>0)
											{
												
												foreach($res['data'] as $row)
												{
													$student_id = $row['student_id'];
													$set_id = $row['set_id'];
													$link = encode('set_id='.$set_id.'&student_id='.$student_id);
													$result = set_result($student_id,$set_id);
													$student_name = get_data('student',$student_id,'student_name','id')['data'];
													$student_class = get_data('course_details',get_data('student',$student_id,'course_id','id')['data'],'course_code')['data'];
										
										$student_name = get_data('student',$student_id,'student_name','id')['data'];
										
										$student_roll = get_data('student',$student_id,'student_roll','id')['data'];
													//$student_name = get_data('visitor',$student_id,'name')['data'];
												echo"<tr class='odd gradeX'>";
														echo"<td>".date('d-M-Y', strtotime($row['entry_time']))."</td>";
												
											echo"<td>".$student_class."</td>";
											echo"<td>".$student_roll."</td>";
											echo"<td>".$student_name."</td>";
												echo"<td>".get_data('set_details',$set_id,'set_name')['data']."</td>";
												
									
												echo"<td>".get_data('set_details',$set_id,'question')['data']."</td>";
												
												echo"<td>".$result['correct']."</td>";
												echo"<td>".$result['wrong']."</td>";
												echo"<td>".$result['unsolved']."</td>";
												echo"<td>".$result['marks']."</td>";
												
												echo"<td width='55'>";
												echo "<a href='analysis_report?link=$link' title='Analysis Report ' >
												<button class='btn btn-info btn-sm' name='Pay_fee'><i class='fa fa-table'></i></button></a>";
										?>
												<span  class='delete_btn btn btn-sm btn-danger' data-id='<?php echo $row['id'];?>' data-table='answer' data-pkey='id' title='Reset Exam' data-per='yes'><i class='fa fa-trash'></i></button></span> 
										<?php
												echo "</td></tr>";
												}
											}
										}
                                       ?>
                                     </tr> 
                                    </tbody>
									
                                </table>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
