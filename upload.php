<?php

    header('Access-Control-Allow-Origin: *'); // this!
    header('Access-Control-Allow-Headers: Content-Type'); // and this!
    //more code here
    
	$data_result = array();
	$type = $_GET['type'];
    if($type=='.jpg'||$type=='.png'||$type=='.gif'||$type=='.csv'||$type=='.pdf'){
        $myimg = $_FILES["document"]["name"];
        $path1 = "temp/" . time() . rand(10000, 99999).$type;
        if (move_uploaded_file($_FILES["document"]["tmp_name"], $path1)) {
            $data_result['result'] = 'true';
            $data_result['path'] = $path1;
        } else {
            $data_result['result'] = 'false';
            $data_result['msg'] = 'File is not uploading..';
        }
    }else{
        $data_result['result'] = 'false';
        $data_result['msg'] = 'Sorry file extention not matched!';
    }
    echo json_encode($data_result);

?>