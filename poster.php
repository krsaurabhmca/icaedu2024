<?php require_once('temp/sidebar.php'); 
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                   
	<div class="card ">
        <div class="card-header bg-secondary ">
             <h4 class="mb-sm-0 font-size-18 text-light">Create Poster</h4>
        </div>
        <div class="card-body">
			     <div class="row">
                <div class="col-md-4" >
                    <!-- Form Elements -->
                        <form action ='add_poster' id='insert_frm' enctype='multipart/form-data'>
                       
                        <div class="form-group">
                            <label>Post Title</label>
                            <input class="form-control" value='' name='post_title'  required  >
                        </div>
                        <input class="form-control" type='hidden' name='photo' id='targetimg'>
                      
                        <!--<div class="checkbox">-->
                        <!--    <label>-->
                        <!--    <input type="checkbox" value="yes" name='checksms'> Send On Whatsapp-->
                        <!--    </label>-->
                        <!--    <input class="form-control" type='hidden' name='post_image' id='targetimg'>-->
                        <!--</div>-->
                        
                        </form> 
                        <form id='uploadForm' enctype= 'multipart/form-data'>
                            <div class="form-group mb-3">
                                <label>Uplaod Photo </label>
                                <input type='file' name='uploadimg' id='uploadimg' accept='image' class='form-control'>
                                <p> JPG of 300px X 300px</p>
                            </div>
                            <div id='display'></div>
                        </form>
                     <button class="btn btn-danger" id='insert_btn'>Submit</button>
                    </div>  
                     
                
                <div class="col-lg-8">
                                
                                <!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                            <th>Post Date</th>
                                            <th>Post Title</th>
                                            <th>Photo </th>
                                            <th>Operation</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                    $res = get_all('poster' ,'*', array('created_by'=>$user_id));
                                    if($user_type=='ADMIN')
                                    {
                                       $res = get_all('poster'); 
                                    }
                                    foreach($res['data'] as $row)
                                    {
                                            echo "<tr>";
                                            $post_id=$row['id'];
                                            echo "<td> ". date('d M',strtotime($row['post_date'])) ."</td>";
                                            echo "<td> ". $row['post_title'] ."</td>";
                                            
                                            if ($row['photo'] =="")
                                            {
                                            echo "<td> NO ATTACHMENT </td>";
                                            }
                                            else {
                                            echo "<td> <a href='temp/upload/". $row['photo'] ."' target='new' download > Download </a></td>";
                                            }
                                          //  echo "<td> ". $row['status'] ."</td>";
                                    ?>
                                            <td align='right'>
                                            <a href='send_poster.php?poster_id=<?=$post_id?>' class='btn btn-info btn-sm' target='_blank'> <i class='fa fa-flag'></i> </a>
                                            
                                            <!--<button class='send_post btn btn-info btn-sm' data-post_id='<?=$post_id?>'> <i class='fa fa-flag'></i> </button>-->
                                            <?php echo btn_delete('poster',$post_id,'','fa fa-trash','yes'); ?>
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
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>

<?php require_once('temp/footer.php'); ?>