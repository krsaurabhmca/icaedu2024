<?php require_once('temp/sidebar.php'); 

if (isset($_REQUEST['att_date']))
    {
        $att_date=$_REQUEST['att_date'];
    }
else{
        $att_date=date('Y-m-d');
}

if (isset($_REQUEST['batch_id']))
    {
        $batch_id=$_REQUEST['batch_id'];
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
                     	 <form action ='' method='get'>
                            <div class="row">
                            
                                <div class="col-md-8">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Make Attendance
                                         <button class='btn btn-primary btn-sm' onClick ='exportxls()'> Export </button>
                                    </h4>
                                    </div>     
                                </div>
                                <div class="col-md-2">
                                        <select name ='batch_id' >
                                        <?php dropdown_where('batch_details','id','batch_name', array('created_by'=>$user_id,'status'=>'ACTIVE'), $batch_id);
                                        ?>
                                        </select>
                                </div>
                                <div class="col-md-2">
                                        <input type='date' class='h6' name='att_date' value='<?php echo $att_date;?>' id='att_date' max='<?php echo date('Y-m-d');?>' onblur='submit()'>
                                </div>
                            </div>
                            </form>  
                </div>
                        
                        <!-- end page title -->
			
	 <div class="card mb-4">
        
                    <!-- Advanced Tables -->
    <?php
    if (isset($_REQUEST['att_date']))
    {
        $batch_id=$_REQUEST['batch_id'];
        $att_date=$_REQUEST['att_date'];
        $mvalue = remove_space(date('M_Y',strtotime($att_date)));
        $center_id =centerid($user_name);
    //   $sql = "select student_att.*, student.id, student.student_name, student.center_id , student.status from student_att, student where student.id = student_att. student_id and student.center_id ='$center_id' and student.status='VERIFIED' and student_att.status='ACTIVE' and student.batch_id = '$batch_id' order by student.student_roll";
       
        // $sql = "select student_att.*, student.id, student.student_name, student.center_id , student.status from student_att, student where student.id = student_att.student_id and student.batch_id = '$batch_id' order by student.student_roll";
        
        $sql = get_all('student_att','*',['batch_id'=>$batch_id,'status'=>'ACTIVE']);
    ?>
    <div class="card ">            
     <div class="card-header <?php echo $bgClr ?> font-weight-bold">
        Attendance of <?php echo date('d-M-Y',strtotime($att_date));?> (<?php echo date('l',strtotime($att_date));?>) </b>
        <span style='float:right'>
                <span class='btn btn-primary btn-sm border ' >
                    <input type="checkbox" id="selectall" onClick="selectAll(this)" /> All Present
                </span>&nbsp;
                <button id='att_btn' class='btn btn-success btn-sm' title='Save Data' style="margin-right:8px;"><i class='fa fa-save'></i> SAVE </button> &nbsp;
        </span>
    </div>
        <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id='data_tbl'>
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Roll No.</th>
                                            <th>Student Name</th>
                                            <th>Total Fee</th>
                                            <th>Dues Amount</th>
                                            <th>Status</th>
                                            <th>Att Report</th>
                                            <th>Check to Present</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <form action='master_process.php?task=make_att' method='post' id='att_frm'>
                                            <?php 
                                            $col_name = 'd_'.date('j', strtotime($att_date));
                                            if (date('D', strtotime($att_date)) == 'Sun') {
                                                echo "<script> alert('Selected Date is Sunday');</script>";
                                            }
                                            $tbl_name = 'student_att';
                                            $year = date('Y');
                                            $month = date('m');
                                
                                            // Prepare SQL query to select dates from the current month
                                            $day_sql = "SELECT * FROM holidays WHERE YEAR(date) = $year AND MONTH(date) = $month";
                                            $day_result = direct_sql($day_sql);
                                            $days = $day_result['count'];
                                
                                            // Get the current month and year
                                            $currentMonth = date('m');
                                            $currentYear = date('Y');
                                
                                            // Get the total number of days in the current month
                                            $totalDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
                                
                                            // Calculate the new count of days after subtracting holidays
                                            $open_Days = $totalDays - $days;
                                
                                            $i = 1;
                                            $displayed_ids = array(); // Array to track displayed student IDs
                                
                                            foreach ($sql['data'] as $row) {
                                                $id = $row['student_id'];
                                
                                                // Check if student ID has already been displayed
                                                if (in_array($id, $displayed_ids)) {
                                                    continue; // Skip this iteration if the ID has already been displayed
                                                }
                                
                                                // Add the current student ID to the displayed list
                                                $displayed_ids[] = $id;
                                
                                                $st_roll = studentinfo($id, 'student_roll');
                                                $batch_id = $row['batch_id'];
                                                $st_name = studentinfo($id, 'student_name');
                                                $st_att_id = get_data('student_att', $id, 'id', 'student_id')['data'];
                                                $stu_id = get_data('student_att', $st_att_id, 'student_id','id')['data'];
                                                $post = array('student_id' => $id, 'att_month' => $mvalue, 'student_roll' => $roll, 'batch_id' => $batch_id);
                                
                                                $course_fee = studentinfo($id, 'course_fee');
                                                $paid_amount = totalpaid($id);
                                                $dues = $course_fee - $paid_amount;
                                
                                                insert_data($tbl_name, $post);
                                
                                                echo "<tr class='odd gradeX'>";
                                                $total_p = get_total_p($id);
                                                $total_a = get_total_a($id);
                                
                                                echo "<td>".$i."</td>";
                                                echo "<td>".$st_roll."</td>";
                                                echo "<td>".$st_name."</td>"; 
                                                echo "<td>".$course_fee."</td>";
                                                echo "<td>".$dues;
                                                
                                                if ($course_fee <> 0 && $dues == 0) {
                                                    echo "<button type='submit' class='btn btn-danger btn-sm float-end' name='No_dues'>No Dues</button>";
                                                } else {
                                                    echo "<a href='pay_fee?student_id=$id' title='Pay Fee'>";
                                                    echo "<button type='submit' class='btn btn-success btn-sm float-end' name='Pay_fee'>Pay Fee</button></a>"; 
                                                }
                                
                                                echo "</td>";
                                                echo "<td>".$row['status']."</td>";
                                                echo "<td>".$total_p.'/'.$total_a."</td>";
                                
                                                echo "<td width='185'>";
                                                $satt = get_multi_data($tbl_name, array('student_id' => $id, 'att_month' => $mvalue, 'batch_id' => $batch_id))['data'][0];
                                                
                                                if ($satt[$col_name] == 'P') {
                                                    echo "<input type='checkbox' value ='$id' name='sel_id[]' checked class='chk'>";
                                                } else {
                                                    echo "<input type='checkbox' value ='$id' name='sel_id[]' class='chk'>";
                                                }
                                
                                                echo "&emsp;";
                                                // echo "<button class='delete_btn btn btn-danger btn-sm' id='btn_dlt'  data-table='student_att' data-per='no'  data-id='$st_att_id' data-pkey='id' title='Detete This Permanently' $disabled > <i class='fa fa-trash'></i> </button>";
                                                echo btn_delete('student_att', $st_att_id);
                                
                                                echo "</td></tr>";
                                                $i++;
                                            }
                                            ?>
                                        </form>
                                    </tbody>
                                </table>

    <?php }?>
                                
                            </div>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script language="JavaScript">
    function selectAll(source) {
        checkboxes = document.getElementsByName('sel_id[]');
        for(var i in checkboxes)
            checkboxes[i].checked = source.checked;
    }
    </script>
    <script>
        // $(document).on('click','#btn_dlt', function(){
            // var studentId = '<?php// echo $stu_id ?>';
        //     bootbox.confirm({
        // 		message: "Do you really want to delete this?",
        // 		buttons: 
        // 		{
        // 			confirm: {
        // 				label: 'Yes',
        // 				className: 'btn-success'
        // 			},
        // 			cancel: {
        // 				label: 'No',
        // 				className: 'btn-danger'
        // 			}
        // 		}, 
        // 		callback: function (result) {
        // 			if(result==true)
        //     			{
                            // $.ajax({
                                // url: 'temp/master_process.php?task=update_att', 
                                // type: 'POST',
                                // data: {
                                //     'student_id': studentId,
                                //     'batch_id' : 'null'
                                }
            //              }
            // 			}
            // });
        // });
    </script>