<?php require_once('temp/sidebar.php');
if(isset($_GET['txn_type']))
{
$txn_type =$_GET['txn_type'];
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
                                    <h4 class="mb-sm-0 font-size-18">Manage Income /Expense</h4>
                                    <div class="page-title-right">
                                      <form>
                                        <select name='txn_type' onChange='submit()' class='h6 select2'>
                                            <?php dropdown($txn_type_list, $txn_type); ?>
                                        </select>
                                      </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
    <div class="card mb-4">
     <div class='card-header'>
                Transaction History
                <span style='float:right'>
                
                <button class='ls-modal btn btn-success btn-sm' data-user='<?php echo $user_id; ?>' data-txn='INCOME' >+ <i class='fa fa-inr'></i> INCOME</button>
                <button class='ls-modal btn btn-danger btn-sm' data-user='<?php echo $user_id; ?>' data-txn='EXPENSE' >- <i class='fa fa-inr'></i> EXPENSE</button>
                <button class='btn btn-primary btn-sm' onClick ='exportxls()'> <i class='fa fa-file-excel'></i> Export </button>
                </span>                 
        </div>
        <div class="card-body">
                            <div class="table-responsive">
                             <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Txn Type</th>
                                            <th>Amount</th>
                                            <th>Mode </th>
                                            <th>Remarks </th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        if(isset($_GET['txn_type']) and $txn_type <> '')
                                        {
                                        
                                         $sql ="select * from account where created_by ='$user_id' and txn_type ='$txn_type' order by txn_date desc ";
                                        }
                                        else{
                                        $sql ="select * from account where created_by ='$user_id' order by txn_date, id ";
                                        }
                                        $res = direct_sql($sql);
                                        $inc_total = 0;
                                        $exp_total = 0;
                                        if($res['count']>0){
                                        foreach($res['data'] as $row)
                                        {
                                        $id =$row['id'];
                                        if ($row['txn_type'] =="INCOME")
                                        {
                                        echo"<tr class='odd gradeX' style='background:lightgreen'>";
                                        $inc_total = $inc_total + $row['txn_amount'];
                                        }
                                        else{
                                        echo"<tr class='odd gradeX'>";
                                        $exp_total = $exp_total + $row['txn_amount'];
                                        }
                                        
                                        
                                        echo"<td>". date('d-M-Y', strtotime($row['txn_date']))."</td>";
                                        echo"<td>".$row['txn_type']."</td>";
                                        echo"<td>".$row['txn_amount']."</td>";
                                        echo"<td>".$row['txn_mode']."</td>";
                                        echo"<td>".$row['txn_remarks']."</td>";
                                        
                                        echo"<td align='right'>";
                                        ?>
                                        
                                        <?php echo btn_delete('account',$id); ?>
                                        
                                        <!--<span data-table='center_details' data-id='<?php echo $center_id; ?>' data-pkey='center_id' class='block_btn' title='Block This Center'> <i class='fa fa-ban'></i> </span>-->
                                        
                                        
                                        </td>
                                        <?php
                                        echo "</tr>";
                                        }
                                    }
                                      ?>
                                     </tr> 
                                    </tbody>
                                    <tfoot>
                                        <tr class='bg-dark text-light'>
                                            <td colspan='3' >Total</td>
                                             <td> INCOME :  <?php echo  $inc_total; ?></td>
                                             <td> EXPENSE :  <?php echo  $exp_total; ?></td>
                                             <td> BALANCE :  <?php echo  $inc_total - $exp_total; ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            
                            </div>
                            
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id='appmodal'>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">  </h5>
                    <button type="button" class="bootbox-close-button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action ='account_entry' method ='post' id='insert_frm'    enctype='multipart/form-data'>
                        <div class="form-group mb-3">
                            <label> Transaction Type</label>
                            <input  id='created_by' type='hidden' required>
                            <input class="form-control" id ='txn_type' name='txn_type' maxlength='8' readonly required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Txn Date</label>
                            <input class="form-control"  type='date' value ='<?php echo date('Y-m-d'); ?>' name='txn_date' required>
                        </div>  
                        <div class="form-group mb-3">
                            <label>Txn Amount</label>
                            <input class="form-control"  type='number' value ='' name='txn_amount' required autofocus>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label>Txn Mode</label>
                            <select name ='txn_mode' class='form-control'>
                            <?php dropdown($txn_mode_list); ?>
                            </select>
                        </div>
                                                                
                        <div class="form-group mb-3">
                            <label>Remarks </label>
                            <input class="form-control" placeholder="Details of Transaction" name='txn_remarks' required>
                        </div>
                    </form>
                    
                    <button class="btn btn-success" id='insert_btn'>Save Txn </button>
                
                </div>
            </div>
        </div>
    </div>

<?php require_once('temp/footer.php'); ?>
<script>
        $(document).on('click','.ls-modal',function(e){
          e.preventDefault();
          $('#appmodal').modal('show');
          var txn_type = $(this).attr("data-txn");
          $("#created_by").val($(this).attr("data-user"));
          $("#txn_type").val(txn_type);
          $("#exampleModalCenterTitle").html(txn_type + " ENTRY")
        });
    </script>   