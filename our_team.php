<?php require_once('temp/sidebar.php'); 
if(isset($_REQUEST['state_code']))
{
    $st_code =$_REQUEST['state_code'];
    $dt_code =$_REQUEST['dist_code'];
}
else{
    $dt_code =$st_code =null;
}
?>
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                     <!-- <div class="content p-4"> -->
                     	 <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18"> Our TEAM </h4>
                                    <div class="page-title-right">
                                    <form action ='' method='get'>
                                       <select name='state_code' onChange='getdistrict(this.value)' class='h6'>
                                        <option value=''> Select State</option>
                                        <?php dropdown_list('state','id','state_name',$st_code); ?>
                                    </select>
                                    <select name='dist_code' onChange='submit()' id='district-list' class='h6'>
                                        <option value=''> Select District </option>
                                        <?php dropdown_list('district','id','dist_name',$dt_code); ?>
                                    </select>
                                    
                                    </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
      <div class="card ">
        <div class="card-header <?php echo $bgClr ?> font-weight-bold">
           Select State & District to get Team Details.
        </div>
   
        <div class="card-body">
        <div class="row text-center">
            
            <?php
            if(isset($_GET['dist_code'])){
             $allc  = get_all('center_details','*', array('dist_code'=>$_GET['dist_code'], 'status'=>'ACTIVE'))['data'];
             $ct  = get_all('center_details','*', array('dist_code'=>$_GET['dist_code'], 'status'=>'ACTIVE'))['count'];
             if($ct>=1){
                foreach($allc as $cd)   
                {
                ?>
                <div class="col-md-3 border-right py-4">
                <div class='card bg-light'>
                    <div class="card-body" style='height:380px;'>
                    <span class="fa-stack fa-4x mb-4">
                        <img src='temp/upload/<?php echo $cd['director_photo']; ?>' class='rounded' width='90px' height='110px' height='150px'>
                    </span>
                    <br>
                    <h3 class='btn btn-warning'><?php echo $cd['center_director']; ?> </h3>
                    <h4><?php echo $cd['center_name']; ?></h4>
                    <ul class="my-4 list-unstyled text-secondary font-weight-bold">
                        <span class='text-primary'>Director</span>
                        <li class='text-'><?php echo $cd['center_address']; ?>,
                       <?php echo get_data('district',$cd['dist_code'],'dist_name','id')['data']; ?>, <?php echo get_data('state',$cd['state_code'],'state_name','id')['data']; ?></li>
                      
                    </ul>
                    <button class="btn btn-outline-danger"><?php echo $cd['center_code']; ?></button>
                   
                </div>
                </div>
                </div>
            <?php } } }?>
                
            </div>
            
           </div>
           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
