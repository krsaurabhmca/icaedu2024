<?php require_once('temp/sidebar.php'); 
if(isset($_REQUEST['state_code']))
{
	$st_code =$_REQUEST['state_code'];
	$dt_code =$_REQUEST['dist_code'];
}
else{
	$dt_code =$st_code =null;
}
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
                                    <h4 class="mb-sm-0 font-size-18">Manage Center Details</h4>
                                    <div class="page-title-right">
		                             <form action="" method="get">
		                             	<select name='state_code' onChange='getdistrict(this.value)' class='h6'>
					                     <option value=''> Select State</option>
					                     <?php dropdown_list('state','id','state_name',$st_code); ?>
										</select>
										<select name='dist_code' onChange='submit()' id='district-list' class='h6'>
										<option value=''> Select District </option>
											<?php dropdown_list('district','id','dist_name',$dt_code); ?>
										</select>
		                             </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			     <div class="table-responsive">
                             <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Center Code<?php echo $dt_code ?></th>
                                            <th>Center Name</th>
                                            <th> Director</th>
                                            <th> Mobile No. </th>
                                            <!--<th> Wallet </th>-->
                                            <!--<th> Status </th>-->
                                            <th>Operation.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										if ($dt_code ==null)
										{
											$sql ="select * from center_details where status not in ('AUTO','DELETED') order by center_name ";
										}
										else{
											$sql ="select * from center_details where state_code ='$st_code' and dist_code ='$dt_code' and status not in ('AUTO','DELETED') order by center_name ";
										}
										
										$res = direct_sql($sql);
										
										foreach($res['data'] as $row)
										{
										$center_id =$row['id'];
										$ed_link = encode('center_id='.$center_id);
										$center_code = trim($row['center_code']);
										//$status = userinfo(userid($row['center_code']),'user_status');
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
										if($row['ref_id'] == '')
										{
											$ref_by =null;
											echo"<td class='text-success' >".$center_code."</td>";
										}
										else{
											$ref_by = get_data('center_details',$row['ref_id'],'center_name' ,'id')['data'];
											echo"<td title='".$ref_by."' >".$center_code."</td>";
										}
										
										echo"<td>".$row['center_name'].", ".get_data('district',$row['dist_code'],'dist_name' ,'id')['data']. " <a href='ref_center?ref_id=$center_id' class='badge badge-success'>". refcount($center_id)."</a></td>";
										echo"<td>".$row['center_director']."</td>";
                                        // echo"<td>".$row['center_mobile']."</td>";
                                        // echo"<td>".$row['center_wallet']."</td>";
                                        echo"<td>".$row['status']."</td>";
										
                                        echo"<td align='right'>";
                                        	echo "<a href='pdf_cntr_certificate.php?link=".$ed_link."' target='_blank' title='Print Center Certificate ' >
										    <button type='submit' class='btn btn-warning btn-sm' name='certificate'><i class='fa fa-file-pdf'></i> </button>
										</a>";
										?>
										<?php echo btn_edit('add_center',$center_id); ?>
										</td>
										<?php
									    echo "</tr>";
										}
                                      ?>
                                     </tr> 
                                    </tbody>
                                </table>
                            </div>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>

<?php require_once('temp/footer.php'); ?>
	