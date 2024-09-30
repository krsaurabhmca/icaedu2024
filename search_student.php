<?php require_once('temp/sidebar.php'); 
if($user_type=='CLIENT')
{
    $center_id = centerid($user_name);	
    $str =" and center_id ='$center_id' limit 100";
}
else{
    $str ='';
}

if(isset($_GET['searchText']) and $_GET['searchText']!=''){
	$searchText = $_GET['searchText'];
	$sql ="SELECT student.*, concat(student_name, student_mobile,student_roll) as f1  FROM student having f1 like'%$searchText%' limit 100";
}
 
if(isset($_GET['course_id']) && $_GET['course_id'] !=''){
    $course_id = $_GET['course_id'];
	$sql ="SELECT * FROM student where course_id ='$course_id' limit 500";
}

if(isset($_GET['status']) && $_GET['status'] !=''){
    $status = $_GET['status'];
	$sql ="SELECT * FROM student where status ='$status' limit 500";
}

echo $sql = $sql.$str;
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
                                    
                                    <div class="page-title-left">
                                     <form action ='' method='get'>
<div class="input-group mb-3">
  <input value='<?= $searchText ?>' class='form-control' placeholder='Search via Name, mobile, Reg No.' required aria-label="Recipient's username" aria-describedby="basic-addon2" name='searchText' onblur='submit()'>
  <span class="input-group-text" ><i class='fa fa-search'></i></span>
</div>
									</form>
                                    </div>
                                    
                                    <div class="page-title-right">
                                    <form action ='' method='get'>
        									<select name='status' onChange='submit()' class='h6 select2'>
        										<?php dropdown($status_list,$status); ?>
        									</select>
									</form>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-header"> Search Student Result</div>
        <div class="card-body">
			        <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
									
                                        <tr>
                                        <?php ?>
                                            <th>Center Code</th>
                                            <th>Reg. No.</th>
											<th>Student Name</th>
											<th>Date of Birth </th>
											<th>Course </th>
											<th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
						                
						                if($sql!='')
						                {
								        $res = direct_sql($sql);
						                }
										if($res['count'] > 0){
										foreach($res['data'] as $row)
										{
										$stu_id =$row['id'];
										$status = $row['status'];
										$ed_link =encode('student_id='.$stu_id);
										echo"<tr class='odd gradeX'>";
										
										echo"<td>".get_data('center_details',$row['center_id'],'center_code','id')['data']."</td>";
										echo"<td> ".trim($row['student_roll'])."</td>";
										echo"<td><a href='print_application.php?link=$ed_link'>".$row['student_name']."</a></td>";
										echo"<td>".date('d-M-Y',strtotime($row['date_of_birth']))."</td>";
										echo"<td>".get_data('course_details',$row['course_id'],'course_code','id')['data']."</td>";
										echo"<td>".$status."</td>";
										
                                        echo"<td width='160' align='right'>";
                                        
                                        //echo student_action($stu_id);
                                        echo student_docs($stu_id);
                                        
								
									
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