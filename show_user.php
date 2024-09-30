<?php require_once('temp/sidebar.php'); 
if(isset($_REQUEST['center_id']))
{
    $center_id = $_REQUEST['center_id'];
}
if($_SESSION['user_type'] =='CLIENT')
{
    echo "<script> window.location ='client_index' </script>";
}
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">


            <div class="card mb-4">
                <div class="card-header">
                    <div class='row'>
                    <div class='col-md-10'>
                    Manage User 
                    </div>
                    <div class='col-md-2'>
                        <form>
                    <select name='cstatus' class='from-control float-end' onchange='submit()'>
                        <?php dropdown($status_simple, $_GET['cstatus']); ?>
                    </select>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>

                                    <th>Center Name</th>
                                    <th>Center Code</th>
                                    <th>Mobile No.</th>
                                    <th>User Status</th>
                                    <th>Operation.</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php 
                                $cststus ='ACTIVE';
                                if(isset($_GET['cstatus']))
                                {
                                    $cststus  =$_GET['cstatus'];
                                }
                                    $sql ="select user.id,user.user_name, user_mobile, user_pass, user.status, cd.center_name from user,center_details cd
                                     where cd.center_code = user.user_name and user.user_type <>'admin' and user.status not in ('AUTO','DELETED') and cd.status ='$cststus' order by center_name  "; 
                                        $res = direct_sql($sql);

                                        foreach((array) $res['data'] as $row)
                                        {
                                        $user_id =$row['id'];
                                        $center_code =$row['user_name'];
                                        $st =$row['status'];
                                        $cname =centerid($center_code,'center_name');
                                        if($st =='BLOCK')
                                        {
                                        echo"<tr class='odd gradeX text-danger'>";  
                                        }else{
                                        echo"<tr class='odd gradeX'>";  
                                        }
                                        
                                        echo"<td>".$cname."</td>";
                                        echo"<td>".$row['user_name']."</td>";
                                        echo"<td>".$row['user_mobile']."</td>";
                                        echo"<td>". show_status($row['status'])."</td>";
                                        echo"<td align='right'>
                                        
                                       
                                        
                                        <a href='txn_entry.php?center_code=$center_code' title='Transaction Entry ' >
                                        <button type='submit' class='btn btn-success btn-sm' name='Pay_fee'> TXN Entry </button></a>
                                        
                                        <a href='edit_user.php?user_id=$user_id' title='Edit User Info ' >
                                        <button type='submit' class='btn btn-warning  btn-sm' title='Change Password'> <i class='fa fa-edit'></i> </button></a> ";
                                         echo btn_view('user',$user_id,$row['user_name']);
                                        ?>

                                <button type='button' data-url="client_index" data-id='<?php echo $row['user_name'];?>'
                                    data-code='<?php echo $row['user_pass'];?>' class='login_as btn btn-danger btn-sm' title='Login As Center'>
                                    <i class='fa fa-key'></i> </button>

                                <?php if($st <>'BLOCK') { ?>
                                <button type='button' data-id='<?php echo $center_code; ?>' data-status='BLOCK'
                                    title='Block This Center' class='block_user btn btn-dark btn-sm'> <i
                                        class='fa fa-ban'></i> BLOCK </button>
                                <?php  } else{ ?>
                                <button type='button' data-id='<?php echo $center_code; ?>' data-status='ACTIVE'
                                    class='block_user btn btn-warning  btn-sm' title='Unblock This Center'> UNBLOCK
                                </button>

                                <?php } ?>
                                </td>
                                <?php
                                        }
                                       ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page-content -->
        <?php require_once('temp/footer.php'); ?>