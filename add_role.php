<?php require_once('temp/sidebar.php'); 
$table = 'user_role';
if(isset($_GET['suser_id']) && $_GET['suser_id'] !='')
{
    $suser_id = $_GET['suser_id'];
}
?>
<style>
    .card-header {
    background: #302948;
    color: #fff;
    font-weight: 600;
    font-size: 14px;
    padding: .625rem 1.25rem;
    margin-bottom: 0;
    border-top: 3px solid #fd9218;
    border-top-left-radius:5px;
    border-top-right-radius:5px;
}
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Manage Role of <?= get_data('user',$suser_id,'user_name')['data']?>

                            <div style='float:right'>
                                <form>
                                    <select name='suser_id' class='form-select select2' value='<?= $user_name?>' onchange='submit()'>
                                        <option value=''>Select User</option>
                                        <?php 
                                        if($user_type=='ADMIN'){
                                            dropdown_list('user','id','user_name',$suser_id) ;
                                        }
                                            if($user_type=='CLIENT'){
                                               $users = get_all('user','*',['created_by'=>$user_id]);
                                               foreach((array)$users['data'] as $user){
                                                   echo "<option value=".$user['id'].">".$user['full_name']."</option>";
                                               }
                                            }
                                        ?>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <span style='float:right'>
                                <span class='btn btn-primary btn-sm border ' >
                                    <input type="checkbox" id="selectall" onClick="selectAll(this)" /> Allow All
                                </span>&nbsp;
                                <button id='role_btn' class='btn btn-success btn-sm' title='Save Data' style="margin-right:8px;"><i class='fa fa-save'></i> SAVE </button> &nbsp;
                            </span>
                            <!--    Basic Table  -->
                            <form action='update_role'>
                                <input type='hidden' value='<?=$user_type?>' name='user_type'>
                                <input type='hidden' value='<?=$suser_id?>' id='suser_id' name='suser_id'>
                                <table class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>

                                            <th>Sr. No. </th>
                                            <th>Task </th>
                                            <th>Allow Task</th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if($user_type=='ADMIN'){
                                            $role_tasks = get_all('user_role','*','','id asc');
                                        }else{
                                            $role_tasks = get_all('client_user_role','*','','id asc');
                                        }
                                        foreach((array)$role_tasks['data'] as $role_task){
                                          $task_id = $role_task['id'];
                                          $chk = check_selection($task_id,$suser_id);
								 	echo "<td>$i</td>";
								 	echo "<td> ". $role_task['task_description']."</td>";
                                    echo "<td> <input type='checkbox' value ='$task_id' name='sel_id[]' $chk class='chk'> </td>";							
                                    
                                    ?>

                                        </tr>
                                    <?php
                                    $i++;
                                        }
									?>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <?php require_once('temp/footer.php'); ?>
    <script language="JavaScript">
        function selectAll(source) {
            checkboxes = document.getElementsByName('sel_id[]');
            for(var i in checkboxes)
                checkboxes[i].checked = source.checked;
        }
    </script>