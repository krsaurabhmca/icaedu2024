<?php require_once('temp/sidebar.php'); ?>
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                     <!-- <div class="content p-4"> -->
                     	 <!-- start page title -->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                 <h4 class="mb-sm-0 font-size-18"> Dues Report </h4>
                                
                            </div>
                            
                            <div class="col-md-6">
                                    
                                  
                                        <form action='#' method='post'>
                                        <div class="row">
                                            
                                        <div class="col-md-6"></div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name='batch_id' class='form-select select2' >
                                                    <option value =''> Select Batch </ooption>
                                                    <?php echo dropdown_where('batch_details','id','batch_name', array('created_by'=>$user_id,'status'=>'ACTIVE'), $_POST['batch_id']); ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <!--<div class="col-md-6">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <select name='course_id' >-->
                                        <!--            <option value =''> Select Course </ooption>-->
                                        <!--            <?php echo dropdown_list('course_details','id','course_name', $_POST['course_id'],'course_code'); ?>-->
                                        <!--        </select>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                       
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-lg btn-success btn-sm" name='submit' value='Generate Report' >
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                    </div>

                                </div>
                         
                        <!-- end page title -->
     <?php if(isset($_POST['submit']) && isset($_POST['batch_id']) )
                                    {
                                       $batch_id =  $_POST['batch_id'];
                                        
                                        $batch_name =get_data('batch_details',$_POST['batch_id'],'batch_name')['data'];
                   
                ?>                  
        <div class="card mb-4">
        <div class="card-header <?php echo $bgClr ?> font-weight-bold">
                        
            Due Report of Batch <b> <?= $batch_name ?>  </b>
            <button id='btnExport' onclick='fnExcelReport();' class='btn btn-info btn-sm' title='Download Excel' style="float:right">Export<i class='fa fa-file-excel-o'></i></button>
        </div>
   
        <div class="card-body">
                               <div class="table-responsive">
                                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Reg. No.</th>
                                            <th>Batch</th>
                                            <th>Total</th>
                                            <th>Paid Amount</th>
                                            <th>Dues Amount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $dtotal=0;
                                    $center_id = centerid($user_name,'id');
                                    
                                    
                                    if(isset($_POST['batch_id']))
                                    {
                                       
                                    $res  = get_all('student','*',['batch_id' =>$batch_id]);
                                    
                                    foreach((array) $res['data'] as $row)
                                    {
                                    $student_id = $row['id'];
                                    $batch_name =get_data('batch_details',studentinfo($student_id,'batch_id'),'batch_name' )['data'];
                                    
                                    $total = $row['course_fee'];
                                    $paid  = totalpaid($student_id);
                                    $dues = $total -$paid;
                                    $dtotal +=$dues;
                                    if($dues<>0){
                                    echo"<tr class='odd gradeX'>";
                                    echo "<td> ". studentinfo($student_id,'student_name') ."</td>";
                                    echo "<td> ". studentinfo($student_id,'student_roll') ."</td>";
                                    echo "<td> ". $batch_name ."</td>";
                                    echo "<td> ". $total ."</td>";
                                    echo "<td> ". $paid ."</td>";
                                    echo "<td> ". $dues."</td>";
                                            
                                    echo "</tr>";
                                    
                                    }
                                    }
                                    
                                    ?>
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr class='bg-dark text-light'>
                                            <td> Total </td>
                                            <td colspan='5' align='right'> <?php echo $dtotal; ?></td></tr>
                                    </tfoot>
                                </table>
                                <?php } } ?>
                            </div>
                            
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
