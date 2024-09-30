<?php require_once('temp/header.php'); ?>
<?php require_once('temp/sidebar.php'); ?>
   <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
    
        <div class="row">
         <div class="col-lg-12">
            <div class="card">
            <div class="card-header bg-warning">
                List of Issued Admit Card 
            </div>
             <div class="card-body">
             <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
							      <thead>
                                        <tr>
                                            <th>Reg. No.</th>
                                            <th>Student Name</th>
                                            <th>DOB</th>
											<th>Exam Date </th>
											<th>Venue</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
										
										<?php 
										if($_SESSION['user_type']=='ADMIN')
										{
										$sql ="select * from admit_card ";
										}
										else{
										    $center_id = centerid($_SESSION['user_name']);
										 	$sql ="select admit_card.*, student.center_id from admit_card, student where student.student_roll = admit_card.student_roll and center_id ='$center_id'";   
										}

										$res = mysqli_query($con,$sql) or die ("Error in selecting Student". mysqli_error($con));
										
										while($row =mysqli_fetch_array($res))
										{
										
										$sinfo = get_data('student',$row['student_roll'], null ,'student_roll')['data'];
										$center_code =centerinfo($sinfo['student_id'], 'center_code');
										echo"<tr class='odd gradeX'>";
										echo"<td>".$row['student_roll']."</td>";
										echo"<td>".$sinfo['student_name']."</td>";
										echo"<td>".$sinfo['date_of_birth']."</td>";
										echo"<td>".date('d-M-Y',strtotime($row['exam_date']))."</td>";
										echo"<td>".$row['exam_venue']."</td>";
										echo"<td>".$row['exam_time']."</td>";
										echo"<td>";
										echo "  <a href='print_admit_card.php?registration=".$row['student_roll']."' target='print' class='btn btn-primary btn-sm'> <i class='fa fa-print'></i></a>";
									
										echo "&nbsp;&nbsp;". btn_delete('admit_card', $row['id']);
									
                                        echo "</td></tr>";
										}
                                       ?>
                                     </tr> 
                                    </tbody>
									
										
                                </table>
					
                            </div>
            </div>
            </div>
            </div>
<?php require_once('temp/footer.php'); ?>