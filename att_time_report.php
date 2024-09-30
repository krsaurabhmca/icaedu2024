<?php require_once('temp/sidebar.php'); 
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
                                    <h4 class="mb-sm-0 font-size-18">Attendance Report With Timing
                                    <button class='btn btn-primary btn-sm' onClick ='exportxls()'> Export </button></h4>
                                    <div class="page-title-right">
                                      <form action ='' method='get'>
                                      <input type='date' value='<?php echo date('Y-m-d'); ?>' name='att_date' onblur='submit()'>
                                      </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                           <!-- Advanced Tables -->
    <?php
    if (isset($_REQUEST['att_date']))
    {
        $center_id = get_data('center_details',$user_name,'id','center_code')['data'];
        $att_date=trim($_REQUEST['att_date']);
        $tbl_name=  'attendance'; // trim($_REQUEST['tbl_name']);
        $sql = "select $tbl_name.*, student.student_name, student.student_roll from $tbl_name, student where date_of_att='$att_date' and student.center_id ='$center_id' and student.id = $tbl_name.student_id order by student.student_roll";
        
    ?>
    <div class="card ">
     <div class="card-header <?php echo $bgClr ?>">
        Attendance <?php echo " of ". date('d-M-Y',strtotime($att_date));?>
     </div>
        <div class="card-body">
                              <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    
                                        <tr>
                                            <th>Roll No.</th>
                                            <th>Student Name</th>
                                            <th>In Time</th>
                                            <th>Out Time</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        $res = mysqli_query($con,$sql) or die ("Error in selecting Student". mysqli_error($con));
                                        while($row =mysqli_fetch_array($res))
                                        {
                                        $j=0;
                                        $id =$row['student_id'];
                                        $data = get_data('student',$id,null,'student_id')['data'];
                                        $st = $row['status'];
                                        //print_r($data);
                                        echo"<tr class='odd gradeX'>";
                                        
                                        echo"<td>".$data['student_roll']."</td>";
                                        echo"<td>".$data['student_name']."</td>";
                                        echo"<td>".$row['entry_time']."</td>";
                                        echo"<td>";
                                        if($st =='OUT')
                                        { 
                                          echo  $row['exit_time'] ;
                                        } 
                                        echo "</td>";
                                        
                                        echo"<td>".$row['status']."</td>";
                                        
                                        }
                                    }
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
<script language="JavaScript">
    function selectAll(source) {
        checkboxes = document.getElementsByName('sel_id[]');
        for(var i in checkboxes)
            checkboxes[i].checked = source.checked;
    }
</script>

<?php require_once('temp/footer.php'); ?>