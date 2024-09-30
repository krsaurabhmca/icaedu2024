<?php require_once("temp/function.php");
$data = decode($_GET['link']);
$center_id =$data['center_id']; 

$sc = get_data('center_details',$center_id)['data'];

$dist_name = get_data('district',$sc['dist_code'],'dist_name','id')['data']; 
$state_name = get_data('state',$sc['state_code'],'state_name','id')['data'];

?>

<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Exo:wght@900&display=swap" rel="stylesheet">
<title> <?php echo $inst_name; ?></title>
<style>
body{
	color:#000;
    margin:0px;
    padding:0px;
}
.canvas_div_pdf{
    margin-top:0px;
    background:url('assets/img/cntr_cr.jpg') no-repeat;
    background-size: 1220px 830px; 
    width:1220px;
    border:solid 0px red;
}
td{
	font-size:16px;
	padding:4px;
	/*font-family:  'Playball', cursive, times new roman;*/
	line-height:36px;
	text-align:center;
	}
label{color:#fff;display:none;}
@media print {
  #printbtn {
    display: none;
  }
 
  @page {size: auto;}
}


</style>

			<div id='ms' class='canvas_div_pdf'>
			 <input type='button' onclick='window.print();' id='printbtn' value='Print Now' style='margin-top:50px;display:none;'>
			<table width='1050px' height='830' border='0' id='certificate' >
				<tr>
				<td height='250px' width="50px"> </td>
				<td valign='top' style='padding-right:0px;padding-top:40px;text-align:left;font-family:times new roman;font-size:20px;color: white;'><b> Sr. No. : <?= $sc['sl_no'] ?></b>
				</td>
				</tr>
				
				
				<tr>
				<td colspan='3'>
				<div style='width:800px;font-size:22px;margin-left:310px ;margin-bottom: 10px;'>
				<span style="font-size:22px;font-weight:400;font-family: 'Playball', cursive, times new roman;"> This is certify that </span><br>
				<span style="font-size:20px;font-weight:400;font-family: 'Exo', sans-serif;">   <?= $sc['center_name'] ?></span>
				</div>
				<div style='width:800px;font-size:22px;margin-left:310px ;margin-bottom: 10px;'>
				<span style="font-size:22px;font-weight:400;font-family: 'Playball', cursive, times new roman;"> Represented by </span><br>
				<span style="font-size:20px;font-weight:400;font-family: 'Exo', sans-serif;">Ms. / MR. <?= $sc['center_director'] ?></span>
				</div>
				<div style='width:800px;font-size:22px;margin-left:310px ;margin-bottom: 10px;'>
				<span style="font-size:22px;font-weight:400;font-family: 'Playball', cursive, times new roman;"> Having its Office at </span><br>
			    <span style="font-size:16px;font-weight:400;font-family: 'Exo', sans-serif;"><?= $sc['dp_address'] ?></span><br>
				Dist : <span style="font-size:16px;font-weight:400;font-family: 'Exo', sans-serif;"><?= $dist_name ?></span>,
				State : <span style="font-size:16px;font-weight:400;font-family: 'Exo', sans-serif;"><?= $state_name ?></span>,
				PIN Code : <span style="font-size:16px;font-weight:400;font-family: 'Exo', sans-serif;"><?= $sc['pin_code'] ?></span>
				</div>
				<div style='width:800px;font-size:22px;margin-left:310px;line-height:23px;'>
				<span style="font-size:22px;font-weight:400;font-family: 'Playball', cursive, times new roman;margin-bottom: 20px;"> Authorised to conduct different academic and technical programs<br>
                   under the symbol and banner of </span>
				</div>
				<div style='width:800px;font-size:22px;margin-left:310px;line-height:px;margin-bottom: 10px;'>
				 <span style="font-size:18px;font-weight:400;font-family: 'Exo', sans-serif;text-decoration: underline;text-decoration-thickness: 5px;text-decoration-color:#26166b">IMMENSE  INSTITUTE OF TECHNOLOGY & MANAGEMENT  PRIVATE LIMITED </span> 
				 </div>
				 <div style='width:800px;font-size:22px;margin-left: 200px;line-height:23px;margin-bottom: 10px;color:#26166b'>
				 <span style="font-size:18px;font-weight:400;font-family: 'Exo', sans-serif;text-decoration: underline;text-decoration-thickness: 2px;text-decoration-color:#d28540">CENTER CODE</span><br>
				 <span style="font-size:18px;font-weight:400;font-family: 'Exo', sans-serif;"><?= $sc['center_code'] ?></span> 
				 </div>
				 <div style='width:800px;font-size:22px;margin-left: 21px;line-height:23px;margin-bottom:10px;'>
				 <span style="font-size:18px;font-weight:400;font-family: 'Exo', sans-serif;text-decoration: underline;text-decoration-thickness: 2px;">Date of Registration</span><br>
				 <span style="font-size:18px;font-weight:400;font-family: 'Exo', sans-serif;"><?= date('d-M-Y',strtotime($sc['center_dos'])) ?></span> 
				 </div>
				 <div style='width:800px;font-size:22px;margin-left: 375px;line-height:23px;margin-top:-56px;'>
				 <span style="font-size:18px;font-weight:400;font-family: 'Exo', sans-serif;text-decoration: underline;text-decoration-thickness: 2px;">Date of Expiry</span><br>
				 <span style="font-size:18px;font-weight:400;font-family: 'Exo', sans-serif;"><?= date('d-M-Y',strtotime($sc['center_doe'])) ?></span> 
				 </div>
				 </td>
				
				</tr>
							
				</table>
				</div>
    