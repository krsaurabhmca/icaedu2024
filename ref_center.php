<?php require_once('temp/sidebar.php'); ?>
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
                                    <h4 class="mb-sm-0 font-size-18">Referral Centers</h4>
                                    <div class="page-title-right">
		                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
		<div class="card-header bg-white font-weight-bold">
		   
        </div>
        <div class="card-body">
			        <div class="table-responsive">
                              <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Center Name</th>
                                            <th>Ref By</th>
                                            <th> Director</th>
                                            <th> Mobile No. </th>
                                            <th> Wallet </th>
                                            <th> Status </th>
                                            <?php if( $user_type =='ADMIN' ) { ?>
                                            <th>Operation.</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if ($user_type=='CLIENT' )
                                        {
                                            $center_id = centerid($user_name);
                                            $sql ="select * from center_details where ref_id ='$center_id' order by center_name";
                                        }
                                        else if(isset($_REQUEST['ref_id']))
                                        {
                                            $ref_id = $_REQUEST['ref_id'];
                                            $sql ="select * from center_details where ref_id ='$ref_id' order by center_name";
                                        }
                                        else{
                                            $sql ="select * from center_details where ref_id <>'' order by center_name";
                                        }
                                        $res = direct_sql($sql);
                                        
                                        foreach($res['data']  as $row)
                                        {
                                        $center_id = $row['id'];
                                        $center_code = trim($row['center_code']);
                                        $user_data = get_all('user','*',array('user_name'=>$center_code))['data'];
                                        $row = get_all('center_details','*',array('center_code'=>$center_code))['data'][0];
                                        
                                        $user_id =$user_data[0]['id'];
                                        $status =$user_data[0]['status'];
                                        if ($status =="BLOCK")
                                        {
                                        echo"<tr class='odd gradeX' style='background:gold'>";
                                        }
                                        else{
                                        echo"<tr class='odd gradeX'>";
                                        }
                                        $ref_by = get_data('center_details',$row['ref_id'],'center_name' ,'id')['data']. " [".
                                        get_data('center_details',$row['ref_id'],'center_code' ,'id')['data'] ."]";
                                        
                                        echo"<td>".$row['center_name']. "[".$row['center_code']."]</td>";
                                        echo"<td>".$ref_by."</td>";
                                        echo"<td>".$row['center_director']."</td>";
                                        echo"<td>".$row['center_mobile']."</td>";
                                        echo"<td>".$row['center_wallet']."</td>";
                                        echo"<td>".$row['status']."</td>";
                                        if( $user_type =='ADMIN' ) {
                                        echo"<td align='right'>";
                                        
                                        ?>
                                        <button class='ls-modal btn btn-success btn-sm' data-center='<?php echo $center_id; ?>' data-code='<?php echo $center_code; ?>' >₹</button>
                                        <?php echo btn_edit('add_center',$center_id); ?>
                                        <!--<a href='edit_center.php?center_id=<?php echo $center_id; ?>&action=edit'>-->
                                        <!--    <button class='btn btn-info btn-xs'> <i class='fa fa-edit'></i></button></a>-->
                                        <?php echo btn_delete('center_details',$center_id); ?>
                                        <!--<span data-table='center_details' data-id='<?php echo $center_id; ?>' data-pkey='center_id' class='delete_btn' title='Permanetly Remove This Center'> <i class='fa fa-trash'></i> </span>-->
                                        
                                        <!--<span data-table='center_details' data-id='<?php echo $center_id; ?>' data-pkey='center_id' class='block_btn' title='Block This Center'> <i class='fa fa-ban'></i> </span>-->
                                        
                                        
                                        </td>
                                        <?php
                                        }
                                        echo "</tr>";
                                        }
                                      ?>
                                     </tr> 
                                    </tbody>
                                </table>
                                <?php 
                                    if(isset($_GET['action']) and $_GET['action'] =='delete')
                                    {
                                        $center_id =$_GET['center_id'];
                                        $sql ="delete from center_details where center_id =$center_id";
                                        mysqli_query($con,$sql) or die("Error in Center Delete " .mysqli_error($con));
                                    Echo "<script>window.location='manage_center.php'</script>"; 
                                    } 
                                    
                                    if(isset($_GET['action']) and $_GET['action'] =='block')
                                    {
                                        $center_code =$_GET['center_code'];
                                        $sql2 ="update user set user_status ='BLOCK' where user_name ='$center_code'";
                                        
                                        //UPDATE `user` SET `user_status` = 'ACTIVE' WHERE `user`.`user_id` = 16;
                                        mysqli_query($con,$sql2) or die("Error in Center Blocking " .mysqli_error($con));
                                    
                                    } 
                                ?>
                            </div>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id='appmodal'>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"> Recharge </h5>
                    <button type="button" class="bootbox-close-button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action ='add_to_wallet' method ='post' id='wallet_frm'    enctype='multipart/form-data'>
                        <div class="form-group  mb-3">
                            <label> Centre Code </label>
                            <input  name='center_id' id='center_id' type='hidden' required>
                            <input class="form-control" id ='center_code' maxlength='8' readonly required>
                        </div>
                        <div class="form-group  mb-3">
                            <label>Txn Date</label>
                            <input class="form-control"  type='date' value ='<?php echo date('Y-m-d'); ?>' name='txn_date' required>
                        </div>  
                        <div class="form-group  mb-3">
                            <label>Txn Amount</label>
                            <input class="form-control"  type='number' value ='' name='credit_amt' required autofocus>
                        </div>
                                                                
                        <div class="form-group mb-3">
                            <label>Remarks </label>
                            <input class="form-control" placeholder="Details of Transaction" name='txn_remarks' required>
                        </div>
                    </form>
                    
                    <button class="btn btn-success" id='add_wallet'> Update Transaction Details </button>
                
                </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script>
        $('.ls-modal').on('click', function(e){
          e.preventDefault();
          $('#appmodal').modal('show');
          
          $("#center_id").val($(this).attr("data-center"));
          $("#center_code").val($(this).attr("data-code"));
        });
    </script>   