<?php require_once('function.php'); 
$user_id = $_SESSION['user_id'];
$user = get_data('user', $user_id)['data'];
$user_name = $user['user_name'] 
?>
<!doctype html>
<html lang="en">
<head>
        
        <meta charset="utf-8" />
        <title>Student | <?php echo $inst_name ?></title>
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
                                    <img src="assets/img/apprise.png" alt="" height="26">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/img/logo-dark.png" alt="" height="60">
                                </span>
                            </a>

                            <a href="index" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../assets/img/apprise.png" alt="" height="26">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/img/logo-light.png" alt="" height="60">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">

                         <div class="dropdown d-inline-block d-lg-none ms-2">
                            <ul class="navbar-nav ml-auto">
                              
                            </ul>
                         </div>
                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            
                            <div class="dropdown d-inline-block">
                                <div class="card" >
                                 <?php 
                                $mobile = centerinfo($user_id,'center_mobile');
                                 echo  "<a href='tel:$mobile'><big class='btn bg-info text-light'>Helpline No. - +91".$mobile."</big></a>";
                                  ?>
                                </div>
                               
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="https://icaedu.co.in/apprise/temp/upload/<?php echo get_data('student',$_SESSION['user_id'],'student_photo')['data'] ?>"
                                    alt="Student Photo">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php echo get_data('student',$_SESSION['user_id'],'student_name')['data'] ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                               
                                <!--<div class="dropdown-divider"></div>-->
                                <a class="dropdown-item text-danger" href="javascript:void();" onClick='logout()'><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>

                        <!--<div class="dropdown d-inline-block">-->
                        <!--    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">-->
                        <!--        <i class="bx bx-cog bx-spin"></i>-->
                        <!--    </button>-->
                        <!--</div>-->

                    </div>
                </div>
            </header>
