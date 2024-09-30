<?php require_once('temp/function.php');
	$set_id = $_GET['set_id'];
	$qbank = get_data('set_details',$set_id)['data'];
	//print_r($qbank);
	extract($qbank);
	if(!isset($_SESSION['user_type']))
	{
	    exit();
	}
?>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<table rules='none' border='0' width='800px' cellpadding='5px'>
	<tr>
		<td colspan='2' align='center'>
			<h2><?php echo $inst_name; ?></h2>
			<b><?php echo $inst_address1. ", ".$inst_address2; ?></b><br>
			<b><?php echo $set_name; ?></b>
		</td>
	</tr>
	<tr>
		<td> Question : <?php echo $question; ?> </td>
		<td align='right'> Duration : <?php echo $duration; ?> Minutes</td>
	</tr>
	<tr><td colspan='2'><hr></td> </tr>
<?php 
	$qlist = explode(',',$question_list);
	$i=1;
foreach($qlist as $q)
{
    $question = get_data('qbank',$q)['data'];
    
	echo "<tr>
	    <td width='80px'> ". $i ." </td>
	    <td>".html_entity_decode(base64_decode($question['question'])) ."</td></tr>";
	echo "<tr><td colspan='2'><b> A: </b>". html_entity_decode($question['opt1'])  ."</td></tr>";
	echo "<tr><td colspan='2'><b> B: </b> ". html_entity_decode($question['opt2']) ."</td></tr>";
	echo "<tr><td colspan='2'><b> C: </b>". html_entity_decode($question['opt3'])  ."</td></tr>";
	echo "<tr><td colspan='2'><b> D: </b>". html_entity_decode($question['opt4'])  ."</td></tr>";
		echo "<tr><td colspan='2'><span style='color:red'> Answer: ". html_entity_decode(get_data('qbank',$q,'answer')['data'])  ."</span> </td></tr>";
	echo "<tr><td colspan='2'> <hr> </td></tr>";
	
	$i++;
}