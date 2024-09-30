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
                                    <h4 class="mb-sm-0 font-size-18">Manage Student
                                    <button class='btn btn-primary btn-sm' onClick ='exportxls()'> Export </button></h4>
                                    <div class="page-title-right">
                                      <form action ='' method='get'>
                                        <select name='batch_id' class='form-select select2'>
                                              <?php dropdown_where('batch_details','id','batch_name', ['created_by'=>$user_id,'status'=>'ACTIVE'])?>
                                        </select>
                                        
                                        <select name='tbl_name' onChange='submit()' class='form-select select2'>
                                            <option value=''> Select Month </option>
                                              <?php for($i=1; $i<13;$i++){
                                                $dt =date('Y')."-".$i."-1";
                                                $val =remove_space(date('M_Y',strtotime($dt)));
                                                            
                                                echo"<option value='$val'>". add_space($val)."</option>";
                                                }?>
                                        </select>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                           <!-- Advanced Tables -->
    <?php
    if (isset($_REQUEST['tbl_name']))
    {
        $center_data = get_data('center_details',$user_name,null,'center_code')['data'];
        $center_id = get_data('center_details',$user_name,'id','center_code')['data'];
        $month_name=trim($_REQUEST['tbl_name']);
        $batch_id=trim($_REQUEST['batch_id']);
        
        $tbl_name=  'student_att'; // trim($_REQUEST['tbl_name']);
        $lastday = date('t',strtotime($dt));
        $sql = "select $tbl_name.*, student.student_name, student.student_roll from $tbl_name, student where att_month='$month_name' and student.center_id ='$center_id' and student.id = $tbl_name.student_id and $tbl_name.batch_id ='$batch_id' order by student.student_roll";
        
    ?>
    <div class="card ">
     <div class="card-header <?php echo $bgClr ?>">
        Attendance <?php echo " of ". add_space($month_name);?>
        </div>
        <div class="card-body" style="overflow-x:scroll;">
            <table id="data_tbl1" class="table table-hover" cellspacing="0" width="100%" style='overflow-x=scroll;'>
                                    <thead>
                                        <tr >
                                            <td colspan='<?= ($lastday+3) ?>' align='center'> 
                                            <?php  echo"<h3> {$center_data['center_name']}  [ {$center_data['center_code']} ]</h3>"; 
                                            echo $center_data['center_address'] ;
                                            echo "<br><b> Attendance of Batch " . get_data('batch_details', $batch_id,'batch_name')['data'] ." of ". add_space($month_name) ."</b>";
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <th>Roll No.</th>
                                            <th>Student Name</th>
                                            <?php
                                            for($i=1; $i<=$lastday; $i++)
                                            {
                                            echo "<th>$i</th>";
                                            }
                                            ?>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        $res = mysqli_query($con,$sql) or die ("Error in selecting Student". mysqli_error($con));
                                        while($row =mysqli_fetch_array($res))
                                        {
                                        $j=0;
                                        $id =$row['student_id'];
                                        echo"<tr class='odd gradeX'>";
                                        
                                        echo"<td>".$row['student_roll']."</td>";
                                        echo"<td>".$row['student_name']."</td>";
                                        for($i=1; $i<=$lastday; $i++)
                                            {
                                                
                                                $col_name = 'd_'.$i;
                                                if ($row[$col_name]=='P')
                                                {
                                                $j++;   
                                                }
                                                $x = ($row[$col_name]=='A')?"<span class='badge bg-danger'>$row[$col_name]</span>":"<b class='badge text-dark'>$row[$col_name]</b>";
                                                echo "<td>$x</td>";
                                            
                                            
                                            }
                                        echo"<td>".$j."</td>";
                                        
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