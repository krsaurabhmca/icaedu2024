<?php 
require_once("temp/function.php");
$ct = (isset($_GET['count']))?$_GET['count']:10; 
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

body{
	color:#000;
	font-family: "Poppins", sans-serif;
}

.idcard{width:200px; height:325px; background:#0ff url('assets/img/icard_back.jpg') no-repeat; text-align:center; float:left; margin:4px;margin-top:30px;}

@media print {
  #printbtn {
    display: none;
  } 
  #info {
    display: none;
  } 
  #type {
    display: none;
  }
  @page {size: landscape}
}
</style>

<div id='info'>
   <b> Instruction :</b>
   <li>  Go to  <b>apprise/assets/img/icard_back.png</b> to Change this Image </li>
   <li> Page Size : A4</li>
   <li> Margin :Minimum </li>
   <li> Use Print Button to Hide Instruction</li>
   <li> user <a href='print_id_back.php?count=20'>....print_id_back.php?count=20 </a> </i> to 20 cards and so on </li>
   <button onclick='print()' id='printbtn'> Print </button>
</div>


<?php for($i=1; $i<=$ct; $i++) { 

?>

<div class='idcard'>

</div>

<?php } ?>