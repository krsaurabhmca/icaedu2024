<?php
session_start(); 
$token = session_id();
ini_set('max_execution_time', 300);
set_time_limit(300);
date_default_timezone_set('Asia/Kolkata');
$today= date('Y-m-d');
$year =date("Y");
/*-------Some Basic Details (Global Variables) ---------*/
if(isset($_SESSION['user_id']))
{
	$user_id = $_SESSION['user_id'];
}

$inst_name ="IITM";
$full_name ="IMMENSE INSTITUTE OF TECHNOLOGY & MANAGEMENT";
$inst_address1 ="Hari Mohan  Gali, Salempur  ";
$inst_address2 ="Chapra, Bihar 841301";
$inst_address3 ="Mukandpur, North West, Delhi - 110042 ";
$inst_contact ="8271055515";
$inst_support ="8409720456";
$inst_email ="info@icaedu.in";
$inst_logo ="assets/img/logo.png";
$white_logo ="assets/img/white_logo.png";
$inst_url ="https://icaedu.co.in/";
$inst_domain ="icaedu.co.in";
$inst_type ="Institute";
$sender_id ="OFFEDU";
$noreply_email ="noreply@icaedu.co.in";

$inst_info ="IITM Group, Delhi";

$r_url = "https://iitmedu.co.in/registration-verification";

$inst_wa ="on";
$wa_api_key ="5331bd380f744353a0ded646828dc484";

$auth_key ="370782AXr3d0jEz61bb1223P1"; // MSG 91 METHOD MEDIA

$base_url ='https://icaedu.co.in/apprise/';
$docs_fee=200;
$ref_per =10; // Percentage of Referral
/*---------Social Link ----------*/
$start_date = '2023-12-01';

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


$host_name ='localhost';
$db_user ='u932202171_icaedu';
$db_name ='u932202171_icaedu';
$db_password ='@User_2001';

$current_date_time = date('Y-m-d H:i:s');
$bgClr = 'bg-secondary text-white';
$bgkey = 'bg-success';
$gender_list =array('','MALE','FEMALE','OTHER');
$qualification_list = array('','Non Matric','Matric','Intermediate','Graduate','Post Graduate' );
// $qualification_list = array('','8th Standards','	
// 8th Pass','10th Standards','12th Standards','Graduate','Post Graduate' );
$duration_list = array('',1,2,3,4,6,9,12,15,18,24);

$status_exam = array('PENDING','ACTIVE','BLOCK','FINISH');
$status_student = array('PENDING','VERIFIED','BLOCK');
$status_simple = array('ACTIVE','PENDING','BLOCK');
$status_list =array('PENDING','VERIFIED','RESULT UPDATED','RESULT OUT','DISPATCHED','BLOCK');
$unit_list =array('Days','Months','Hours','Years');

$ans_option = array( 'A','B','C','D'); 
$level = array( 'EASY','MEDIUM','HARD'); 
$topic_list = array( 'FUNDAMENTAL', 
	'MS DOS','MS WINDOWS','MS WORD','MS EXCEL','MS POWERPOINT','CSS','PHP');
	
$month = array('April','May','June','July','August','September','October','November','December','January','February','March');


$admin_role =array('test','add_course' , 'add_paper' , 'add_student' , 'admin_download_student' , 'admin_view_student' , 'assets' , 'change_password' , 'client_index' , 'config' , 'dashboard' , 'docs.txt' , 'docs_upload' , 'edit_center.php' , 'edit_course' , 'edit_student','edit_student.php' , 'edit_user.php' , 'footer' , 'function' , 'gallery' , 'header' , 'ica_team' , 'index' , 'login' , 'manage_center' , 'manage_course' , 'manage_student' , 'master_process' , 'menu' , 'next' , 'notice' , 'notification' , 'print_application' , 'print_c_certificate' , 'print_c_ms' , 'print_certificate' , 'print_certificate_old' , 'print_id' , 'print_ms' , 'print_result' , 'qrcode' , 'question' , 'quick_view' , 'result_edit' , 'result_entry','result_entry.php', 'result_view' , 'rtfmail' , 'send_sms' , 'show_enquery' , 'show_question' , 'show_topics' , 'show_user' , 'syllabus' , 'topic_view' , 'txn_entry.php', 'txn_entry','user_txn.php', 'txn_history' , 'txn_process' , 'txn_view' , 'upload' , 'user_txn' , 'video' ,'fee_entry','search_to_pay','collection_report','pay_fee','wallet_txn','ref_center','add_center','our_team','account_txn','add_to_gallery');

$client_role = array('test','config','conn','function','client_index','add_student','manage_student','result_view','result_entry.php','result_edit','ica_team','user_txn','fee_entry','search_to_pay','collection_report','pau_u_money','paytm','change_passsword','edit_student','edit_process','edit_result','fee_update','result_entry','pay_fee','txn_history','account_txn','ref_center','wallet_txn','our_team','make_att','att_report', 'att_time_report');

$admin_task = array('master_delete','send_sms','master_block','block_user','update_status','add_center','edit_center','txn_entry','delete_student','add_course_type','add_course','add_paper','add_docs','add_question','add_video','add_to_gallery','edit_user','add_to_wallet','delete_course','upload_syllabus');

$txn_mode_list =array('','BANK','CASH');
$txn_type_list =array('','INCOME','EXPENSE');
$menu_type_list =array('','MENU','SUBMENU');

$permission_list =array('YES','NO');

$param_list = array(''=>'Select parameter','student_name'=>'Name','student_father'=>'Father Name','date_of_birth'=>'DOB','course_id'=>'Course Name','center_id'=>'Center Name');

for($i=2019; $i<=date('Y'); $i++){ 
    $year_list[] =$i;
}


// META WHATSAPP AUTOMATION whatsapp.x2z.in 

$wa_vendor ='ca6b6ef7-cf72-4fba-a60f-af147ac1a4bc';
$wa_token ='0rgYF51fW4gm4x9Ywi1tdoDpeDmAfsw4L5QJsJJyQsUYssXIb5viSgf5XKbnqhIK';

  
  

/*-------End of Basic Details ---------*/

?>