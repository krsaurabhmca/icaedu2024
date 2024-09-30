<?php 
include('temp/function.php'); 
$chapter_id =$_GET['chapter_id'];
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
        <div class="content p-1">
				
				<div class="card">
				  	<div class="card-body">
						  <?php echo base64_decode(get_data('chapter',$chapter_id,'chapter_details')['data']); ?>
						</div>
				</div>
		</div>
