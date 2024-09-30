<?php 
include('temp/function.php');
 $data = decode($_GET['link']);
// print_r($data);
$id = $data['student_id']; 

///verify_request();
?>

<style> 
table {width:900px;font-family:calibri;border:solid 2px #222;}
th{font-weight:400px;}
td{padding:10px;border-bottom:dotted 1px gray;text-align:left;text-transform:capitalize;}
strong{text-align:center;font-weight:800;color:maroon;font-size:24px;}
.txt {width:350px; height:24px;line-height:30px;font-size:20px;}
h7{padding:0px;margin:0px;font-size:30px;color:midnightblue;font-family:arial black;}
hr{solid 1px #000;}
.head{color:midnightblue;font-family:arial;border:none;}
	p{text-transform:none;}
</style>
<center>
<table border='0' width="1000" rules='col'>
<tbody>
<tr>
	 <td class='head' colspan='5'>
	 <center>
	 <img src='assets/img/banner.jpg' height='180px' width='930px' >
	 
	<span style='text-transform:lowercase'>
	<?php echo $inst_email; ?>| <?php echo $inst_url; ?>
	</span> 
	
	 </td>
</tr>

<tr><td colspan='5' style='border-top:solid 2px gray;border-bottom:solid 2px gray;'>  <center><h2>  Application Form  </h2></center> </td></tr>
<tr>
	<td>  </td>
	<td> Name of Candidate </td>
	<td> <?php echo studentinfo($id,'student_name'); ?> </td>
	<td rowspan='9'> 
	 <div style='text-align:right;font-weight:600;width:200px;float:right;'><?php echo studentinfo($id,'student_roll'); ?></div><br>
	<img src='temp/upload/<?php echo studentinfo($id,'student_photo'); ?>' alt ='Student Photo Not Available' width ='150' height='180' align='right' valign='top' />  
	</td>
<tr>
<tr>
	<td>  </td>
	<td> Mother's Name  </td>
	<td> <?php echo studentinfo($id,'student_mother'); ?></td>
<tr>
<tr>
	<td>  </td>
	<td> Father's Name  </td>
	<td> <?php echo studentinfo($id,'student_father'); ?></td>
<tr>
<tr>
	<td> </td>
	<td> Date of Birth *</td>
	<td><?php echo date('d-M-Y',strtotime(studentinfo($id,'date_of_birth'))); ?>
	</td>
<tr>
<tr>
		<td>  </td>
		<td>  Gender </td>
		<td colspan='1'>
		 <?php echo studentinfo($id,'student_sex'); ?></td>
</tr>
<tr>
		<td>  </td>
		<td> Nationality </td>
		<td colspan='1'>
		 <?php echo "INDIAN"; ?>	
		</td>
	</tr>
<tr>
	<td> </td>
	<td> Present Address </td>
	<td colspan='2'style=' text-transform:uppercase;'> <?php echo studentinfo($id,'student_address'); ?></td>
<tr>

<tr>
	<td> </td>
	<td> Mobile No. </td>
	<td colspan='2'> <?php echo studentinfo($id,'student_mobile'); ?> </td>
<tr>
<tr>
	<td> </td>
	<td> Email Address </td>
	<td colspan='2'> <?php echo studentinfo($id,'student_email'); ?></td>
<tr>
<tr>
	<td colspan='4'> <h3>Course Details </h3> </td>
</tr>

</tbody>
	<tr>
		<td> 
		
		</td>
		<td> Course Name /Code </td>
		
		<td colspan='2'> <?php echo courseinfo($id,'course_name') ." (" .courseinfo($id,'course_code') .") "; ?>  </td>
	</tr>
	
	<tr>
		<td> </td>
		<td> Course Duration </td>
		
		<td colspan='2'> <?php echo courseinfo($id,'course_duration') ." " .courseinfo($id,'course_unit'); ?> </td>
	</tr>
	
<tr>
	<td colspan='4'> <h3>Center Details </h3> </td>
</tr>

</tbody>
	<tr>
		<td> 
		
		</td>
		<td> Center Code </td>
		
		<td colspan='2'> <?php echo centerinfo($id,'center_code'); ?>  </td>
	</tr>
	
	<tr>
		<td> </td>
		<td> Center Name </td>
		
		<td colspan='2'> <?php echo centerinfo($id,'center_name'); ?> </td>
	</tr>
	
	<tr>
		<td> </td>
		<td> Center Address </td>
		
		<td colspan='2'> <?php echo centerinfo($id,'center_address'); ?> </td>
	</tr>
	
	<?php 
	$status  = studentinfo($id,'status');
	if($status=='RESULT OUT' or $status=='DISPATCHED' ) { ?>
	<tr>
		<td> </td>
		<td> Date of Admisison </td>
		
		<td colspan='2'> <?php echo date('d-M-Y',strtotime(studentinfo($id,'admission_date'))); ?></td>
	</tr>
	<?php } ?>
	
	<tr>
		<td colspan='4'><b> Decleration </b><p> I hereby declared that all the informations are correct and true to the best of my knowledge and belief.  </p> </td>
	
		
	</tr>
	<tr height=130px>
		<td colspan='3'>
		Place:	_______________<br><br>
		Date : 	_______________
		
		</td>
		<td > 
		<div style='width:200;height:50px;border:solid 0px gray;text-align:center;padding-top:-20px;float:right;'>
		<img src='temp/upload/<?php echo strtolower(centerinfo($id,'director_sign')); ?>' height='50px' ><br>
		Authorized Signatory <br></div> 	
		</td>
	</tr>

	</tbody></table>
	
	  <center><input type='button' value=' PRINT ' onClick='this.style.display="none";window.print();' ></center>
	
	
