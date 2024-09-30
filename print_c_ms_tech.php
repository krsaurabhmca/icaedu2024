<?php require_once("temp/function.php");
$sid =$_GET['student_id'];
$studentinfo = get_data('student',$sid,null,'id')['data'];
$course_id=$studentinfo['course_id']; 
$center_id=$studentinfo['center_id']; 
?>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nixie+One">
<style>
    body{
        margin:0px;
        padding:0px;
        font-family:Trebuchet MS, arial;
    }
    td{font-size:18px;padding:4px;font-family:Trebuchet MS, arial;line-height:22px;font-weight:400;}
    #techpage{
        width:203mm;
        height:269mm;
        padding:0mm;
        border:solid 1px #fff;
        margin:auto;
    }
    #printarea{
       margin-left:0mm;
       margin-right:8mm;
       margin-bottom:3mm;
       margin-top:4mm;
       height:272mm;
       width:195mm;
       border:solid 0px #000;
       background:url('assets/img/bg_ms_tech.png') no-repeat;
       background-size:195mm 269mm;
    }
</style>


<div id='techpage'>
   <div id='printarea'>
       <div style ='height:45mm;text-align:right;padding-top:10mm;padding-right:5mm'>
           Sr. No. : <?php echo resultinfo($sid,'ms_no'); 
				$qrvalue = "Reg No :". $studentinfo['student_roll']."Name". $studentinfo['student_name'] ."Certificate No". resultinfo($sid,'cer_no') . " http://icaedu.co.in/result-verification";
				//$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".$qrvalue."&chld=H|0"; 
			    //$url = "https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=".$qrvalue;
				echo "<br><img src ='".qrcode($qrvalue)."' width='80px' /> "; ?>
				
       </div>
      <table width='100%' border='0' >
				<tr>
				    <td width='120'> <label1> Registration No. </label> </td> 
    				<td width='10px'> <label1>: </td>
    				<td width='180'> <?php echo $studentinfo['student_roll']; ?> </td>
    				<td width='100px' rowspan='4' style='vertical-align:top;text-align:center;' width="100px">         
    					<img src='temp/upload/<?php  echo $studentinfo['student_photo']; ?>' alt ='<?php echo $studentinfo['student_photo']; ?>' width ="80" height='100' /> 
    				</td>
				
				</tr>
				<tr>
				<td> <label1> Student's Name </label> </td> <td><label1> : </label></td>
				<td> <?php echo $studentinfo['student_name']; ?> </td>
				</tr>
				
				<tr>
				<td> <label1> Mother's Name </label> </td> <td><label1> : </label1></td>
				<td> <?php echo $studentinfo['student_mother']; ?> </td>
				
				</tr>
				
				<tr>
				<td> <label1> Father's Name </label> </td> <td><label1> : </label1></td>
				<td> <?php echo $studentinfo['student_father']; ?> </td>
				
				</tr>
				
				<tr>
				<td> <label1> Course Name </label> </td> <td><label1> : </label></td>
				<td  colspan='2'> <?php echo courseinfo($sid,'course_name'); ?> 
				 ( <?php echo courseinfo($sid,'course_code'); ?> )
				</td>
				</tr>
				<tr>
				<td> <label1> Course Duration</label> </td> <td><label1> : </label></td>
				<td colspan='2'> <?php echo courseinfo($sid,'course_duration'); ?> Months </td>
				</tr>
				
				
				<tr>
				<td > <label1> Study Centre Name </label> </td> <td><label1> : </label></td>
				<td colspan='2'> <?php echo trim(centerinfo($sid,'center_name')); ?></td>
				</tr>
				<tr>
				<td > <label1>Centre Code & Address </label> </td> <td><label1> : </label></td>
				<td colspan='2'> <?php echo centerinfo($sid,'center_code'); ?> & <?php echo centerinfo($sid,'center_address'); ?>, <?php echo get_data('district',centerinfo($sid,'dist_code'),'dist_name','id')['data']; ?>, <?php echo get_data('state',centerinfo($sid,'state_code'),'state_name','id')['data']; ?> </td>
				</tr>
			</table>	
		    <div style='height:82mm;border:solid 0px red;'>
		      <table width='100%'  border='1' class='marks' rules='all' >
				<tr style='background:#c39f61;color:#fff;height:20px;line-height:20px'>
					
					<th width='420px'><label2> Exam </label></th>
					<th ><label2> Full Marks </label> </th>
					<th ><label2> Pass Marks </label> </th>
					<th><label2> Marks Obtained </label> </th>
				</tr>
				<?php 
				$i=1;
				$ttotal =0;
				$ptotal =0;
				$ototal =0;
				$sql ="select * from paper_list where course_id ='$course_id'";
				$res = direct_sql($sql);
				
				foreach($res['data'] as $row)
				{
				  //print_r($row);
    				$paper ='paper'.$i;
    				$ttotal =$ttotal +$row['full_marks'];
    				$ptotal =$ptotal +$row['pass_marks'];
    				$obt_marks = resultinfo($sid,$paper);
    				$ototal =$ototal +$obt_marks; 
				?>
				<tr style='height:20px;'>
					<td> <label2><?php echo $row['paper_name']; ?> </label2> </td>
					<td align='center'><label2><?php echo $row['full_marks']; ?> </label2> </td>
					<td align='center'><label2><?php echo $row['pass_marks']; ?></label2> </td>
					<td align='center'><label2> <?php echo $obt_marks; ?> <label2> </td>
				</tr>
				<?php 
				$i=$i+1;
				} 
				?>
				
				<tr style='background:#c39f61;color:#fff;height:20px'>
    				<td align='center' >Total</td>
    				<td align='center' >  <?php echo $ttotal; ?> </td>	
    				<td align='center' >  <?php echo $ptotal; ?> </td>	
    				<td align='center'>  <?php echo $ototal ; //resultinfo($sid,'grade'); ?>  </td>
				</tr>
				<tr height='20px' >
    				<td align='center'  colspan='2'> Overall Percentage :  <?php echo resultinfo($sid,'percentage'); ?> % </td>
    				<td align='center'  colspan='2'> *Grade : <?php echo resultinfo($sid,'grade'); ?> </td>
				</tr>
				</table>
			</div>	
			<br><br>
		    <table border='0' width="100%" height='30px' rules='none'>
		        <tr>
		        <th width="13%" style='color:red;' align='left'> *Grade :</th>
			    <th width="15%">A</th>
			    <th width="15%">B</th>
			    <th width="15%">C</th>
			    <th width="12%">D</th>
			    <th width=''>Failure</th>
		       </tr>
		           
		       <tr>
			    <th width="18%" style='color:red;' align='left' >Mark Range :</th>
			    <th width="15%">(85 to 100%)</th>
			    <th width="15%">(70 to 84%)</th>
			    <th width="15%">(55 to 69%)</th>
			    <th width="12%">(42 to 54%)</th>
			    <th width=''>(Below 40%)</th>
			    </tr>
			    <tr>
			    <td colspan='6'> 
				    <div style='margin-left:10px'> 
				    Date of Issue :  <?php echo date('d-M-Y',strtotime(resultinfo($sid,'ms_date'))); ?> 
				    </div>
				</td>
				</tr>
		    </table>    
		 
			<table width='100%' height='30px;' border='0'>
			   
				<tr>
				    <td align='right'>
				        <div style='margin-right:30px;float:right;margin-bottom:10px;border:solid 0px red;'><img src='assets/img/stamp_sign.png' valign ='middle' width='130px'></div> 
				    </td>
				</tr>				
			</table>	

   </div>
</div>