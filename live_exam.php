<?php require_once('temp/sidebar.php'); ?>
<meta http-equiv="refresh" content="30">
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
                                    <h4 class="mb-sm-0 font-size-18">Live Exam</h4>
                                    <div class="page-title-right">
		                           Auto Refresh on Every 30 Seconds
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
                                            <th>Student Details</th>
                                           	<th>Set Details</th>
											<th>Live Photo</th>
											<th>Status</th>
											
                                        </tr>
                                    </thead>
                                   <tbody>
										<?php 
										$sql ="select * from answer where status ='PENDING' and DATE_FORMAT(updated_at,'%Y-%m-%d') ='$today'"; 
										$res = direct_sql($sql);
										
										foreach($res['data'] as $row )
										{
										$id =$row['id'];
										$student_id =$row['student_id'];
										$set_id =$row['set_id'];
										
										$student =get_data('student',$student_id)['data'];
									
										$center =get_data('center_details',$student['center_id'])['data'];
										
										$set =get_data('set_details',$set_id)['data'];
										
										echo "<tr class='odd gradeX'>";
										
										echo"<td>".
										$center['center_name']."</br><b>". $student['student_name'] ."</b><br>". $student['student_roll']."</td>";
										
										echo"<td>".$set['set_name']."</br>".
										 $set['duration']." Minutes </td>";
                                       
                                        echo"<td><img src='".$row['live_photo']."' width='100px' /></td>";
                                        
                                        echo"<td>".$row['entry_time']. "<br><b>".$row['status']."</b><br>".
										 btn_delete('answer',$id);
										
									    echo "</td></tr>";
										}
                                       ?>
                                     
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
			 true
		});
		
    </script>