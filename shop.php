<?php require_once('temp/sidebar.php');
$center_code =  $_SESSION['user_name'];
// $center_code=$_GET['center_code'];
$center_id = centerid($center_code);
$inv_id = invopen($center_code)['id'];
$txn_date = get_data('invoice',$inv_id,'txn_date')['data'];

if(isset($_SESSION['inv_no']))
{
    $inv_no =$_SESSION['inv_no'];
    $txn_date =$_SESSION['txn_date'];
}
else{
    $inv_no='';
    $txn_date = date('Y-m-d');
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
                                    <h4 class="mb-sm-0 font-size-18">Transaction Entry</h4>
                                    <div class="page-title-right">
                              
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
            
    <div class="card mb-4">
        <div class="card-body">
              <div class="row">
                   <form  action ='shop_entry' enctype='multipart/form-data' id='item_frm'> 
                          <div class="row">
                                
                                <div class="col-lg-4 col-sm-12 mb-3">
                                                  
                                        <div class="form-group">
                                            <label> Center Name </label>
                                            <input type='hidden'  name='inv_id' value='<?php echo $inv_id; ?>' >
                                            <input type='hidden'  value='<?php echo $center_code; ?>' name='center_code' >
                                            <input class="form-control" required type='text'
                                            value='<?php echo centerid($center_code,'center_name');?>' readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                
                                        <div class="form-group">
                                            <label>Invoice No.</label>
                                           <input class="form-control"  name='invoice_no' value='<?php echo invno_gen($inv_id) ?>'   id='inv_no' readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                
                                        <div class="form-group">
                                            <label>Date of Order </label>
                                            <input class="form-control" type='date' name='order_date' value='<?php echo $txn_date; ?>' readonly>
                                        </div>  
                                    </div>
                                <hr>
                                
                                <div class="col-lg-3 col-sm-6">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                           <select class="form-select"  name='txn_remarks' id='txn_desc'   onchange='bal()' required>
                                            <option value="">Select Product</option>
                                               <?php dropdown_two_value('product','prd_name','prd_name',null,'prd_price'); ?>
                                           </select>
                                        </div>  
                                </div>
                            
                                <div class="col-lg-3 col-sm-6">
                                                                
                                        <div class="form-group">
                                            <label>Quantity  </label>
                                            <input class="form-control" type='number'  name='quantity' id='qty' onKeyup='bal()' required>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                        
                                        <div class="form-group">
                                            <label>Rate  </label>
                                            <input class="form-control" type='number' name='rate' id='rate'  onKeyup='bal()' readonly="">
                                        </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                
                                    
                                        <div class="form-group">
                                         <label> Amount </label>
                                            <input class="form-control"  name='amount' id ='amount' readonly >
                                           
                                        </div>
                                </div>
                            
                             </div>
                                        
                                
                                
                    
                                     
                             </form>
                                <div class="col-lg-12 col-sm-6">
                                        <div class="form-group"  style='float:right'>
                                        
                                        <label> &nbsp; </label><br>
                                        
                                        <input type="button" class="btn btn-success btn-block" value='Add Items' id='add_item_btn'>
                                        </div>
                                </div>  
                            </div>
                        <hr>
                            <table id="item_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                           
                                            <th>Decription  </th>
                                            <th>Quantity</th>
                                            <th>Rate </th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql ="select * from txn where inv_id='$inv_id' order by id desc "; 
                                        $t =0;
                                        $i=1;
                                        
                                        $res = direct_sql($sql);
                                        if($res['data'] != ''){
                                        foreach($res['data'] as $row)
                                        {
                                        $txn_id =$row['id'];
                                        $t =$t +$row['amount']; 
                                        echo"<tr class='odd gradeX'>";
                                        //echo"<td>". $i."</td>";
                                        echo"<td>".$row['txn_remarks']."</td>";
                                        echo"<td class='qty' >".$row['quantity']."</td>";
                                        echo"<td>".$row['rate']."</td>";
                                        echo"<td align='right' class='amt'>".$row['amount']."</td>";
                                        // echo 
                                        echo"<td align='right'>".btn_delete('txn',$txn_id,null,'fa fa-trash','yes')."</td>";
                                        echo "</tr>";
                                        $i++;
                                        } }
                                       ?>
                                     </tr> 
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <td colspan='3'> Total </td>
                                        <td align='right' id='qsum'><b>  </b> </td>
                                        <td align='right' id='asum'><b> <?php echo $t; ?>  </b> </td>
                                        
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    <div class="card-body">      
                        <div class='row'>
                            <div class="col-lg-3 col-sm-6"> 
                            <form action='shop_invoice' method='post'  id='update_frm'>
                            <div class="form-group">
                             <?php 
                               $dues_amt = get_data('center_details',$center_code,'center_balance','center_code')['data'];
                               $t_amt = $dues_amt + $t;
                             ?>
                                            <label>Prev. Dues </label>
                                            <input class="form-control"  name='prev_dues'  id ='prev' value='<?php echo $dues_amt ?>' readonly >
                                            
                                        </div>
                            </div>
                            <!-- <div class="col-lg-2 col-sm-6"> -->
                                        <!-- <div class="form-group"> -->
                                            <!-- <label> Amount Paid </label> -->
                                            <input type='hidden' name='inv_id' value='<?php echo $inv_id; ?>' >
                                            <input type='hidden' name='total' id='total' value='<?php echo $t; ?>' >
                                            <input type='hidden' name='invoice_no' value='<?php echo $inv_no; ?>' id='dinv_no' >
                                            <input type='hidden'  value='<?php echo $center_code; ?>' name='center_code' >
                                            <input type="hidden"  name='txn_date' required value='<?php echo date('Y-m-d',strtotime($txn_date)); ?>'>
                                        
                                            <input type="hidden" class="form-control"  name='payment' id ='payment'onKeyup='diff()' value='0.00'>
                                        <!-- </div> -->
                            <!-- </div>           -->
                            <div class="col-lg-3 col-sm-6">
                            
                                        <div class="form-group">
                                            <label>Net Payable Amount </label>
                                            <input class="form-control"  name='dues'  id ='dues' value="<?php echo $t_amt ?>" readonly required>
                                            
                                        </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                
                                    
                                        <div class="form-group">
                                         <label> Remarks </label>
                                            <input class="form-control"  name='txn_remarks'  >
                                           
                                        </div>
                                </div>
                            </form>
                            <div class="col-lg-2 col-sm-6">
                                    <div class="form-group mt-2">
                                        <br>
                                        <input type="button" class="btn btn-danger btn-block" value='Order Now' id='update_btn'>
                                    </div> 
                            </div>
                            
                                
        </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script>
    $('select').change(function(){
    var price = $(this).find(':selected').attr('data-price');
    $('#rate').val(price);
});
</script>
<script>

$("#inv_no").keyup(function(){
    $("#dinv_no").val($(this).val());
})
function updateinvoice()
{
    var qsum = 0;
    $(".qty").each(function(){
        qsum += +$(this).val();
    });
    $("#qsum").val(qsum);
    
    var asum = 0;
    $(".amt").each(function(){
        asum += +$(this).val();
    });
    $("#asum").val(asum);
}    
    
    function bal()
    {
    // alert("hello");  
    var d  = document.getElementById("qty").value;
    var m = document.getElementById("rate").value;
    var b =parseFloat(m) * parseFloat(d);
    document.getElementById("amount").value = parseFloat(b).toFixed(2);

    }

    function diff()
    {
     //alert("hello");  
    var prev  = document.getElementById("prev").value;
    var a  = document.getElementById("total").value;
    //var f  = document.getElementById("fare").value;
    var p= document.getElementById("payment").value;
    var d =(parseFloat(prev) + parseFloat(a)) - parseFloat(p);
    document.getElementById("dues").value = parseFloat(d).toFixed(2);
    }

</script>
