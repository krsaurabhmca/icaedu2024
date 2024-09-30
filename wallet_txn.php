<?php require_once('temp/sidebar.php'); 
if(isset($_GET['frmDate'])){
    $frmDate = $_GET['frmDate'];
    $endDate = $_GET['endDate'];
}else{
    $frmDate ='';
    $endDate = '';
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
                                    <h4 class="mb-sm-0 font-size-18">Wallet Transaction</h4>
                                    <div class="page-title-right">
		                            <form method='get'>
		                               <div class='row'>
		                               <div class='col-6'>
		                               <input type='date' name='frmDate' value='<?php echo $frmDate ?>'></div>
		                                <div class='col-6'>
		                               <input type='date' name='endDate' min='<?php echo $frmDate ?>' oninput='submit()' value='<?php echo $endDate ?>'></div>
		                               </div>
		                            </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
		 <div class="card-header <?php echo $bgClr ?> font-weight-bold">
           Wallet Transaction Details  <button id='btnExport' onClick ='exportxls()' class='btn btn-info btn-sm' style="float:right" >Download Excel </button>
            
        </div>
        <div class="card-body">
                              <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Txn Id</th>
                                            <th>Txn Date</th>
                                            <th>Center Code</th>
                                            <th>Center Name</th>
                                            <th>Credit Amt  </th>
                                            <th>Debit Amt  </th>
                                            <th>Description  </th>
                                            <th>Balance </th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($user_type=='CLIENT')
                                        {
                                            $center_id =centerid($user_name);
                                            $sql ="select * from wallet where center_id ='$center_id' and  status ='SUCCESS' and  cast(created_at as date) BETWEEN '$frmDate' AND '$endDate'"; 
                                        }
                                        else{
                                           $sql ="select *  from wallet where status ='SUCCESS' and  cast(created_at as date) BETWEEN '$frmDate' AND '$endDate'"; 
                                        }
                                        
                                        $t =0;
                                        $p =0;
                                        $d=0;
                                        
                                        $res = direct_sql($sql);
                                        
                                        foreach($res['data'] as $row)
                                        {
                                        echo"<tr class='odd gradeX'>";
                                        echo"<td>".$row['id']."</td>";
                                        $center_id = $row['center_id'];
                                        echo"<td>".date('d-M-Y',strtotime($row['txn_date']))."</td>";
                                        echo"<td>".get_data('center_details',$center_id,'center_code','id')['data']."</td>";
                                        echo"<td>".get_data('center_details',$center_id,'center_name','id')['data']."</td>";
                                        echo"<td>".$row['credit_amt']."</td>";
                                        echo"<td>".$row['debit_amt']."</td>";
                                        echo"<td>".$row['txn_remarks']."</td>";
                                        echo"<td>".$row['balance']."</td>";
                                            
                                        echo "</tr>";
                                        }
                                       ?>
                                     </tr> 
                                    </tbody>
                                    
                                </table>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>