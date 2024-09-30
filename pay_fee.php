<?php require_once('temp/sidebar.php'); 
 $student_id =$_GET['student_id'];
$course_fee =studentinfo($student_id,'course_fee');
$paid_amount =totalpaid($student_id);
$dues =$course_fee -$paid_amount;
?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Pay Fee for <?php echo studentinfo($student_id,'student_name');?></h4>
                                    <div class="page-title-right">
                                    
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                         <div class="col-lg-12">
                              <!--<div class="card-header <?php echo $bgClr ?> -->
                              <!--  Details of Fee -->
                              <!--       </div>-->
                            <div class="card">
                               
            <div class="card-body">
           <div class='row'>
				<div class='col-4'>
                <form action ='pay_fee' method ='post' name='fee' id='insert_frm'>
				        <div class="form-group mb-2">
                            <label>Receipt No.</label>
                            
                            <input class="form-control" value='' name='receipt_no' type='text'>
                        </div>
						<div class="form-group mb-2">
                            <label>Date of Payment</label>
                            
                            <input class="form-control" value='<?php echo date('Y-m-d');?>' name='paid_date' type='date'>
                        </div>
						
							
						<div class="form-group mb-2">
                          <label>Dues Amount</label>   
                            <input class="form-control" value='<?php echo $student_id;?>' name='student_id' type='hidden'>
                            <input class="form-control" value='<?php echo $dues ;?>' name='previous_dues' type='text' readonly>
                        </div>
						
						
						
						<div class="form-group has-error">
                            <label class="control-label" for="inputError">Enter Amount to Pay</label>
                            <input type="text" class="form-control" id="inputError" 
							placeholder='' name='paid_amount' required>
                        </div>
						<div class="form-group">
                            <label>Installment</label>
                            <input class="form-control" value='' name='remarks' required>
                        </div>
						<div class="checkbox">
                            <label>
                            <input type="checkbox" value="yes" name='checksms'> Send SMS Also (if Internet Connection)
                            </label>
                        </div>
						<input type="submit" class="btn btn-info" value='Make A Payment' name='submit' id='insert_btn'>
						</div>
						
					</form>		
						
					
						
					<div class="col-lg-8">
								
								<!--    Basic Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Your Last Payment Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead >
                                        <tr>
                                            <th >Receipt Id</th>
                                            <th>Paid date</th>
                                            <th>Total</th>
                                            <th>Paid Amount</th>
                                            <th>Remarks</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$query ="select * from receipt where student_id =$student_id order by id desc";
									$res = direct_sql($query);
									foreach($res['data'] as $row )
									{
									   // print_r($row);
											$link = encode('receipt_id='.$row['id']);
											echo "<tr>";
											echo "<td> <a href='print_receipt.php?link=$link' target='_blank'>".$row['receipt_no']."</a></td>";
											echo "<td> ". date('d-M-y',strtotime($row['paid_date'])) ."</td>";
											echo "<td> ". $row['total'] ."</td>";
											echo "<td> ". $row['paid_amount'] ."</td>";
									//		echo "<td> ". $row['paid_month'] ."</td>";
											echo "<td> ". $row['remarks'] ."</td>";
											echo "</tr>";
									}
									?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
            
            
              </div>
                </div>
                <!-- end select2 -->

            </div>

       
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
