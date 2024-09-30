<?php require_once('temp/sidebar.php'); 
if(isset($_GET['id']))
{
	$data  = get_data('set_details',$_GET['id'])['data'];
	extract($data);
}
else{
	$res1  =insert_row('set_details');
	$id1 = $res1['id'];
	$data  = get_data('set_details',$id1)['data'];
	extract($data);
}

if(isset($_GET['status']))
{
    $status = $_GET['status'];
	$res = get_all('set_details','*',array('status'=>$status));
}
else{
    $res = get_all('set_details');
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
                                    <h4 class="mb-sm-0 font-size-18">Manage Exam Set 
                                    	<button class='btn btn-primary btn-sm' onClick ='exportxls()'> Export </button></h4>
                                    <div class="page-title-right">
		                             <form action ='' method='get'>
										<select name='status' onChange='submit()' class='h6'>
											<?php dropdown($status_exam,$status); ?>
										</select>
									 </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
		<div class="card-header <?php echo $bgClr ?>  font-weight-bold">
           Set Details 
  
           <span class='float-right' style="float:right">
		     <a class="btn btn-primary btn-sm border" href='create_set' ><i class='fa fa-plus' title='Add New Set '></i></a> &nbsp;
		      <button type="submit" class="btn btn-sm btn-success  " id='update_btn'>Save Set </button>
		     
		     </span>
        </div>
        <div class="card-body">
		
                       <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th>Course</th>
                                            <th>Set Name</th>
                                            <th>D/Q</th>
                                            <th>Marks(+/-)</th>
                                            <th>Active Date</th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
								
									if($res['count']>0)
									{	
									foreach($res['data'] as $row)
									{
											echo "<tr>";
											$id=$row['id'];
											$course = get_data('course_details',$row['course_id'],'course_name')['data'];
											$quiz_key = encode('visitor_id=0&inst_name='.$inst_name);
											$link = encode('set_name='.$row['set_name'].'&id='.$id);
										
										    $view_link = 'view_data.php?link='.encode('table=set_details&id='.$id);
                                            $view_title =  $row['set_name'];
										
										echo "<td> ". $course ."</td>";
											echo "<td> <a href='print_set?set_id=$id' target='_blank'>". 
										
										$row['set_name'] ."</a></td>";
											echo "<td> ". $row['duration'] ."/" . $row['question']. "</td>";
											echo "<td> ". $row['marks_plus']. "/ ".$row['marks_minus'] ."</td>";
												echo "<td> ". date('d-M h:i A', strtotime($row['start_date'])). " to ". date('d-M h:i A', strtotime($row['end_date'])) ."</td>";
											echo "<td> ". $row['status'] ."</td>";
									?>
											<td align='right'>
											
											<?php if($row['status']<>'ACTIVE'){ ?>

											<a href='set_question?link=<?php echo $link; ?>' class=' btn btn-success btn-sm text-light' title='Add Question'> <i class='fa fa-plus'></i></a>
											<?php } ?>
											<?php echo btn_edit('create_set',$id); ?>
											
											<?php echo btn_delete('set_details',$id); ?>
											
												<?php echo btn_view('set_details',$id, $view_title); ?>
										
											</td>
											</tr>
									<?php
									}
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
