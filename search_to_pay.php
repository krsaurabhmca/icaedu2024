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
                                    <h4 class="mb-sm-0 font-size-18"> Search for Payment </h4>
                                    <div class="page-title-right">
                                        <!--<form>-->
                                        <!--<select name='batch_id' class='form-select select2' onchange='submit()' onblur='submit()'>-->
                                        <!--    <?= dropdown_where('batch_details','id','batch_name',['created_by'=>$user_id]);?>-->
                                        <!--</select>-->
                                        <!--</form>-->
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
   <div class="card ">
        <div class="card-body">
                               <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
      
                                    <thead>
                                        <tr>
                                            <th>Reg. No.</th>
                                            <th>Name</th>
                                            <th>Course </th>
                                            <th>Batch </th>
                                            <th>Total Fee </th>
                                            <th>Total Paid </th>
                                            <th>Dues Amount </th>
                                            
                                            <th>Operation.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($user_type <>'ADMIN' or $user_type <>'CLIENT')
                                        {
                                        $center_id = centerid($user_name);
                                            
                                       
                                        $sql ="select * from student where center_id =$center_id and status not in ('AUTO','PENDING','DELETED','BLOCKED','REJECTED')"; 
                                        
                                        
                                        
                                        $res = direct_sql($sql);
                                        
                                        foreach((array) $res['data'] as $row)
                                        {
                                           
                                        $student_id =$row['id'];
                                        $status = $row['status'];
                                        $course_fee =studentinfo($student_id,'course_fee');
                                        $paid_amount =totalpaid($student_id);
                                        $dues =$course_fee -$paid_amount;
                                        $batch_name =get_data('batch_details',studentinfo($student_id,'batch_id'),'batch_name')['data'];

                                        echo"<tr class='odd gradeX'>";
                                        echo"<td>".trim($row['student_roll'])."</td>";
                                        echo"<td>".$row['student_name']."</td>";
                                        echo"<td>".courseinfo($student_id,'course_code')."</td>";
                                        echo"<td>".$batch_name."</td>";
                                        echo"<td>".$course_fee."</td>";
                                        echo"<td>".$paid_amount."</td>";
                                        echo"<td>".$dues."</td>";
                                        
                                        echo"<td>";
                                    
                                        if ($course_fee <>0 && $dues ==0)
                                        {
                                        echo "<button type='submit' class='btn btn-danger btn-sm' name='No_dues'>No Dues </button>";    
                                        }
                                        else if($course_fee <>0 && $dues <0)
                                        {
                                        echo "<button type='submit' class='btn btn-warning btn-sm' >Advance</button>";    
                                        }
                                        else{
                                        echo "<a href='pay_fee?student_id=$student_id' title='Pay Fee  ' >
                                        <button type='submit' class='btn btn-success btn-sm' name='Pay_fee'>Pay Fee </button></a>"; 
                                        }   
                                        echo "</td></tr>";
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
<?php require_once('temp/footer.php'); ?>
