<?php require_once('temp/sidebar.php'); 
$sub_name ='';
if(isset($_REQUEST['subject_id']))
{
    $filter['subject_id'] = $subject_id = $_REQUEST['subject_id'];
    $sub_name = "of ". get_data('subject',$subject_id,'sub_name')['data'];
}

$res = get_all('chapter','*',$filter);
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
                                    <h4 class="mb-sm-0 font-size-18">View Chapters
                                    <?= $sub_name; ?> 
                                    </h4>
                                    <div class="page-title-right">
                                    <form method="get">
		                             <select name='topic' onChange='submit()' class='h6 select2'>
                                        <option value=''> Select A Subject </option>
                                        <?php dropdown_list('subject','id','sub_name',$subject_id); ?>
                                    </select>   
                                    </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			     <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th>Order</th>
                                            <?php if ($sub_name==''){?>
                                            <th>Subject</th>
                                            <?php } ?>
                                            <th>Chapter</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                    if($res['count'] > 0){
                                    foreach($res['data'] as $row)
                                    {
                                        $chapter_id =$row['id'];
                                        $details =$row['chapter_details'];
                                        $title =$row['chapter_name'];
                                        $subject =get_data('subject',$row['subject_id'],'sub_name')['data'];
                                         $docs_id=$row['id'];
                                            echo "<tr>";
                                            echo "<td> ". $row['display_id'] ."</td>";
                                            if ($sub_name==''){
                                            echo "<td> ". $subject ."</td>";
                                            }
                                            echo "<td> ". $title ."</td>";
                                          //  echo "<td> ". $details ."</td>";
                                            ?>
                                            <td align='right'>
                                            <?php echo btn_edit('add_chapter',$chapter_id) ?>
                                            <a href="quick_view.php?chapter_id=<?php echo $chapter_id; ?>" class='ls-modal btn btn-success btn-sm' data-title='<?php echo $title; ?>' > Quick View </a>
                                            <!--<a href='topic_view.php?docs_id=<?php echo $chapter_id; ?>' class="btn btn-danger btn-xs " >Show</a>-->
                                            <?php echo btn_delete('chapter',$chapter_id) ?>
                                            </td>
                                            </tr>
                                    <?php
                                    } }
                                    ?>
                                       
                                    </tbody>
                                </table>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
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
        $(document).on('click','.ls-modal', function(e){
          e.preventDefault();
          $('#view_data').modal('show').find('.modal-title').html($(this).attr('data-title'));
          $('#view_data').modal('show').find('.modal-body').load($(this).attr('href'));
        });
    </script>
