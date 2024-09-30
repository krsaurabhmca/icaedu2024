<?php require_once('temp/sidebar.php'); 
 $table ='user';
 $ref_prsn_id = $ref_id ='';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
    } else {
        
        $res  = insert_row($table);
        print_r($res);
        if($res['status']=='success')
        {
            $id = $res['id'];
            $isedit = 'no';
            $data  = get_data($table, $id)['data'];
            extract($data);
            $status = 'ACTIVE';
        }
    }
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================= -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
	<div class="card ">
        <div class="card-header">Create Staff 
        <div class='float-end'>
       <a href='create_user' class='btn btn-danger btn-sm'> Add New</a>
        <button class="btn btn-primary btn-sm" id="update_btn" accesskey="s"> Save </button>
        </div>
        </div>
        <div class="card-body">
			     <div class="row">
                <div class="col-md-4" >
                    <!-- Form Elements -->
                         <form action ='create_staff' id='update_frm' enctype='multipart/form-data'>
                        <div class="form-group"><?php 
                                    $user_type = $_SESSION['user_type'];
                                if($user_type == 'ADMIN'){
                            ?>
                                <!--<label class="control-label" for="inputError">Center </label>-->
                                <!--     <select name='status' class='form-select select2'>-->
                                <!--        <?php// echo dropdown_list('center_details', 'id', 'center_name', $center_id, 'center_code'); ?>-->
                                <!--    </select>-->
                            <?php 
                                }
                                if($user_type == 'CLIENT'){                            ?>
                                <input type='hidden' value='<?php echo centerid($_SESSION['user_name']); ?>' name='center_id' required >
                            <?php  } if($id==''){ ?>
                             <input class="form-control" value='<?= $res['id'];?>' name='id'  required type='hidden'  >
                             <?php } else{ ?>
                             <input class="form-control" value='<?= $id;?>' name='id'  required type='hidden'  >
                             <?php }  ?>
                            <?php if( $user_type == 'ADMIN' ){  ?>
                            
                               <input class="form-control" value='STAFF' name='isedit' value='<?= $isedit;?>' type='hidden'  >
                               <input class="form-control" value='STAFF' name='user_type'   type='hidden'  >
                            <?php } else if ( $user_type == 'CLIENT' ){ ?>  
                               <input class="form-control" value='CAS' name='isedit' value='<?= $isedit;?>' type='hidden'  >
                               <input class="form-control" value='CAS' name='user_type'   type='hidden'  >
                            <?php } ?>
                            <label>Full Name</label>
                            <input class="form-control" value='<?php echo $full_name;?>' name='full_name' type='text'>
                        </div>
                        <div class="form-group">
                            <label>User Email</label>
                            <input class="form-control" name='user_email' value='<?php echo $user_email;?>'  required  >
                        </div>
                         <div class="form-group">
                            <label>Mobile No.</label>
                            <input class="form-control" name='user_mobile' value='<?php echo $user_mobile;?>'  required  >
                        </div>
                        <?php if($isedit =='yes'){ ?>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" name='user_pass' value='' >
                            <p class='text-muted'> Leave it blank if don't want to change </p>
                        </div>
                         <?php }else { ?>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" name='user_pass' value='' required >
                        </div>
                        <?php } ?>
                         <div class="form-group mb-3">
                        <label class="control-label" for="inputError">Status </label>
                         <select name='status' class='form-select select2'>
                            <?php dropdown($status_simple,$status); ?>
                        </select>
                        </div>
                    </form> 
                    </div>  
                <div class="col-lg-8">
                                <!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th>Name</th>
                                            <th>Username </th>
                                            <th>Mobile </th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if($user_type == 'CLIENT'){
                                    $res = get_all($table,'*',['created_by'=>$user_id,'user_type'=>'CAS']);
                                    }else{
                                         $res = get_all($table,'*',['created_by'=>$user_id,'user_type'=>'STAFF']);
                                    }
                                    foreach((array) $res['data'] as $row)
                                    {
                                            echo "<tr>";
                                            $user_id=$row['id'];
                                           
                                    echo "<td> ". $row['full_name'] ."</td>";
                                    echo "<td> ". $row['user_email'] ."</td>";
                                    echo "<td> ". $row['user_mobile'] ."</td>";
                                          
                                    echo "<td> ". $row['status'] ."</td>";
                                    ?>
                                        <td align='right'>
                                        <?php echo btn_edit('create_user',$user_id); ?>
                                        <?php echo btn_delete('user',$user_id); ?>
                                        </td>
                                            </tr>
                                    <?php } ?>
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
    </script>