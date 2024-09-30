<?php require_once('temp/sidebar.php'); 
?>
<link rel="stylesheet" href="./assets/css/yt.css">
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
                                    <form method="get">
		                             <select name='topic' onChange='submit()' class='h6'>
                                        <option value=''> Select A Topic </option>
                                        <?php dropdown($topic_list,$topic); ?>
                                    </select>   
                                    </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			     <div class="row">
                <div class="col-lg-4">
                 
                        <form action ='add_video' method ='post' id='insert_frm' enctype='multipart/form-data'>
                
                        <div class="form-group mb-3">
                            <label>Video Type</label>
                            <select class="form-control" name='video_type' required>
                                <option value='PROMO'>Promo</option>
                                <option value='EVENT'>EVENT</option>
                                <option value='CLASSES'>CLASSES</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Video Title</label>
                            
                            <input class="form-control" value='' name='video_title'  required  >
                        </div>
                        
                        <div class="form-group mb-3">
                            <label>Youtube Url </label>
                            <input class="form-control" name='video_url' type='url' required>
                        </div>
                        
                        <div class="form-group mb-3">
                                            <label>Video Status</label>
                                            <select class="form-control" name='video_status' required>
                                                <option value='SHOW'>SHOW</option>
                                                <option value='HIDE'>HIDE</option>
                                            </select>
                        </div>
                        <form>
                        <input type="submit" class="btn btn-danger" value='Publish Video' id='insert_btn'>
                </div>
                <div class="col-lg-8">
                                
                   <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                   
                                    <thead >
                                        <tr>
                                            
                                            <th>Video Date</th>
                                            <th>Video Type</th>
                                            <th>Video Title</th>
                                         <!--   <th>event Details</th>-->
                                            <th>Video Preview </th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql ="select * from video order by id desc";
                                    $res = direct_sql($sql);
                                    foreach($res['data'] as $row)
                                    {
                                    echo "<tr>";
                                        $vid=$row['id'];
                                        echo "<td> ". date('d M',strtotime($row['video_date'])) ."</td>";
                                        echo "<td> ". $row['video_type'] ."</td>";
                                        echo "<td> ". $row['video_title'] ."</td>";
                                    ?>
                                    <td align='center'>
                                        <div class="youtube-link" //youtubeid="<?php echo getvid($row['video_url']); ?>"><i class='fa fa-play fa-2x'></i> </div>
                                    </td>
                                    <?php
                                        echo "<td> ". $row['video_status'] ."</td>";
                                    ?>
                                            
                                            <td>
                                            <?php echo btn_delete('video', $vid) ?>
                                            </td>
                                            </tr>
                                    <?php
                                    }
                                    ?>
                                       
                                    </tbody>
                                </table>
                        </div>
                   </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script src="./assets/js/yt.js"></script>
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
