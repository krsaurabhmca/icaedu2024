<?php require_once('temp/sidebar.php');
$center_id = centerid($user_name);
$year  = (isset($_POST['year']))? $_POST['year']:date('Y');
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

                                    <!--<div class="page-title-right">-->
                                    <!--   <a href='payment'><button class='btn btn-info btn-sm'> Recharge Now</button></a>-->
                                    <!--   <button class='btn btn-danger btn-sm'> ₹<?php echo $wallet; ?></button>-->
                                    <!--</div>-->

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                    <?php
                        if($_SESSION['user_type'] == 'CLIENT'){
                    ?>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card overflow-hidden">
                                    <div class="bg-primary bg-soft">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="text-primary p-3">
                                                    <h5 class="text-primary">Welcome Back !</h5>
                                                    <p>Top 10 Performer </p>
                                                </div>
                                            </div>
                                            <div class="col-5 align-self-end">
                                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                     <table rules='all' class='table'>
                                            <tr>
                                                <form method='post'>
                                                <td colspan='3'>
                                                    Select Year 
                                                    <select name='year' onchange='submit()' onblur='submit()' >
                                                        <?php dropdown($year_list,$year); ?>
                                                    </select>
                                                   
                                                </td>
                                                 </form>
                                            </tr>
                                            <tr>
                                               <th>Center Name</th>
                                            <th> Document</th>
                                            </tr>
<?php

$sql = "select center_id,count(student.id) as ct from student where year(student.created_at) ='$year' and status not in ('AUTO','DELETED') group by center_id ORDER BY `ct` desc"; 

$res = direct_sql($sql);
$i=1;
    foreach($res['data'] as $row)
    {
        echo "<tr>";
        echo "<td>" .get_data('center_details', $row['center_id'] ,'center_name')['data'] ."(".get_data('center_details', $row['center_id'] ,'center_address')['data'].")</td>";
        echo "<td>" .$row['ct'] ."</td>";
        echo "</tr>";
        
        if($i==10)
        {
            break;
        }
        else{
          $i++;  
        }
    }
    $rank = get_rank($sql, 'center_id', centerid($user_name));
    echo "<tr class='bg-primary text-light'><th> Your Rank </th><th>" .$rank. "</th></tr>";
?>
</table>
                                </div>
                             
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
                                         <h4 class="card-title mb-4"> What's New</h4>
                                    <div class="card-body bg-primary bg-soft pt-2">
                                      
                                               <?php $all_notice  = get_all('notice', '*' ,array('status'=>'CLIENT'))['data']; 
                                                    foreach($all_notice as $all)
                                                    {
                                                        echo "<u class='text-danger'>". $all['notice_title'] .'</u> <i>'.  html_entity_decode($all['notice_details']) .'</i> <hr>';
                                                    }
                                                ?>   
                                       
                                    </div>
                                        <div class="d-sm-flex flex-wrap">
                                            <h4 class="card-title mb-2 mt-2"> Institution Profile</h4>
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
                                  
                                    
                                    </table>
                                   
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    
                    <div class='row'>
                        <div class="card">
                                    
                                    <div class="card-body">
                                       <div id="piechart" style="width:100%; height:200px;"></div>
                                    </div>
                                </div>
                    </div>
                    <?php
                        }else{
                           $center = get_data('user',$_SESSION['user_id'],'created_by')['data'];
                           $c_user = get_data('user',$center,'user_name')['data'];
                    ?>
                            <div class="card">
                                    <div class="row">
                                    <div class="col-md-6">
                                         <h4 class="card-title m-2"> What's New</h4>
                                    <div class="card-body bg-primary bg-soft pt-2">
                                      
                                               <?php $all_notice  = get_all('notice', '*' ,array('status'=>'CLIENT'))['data']; 
                                                    foreach($all_notice as $all)
                                                    {
                                                        echo "<u class='text-danger'>". $all['notice_title'] .'</u> <i>'.  html_entity_decode($all['notice_details']) .'</i> <hr>';
                                                    }
                                                ?>   
                                       
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-sm-flex flex-wrap">
                                            <h4 class="card-title m-3"> Institution Profile</h4>
                                        </div>
                                        
                                       <table class="table" width='100%'>
                                    <tr style='height:70px'></tr>
                                    <tr>
                                        <td width='160'> <label> Center Code </label> </td>
                                        <td> <?php echo centerid( $c_user,'center_code'); ?> </td>
                                        
                                        <td rowspan='5'  style='vertical-align:middle;text-align:center;' width='180'>
                                        <img src='temp/upload/<?php echo centerid( $c_user,'director_photo'); ?>' alt ='Image Not Available' width ='110' height='140' /> 
                                        </td>
                                    
                                    </tr>
                                
                                    <tr>
                                        <td> <label> Center Name </label> </td>
                                        <td> <?php echo centerid( $c_user,'center_name'); ?> </td>
                                    </tr>
                                    <tr>
                                        <td> <label> Director's Name  </label> </td>
                                        <td> <?php echo centerid( $c_user,'center_director'); ?> </td>
                                    </tr>
                                    <tr>
                                        <td> <label> Address </label> </td>
                                        <td> <?php echo centerid( $c_user,'center_address'); ?> ,<?php echo distinfo(centerid( $user_name,'dist_code'),'dist_name'); ?> </td>
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td> <label> Email ID </label> </td>
                                        <td> <?php echo centerid($c_user,'center_email'); ?> </td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        <td> <label> Mobile </label> </td>
                                        <td> <?php echo centerid( $c_user,'center_mobile'); ?> </td>
                                        <td ></td>
                                    </tr>
                                  
                                    
                                    </table>
                                   
                                   
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    <?php
                        }
                    ?>

               
               
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
       
        var data = google.visualization.arrayToDataTable(<?php echo yearly_graph(); ?>);
        
        var options = {
          title: "Your Student Graph ",
          is3D: true
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>