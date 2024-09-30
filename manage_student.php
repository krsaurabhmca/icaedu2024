<?php require_once('temp/sidebar.php'); 
if($user_type=='CLIENT')
{
// $center_id = centerid($user_name);	
}
if(isset($_GET['center_id']))
{
	$center_id = $_SESSION['center_id'] =$_GET['center_id'];
}
else
{
	$center_id = $_SESSION['center_id'];
}

if(isset($_GET['scan_by']))
{
	$status = $_SESSION['status'] =$_GET['scan_by'];
}
else if(isset($_SESSION['status']))
{
	$status = $_SESSION['status'];
}
else{
	$status ='PENDING';
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
                                    <h4 class="mb-sm-0 font-size-18">Manage Student
                                     <button class='btn btn-primary btn-sm' onClick ='exportxls()'> Export </button>
                                     	<select id='batch_id' class='select2'>
                                     	    <option value=''> Select Batch </option>
										<?php dropdown_where('batch_details','id','batch_name', array('created_by'=>$user_id,'status'=>'ACTIVE')); ?>
									</select>
									<?php  if($user_type=='CLIENT' and  $status =='VERIFIED') { ?> 
									 <span class='btn btn-info btn-sm'>
										<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All
										</span>
						            <button class='btn btn-danger btn-sm' id='add_to_att'> Add to Attendance </button>
									<?php  } ?></h4>
                                    <div class="page-title-right">
                                        <form action ='' method='get'>
									<select name='scan_by' onChange='submit()' class='h6'>
										<?php dropdown($status_list,$status); ?>
									</select>
									</form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			        <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
									<?php if($user_type=='ADMIN'){?>	
										<tr><td colspan='7' align='center'>
									
										<span class='btn btn-info btn-sm'>
										<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All
										</span>
										
									<?php if($status =='BLOCK') {?>
										<button class='status_btn btn btn-info btn-sm' data-status='RESULT OUT'>Unblock Selected</button>
									<?php }
									else if($status =='PENDING') {?>
										<button class='status_btn btn btn-success btn-sm' data-status='VERIFIED' >Verify Selected </button>
									<?php }
									else if($status =='RESULT OUT'){ ?>
										<button class='status_btn btn btn-primary btn-sm' data-status='DISPATCHED'>Mark As Dispatched</button>
										<button class='status_btn btn btn-secondary btn-sm' data-status='BLOCK'>Block Selected</button>
									<?php } else{ ?>
									   
										<button class='status_btn btn btn-secondary btn-sm' data-status='BLOCK'>Block Selected</button>
										<button class='status_btn btn btn-danger btn-sm' data-status='DELETE'>Delete Selected</button>
									<?php } ?>
									
									
									</td></tr>
									<?php }?>
									
                                        <tr>
                                        <?php ?>
                                            <!--<th>Center Code</th>-->
                                            <th>Reg. No.</th>
											<th>Student Name</th>
											<th>Date of Birth </th>
											<th>Course </th>
											<!--<th>Status</th>-->
											<th>Photo</th>
											<th>Address</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										if(isset($_GET['batch_id']) and $_GET['batch_id'] !='')
										{
										 $batch_id = $_GET['batch_id'];
										$sql ="select * from student  where student_name <> '' and batch_id ='$batch_id'"; 
										}
										else if($user_type =='CLIENT')
										{
										 $center_id = centerid($user_name);
										$sql ="select * from student  where student_name <> '' and center_id ='$center_id' and status ='$status'"; 
										}
										
										else{
										$sql ="select * from student where student_name <> '' and  center_id ='$center_id' and status ='$status'";
										}
										
									//	echo $sql;
										$res = direct_sql($sql);
										if($res['data'] !=''){
										foreach($res['data'] as $row)
										{
										$stu_id =$row['id'];
										$status = $row['status'];
										$img = 'temp/upload/'.$row['student_photo'];
										$ed_link =$stu_id;
										$print_link =encode("student_id=$stu_id&name={$row['student_name']}");
										echo"<tr class='odd gradeX'>";
										
								// 		echo"<td>".get_data('center_details',$row['center_id'],'center_code','id')['data']."</td>";
										echo"<td>".trim($row['student_roll'])."</td>";
										
											echo"<td><a href='view_student.php?link=$print_link' >".$row['student_name']."</a></td>";
											
									//	echo"<td><a href='print_application.php?link=$print_link' target='_blank'>".$row['student_name']."</a></td>";
										echo"<td>".date('d-M-Y',strtotime($row['date_of_birth']))."</td>";
										echo"<td>".get_data('course_details',$row['course_id'],'course_code','id')['data']."</td>";
									//	echo"<td>".show_status($status)."</td>";
										echo"<td><img src='$img' style='height:25px;width:25px'  onerror=`this.onerror=null;this.src='assets/img/no_image.jpg';`></td>";
										
										echo"<td>".trim($row['student_address'])."</td>";
								
                                        echo"<td width='160' align='right'>";
									if($user_type=='ADMIN')
									{
										echo "<input type='checkbox' value ='$stu_id' name='sel_id[]' class='chk'> &nbsp;";
										if ($status =='VERIFIED')
										{
										echo btn_edit('result_entry',$ed_link,'fa fa-address-card','Add Mark','success');
										echo btn_edit('add_student',$ed_link,'fa fa-edit','Add Student');	
										}
										else if ($status =='PENDING'){
										echo btn_edit('add_student',$ed_link);
										}
										else if ($status =='RESULT UPDATED'){
										    echo btn_edit('result_edit',$ed_link,'fa fa-edit','Edit Result','danger');
										}
									    else 
									    {
									    	echo btn_edit('add_student',$ed_link,'fa fa-edit','Edit Student','danger');
										
										}
									}
									else{
										
										if ($status =='VERIFIED')
										{

										echo "<input type='checkbox' value ='$stu_id' name='sel_id[]'  class='chk'>";
										echo btn_edit('result_entry',$ed_link,'fa fa-address-card','Edit Result');
											
										}
										else if ($status =='PENDING'){
										echo btn_edit('add_student',$ed_link);
										}
										else if ($status =='RESULT UPDATED'){
										    echo btn_edit('result_edit',$ed_link,'fa fa-check','Edit Result','danger');
										}
									    else
									    {
									    
										}
									
									
									}
									
									echo student_docs($ed_link);
										echo "</td></tr>";
										
										} }
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