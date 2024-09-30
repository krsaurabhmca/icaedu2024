<?php require_once('temp/sidebar.php'); 
if(isset($_GET['link']))
{
	$data = decode($_GET['link']);
	$set = get_data('set_details',$data['id']);
	if($set['count']>0)
	{
		extract($set['data']);
		$course = get_data('course_details', $course_id,'course_name')['data'];
		
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
                                    <h4 class="mb-sm-0 font-size-18"><?php echo $set_name ."  [ Total Question : ". $question ." ]"; ?></h4>
			                          	
                                    <div class="page-title-right">
		                             <span class='badge bg-danger float-right'><?php echo  $course; ?> </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			<div class='row'>
						<div class='col-md-12'>
						
						</div>
					</div>
					<div class='row'>
						<div class='col-md-9'>
                             <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
								<thead >
									<?php if($user_type=='ADMIN'){?>	
										<tr>
										    <td colspan='3' align='center'>
									    
										<?php if( count(explode(',',$question_list)) < $question)
											{
												echo "<button class='add_remove_question btn btn-info btn-sm' data-status ='Add' data-set ='$id' data-task='question_plus' >Add Selected</button>";
											}
										
										?>
										<button class='add_remove_question btn btn-secondary btn-sm' data-status ='Remove' data-task='question_minus' data-set ='<?php echo $id; ?>' > Remove Selected</button>
								
									</td></tr>
									<?php }?>
									<tr>
										
										
										<th>Subject</th>
										<th>Question</th>
										<th><input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> </th>
									</tr>
								</thead>
								<tbody>
								<?php
								$sub = get_data('course_details',$course_id,'course_syllabus')['data'];
							    
                                $sql ="select * from qbank where subject_id in ($sub) ";
                                $res = direct_sql($sql);
                                
							
									foreach($res['data'] as $row){
										echo "<tr>";
										$q_id=$row['id'];
										
										$subject_name = get_data('subject', $row['subject_id'], 'sub_name')['data'];
									    
									    
									    echo "<td> ".$subject_name."</td>";
									    echo "<td> ".html_entity_decode(base64_decode($row['question'])) ."</td>";
										//echo "<td> ".strip_tags(base64_decode($row['question'])) ."</td>";
										?>
										
										<td align='center'>
										<?php if(in_array($q_id, explode(',',$question_list))){
												echo "<input type='checkbox' value ='$q_id' checked name='sel_id[]'  class='chk'>";
											}
										else{
										?>
											<input type='checkbox' value ='<?php echo $q_id; ?>' name='sel_id[]'  class='chk'>
										
										<?php } ?>
										</td>
										</tr>
							
										<?php } ?>
								   
								</tbody>
							</table>
						</div>
						<div class='col-md-3'>
                          	<table class='table'>
								<tr> <th colspan='2' align='center'> Subject Wise Set Analysis </th></tr>
								
								<?php 
								if($question_list<>'')
								{
								// $sql = 'SELECT course_id, count(course_id) FROM qbank WHERE `id` IN ('.$question_list.') group by course_id';
								
								// $all_subject =direct_sql($sql);
								// if($all_subject['count']>0)
								// {
								// foreach($all_subject['data'] as $count_row)
								// 	{
								// 		//print_r($count_row);
								// 		echo '<tr><td>'. get_data('course_details',$count_row['course_id'] , 'course_name','id')['data']. "</td>";
								// 		echo '<td>'. $count_row['count(course_id)']. "</td></tr>";
										
								// 	}
								// }
								?>
								<tr class='bg-info text-light'><td> Total Selected </td> <td> <?php echo count(explode(',',$question_list)); ?> /<?php echo $question; ?> </td></tr>
							</table>
							<?php  if( count(explode(',',$question_list)) == $question) { ?>
							<button class='btn btn-success btn-block' id='finish_set' data-set='<?php echo $id; ?>' > Finish Set  </button>
							<?php } else{ ?>
								<p class='text-danger text-center'> No. of question not Match </p> 
								<?php } }  ?>
						</div>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php } require_once('temp/footer.php'); ?>
