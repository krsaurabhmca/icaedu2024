<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
include_once('function.php');
$user_type = $_SESSION['user_type'];
$sql = "select * from event_log WHERE created_by  <> '1' and created_at >= NOW() - INTERVAL 1 MINUTE order by id desc limit 10 ";

$ct = direct_sql($sql)['count'];
$notice = direct_sql($sql)['data'];

if($ct>=1 and $user_type =='ADMIN')
{
	foreach($notice as $single)
	{
	$action_by = get_data('user',$single['created_by'],'user_name','user_id')['data'];
	$msg = "<p><i class='fa fa-hand-o-right'></i> ". $action_by ." perform ". addspace($single['event_name']). " at ". date('h:i s', strtotime($single['created_at'])) ."</p>"; 
	//$msg = "<a href='#' class='dropdown-item'>".$msg."</a>"; 
	echo "data:{$msg} \n\n";
	}
	flush();
}
?>