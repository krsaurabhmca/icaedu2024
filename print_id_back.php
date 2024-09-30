<?php require_once("temp/function.php");	
error_reporting(E_ALL);
?>
<title> <?php echo $inst_name; ?></title>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
body{
	color:#000;
	padding-top:0px;
	padding:0px;
	margin:10px;
	font-family: 'Roboto', sans-serif;
	font-size:11px;
}

.idcard{
    width:53mm; height:85mm;
	background: url('assets/images/back_id.jpg') no-repeat 50% 50%; 
    background-size:53mm 85mm;
    float:left;page-break-before: always;position:relative;
    border:solid 1px #fff;
 }

.inner_box{
    width:47.56mm; height:81.46mm;
    width:49.56mm; height:81.46mm;
    border:solid 0px red;
    background:transparent;
    margin:auto;
    margin-top:9.62mm;
}

.banner{
		position:absolute;width:25mm; height:2.8mm;left:16mm;z-index:0;background:orangered; border-radius:10%;top:15mm;
		font-size:8px;color:#fff;line-height:12px;padding:0px 5px;
	}
	
.photo{
		position:absolute;width:15mm; height:18mm;left:6mm;z-index:0;border:solid 0px #000;border-radius:10%;top:19mm;
	}
.qr{
		position:absolute;width:16mm; height:16mm;left:35mm;z-index:0;border:solid 0px #000;border-radius:0%;top:20mm;
	}
.sign{
		position:absolute;width:16mm; height:16mm;left:35mm;z-index:0;border:solid 0px #000;border-radius:0%;top:74mm;
		font-size:8px;
	}
.adm{
		position:absolute;
		left:25mm;
		border-radius:2px;
		top:25mm;
		font-size:12px;
		background:orangered;
		color:#fff;
		padding:2px 5px;
	}
.name{
		position:absolute;
		border-radius:2px;
		top:37mm;
		width:47mm;
		font-size:14px;
		color:orangered;
		text-align:center;
		border:solid 0px red;
		text-transform:uppercase;
		font-weight:600;
	}


txt{
    font-size:8px;
    line-height:10px;
    font-weight:600;
      text-align: justify;
  text-justify: inter-word;
}
@media print {
  #printbtn {
    display: none;
  }
  .idcard{
        page-break-inside:avoid;
    }
  /*@page {size:portrait;}*/
}
</style>

<?php
extract($_POST);

	for($i=1; $i<=10; $i++)
	{
	$student_id = $student['id'];
	$student_admission = $student['student_admission'];
	?>
        <div class='idcard' style='margin-bottom:18px;margin-left:5px;margin-top:15px'>
            <div class='inner_box'>
        <br><br>
        <h3 style='margin-top:-55px;text-align:center;text-decoration: underline;'> Instructions:</h3>
        <txt>
            <ol style="margin-left:-30px;">
                
           <li>The Holder of this card is a registered student of IITM.</li>
       <li>Student must wear I-Card around the neck in the institution campus.</li>
        <li>By the registration, the holder agrees to abide by the Rules and Regulations of the institute.</li>
        <li>In the case of loss, inform the  institution immediately.</li>
        </ol>
        <img src='assets/img/ica.png' width='100%' height='50px'>
        &emsp;&emsp;&emsp;An ISO 9001 : 2015 Certified Company
        <br>
        <br><ion-icon name="location-outline"></ion-icon> <?= $inst_address3 ?>
        <br><ion-icon name="mail-outline"></ion-icon> <?= $inst_email ?>
        <br><ion-icon name="call-outline"></ion-icon> <?= $inst_contact ?>
        <br><ion-icon name="earth-outline"></ion-icon> <?= $inst_url ?>
        
        </txt>
                <h3 style='margin-top:35px;text-align:center;'>Signature Authority</h3>

        <!--<small><b>&nbsp;&nbsp;&nbsp;&nbsp;  If found please return to following address. </b></small>-->
     
			</div>
    	</div>	
<?php } ?>
			
