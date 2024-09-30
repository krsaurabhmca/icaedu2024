<?php
include 'student_temp/sm_header.php';
$syllabus= courseinfo($_SESSION['user_id'],'course_syllabus');
$subject_list = explode(',',$syllabus);
$finished_chapter = get_data('student',$user_id,'finished_chapter')['data'];

if(isset($_GET['link']))
{
    $data= decode($_GET['link']);
    $chapter_id =$data['chapter_id'];
    }
else{
    $chapter_id = current_docs($user_id);
}
$subject_id = get_data('chapter',$chapter_id,'subject_id')['data'];
$sub_name = get_data('subject',$subject_id,'sub_name')['data'];

?>
<style>
    .goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
     top: 0px !important; 
  -webkit-user-select: none;
     -moz-user-select: -moz-none;
      -ms-user-select: none;
          user-select: none;
    }

@media print {
         body {display:none;}
      }
</style>
<script>
document.addEventListener('contextmenu', event => event.preventDefault());
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <div class="sticky-row px-4 pt-2">
       
         <div class='col-md-10  d-none d-lg-block'>
            <button class='ls-modal btn btn-dark text-light btn-border border-dark' style='border-radius:25px'> <i class='fa fa-fw fa-book-open'> </i> <?= $sub_name; ?> </button>
        </div> 
        <div class='col-md-2 text-right mr-3 d-none d-lg-block'>
        <script>
            function googleTranslateElementInit() {
                new google.translate.TranslateElement(
                    {pageLanguage: 'en',
                    includedLanguages: "hi,en"
                    },
                    'google_translate_element'
                );
            }
        </script>
        <div id="google_translate_element" class='float-right'></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row" id='content-area'>
            <div class='col-md-3' style='height:500px;overflow-y:scroll;'>
                 <div class="accordion" id="accordionExample">
        <?php
            $i=1; 
            foreach($subject_list as $subject_id) {
             $sub_name = get_data('subject',$subject_id,'sub_name')['data'];
             $res2 = get_all('chapter','*', array('subject_id' =>$subject_id) ,
             ' id ');
             
             if($res2['count']>0)
                    {
                    $isshow ='';
                    $icon ='';
                    $exp = 'false';
                    $collapse ='';
                    if(subject_status($user_id, $subject_id) ==0)
                    {
                        $icon = ' <i class="fa fa-check-circle text-success"></i>';
                        
                    }
                    else if($subject_id ==$index['subject_id'])
                    {
                    $icon =  ' <i class="fa fa-book-open text-danger"></i>';
                        $isshow =' show ';
                        $exp ='true';
                        $collapse ='collapsed';
                    
                    } 
                 
            ?> 
            <div class="accordion-item mb-2">
                <h2 class="accordion-header" id="headingOne">
                
                <button class="accordion-button <?= $collapse?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i?>" aria-expanded="<?= $exp?>" aria-controls="collapseOne">
                    <b>Module <?= $i?>
                    <?php 
                        echo $icon;
                    ?>
                     </b> <br>
                    <h4><?= $sub_name . " <span class='badge' style='background:#0d0d58;'>".$res2['count'] ?></span> </h4>
                    
                   
                    
                </button>

                </h2>
                <div id="collapse<?= $i?>" class="accordion-collapse collapse <?= $isshow; ?> " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <ul class="list-group list-group-flush">
                    <?php 
                    
                   
                    foreach($res2['data'] as $chapter ) { 
                        $current_id =$chapter['id'];
						$link =encode('chapter_id='.$current_id);
                        if( $current_id ==$chapter_id )
                        {
                    ?>
                        <a href="study_material.php?link=<?php echo $link; ?>" class='list-group-item d-flex justify-content-between align-items-center'> 
                        <i class="fa fa-book-open text-danger"></i>
                        <?= $chapter['chapter_name']; ?>
                        
                        <span class="float-right"> <i class='fa fa-arrow-right'></i></span>
                        </a>
                    <?php
                        }
                        else if(find_in_string($finished_chapter, $current_id)=='YES')
                        {
                        ?>
                        <a href="study_material.php?link=<?php echo $link; ?>" class='list-group-item d-flex justify-content-between align-items-center'> 
                        <i class="fa fa-check text-success"></i>
                        <?= $chapter['chapter_name']; ?>
                        
                        <span class="float-right"> <i class='fa fa-arrow-right'></i></span>
                        </a>
                    <?php }
                      else{
                    ?>
                        
                        <!--<span class='list-group-item d-flex justify-content-between align-items-center' disabled> -->
                        
                        <!--<i class="fa fa-lock"></i>-->
                        <!--<?= $chapter['chapter_name']; ?>-->
                        
                        <!--<span class="float-right"> <i class='fa fa-arrow-right'></i></span>-->
                        <!--</span>-->
                        
                         <a href="study_material.php?link=<?php echo $link; ?>" class='list-group-item d-flex justify-content-between align-items-center'> 
                        <i class="fa fa-book"></i>
                        <?= $chapter['chapter_name']; ?>
                        
                        <span class="float-right"> <i class='fa fa-arrow-right'></i></span>
                        </a>
                    <?php
                        }
                    }
                    
                    ?>
                </ul>
                </div>
                </div>
            </div>
        <?php $i++; } }?> 
    </div> 
                
            </div>
            <div class='col-md-9'>
                <?php
                $index = get_chapter($user_id,$chapter_id);
                //print_r($index);
                $prev_id =$index['prev']; // prev_chapter($chapter_id);
                $next_id =$index['next']; // next_chapter($chapter_id);
               
                $docs = get_data('chapter',$chapter_id)['data'];
               // print_r($docs);
               
                if($prev_id !='0')
                {
                   $finished_chapter1 = add_to_string($finished_chapter,$prev_id);
                }
                $res9 = update_data('student',array('current_chapter'=> $chapter_id,'finished_chapter'=>$finished_chapter1), $user_id);
                
                $prev = get_data('chapter',$prev_id)['data'];
                $next = get_data('chapter',$next_id)['data'];
                
                $prev_link =encode('chapter_id='.$prev_id);
                $next_link =encode('chapter_id='.$next_id);
                
                echo "<h1> {$docs['chapter_name']} </h1>";
               
                echo "<div style='padding:24px;'>". base64_decode($docs['chapter_details']) ."</div>";
              
                $prev_chapter = strlen($prev['chapter_name']) > 50 ? substr($prev['chapter_name'],0,30)."..." : $prev['chapter_name'];
                $next_chapter = strlen($next['chapter_name']) > 50 ? substr($prev['chapter_name'],0,30)."..." : $next['chapter_name'];
                ?>
            </div>
        </div> 
        
        <div class='row bg-light text-center mt-3  '>
           
            <div class='col-lg-6 d-flex pt-3 align-item-start  justify-content-center' style='border-right:solid 1px #666;'>
                <?php if($prev_id !=0) {?>
                <a href='study_material.php?link=<?php echo $prev_link; ?>' class='row'>
                    <div class='cbut' >
                        <i class='fa fa-arrow-left fa-3x'></i>
                    </div>
                    <div class='lbut'>
                    Previous <br>
                    <span style='font-size:20px;'> <?= $prev_chapter ?> </span>
                    </div>
                </a>
                <?php } ?>
            </div>
            

           <div class='col-lg-6 d-flex pt-3 align-item-end text-right  justify-content-center'>
                <?php if($next_id !=0) {?>
                    <a href='study_material.php?link=<?php echo $next_link; ?>' class='row'>   
                    <div class='rbut'>
                    Next <br>
                    <span style='font-size:20px;'> <?= $next_chapter?> </span>
                    </div>
                    <div class='cbut'>
                        <i class='fa fa-arrow-right fa-3x'></i>
                    </div>
                    </a>
                <?php } ?>
            </div>
           
        </div>
      
    </div>



  <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/datatables.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- dashboard init -->
        <script src="assets/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <script src="assets/libs/jquery-validation/jquery.validate.min.js"></script>
        <script src="assets/js/notify.min.js"></script>
        <script src="assets/js/bootbox.all.js"></script>
        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/js/apprise.js"></script>

       