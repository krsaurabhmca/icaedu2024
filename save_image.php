<?php
include('temp/function.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'));

    $imageData = str_replace('data:image/png;base64,', '', $requestData->image);
    $imageData = str_replace(' ', '+', $imageData);
    $decodedImageData = base64_decode($imageData);

    $imageName = $requestData->name;
    $poster_id = $requestData->poster_id;
    
    $title = get_data('poster',$poster_id,'post_title')['data'];
    $mobile = get_data('center_details',$imageName,'center_mobile','center_code')['data'];
    $center_name = get_data('center_details',$imageName,'center_name','center_code')['data'];

    $filePath = 'poster/'.remove_space($imageName).".png"; // Provide the appropriate path

    file_put_contents($filePath, $decodedImageData);
    
    $response = array('url' => $imageName);
    $msg = $title ." - *". trim($center_name)."*";
    if($center_name!='')
    {
        wa_send('9431426600',$msg, $base_url.$filePath);
        //wa_send($mobile,$title, $base_url.$filePath);
    }
    
    echo json_encode($response);
    
}
?>
