<?php require_once("temp/function.php");
verify_request();
$data = decode($_GET['link']);
$sid =$data['student_id']; 
$student = get_data('student',$sid)['data'];
?>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nixie+One">
<title> <?php echo $inst_name; ?></title>
<style>
body{
	color:#000;
	width:1050px;
	height:1450px;
	padding:0px;
	margin:0px;
}
.canvas_div_pdf{
    background:url('assets/img/bg_ms.jpg') no-repeat 0% 0%;
	background-size: 1050px 1380px;
	border:solid 0px red;
	
}
.ms{
	padding-left:25px;
	padding-top:10px;
	
}
td{font-size:19px;padding:4px;font-family:Trebuchet MS, arial;line-height:22px;font-weight:400;}
.marks td{font-size:18px;padding:4px;font-family:Trebuchet MS, arial;line-height:28px;font-weight:400;}
label1{display:block;}
label{color:#fff;display:none;}
@media print {
  #printbtn {
    display: none;
  }
  @page {size: portrait;}
}
</style>

			<div class='canvas_div_pdf'>
			<div class='ms'>
			            <!--<input type='button' onclick='window.print();' id='printbtn' value='Print Now'>
			            <img src='assets/img/bg_ms.jpg' width='1000px' > -->
			<table width='1000px' height='442px' border='0' >
				<tr>
				<td colspan='3' height='225px' > </td>
				<td style='padding-right:20px;text-align:right;valign:top;'> 
				Sr. No. : <?php echo $msid= resultinfo($sid,'ms_no'); 
				$qrvalue = "Reg No :". studentinfo($sid,'student_roll')."Name". studentinfo($sid,'student_name') ."Certificate No". resultinfo($sid,'cer_no') . " http://icaedu.co.in/result-verification";
				//$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".$qrvalue."&chld=H|0"; 
				echo "<br><img src ='".qrcode($qrvalue)."' width='100' /> "; ?>
				</td>
				</tr>
				<tr height='50' > <td colspan='4'></td></tr>
				<tr>
				<td width='260px'> <label1> Registration No. </label> </td> 
				<td width='40px'> <label1>: </td>
				<td width='400px'> <?php echo studentinfo($sid,'student_roll'); ?> </td>
				<td width='100px' rowspan='6' style='vertical-align:top;text-align:center;'width='230'>
					<img src='temp/upload/<?php  echo studentinfo($sid,'student_photo'); ?>' alt ='<?php echo studentinfo($sid,'student_photo'); ?>' width ='100' height='120' /> 
				</td>
				
				</tr>
				<tr>
				<td> <label1> Student's Name </label> </td> <td><label1> : </label></td>
				<td> <?php echo studentinfo($sid,'student_name'); ?> </td>
				</tr>
				
				<tr>
				<td> <label1> Mother's Name </label> </td> <td><label1> : </label1></td>
				<td> <?php echo studentinfo($sid,'student_mother'); ?> </td>
				
				</tr>
				
				<tr>
				<td> <label1> Father's Name </label> </td> <td><label1> : </label1></td>
				<td> <?php echo studentinfo($sid,'student_father'); ?> </td>
				
				</tr>
				
				<tr>
				<td> <label1> Course Name </label> </td> <td><label1> : </label></td>
				<td> <?php echo courseinfo($sid,'course_name'); ?> 
				 ( <?php echo courseinfo($sid,'course_code'); ?> )
				</td>
				</tr>
				<tr>
				<td> <label1> Course Duration</label> </td> <td><label1> : </label></td>
				<td> <?php echo courseinfo($sid,'course_duration') ." ".courseinfo($sid,'course_unit'); ?></td>
				</tr>
				
				
				<tr>
				<td > <label1> Study Centre Name </label> </td> <td><label1> : </label></td>
				<td colspan='2'> <?php echo centerinfo($sid,'center_name'); ?>
				</tr>
				<tr>
				<td > <label1>Centre Code  & Address </label> </td> <td><label1> : </label></td>
				<td colspan='2'> <?php echo centerinfo($sid,'center_code'); ?>& <?php echo centerinfo($sid,'center_address'); ?>, 
				<?php echo get_data('district',centerinfo($sid,'dist_code'),'dist_name','id')['data']; ?>, <?php echo get_data('state',centerinfo($sid,'state_code'),'state_name','id')['data']; ?> </td>
				</tr>
				
				<tr>
				
				<td colspan='4' height='290px' valign='middle' style='padding:50px;'> 
							<img src='syllabus/<?php echo courseinfo($sid,'course_image'); ?>'>
				</td>
				
				</tr>
			</table>
		<table width='1000px' height='400px' border='0' class='marks'>
				<tr>
					
					<th width='200px'><label> Exam </label></th>
					<th width='200px'><label> Full Marks </label> </th>
					<th width='200px'><label> Pass Marks </label> </th>
					<th><label> Marks Obtained </label> </th>
				</tr>
				<?php
				$i=1;
				$course_id = $student['course_id'];
				$sql ="select * from paper_list where course_id ='$course_id'";
				$res = direct_sql($sql);
			
				foreach($res['data'] as $row)
				{
				// 	print_r($row);
				 $paper ='paper'.$i;
				?>
				<tr>
					<td> <label><?php echo $row['paper_name']; ?> </label> </td>
					<td align='center'><label><?php echo $row['full_marks']; ?> </label> </td>
					<td align='center'><label><?php echo $row['pass_marks']; ?></label> </td>
					<td align='center'> <?php echo resultinfo($sid,$paper); ?> </td>
				</tr>
				<?php 
				$i=$i+1;
				} 
				?>
				
				
				<tr height='20' > <td colspan='4'></td></tr>
				<tr>
				<td></td>
				<td align='center' colspan='2'>  <?php echo resultinfo($sid,'percentage'); ?> % </td>	
				<td align='center'>  <?php echo resultinfo($sid,'grade'); ?>  </td>
				</tr>
									
				<tr>
				<td colspan='4' height='120x'> </td>
				</tr>
				<tr> 
				<td colspan='4'> <div style='margin-left:50px'> 
				Date of Issue : <?php echo date('d-M-Y',strtotime(resultinfo($sid,'ms_date'))); ?> </div></td>	 
				</tr> 
				
				<tr height='120px'>
				<td colspan='3' > </td>
				<td align='right'><div style='margin-right:75px;margin-top:-50px;'><img src='assets/img/stamp_sign.png' width='150px' align='right' valign ='bottom'></div> </td>
				</tr>				
									
				</table>
				</div>
			</div>
   <!-- <input type="button" onClick ='downloadPdf()' value="Save As PDF" id='printbtn' />


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
//$("document").ready(function() {
function downloadPdf(){

var HTML_Width = $(".canvas_div_pdf").width();
var HTML_Height = $(".canvas_div_pdf").height();
var top_left_margin =0;
var PDF_Width = HTML_Width+(top_left_margin*2);
var PDF_Height = (HTML_Height*1.0)+(top_left_margin*2);
var canvas_image_width = HTML_Width;
var canvas_image_height = HTML_Height;

var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
canvas.getContext('2d');

console.log(canvas.height+"  "+canvas.width);


var imgData = canvas.toDataURL("image/jpeg", 1.0);
var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
   pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);


for (var i = 1; i <= totalPDFPages; i++) { 
pdf.addPage(PDF_Width, PDF_Height);
pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
}

   pdf.save("HTML-Document.pdf");
        });
}
//});
</script>

-->