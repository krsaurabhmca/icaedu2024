<?php require_once('temp/sidebar.php'); 
$data =decode($_GET['link']);
$center_code =$data['center_code'];
$center_id =centerid($center_code);
$txn_date =$data['txn_date'];
$inv_id =$data['inv_id'];
?>
<style type="text/css">
@media print
{
/*body * { visibility: hidden; }*/
/*#printarea * { visibility: visible; }*/
/*#printarea { position: absolute; top: 10px; left: 10px; width:100%;height:700px; }*/
#btn_hide * { visibility: hidden; }
tbody{min-height:650px;}
td{border:solid 1px #d4d4d4;}
}
</style>
<script type="text/javascript" src="js/towords.js"></script>
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
                                    <h4 class="mb-sm-0 font-size-18">Invoice Details </h4>
                                    <div class="page-title-right">
                                     
                                     
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                           <!-- Advanced Tables -->
  
    <div class="card ">
    
        <div class="card-body">
            <!--<table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">-->
              <table id ='printarea' class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <td colspan='2'> 
                                            <b> Company Details</b> <br>
                                            <?php echo $inst_name; ?> <br>
                                            <?php echo $inst_address1; ?> <br>
                                            <?php echo $inst_contact; ?> <br>
                                            <?php echo $inst_email; ?> <br>
                                            
                                            </td>
                                            
                                            <td colspan='3' > 
                                            <b> Center Details</b> <br>
                                            <?php echo centerid($center_code,'center_name'); ?> <br>
                                            <?php echo centerid($center_code,'center_address'); ?> <br>
                                        <?php echo centerid($center_code,'center_mobile'); ?> <br> 
                                        <?php echo centerid($center_code,'center_email'); ?> <br>
                                            </td>
                                        </tr>
                                        <tr bgcolor='#d5d5d5'>
                                              <td colspan='3'> Invoice No : 
                                              <?php echo invinfo($inv_id, 'invoice_no'); ?></td>
                                              <td colspan='2' align='right'> Date : <?php echo date('d-M-Y',strtotime($txn_date)); ?> </td>

                                        </tr>
                                        <tr>
                                            <th width='100px'>Sr. No.  </th>
                                            <th>Particulars  </th>
                                            <th>Rate </th>
                                            <th width='150px'>Quantity</th>
                                            <th>Amount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody valign='top'>
										<?php 
										$sql ="select * from txn  where inv_id ='$inv_id' "; //center_code='$center_code' and txn_date='$txn_date'"; 
										$t =0;
										$p =0;
										$d=0;
										$i=1;
										$res = direct_sql($sql);
										
										foreach($res['data'] as $row)
										{
										$t =$t +$row['amount'];	
										echo"<tr class='odd gradeX'>";
										echo"<td>".$i."</td>";
										echo"<td>".$row['txn_remarks']."</td>";
										echo"<td>".$row['rate']."</td>";
										echo"<td>".$row['quantity']."</td>";
										echo"<td>".$row['amount']."</td>";
										echo "</tr>";
										$i=$i+1;
										}
                                       ?>
                                     </tr> 
                                    </tbody>
									<tfoot class='text-right'>
										<tr>
									    <td colspan='3' rowspan='6'></td>
										<td align='left'> Total </td>
										<th> <?php echo $t; ?></th>
										
										</tr>
										<tr>
										
										<td  align='left'> Prev Dues </td>
										<th > <?php echo $prev = invinfo($inv_id,'prev_dues'); ?></th>
										</tr>
										<tr>
										    
										<tr>
										
										<td class='text-info'  align='left'><b>Net Payable Amt </b></td>
										<th class='text-info'> <?php echo $prev + $t; ?></th>
										</tr>
										
										<td  align='left' class='text-success'><b> Paid Amount </b> </td>
										<th class='text-success'> <?php echo $paid = invinfo($inv_id,'payment'); ?></th>
										</tr>
										<tr>
										
										<td class='text-danger'  align='left'><b>Current Dues </b></td>
										<th class='text-danger'> <?php echo $prev = invinfo($inv_id,'dues'); ?></th>
										</tr>
								
										
									    <tr><td colspan='5' style='text-transform:uppercase;'>
									   <center>	<script> var words =toWords(<?php echo $paid = invinfo($inv_id,'payment'); ?>); document.write("<div class='t'><b>In Words : </b>"+words+" rupees only </div>"); </script>
									   </center></td></tr>
									   </tfoot>
                                </table>
                        <div class="panel-footer" id ='btn_hide'>
                            <center> <button class='btn btn-success btn-sm'onClick='window.print()'>PRINT </button> </center>
                        </div>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->

<?php require_once('temp/footer.php'); ?>