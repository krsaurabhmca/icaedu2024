<?php require_once('temp/sidebar.php');
$center_id = centerid($user_name);
?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Dashboard [<?php echo $_SESSION['user_name']; ?>]</h4>

                                    <div class="page-title-right">
                                       <a href='payment'><button class='btn btn-info btn-sm'> Recharge Now</button></a>
                                       <button class='btn btn-danger btn-sm'> ₹<?php echo $wallet; ?></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card overflow-hidden">
                                    <div class="bg-primary bg-soft">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="text-primary p-3">
                                                    <h5 class="text-primary">Welcome Back !</h5>
                                                    <p>What's New</p>
                                                </div>
                                            </div>
                                            <div class="col-5 align-self-end">
                                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12" style="height:420px">
                                               <?php $all_notice  = get_all('notice', '*' ,array('status'=>'CLIENT'))['data']; 
                                                    foreach($all_notice as $all)
                                                    {
                                                        echo "<u class='text-danger'>". $all['notice_title'] .'</u> <i>'.  html_entity_decode($all['notice_details']) .'</i> <hr>';
                                                    }
                                                ?>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Monthly Earning</h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="text-muted">This month</p>
                                                <h3>$34,252</h3>
                                                <p class="text-muted"><span class="text-success me-2"> 12% <i class="mdi mdi-arrow-up"></i> </span> From previous period</p>

                                                <div class="mt-4">
                                                    <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View More <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mt-4 mt-sm-0">
                                                    <div id="radialBar-chart" class="apex-charts"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-0">We craft digital, graphic and dimensional thinking.</p>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">STUDENT'S</p>
                                                        <h4 class="mb-0"><?php echo get_all('student','*',array('center_id'=>$center_id))['count'];?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="fa fa-users  font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">PENDING</p>
                                                        <h4 class="mb-0"><a href='manage_student?scan_by=PENDING'> <?php  echo get_all('student','*',array('status'=>'PENDING','center_id'=>$center_id))['count'];?></a></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center ">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-user-plus font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">VERIFIED</p>
                                                        <h4 class="mb-0"><a href='manage_student?scan_by=VERIFIED'> <?php  echo get_all('student','*',array('status'=>'VERIFIED','center_id'=>$center_id))['count'];?></a></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-user-check  font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">DISPATCHED</p>
                                                        <h4 class="mb-0"><a href='manage_student?scan_by=DISPATCHED'> <?php  echo get_all('student','*',array('status'=>'DISPATCHED','center_id'=>$center_id))['count'];?></a></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-export  font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex flex-wrap">
                                            <h4 class="card-title mb-4"> Institution Profile</h4>
                                        </div>
                                        
                                       <table class="table" width='100%'>
                                    
                                    <tr>
                                        <td width='160'> <label> Center Code </label> </td>
                                        <td> <?php echo centerid( $user_name,'center_code'); ?> </td>
                                        
                                        <td rowspan='5'  style='vertical-align:middle;text-align:center;' width='180'>
                                        <img src='temp/upload/<?php echo centerid( $user_name,'director_photo'); ?>' alt ='Image Not Available' width ='110' height='140' /> 
                                        </td>
                                    
                                    </tr>
                                
                                    <tr>
                                        <td> <label> Center Name </label> </td>
                                        <td> <?php echo centerid( $user_name,'center_name'); ?> </td>
                                    </tr>
                                    <tr>
                                        <td> <label> Director's Name  </label> </td>
                                        <td> <?php echo centerid( $user_name,'center_director'); ?> </td>
                                    </tr>
                                    <tr>
                                        <td> <label> Address </label> </td>
                                        <td> <?php echo centerid( $user_name,'center_address'); ?> ,<?php echo distinfo(centerid( $user_name,'dist_code'),'dist_name'); ?> </td>
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td> <label> Email ID </label> </td>
                                        <td> <?php echo centerid($user_name,'center_email'); ?> </td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        <td> <label> Mobile </label> </td>
                                        <td> <?php echo centerid( $user_name,'center_mobile'); ?> </td>
                                        <td ></td>
                                    </tr>
                                    <tr >
                                        <!--<td colspan='3'>-->
                                        <!--<img src='assets/img/ps_info.png' class='img-thumbnail'> -->
                                        <!--</td>-->
                                    </tr>
                                    
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
<!-- 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Latest Transaction</h4>
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 20px;">
                                                            <div class="form-check font-size-16 align-middle">
                                                                <input class="form-check-input" type="checkbox" id="transactionCheck01">
                                                                <label class="form-check-label" for="transactionCheck01"></label>
                                                            </div>
                                                        </th>
                                                        <th class="align-middle">Order ID</th>
                                                        <th class="align-middle">Billing Name</th>
                                                        <th class="align-middle">Date</th>
                                                        <th class="align-middle">Total</th>
                                                        <th class="align-middle">Payment Status</th>
                                                        <th class="align-middle">Payment Method</th>
                                                        <th class="align-middle">View Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input class="form-check-input" type="checkbox" id="transactionCheck02">
                                                                <label class="form-check-label" for="transactionCheck02"></label>
                                                            </div>
                                                        </td>
                                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2540</a> </td>
                                                        <td>Neal Matthews</td>
                                                        <td>
                                                            07 Oct, 2019
                                                        </td>
                                                        <td>
                                                            $400
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-pill badge-soft-success font-size-11">Paid</span>
                                                        </td>
                                                        <td>
                                                            <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                                        </td>
                                                        <td> -->
                                                            <!-- Button trigger modal -->
                                                            <!-- <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".transaction-detailModal">
                                                                View Details
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> -->
                                        <!-- end table-responsive -->
                                  <!--   </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Transaction Modal -->
                <div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="transaction-detailModalLabel">Order Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                                <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <img src="assets/images/product/img-7.png" alt="" class="avatar-sm">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                                        <p class="text-muted mb-0">$ 225 x 1</p>
                                                    </div>
                                                </td>
                                                <td>$ 255</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <img src="assets/images/product/img-4.png" alt="" class="avatar-sm">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">Phone patterned cases</h5>
                                                        <p class="text-muted mb-0">$ 145 x 1</p>
                                                    </div>
                                                </td>
                                                <td>$ 145</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h6 class="m-0 text-right">Sub Total:</h6>
                                                </td>
                                                <td>
                                                    $ 400
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h6 class="m-0 text-right">Shipping:</h6>
                                                </td>
                                                <td>
                                                    Free
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h6 class="m-0 text-right">Total:</h6>
                                                </td>
                                                <td>
                                                    $ 400
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal -->

                <!-- subscribeModal -->
               <!--  <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center mb-4">
                                    <div class="avatar-md mx-auto mb-4">
                                        <div class="avatar-title bg-light rounded-circle text-primary h1">
                                            <i class="mdi mdi-email-open"></i>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="col-xl-10">
                                            <h4 class="text-primary">Subscribe !</h4>
                                            <p class="text-muted font-size-14 mb-4">Subscribe our newletter and get notification to stay update.</p>

                                            <div class="input-group bg-light rounded">
                                                <input type="email" class="form-control bg-transparent border-0" placeholder="Enter Email address" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                
                                                <button class="btn btn-primary" type="button" id="button-addon2">
                                                    <i class="bx bxs-paper-plane"></i>
                                                </button>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- end modal -->
             <!-- Modal -->
<div class="modal fade" id="popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    
      <div class="modal-body">
         <button type="button" class="btn-dark float-end text-light mt-3" data-bs-dismiss="modal" aria-label="Close">X</button>
        <?php 
        $img = get_all('popup')['data'][0]['image_url'];
        $imgStatus = get_all('popup')['data'][0]['image_status'];
        
        ?>
        <img class="modal-content" src="temp/upload/<?= $img ?>">
      
    </div>
  </div>
</div>

<?php
require_once('temp/footer.php');
?>
<script>
$( document ).ready(function() {
    if('<?= $imgStatus ?>' == 'SHOW'){
     $('#popup').modal('show');
    }
});
</script>  

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
       
        var data = google.visualization.arrayToDataTable(<?php echo monthly_graph($year); ?>);
        
        var options = {
          title: "New Admission vs Result Published <?= $year;?>",
          is3D: true
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>