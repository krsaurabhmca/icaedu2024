<?php require_once('temp/sidebar.php'); 
if($user_type =='CLIENT')
{
	$center_id =centerid($user_name);
}
else if(isset($_GET['center_id']))
{
	$center_id =$_SESSION['center_id'] = $_GET['center_id'];
}
// else if(isset($_SESSION['center_id']))
// {
// 	$center_id =$_SESSION['center_id'];
// }

else{
	$center_id =null;
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
                                    <h4 class="mb-sm-0 font-size-18">View Result Details</h4>
                                    <div class="page-title-right">
		                             <?php if ($user_type =='ADMIN')  {?>
									<form action='' method='get'>
									<select name='center_id' onChange='submit()' class='h6 select2'>
										<?php dropdown_list('center_details' ,'id', 'center_name', $center_id,'center_code' ); ?>
									</select>
									</form>
									<?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body"><?=  $cntr_no ?>
			       <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Reg. No.</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>P1</th>
											<th>P2</th>
                                            <th>P3</th>
                                            <th>P4</th>
                                            <th>P5</th>
                                            <th>P6</th>
                                            <th>P7</th>
                                            <th>P8</th>
                                            <th> Total</th>
                                            <th> Per </th>
                                            <th> Grade</th>
                                            <th> Serial</th>
                                            <th > Action </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
									
									if($center_id <> null)
										{		
									    $sql ="select result.*, student.center_id from result,student where result.student_id =student.id and student.center_id ='$center_id' and student.status in ('DISPATCHED','RESULT OUT')";
										}
										else{
								        $sql ="select result.*, student.* from result,student where student.status in ('RESULT OUT') and result.student_id = student.id";
									   	}
									//$sql ="select result.*, student.center_id from result,student where result.student_id =student.id and student.center_id ='$center_id' and student.status in ('DISPATCHED','RESULT OUT')";
									
								    //echo $sql	;
								    	$res = direct_sql($sql);
										foreach($res['data'] as $row )
										{
										    
										$result_id =$row['id'];
										
										$stu_id = $row['student_id'];
										
										 $cntr_id = get_data('student',$stu_id,'center_id')['data'];
										 
										 $cntr_no = get_data('center_details',$cntr_id,'center_mobile')['data'];
										 
										  //$cntr_no = '8271055515';
										 
										$ed_link = encode('student_id='.$stu_id);
										$course_type = courseinfo($stu_id,'course_type');
                                        
										echo"<tr class='odd gradeX'>";
										echo"<td>".studentinfo($stu_id,'student_roll')."</td>";
										echo"<td>".studentinfo($stu_id, 'student_name')."</td>";
										echo"<td>".courseinfo($stu_id,'course_code')."</td>";
										//echo"<td>".$row['exam_name']."</td>";
										$status =studentinfo($stu_id,'status');
										
                                        echo"<td>".$row['paper1']."</td>";
                                        echo"<td>".$row['paper2']."</td>";
                                        echo"<td>".$row['paper3']."</td>";
                                        echo"<td>".$row['paper4']."</td>";
                                        echo"<td>".$row['paper5']."</td>";
                                        echo"<td>".$row['paper6']."</td>";
                                        echo"<td>".$row['paper7']."</td>";
                                        echo"<td>".$row['paper8']."</td>";
                                        
                                        if($course_type ==8)
											{
                                       echo "<td> </td>";
                                       echo "<td> </td>";
                                       echo "<td> </td>";
											}
										else{
										   
										echo"<td>".$row['total']."</td>";
                                        echo"<td>".$row['percentage']."</td>";
                                        echo"<td>".$row['grade']."</td>";
                                        }
                                        
										echo"<td>".$row['cer_no']."</td>";	
                                     
                                        echo "<td>";
										if ($status =='RESULT OUT' or $status =='DISPATCHED' )
										{
											if($course_type ==8)
											{
											    	
                                                echo wa_button('pdf_c_typing.php?link='.$ed_link,$cntr_no,studentinfo($stu_id, 'student_name')." Typing Certificate",null,'Send Certificate','primary');
                                        
											    echo "<a href='pdf_c_typing.php?link=".$ed_link."' target='_blank' title='Print Typing Certificate ' >
												<button type='submit' class='btn btn-primary btn-sm' name='Pay_fee'>TY Certificate </button></a>";	
											}
											else if($course_type ==9)
											{
											    
											     echo wa_button('pdf_c_certificate.php?link='.$ed_link,$cntr_no,studentinfo($stu_id, 'student_name')." Certificate",null,'Send Certificate','primary');
											      echo "<a href='pdf_c_certificate.php?link=".$ed_link."' target='_blank' title='Print Certificate ' >
												
    											  <button type='submit' class='btn btn-warning btn-sm' name='certificate'><i class='fa fa-file-pdf'></i> </button></a>";
    										
                                                  
                                             
												  echo "<a href='pdf_c_ms_pgdca.php?link=".$ed_link."' target='_blank' title='PDF Result Sheet '>
												  <button type='submit' class='btn btn-success btn-sm' name='Download PDF'><i class='fa fa-file-pdf'></i></button></a>";
												  echo wa_button('pdf_c_ms_pgdca.php?link='.$ed_link,$cntr_no,studentinfo($stu_id, 'student_name')." Masksheet",null,'Send Marksheet','success');
                                        
											}
											else if($course_type ==4)
											{
											    	
                                        
                                            echo wa_button('print_c_v_certificate.php?link='.$ed_link,$cntr_no,studentinfo($stu_id, 'student_name')." Certificate",null,'Send C.V Certificate','primary');
                                        
												echo "<a href='print_c_v_certificate.php?link=".$ed_link."' target='_blank' title='Print Vocational Certificate ' >
											<button type='submit' class='btn btn-danger btn-sm' name='Pay_fee'>VC Certificate </button></a>";	
											}
											 else if($course_type ==2 or $course_type ==3 or $course_type ==5 or $course_type ==6 or  $course_type ==7)
											{
											    
                                        
                                        echo wa_button('print_c_ms_tech.php?link='.$ed_link,$cntr_no,studentinfo($stu_id, 'student_name')." Marksheet",null,'Send Marksheet','primary');
                                        
											 echo "<a href='print_c_ms_tech.php?student_id=$stu_id' target='_blank' title='Print Tech Result Sheet ' >
												<button type='submit' class='btn btn-success btn-sm' name='Pay_fee'>Marks </button></a>";	
												echo "<a href='print_c_certificate.php?link=".$ed_link."' target='_blank' title='Print Technical Certificate ' >
											<button type='submit' class='btn btn-warning btn-sm' name='certificate'>Certificate </button></a>";		
											}
											else{
												//echo "<a href='print_c_ms.php?link=".$ed_link."' target='_blank' title='Print Result Sheet ' >
												//<button type='submit' class='btn btn-success btn-sm' name='Pay_fee'>Marks </button></a>";
												
                                        
                                        echo wa_button('pdf_c_ms.php?link='.$ed_link,$cntr_no,studentinfo($stu_id, 'student_name')." Marks sheet",null,'Send Marksheet','success');
                                        
												echo "<a href='pdf_c_ms.php?link=".$ed_link."' target='_blank' title='PDF Result Sheet '>
												<button type='submit' class='btn btn-success btn-sm' name='Download PDF'><i class='fa fa-file-pdf'></i></button></a>";	
												echo "<a href='pdf_c_certificate.php?link=".$ed_link."' target='_blank' title='Print Certificate ' >
												
											<button type='submit' class='btn btn-warning btn-sm' name='certificate'><i class='fa fa-file-pdf'></i> </button></a>";
										
                                        echo wa_button('pdf_c_certificate.php?link='.$ed_link,$cntr_no,studentinfo($stu_id, 'student_name')." Certificate",null,'Send Certificate','primary');
                                        
											}
										}		
                                        echo "</td></tr>";
										}
										
                                       ?>
                                      
                                    </tbody>
                                </table>
                           </div>
                        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
<!--</div>-->
<!--</div>-->
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>