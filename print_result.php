<?php require_once('temp/sidebar.php'); 
if(isset($_REQUEST['center_id']))
{
    $center_id = $_REQUEST['center_id'];
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
                                    <h4 class="mb-sm-0 font-size-18">Print Result</h4>
                                    <div class="page-title-right">
		                              <form action='' method='get'>
                                        <select name='center_id' onChange='submit()' class='h6 select2'>
                                            <?php dropdown_list('center_details' ,'id', 'center_name', $center_id,'center_code' ); ?>
                                        </select>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			      <div class="card-body">
                            <div class="table-responsive">
                                <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Center Code</th>
                                            <th>Reg. No.</th>
                                            <th>Student Name</th>
                                            <th>Date of Birth </th>
                                            <th>Course </th>
                                            <th>Status</th>
                                            <th>Print</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($center_id))
                                        {
                                         $sql ="select * from student where center_id ='$center_id' and status ='RESULT OUT'";
                                        
                                        if($user_type <>'ADMIN')
                                        {
                                        $center_id =centerinfo($admin,'center_id');
                                        $sql ="select * from student where center_id =$center_id"; 
                                        }
                                        
                                        $res = direct_sql($sql);
                                        
                                        foreach($res['data'] as $row)
                                        {
                                            // print_r($row);
                                        $stu_id =$row['id'];
                                        $ed_link = encode('student_id='.$stu_id);
                                        $status = $row['status'];
                                        $course_type = get_data('course_details',$row['course_id'],'course_type','id')['data'];
                                        
                                        echo"<tr class='odd gradeX'>";
                                        
                                        echo"<td>".get_data('center_details',$row['center_id'],'center_code','id')['data']."</td>";
                                        echo"<td>".trim($row['student_roll'])."</td>";
                                        echo"<td>".$row['student_name']."</td>";
                                        echo"<td>".date('d-M-Y',strtotime($row['date_of_birth']))."</td>";
                                        echo"<td>".get_data('course_details',$row['course_id'],'course_code','id')['data']. "</td>";
                                        echo"<td>".$status."</td>";
                                        
                                        echo"<td width='155'>";
                                    
                                        if ($status =='RESULT OUT')
                                        {
                                            if($course_type ==8)
                                            {
                                                echo "<a href='print_typing.php?student_id=$stu_id' target='_blank' title='Print Typing Certificate ' >
                                                <button type='submit' class='btn btn-primary btn-sm' name='Pay_fee'>TY Certificate </button></a>";  
                                            }
                                            else if($course_type ==9)
											{
											   echo "<a href='print_certificate.php?student_id=$stu_id' target='_blank' title='Print Certificate ' >
                                                <button type='submit' class='btn btn-warning btn-sm' name='certificate'>Certificate </button></a>";
                                                
											  echo "<a href='print_ms_pgdca.php?link=".$ed_link."' target='_blank' title='PDF Result Sheet '>
											  <button type='submit' class='btn btn-success btn-sm' name='Download PDF'><i class='fa fa-file-pdf'></i></button></a>";
												
											}
                                            else if($course_type ==4)
                                            {
                                                echo "<a href='print_vc.php?student_id=$stu_id' target='_blank' title='Print Vocational Certificate ' >
                                            <button type='submit' class='btn btn-danger btn-sm' name='Pay_fee'>VC Certificate </button></a>";   
                                            }
                                            else if($course_type ==2 or $course_type ==3 or $course_type ==5 or $course_type ==6 or  $course_type ==7)
                                            {
                                             echo "<a href='print_ms_tech.php?student_id=$stu_id' target='_blank' title='Print Result Sheet ' >
                                                <button type='submit' class='btn btn-success btn-sm' name='Pay_fee'>Marks </button></a>";   
                                                echo "<a href='print_certificate.php?student_id=$stu_id' target='_blank' title='Print Technical Certificate ' >
                                            <button type='submit' class='btn btn-warning btn-sm' name='certificate'>Certificate </button></a>";     
                                            }
                                            else{
                                                echo "<a href='print_ms.php?student_id=$stu_id' target='_blank' title='Print Result Sheet ' >
                                                <button type='submit' class='btn btn-success btn-sm' name='Pay_fee'>Marks </button></a>";   
                                                echo "<a href='print_certificate.php?student_id=$stu_id' target='_blank' title='Print Certificate ' >
                                            <button type='submit' class='btn btn-warning btn-sm' name='certificate'>Certificate </button></a>"; 
                                            }
                                        }                                   
                                             
                                        echo "</td></tr>";
                                        }}
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
