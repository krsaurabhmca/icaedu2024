<?php require_once('student_temp/sidebar.php'); 
$sid =$_SESSION['user_id'];
$course_id =studentinfo($sid,'course_id');
$course_type =get_data('course_details',$course_id,'course_type')['data'];
$ed_link = encode('student_id='.$sid);
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
                                    <h4 class="mb-sm-0 font-size-18">PROVISIONAL MARKS STATEMENT</h4>
                                    <div class="page-title-right">
		                           
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
        <?php if($course_type== '8' || $course_type=='4'){
            $url= "../pdf_c_typing.php?link=$ed_link";
            echo "<iframe src='$url' title='student certificate' width='100%'height='800px'></iframe>";
        }else{
        ?>
			        <div class="table-responsive">
                                <table class="table">
									<tr> <th colspan='4'><center> <h3> PROVISIONAL MARKS STATEMENT</h3> </th> 
										<td rowspan='2'><center> <img src='../temp/upload/<?php  echo studentinfo($sid,'student_photo'); ?>' alt='Student Photo' Width='100px' height='120px'> </center></td>
									</tr>
									
									<tr>
									<td> <label> Course Name : </label> </td>
                                    <td width='300'> <?php echo courseinfo($sid,'course_name'); ?> 
									(<?php echo courseinfo($sid,'course_code'); ?> ) </td>
									<td> <label> Reg. No. </label> </td>
									<td colspan='1'> <?php echo studentinfo($sid,'student_roll'); ?> </td>
									</tr>
									<tr>
									
									<tr>
									<td> <label> Student Name : </label> </td>
									<td> <?php echo studentinfo($sid,'student_name'); ?> </td>
                                    <td> <label> Center Code : </label> </td>
									<td colspan='2'> <?php echo centerinfo($sid,'center_code'); ?> </td>
									</tr>
									
									<tr>
									<td> <label> Mother's Name : </label> </td>
									<td> <?php echo studentinfo($sid,'student_mother'); ?> </td>
									<td > <label> Center Name : </label> </td>
                                    <td colspan='2'> <?php echo centerinfo($sid,'center_name'); ?>  </td>
									</tr>
									
									
									<tr>
									<td> <label> Father's Name : </label> </td>
									<td> <?php echo studentinfo($sid,'student_father'); ?> </td>
									<td> <label> Center Address : </label> </td>
                                    <td colspan='2' > <?php echo centerinfo($sid,'center_address'); ?>  </td>
									</tr>
								</table>
								<table class='table text-center' >
									<tr>
									<th colspan='5'> </th>
									</tr>
									
									<tr bgcolor='pink'>
										<!--<th> # </th>-->
										<th> Exam </th>
										<th> Full Marks </th>
										<th> Pass Marks  </th>
										<th> Marks Obtained  </th>
									</tr>
									<?php
				$i=1;
				$sql ="select * from paper_list where course_id ='$course_id'";
				$res = mysqli_query($con,$sql) or die ("Error in selecting Student". mysqli_error($con));
				
				while($row =mysqli_fetch_array($res))
				{
				$paper ='paper'.$i;
				?>
				<tr >
					<td align='left'><?php echo $row['paper_name']; ?> </td>
					<td><?php echo $row['full_marks']; ?> </td>
					<td><?php echo $row['pass_marks']; ?> </td>
					<td align='center'> <?php echo resultinfo($sid,$paper); ?> </td>
				</tr>
				
				<?php 
				$i=$i+1;
				} 
				?>
									
				<tr>
				<th> Total </th>
				<th> 400 </th>
				<th> 160 </th>
				<th> <?php echo resultinfo($sid,'total'); ?>  </th>
				</tr>
				<tr class='bg-info text-white'>
				<TD COLSPAN='2'> </TD>
	<td class='but'> Percentage &nbsp; &nbsp; &nbsp; &nbsp; <?php echo resultinfo($sid,'percentage'); ?>% </td>										<td  > Grade &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;  <?php echo resultinfo($sid,'grade'); ?>  </td>
							<td></td>
									</tr>
									
									<tr>
									<td colspan='4' style='text-align:justify'>
									<b>Notes & Explanation :</b>
										<p>1. In case of any mistake being detected in the preparation of the Marks Statement at any stage or when it is brought to the notice of the
										concerned authority, we shall have the right to make necessary corrections. </p>

										<p>2. This is a Computer generated Provisional Marks Statement and hence does not require Signature. For Verification refer to Original Marks
										Statement. </p>
										<p>3. In case of any error in this statement of marks it should be reported within 15 days.</p>
									</td>
							
									
								    </table>
				</div>
				<?php } ?>
              </div>
            </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('student_temp/footer.php'); ?>