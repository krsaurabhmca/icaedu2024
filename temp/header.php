<?php require_once('function.php'); 
if(!$_SESSION['user_type'] =='CLIENT')
{
    // echo "<script> window.location ='login' </script>";
    
    
}
?>
<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title><?php echo $inst_name ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?php echo $inst_name ?>" name="description" />
        <meta content="<?php echo $inst_name ?>" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="assets/css/datatables.min.css">
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="assets/libs/select2/css/select2.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "nc9qlyspq1");
</script>

    </head>
        <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/img/apprise.png" alt="" height="34">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="60">
                                </span>
                            </a>

                            <a href="index" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/img/apprise.png" alt="" height="34">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/img/logo-light.png" alt="" height="60">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">
                        <?php if(strtoupper($_SESSION['user_type'])=='ADMIN'){ ?>
                        <div style='margin-top:15px;margin-right:15px;'  class="d-none d-md-block d-lg-block">
                                <a href='strength' class='btn btn-sm btn-outline-primary' title='Manage Students'><i class='fa fa-user'></i> Manage Students</a>
                                 <a href='show_user' class='btn btn-sm btn-outline-secondary' title='Login As Client'><i class='fa fa-user'></i> Clients</a>
                                 <a href='manage_center' class='btn btn-sm btn-outline-success' title='Wallet Recharge'> &#8377; Recharge </a>
                                 <a href='print_result' class='btn btn-sm btn-outline-dark ' title='Print Certificate'> <i class='fa fa-print'></i> Print Certificate </a>
                                 <a href='quick_student' class='btn btn-sm btn-outline-info' title='Student Registration'> <i class='fa fa-user-plus'></i> Quick Student </a>
                                 <a href='admin_download_student' class='btn btn-sm btn-outline-warning' title='Print ID card'><i class='fa fa-address-book'></i> ID Card </a>
                                 <a href='datewise_center_report' class='btn btn-sm btn-outline-dark' title='Datewise Report'><i class='fa fa-address-book'></i> Report </a>
                                 <a href='result_view' class='btn btn-sm btn-outline-success' title='Pending For Print'><i class='fa fa-print'></i> <?= get_all('student','*',['status'=>'RESULT OUT'])['count']; ?> </a>
                        </div>
                        <?php } else if(strtoupper($_SESSION['user_type'])=='CLIENT'){ 
                         $center1 = get_data('center_details', $_SESSION['user_name'], null,'center_code')['data'];
                         ?>
                        <div style='margin-top:15px;margin-right:150px;font-size:15px'  class="d-none d-md-block d-lg-block text-bold">
                           <a href='' class='btn   text-bold bg-danger text-light' title='Dues'>Dues Balance - <?= $center1['center_balance'] ?></a>
                           <a href='payment' class='btn   text-bold bg-primary text-light' title='Dues'>Recharge Now</a>
                           <a href='' class='btn   text-bold bg-success text-light' title='Dues'>Wallet Balance - <?= $center1['center_wallet'] ?></a>
                           <a href='make_att' class='btn   text-bold bg-dark text-light' title='Dues'>Make Attendance </a>
                           <a href='search_to_pay' class='btn   text-bold bg-warning text-light' title='Dues'>Collect Fee </a>
                        </div>
                       
                        <?php } ?>
                        
                     <!--    <div class="dropdown d-inline-block d-lg-none ms-2">
                     <!--       <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"-->
                     <!--       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                     <!--           <i class="mdi mdi-magnify"></i>-->
                     <!--       </button>-->
                     <!--       <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"-->
                     <!--           aria-labelledby="page-header-search-dropdown">-->
        
                     <!--           <form class="p-3">-->
                     <!--               <div class="form-group m-0">-->
                     <!--                   <div class="input-group">-->
                     <!--                       <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">-->
                     <!--                       <div class="input-group-append">-->
                     <!--                           <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>-->
                     <!--                       </div>-->
                     <!--                   </div>-->
                     <!--               </div>-->
                     <!--           </form>-->
                     <!--       </div>-->
                     <!--   </div> -->
                     
                    
                     
                       
                        <!--<div class="dropdown d-none d-lg-inline-block ms-1">-->
                          
                        <!--    <button type="button" class="login_as btn header-item noti-icon "  data-id="<?php echo get_data('user',$_SESSION['old_user_id'],'user_name')['data']; ?>" data-code="<?php echo get_data('user',$_SESSION['old_user_id'],'user_pass')['data']; ?>">-->
                        <!--        <i class="bx bx-arrow-back"></i>-->
                        <!--    </button>-->
                           
                        <!--</div>  -->
                     <?php if ($_SESSION['user_type'] =='DEV')
                     {
                     ?>
                       <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" >
                               <a href='temp/master_process.php?task=birthday' target='_blank' onclick=" return confirm('Do you really want to send birthday wishes ?')"> <i class="bx bx-cake"></i></a>
                            </button>
                        </div> 
                  
                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div> 
                       
                    <?php
                     }
                    ?>  
                       
                       
                        <div class="dropdown d-inline-block">
                            <?php if($_SESSION['user_type']=='ADMIN')
                            {
                                ?>
                            <a href='search_student.php' title ='Global Search'>
                            <button type="button" class="btn header-item noti-icon waves-effect"
                            aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-search bx-tada"></i>
                                
                            </button>
                            </a>
                            <?php } ?>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small" key="t-view-all"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" key="t-your-order">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-3.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-simplified">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" key="t-shipped">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-4.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-occidental">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span> 
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if($_SESSION['user_type'] =='CLIENT'){ ?>
                                <img class="rounded-circle header-profile-user" src="temp/upload/<?php echo centerid( $_SESSION['user_name'],'director_photo'); ?>" alt="Header Avatar">
                             <?php } else { ?>
                                <img class="rounded-circle header-profile-user" src="assets/img/users.png" alt="Header Avatar">
                             <?php } ?>
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php echo $_SESSION['user_name']; ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">My Wallet</span></a>
                                <a class="dropdown-item d-block" href="change_password"><!-- <span class="badge bg-success float-end">11</span> --><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                               <!--  <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="javascript:void();" onClick='logout()'><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>
                        <?php if($_SESSION['user_type']=='ADMIN'){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect" title="Short Key">
                                <i class="bx bx-cog bx-spin"></i>
                            </button>
                        </div>
                       <?php } ?>
                    </div>
                </div>
            </header>
