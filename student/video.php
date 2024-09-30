<?php require_once('student_temp/sidebar.php'); 
$syllabus= courseinfo($_SESSION['user_id'],'course_syllabus');
$new_topic_list = explode(',',$syllabus);
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
                                    <h4 class="mb-sm-0 font-size-18">Add Video for Gallery</h4>
                                    <div class="page-title-right">
		                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			   <div class="row">
                
				<div class="col-lg-12">
								
					<table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                   
                                    <thead >
                                        <tr>
                                            
                                            <th>Video Date</th>
                                            <th>Video Type</th>
                                            <th>Video Details </th>
                                            <th>Video Preview </th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$query ="select * from video order by id desc";
									$res = direct_sql($query);
									foreach($res['data'] as $row)
									{
									   // print_r($row['video_url']);
									echo "<tr>";
										$vid=$row['id'];
										echo "<td> ". date('d M',strtotime($row['video_date'])) ."</td>";
										echo "<td> ". $row['video_type'] ."</td>";
									    echo "<td> ". $row['video_title'] ."</td>";
									?>
									<td align='center'>
										<div class="youtube-link" youtubeid="<?php echo getvid($row['video_url']); ?>"><i class="bx bx-video-recording font-size-24"></i> </div>
									</td>
									
									<?php
									}
									?>
                                       
                                    </tbody>
                                </table>
						</div>
                   </div>
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