<?php 
include('temp/header.php');
include('temp/sidebar.php');
$data = decode($_GET['link']);
$sid = $data['student_id']; 
$student = get_data('student',$sid)['data'];
$course_id = $student['course_id'];
$status = $student['status'];
$print_link =encode("student_id=$sid&name={$student['student_name']}");
?>
  <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    background-color: #eee;
}
#student_view img{
    height: 150px;
    width: 150px;
    border: 8px solid #eee;
    position: absolute;
    left: 50%;
    top: 0;
    transform: translate(-50%,-50%);
}

.card{
    position:relative;
    width: 100%;
    border-radius: 5px;
    border: none;
    
}
.name{
    font-size: 20px;
    margin-bottom: 6px;
    padding-top: 90px;
}
.job{
    color: #25fa25;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 8px;
}
.container .card .icons .icon {
    font-size: 14px;
    width: 30px;
    height: 30px;
    color: white;
    background-color: #fa2525;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}
.dis{
    color: #7e7c7c;
    line-height: 2;
}

.container .card:hover .icons .icon {
    background-color: #f06d6d;
}
.container .card:hover .text-center{
    background-color:#fa2525;
    color: white;
}
.container .card:hover .job,.container .card:hover .name{
    color: white;
}
.container .card:hover .dis{
    color: #c4c4c4;
}
.container .card .icons .icon:hover{
    background-color: rgb(235, 123, 103);
}
.mt-80{
    margin-top: 80px;
}

td{
    padding:4px;
}
th{
    text-align:center;
    padding:4px;
}
tr:nth-child(even) {background-color: #e8c9f5;}

            </style>
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                 
			
	<div class="card mb-4">
        <div class="card-header" style='background:#e8c9f5'>
            <b>Student Profile </b>
            <span style='float:right'>
                <button class='btn btn-border border-primary btn-sm'>
                  <?= studentinfo($sid,'status');?>
                </button>
            
              <?php	
              if($_SESSION['user_type']=='ADMIN'){
              echo btn_edit('add_student',$sid,'fa fa-edit','Edit Student','warning');
              }
              ?>
              <a href='print_application.php?link=<?=$print_link?>' class='btn btn-success btn-sm' target='_blank'><i class='fa fa-print'></i></a>
            </span>
        </div>
        <div class="card-body" id="student_view">
           
            <div class='row'>
            
             <div class="col-lg-4  col-md-6 col-sm-6 mt-80">
                <div class="card  d-flex align-items-center justify-content-center text-light" style='background:#550874;'>
                    <div class="w-100"><img src="<?= $base_url ?>/temp/upload/<?php echo get_data('student',$sid,'student_photo')['data'] ?>" alt="" class="rounded-circle" ></div>
                    <div class="text-center ">
                        <p class="name"><?php echo studentinfo($sid,'student_name'); ?></p>
                      
                        <p><?php echo studentinfo($sid,'student_roll'); ?></p>
                       
                        <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                            <li class="icon "><span class="fa fa-birthday-cake"></span></li>
                            <li class="icon mx-2">
                                <?php echo date('d-M-Y',strtotime(studentinfo($sid,'date_of_birth'))); ?>
                            </li>
                           
                        </ul>
                        <p class="dis pb-4 text-light" >
                           
                            <?php echo courseinfo($sid,'course_code'); ?><br>
                         
						    <i class='fa fa-mobile'></i>
						    <a href='tel:<?php echo studentinfo($sid,'student_mobile'); ?>' class='text-warning'><?php echo studentinfo($sid,'student_mobile'); ?></a>
						   
						   <?php if(studentinfo($sid,'student_email') !=''){ ?>
						    <br><i class='fa fa-envelope'></i>
						    <a href='mailto:<?php echo studentinfo($sid,'student_email'); ?>' class='text-warning'><?php echo studentinfo($sid,'student_email'); ?></a> 
						    <?php } ?> 
						    <hr>
						    <?php if(studentinfo($sid,'student_id_proof') !=''){ ?>
						    <a href='temp/upload/<?php echo studentinfo($sid,'student_id_proof'); ?>' download class='btn btn-success btn-sm'><i class='fa fa-download'></i> ID Proof </a> 
						    <?php } ?> 
						    
						    <?php if(studentinfo($sid,'student_edu_proof') !=''){ ?>
						    
						    <a href='temp/upload/<?php echo studentinfo($sid,'student_edu_proof'); ?>' download class='btn btn-success btn-sm'><i class='fa fa-download'></i> Education Proof</a> 
						    <?php } ?> 
						</p>
                    </div>
                </div>
            </div>
             <div class="col-lg-8  col-md-6 col-sm-6 mt-80">
                 
                  <table width="100%" cellpadding='4px' style='border:solid 1px #d2d2d2;' >
									
									<tr>
									<td> <label> Mother's Name </label> </td> <td> : </td>
									<td> <?php echo studentinfo($sid,'student_mother'); ?> </td>
                                    
                                    </tr>
									
									<tr>
									<td> <label> Father's Name </label> </td> <td> : </td>
									<td> <?php echo studentinfo($sid,'student_father'); ?> </td>
                                    
                                    </tr>
                                    
                                    <tr>
									<td> <label> Qualification </label> </td> <td> : </td>
									<td> <?php echo studentinfo($sid,'student_qualification'); ?> </td>
                                    
                                    </tr>
									
								
									<tr>
									<td> <label> Course Title</label> </td> <td> : </td>
                                    <td> <?php echo courseinfo($sid,'course_name'); ?> 
									 ( <?php echo courseinfo($sid,'course_code'); ?> )
									</td>
									</tr>
									<tr>
									<td> <label> Course Duration</label> </td> <td> : </td>
                                    <td> <?php echo courseinfo($sid,'course_duration'); ?> Months </td>
									</tr>
									
									<tr>
									<td width='190'> <label> Center Code </label> </td> <td> : </td>
									<td> <?php echo centerinfo($sid,'center_code'); ?> </td>
									</tr>
									<tr>
									<td width='190'> <label> Center Name </label> </td> <td> : </td>
									<td> <?php echo centerinfo($sid,'center_name'); ?> </td>
									</tr>
									<tr>
									<td width='190'> <label> Center Address </label> </td> <td> : </td>
									<td> <?php echo centerinfo($sid,'center_address'); ?>, <?php echo distinfo(centerinfo($sid,'dist_code'),'dist_name'); ?> </td>
									
									</tr>
									
								    	<tr>
									<td width='190'> <label> Contact Number </label> </td> <td> : </td>
									<td> <?php echo centerinfo($sid,'center_mobile'); ?> </td>
									
									</tr>	
									<?php 
									   if(studentinfo($sid,'status') =='RESULT OUT' || studentinfo($sid,'status') =='DISPATCHED'){
									?>
									<tr>
									<td width='190'> <label> Admission Date </label> </td> <td> : </td>
									<td> <?php echo studentinfo($sid,'admission_date'); ?> </td>
									
									</tr>
									<?php } ?>
									<!--<tr>-->
									<!--<td width='190'> <label> Reg Date </label> </td> <td> : </td>-->
									<!--<td>-->
									    
									<!--     <?php echo date('d-M-Y h:i A', strtotime(studentinfo($sid,'created_at'))); ?> </td>-->
									     <?php //echo time_gap(studentinfo($sid,'created_at')); ?> </td>
									
									<!--</tr>-->
							
									
								    </table>
             </div>
             
            <?php if(get_data('result',$sid,null,'student_id')['count'] >0){ ?>
             <h4> Performance Report 
            <span style='float:right'>
            
             <?php 
             if ($status =='RESULT UPDATED' and $user_type =='ADMIN'){
				echo btn_edit('result_edit',$sid,'fa fa-edit','Edit Result','danger');
			    }
			?>
            </span>
             </h4>
             
            <!--<table class='table table-bordered'>-->
            <table width="100%" cellpadding='4px' style='border:solid 1px #d2d2d2;' >
				<tr >
					
					<th width='200px'> Exam </label></th>
					<th width='200px'> Full Marks </label> </th>
					<th width='200px'> Pass Marks </label> </th>
					<th> Marks Obtained </label> </th>
				</tr>
				<?php
				$i=1;
				$full_total=0;
				$pass_total=0;
				$obtained_total=0;
				$sql ="select * from paper_list where course_id ='$course_id'";
				$res = mysqli_query($con,$sql) or die ("Error in selecting Student". mysql_error());
				
				while($row =mysqli_fetch_array($res))
				{
				$paper ='paper'.$i;
				
				$full_total+=$row['full_marks'];
				$pass_total+=$row['pass_marks'];
				$obtained_total+=resultinfo($sid,$paper);
				?>
				<tr height='20px'>
					<td> <label><?php echo $row['paper_name']; ?> </label> </td>
					<td align='center'><label><?php echo $row['full_marks']; ?> </label> </td>
					<td align='center'><label><?php echo $row['pass_marks']; ?></label> </td>
					<td align='center'> <?php echo resultinfo($sid,$paper); ?> </td>
				</tr>
				<?php 
				$i=$i+1;
				} 
				?>
				<?php if( courseinfo($sid,'course_type') <>'8' ) { ?>
				<tr height='20px'>
					<td width='200'> <label><b>Total</label> </td>
					<th  width='200'><label align='center'><?php echo $full_total; ?> </label> </th>
					<th width='200'> <label align='center'><?php echo $pass_total; ?> </label> </th>
					<th width='200'> <label align='center'><?php echo $obtained_total; ?> </label> </th>
					</tr>   
				<?php } ?> 
				</table>
				<?php }?>
				</div>
				</div>
              </div>
            </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>