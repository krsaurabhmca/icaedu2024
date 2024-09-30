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
                                    <h4 class="mb-sm-0 font-size-18"> Collection Report </h4>
                                    <div class="page-title-right">
                                        <form action='#' method='post'>
                                        <div class="row text-center">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label></label>
                                                <input type='date' value='<?php echo date('Y-m-d');?>' name='from_date' class='h6' title='From Date' >
                                            </div>
                                        </div>
                                        
                                         <div class="col-lg-4">
                                            <div class="form-group">
                                                <label></label>
                                                <input type='date' value='<?php echo date('Y-m-d');?>' name='to_date' class='h6' title='To Date'>
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
     <?php if(isset($_POST['submit']) && isset($_POST['from_date']) )
                                    {
                        $fromdate =$_POST['from_date'];
                        $todate =$_POST['to_date'];
                ?>                  
        <div class="card mb-4">
        <div class="card-header <?php echo $bgClr ?> font-weight-bold">
                        
            Collection from <b> <?php echo date('d-M-Y',strtotime($fromdate)); ?></b> to <b><?php echo date('d-M-Y',strtotime($todate)); ?></b>
            <button id='btnExport' onClick ='exportxls()' class='btn btn-info btn-sm' title='Download Excel' style="float:right">Export<i class='fa fa-file-excel-o'></i></button>
        </div>
   
        <div class="card-body">
                               <div class="table-responsive">
                                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th >Receipt Id</th>
                                            <th >Student Name</th>
                                            <th>Paid date</th>
                                            <th>Total</th>
                                            <th>Paid Amount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total=0;
                                    $center_id = centerid($user_name,'id');
                                    
                                   // echo $query ="SELECT receipt.*, student.id, student.center_id FROM receipt, student WHERE receipt.student_id = student.id and paid_date between '$fromdate' and '$todate' and student_id =(SELECT student_id FROM student WHERE center_id ='$center_id')";
                                    $query ="SELECT receipt.*, student.id as student_id, student.center_id and center_id FROM receipt, student WHERE receipt.student_id = student.id and paid_date between '$fromdate' and '$todate' and student.center_id ='$center_id'";
                                    
                                //  $query ="select * from receipt where paid_date between '$fromdate' and '$todate' order by receipt_id desc";
                                        
                                    $res = direct_sql($query);
                                    
                                    foreach($res['data'] as $row)
                                    {
                                    $rid = $row['id'];
                                    $link =encode('receipt_id='.$rid);
                                    $total =$total +$row['paid_amount'];
                                    echo"<tr class='odd gradeX'>";
                                    echo "<td> <a href='print_receipt.php?link=$link' target='_blank'>".$rid."</a></td>";
                                    echo "<td> ". studentinfo($row['student_id'],'student_name') ."</td>";
                                    echo "<td> ". date('d-M-y',strtotime($row['paid_date'])) ."</td>";
                                    echo "<td> ". $row['total'] ."</td>";
                                    echo "<td> ". $row['paid_amount'] ."</td>";
                                    echo "</tr>";
                                    }
                                    
                                    ?>
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr><td colspan='5' align='right'> <?php echo $total; ?></td></tr>
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
