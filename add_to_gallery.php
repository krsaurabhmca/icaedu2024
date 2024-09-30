<?php require_once('temp/sidebar.php'); 
if(isset($_REQUEST['center_id']))
{
    $center_id = $_REQUEST['center_id'];
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
                                    <h4 class="mb-sm-0 font-size-18">Add an Image for Web Gallery</h4>
                                    <div class="page-title-right">
                              
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
            
    <div class="card mb-4">
        <div class="card-body">
                    <div class='row'>
                        <div class='col-lg-4'>
                        <form action ='add_to_gallery' method ='post' id='insert_frm' enctype='multipart/form-data'>
                
                        
                        <div class="form-group mb-3">
                            <label>Image Title</label>
                            
                            <input class="form-control" value='' name='image_title'  required  >
                            <input class="form-control" type='hidden' value='ACTIVE' name='status'  required  >
                        </div>
                        
                        <div class="form-group mb-3">
                                            <label>Image Status</label>
                                            <select class="form-control" name='image_status' required>
                                                <option value='SHOW'>SHOW</option>
                                                <option value='HIDE'>HIDE</option>
                                            </select>
                         <input class="form-control"  name='status' type='hidden' value='ACTIVE' required>
                         <input class="form-control"  name='image_url' type='hidden' id='targetimg' required>
                        </div>
                        
                        </form>     
                         <form id='uploadForm' enctype= 'multipart/form-data'>
                            <div id='display'></div>
                            <div class="form-group">
                                <label>Upload Photograph (Max 50 KB) </label>
                                <input type='file' class="form-control" name='uploadimg' id='uploadimg' accept='image'>
                                <br><small> Only Jpg and Png image upto 50KB. </small>
                            </div>
                            
                        </form>
                         <button class="btn btn-danger" id='insert_btn'>Upload Image</button>
                        </div>
                        
            
                        
                    <div class="col-lg-8">
                                
                                <!--    Basic Table  -->
                    <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                           
                                            <th>Image Title</th>
                                         <!--   <th>event Details</th>-->
                                            <th>Show Image </th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query ="select * from gallery where status='ACTIVE' order by id desc";
                                    $res = direct_sql($query);
                                    foreach($res['data'] as $row)
                                    {
                                        
                                        // print_r($row);
                                            echo "<tr>";
                                            $image_id=$row['id'];
                                        //  echo "<td> ". date('d M',strtotime($row['image_date'])) ."</td>";
                                            echo "<td> ". $row['image_title'] ."</td>";
                                        $path="temp/upload/". $row['image_url'];
                                        echo "<td> <img src='$path' alt='$path' height='40' width='40'></td>";
                                            echo "<td> ". $row['image_status'] ."</td>";
                                    ?>
                                          
                                            
                                         <td align='right'>
                                         <?php echo btn_delete('gallery',$image_id); ?>
                                    <!--<span class='delete_btn' data-table='gallery' data-id='<?php echo $image_id; ?>' data-pkey='image_id' title='Detete Image Permanently'> <i class='fa fa-trash'></i> </span>-->
                                    </td>
                                            </tr>
                                    <?php
                                    }
                                    ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
