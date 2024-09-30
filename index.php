<?php require_once('temp/sidebar.php');
if($_SESSION['user_type'] =='CLIENT' or $_SESSION['user_type'] == 'CAS')
{
    echo "<script> window.location ='client_index' </script>";
}
$year  = (isset($_POST['year']))? $_POST['year']:date('Y');
?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">

                     <!-- start page title -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                
                                  <h4 class="mb-sm-0 font-size-18">Dashboard[<?php echo $_SESSION['user_name']; ?>] </h4>
                            </div>
                             <div class="col-md-7">
                                 
                                 <!--<a href='print_result' class='btn btn-sm btn-primary' title='Print Certificate'><i class='fa fa-print'></i> Certificate </a>-->
                                 <!--<a href='show_user' class='btn btn-sm btn-danger' title='Login As Client'><i class='fa fa-user'></i> Clients</a>-->
                                 <!--<a href='manage_center' class='btn btn-sm btn-success' title='Wallet Recharge'> &#8377; Recharge </a>-->
                                 <!--<a href='live_exam' class='btn btn-sm btn-dark ' title='View Ongoing Exam'> <i class='fa fa-globe'></i> Live Exam </a>-->
                                 <!--<a href='quick_student' class='btn btn-sm btn-info' title='Student Registration'> <i class='fa fa-user-plus'></i> Quick Student </a>-->
                                 <!--<a href='admin_download_student' class='btn btn-sm btn-warning' title='Print ID card'><i class='fa fa-address-book'></i> ID Card </a>-->
                                 <!--<a href='result_view' class='btn btn-sm btn-success' title='Pending For Print'><i class='fa fa-print'></i> 
                                 <?= get_all('student','*',['status'=>'RESULT OUT'])['count']; ?> </a>-->
                                 
                            </div>
                            
                            <div class="col-md-2 text-right">
                                  <div class='badge bg-danger badge-lg blink float-end'><?php echo expiry($start_date); ?> Left</div>
                                 
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
                                                    
                                                    <h5 class="text-primary">Best Performer !</h5>
                                                    <p> All Performer  </p>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-5 align-self-end">
                                               
                                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0" style="overflow-y: auto; height:560px">
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
                                                <th>Sr No.</th>
                                                <th>Center Name</th>
                                            <th> Document</th>
                                            </tr>
<?php
 $sql = "select center_id,count(student.id) as ct from student where year(student.created_at) ='$year' and status not in ('AUTO','DELETED') group by center_id ORDER BY `ct` DESC"; 
// $sql ="select student.center_id, count(result.id) as ct from result,student where result.student_id =student.id and student.status ='DISPATCHED' and year(result.created_at) ='2021' group by center_id  ORDER BY `ct`  DESC limit 10";
$res = direct_sql($sql);
$i=1;
    foreach($res['data'] as $row)
    {
        echo "<tr>";
        echo "<td>" .$i."</td>";
        echo "<td>" .get_data('center_details', $row['center_id'] ,'center_name')['data'] ."(".get_data('center_details', $row['center_id'] ,'center_code')['data'].")</td>";
        echo "<td>" .$row['ct'] ."</td>";
        echo "</tr>";
        $i++;
    }
?>
</table>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">CENTERS</p>
                                                        <h4 class="mb-0"><?php  echo get_all('center_details')['count'];?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-buildings font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">STUDENTS</p>
                                                        <h4 class="mb-0"><?php  echo get_all('student')['count'];?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center ">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="fa fa-users font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">DISPATCHED</p>
                                                        <h4 class="mb-0"><?php  echo get_all('student','*',array('status'=>'DISPATCHED'))['count'];?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-export font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">ENQUIRY</p>
                                                        <h4 class="mb-0"><?php  echo get_all('enquiry')['count'];?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-question-mark font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">Courses</p>
                                                        <h4 class="mb-0"><?php  echo get_all('course_details')['count'];?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-detail font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">NOTICE</p>
                                                        <h4 class="mb-0"><?php  echo get_all('notice')['count'];?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-message-rounded-dots font-size-24"></i>
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
                                    <div class="card-header bg-secondary text-light">
                                        Status Report 
                                        <a href='strength' class='btn btn-success btn-danger btn-sm' style='float:right'>Center Wise Statics</a>
                                    </div>
                                    <div class="card-body">
                                       
                                       <div id="piechart" style="width:100%; height:320px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                        <div class='row'>
                        <div class="card">
                                    
                                    <div class="card-body">
                                       <div id="yearchart" style="width:100%; height:200px;"></div>
                                    </div>
                                </div>
                        </div>
                    
                        <div class="alert alert-info">
                         <i class="fa fa-warning fa-2x"></i> &nbsp;&nbsp; Hello <b>&nbsp;<?php echo strtoupper($user_name);?> ! </b>This system is only permited to <?php echo $inst_name; ?>. It is not for commercial use. Username and password is confidential,do not share with any unauthorised person.
                         Any query, comment write us <a href='mailto:<?php echo $dev_email; ?>' class='alert-link'><?php echo $dev_email; ?></a> or Call +91 <?php echo $dev_contact; ?>.
                         Details, updates and terms to use are available on <a href='<?php echo $dev_url; ?>' title='<?php echo $dev_company; ?>' class='alert-link' > <?php echo $dev_url; ?> </a>.
                         </div>
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

<?php
require_once('temp/footer.php');
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(yearChart);

      function drawChart() {
       
        var data = google.visualization.arrayToDataTable(<?php echo monthly_graph($year); ?>);
        
        var options = {
          title: "New Admission vs Result Published <?= $year;?>",
          is3D: true
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      
      function yearChart() {
       
        var data = google.visualization.arrayToDataTable(<?php echo yearly_graph(); ?>);
        
        var options = {
          title: "Overall Student Graph",
          is3D: true
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('yearchart'));

        chart.draw(data, options);
      }
</script>