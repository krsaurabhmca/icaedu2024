<?php 
include('student_temp/function.php'); 
$data= decode($_GET['link']);
$docs_id =$data['docs_id'];
// print_r($data);
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
						<?php echo docsinfo($docs_id,'docs_details'); ?>
						</div>
						</div>
				


        </div>
