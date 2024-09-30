<?php require_once('student_temp/sidebar.php'); 
$syllabus= courseinfo($_SESSION['user_id'],'course_syllabus');
$new_topic_list = explode(',',$syllabus);
// $new_list = array();


if(isset($_REQUEST['topic']))
{
	$topic =$_REQUEST['topic'];
}
else{
	$topic=null;
}
?>
<link rel="stylesheet" href="assets/css/yt.css">
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                     <!-- <div class="content p-4"> -->
                     	 <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">View Topics</h4>
                                    <div class="page-title-right">
		                             <form action ='' method='get'>
		                            <select name='topic' onChange='submit()' class='h6'>
									<option value=''> Select A Topic </option>
									<?php foreach($new_topic_list as $list){
									    if($list !=''){
                                    $new_list = get_data('subject',$list)['data']['sub_name'];
                                    $new_id = get_data('subject',$list)['data']['id'];
									?>
									<option value='<?php echo $new_id; ?>' <?php if($new_id ==$topic) echo "selected"; ?>><?php echo $new_list; ?></option>
								<?php } } ?>
									</select>	
									</form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			    <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                            <!--<th>Upload Date</th>-->
                                            <th>Topic Title</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									if($topic<>null)
									{
									 $query ="select * from docs where topic_name ='$topic' order by id";
								// 	 echo "<pre>";
									$res = direct_sql($query);
								// 	print_r($res);
									foreach($res['data'] as $row)
									{
										$str =$row['docs_details'];
										$title =$row['docs_title'];
											echo "<tr>";
											$docs_id=$row['id'];
											$link =encode('docs_id='.$docs_id);
								// 			echo "<td> ". date('d-M-Y',strtotime($row['docs_date'])) ."</td>";
											echo "<td> ". $title ."</td>";
											?>
										<td align='left'>
											<a href="quick_view.php?link=<?php echo $link; ?>" class='ls-modal btn btn-success btn-sm' data-title='<?php echo $title; ?>' > Read Now </a>
										<!-- <span class="youtube-link btn btn-info btn-sm" youtubeid="<?php //echo getvid($row['doc_url']); ?>"><i class="bx bx-video-recording"></i> </span> -->
									<?php
									}
									}
									?>
                                       
                                    </tbody>
                                </table>
              </div>
            </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('student_temp/footer.php'); ?>
<script src="assets/js/yt.js"></script>
 <!-- Initialize GRT Youtube Popup plugin -->
 <script>
			// Demo video 1
			$(".youtube-link").grtyoutube({
				autoPlay:true,
				theme: "dark"
			});

			// Demo video 2
			$(".youtube-link-dark").grtyoutube({
				autoPlay:false,
				theme: "light"
			});
</script>
  <script>
   
        $('.ls-modal').on('click', function(e){
		  e.preventDefault();
		  $('#appmodal').modal('show').find('.modal-title').html($(this).attr('data-title'));
		  $('#appmodal').modal('show').find('.modal-body').load($(this).attr('href'));
		});
	</script>
   
   <!-- Modal -->
<div class="modal fade"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id='appmodal'>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
     
    </div>
  </div>
</div>
   
  