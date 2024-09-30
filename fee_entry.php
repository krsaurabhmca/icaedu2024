<?php require_once('temp/sidebar.php');
if($user_type=='CLIENT')
{
    $center_id =centerid($user_name);
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
                                    <h4 class="mb-sm-0 font-size-18">Fee Entry</h4>
                                    <div class="page-title-right">
                                     <!--<form action ='' method='get'>-->
                                     <!--   <select name='batch_id' onblur='submit()'  onchange='submit()'  class='form-select select2'>-->
                                     <!--       <?php echo dropdown_where('batch_details','id','batch_name',['created_by'=>$user_id,'status'=>'ACTIVE'], $_GET['batch_id']); ?>-->
                                     <!--   </select>-->
                                     <!--   </form>-->
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
    <?php if($user_type =='CLIENT' )
            {
            $batch_id =$_GET['batch_id'];     
    ?>
    <div class="card">
    <div class="card-header bg-dark font-weight-bold text-white">
        Set Student Fee  
       
    </div>
        <div class="card-body">
                             <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th>Reg No.</th>
                                            <th>Student Name</th>
                                            <th>Mobile No</th>
                                            <th>Course Name</th>
                                            <th width='180px'>Course Fee </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total=0;
                                    
                                    $query ="select * from student  where  center_id =$center_id and status not in ('AUTO','PENDING','DISPATCHED','DELETED','BLOCKED') order by id";
                                        
                                                    
                                    $res = direct_sql($query);
                                    
                                    foreach((array) $res['data'] as $row)
                                    {
                                        $student_id = $row['id'];
                                        $course_id =studentinfo($student_id,'course_id');
                                        $default_fee = get_data('course_details', $course_id,'course_fee')['data'];
                                        $course_name = get_data('course_details', $course_id,'course_name')['data'];
                                        $student_fee = studentinfo($student_id,'course_fee');
                                        
                                        $bgcls = ($student_fee>0)?' bg-warning ' :'';
                                            echo"<tr class='odd gradeX $bgcls'>";
                                            echo "<td> ". studentinfo($student_id,'student_roll') ."</td>";
                                            echo "<td> ". studentinfo($student_id,'student_name') ."</td>";
                                            echo "<td> ". studentinfo($student_id,'student_mobile') ."</td>";
                                            echo "<td> ". $course_name ."</td>";
                                            echo "<td>";
                                        ?>
                                            
                                            <?php 
                                            echo "<input type='text' placeholder='".$default_fee."' value='".$student_fee."' class='fee_value' size='10' name='dues_amount' data-id ='$student_id'> ";
                                            echo "<input type='button' class='set_fee_btn btn btn-danger btn-sm' value='Set Fee'>";
                                            ?>
                                    </td>
                                    </tr>
                                    <?php   
                                    }
                                    
                                    ?>
                                    
                                    </tbody>
                                </table>
                            
                           </div>
                           <?php } else{
                                echo "<div class='alert alert-info'> Alert ! Select Batch From Right Corner To See Student Data  </div>";
                           }?>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
