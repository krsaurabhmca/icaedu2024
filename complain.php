<?php require_once('temp/sidebar.php'); 
?>

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
                                    <h4 class="mb-sm-0 font-size-18">Complaint and Support</h4>
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
                        <form action ='add_complain' id='insert_frm' enctype='multipart/form-data'>
                            <input type="hidden" class="form-control" value='<?php echo $_SESSION['user_id']?>' name='center_id' type='date'>
                            <input type="hidden" class="form-control" value='<?php echo date('Y-m-d');?>' name='tckt_date' type='date'>
                       
                        
                        <div class="form-group mb-3">
                            <label>Title</label>
                            
                            <input class="form-control" value='' name='tckt_title'  required>
                        </div>   
                        <div class="form-group mb-3">
                            <label>Detail</label>
                            
                            <textarea class="form-control" value='' name='tckt_details'  required></textarea>
                        </div>    
                            <input class="form-control" type='hidden' name='image' id='targetimg'>
                        <!-- </div> -->
                        
                    </form> 
                        <form id='uploadForm' enctype= 'multipart/form-data'>
                            <div class="form-group mb-3">
                                <label>Attachment </label>
                                <input type='file' name='uploadimg' id='uploadimg' accept='image' class='form-control'>
                            </div>
                            <div id='display'></div>
                        </form>
                        <div class="bg-white">
                    <button class="btn btn-danger" id='insert_btn'>Send Complain</button>
                </div>
                    </div>  
                     
                
                <div class="col-lg-8">
                                
                                <!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                            <th>Complain Date</th>
                                            <th> Title</th>
                                            <th>Details</th>
                                            <th>Attachment </th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query ="select * from support_ticket WHERE status='PENDING' order by id desc";
                                    $res = direct_sql($query);
                                    if($res['data']){
                                    foreach($res['data'] as $row)
                                    {
                                            echo "<tr>";
                                            $cmpl_id=$row['id'];
                                            echo "<td> ". date('d M',strtotime($row['tckt_date'])) ."</td>";
                                            echo "<td> ". $row['tckt_title'] ."</td>";
                                            echo "<td>". $row['tckt_details'] ."</td>";
                                            if ($row['image'] =="")
                                            {
                                            echo "<td> NO ATTACHMENT </td>";
                                            }
                                            else {
                                            echo "<td> <a href='temp/upload/". $row['image'] ."' target='new'> Download </a></td>";
                                            }
                                        
                                    ?>
                                            <td align='right'>
                                            <?php echo btn_delete('support_ticket',$cmpl_id,'','fa fa-trash','yes'); ?>
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
            </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>