<?php require_once('function.php'); ?>
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
        <div id="layout-wrapper">
            <header id="page-topbar" style='z-index:10000!important'>
                <div class="navbar-header" >
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <!--<a href="index" class="logo logo-dark">-->
                            <!--    <span class="logo-sm">-->
                            <!--        <img src="assets/img/apprise.png" alt="" height="26">-->
                            <!--    </span>-->
                            <!--    <span class="logo-lg">-->
                            <!--        <img src="assets/img/logo-dark.png" alt="" height="60">-->
                            <!--    </span>-->
                            <!--</a>-->

                            <a href="index" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../assets/img/apprise.png" alt="" height="26">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/img/logo-light.png" alt="" height="50">
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?= $base_url ?>/temp/upload/<?php echo get_data('student',$_SESSION['user_id'],'student_photo')['data'] ?>"
                                    alt="Student Photo">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php echo get_data('student',$_SESSION['user_id'],'student_name')['data'] ?></span>
                               
                            </button>
                          
                        </div>
                    </div>
                </div>
            </header>
<?php 
if(isset($_SESSION['student_id']))
{
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];
    if($user_type=='STUDENT')
    {
    $user_name = $_SESSION['user_name'];
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
<style>
   
    .modal-dialog {
        top:70px;
      	position: fixed;
		margin: auto;
		width: 400px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
        transition: 2s;
        overflow-y:scroll;
	}
    .modal-header{
        box-shadow:2px 2px 2px #ddd;
    }
    .modal-content {
		height: 100%;
        border-radius:0px;
		
	}
    .modal-body {
		padding: 15px 15px 80px;
        overflow-y: auto;
	}

    .modal-header .btn-close {
    padding: .5rem .5rem;
    border-radius: 50%;
    border: solid 1px;
    float: left;
    margin:;
    }


.accordion-item{
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    background:transparent;
    border-radius:10px!important;
    border: solid 1px #aaa!important;
}

.accordion-button{
    display: grid;
    background:transparent!important;
    border: solid 0px #fff;
}
.accordion-body{
    padding:0px;
}

.sticky-row{
    width:100%;
    display:flex;
    background:#eff2f7;
    position:fixed;
    z-index:100;
    border-top:solid 1px #ccc;
    border-bottom:solid 1px #ddd;
    box-shadow:2px 3px 3px #d6d6d6;
    margin-top:30px;
}
#content-area{
    margin-top:100px;
}

.cbut{
    width:60px;
    height:60px;
    border-radius:50%;
    line-height:70px;
    padding:5px;
    border:solid 1px #ddd;
    color:#aaa;
    margin-right:10px;
    float:left;
}

.lbut {
    width:auto;
    height:80px;
    font-weight:600;
    color:#aaa;
    text-align:left;
    margin-left:20px;
}
.rbut{
    width:auto;
    height:80px;
    font-weight:600;
    color:#aaa;
    text-align:right;
    margin-right:20px;
}
.lbut span, .rbut span{
  color:#666;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>