<?php require_once('student_temp/sidebar.php'); 
// $student_id =$_GET['student_id'];
$sid =$_SESSION['user_id'];
// $course_id =studentinfo($sid,'course_id');

$course_fee =$course_fee =studentinfo($sid,'course_fee');
$paid_amount = totalpaid($sid);
$dues =$course_fee - $paid_amount;

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
                                    <h4 class="mb-sm-0 font-size-18">Pay Details of <?php 
                                    echo studentinfo($sid,'student_name');?> 	 </h4>
                                    <div class="page-title-right">
		                           
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
		  <div class="card-header bg-white font-weight-bold">
           Details of Fee  ( Course Fee : <b><?php echo studentinfo($sid,'course_fee'); ?> </b>)
        </div>
        <div class="card-body">
			    <div class="table-responsive">
                                <table class="table">
                                    <thead >
                                        <tr bgcolor='pink'>
                                            <th>Receipt No.</th>
                                            <th>Paid date</th>
                                            <th>Dues Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Remarks</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									 $query ="select * from receipt where student_id =$sid order by id desc";
									$res = direct_sql($query);
									$total =0;
								// 	print_r($course_fee);
									foreach($res['data'] as $row)
									{
									    
										$rid = $row['id'];
										$link =encode('receipt_id='.$rid);
											echo "<tr>";
											echo "<td> <a href='print_receipt.php?link=$link' target='_blank'>". $row['receipt_no']."</a></td>";
											echo "<td> ". date('d-M-y',strtotime($row['paid_date'])) ."</td>";
											echo "<td> ". $row['total'] ."</td>";
											echo "<td> ". $row['paid_amount'] ."</td>";
											echo "<td> ". $row['remarks'] ."</td>";
											echo "</tr>";
											$total =$total+ $row['paid_amount'];
									}
										$dues = $course_fee -$total;
									?>
                                       
                                    
									<tr><th colspan='2'> Total Paid :</th><th> <?php echo $total; ?> </th>
										<th> <?php if($dues ==0) {echo "No Dues"; }
											else{echo "Dues = " .$dues ;}  ?>
										</th>
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
<?php require_once('student_temp/footer.php'); ?>