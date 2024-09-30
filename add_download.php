<?php require_once('temp/sidebar.php'); 
 $table ='download';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
        $userId  = get_data('user',$center_code,'id','user_name')['data'];
    } else {
        $res  = insert_row($table);
        $id = $res['id'];
        $user_res  = insert_row('user');
        $userId = $user_res['id'];  
        $isedit = 'no';
        $data  = get_data($table, $id)['data'];
        extract($data);
    }
?>
<style type="text/css">
    #prsn{
        display: none;
    }
</style>
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
                                    <h4 class="mb-sm-0 font-size-18">Add New Centre</h4>

                                   <!--  <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Form Advanced</li>
                                        </ol>
                                    </div> -->

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                     <div class="card-header <?php echo $bgClr ?> font-weight-bold">
                                     Centre
                                 <span class='float-right' style='float:right'>
                                        <a href='manage_center'>  <button class="btn btn-dark btn-sm" > View All </button></a> 
                                         <?php 
                                        if($user_type=='CLIENT' and $wallet < $docs_fee)
                                        {
                                            echo "<span class='btn btn-danger'>Your wallet amount is $wallet kindly recharge. </span>";
                                        }
                                        else{
                                            echo '<button class="btn btn-primary btn-sm" id="update_btn" accesskey="s"> Save </button>';
                                        }
                                        ?>
                                    </span>
                                     </div>
          <div class="card-body">
               <form action ='add_center' id='update_frm' enctype='multipart/form-data'>
                
            <div class='row'>
             <div class='col-md-4'>

                       <div class="form-group mb-3">
                            <label>Enter Centre Code </label>
                            <input type='hidden' name='id' value='<?php echo $id; ?>'>
                            <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
                            <input type='hidden' name='userId' value='<?php echo $userId ?>'>
                           
                            <input class="form-control" placeholder="Must be 8 Digit"  maxlength='8' name='center_code' value="<?php echo $center_code ?>" autofocus required>
                        </div>  
                        <div class="form-group mb-3">
                            <label>Enter Centre Name </label>
                            <input class="form-control" placeholder="Full Name of Center" name='center_name' value="<?php echo $center_name ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Sl No. </label>
                            <input class="form-control" placeholder="Sl No." name='sl_no' value="<?php echo $sl_no ?>">
                        </div>                                          
                        <div class="form-group mb-3">
                            <label>Enter Director Name</label>
                            <input class="form-control" placeholder="Director Name Here" name='center_director' value="<?php echo $center_director ?>" required>
                        </div>
                        <!--<div class="form-group">
                            <label>Enter Father's Name</label>
                            <input class="form-control" placeholder="Father's Name" name='center_father' required>
                        </div>-->
                     <div class="form-group mb-3">
                            <label>Date of Agreement</label>
                            <input class="form-control"  type='date' name='center_dos' value="<?php echo $center_dos ?>">
                        </div>
                        <div class="form-group">
							<label>Ref By 
                                <input class="form-check-input" type="radio" name="ref_by"  value="center" onclick ='refcehck(this)' checked>
                                <label class="form-check-label">
                                Center
                                </label>
                                <input class="form-check-input" type="radio" name="ref_by"  value="person" onclick ='refcehck(this)'>
                                <label class="form-check-label" >
                                Person
                                </label>
                            </label>
                            <div id='cnter'>
							<select name='ref_id' id='ref_id' class='form-control form-select'>
								<option value=''> Select  Ref Center....</option>
								<?php dropdown_list('center_details','id','center_name',$ref_id,'center_code'); ?>
							</select>
                            </div>
                            <div id='prsn'>
                            <select name='ref_prsn_id'  class='form-control form-select'>
                                <option value=''> Select Ref Person....</option>
                                <?php dropdown_list('ref_user','id','ref_name',$ref_prsn_id); ?>
                            </select>
                            </div>
						</div>
                        
                    </div>
                    <div class="col-md-4 mb-3">                  
                                        
                                       
                        <div class="form-group mb-3">
                            <label>Enter Email Id. (Center/ Director) </label>
                            <input class="form-control" placeholder="someone@email.com" name='center_email' type='email' value="<?php echo $center_email ?>">
                        </div>
                       <div class="form-group mb-3">
                            <label>Enter Mobile No. (Center/ Director) </label>
                            <input class="form-control" placeholder="" name='center_mobile' maxlength='10' value="<?php echo $center_mobile ?>" required>
                        </div>
                                        
                        <div class="form-group mb-3">
                            <label>Address (center) </label>
                            <textarea class="form-control" rows="3" name='center_address'><?php echo $center_address ?></textarea>
                        </div> 
                        <div class="form-group mb-3">
                            <label>Display Address (center) </label>
                            <textarea class="form-control" rows="3" name='dp_address'><?php echo $dp_address ?></textarea>
                        </div>  
                        <div class="form-group mb-3">
                     <label class="control-label" for="inputError">Status </label>
                                
                        <select name='status' class='form-control form-select' required>
                           <option value=''> Select </option>
                            <?php dropdown($status_simple,$status); ?>
                        </select>
                        </div>
                        
                               
                    </div>
                        <div class="col-md-4">
                                        
                            <div class="form-group mb-3">
                                        <label class="control-label" for="inputError">Select State </label>
                                                
                                        <select name='state_code' id="state_code" onChange='getdistrict(this.value)' class='form-control form-select'>
                                           <option value=''> Select </option>
                                            <?php dropdown_list('state','id','state_name',$state_code); ?>
                                        </select>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                        <label  class="control-label" for="inputError">Select District </label> 
                                        <select name='dist_code' id='district-list' class='form-control form-select'>
                                            <option value=''> Select </option>
                                            <?php dropdown_list('district','id','dist_name',$dist_code); ?>
                                        </select>
                                        </div>
                            <input type="hidden" name='director_photo' id='targetimg' value="<?php echo $director_photo ?>" >
                            <input type='hidden' name='director_sign'  id='target_id_proof' value="<?php echo $director_sign ?>">
                            <input type='hidden' name='center_logo'  id='target_logo' value="<?php echo $center_logo ?>">
                            
                        </form>
                             <form id='uploadForm' enctype= 'multipart/form-data'>
                                <div class="form-group mb-3">
                                    <label>Upload Photograph (Max 50 KB) </label>
                                    <input class='form-control' type='file' name='uploadimg' id='uploadimg' accept='image'>
                                </div>
                                <div id='display'></div>
                                <input type="hidden" id='edit_img' value="<?php echo $director_photo ?>">
                            </form>
                            <hr>
                            <form id='id_proof' enctype= 'multipart/form-data'>
                                <div id='student_id_display'> </div>
                                <div class="form-group mb-3">
                                    <label>Upload Director Sign</label><br>
                                    <input class='form-control' type='file' name='uploadimg' id='upload_id_proof' accept='image'>
                                    <br><small> Upload Scan Copy of fresh Signature. </small>
                                    <input type="hidden" id='sign_img' value="<?php echo $director_sign ?>">
                                </div>
                            </form>
                            <form id='cntr_logo' enctype= 'multipart/form-data'>
                                <div id='logo_display'> </div>
                                <div class="form-group mb-3">
                                    <label>Upload Center Logo</label><br>
                                    <input class='form-control' type='file' name='uploadimg' id='upload_cntr_logo' accept='image'>
                                    <br><small> Upload Center Logo. </small>
                                    <input type="hidden" id='logoCntr' value="<?php echo $center_logo ?>">
                                </div>
                            </form>
                    </div>
                    </div>
                <!-- end select2 -->

            </div>

       <!--  <div class="card-footer bg-white">
        <hr>
       
        <hr>
        </div> -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script type="text/javascript">
    
    //===========Edited Image ==============//

$( document ).ready(function() {
 var edit_img = $('#edit_img').val();
 var sign_img = $('#sign_img').val();
 var cntr_logo = $('#logoCntr').val();
 var display = $('#display').val();

 if(edit_img !==''){
     $("#display").html("<img src='temp/upload/"+edit_img +"' width='100px' height='100px' class='img-thumbnail'>");
 }
 if(sign_img !='' ){
    $("#student_id_display").html("<img src='temp/upload/"+sign_img +"' width='100px' height='100px' class='img-thumbnail'>");
 }
 if(cntr_logo !=''){
     $("#logo_display").html("<img src='temp/upload/"+cntr_logo +"' width='100px' height='100px' class='img-thumbnail'>");
 }
//  if(edit_img !=='' && sign_img !='' ){
//  if(display !=''){
//     $("#display").html("<img src='temp/upload/"+obj.id +"' width='100px' height='100px' class='img-thumbnail'>");
// }else{
//     $("#display").html("<img src='temp/upload/"+edit_img +"' width='100px' height='100px' class='img-thumbnail'>");
//     $("#student_id_display").html("<img src='temp/upload/"+sign_img +"' width='100px' height='100px' class='img-thumbnail'>");
//     $("#logo_display").html("<img src='temp/upload/"+cntr_logo +"' width='100px' height='100px' class='img-thumbnail'>");
// }
// }
});
</script>
<script type="text/javascript">
    function refcehck(ele){
        var checkref = $(ele).val();
        if(checkref == 'person'){
            $('#cnter').css('display','none');
            $('#prsn').css('display','block');
        }else{
            $('#prsn').css('display','none');
            $('#cnter').css('display','block');
        }
    }
</script>