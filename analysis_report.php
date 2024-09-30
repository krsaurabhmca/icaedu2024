<?php include('temp/header.php');?>?>
<?php include('temp/sidebar.php');
if(isset($_GET['link']))
{
	$data = decode($_GET['link']);
	$set_id = $data['set_id'];
	$student_id = $data['student_id'];
    $set =get_data('set_details',$set_id)['data'];
    $student =get_data('student',$student_id)['data'];
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
               	<div class='col-9'>
				
                <h2 class="mb-4"><?php echo $student['student_name']; ?>
                </h2>
				</div>
				<div class='col-3' align='right'>
				    <button class='btn btn-success btn-sm' onClick ='exportxls()'> Export </button>
					<a href='set_result?set_id=<?php echo $set_id; ?>' class='btn btn-info btn-sm' > Back to List</a>
				</div>
		</div>
		<div class="card mb-4">
        <div class="card-body">
        
                                 <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <td colspan='9' class='bg-dark text-light'>
                                               <center><b> <?php echo
                                        $set['set_name'] . " | ".
                                        $student['student_name'] . " | ". 
                                        $student['student_roll']; ?>
                                                </b></center>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Question</th>
                                            <th>A</th>
                                            <th>B</th>
                                            <th>C</th>
                                            <th>D</th>
                                            <th title='Correct Answer'>CA</th>
                                            <th title='Your Answer'>YA</th>
                                            <th>Marks </th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										$set = get_data('set_details',$set_id);
										if($set['count']>0)
										{	
											$marks =0;
											$qlist = explode(',',$set['data']['question_list']); 
											$res  = get_all('answer','*', array('set_id'=>$set_id,'student_id'=>$student_id,'status'=>'FINISH'));
											$i=1;
											if($res['count']>0)
											{
												foreach ($qlist as $q)
												{
													$qinfo  = get_data('qbank',$q,null,'id')['data'];
													$oans = $qinfo['answer'];
													$yans = $res['data'][0]['q_'.$i];
													if($yans =='')
													{
														$marks = 0;
													}
													elseif($oans ==$yans)
													{
														$marks = $set['data']['marks_plus'];
													}
													else{
														$marks = $set['data']['marks_minus'];
													}
													
													echo"<tr class='odd gradeX'>";
													echo"<td>".$i."</td>";
										echo"<td>". base64_decode($qinfo['question'])."</td>";
													echo"<td>".$qinfo['opt1']."</td>";
													echo"<td>".$qinfo['opt2']."</td>";
													echo"<td>".$qinfo['opt3']."</td>";
													echo"<td>".$qinfo['opt4']."</td>";
													echo"<td>".$qinfo['answer']."</td>";
											echo"<td>".$yans."</td>";
													if($marks <=0)
													{
													echo"<td bgcolor='lightpink' align='center'>".$marks."</td>";
													}
													else{
													 	echo"<td bgcolor='lightgreen' align='center'>".$marks."</td>";  
													}
													
													
												$i++;			
												}
											}
										}								}
                                       ?>
                                     </tr> 
                                    </tbody>
									
                                </table>
                            </div>
                            </div>
                            </div>
                            
                      
<?php  require_once('temp/footer.php'); ?>