<?php require_once('temp/sidebar.php'); 
if(isset($_REQUEST['center_id']))
{
    $center_id = $_REQUEST['center_id'];
}
if(isset($_REQUEST['course_type_id']))
{
    $course_type_id = $_REQUEST['course_type_id'];
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
                                    <h4 class="mb-sm-0 font-size-18">Print Multiple Result</h4>
                                    <div class="page-title-right">
		                                <form action='' method='get'>
                                        <select name='center_id'  class='h6 select2'>
                                            <?php dropdown_list('center_details' ,'id', 'center_name', $center_id,'center_code' ); ?>
                                        </select>
                                        
                                        <select name='course_type_id' onChange='submit()' class='h6 select2'>
                                            <?php dropdown_list('default_course' ,'id', 'course_type', $course_type_id ); ?>
                                        </select>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
	
	<?php
	$action_url='';
	if($course_type_id ==8)
        {
         	$action_url='print_typing.php';     
        
        }
        else if($course_type_id ==4)
        {
            	$action_url='print_vc.php';   

        }
        else if($course_type ==2 or $course_type ==3 or $course_type ==5 or $course_type ==6 or  $course_type ==7)
                                            
        {
            	$action_url='print_ms_tech.php';   

        }
        else
        {
            	$action_url='print_ms_multi.php';   
            	$action_url2='print_certificate.php';   

        }
        ?>
	
	
	<div class="card mb-4">
        <div class="card-body">
			      <div class="card-body">
                            <div class="table-responsive">
                                <form action='<?= $action_url ?>' method='post' target='icard' >
                                <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Center Code</th>
                                            <th>Reg. No.</th>
                                            <th>Student Name</th>
                                            <!--<th>Date of Birth </th>-->
                                            <th>Course </th>
                                            <th>Status</th>
                                            <th>Print</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($user_type <>'ADMIN')
                                        {
                                        $center_id =centerinfo($admin,'center_id');
                                        }
                                        
                                        if(isset($center_id))
                                        {
                                         $sql="SELECT student.id as student_id, student_roll, student_name, course_id, center_id, student.status as status, course_details.course_name, default_course.id FROM student, course_details, default_course WHERE student.course_id=course_details.id and course_details.course_type =default_course.id and default_course.id='$course_type_id' and  center_id ='$center_id' and student.status ='RESULT OUT'";  
                                       
                                        $res = direct_sql($sql);
                                        
                                        foreach($res['data'] as $row)
                                        {
                                            // print_r($row);
                                        $stu_id =$row['student_id'];
                                        // $link = encode('student_id='$stu_id);
                                        $status = $row['status'];
                                        $course_type = get_data('course_details',$row['course_id'],'course_type','id')['data'];
                                        
                                        echo"<tr class='odd gradeX'>";
                                        
                                        echo"<td>".get_data('center_details',$row['center_id'],'center_code','id')['data']."</td>";
                                        echo"<td>".trim($row['student_roll'])."</td>";
                                        echo"<td>".$row['student_name']."</td>";
                                       //echo"<td>".date('d-M-Y',strtotime($row['date_of_birth']))."</td>";
                                        echo"<td>".get_data('course_details',$row['course_id'],'course_code','id')['data']. "</td>";
                                        echo"<td>".$status."</td>";
                                        
                                        echo"<td>";
                                        if ($status =='RESULT OUT')
                                        {
                                               echo "<input type='checkbox'  value ='$stu_id' name='sel_id[]'>";
                                               
                                         
                                        }                                  
                                             
                                        echo "</td></tr>";
                                        }}
                                       ?>
                                    </tbody>
                                     <tfoot>
                                     <tr>
                                     <td colspan='6'>
                                        
                                            <center>
                                            
                                            <span style='font-size:16px;color:maroon;'>
                                                <input type="checkbox" id="selectall" onClick="selectAll(this)" /> Select All
                                            </span>
                                            <input type='button' onClick='submit()' class='btn btn-success btn-sm' value='Print Selected '>
                                            </center> 
                                        </td>
                                    </tr>
                                    
                                    </tfoot>
                                </table>
                                </form>
                            </div>
                            
                      
            </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
