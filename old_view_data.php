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
    <div class="content p-4">
			
			<div class="card mb-4">
				<div class="card-body">
				<?php 
				    $info ="<table rules='1' align='center' width='85%' cellpadding='3' rules='rows'>";
			    foreach ($data as $key => $value) 
			    {
			        $info = $info."<tr><td><b>".addspace($key)."</b></td><td>".wordwrap($value,55,'<br>',true) ."</td></tr>";
			    }
			    $info =$info."</table>";
			    
			    echo $info;
			    ?>
				</div>
			</div>

    </div>
