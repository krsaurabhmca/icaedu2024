<?php 
require_once('header.php');
if(isset($_SESSION['student_id']))
{
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];
    if($user_type=='STUDENT')
    {
    $user_name = $_SESSION['user_name'];
    $roll = get_data('student',$user_id,'student_roll')['data'];
    $mobile = get_data('student',$user_id,'student_mobile')['data'];
    $ut = get_data('student',$user_id,'token')['data'];
    echo "<br>". $token;
        if($token != $ut)
        {
          echo "<script> window.location ='student_temp/master_process?task=logout2' </script>";
        }
    }
    else{
      echo "<script> window.location ='student_temp/master_process?task=logout2' </script>"; 
    }
}
else{
     echo "<script> window.location ='student_temp/master_process?task=logout2' </script>";
}
?>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="index" class="waves-effect">
                                    <i class="bx bxs-dashboard"></i>
                                    <!-- <span class="badge rounded-pill bg-info float-end">04</span> -->
                                    <span key="t-dashboards">DashBoard
                                </a>
                            </li>
                              <!--<li class="menu-title" key="t-menu">Menu</li>-->
                            <!--<li>-->
                            <!--    <a href="view_reg" class=" waves-effect">-->
                            <!--        <i class="bx bx-face"></i>-->
                            <!--        <span key="t-layouts">View Registration</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <li>
                                <a href="view_ms" class="waves-effect">
                                    <i class="bx bx-show"></i>
                                    <span key="t-calendar">View Mark Sheet</span>
                                </a>
                            </li>

                            <li>
                                <a href="show_fee" class="waves-effect">
                                    <i class='bx bxs-credit-card'></i>
                                    <span key="t-chat">View Payments</span>
                                </a>
                            </li> 
                            
                            <!--<li>-->
                            <!--    <a href="show_topics" class="waves-effect">-->
                            <!--        <i class="bx bx-chart"></i>-->
                            <!--        <span key="t-chat">Study Material</span>-->
                            <!--    </a>-->
                            <!--</li>  -->
                            <li>
                                <a href="study_material" class="waves-effect">
                                    <i class="bx bx-book"></i>
                                    <span key="t-chat">Read & Learn </span>
                                </a>
                            </li>  
                            
                             <li>
                                <a href="practice_set" class="waves-effect">
                                    <i class="bx bxl-paypal"></i>
                                    <span key="t-chat">Practice Set</span>
                                </a>
                            </li>
                            <li>
                                <a href="online_exam" class="waves-effect">
                                    <i class="bx bx-laptop"></i>
                                    <span key="t-chat">Online Exam </span>
                                </a>
                            </li> 
                            <li>
                                <a href="att_report" class="waves-effect">
                                    <i class="bx bx-calendar"></i>
                                    <span key="t-chat">Attendence  </span>
                                </a>
                            </li> 
                        </ul>
                  
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
