<?php 
include('temp/function.php');

$param = decode($_GET['link']);

$table = $param['table'];
$id = $param['id'];

$res = get_data($table, $id);
if($res['status']=='success')
{
    $data =$res['data'];
    unset($data['id']);
    unset($data['created_by']);
    unset($data['created_at']);
    unset($data['updated_at']);
    unset($data['updated_by']);
}

?>

<style>
body {
  -webkit-user-select: none;
     -moz-user-select: -moz-none;
      -ms-user-select: none;
          user-select: none;
}

@media print {
         body {display:none;}
      }
</style>
<script>
document.addEventListener('contextmenu', event => event.preventDefault());
</script>
    <div class="content">
			
			<div class="card">
				<div class="card-body">
				<?php 
				    $info ="<table rules='1' align='center' width='90%' cellpadding='3' rules='rows'>";
			    foreach ($data as $key => $value) 
			    {
			        if($key =='photo')
			        {
			            $display_key = addspace($key);
			            $display_val = "<img src='upload/".$value."' width='100px' class='img-thumbnail'>";
			        }
			        else if($key =='course_id')
			        {
			            $display_key ='Course Name';
			            $display_val = get_data('course_details',$value,'course_name')['data']; 
			        }
			        else if($key =='start_date' or $key =='end_date')
			        {
			            $display_key = addspace($key);
			            $display_val = date('d-M-Y h:i A', strtotime($value)); 
			        }
			         else if($key =='added_by')
			        {
			            $display_key ='Staff Name';
			            $display_val = get_data('user',$value,'full_name')['data'] ." [". get_data('user',$value,'user_name')['data'] ."]";
			        }
			        else{
			        $display_key = addspace($key);
			        $display_val = wordwrap($value,55,'<br>',true);
			        }
			        
			        $info = $info."<tr><td><b>".$display_key."</b></td><td>".$display_val ."</td></tr>";
			    }
			    $info =$info."</table>";
			    
			    echo $info;
			    ?>
				</div>
			</div>

    </div>
