<?php require_once('temp/sidebar.php'); 
if(isset($_REQUEST['search']))
{
     extract($_POST);
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
                                    <h4 class="mb-sm-0 font-size-18">Duplicate Finder</h4>
                                    <div class="page-title-right">
		                             
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-header bg-dark">
            <form action='' method='post'>
                <div class='row'>
                     <div class='col-md-3'>
                        <select name='center_id'class='form-select select2' required>
                             <?= dropdown_list('center_details','id','center_name', $center_id,'center_code'); ?>
                        </select>
                    </div>
                    
                    <div class='col-md-2'>
                        <select name='param1'class='form-select select2' required>
                             <?= dropdown_with_key($param_list, $param1); ?>
                        </select>
                    </div>
              
                    <div class='col-md-2'>
                        <select name='param2'class='form-select select2' required>
                            <?= dropdown_with_key($param_list, $param2); ?>
                        </select>
                    </div>
                
                    <div class='col-md-2'>
                        <select name='param3'class='form-select select2' required>
                             <?= dropdown_with_key($param_list, $param3); ?>
                        </select>
                    </div>
                    <div class='col-md-2'>
                        <select name='param4'class='form-select select2' required>
                             <?= dropdown_with_key($param_list, $param4); ?>
                             <?php // dropdown($status_list, $param4); ?>
                        </select>
                    </div>
                    
                    <div class='col-md-1'>
                        <button class='btn btn-success btn-sm' name='search'> Search </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
			      <div class="card-body">
                            <div class="table-responsive">
                                <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    
                                    <thead>
									<?php if($user_type=='ADMIN'){?>	
										<tr><td colspan='7' align='center'>
									    	<button class='status_btn btn btn-secondary btn-sm' data-status='BLOCK'>Block Selected</button>
										    <button class='status_btn btn btn-danger btn-sm' data-status='DELETE'>Delete Selected</button>
										    </td>
										 </tr>
									<?php } ?>
								
                                        <tr>
                                            <!--<th>Center Code</th>-->
                                            <th>Student Name</th>
                                            <th>Reg. No.</th>
                                            <th>Father Name</th>
                                            <th>Date of Birth </th>
                                            <th>Course </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($_POST['search']))
                                        {
                                        $center_id =$_POST['center_id'];
                                        $status =$_POST['status'];
                                        
                                        $sql = "SELECT * FROM student WHERE ( $param1, $param2, $param3, $param4) IN ( SELECT $param1, $param2, $param3, $param4 FROM student GROUP BY  $param1, $param2, $param3, $param4 HAVING COUNT(*) > 1 ) and center_id ='$center_id' order by student_name"; 
                                        
                                      //$sql="SELECT id, $param1, $param2, $param3, status, COUNT(*) as count FROM student where student_name <>'' and status not in('AUTO','DELETED') GROUP BY $param1, $param2, $param3 HAVING COUNT(*) > 1";
                                         
                                       
                                        $res = direct_sql($sql);
                                        
                                        foreach($res['data'] as $row)
                                        {
                                           
                                        $stu_id =$row['id'];
                                        // $row =get_data('student',$stu_id)['data'];
                                        // $flink = $param1."=".$stu[$param1]."&".$param2."=".$stu[$param2]."&".$param3."=".$stu[$param3];
                                        
                                        $ed_link = encode('student_id='.$stu_id);
                                        $status = $row['status'];
                                        $course_type = get_data('course_details',$row['course_id'],'course_type','id')['data'];
                                        
                                        echo"<tr class='odd gradeX'>";
                                        
                                        //echo"<td>".get_data('center_details',$row['center_id'],'center_code','id')['data']."</td>";
                                        echo"<td>".$row['student_name']."</td>";
                                        echo"<td>".trim($row['student_roll'])."</td>";
                                       
                                        echo"<td>".$row['student_father']."</td>";
                                        echo"<td>".date('d-M-Y',strtotime($row['date_of_birth']))."</td>";
                                        echo"<td>".get_data('course_details',$row['course_id'],'course_code','id')['data']. "</td>";
                                        echo"<td>".show_status($status)."</td>";
                                        echo "<td>";
                                        
                                        if($user_type=='ADMIN')
    									{
    										echo "<input type='checkbox' value ='$stu_id' name='sel_id[]' class='chk'> &nbsp;";
    										echo btn_edit('add_student',$stu_id,'fa fa-edit','Add Student');
    										
    									}
                                        echo "</td>";
                                       
                                    
                                        echo "</tr>";
                                        }
                                            
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                            
                      
            </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
