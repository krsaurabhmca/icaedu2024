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
                                    <h4 class="mb-sm-0 font-size-18">Manage Course Details</h4>
                                    <div class="page-title-right">
		                           
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			      <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Course Type</th>
                                            <th>Course Code</th>
                                            <th>Course Name</th>
											<th>Duration</th>
											<th>Eligibility </th>
											<th>R. Fee</th>
											<th>Status</th>
											<th>Count</th>
											<th>Syllabus</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                   <tbody>
										<?php $sql ="select * from course_details where status not in ('AUTO','DELETED')"; 
										// where student_status='ACTIVE' order by student_id desc";
										$res = direct_sql($sql);
										
										foreach($res['data'] as $row )
										{
										$course_id =$row['id'];
										
										$ct = get_all('student', '*',['course_id'=>$course_id])['count'];
										$cimg =$row['course_image'];
										echo"<tr class='odd gradeX'>";
										encode('course_id='.$course_id);
										
										echo"<td>".get_data('default_course',$row['course_type'],'course_type','id')['data']."</td>";
										echo"<td>".$row['course_code']."</td>";
										echo"<td>".$row['course_name']."</td>";
                                        echo"<td>".$row['course_duration'] ." " .$row['course_unit']."</td>";
                                        //echo"<td>".$row['no_of_semester']."</td>";
                                        echo"<td>".$row['course_eligibility']."</td>";
                                        echo"<td>".$row['course_fee']."</td>";
                                        echo"<td>".show_status($row['status'])." </td>";
                                        echo"<td>".show_status($ct)." </td>";
                                        $sub = $row['course_syllabus'];
                                        $sub_id = explode(',',$sub);
                                       
                                        // if(is_string($sub_id) == false){
                                        	$subName = '';
                                        foreach($sub_id as $s_id){
                                        	 // print_r(is_integer($s_id));
                                        	$sub_name = get_data('subject',$s_id,'sub_name')['data'];
                                        	$subName .=$sub_name.",";
										}
										   echo"<td>".$subName." </td>";
									// }else{
										// echo"<td>".$row['course_syllabus']." </td>";
									// }
                                        echo"<td width='105'>";
										echo btn_edit('add_course',$course_id);
										echo btn_delete('course_details',$course_id);
										?>
										<a href='temp/upload/<?php echo $cimg; ?>' download='<?php echo $row['course_name']; ?>' class='btn btn-primary btn-sm'><i class='fa fa-download'></i></a>
											</td>
										
										<?php
									    echo "</tr>";
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
<script>
        $(document).ready(function () {

			$('#course_tbl').dataTable();
			 responsive: true
		});
		
    </script>