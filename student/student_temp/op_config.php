<?php
session_start(); 
$token = session_id();
ini_set('max_execution_time', 300);
set_time_limit(300);
date_default_timezone_set('Asia/Kolkata');
/*-------Some Basic Details (Global Variables) ---------*/
if(isset($_SESSION['user_id']))
{
	$user_id = $_SESSION['user_id'];
}

$inst_name ="IMMENSE INSTITUTE OF TECHNOLOGY & MANAGEMENT PVT. LTD.";
$inst_address1 ="Hari Mohan  Gali, Salempur  ";
$inst_address2 ="Chapra, Bihar 841301";
$inst_contact ="8271055515";
$inst_support ="8409720456";
$inst_email ="info@icaedu.in";
$inst_logo ="assets/img/logo.png";
$white_logo ="assets/img/white_logo.png";
$inst_url ="https://icaedu.co.in/apprise";
$inst_domain ="icaedu.co.in";
$inst_type ="Institute";
$sender_id ="ICALTD";
$noreply_email ="noreply@icaedu.co.in";
//$auth_key ="642128fe8bf590f12eaf361ce469ce4"; // MSG CLUB
$auth_key ="209987Al4tzuMCF60fa96f8P1"; // MSG 91 METHOD MEDIA
$base_url ='https://icaedu.co.in/apprise';
$api_key ='3e83b446317408464a71376eab83a191'; //Icaedu
/*---------Social Link ----------*/

$facebook ='http://facebook.com/offerplant';
$twitter ='http://twitter.com/offerplant';
$linkedin ='http://linkedin.com/company/offerplant';
$youtube ='http://youtube.com';
$pinterest ='http://pinterest.com/offerplant';
$instagram ='http://instagram.com/offerplant';


$app_name ='Apprise 1.0';
$dev_company ="OfferPlant Technologies Private Limited";
$dev_by ="OfferPlant";
$dev_url ="http://offerplant.com";
$dev_email ="ask@offerplant.com";
$dev_contact ="9431426600";

/* Change in dbcontroller.php also */
$host_name ='localhost';
$db_user ='u932202171_icaedu';
$db_name ='u932202171_icaedu';
$db_password ='@User_2001';


$gender_list =array('','MALE','FEMALE','OTHER');
$qualification_list =array('','Non Matric','Matric','Intermediate','Graduation','Post Graduation' );
$duration_list =array('',1,2,3,4,6,9,12,15,18,24);

$status_list =array('PENDING','VERIFIED','RESULT UPDATED','RESULT OUT','BLOCK');
$unit_list =array('Days','Months','Hours','Years');

$topic_list = array( 'FUNDAMENTAL', 
	'MS DOS','MS WINDOWS','MS WORD','MS EXCEL','MS POWERPOINT','MS ACCESS','HTML','	INTERNET','MULTIMEDIA','HARDWARE','NETWORKING','TALLY','ADOBE PAGEMAKER','ADOBE PHOTOSHOP','COREL DRAW','PROGRAMING IN C','VISUAL BASIC 6.0','ORACLE','JAVA','C++','
	C#','CSS','PHP');
	
$month = array('April','May','June','July','August','September','October','November','December','January','February','March');


$CLIENT = array('config.php','conn.php','function.php','index.php','new_student.php','view_student.php','result_view.php','ica_team.php','user_txn.php','fee_entry.php','search_to_pay.php','collection_report.php','pau_u_money.php','paytm.php','change_passsword.php','student_process.php','edit_student.php','edit_process.php','edit_result.php','edit_result_process.php','fee_update.php','result_entry.php','result_process.php','pay_fee.php','pay_process.php','txn_history.php');
/*-------End of Basic Details ---------*/

?>