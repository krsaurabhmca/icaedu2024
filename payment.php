<?php require_once('temp/sidebar.php'); 
$center_code=$_GET['center_code'];
$center_id =centerid($center_code);
if($_GET['type'] == 'pending'){
    $inv_id = invpending($center_code)['id'];
    $inv_no = invno_gen($inv_id);
    $rd = 'readonly';
}else{
    $rd = 'readonly';
    $inv_id = invopen($center_code)['id'];
    if(isset($_SESSION['inv_no']))
{
    $inv_no =$_SESSION['inv_no'];
    $txn_date =$_SESSION['txn_date'];
}
else{
    $inv_no='';
    $txn_date = date('Y-m-d');
}
}
// $txn_date =get_data('invoice',$inv_id,'txn_date')['data'];



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
                                    <h4 class="mb-sm-0 font-size-18">Make Payment</h4>
                                    <div class="page-title-right">
                              
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
            
    <div class="card mb-4">
        <div class="card-body">
             <div class="col-md-10 mb-5 text-center">
         
                    <img class='img-responsive payment-qr'src='assets/img/paytm.jpg' width='900' height='500'>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
