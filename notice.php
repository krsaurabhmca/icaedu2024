<?php require_once('temp/sidebar.php'); 
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
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
                                    <h4 class="mb-sm-0 font-size-18">Manage Center Details</h4>
                                    <div class="page-title-right">
		                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
	<div class="card ">
        <div class="card-body">
			     <div class="row">
                <div class="col-md-4" >
                    <!-- Form Elements -->
                        <form action ='add_notice' id='insert_frm' enctype='multipart/form-data'>
                        <div class="form-group">
                            <label>Notice Date</label>
                            <input class="form-control" value='<?php echo date('Y-m-d');?>' name='notice_date' type='date'>
                        </div>
                        <div class="form-group">
                            <label>Notice Title</label>
                            
                            <input class="form-control" value='' name='notice_title'  required  >
                        </div>
                        
                        <div class="form-group">
                            <label>Details of Notice</label>
                            
                            <textarea name='notice_details' id='summernote' required></textarea>
                        </div>
                        
                        <?php if($user_type == 'ADMIN'){ ?>
                        <div class="form-group">
                                            <label>Notice Status</label>
                                            <select class="form-control" name='status' required>
                                                <option value='SHOW'>SHOW</option>
                                                <option value='HIDE'>HIDE</option>
                                                <option value='CLIENT'>CLIENT</option>
                                            </select>
                                      </div>
                       
                        <div class="checkbox">
                            <label>
                            <input type="checkbox" value="yes" name='checksms'> Send Email to All Clients
                            </label>
                            <input class="form-control" type='hidden' name='notice_attachment' id='targetimg'>
                        </div>
                        
                    </form> 
                        <form id='uploadForm' enctype= 'multipart/form-data'>
                            <div class="form-group mb-3">
                                <label>Notice Attachment </label>
                                <input type='file' name='uploadimg' id='uploadimg' accept='image' class='form-control'>
                            </div>
                            <div id='display'></div>
                        </form>
                      <?php }else{ ?>
                          <input type="hidden" value="client_web" name='status'>
                     <?php } ?>
                    </div>  
                     
                
                <div class="col-lg-8">
                                
                                <!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                            <th>Notice Date</th>
                                            <th>Notice Title</th>
                                         <!--   <th>Notice Details</th>-->
                                            <th>Attachment </th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                    $res = get_all('notice' ,'*', array('created_by'=>$user_id));
                                    if($user_type=='ADMIN')
                                    {
                                       $res = get_all('notice'); 
                                    }
                                    foreach($res['data'] as $row)
                                    {
                                            echo "<tr>";
                                            $notice_id=$row['id'];
                                            echo "<td> ". date('d M',strtotime($row['notice_date'])) ."</td>";
                                            echo "<td> ". $row['notice_title'] ."</td>";
                                            //echo "<td>". $row['notice_details'] ."</td>";
                                            if ($row['notice_attachment'] =="")
                                            {
                                            echo "<td> NO ATTACHMENT </td>";
                                            }
                                            else {
                                            echo "<td> <a href='temp/upload/". $row['notice_attachment'] ."' target='new'> Download </a></td>";
                                            }
                                            echo "<td> ". $row['status'] ."</td>";
                                    ?>
                                            <td align='right'>
                                            <?php echo btn_view('notice',$notice_id,$row['notice_title']); ?>
                                            <?php echo btn_delete('notice',$notice_id,'','fa fa-trash','yes'); ?>
                                            </td>
                                            </tr>
                                    <?php
                                    }
                                    ?>
                                       
                                    </tbody>
                                </table>
                      </div>
                  </div>
                <div class="bg-white">
                    <button class="btn btn-danger" id='insert_btn'>Publish Notice</button>
                </div>
                </div>
            </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

    <script>
      $('#summernote').summernote({
        placeholder: 'Type your text here',
        tabsize: 2,
        height:100
      });
    </script>