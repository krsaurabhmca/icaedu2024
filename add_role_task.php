<?php require_once('temp/sidebar.php'); 
 $table ='user_role';
 $ref_prsn_id = $ref_id ='';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
    } else {
        
        $res  = insert_row($table);
            $id = $res['id'];
            $isedit = 'no';
            $data  = get_data($table, $id)['data'];
            extract($data);
            $status = 'ACTIVE';
    }
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                    
	<div class="card ">
        <div class="card-header">Manage Role Tasks <?php  $user_type = $_SESSION['user_type'];  ?>
        <div class='float-end'>
       <a href='add_role_task' class='btn btn-danger btn-sm'> Add New</a>
        <button class="btn btn-primary btn-sm" id="update_btn" accesskey="s"> Save </button>
        </div>
        </div>
        <div class="card-body">
			     <div class="row">
                <div class="col-md-4" >
                    <!-- Form Elements -->
                        <?php
                            if($user_type == 'ADMIN'){
                        ?>
                        <form action ='create_role_task' id='update_frm' enctype='multipart/form-data'>
                            
                            <label class="control-label" for="inputError">Menu Type </label>
                                     <select name='menu_type' class='form-select' required id='menu_type'>
                                        <?php  dropdown($menu_type_list, $menu_type); ?>
                                    </select>
                             
                             <div id='parent_menu'>      
                             <label class="control-label" for="inputError">Parent menu </label>
                                     <select name='parent_menu' class='form-select select2'>
                                        <?php  dropdown_where('user_role', 'id','task_description', ['menu_type'=>'MENU'], $parent_menu ); ?>
                                    </select>
                            </div>        
                        <div class="form-group">
                              
                            <label>Task Name</label>
                             <input class="form-control" value='<?= $data['id'];?>' name='id'  required type='hidden'  >
                            <input class="form-control" value='<?php echo $task_name;?>' name='task_name' type='text' required>
                        </div>
                       
                        <div class="form-group">
                            <label>Task Description</label>
                           
                            <input class="form-control" name='task_description' value='<?php echo $task_description;?>'  required  >
                        </div>
                        <div id='icon'>      
                             <label>Icon </label>
                            <input class="form-control" value='<?php echo $icon;?>' name='icon' type='text' >
                        </div>
                         <div class="form-group mb-3">
                        <label class="control-label" for="inputError">Status </label>
                         <select name='status' class='form-select select2' required>
                            <?php dropdown($status_simple,$status); ?>
                        </select>
                        </div>
                     
                    </form> 
                    
                            <?php   }  ?>
                    </div>  
                
                <div class="col-lg-8">
                                
                                <!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Task Name</th>
                                            <th>Task Des. </th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?
                                    $i = '1';
                                    $res = get_all($table,'*','','id asc');
                                    foreach((array) $res['data'] as $row)
                                    {
                                            echo "<tr>";
                                            $user_role_id=$row['id'];
                                           
                                    echo "<td> ". $i ."</td>";
                                    echo "<td> ". $row['task_name'] ."</td>";
                                    echo "<td> ". $row['task_description'] ."</td>";
                                          
                                    echo "<td> ". $row['status'] ."</td>";
                                    ?>
                                        <td align='right'>
                                        <?php echo btn_edit('add_role_task',$user_role_id); ?>
                                        <?php echo btn_delete('user_role',$user_role_id); ?>
                                        </td>
                                            </tr>
                                    <?php $i++ ; }   ?>
                                       
                                    </tbody>
                                </table>
                      </div>
                  </div>
               
                </div>
            </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

    <script>
      $('#summernote').summernote({
        placeholder: 'Type your text here',
        tabsize: 2,
        height:100
      });
      
      
       $(document).on("change blur","#menu_type", function(){
           let x = $(this).val();
          // alert(x);
           if(x=='MENU')
           {
               $("#icon").css('display','block');
               $("#parent_menu").css('display','none');
           }else{
                $("#icon").css('display','none');
               $("#parent_menu").css('display','block');
           }
      });
    </script>