<?php 
require_once("temp/function.php"); 

if(isset($_GET['send']) and $_GET['send'] =='yes')
{

$month = date('m');
$day =  date('d');

$sql = "select id , student_name, student_mobile, date_of_birth, status from student where day(date_of_birth) = '$day' and month(date_of_birth) ='$month' and status not in ('BLOCKED','DELETED')";

$res  = direct_sql($sql);
$i=1;
foreach((array)$res['data'] as $row)
{
    $mobile  = $row['student_mobile'];
    $name  = $row['student_name'];
    $dob = $row['date_of_birth'];
    
    $age  = calculateAge($row['date_of_birth']);
    
    $sms  ="🎉  Happy Birthday $name ! 🎂‚ Wishing you ( $age  birthday ) a day filled with joy, success, and prosperity. May your year ahead be as bright as your smile!  🥳 ".$inst_name ." ". $inst_url;
    
    echo "<br>". $i.":".  $mobile . $sms;
    $i++;
    wa_send($mobile, $sms); 
}

}

?>
