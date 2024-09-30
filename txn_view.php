<?php require_once('temp/sidebar.php'); 
if(isset($_GET['center_code']))
{
$center_code =$_GET['center_code'];
}
else{
    $center_code=$user_name;
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
                                    <h4 class="mb-sm-0 font-size-18">View Transaction</h4>
                                    <div class="page-title-right">
		                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
	<div class="card ">
	<div class="card mb-4">
		<div class="card-header <?php echo $bgClr ?> font-weight-bold">
           Manage Transaction Details <button id='btnExport' onclick='fnExcelReport();' class='btn btn-info btn-sm' style="float:right" >Download Excel </button>
          
        </div>
        <div class="card-body">
			     <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Center Code</th>
                                            <th>Center Name</th>
                                            <th>Total  </th>
                                            <th>Payment </th>
                                            <th>Dues </th>
                                            <th>Operation.</th onchange="">
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql ="select center_code, sum(total) ,sum(payment),sum(dues) from invoice where status ='CLOSE' group by center_code"; 
                                        $t =0;
                                        $p =0;
                                        $d=0;
                                        
                                        $res = mysqli_query($con,$sql) or die ("Error in Txn Report ". mysql_error());
                                        
                                        while($row =mysqli_fetch_array($res))
                                        {
                                            $center_dues = get_data('center_details',$row['center_code'], 'center_balance','center_code')['data'];
                                            
                                        $t =$t +$row['sum(total)']; 
                                        $p =$p +$row['sum(payment)'];   
                                        $dues =$row['sum(total)']-$row['sum(payment)'];
                                        $d =$d +$dues;
                                        echo"<tr class='odd gradeX'>";
                                        $center =$row['center_code'];
                                        echo"<td>".$center."</td>";
                                        echo"<td><a href='user_txn.php?center_code=$center' title='Click to View Transactions'>".centerid($center,'center_name')."</a></td>";
                                        
                                        echo"<td>".$row['sum(total)']."</td>";
                                        echo"<td>".$row['sum(payment)']."</td>";
                                        echo"<td>".$center_dues."</td>";
                                        echo"<td width='55'>";
                                        echo "<a href='txn_entry.php?center_code=$center&action=txn' title='Click to Entry New Transactions ' >
                                        <button type='submit' class='btn btn-info btn-sm' name='Pay_fee'> Txn Entry</button></a>";  
                                        echo "</td></tr>";
                                        }
                                       ?>
                                     </tr> 
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <td colspan='2'> Total </td>
                                        <th> <?php echo $t; ?></th>
                                        <th> <?php echo $p; ?></th>
                                        <th> <?php echo $d; ?></th>
                                        <td> &nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>