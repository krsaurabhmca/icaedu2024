<?php require_once('student_temp/sidebar.php'); 
$syllabus= courseinfo($_SESSION['user_id'],'course_syllabus');
$new_topic_list = explode(',',$syllabus);
$stu_id = $_SESSION['user_id'];
$student_roll = get_data('student',$stu_id,'student_roll')['data'];
if(isset($_REQUEST['topic']))
{
	$topic =$_REQUEST['topic'];
}
else{
	$topic=null;
}
?>
<link rel="stylesheet" href="assets/css/yt.css">
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
                                    <h4 class="mb-sm-0 font-size-18">Online Exam</h4>
                                    <div class="page-title-right">
		                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			   <div class="row">
                
				<div class="col-lg-12" id=''>
								
					<table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                   
                                    <thead >
                                        <tr>
                                            <th>Set Name</th>
                                            <th>Duration</th>
                                            <th>No. of Question</th>
                                            <th>Marks</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									//$query ="select * from set_details where status ='ACTIVE' order by id desc";
									$query ="select * from admit_card where student_roll ='$student_roll' order by id desc";// limit 1";
									$res = direct_sql($query);
									foreach($res['data'] as $row)
									{
									  
									    echo "<tr>";
										$sid=$row['set_id'];
										$set = get_data('set_details',$sid)['data'];
										$set_name=$set['set_name'];
										echo "<td> ". $set['set_name'] ."</td>";
									    echo "<td> ". $set['duration'] ." Minutes </td>";
									    echo "<td> ". $set['question'] ."</td>";
									    echo "<td> ". $set['question']*$set['marks_plus'] ."</td>";
									    
									    $link =encode("set_id=$sid&set_name=$set_name");
									 ?>
									<td align='center'>
									    
									    <?php 
									     $ans = get_all('answer','*', array('set_id'=>$sid, 'student_id'=>$stu_id,'status'=>'FINISH'));
									     
									    if($ans['count']>0){ ?>
										<a class='btn btn-success btn-sm' >Completed</a>
										<?php }  else {?> 
											<a class='quiz_start btn btn-danger btn-sm' data-name='<?php echo $set_name;?>' data-id='<?php echo $sid;?>' data-url='start_exam.php?link=<?php echo $link;?>' onclick='wopen()'>Start</a>
										
										<?php } ?> 
									</td>
									<?php
									}
									?>
                                       
                                    </tbody>
                                </table>
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

<script>
$(document).on('click', ".quiz_start", function(){
        var src = $(this).data('url');
    window.open(src, "newWin", "location=no,status=no,directories=no,fullscreen=yes,toolbar=no,scrollbars=no,resizable=no,width="+screen.availWidth+",height="+screen.availHeight);
    });
    
</script>
<script src="assets/js/exam.js"></script>
 