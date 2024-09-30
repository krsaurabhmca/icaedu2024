<?php require_once('temp/sidebar.php'); ?>
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
                                    <h4 class="mb-sm-0 font-size-18"> Daily Attendance Report </h4>
                                    <div class="page-title-right">
                                        <form action='#' method='post'>
                                        <div class="row text-center">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label></label>
                                                <input type='date' class='form-control' value='<?php echo date('Y-m-d');?>' name='on_date' class='h6' title='Date' >
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 mt-3   ">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-lg btn-success btn-sm" name='submit' value='Generate Report' >
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
     <?php if(isset($_POST['submit']) && isset($_POST['on_date']) )
                                    {
                        $ondate =$_POST['on_date'];
                        $sel_date = date('d',strtotime($ondate));
                        $sel_mon = strtolower(date('M',strtotime($ondate)));
                        $sel_year = date('Y',strtotime($ondate));
                        $sel_month = $sel_mon.'_'.$sel_year;
                        $sel_day = 'd_'.$sel_date;
                ?>                  
        <div class="card mb-4">
        <div class="card-header <?php echo $bgClr ?> font-weight-bold">
                        
            Attendance Report on  <b> <?php echo date('d-M-Y',strtotime($ondate)); ?></b> 
            <button id='btnExport' onClick ='exportxls()' class='btn btn-info btn-sm' title='Download Excel' style="float:right">Export<i class='fa fa-file-excel-o'></i></button>
        </div>
   
        <div class="card-body">
                               <div class="table-responsive">
                                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <!--<?php print_r($_SESSION) ?>-->
                                        <tr>
                                            <th >Serial No</th>
                                            <th >Batch Name</th>
                                            <th>Total Present</th>
                                            <th>Total Absent</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i=1;
                                        $total_p = 0;
                                        $total_a = 0;
                                            $batch = "select id,batch_name from batch_details where created_by = '$user_id' and status='ACTIVE'";
                                            $b_res = direct_sql($batch);
                                            foreach((array)$b_res['data'] as $b_ids){
                                                $bid = $b_ids['id'];
                                                $b_name = $b_ids['batch_name'];
                                                $att_sql = "SELECT COUNT(CASE WHEN `$sel_day` = 'P' THEN 1 END) AS count_p, COUNT(CASE WHEN `$sel_day` = 'A' THEN 1 END) AS count_a FROM student_att WHERE batch_id = '$bid' AND att_month = '$sel_month'";
            
                                                $att_res = direct_sql($att_sql);
                                                foreach((array)$att_res['data'] as $att){
                                                    $att_p = $att['count_p'];
                                                    $att_a = $att['count_a'];
                                                        $total_p = $total_p+$att_p; 
                                                        $total_a = $total_a+$att_a;
                                                        echo"<tr class='odd gradeX'>";
                                                            echo "<td>".$i."</td>";
                                                            echo "<td> ".$b_name ."</td>";
                                                            echo "<td> ". $att_p ."</td>";
                                                            echo "<td> ". $att_a."</td>"; 
                                                        echo "</tr>";
                                                }
                                                
                                            $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr style='background-color:#6b6b6b;color:#fff'>
                                            <td colspan='2' ></td>
                                            <td align='left'> <b><?php echo $total_p; ?></b></td>
                                            <td align='left'> <b><?php echo $total_a; ?></b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php } ?>
                            </div>
                            
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
