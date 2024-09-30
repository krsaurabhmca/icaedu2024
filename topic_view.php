<?php require_once('temp/sidebar.php'); 
$docs_id =$_GET['docs_id'];
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
        <!--  page-wrapper -->
        <div class="content p-4">
        	
        <h2 class="mb-4">Add New Course</h2>

		<div class="card mb-4">
			<div class="card-header bg-white font-weight-bold">
				<?php echo get_data('docs',$docs_id,'docs_title','docs_id')['data']; ?>
				<div style='float:right'>
				<?php if( docsprev($course_id) <>"") { ?>
					
					<a href='topic_view.php?docs_id=<?php echo docsprev($docs_id); ?>' class='btn btn-danger btn-xs' > PREV </a>
					
				<?php } ?>


				<?php if( docsnext($docs_id) <>"") { ?>

					<a href='topic_view.php?docs_id=<?php echo docsnext($docs_id); ?>' class='btn btn-success btn-xs'>  NEXT </a>
				<?php } ?>
				</div>
            </div>
			<div class="card-body">
			<?php echo docsinfo($docs_id,'docs_details'); ?>
			</div>
			</div>
				


            </div>
        </div>
        <!-- end page-wrapper -->

            

        </div>
        <!-- end page-wrapper -->

   
  
</body>

</html>
