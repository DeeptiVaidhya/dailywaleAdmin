<?php
//more code here
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('date');
        header('Access-Control-Allow-Headers: Content-Type, Authoriz');
        header('Access-Control-Allow-Origin: *');
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
            header('HTTP/1.1 200 OK');
            die();
        }
    }

    public function genrate_token($tokenData){
        $str=implode(',', $tokenData);
        $token= base64_encode($str);
        return $token;
    }

    public function decode_token($str){
      // echo $str;exit;
        return true;
        
        // global $con;
        // $str_res      = base64_decode($str);
        
        // $user_data    = explode(',',$str_res);

        // $where = array(
        //     "user_mobile"  => $user_data[0],
        //     "device_token" => $user_data[1],
        // );
        // $result  = $this->Model->selectAllById('user',$where);
        // if($result){
        //     return true;
        // }else{
        //     return false;
        // }
    }

    function messageSend($message,$mobileNumber){
        //Your authentication key

        $authKey   = "75568A0nZox8z9548029cb";
        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId  = "DLYWLE";
        
        //Define route 
        $route = "4";
        
        //Prepare you post parameters
        // $postData = array(
        //     'authkey'    => $authKey,
        //     'mobiles'    => $mobileNumber,
        //     'message'    => $message,
        //     'sender'     => $senderId,
        //     'route'      => $route,
        //     'response'   => 'json',
        //     'ignoreNdnc' => 1
        // );
        
        //API URL
        // $url = "https://control.msg91.com/sendhttp.php";


        $postData = array(
            'authentic-key'    => '35354461696c7977616c653332361546505700',
            'number'           => $mobileNumber,
            'message'          => $message,
            'senderid'         => 'Dlywle',
            'route'            => '1',
            'response'         => 'json',
            'ignoreNdnc'       => 1
        );

        $url = "http://sms.mysmsmart.com/http-tokenkeyapi.php";
        
        
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
           CURLOPT_POSTFIELDS => $postData
        ));
        
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
        //get response
        $output = curl_exec($ch);
        
        curl_close($ch);

        $json = json_decode($output, true);
        return $json;
        //return $json['type'];
    }

    // Login
    public function login(){
        $post           = file_get_contents('php://input');
        $val            = json_decode($post);
        $mobile         = $val->mobile;
        $device_type    = $val->device_type;
        $device_token   = $val->device_token;
        date_default_timezone_set('Asia/Calcutta'); 
        $date      = date('Y-m-d');
        $wheredata=array(
            'user_mobile'    => $mobile 
        );
        $result=$this->Model->selectAllById('user',$wheredata);
        if ($result) {
            $tokenData = array();
            $tokenData['user_mobile']   = $mobile; 
            $tokenData['device_token']  = $device_token; 
            $data_result['token']       = $this->genrate_token($tokenData);
            $otp                        = mt_rand(100000,999999);
            $where_device = array(
                'user_id' => $result->user_id
            );

            if($mobile!='4084766514'){
	            $device_data = array(
	                'otp'          => $otp,
	                'device_type'  => $device_type,
	                'device_token' => $device_token
	            );
	            $res  = $this->Model->update($where_device,'user',$device_data);
	            if ($res) {
	                $msg    = $otp .' is your One Time Verification (OTP) code to confirm your phone number at Dailywale.'; 
	                if($this->messageSend($msg,$mobile)) {
	                    $resultData = $this->Model->selectAllbyId('user',$where_device);
	                    if ($resultData) {
	                        $data_result['result']       = 'true';
	                        $data_result['data']         = $resultData;
	                        $data_result['msg']          ='Login Successfully';
	                    }else{
	                        $data_result['result']       = 'false';
	                        $data_result['msg']          = 'Login not Successfully';
	                    }
	                }else{
	                    $data_result['result']           ='false';
	                    $data_result['msg']              ='Please Check your Registered Mobile number';
	                }
	            }else{
	                $data_result['result']               = 'false';
	                $data_result['msg']                  = 'User not Updated';
	            }
	        }else{
	        	$device_data = array(
	                'otp'          => '998110',
	                'device_type'  => 'ios',
	                'device_token' => '0'
	            );
	            $res  = $this->Model->update($where_device,'user',$device_data);
	        	$resultData = $this->Model->selectAllbyId('user',$where_device);
                if ($resultData) {
                    $data_result['result']       = 'true';
                    $data_result['data']         = $resultData;
                    $data_result['msg']          ='Login Successfully';
                }else{
                    $data_result['result']       = 'false';
                    $data_result['msg']          = 'Login not Successfully';
                }
	        }
        }else{
            //register
            $data = array(
                "user_mobile"  => $mobile,
                'device_type'  => $device_type,
                'device_token' => $device_token
            );
            $create = $this->Model->insert('user',$data);
            if ($create) {
                $mobile     = $mobile;
	            $where_data = array('user_mobile' => $mobile);
                if($mobile!='4084766514'){
	                $otp        = mt_rand(100000,999999);
	                $data       = array('otp' => $otp);
	                $show_info = $this->Model->update($where_data,'user',$data);
	                if ($show_info) {
	                    $msg    = 'your DailyWale otp is'." : ". $otp; 

	                    if($this->messageSend($msg,$mobile)) {
	                        $result   = $this->Model->selectAllById('user',$where_data);
	                        if ($result){
	                         // print_r($result);exit;
	                            $user_mobile = $result->user_mobile;
	                            $user_id = $result->user_id;
	                            $where_user_id= array(
	                                "user_id"   => $user_id,
	                            );
	                            $results_user_data    = $this->Model->selectAllById('user',$where_user_id);
	                            $dataNotification =array(
	                                "user_id"   => $user_id,
	                                "date_time" => $date,
	                                "title"     => "New Registered",
	                                "message"   => "Welcome to Dailywale,You have Registered  Successfully!! placed your first order!",
	                                "read_status"=> '0'
	                            );
	                            $createNotification = $this->Model->insert('notification',$dataNotification);
	                            if ($results_user_data) {
	                                if($results_user_data->device_type=='android'){
	                                    $a= $this->sendPushAndroid($results_user_data->device_token,'Message Alert','Welcome to Dailywale,You have Registered  Successfully!! placed your first order!!',$user_id,'0');
	                                }
	                                $data_result['result']     = true;
	                                $data_result['msg']     = 'Order Deliver';
	                            }else{
	                                $data_result['result']     = false;
	                                $data_result['msg']     = 'notification not created';
	                            }
	                             // print_r($createNotification);exit;
	                            $tokenData   = array();
	                            $tokenData['user_mobile']   = $mobile; 
	                            $tokenData['device_token']  = $device_token; 
	                            $data_result['token']       = $this->genrate_token($tokenData);
	                            $data_result['result']      = 'true';
	                            $data_result['data']        = $result;
	                            $data_result['msg']         = "You have Registered  Successfully";
	                        }else{
	                            $data_result['result']      = 'false';
	                            $data_result['msg']         = 'Not Registered User Found' ;
	                        } 
	                    }else{
	                        $data_result['result']          = 'false';
	                        $data_result['msg']             = "Message Not send Please check your Mobile Number";
	                    }
	                }else{
	                    $data_result['result']           = 'false';
	                    $data_result['msg']              = 'Otp Not Update Succesfully';
	                }
	            }else{
	            	$otp        = '998110';
	                $data       = array('otp' => $otp);
	                $show_info = $this->Model->update($where_data,'user',$data);
	            	$result   = $this->Model->selectAllById('user',$where_data);
                    if ($result){
                        $user_mobile = $result->user_mobile;
                        $user_id = $result->user_id;
                        $where_user_id= array(
                            "user_id"   => $user_id,
                        );
                        $results_user_data    = $this->Model->selectAllById('user',$where_user_id);
                        $dataNotification =array(
                            "user_id"   => $user_id,
                            "date_time" => $date,
                            "title"     => "New Registered",
                            "message"   => "Welcome to Dailywale,You have Registered  Successfully!! placed your first order!",
                            "read_status"=> '0'
                        );
                        $createNotification = $this->Model->insert('notification',$dataNotification);
                        if ($results_user_data) {
                            if($results_user_data->device_type=='android'){
                                $a= $this->sendPushAndroid($results_user_data->device_token,'Message Alert','Welcome to Dailywale,You have Registered  Successfully!! placed your first order!!',$user_id,'0');
                            }
                            $data_result['result']     = true;
                            $data_result['msg']     = 'Order Deliver';
                        }else{
                            $data_result['result']     = false;
                            $data_result['msg']     = 'notification not created';
                        }
                         // print_r($createNotification);exit;
                        $tokenData   = array();
                        $tokenData['user_mobile']   = $mobile; 
                        $tokenData['device_token']  = $device_token; 
                        $data_result['token']       = $this->genrate_token($tokenData);
                        $data_result['result']      = 'true';
                        $data_result['data']        = $result;
                        $data_result['msg']         = "You have Registered  Successfully";
                    }else{
                        $data_result['result']      = 'false';
                        $data_result['msg']         = 'Not Registered User Found' ;
                    }
	            }
            }else{
                $data_result['result']               = 'false';
                $data_result['msg']                  = ' Not Successfully Registered';
            }
        }
        echo json_encode($data_result);
    }

    //edit Profile
    public function edit_profile() {
        $post = file_get_contents('php://input');
        $val  = json_decode($post);
        $headers = $this->input->request_headers();
        if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
            
            if(isset($headers['Authoriz'])){
                $token=$headers['Authoriz'];
            }else{
                $token=$headers['authoriz'];
            }
             $decodedToken = $this->decode_token($token);
            if ($decodedToken != false) {
                $wheredata     = array(
                    'user_id'  => $val->user_id
                );
                $data = array(
                   'fname'      => $val->fname,
                   'lname'      => $val->lname,
                   'email'      => $val->email,
                   // 'gender' => $val->gender,
                   // 'dob'     => $val->dob,
                   'city_id'    => $val->city_id,
                   'zone_id'    => $val->zone,
                   'subzone_id' => $val->subzone,
                   'pincode'    => $val->pincode,
                   'address'    => $val->address,
                   'state_id'   => $val->state_id,
                   'user_status'=> '1'
                );

                $firstname  = $val->fname;
                $lastname   = $val->lname;
                $email      = $val->email;
                $city_id    = $val->city_id;
                $zone_id    = $val->zone;
                $subzone_id = $val->subzone;
                $pincode    = $val->pincode;
                $address    = $val->address;
                $state_id   = $val->state_id;
                if (!$firstname == '' && !$lastname == '' && !$email == '' && !$city_id == '' && !$zone_id == '' && !$subzone_id == '' && !$pincode == '' && !$address == '' && !$state_id == '') {
                
                    $show_status = $this->Model->update($wheredata,'user',$data);
                    if ($show_status) {
                        $result = $this->Model->selectAllById('user',$wheredata);
                        if ($result) {
                            $data_result['result']        = 'true';
                            $data_result['data']          = $result;
                            $data_result['msg']           = 'Profile Updated';
                        }else{
                            $data_result['result']        = 'false';
                            $data_result['msg']           = 'Sorry no Data Found';
                        }
                    }else{
                        $data_result['result']            = 'false';
                        $data_result['result']            = 'User Profile not Update';
                    }
                 
              }else{
                $data_result['result']       = 'false';
                $data_result['msg']          = "All field should not be blank";
              }
            }else{
                $data_result['result'] = 'false';
                $data_result['result'] = 'Invalid Token';
            }
        }else{
            $data_result['result']   = 'false';
            $data_result['msg']      = 'Invalid Token';
        }
        echo json_encode($data_result);
    }

    // check otp
    public function Check_otp() {
        $post = file_get_contents('php://input');
        $val  = json_decode($post);
        $headers = $this->input->request_headers();
        if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
            
            if(isset($headers['Authoriz'])){
                $token=$headers['Authoriz'];
            }else{
                $token=$headers['authoriz'];
            }
             $decodedToken = $this->decode_token($token);
            if ($decodedToken != false) {
                $wheredata = array(
                    'user_mobile'  => $val->mobile,
                    'otp'          => $val->otp
                );
                $result=$this->Model->selectAllById('user',$wheredata);
                if($result){
                    $data = array(
                       'otpStatus' => '1'
                    );
                    $show_status = $this->Model->update($wheredata,'user',$data);
                    $data_result['result']        = 'true';
                    $data_result['otpStatus']     = '1';
                    $data_result['msg']           = 'Your otp Matched';
                }else{
                    $data_result['result']        = 'false';
                    $data_result['msg']           = 'Sorry Your otp Not matched';
                }
            }else{
                $data_result['result']='Invalid Token';
            }
        }else{
            $data_result['result']='Invalid Token';
        }
        echo json_encode($data_result);
    }

    //State show
    public function state(){
        //$results    = $this->Model->select('state');
        $activeData = array(
                    "is_status" => "Online"
        );
        $results  = $this->Model->selectdata('state',$activeData);
        if ($results) {
            $data_result['result']     = 'true';
            $data_result['state']      = $results;
            $data_result['msg']        = 'State show Successfully';
        }else{
            $data_result['result']     = 'false';
            $data_result['msg']        = 'State not available';
        }
        echo json_encode($data_result);
    }

    //City show
    public function cityShow(){
        //$results    = $this->Model->select('city');
        $activeData = array(
                    "is_status" => "Online"
        );
        $results  = $this->Model->selectdata('city',$activeData);
        //print_r($results);die;
        if ($results) {
            $data_result['result']     = 'true';
            $data_result['city']       = $results;
            $data_result['msg']        = 'City show Successfully';
        }else{
            $data_result['result']     = 'false';
            $data_result['msg']        = 'City not available';
        }
        echo json_encode($data_result);
    }

    //City
    public function city(){
        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        $state      = $val->state;
        $where      = array("state_id" => $state);
        $results    = $this->Model->selectdata('city',$where);
        if ($results) {
            $data_result['result']  = 'true';
            $data_result['city']    = $results;
            $data_result['msg']     = 'City is available';
        }else{
            $data_result['result']  = 'false';
            $data_result['msg']     = 'City not available';
        }   
        echo json_encode($data_result);
    }

    //zone
    public function zone(){
        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        $city_id    = $val->city_id;
        $orderBy    = "zone_name asc";
        $where      = array("city_id" => $city_id, "is_status" => "Online");
        $results    = $this->Model->selectdata('zone',$where, $orderBy);
        if ($results) {
            $data_result['result']  = 'true';
            $data_result['zone']    = $results;
            $data_result['msg']     = 'Zone is available';
        }else{
            $data_result['result']  = 'false'; 
            $data_result['msg']     = 'Zone not available';
        }   
        echo json_encode($data_result);
    }

    //Banner
    public function bannerList(){
        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        // $results    = $this->Model->selectDrag('banners');
        $orderBy  = "position_order asc";
        $where      = array('banner_type' => 'Home');
        $results    = $this->Model->selectdata('banners', $where, $orderBy);
        if ($results) {
            foreach ($results as $key) {

                $whereItem = array(
                    "item_id" => $key['item_id']
                );

                $itemData  = $this->Model->selectAllById('item',$whereItem);
                $priceDecimal = (float)$itemData->item_price;
                $amt = (float)$itemData->item_price-(float)$itemData->item_discount;

                 $itemArray = array(
                    "itemId"            => $itemData->item_id,
                    "itemName"          => $itemData->item_name,
                    "itemImages"        => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$itemData->item_images,
                    "itemDesc"          => $itemData->item_desc,
                    "itemPrice"         =>  number_format($priceDecimal, 2),
                    "itemUnit"          => $itemData->item_unit,
                    "isOutOfStock"      => $itemData->is_out_of_stock,
                    "tax"               => $itemData->tax,
                    "isOnline"          => $itemData->is_online,
                    "is_available_six_to_twl"          => $itemData->is_available_six_to_twl,
                    "discount"          => $itemData->item_discount,
                    "actualPrice"       => $itemData->item_price,
                    "packaging"         => $itemData->packaging,
                    "delivery"          => $itemData->delivery,
                    "is_schedule"       => $itemData->is_schedule,
                    "discountPrice"     => $amt,
                );


                $banner[] = array(
                    "banner_id"         => $key['banner_id'],
                    "banner_type"       => $key['banner_type'],
                    "application_type"  => $key['application_type'],
                    "item_id"           => $key['item_id'],
                    "item"              => $itemArray,
                    "sub_cat_id"        => $key['sub_cat_id'],
                    "position_order"    => $key['position_order'],
                    "banner_image"      => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key['image']
                );
            }
            $data_result['result']      = 'true';
            $data_result['bannerData']  = $banner;
            $data_result['msg']         = 'Banner is available';
        }else{
            $data_result['result']      = 'false';
            $data_result['msg']         = 'Banner not available';
        }   
        echo json_encode($data_result);
    }

    //zone
    public function subZone(){
        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        $zone_id    = $val->zone_id;
        $orderBy    = "subzone_name asc";
        $where      = array("zone_id" => $zone_id);
        $results    = $this->Model->selectdata('subzone',$where, $orderBy);
        if ($results) {
            $data_result['result']  = 'true';
            $data_result['subZone'] = $results;
            $data_result['msg']     = 'Sub Zone is available';
        }else{
            $data_result['result']  = 'false';
            $data_result['msg']     = 'Sub Zone not available';
        }   
        echo json_encode($data_result);
    }

    //add to cart
    public function addToCart(){
        $post                = file_get_contents('php://input');
        $val                 = json_decode($post);
        $user_id             = $val->user_id;
        $quantity            = $val->quantity;
        $item_id             = $val->item_id;
        $price               = $val->price;
        $SelectedType        = $val->SelectedType;
        date_default_timezone_set('Asia/Calcutta'); 
        $date                = date('Y-m-d');
        $datatext            = array();
        $datatext['results'] = false;

        // print_r('de');
        // die;
        $headers = $this->input->request_headers();
        if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
            if(isset($headers['Authoriz'])){
                $token=$headers['Authoriz'];
            }else{
                $token=$headers['authoriz'];
            }
            $decodedToken = $this->decode_token($token);
            if ($decodedToken != false) {
                $whereItem = array("item_id"=>$item_id);
                $itm = $this->Model->selectAllbyId('item',$whereItem);
                if ($itm) {
                    $pkg = $itm->packaging;
                    $tax = $itm->tax;
                    $dlv = $itm->delivery;
                }else{
                    $pkg = 0;
                    $tax = 0;
                    $dlv = 0;
                }
                if ($SelectedType == "Tomorrow") {
                    $ScheduleOn   = 'Next Morning';
                    $datee         = date('Y-m-d',strtotime("+1 day"));
                    $total_amount1 = (int)$quantity*(float)$price;
                    $total_amount  = (( (float)$pkg + (float)$tax + (float)$dlv) * $quantity) + $total_amount1;
                    $data = array (
                        "user_id"       => $user_id,
                        "item_id"       => $item_id,
                        "quanity"       => $quantity,
                        "price"         => $price,
                        "total_price"   => $total_amount,
                        "scheduleOn"    => $ScheduleOn,
                        "scheduleType"  => $SelectedType,
                        "date_time"     => $datee
                    );
                    $cartInsert = $this->Model->insert('cart',$data);
                    if($cartInsert){
                        $lastId = $this->db->insert_id();
                        $wheredata = array("cart_id" => $lastId);
                        $cart   = $this->Model->selectAllById('cart',$wheredata);
                        if($cart){
                            $datatext['results']    = true;
                            $datatext['cartData']   = $cart;
                            $datatext['msg']        = "Product add Successfully";
                        }else{
                            $datatext['results']    = false;
                            $datatext['msg']        = "Product not show Successfully";
                        }
                    }else{
                        $datatext['results']        = false;
                        $datatext['msg']            = "Product not add Successfully";
                    }
                }else if ($SelectedType == "ScheduleDate") {
                    $dateCount = count($val->ScheduleOn);
                    for ($i=0; $i < count($val->ScheduleOn); $i++) { 
                        $ScheduleOn    = $val->ScheduleOn;
                        $total_amount1 = (int)$quantity*(float)$price;
                        $total_amount  = (((float)$pkg + (float)$tax + (float)$dlv) * $quantity) + $total_amount1;
                        $data = array (
                            "user_id"       => $user_id,
                            "item_id"       => $item_id,
                            "quanity"       => $quantity,
                            "price"         => $price,
                            "total_price"   => $total_amount,
                            "scheduleOn"    => $ScheduleOn[$i],
                            "scheduleType"  => $SelectedType,
                            "date_time"     => $ScheduleOn[$i]
                        );
                        $cartInsert = $this->Model->insert('cart',$data);
                    }
                    if($cartInsert){
                        $lastId = $this->db->insert_id();
                        $wheredata = array("cart_id" => $lastId);
                        $cart   = $this->Model->selectAllById('cart',$wheredata);
                        if($cart){
                            $datatext['results']    = true;
                            $datatext['cartData']   = $cart;
                            $datatext['msg']        = "Product add Successfully";
                        }else{
                            $datatext['results']    = false;
                            $datatext['msg']        = "Product not show Successfully";
                        }
                    }else{
                        $datatext['results']        = false;
                        $datatext['msg']            = "Product not add Successfully";
                    }
                }else {
                    $value = $val->ScheduleOn;
                    if ($value[0]->Sunday==true) {
                        $day[] = 'Sunday';
                    }
                    if ($value[0]->Monday==true) {
                        $day[] = 'Monday';
                    }
                    if ($value[0]->Tuesday==true) {
                        $day[] = 'Tuesday';
                    }
                    if ($value[0]->Wednesday==true) {
                        $day[] = 'Wednesday';
                    }
                    if ($value[0]->Thrusday==true) {
                        $day[] = 'Thursday';
                    }
                    if ($value[0]->Friday==true) {
                        $day[] = 'Friday';
                    }
                    if ($value[0]->Saturday==true) {
                        $day[] = 'Saturday';
                    }

                    $ScheduleOn = implode(',',$day);

                    $dateee       = date('Y-m-d');
                    $countDay     = count($day);
                    $total_amount1 = (int)$quantity*(float)$price;
                    $total_amount  = (((float)$pkg+(float)$tax+(float)$dlv) * $quantity)+$total_amount1;
                    for ($i=0; $i <count($day) ; $i++) { 
                        $dateee       = date('Y-m-d');
                        for ($j=0; $j < 4; $j++){
                            $dateee = date('Y-m-d', strtotime("next ".$day[$i], strtotime($dateee)));
                            $data = array (
                                "user_id"       => $user_id,
                                "item_id"       => $item_id,
                                "quanity"       => $quantity,
                                "price"         => $price,
                                "total_price"   => $total_amount,
                                "scheduleOn"    => $day[$i],
                                "scheduleType"  => $SelectedType,
                                "date_time"     => $dateee
                            );
                            $cartInsert = $this->Model->insert('cart',$data);
                            if($cartInsert){
                                $lastId = $this->db->insert_id();
                                $wheredata = array("cart_id" => $lastId);
                                $cart   = $this->Model->selectAllById('cart',$wheredata);
                                if($cart){
                                    $datatext['results']    = true;
                                    $datatext['cartData']   = $cart;
                                    $datatext['msg']        = "Product add Successfully";
                                }else{
                                    $datatext['results']    = false;
                                    $datatext['msg']        = "Product not show Successfully";
                                }
                            }else{
                                $datatext['results']        = false;
                                $datatext['msg']            = "Product not add Successfully";
                            }
                        }
                    }
                }
            }else{
                $datatext['results']        = false;
                $datatext['msg']='Invalid Decode Token';
            }
        }else{
            $datatext['results']        = false;
            $datatext['msg']='Invalid Token';
        }
        echo json_encode($datatext);
    }


    //add to cart
    public function addToCart1(){
        $post                = file_get_contents('php://input');
        $val                 = json_decode($post);
        $user_id             = $val->user_id;
        $quantity            = $val->quantity;
        $item_id             = $val->item_id;
        $price               = $val->price;
        $SelectedType        = $val->SelectedType;
        date_default_timezone_set('Asia/Calcutta'); 
        $date                = date('Y-m-d');
        $datatext            = array();
        $datatext['results'] = false;
        $headers = $this->input->request_headers();
        if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
            if(isset($headers['Authoriz'])){
                $token=$headers['Authoriz'];
            }else{
                $token=$headers['authoriz'];
            }
            $decodedToken = $this->decode_token($token);
            if ($decodedToken != false) {
                $whereItem = array("item_id"=>$item_id);
                $itm = $this->Model->selectAllbyId('item',$whereItem);
                if ($itm) {
                    $pkg = $itm->packaging;
                    $tax = $itm->tax;
                    $dlv = $itm->delivery;
                }else{
                    $pkg = 0;
                    $tax = 0;
                    $dlv = 0;
                }
                if ($SelectedType == "Tomorrow") {
                    $ScheduleOn   =  date('Y-m-d',strtotime("+1 day")); //'Next Morning';
                    $datee         = date('Y-m-d',strtotime("+1 day"));
                    $total_amount1 = (int)$quantity*(float)$price;
                    $total_amount  = (( (float)$pkg + (float)$tax + (float)$dlv) * $quantity) + $total_amount1;
                    $data = array (
                        "user_id"       => $user_id,
                        "item_id"       => $item_id,
                        "quanity"       => $quantity,
                        "price"         => $price,
                        "total_price"   => $total_amount,
                        "scheduleOn"    => $ScheduleOn,
                        "scheduleType"  => 'ScheduleDate',
                        "date_time"     => $datee
                    );
                    $cartInsert = $this->Model->insert('cart',$data);
                    if($cartInsert){
                        $lastId = $this->db->insert_id();
                        $wheredata = array("cart_id" => $lastId);
                        $cart   = $this->Model->selectAllById('cart',$wheredata);
                        if($cart){
                            $datatext['results']    = true;
                            $datatext['cartData']   = $cart;
                            $datatext['msg']        = "Product add Successfully";
                        }else{
                            $datatext['results']    = false;
                            $datatext['msg']        = "Product not show Successfully";
                        }
                    }else{
                        $datatext['results']        = false;
                        $datatext['msg']            = "Product not add Successfully";
                    }
                }else if ($SelectedType == "ScheduleDate") {
                    $dateCount = count($val->ScheduleOn);
                    for ($i=0; $i < count($val->ScheduleOn); $i++) { 
                        $ScheduleOn    = $val->ScheduleOn;
                        $total_amount1 = (int)$quantity*(float)$price;
                        $total_amount  = (((float)$pkg + (float)$tax + (float)$dlv) * $quantity) + $total_amount1;
                        $data = array (
                            "user_id"       => $user_id,
                            "item_id"       => $item_id,
                            "quanity"       => $quantity,
                            "price"         => $price,
                            "total_price"   => $total_amount,
                            "scheduleOn"    => $ScheduleOn[$i],
                            "scheduleType"  => $SelectedType,
                            "date_time"     => $ScheduleOn[$i]
                        );
                        $cartInsert = $this->Model->insert('cart',$data);
                    }
                    if($cartInsert){
                        $lastId = $this->db->insert_id();
                        $wheredata = array("cart_id" => $lastId);
                        $cart   = $this->Model->selectAllById('cart',$wheredata);
                        if($cart){
                            $datatext['results']    = true;
                            $datatext['cartData']   = $cart;
                            $datatext['msg']        = "Product add Successfully";
                        }else{
                            $datatext['results']    = false;
                            $datatext['msg']        = "Product not show Successfully";
                        }
                    }else{
                        $datatext['results']        = false;
                        $datatext['msg']            = "Product not add Successfully";
                    }
                }else {
                    $value = $val->ScheduleOn;
                    if ($value[0]->Sunday==true) {
                        $day[] = 'Sunday';
                    }
                    if ($value[0]->Monday==true) {
                        $day[] = 'Monday';
                    }
                    if ($value[0]->Tuesday==true) {
                        $day[] = 'Tuesday';
                    }
                    if ($value[0]->Wednesday==true) {
                        $day[] = 'Wednesday';
                    }
                    if ($value[0]->Thrusday==true) {
                        $day[] = 'Thursday';
                    }
                    if ($value[0]->Friday==true) {
                        $day[] = 'Friday';
                    }
                    if ($value[0]->Saturday==true) {
                        $day[] = 'Saturday';
                    }

                    $ScheduleOn = implode(',',$day);

                    $dateee       = date('Y-m-d');
                    $countDay     = count($day);
                    $total_amount1 = (int)$quantity*(float)$price;
                    $total_amount  = (((float)$pkg+(float)$tax+(float)$dlv) * $quantity)+$total_amount1;
                    for ($i=0; $i < count($day); $i++) { 
                        $dateee       = date('Y-m-d');
                        for ($j=0; $j < 4; $j++){
                            $dateee = date('Y-m-d', strtotime("next ".$day[$i], strtotime($dateee)));
                            $data = array (
                                "user_id"       => $user_id,
                                "item_id"       => $item_id,
                                "quanity"       => $quantity,
                                "price"         => $price,
                                "total_price"   => $total_amount,
                                "scheduleOn"    => $day[$i],
                                "scheduleType"  => $SelectedType,
                                "date_time"     => $dateee
                            );
                            $cartInsert = $this->Model->insert('cart',$data);
                            if($cartInsert){
                                $lastId = $this->db->insert_id();
                                $wheredata = array("cart_id" => $lastId);
                                $cart   = $this->Model->selectAllById('cart',$wheredata);
                                if($cart){
                                    $datatext['results']    = true;
                                    $arr[] = $cart;
                                    $datatext['cartData']   = $arr;
                                    $datatext['msg']        = "Product add Successfully";
                                }else{
                                    $datatext['results']    = false;
                                    $datatext['msg']        = "Product not show Successfully";
                                }
                            }else{
                                $datatext['results']        = false;
                                $datatext['msg']            = "Product not add Successfully";
                            }
                        }
                    }
                }
            }else{
                $datatext['results']        = false;
                $datatext['msg']='Invalid Decode Token';
            }
        }else{
            $datatext['results']        = false;
            $datatext['msg']='Invalid Token';
        }
        echo json_encode($datatext);
    }

    //add to cart
    public function removeToCart(){
        $post                = file_get_contents('php://input');
        $val                 = json_decode($post);
        $cart_id             = $val->cart_id;
        $datatext            = array();
        $datatext['results'] = false;
        $headers = $this->input->request_headers();
        if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
            if(isset($headers['Authoriz'])){
                $token=$headers['Authoriz'];
            }else{
                $token=$headers['authoriz'];
            }
            $decodedToken = $this->decode_token($token);
            if ($decodedToken != false) {
                $wheredata = array("cart_id" => $cart_id);
                $cartSelect = $this->Model->selectAllById('cart',$wheredata);
                if ($cartSelect) {
                    $cart = $this->Model->deleterec($wheredata,'cart');
                    if($cart){
                        $datatext['results']    = true;
                        $datatext['msg']        = "Cart Item Remove Successfully";
                    }else{
                        $datatext['results']    = false;
                        $datatext['msg']        = "Cart Item not Remove Successfully";
                    }
                }else{
                    $datatext['results']        = false;
                    $datatext['msg']            = "Cart Item not Available";
                }
            }else{
                $data_result['result']='Invalid Decode Token';
            }
        }else{
            $data_result['result']='Invalid Token';
        }    
        echo json_encode($datatext);
    }


        //add to cart
    public function removeAllCart(){
        $post                = file_get_contents('php://input');
        $val                 = json_decode($post);
        $user_id             = $val->user_id;
        $datatext            = array();
        $datatext['results'] = false;
        $headers = $this->input->request_headers();
        if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
            if(isset($headers['Authoriz'])){
                $token=$headers['Authoriz'];
            }else{
                $token=$headers['authoriz'];
            }
            $decodedToken = $this->decode_token($token);
            if ($decodedToken != false) {
                $wheredata = array("user_id" => $user_id,"cart_status" =>'0');
                $cartSelect = $this->Model->selectAllById('cart',$wheredata);
                if ($cartSelect) {
                    $cart = $this->Model->deleterec($wheredata,'cart');
                    if($cart){
                        $datatext['results']    = true;
                        $datatext['msg']        = "Cart Item Remove Successfully";
                    }else{
                        $datatext['results']    = false;
                        $datatext['msg']        = "Cart Item not Remove Successfully";
                    }
                }else{
                    $datatext['results']        = false;
                    $datatext['msg']            = "Cart Item not Available";
                }
            }else{
                $data_result['result']='Invalid Decode Token';
            }
        }else{
            $data_result['result']='Invalid Token';
        }    
        echo json_encode($datatext);
    }

    //cat and subcat show
    public function catAndSubCat(){
        $orderBy  = "position_order asc";
        $activeData = array(
                    "is_status" => "Online"
        );
        $results  = $this->Model->selectdata('cat',$activeData,$orderBy);
       // $results  = $this->Model->select('cat', $orderBy);
        if ($results) {
            foreach ($results as $key) {
                $catId = $key['cat_id'];
                $whereData = array(
                    "cat_id" => $catId,
                    "is_status" => "Online"
                );
                $data = array();
                $subCateResult  = $this->Model->selectdata('sub_cat',$whereData, $orderBy);
                if ($subCateResult) {
                    foreach ($subCateResult as $value) {
                        $data[] = array(
                            "subCategoryId"   =>  $value['sub_cat_id'],
                            "subCategoryName" =>  $value['sub_cat_name'],
                            "topOrderPostion" =>  $value['position_order'],
                            "subCatIcon"      =>  'http://dailywale.com/dailywaleAdmin/uploads/user/'.$value['icon']
                        );
                    }
                    $catData[] = array(
                        "categoryId"      => $catId,
                        "categoryName"    => $key['cat_name'],
                        "categoryType"    => $key['type'],
                        "positionOrder"    => $key['position_order'],
                        "categoryIcon"    => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key['icon'],
                        "subCategoryData" => $data
                    );
                }else{
                    $catData[] = array(
                        "categoryId"      => $catId,
                        "categoryName"    => $key['cat_name'],
                        "categoryType"    => $key['type'],
                        "positionOrder"    => $key['position_order'],
                        "categoryIcon"    => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key['icon'],
                        "subCategoryData" => "No Data"
                    );
                }
                $data_result['result']     = 'true';
                $data_result['CatSubCat']  = $catData;
                $data_result['msg']        = 'category show Successfully';
            }
        }else{
            $data_result['result'] = 'false';
            $data_result['msg']    = 'category not available';
        }   
        echo json_encode($data_result);
    }

    //popular item list
    public function popularItemListing(){
        $post      = file_get_contents('php://input');
        $val       = json_decode($post); 
        $orderBy  = "position_order asc";       
        $results    = $this->Model->select('popular_items', $orderBy);
        if ($results) {
            foreach ($results as $key) {
                $whereData = array(
                    'item_id' => $key['item_id']
                );
                $item  = $this->Model->selectdata('item',$whereData);
                if ($item) {
                    foreach ($item as $value) {
                        $priceDecimal = (float)$value['item_price'];
                        $amt = (float)$value['item_price']-(float)$value['item_discount'];
                        // $amt = $value['item_price']-$price;
                        $whereSubCat = array("sub_cat_id" => $value['sub_cat_id']);
                        $sub_cat  = $this->Model->selectdata('sub_cat',$whereSubCat);
                        if ($sub_cat) {
                            foreach ($sub_cat as $subcate) {
                                $subCatArray      = array();
                                $itemArray = array();
                                $where = array("cat_id" => $subcate['cat_id']);
                                $cat  = $this->Model->selectdata('cat',$where);
                                if($cat){
                                    foreach ($cat as $category) {
                                        $catArray = array();
                                        $catArray[] = array(
                                            "cat_id"      => $category['cat_id'],
                                            "cat_name"    => $category['cat_name'],
                                            "icon"        => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$category['icon']
                                        );
                                    }
                                    $subCatArray[]      = array(
                                        "sub_cat_id"     => $subcate['sub_cat_id'],
                                        "sub_cat_name"   => $subcate['sub_cat_name'],
                                        "sub_cat_icon"   => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$subcate['icon'],
                                        "category"       => $catArray
                                    );
                                }else{
                                    $subCatArray[]      = array(
                                        "sub_cat_id"     => $subcate['sub_cat_id'],
                                        "sub_cat_name"   => $subcate['sub_cat_name'],
                                        "sub_cat_icon"   => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$subcate['icon'],
                                        "category"       => 'No Category'
                                    );  
                                }
                            }
                            $itemArray[] = array(
                                "itemId"            => $value['item_id'],
                                "itemName"          => $value['item_name'],
                                "itemImages"        => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$value['item_images'],
                                "itemDesc"          => $value['item_desc'],
                                "itemPrice"         => number_format($priceDecimal, 2),
                                "itemUnit"          => $value['item_unit'],
                                "isOutOfStock"      => $value['is_out_of_stock'],
                                "tax"               => $value['tax'],
                                "isOnline"          => $value['is_online'],
                                "is_available_six_to_twl"          => $value['is_available_six_to_twl'],
                                "discount"          => $value['item_discount'],
                                "actualPrice"       => $value['item_price'],
                                "packaging"         => $value['packaging'],
                                "delivery"          => $value['delivery'],
                                "is_schedule"       => $value['is_schedule'],
                                "discountPrice"     => $amt,
                                "subCategory"       => $subCatArray
                            );
                        }else{
                            $itemArray[] = array(
                                "itemId"            => $value['item_id'],
                                "itemName"          => $value['item_name'],
                                "itemImages"        => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$value['item_images'],
                                "itemDesc"          => $value['item_desc'],
                                "itemPrice"         => number_format($priceDecimal, 2),
                                "itemUnit"          => $value['item_unit'],
                                "isOutOfStock"      => $value['is_out_of_stock'],
                                "tax"               => $value['tax'],
                                "packaging"         => $value['packaging'],
                                "delivery"          => $value['delivery'],
                                "is_schedule"       => $value['is_schedule'],
                                "isOnline"          => $value['is_online'],
                                "is_available_six_to_twl"          => $value['is_available_six_to_twl'],
                                "discount"          => 'No Discount',
                                "actualPrice"       => 'No Price',
                                "discountPrice"     => 'No Amount',
                                "subCategory"       => 'No Sub-Category'
                            );
                        }
                    }
                    $popularArray[]   = array(
                        "popularId"       => $key['pop_pro_id'],
                        "positionOrder"   => $key['position_order'],
                        "valid_date"      => $key['valid_date'],
                        "item"            => $itemArray
                    );
                $data_result['result']        = 'true';
                $data_result['PopularData']   = $popularArray;
                $data_result['msg']           = 'Popular Item List Successfully';
                }
                
            }
        }else{
            $data_result['result'] = 'false';
            $data_result['msg']    = 'Popular Item List not available';
        }   
        echo json_encode($data_result);
    }

    //cart show acc to user
    public function cartItemList(){
        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        $user_id    = $val->user_id;
        $whereItem  = array("user_id" => $user_id,"cart_status"=>'0');
        $orderBy  = "date_time asc";
        $totalPrice1 = 0;
        $results    = $this->Model->selectdata('cart',$whereItem, $orderBy);
        if ($results) {
            $oldCartCount = 0;
            foreach ($results as $key) {

                $scheduleDate = $key['scheduleOn'];

                if(strtotime($scheduleDate)>strtotime(date('Y-m-d'))){
                    $totalPrice1 += $key['total_price'];
                    $totalPrice = round($totalPrice1, 2);
                    $whereData = array(
                        "item_id" => $key['item_id']
                    );
                    $itemResult  = $this->Model->selectAllById('item',$whereData);
                    
                    if ($itemResult) {
                        $total1     = (int)$key['quanity']*(float)$key['price'];
                        $taxTotal1 = $total1+ (( (float)$itemResult->tax + (float)$itemResult->packaging + (float)$itemResult->delivery) * $key['quanity']);
                        $taxTotal    = round($taxTotal1, 2);
                        $total       = round($total1, 2);
                        $where       = array("user_id" => $user_id);

                        if($itemResult->tax==null){
                            $itemResult->tax = 0;
                        }
                        
                        $itemArray[] = array(
                            "cart_id"            => $key['cart_id'],
                            "user_id"            => $key['user_id'],
                            "quanity"            => $key['quanity'],
                            "price"              => $key['price'],
                            "qtyPriceTotal"      => $total,
                            "taxTotal"           => $taxTotal,
                            "scheduleOn"         => $key['scheduleOn'],
                            "scheduleType"       => $key['scheduleType'],
                            "scheduleTime"       => 'Before 9:00 Am',
                            "order_detail"       => $key['order_detail'],
                            "item_type"          => $key['item_type'],
                            "deliverDate"        => date('d-m-Y',strtotime($key['date_time'])),
                            "itemId"             => $itemResult->item_id,
                            "itemName"           => $itemResult->item_name,
                            "itemImages"         => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$itemResult->item_images,
                            "itemDesc"           => $itemResult->item_desc,
                            "itemUnit"           => $itemResult->item_unit,
                            "isOutOfStock"       => $itemResult->is_out_of_stock,
                            "tax"                => $itemResult->tax,
                            "packaging"          => $itemResult->packaging,
                            "delivery"           => (float)$key['quanity'] * (float)$itemResult->delivery,
                            "is_schedule"        => $itemResult->is_schedule,
                            "isOnline"           => $itemResult->is_online
                        );
                    }
                    $data_result['totalPrice']          = $totalPrice;
                    $data_result['itemData']            = $itemArray;
                    
                    $msg = 'Not Payment';
                    $userResult  = $this->Model->selectAllById('user',$where);
                    $walAmount   = $userResult->wallet_amount;
                    if ((float)$walAmount>=(float)$totalPrice) {
                        $msg = 'Payment';
                    }
                    $data_result['walletAmountStatus']  = $msg;
                }else{
                    $cart_id = $key['cart_id'];
                    $wheredata = array("cart_id" => $cart_id);
                    $cart = $this->Model->deleterec($wheredata,'cart');
                    $oldCartCount += $oldCartCount + 1;
                    $data_result['Remove']   = $oldCartCount.' Old was removed';
                }
                $data_result['result']              = 'true';
                $data_result['msg']                 = 'Cart Item show Successfully';
            }

        }else{
            $data_result['result'] = 'false';
            $data_result['msg']    = 'Item not available';
        }   
        echo json_encode($data_result);
    }

    //wallet amount show
    public function wallet(){
        $post                = file_get_contents('php://input');
        $val                 = json_decode($post);
        $user_id             = $val->user_id;
        $datatext            = array();
        $datatext['results'] = false;
        // $headers = $this->input->request_headers();
        // if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
        //     if(isset($headers['Authoriz'])){
        //         $token=$headers['Authoriz'];
        //     }else{
        //         $token=$headers['authoriz'];
        //     }
        //     $decodedToken = $this->decode_token($token);
        //     if ($decodedToken != false) {
                $wheredata = array("user_id" => $user_id);
                $wal = $this->Model->selectAllById('user',$wheredata);
                if ($wal) {
                    $wheredata1 = array("user_id" => $user_id);
                    $orderby = '"trans_id", "desc"';
                    $results   = $this->Model->selectWalletOrderBy($user_id);
                    foreach ($results as $key) {
                        $get_date = $key->date_time;
                        $newDate = date("d-m-Y", strtotime($get_date));
                        $dataget[] = array(
                            'trans_id'   => $key->trans_id,
                            'user_id'    => $key->user_id,
                            'amount'     => $key->amount,
                            'pay_by'     => $key->pay_by,
                            'detail'     => $key->detail,
                            'date_time'  => $newDate
                        );
                        $datatext['data']           = $dataget;
                    }
                    $datatext['results']        = true;
                    $datatext['wallet']         = number_format($wal->wallet_amount, 2);
                    $datatext['msg']            = "Wallet Amount";

                }else{
                    $datatext['results']        = false;
                    $datatext['msg']            = "Wallet Amount not Available";
                }
        //     }else{
        //         $data_result['result']='Invalid Decode Token';
        //     }
        // }else{
        //     $datatext['result']='Invalid Token';
        // }    
        echo json_encode($datatext);
    }

    //add Wallet Amount
    public function addWallet(){
        $post                = file_get_contents('php://input');
        $val                 = json_decode($post);
        $user_id             = $val->user_id;
        $walAmount           = $val->walAmount;
        $datatext            = array();
        $datatext['results'] = false;
        $headers = $this->input->request_headers();
        if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
            if(isset($headers['Authoriz'])){
                $token=$headers['Authoriz'];
            }else{
                $token=$headers['authoriz'];
            }
            $decodedToken  = $this->decode_token($token);
            if ($decodedToken != false) {
                date_default_timezone_set('Asia/Calcutta'); 
                $date      = date('Y-m-d');
                $data      = array("user_id"=>$user_id,"walletAmount"=>$walAmount,"walletStatus"=>'credited',"created_at"=>$date);
                $walInsert = $this->Model->insert('wallet',$data);
                if ($walInsert) {
                    $wheredata = array("user_id" => $user_id);
                    $wal = $this->Model->selectAllById('user',$wheredata);
                    if ($wal) {
                        $amount = (float)$wal->wallet_amount + (float)$walAmount;
                        $data = array(
                            'wallet_amount' => $amount
                            );
                        $res  = $this->Model->update($wheredata,'user',$data);
                        if ($res) {
                            $datatext['results']        = true;
                            $datatext['wallet']         = (float)$amount;
                            $datatext['msg']            = "Wallet Amount";
                        }else{
                            $datatext['results']        = false;
                            $datatext['msg']            = "Wallet Amount not Added";
                        }
                    }else{
                        $datatext['results']        = false;
                        $datatext['msg']            = "User not Available";
                    }
                }else{
                    $datatext['results']        = false;
                    $datatext['msg']            = "Wallet Amount not Inserted";
                }
            }else{
                $data_result['result']='Invalid Decode Token';
            }
        }else{
            $data_result['result']='Invalid Token';
        }    
        echo json_encode($datatext);
    }

    //cart show acc to user
    public function walletTransaction(){
        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        $user_id    = $val->user_id;
        $where      = array("user_id" => $user_id);
        $results    = $this->Model->selectdata('wallet',$where);
        if ($results) {
            $data_result['result'] = 'true';
            $data_result['data']   = $results ;
            $data_result['msg']    = 'Item not available';
        }else{
            $data_result['result'] = 'false';
            $data_result['msg']    = 'Item not available';
        }   
        echo json_encode($data_result);
    }

    public function test(){
        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        $item_id    = $val->item_id;
        //$item_id=$key1['item_id'];
        $where_item = array(
            "item_id" =>$item_id
            );
        $item_result =$this->Model->selectAllById1('item',$where_item); 
        if($item_result->is_schedule=='1' && $item_result->delivery_days!='0'){

            $delivery_days_result=$item_result->delivery_days;

            for ($i=1; $i < $delivery_days_result; $i++) { 
                $increse="+".$i." day";
                $Date='2019-08-15';
                $datee         = date('Y-m-d',strtotime($Date.$increse));
                $data = array (
                    "user_id"       => '226',
                    "item_id"       => '108',
                    "quanity"       => '1',
                    "price"         => '10',
                    "total_price"   => '10',
                    "scheduleOn"    => $datee,
                    "scheduleType"  => 'ScheduleDate',
                    "date_time"     => $datee
                );
                $cartInsert = $this->Model->insert('cart',$data);
                $array1[] = $cartInsert;
            }
        } 
                   

        //echo json_encode($data_result);
    }



    
    

    //order insert payment status = 1
    public function order(){
        $post=file_get_contents('php://input');
        $val =json_decode($post);
        
        $user_id            = $val->user_id;
        $total_amount       = $val->total_amount;
        
        $discount = "";
        $coupon_code = "";
        
        if(isset($val->discount)){
            $discount = $val->discount;
        }
        if(isset($val->coupon_code)){
            $coupon_code = $val->coupon_code;
        }
        
        
        date_default_timezone_set('Asia/Calcutta'); 
        $date                = date('Y-m-d');
        $datatext            = array();
        // $datatext['results'] = false;
        $headers = $this->input->request_headers();
        if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
            if(isset($headers['Authoriz'])){
                $token=$headers['Authoriz'];
            }else{
                $token=$headers['authoriz'];
            }
            $decodedToken = $this->decode_token($token);
            if ($decodedToken != false) {
                $whereUser = array("user_id"=>$user_id);
            
                $user  = $this->Model->selectAllById('user',$whereUser);
                 // print_r($user);exit;
                if ($user) {
                     $zone    = $user->zone_id;
                     $subzone = $user->subzone_id;
                    //$zone = '';
                    //$subzone = '';
                    $name    = $user->fname.' '.$user->lname;
                    $mobile  = $user->user_mobile;
                }else{
                    $zone    = '';
                    $subzone = '';
                    $name    = '';
                    $mobile  = '';
                }
                $where = array(
                    "cart_status" => 0,
                    "user_id"     => $user_id
                );
                $cart  = $this->Model->selectAllByIdarray('cart',$where);
                if ($cart) {
                    foreach ($cart as $key1) {

                            $where_item = array(
                                "item_id" =>$key1['item_id']
                                );
                            $item_result =$this->Model->selectAllById1('item',$where_item); 
                            if($item_result->is_schedule=='1' && $item_result->delivery_days!='0'){

                                $delivery_days_result=$item_result->delivery_days;

                                for ($i=1; $i < $delivery_days_result; $i++) { 
                                    $increse="+".$i." day";
                                    $Date=$key1['scheduleOn'];
                                    $datee         = date('Y-m-d',strtotime($Date.$increse));
                                    $data = array (
                                        "user_id"       => $key1['user_id'],
                                        "item_id"       => $key1['item_id'],
                                        "quanity"       => $key1['quanity'],
                                        "price"         => '0',
                                        "total_price"   => '0',
                                        "scheduleOn"    => $datee,
                                        "scheduleType"  => 'ScheduleDate',
                                        "date_time"     => $datee
                                    );
                                    $cartInsert = $this->Model->insert('cart',$data);
                                    $array1[] = $cartInsert;
                                }
                            } 

                        $array1[] = $key1['cart_id'];
                    }
                    $cart_id = implode(',',$array1);
                }else{
                    $cart_id = '';
                }
                $data = array (
                    "zone"               => $zone,
                    "subzone"            => $subzone,
                    "name"               => $name,
                    "mobile"             => $mobile,
                    "cart_id"            => $cart_id,
                    "user_id"            => $user_id,
                    "order_date"         => $date,
                    "coupon_code"        => $coupon_code,
                    "total_discount"     => $discount,
                    "total_amount"       => $total_amount,
                    "payment_status"     => '1',
                    "status"             => '1',
                    "created_at"         => $date
                );

                if (!$zone == ''  || !$subzone == '') {
                   
                    $orderInsert = $this->Model->insert('order',$data);
                    if($orderInsert){
                        $lastId = $this->db->insert_id();
                        $wheredata = array("order_id" => $lastId);
                        $order  = $this->Model->selectAllById('order',$wheredata);
                        if($order){
                            $cart = explode(',',$order->cart_id);
                            for ($i=0; $i <count($cart); $i++) { 
                                $data = array("cart_status"=>1);
                                $where = array("cart_id"=>$cart[$i]);
                                $update  = $this->Model->update($where,'cart',$data);
                                
                            }
                            if ($update) {
                                $where = array("user_id"=>$user_id);
                                $wal  = $this->Model->selectAllById('user',$where);
                                if ($wal) {
                                    if ($wal->wallet_amount>0) {
                                        $amt     = $wal->wallet_amount;
                                        $newAmt  = (float)$amt-(float)$total_amount;
                                        $dataAmt = array("wallet_amount"=>$newAmt);
                                        $update1 = $this->Model->update($where,'user',$dataAmt);
                                        if ($update1) {
                                            $dataInserts = array("user_id"=>$user_id,"walletStatus"=>'Debited',"walletAmount"=>(float)$total_amount,"created_at"=>$date); 
                                            $dataInsert = $this->Model->insert('wallet',$dataInserts);
                                            if ($dataInsert) {

                                                if($coupon_code != ''){
                                                    $dataTranction =array(
                                                        "user_id"=> $user_id,
                                                        "wallet_id" => $dataInsert,
                                                        "amount"=> $total_amount,
                                                        "pay_by" => "order add",
                                                        "detail" => "debit + Coupon",
                                                        "coupon_code" => $coupon_code,
                                                        "date_time" => $date,
                                                        "order_id" => $lastId,
                                                        "cart_id" => $cart_id
                                                    );
                                                }else{
                                                    $dataTranction =array(
                                                        "user_id"=> $user_id,
                                                        "wallet_id" => $dataInsert,
                                                        "amount"=> $total_amount,
                                                        "pay_by" => "order add",
                                                        "detail" => "debit",
                                                        "coupon_code" => $coupon_code,
                                                        "date_time" => $date,
                                                        "order_id" => $lastId,
                                                        "cart_id" => $cart_id
                                                    );
                                                }

                                                // $dataTranction =array(
                                                //     "user_id"=> $user_id,
                                                //     "amount"=> $total_amount,
                                                //     "pay_by" => "order add",
                                                //     "detail" => "credit",
                                                //     "date_time" => $date
                                                // );
                                                $create = $this->Model->insert('transaction',$dataTranction);
                                                $dataNotification =array(
                                                    "user_id"   => $user_id,
                                                    "date_time" => date('Y-m-d H:i:s'),
                                                    "title"     => "New Order",
                                                    "message"   => "Welcome to Dailywale,Enjoy your new order!!( Order Id $lastId )",
                                                    "read_status"=> '0'
                                                );
                                                $createNotification = $this->Model->insert('notification',$dataNotification);
                                                if ($wal) {
                                                    if($wal->device_type=='android'){
                                                        $a= $this->sendPushAndroid($wal->device_token,'Message Alert','Welcome to Dailywale,Enjoy your new order!!',$user_id,'0');
                                                    }
                                                    $data_result['result']     = true;
                                                    $data_result['msg']     = 'Order Deliver';
                                                }else{
                                                    $data_result['result']     = false;
                                                    $data_result['msg']     = 'notification not created';
                                                }
                                                $datatext['results']         = true;
                                                $datatext['orderData']       = $order;
                                                $datatext['msg']             = "Order add Successfully";
                                            }else{
                                                $datatext['results'] = false;
                                                $datatext['msg']     = "Wallet not Inserted";
                                            }
                                        }else{
                                            $datatext['results'] = false;
                                            $datatext['msg']     = "User Wallet not Updated";
                                        }
                                    }else{
                                        $datatext['results'] = false;
                                        $datatext['msg']     = "You dont have sufficient balance";
                                    }
                                        
                                }else{
                                    $datatext['results'] = false;
                                    $datatext['msg']     = "User not Available";
                                }
                            }else{
                                $datatext['results']     = false;
                                $datatext['msg']         = "cart not Updated";
                            }
                        }else{
                            $datatext['results']    = false;
                            $datatext['msg']        = "Order not show Successfully";
                        }
                    }else{
                        $datatext['results']        = false;
                        $datatext['msg']            = "Order not add Successfully";
                    }
                }else{
                    $datatext['results']     = false;
                    $datatext['msg']      = 'Zone & Subzone are empty. Please update your profile first.';
                }
            }else{
                $datatext['results'] = false;
                $datatext['msg']  = 'Invalid Decode Token';
            }
        }else{
            $datatext['results']     = false;
            $datatext['msg']      = 'Invalid Token';
        }
        echo json_encode($datatext);
    }

    public function orderCancel(){
        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        $order_id   = $val->order_id;
        $cart_id   = $val->cart_id;
        date_default_timezone_set('Asia/Calcutta'); 
        $date      = date('Y-m-d');
        $headers = $this->input->request_headers();
        if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
            if(isset($headers['Authoriz'])){
                $token=$headers['Authoriz'];
            }else{
                $token=$headers['authoriz'];
            }
            $decodedToken  = $this->decode_token($token);
            if ($decodedToken != false) {
                $where      = array("order_id" => $order_id);
                $results    = $this->Model->selectdata('order',$where);
                if ($results) {
                    $chckloop="false";
                    foreach ($results as $key) {
                        $get_cart_id = $key['cart_id'];
                        $cart_ids = explode(',',$get_cart_id); 
                        for ($i=0; $i <count($cart_ids) ; $i++) { 
                            if($cart_id==$cart_ids[$i]){
                                $chckloop="true";
                                $cart_rmv_id=$cart_ids[$i];
                            }else{
                                $data_result['result']  = 'false';
                                $data_result['msg']     = 'cart id not available';
                            }
                        }
                        if($chckloop=="true"){
                            $match_cart[]=$cart_rmv_id;

                            $arr = array_diff($cart_ids, $match_cart);

                            $new_imp_cart = implode(',',$arr);
                            $data_cart_upd= array(
                                "cart_id" => $new_imp_cart
                            );
                            // $dlt    = $this->Model->update($where,'order',$data_cart_upd);

                            // if ($dlt) {
                                $where_cart_id= array(
                                    "cart_id" => $cart_id
                                );
                                $cart_status= array(
                                    "cart_status" => '2'
                                );
                                $update_cart_status= $this->Model->update($where_cart_id,'cart',$cart_status);
                                $getUserId=$this->Model->selectAllById('cart' ,$where_cart_id);
                                if ($getUserId) {
                                    $user_id = $getUserId->user_id;
                                    $where_user_id= array(
                                        "user_id"   => $user_id,
                                    );
                                    $results_user_data   = $this->Model->selectAllById('user',$where_user_id);
                                    $dataTranction =array(
                                        "user_id"=> $user_id,
                                        "amount"=> $getUserId->total_price,
                                        "pay_by" => "order cancel",
                                        "detail" => "credit",
                                        "date_time" => $date,
                                        "order_id" => $order_id,
                                        "cart_id" => $cart_id
                                    );
                                    $create = $this->Model->insert('transaction',$dataTranction);
                                }
                                if ($getUserId) {
                                    $user_id = $getUserId->user_id;
                                    $msgdel="Your order have cancelled  Successfully!!( Order Id ".$cart_id.")";
                                    $dataNotification =array(
                                        "user_id"   => $user_id,
                                        "date_time" => date('Y-m-d H:i:s'),
                                        "title"     => "Order Cancelled!!",
                                        "message"   => $msgdel,
                                        "read_status"=> '0'
                                    );
                                    $createNotification = $this->Model->insert('notification',$dataNotification);
                                }
                                if ($results_user_data) {
                                    if($results_user_data->device_type=='android'){
                                        $a= $this->sendPushAndroid($results_user_data->device_token,'Message Alert',$msgdel,$user_id,'0');
                                    }
                                    $data_result['result']     = true;
                                    $data_result['msg']     = 'Order Deliver';
                                }else{
                                    $data_result['result']     = false;
                                    $data_result['msg']     = 'notification not created';
                                }

                                $where_cart_id = $cart_id;
                                $results1 = $this->Model->selectReturn($where_cart_id);
                                foreach ($results1 as $key) {
                                    $get_user_id = $key['user_id'];
                                    $get_total_price = $key['total_price'];
                                }
                                $results2 = $this->Model->selectWallet($get_user_id);
                                foreach ($results2 as $k) {
                                  $wall_amount = $k['wallet_amount'];
                                }
                                $user_id = $get_user_id;
                                $amount_return   =  $get_total_price;
                                $getAmount = $wall_amount + $get_total_price ;
                                $rtn_data = $this->Model->updateReturn($user_id, $getAmount);
                                $data_result['result']  = 'true';
                                $data_result['msg']     = 'Order item Cancel Successfully';
                            // }else{
                            //     $data_result['result']  = 'false';
                            //     $data_result['msg']     = 'Order item not Delete!';
                            // }
                        }else{
                            $data_result['result']  = 'false';
                            $data_result['msg']     = 'Order item not Delete';
                        }
                    }
                }else{
                    $data_result['result']  = 'false';
                    $data_result['msg']     = 'Order not available';
                }   
            }else{
                $datatext['results'] = 'false';
                $data_result['msg']  = 'Invalid Decode Token';
            }
        }else{
            $datatext['results']     = 'false';
            $data_result['msg']      = 'Invalid Token';
        }
        echo json_encode($data_result);
    }

    public function orderReturn(){
        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        $order_id   = $val->order_id;
        $cart_id   = $val->cart_id;
        date_default_timezone_set('Asia/Calcutta'); 
        $date      = date('Y-m-d');
        $headers = $this->input->request_headers();
        if ((array_key_exists('Authoriz', $headers) && !empty($headers['Authoriz'])) || (array_key_exists('authoriz', $headers) && !empty($headers['authoriz']))) {
            if(isset($headers['Authoriz'])){
                $token=$headers['Authoriz'];
            }else{
                $token=$headers['authoriz'];
            }
            $decodedToken  = $this->decode_token($token);
            if ($decodedToken != false) {
                $where      = array("order_id" => $order_id);
                $results    = $this->Model->selectdata('order',$where);
                if ($results) {
                    $chckloop="false";
                    foreach ($results as $key) {
                        $get_cart_id = $key['cart_id'];
                        $cart_ids = explode(',',$get_cart_id);
                        for ($i=0; $i <count($cart_ids) ; $i++) { 
                            if($cart_id==$cart_ids[$i]){
                                $chckloop="true";
                                $cart_rmv_id=$cart_ids[$i];
                            }else{
                                $data_result['result']  = 'false';
                                $data_result['msg']     = 'cart id not available';
                            }
                        }
                        if($chckloop=="true"){
                            $match_cart[]=$cart_rmv_id;
                            $arr = array_diff($cart_ids, $match_cart);
                            $new_imp_cart = implode(',',$arr);
                            // $data_cart_upd= array(
                            //     "cart_id" => $new_imp_cart
                            // );
                            // $dlt    = $this->Model->update($where,'order',$data_cart_upd);
                            // if ($dlt) {
                                $where_cart_id= array(
                                    "cart_id" => $cart_id
                                );
                                $cart_status= array(
                                    "cart_status" => '3'
                                );
                                $update_cart_status= $this->Model->update($where_cart_id,'cart',$cart_status);
                                $getUserId=$this->Model->selectAllById('cart' ,$where_cart_id);
                                if ($getUserId) {
                                    $user_id = $getUserId->user_id;
                                    $where_user_id= array(
                                        "user_id"   => $user_id,
                                    );
                                    $results_user_data    = $this->Model->selectAllById('user',$where_user_id);
                                
                                    $dataTranction =array(
                                        "user_id"=> $user_id,
                                        "amount"=> $getUserId->total_price,
                                        "pay_by" => "order return",
                                        "detail" => "Debit",
                                        "date_time" => $date,
                                        "order_id" => $order_id,
                                        "cart_id" => $cart_id
                                    );
                                    $create = $this->Model->insert('transaction',$dataTranction);
                                }
                                $msg="Your order has been Return  Successfully!!( Order Id:".$cart_id.")";
                                if ($getUserId) {
                                    $user_id = $getUserId->user_id;
                                    
                                    $dataNotification =array(
                                        "user_id"   => $user_id,
                                        "date_time" => date('Y-m-d H:i:s'),
                                        "title"     => "Order Return!!",
                                        "message"   => $msg,
                                        "read_status"=> '0'
                                    );
                                    $createNotification = $this->Model->insert('notification',$dataNotification);
                                }
                                if ($results_user_data) {
                                    if($results_user_data->device_type=='android'){
                                        $a= $this->sendPushAndroid($results_user_data->device_token,'Message Alert',$msg,$user_id,'0');
                                    }
                                    $data_result['result']     = true;
                                    $data_result['msg']     = 'Order Deliver';
                                }else{
                                    $data_result['result']     = false;
                                    $data_result['msg']     = 'notification not created';
                                }
                                
                                //Amount Needs to be add on User Wallet Getting Values from Cart Id
                                // $where_cart_id = $cart_id;
                                // $results1 = $this->Model->selectReturn($where_cart_id);
                                //     foreach ($results1 as $key) {
                                //         $get_user_id = $key['user_id'];
                                //         $get_total_price = $key['total_price'];
                                //    }
                                //   $results2 = $this->Model->selectWallet($get_user_id);
                                //   //print_r($results2);die;
                                //   foreach ($results2 as $k) {
                                //       $wall_amount = $k['wallet_amount'];
                                //   }
                                //   // $amount_return= array(
                                //     $user_id = $get_user_id;
                                //     $amount_return   =  $get_total_price;
                                //     $getAmount = $wall_amount + $get_total_price ;

                                //    // ); 
                                //    $rtn_data = $this->Model->updateReturn($user_id, $getAmount);


                                $data_result['result']  = 'true';
                                $data_result['msg']     = 'Order item Return Successfully';
                            // }else{
                            //     $data_result['result']  = 'false';
                            //     $data_result['msg']     = 'Order item not Delete!';
                            // }
                        }else{
                            $data_result['result']  = 'false';
                            $data_result['msg']     = 'Order item not Delete';
                        }
                    }
                }else{
                    $data_result['result']  = 'false';
                    $data_result['msg']     = 'Order not available';
                }   
            }else{
                $datatext['results'] = 'false';
                $data_result['msg']  = 'Invalid Decode Token';
            }
        }else{
            $datatext['results']     = 'false';
            $data_result['msg']      = 'Invalid Token';
        }
        echo json_encode($data_result);
    }

    //order History According to Date
    public function orderHistoryAccToDate(){
        $post             = file_get_contents('php://input');
        $val              = json_decode($post);

        if(!(isset($val->user_id))){
            $resultSend = array();
            $resultSend['results']     = 'false';
            $resultSend['msg']      = 'User Not Found';
            echo json_encode($resultSend);
            exit();
        }

        $user_id          = $val->user_id;
        $date             = date('Y-m-d', strtotime($val->date));
        $orderCancleData  = array();
        $orderPendingData = array();
        $orderDeliverData = array();
        $orderRefundData  = array();

        //Pending
        $where      = array("user_id" => $user_id,"cart_status" => '1',"date_time" => $date);
        $results    = $this->Model->selectdata('cart',$where);
        if ($results) {
            foreach ($results as $key){
                $item_id = $key['item_id'];
                $whereData1 = array(
                    "item_id" => $item_id
                );
                $itemResult  = $this->Model->selectdata('item',$whereData1);
                $item = array();
                if ($itemResult) {
                    $item = array();
                    foreach ($itemResult as $key1) {
                        $total1     = (int)$key['quanity']*(float)$key['price'];
                        $taxTotal1 = $total1+(float)$key1['tax']+(float)$key1['packaging']+(float)$key1['delivery'];
                        $taxTotal    = number_format($taxTotal1, 2);
                        $total       = number_format($total1, 2);
                        $item = array(
                            "itemId"            => $key1['item_id'],
                            "item_name"         => $key1['item_name'],
                            "item_images"       => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key1['item_images'],
                            "item_desc"         => $key1['item_desc'],
                            "item_price"        => number_format($key1['item_price'], 2),
                            "item_unit"         => $key1['item_unit'],
                            "is_out_of_stock"   => $key1['is_out_of_stock'],
                            "tax"               => $key1['tax'],
                            "is_online"         => $key1['is_online']
                        );

                        $order_id = $this->Model->getOrderIdbyCartId($key['cart_id']);

                        $cartData[] = array(
                            "cart_id"           => $key['cart_id'],
                            "order_id"          => $order_id,
                            "quanity"           => $key['quanity'],
                            "price"             => $key['price'],
                            "total_price"       => $key['total_price'],
                            "scheduleOn"        => $key['scheduleOn'],
                            "scheduleType"      => $key['scheduleType'],
                            "Item"              => $item,
                            "qtyPriceTotal"      => $total,
                            "taxTotal"           => $taxTotal,
                        );
                    }
                }
            }
            $orderPendingData[]    = array(
                "cartData"         => $cartData
            );
        }else{
            $orderPendingData = array();
        }

        //cancle 
        $where      = array("user_id" => $user_id,"cart_status" => '2',"date_time" => $date);
        $results    = $this->Model->selectdata('cart',$where);
        if ($results) {
            foreach ($results as $key){
                $item_id = $key['item_id'];
                $whereData1 = array(
                    "item_id" => $item_id
                );
                $itemResult  = $this->Model->selectdata('item',$whereData1);
                $item = array();
                if ($itemResult) {
                    $item = array();
                    foreach ($itemResult as $key1) {
                        $total1     = (int)$key['quanity']*(float)$key['price'];
                        $taxTotal1 = $total1+(float)$key1['tax']+(float)$key1['packaging']+(float)$key1['delivery'];
                        $taxTotal    = number_format($taxTotal1, 2);
                        $total       = number_format($total1, 2);
                        $item = array(
                            "itemId"            => $key1['item_id'],
                            "item_name"         => $key1['item_name'],
                            "item_images"       => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key1['item_images'],
                            "item_desc"         => $key1['item_desc'],
                            "item_price"        => number_format($key1['item_price'], 2),
                            "item_unit"         => $key1['item_unit'],
                            "is_out_of_stock"   => $key1['is_out_of_stock'],
                            "tax"               => $key1['tax'],
                            "is_online"         => $key1['is_online']
                        );

                        $order_id = $this->Model->getOrderIdbyCartId($key['cart_id']);

                        $cartData1[] = array(
                            "cart_id"           => $key['cart_id'],
                            "order_id"          => $order_id,
                            "quanity"           => $key['quanity'],
                            "price"             => $key['price'],
                            "total_price"       => $key['total_price'],
                            "scheduleOn"        => $key['scheduleOn'],
                            "scheduleType"      => $key['scheduleType'],
                            "Item"              => $item,
                            "qtyPriceTotal"      => $total,
                            "taxTotal"           => $taxTotal,
                        );
                    }
                }
            }
            $orderCancleData[]    = array(
                "cartData"         => $cartData1
            );
        }else{
            $orderCancleData = array();
        }

        //refund
        //$where      = array("user_id" => $user_id,"cart_status" => '3',"date_time" => $date);
        $results    = $this->Model->selectdataOrderCancel('cart', $user_id, $date);
        if ($results) {
            foreach ($results as $key){
                $item_id = $key['item_id'];
                $whereData1 = array(
                    "item_id" => $item_id
                );
                $itemResult  = $this->Model->selectdata('item',$whereData1);
                $item = array();
                if ($itemResult) {
                    $item = array();
                    foreach ($itemResult as $key1) {
                        $total1     = (int)$key['quanity']*(float)$key['price'];
                        $taxTotal1 = $total1+(float)$key1['tax']+(float)$key1['packaging']+(float)$key1['delivery'];
                        $taxTotal    = number_format($taxTotal1, 2);
                        $total       = number_format($total1, 2);
                        $item = array(
                            "itemId"            => $key1['item_id'],
                            "item_name"         => $key1['item_name'],
                            "item_images"       => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key1['item_images'],
                            "item_desc"         => $key1['item_desc'],
                            "item_price"        => number_format($key1['item_price'], 2),
                            "item_unit"         => $key1['item_unit'],
                            "is_out_of_stock"   => $key1['is_out_of_stock'],
                            "tax"               => $key1['tax'],
                            "is_online"         => $key1['is_online']
                        );

                        $order_id = $this->Model->getOrderIdbyCartId($key['cart_id']);

                        $cartData2[] = array(
                            "cart_id"           => $key['cart_id'],
                            "order_id"          => $order_id,
                            "quanity"           => $key['quanity'],
                            "price"             => $key['price'],
                            "total_price"       => $key['total_price'],
                            "scheduleOn"        => $key['scheduleOn'],
                            "scheduleType"      => $key['scheduleType'],
                            "Item"              => $item,
                            "qtyPriceTotal"      => $total,
                            "taxTotal"           => $taxTotal,
                        );
                    }
                }
            }
            $orderRefundData[]    = array(
                "cartData"         => $cartData2
            );
        }else{
            $orderRefundData = array();
        }

        //delivery 
        $where      = array("user_id" => $user_id,"cart_status" => '4',"date_time" => $date);
        $results    = $this->Model->selectdata('cart',$where);
        if ($results) {
            foreach ($results as $key){
                $item_id = $key['item_id'];
                $whereData1 = array(
                    "item_id" => $item_id
                );
                $itemResult  = $this->Model->selectdata('item',$whereData1);
                $item = array();
                if ($itemResult) {
                    $item = array();
                    foreach ($itemResult as $key1) {
                        $total1     = (int)$key['quanity']*(float)$key['price'];
                        $taxTotal1 = $total1+(float)$key1['tax']+(float)$key1['packaging']+(float)$key1['delivery'];
                        $taxTotal    = number_format($taxTotal1, 2);
                        $total       = number_format($total1, 2);
                        $item = array(
                            "itemId"            => $key1['item_id'],
                            "item_name"         => $key1['item_name'],
                            "item_images"       => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key1['item_images'],
                            "item_desc"         => $key1['item_desc'],
                            "item_price"        => number_format($key1['item_price'], 2),
                            "item_unit"         => $key1['item_unit'],
                            "is_out_of_stock"   => $key1['is_out_of_stock'],
                            "tax"               => $key1['tax'],
                            "is_online"         => $key1['is_online']
                        );

                        $order_id = $this->Model->getOrderIdbyCartId($key['cart_id']);

                        $cartData3[] = array(
                            "cart_id"           => $key['cart_id'],
                            "order_id"          => $order_id,
                            "quanity"           => $key['quanity'],
                            "price"             => $key['price'],
                            "total_price"       => $key['total_price'],
                            "date_time"       => $key['date_time'],
                            "scheduleOn"        => $key['scheduleOn'],
                            "scheduleType"      => $key['scheduleType'],
                            "Item"              => $item,
                            "qtyPriceTotal"      => $total,
                            "taxTotal"           => $taxTotal,
                        );
                    }
                }
            }
            $orderDeliverData[]    = array(
                "cartData"         => $cartData3
            );
        }else{
            $orderDeliverData = array();
        }

        $data_result['result']     = 'true';
        $data_result['pending']    = $orderPendingData;
        $data_result['Deliver']    = $orderDeliverData;
        $data_result['Cancle']     = $orderCancleData;
        $data_result['Refund']     = $orderRefundData;
        $data_result['msg']        = 'Order History show Successfully';
        echo json_encode($data_result);
    }


    //order History According to bitween two Date
    public function orderHistoryBitweenDate(){
        $post             = file_get_contents('php://input');
        $val              = json_decode($post);

        if(!(isset($val->user_id))){
            $resultSend = array();
            $resultSend['results']     = 'false';
            $resultSend['msg']      = 'User Not Found';
            echo json_encode($resultSend);
            exit();
        }

        $user_id          = $val->user_id;
        $from_date        = date('Y-m-d', strtotime($val->from_date));
        $to_date          = date('Y-m-d', strtotime($val->to_date));
        $orderCancleData  = array();
        $orderPendingData = array();
        $orderDeliverData = array();
        $orderRefundData  = array();

        //Pending
        //$where      = array("user_id" => $user_id,"cart_status" => '1',"date_time" => $from_date);
        //$results    = $this->Model->selectdata('cart',$where);
        $results = $this->db->query("SELECT * FROM `cart` WHERE `user_id` = '".$user_id."' AND (`cart_status` = '1' OR `cart_status` = '6') AND date_time >= '".$from_date."' AND date_time <= '".$to_date."' ORDER BY date_time ASC")->result_array();
        if ($results) {
            foreach ($results as $key){
                $item_id = $key['item_id'];
                $whereData1 = array(
                    "item_id" => $item_id
                );
                $itemResult  = $this->Model->selectdata('item',$whereData1);
                $item = array();
                if ($itemResult) {
                    $item = array();
                    foreach ($itemResult as $key1) {
                        $total1     = (int)$key['quanity']*(float)$key['price'];
                        $taxTotal1 = $total1+(float)$key1['tax']+(float)$key1['packaging']+(float)$key1['delivery'];
                        $taxTotal    = number_format($taxTotal1, 2);
                        $total       = number_format($total1, 2);
                        $item = array(
                            "itemId"            => $key1['item_id'],
                            "item_name"         => $key1['item_name'],
                            "item_images"       => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key1['item_images'],
                            "item_desc"         => $key1['item_desc'],
                            "item_price"        => number_format($key1['item_price'], 2),
                            "item_unit"         => $key1['item_unit'],
                            "is_out_of_stock"   => $key1['is_out_of_stock'],
                            "tax"               => $key1['tax'],
                            "is_online"         => $key1['is_online'],
                            "delivery"          => $key1['delivery']
                        );

                        $order_id = $this->Model->getOrderIdbyCartId($key['cart_id']);

                        $cartData[] = array(
                            "cart_id"           => $key['cart_id'],
                            "order_id"          => $order_id,
                            "quanity"           => $key['quanity'],
                            "price"             => $key['price'],
                            "total_price"       => $key['total_price'],
                            "scheduleOn"        => $key['scheduleOn'],
                            "scheduleType"      => $key['scheduleType'],
                            "delivery_date"     => $key['date_time'],
                            "Item"              => $item,
                            "qtyPriceTotal"      => $total,
                            "taxTotal"           => $taxTotal,
                            "cart_status"		=> $key['cart_status']
                        );
                    }
                }
            }
            $orderPendingData[]    = array(
                "cartData"         => $cartData
            );
        }else{
            $orderPendingData = array();
        }

        //cancle 
        // $where      = array("user_id" => $user_id,"cart_status" => '2',"date_time" => $date);
        // $results    = $this->Model->selectdata('cart',$where);
        $results = $this->db->query("SELECT * FROM `cart` WHERE `user_id` = '".$user_id."' AND `cart_status` = '2' AND date_time >= '".$from_date."' AND date_time <= '".$to_date."'")->result_array();
        if ($results) {
            foreach ($results as $key){
                $item_id = $key['item_id'];
                $whereData1 = array(
                    "item_id" => $item_id
                );
                $itemResult  = $this->Model->selectdata('item',$whereData1);
                $item = array();
                if ($itemResult) {
                    $item = array();
                    foreach ($itemResult as $key1) {
                        $total1     = (int)$key['quanity']*(float)$key['price'];
                        $taxTotal1 = $total1+(float)$key1['tax']+(float)$key1['packaging']+(float)$key1['delivery'];
                        $taxTotal    = number_format($taxTotal1, 2);
                        $total       = number_format($total1, 2);
                        $item = array(
                            "itemId"            => $key1['item_id'],
                            "item_name"         => $key1['item_name'],
                            "item_images"       => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key1['item_images'],
                            "item_desc"         => $key1['item_desc'],
                            "item_price"        => number_format($key1['item_price'], 2),
                            "item_unit"         => $key1['item_unit'],
                            "is_out_of_stock"   => $key1['is_out_of_stock'],
                            "tax"               => $key1['tax'],
                            "is_online"         => $key1['is_online'],
                            "delivery"          => $key1['delivery']
                        );

                        $order_id = $this->Model->getOrderIdbyCartId($key['cart_id']);

                        $cartData1[] = array(
                            "cart_id"           => $key['cart_id'],
                            "order_id"          => $order_id,
                            "quanity"           => $key['quanity'],
                            "price"             => $key['price'],
                            "total_price"       => $key['total_price'],
                            "scheduleOn"        => $key['scheduleOn'],
                            "scheduleType"      => $key['scheduleType'],
                            "Item"              => $item,
                            "delivery_date"     => $key['date_time'],
                            "qtyPriceTotal"      => $total,
                            "taxTotal"           => $taxTotal,
                            "cart_status"		=> $key['cart_status']
                        );
                    }
                }
            }
            $orderCancleData[]    = array(
                "cartData"         => $cartData1
            );
        }else{
            $orderCancleData = array();
        }

        //refund
        // //$where      = array("user_id" => $user_id,"cart_status" => '3',"date_time" => $date);
        // $results    = $this->Model->selectdataOrderCancel('cart', $user_id, $date);
        $results = $this->db->query("SELECT * FROM `cart` WHERE `user_id` = '".$user_id."' AND `cart_status` = '3' AND date_time >= '".$from_date."' AND date_time <= '".$to_date."'")->result_array();

        if ($results) {
            foreach ($results as $key){
                $item_id = $key['item_id'];
                $whereData1 = array(
                    "item_id" => $item_id
                );
                $itemResult  = $this->Model->selectdata('item',$whereData1);
                $item = array();
                if ($itemResult) {
                    $item = array();
                    foreach ($itemResult as $key1) {
                        $total1     = (int)$key['quanity']*(float)$key['price'];
                        $taxTotal1 = $total1+(float)$key1['tax']+(float)$key1['packaging']+(float)$key1['delivery'];
                        $taxTotal    = number_format($taxTotal1, 2);
                        $total       = number_format($total1, 2);
                        $item = array(
                            "itemId"            => $key1['item_id'],
                            "item_name"         => $key1['item_name'],
                            "item_images"       => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key1['item_images'],
                            "item_desc"         => $key1['item_desc'],
                            "item_price"        => number_format($key1['item_price'], 2),
                            "item_unit"         => $key1['item_unit'],
                            "is_out_of_stock"   => $key1['is_out_of_stock'],
                            "tax"               => $key1['tax'],
                            "is_online"         => $key1['is_online'],
                            "delivery"          => $key1['delivery']
                        );

                        $order_id = $this->Model->getOrderIdbyCartId($key['cart_id']);

                        $cartData2[] = array(
                            "cart_id"           => $key['cart_id'],
                            "order_id"          => $order_id,
                            "quanity"           => $key['quanity'],
                            "price"             => $key['price'],
                            "total_price"       => $key['total_price'],
                            "scheduleOn"        => $key['scheduleOn'],
                            "scheduleType"      => $key['scheduleType'],
                            "Item"              => $item,
                            "delivery_date"     => $key['date_time'],
                            "qtyPriceTotal"      => $total,
                            "taxTotal"           => $taxTotal,
                            "cart_status"		=> $key['cart_status']
                        );
                    }
                }
            }
            $orderRefundData[]    = array(
                "cartData"         => $cartData2
            );
        }else{
            $orderRefundData = array();
        }

        //delivery 
        // $where      = array("user_id" => $user_id,"cart_status" => '4',"date_time" => $date);
        // $results    = $this->Model->selectdata('cart',$where);
        $results = $this->db->query("SELECT * FROM `cart` WHERE `user_id` = '".$user_id."' AND `cart_status` = '4' AND date_time >= '".$from_date."' AND date_time <= '".$to_date."'")->result_array();

        if ($results) {
            foreach ($results as $key){
                $item_id = $key['item_id'];
                $whereData1 = array(
                    "item_id" => $item_id
                );
                $itemResult  = $this->Model->selectdata('item',$whereData1);
                $item = array();
                if ($itemResult) {
                    $item = array();
                    foreach ($itemResult as $key1) {
                        $total1     = (int)$key['quanity']*(float)$key['price'];
                        $taxTotal1 = $total1+(float)$key1['tax']+(float)$key1['packaging']+(float)$key1['delivery'];
                        $taxTotal    = number_format($taxTotal1, 2);
                        $total       = number_format($total1, 2);
                        $item = array(
                            "itemId"            => $key1['item_id'],
                            "item_name"         => $key1['item_name'],
                            "item_images"       => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key1['item_images'],
                            "item_desc"         => $key1['item_desc'],
                            "item_price"        => number_format($key1['item_price'], 2),
                            "item_unit"         => $key1['item_unit'],
                            "is_out_of_stock"   => $key1['is_out_of_stock'],
                            "tax"               => $key1['tax'],
                            "is_online"         => $key1['is_online'],
                            "delivery"          => $key1['delivery']
                        );

                        $order_id = $this->Model->getOrderIdbyCartId($key['cart_id']);

                        $cartData3[] = array(
                            "cart_id"           => $key['cart_id'],
                            "order_id"          => $order_id,
                            "quanity"           => $key['quanity'],
                            "price"             => $key['price'],
                            "total_price"       => $key['total_price'],
                            "date_time"       => $key['date_time'],
                            "scheduleOn"        => $key['scheduleOn'],
                            "scheduleType"      => $key['scheduleType'],
                            "Item"              => $item,
                            "delivery_date"     => $key['date_time'],
                            "qtyPriceTotal"      => $total,
                            "taxTotal"           => $taxTotal,
                            "cart_status"		=> $key['cart_status']
                        );
                    }
                }
            }
            $orderDeliverData[]    = array(
                "cartData"         => $cartData3
            );
        }else{
            $orderDeliverData = array();
        }

        $data_result['result']     = 'true';
        $data_result['pending']    = $orderPendingData;
        $data_result['Deliver']    = $orderDeliverData;
        $data_result['Cancle']     = $orderCancleData;
        $data_result['Refund']     = $orderRefundData;
        $data_result['msg']        = 'Order History show Successfully';
        echo json_encode($data_result);
    }


    //item according to subCategory
    public function getItemAccToSubCategory(){
        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        $subCatId   = $val->subCatId;
        $whereItem = array("sub_cat_id" => $subCatId);
        $results    = $this->Model->selectdata('item',$whereItem);
        if ($results) {
            foreach ($results as $key) {
                $price = (float)$key['item_price'];
                $whereData = array(
                    "sub_cat_id" => $subCatId
                );
                $subCateResult  = $this->Model->selectAllById('sub_cat',$whereData);
                if ($subCateResult) {
                    $itemArray[] = array(
                        "subCategoryId"      => $subCatId,
                        "subCategoryName"    => $subCateResult->sub_cat_name,
                        "subCategoryIcon"    => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$subCateResult->icon,
                        "itemId"             => $key['item_id'],
                        "itemName"           => $key['item_name'],
                        "itemImages"         => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key['item_images'],
                        "itemDesc"           => $key['item_desc'],
                        "item_price"         => number_format($price, 2),
                        "itemUnit"           => $key['item_unit'],
                        "isOutOfStock"       => $key['is_out_of_stock'],
                        "tax"                => $key['tax'],
                        "packaging"          => $key['packaging'],
                        "delivery"           => $key['delivery'],
                        "is_schedule"        => $key['is_schedule'],
                        "isOnline"           => $key['is_online']
                    );
                }else{
                    $itemArray[] = array(
                        "subCategoryId"      => $subCatId,
                        "subCategoryName"    => 'No name',
                        "subCategoryIcon"    => 'No Icon',
                        "itemId"             => $key['item_id'],
                        "itemName"           => $key['item_name'],
                        "itemImages"         => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key['item_images'],
                        "itemDesc"           => $key['item_desc'],
                        "item_price"        => number_format($key['item_price'], 2),
                        "itemUnit"           => $key['item_unit'],
                        "isOutOfStock"       => $key['is_out_of_stock'],
                        "tax"                => $key['tax'],
                        "packaging"          => $key['packaging'],
                        "delivery"           => $key['delivery'],
                        "is_schedule"        => $key['is_schedule'],
                        "isOnline"           => $key['is_online']
                    );
                }
                $data_result['result']     = 'true';
                $data_result['itemData']   = $itemArray;
                $data_result['msg']        = 'Item show Successfully';
            }
        }else{
            $data_result['result'] = 'false';
            $data_result['msg']    = 'Item not available';
        }   
        echo json_encode($data_result);
    }

    public function services(){ 
        $results    = $this->Model->select('service_provider');
        if ($results) {
            foreach ($results as $key) {
                $whereData = array(
                    "item_id" => $key['provider_id']
                );
                $serviceResult  = $this->Model->selectAllById('item',$whereData);
                if ($serviceResult) {
                    $amt = (float)$serviceResult->item_price-(float)$serviceResult->item_discount;
                    // $amt = $serviceResult->item_price-$price;
                        $itemArray[] = array(
                            "itemId"             => $serviceResult->item_id,
                            "itemName"           => $serviceResult->item_name,
                            "itemImages"         => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$serviceResult->item_images,
                            "itemDesc"           => $serviceResult->item_desc,
                            "itemUnit"           => $serviceResult->item_unit,
                            "isOutOfStock"       => $serviceResult->is_out_of_stock,
                            "tax"                => $serviceResult->tax,
                            "isOnline"           => $serviceResult->is_online,
                            "discount"           => $serviceResult->item_discount,
                            "actualPrice"        => $serviceResult->item_price,
                            "discountPrice"      => $amt,
                            "serviceId"          => $key["service_id"],
                            "providerId"         => $key["provider_id"],
                            "title"              => $key["title"],
                            "description"        => $key["description"],
                            "pre_booking_price"  => $key["pre_booking_price"],
                            "time"               =>$key["time"]
                        );
                }else{
                    $itemArray[] = array(
                    "itemId"             => 'No item ID',
                    "itemName"           => 'No item Name',
                    "itemImages"         => 'No item image',
                    "itemDesc"           => 'No Description',
                    "itemUnit"           => 'No Unit',
                    "isOutOfStock"       => 'No Stock',
                    "tax"                => 'No Tax',
                    "isOnline"           => 'No Is_online',
                    "discount"           => 'No Discount',
                    "actualPrice"        => 'No Price',
                    "discountPrice"      => 'No Amount',
                    "serviceId"          => $key["service_id"],
                    "providerId"         => $key["provider_id"],
                    "title"              => $key["title"],
                    "description"        => $key["description"],
                    "pre_booking_price"  => $key["pre_booking_price"],
                    "time"                =>$key["time"]
                    );
                }
                $data_result['result']     = 'true';
                $data_result['itemData']   = $itemArray;
                $data_result['msg']        = 'Item show Successfully';
            }
        }else{
            $data_result['result'] = 'false';
            $data_result['msg']    = 'Services not available';
        }   
        echo json_encode($data_result);
    }

    public function getServiceDetailVayaServiceID(){
        $post  = file_get_contents('php://input');
        $val   = json_decode($post);        
        $serviceId  = $val->serviceId;
        $whereItem  = array("service_id" => $serviceId);
        $results    = $this->Model->selectdata('service_provider',$whereItem);
         if ($results) {
            foreach ($results as $key) {
                $whereData = array(
                "service_id" => $serviceId
                );
                $itemArray = array(
                    "provider_id"       => $key['provider_id'],
                    "title"             => $key['title'],
                    "description"       => $key['description'],
                    "pre_booking_price" => $key['pre_booking_price'],
                    "time"              => $key['time'],
                    "created_at"        => $key['created_at'],
                    "updated_at"        => $key['updated_at']
                );
                $data_result['result']     = 'true';
                $data_result['itemData']   = $itemArray;
                $data_result['msg']        = 'Item show Successfully';
            }
        }else{
                $data_result['result']     = 'false';
                $data_result['msg']        = 'Item not show Successfully';
        }
        echo json_encode($data_result);
    }

    public function getItemDetailViaSubcatID(){
        $post  = file_get_contents('php://input');
        $val   = json_decode($post);        
        $subcatId  = $val->subcatId;
        $whereItem = array("sub_cat_id" => $subcatId, "is_online" => "yes");

        $results    = $this->Model->selectdata('item',$whereItem);
        if ($results) {
            foreach ($results as $key) {
                $whereData = array(
                    "sub_cat_id" => $subcatId
                );            
                $price = (float)$key['item_price'];
                $amt = (float)$key['item_price']-(float)$key['item_discount'];
                // $amt = $key['item_price']-$price;
                $subCateResult  = $this->Model->selectAllById('sub_cat',$whereData);
                if ($subCateResult) {
                    $itemArray[] = array(
                        "subCategoryId"      => $subcatId,
                        "subCategoryName"    => $subCateResult->sub_cat_name,
                        "subCategoryIcon"    => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$subCateResult->icon,
                        "itemId"             => $key['item_id'],
                        "itemName"           => $key['item_name'],
                        "itemImages"         => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key['item_images'],
                        "itemDesc"           => $key['item_desc'],
                        "discount"           => $key['item_discount'],
                        "actualPrice"        =>number_format($price, 2),
                        "discountPrice"      => $amt,
                        "itemUnit"           => $key['item_unit'],
                        "isOutOfStock"       => $key['is_out_of_stock'],
                        "tax"                => $key['tax'],
                        "packaging"          => $key['packaging'],
                        "delivery"           => $key['delivery'],
                        "is_schedule"        => $key['is_schedule'],
                        "isOnline"           => $key['is_online'],
                        "is_available_six_to_twl"           => $key['is_available_six_to_twl']
                    );
                }else{
                    $itemArray[] = array(
                        "subCategoryId"      => $subcatId,
                        "subCategoryName"    => 'No name',
                        "subCategoryIcon"    => 'No Icon',
                        "itemId"             => $key['item_id'],
                        "itemName"           => $key['item_name'],
                        "itemImages"         => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key['item_images'],
                        "itemDesc"           => $key['item_desc'],
                        "discount"           => $key['item_discount'],
                        "actualPrice"        => number_format($price,2),
                        "discountPrice"      => $amt,
                        "itemUnit"           => $key['item_unit'],
                        "isOutOfStock"       => $key['is_out_of_stock'],
                        "tax"                => $key['tax'],
                        "packaging"          => $key['packaging'],
                        "delivery"           => $key['delivery'],
                        "is_schedule"        => $key['is_schedule'],
                        "isOnline"           => $key['is_online'],
                        "is_available_six_to_twl"           => $key['is_available_six_to_twl']
                    );
                }
                $data_result['result']     = 'true';
                $data_result['itemData']   = $itemArray;
                $data_result['msg']        = 'Item show Successfully';
            }
        }else{
            $data_result['result'] = 'false';
            $data_result['msg']    = 'Item not available';
        }   


        $whereData = array(
            "sub_cat_id" => $subcatId,
            "banner_type" => 'Category'
        );

        $data_result['bannerData'] = [];

        $bannerRes = $this->Model->selectdata('banners',$whereData);     
        foreach ($bannerRes as $bannerData) {

            $whereItem = array(
                "item_id" => $bannerData['item_id']
            );

            //$item  = $this->Model->selectAllById('item',$whereItem);
            $itemData  = $this->Model->selectAllById('item',$whereItem);
            print_r($itemData);die;
                $priceDecimal = (float)$itemData->item_price;
                $amt = (float)$itemData->item_price-(float)$itemData->item_discount;
                $itemArray = array(
                    "itemId"            => $itemData->item_id,
                    "itemName"          => $itemData->item_name,
                    "itemImages"        => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$itemData->item_images,
                    "itemDesc"          => $itemData->item_desc,
                    "itemPrice"         =>  number_format($priceDecimal, 2),
                    "itemUnit"          => $itemData->item_unit,
                    "isOutOfStock"      => $itemData->is_out_of_stock,
                    "tax"               => $itemData->tax,
                    "isOnline"          => $itemData->is_online,
                    "discount"          => $itemData->item_discount,
                    "actualPrice"       => $itemData->item_price,
                    "packaging"         => $itemData->packaging,
                    "delivery"          => $itemData->delivery,
                    "is_schedule"       => $itemData->is_schedule,
                    "discountPrice"     => $amt,
                    "is_available_six_to_twl"           =>$itemData->is_available_six_to_twl                 );
                
            $banner[] = array(
                'banner_id'    => $bannerData['banner_id'],
                'banner_type'  => $bannerData['banner_type'],
                'item_id'      => $bannerData['item_id'],
                'item'         => $itemArray,
                'image'        => 'http://'.$_SERVER['HTTP_HOST'].'/dailywaleAdmin/uploads/user/'. $bannerData['image'],
                'sub_cat_id'   => $bannerData['sub_cat_id'],
                'position_order'=>$bannerData['position_order'],
                'valid_date'   => $bannerData['valid_date']
            );
            $data_result['bannerData'] = $banner;
        }
        echo json_encode($data_result);
    }

    public function Citypincode(){
        $post      = file_get_contents('php://input');
        $val       = json_decode($post);        
        $city_name  = $val->city_name;
        $whereData = array(
            'city_name' => $city_name
        );  
        // $results    = $this->Model->selectdata('city',$whereData);
        $results    = $this->db->query("SELECT * FROM city WHERE city_name LIKE '%".$city_name."%'")->result_array();
        if ($results) {
            foreach ($results as $key) {
                // $cityArray = array();
                $whereData1 = array(
                    'city_id' => $key['city_id']
                );
                $Zone  = $this->Model->selectdata('zone',$whereData1);
                if ($Zone) {
                    foreach ($Zone as $value) {
                        // $ZoneArray = array();
                        $whereSubZone = array("zone_id" => $value['zone_id']);
                        $subZone  = $this->Model->selectdata('subzone',$whereSubZone);
                        if ($subZone) {
                                $subZoneArray = array();
                            foreach ($subZone as $subzoning) {
                                $wherepin = array("sub_zone_id" => $subzoning['subzone_id']);
                                $pin  = $this->Model->selectdata('pincode',$wherepin);
                                if($pin){
                                    foreach ($pin as $keyPin) {
                                        $pinArray = array();
                                        $pinArray[] = array(
                                            "pinCodeID"      => $keyPin['pincodeID'],
                                            "pinCodeNumber"  => $keyPin['pincode_no']
                                        );
                                    }
                                    $subZoneArray[]      = array(
                                        "subZoneId"      => $subzoning['subzone_id'],
                                        "subZoneName"    => $subzoning['subzone_name'],
                                        "pinCode"        => $pinArray
                                    );
                                }else{
                                    $subZoneArray[]      = array(
                                        "subZoneId"      => $subzoning['subzone_id'],
                                        "subZoneName"    => $subzoning['subzone_name'],
                                        "pinCode"        => 'No PinCode'
                                    );  
                                }
                            }
                            $ZoneArray[] = array(
                                "ZoneId"      => $value['zone_id'],
                                "ZoneName"    => $value['zone_name'],
                                "subZone"      => $subZoneArray
                            );
                        }else{
                            $ZoneArray[] = array(
                                "ZoneId"      => $value['zone_id'],
                                "ZoneName"    => $value['zone_name'],
                                "subZone"      => 'No SubZone'
                            );
                        }
                    }
                    $cityArray[] = array(
                        "cityId"      => $key['city_id'],
                        "cityName"    => $key['city_name'],
                        "Zone"        => $ZoneArray
                    );
                }else{
                    $cityArray[] = array(
                        "cityId"      => $key['city_id'],
                        "cityName"    => $key['city_name'],
                        "Zone"        => 'No Zone'
                    );
                }
                $data_result['result']     = 'true';
                $data_result['locationData']   = $cityArray;
                $data_result['msg']        = 'Location show Successfully';
            }
        }else{
            $data_result['result'] = 'false';
            $data_result['msg']    = 'Location not available';
        }   
        echo json_encode($data_result);
    }
    
    public function getResponceViaMonthAndYear1(){
        $post  = file_get_contents('php://input');
        $val   = json_decode($post);        
        $userId  = $val->userId;
        $year  = $val->month;
        $month  = $val->year;
        $checkdate = $year.'-'.$month;

        $data_result = array();
        $whereItem  = array("user_id" => $userId);
        $results    = $this->Model->selectuserdata($userId);
        if(isset($month) && isset($year) && !empty($month) && !empty($year)) {
            $result = $this->Model->selectUserDetail($userId, $checkdate, $year, $month);
            $data_result['result'] = $result;
            if($result) {
             
                $to = $results->email;
                $subject = 'Invoice (dailywale.com)';
                $headers = "From: " . strip_tags('noreply@dailywale.com') . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
              
                $message = '<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset="utf-8">
                            <title>Print</title>

                            <style>
                                .invoice-box {
                                    max-width: 800px;
                                    margin: auto;
                                    padding: 30px;
                                    /* border: 1px solid #eee;*/
                                    /* box-shadow: 0 0 10px rgba(0, 0, 0, .15); */
                                    font-size: 16px;
                                    line-height: 24px;
                                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                                    color: #555;
                                }
                                
                                .invoice-box table {
                                    width: 100%;
                                    line-height: inherit;
                                    text-align: left;
                                }
                                
                                .invoice-box table td {
                                    /* padding: 5px;*/
                                    vertical-align: top;
                                }
                                
                                .invoice-box table tr td:nth-child(2) {
                                    text-align: right;
                                }
                                
                                .invoice-box table tr.top table td {
                                    padding-bottom: 20px;
                                }
                                
                                .invoice-box table tr.top table td.title {
                                    font-size: 45px;
                                    line-height: 45px;
                                    color: #333;
                                }
                                
                                .invoice-box table tr.information table td {
                                    padding-bottom: 40px;
                                }
                                
                                .invoice-box table tr.heading td {
                                    background: #eee;
                                    border-bottom: 1px solid #ddd;
                                    font-weight: bold;
                                }
                                
                                .invoice-box table tr.details td {
                                    padding-bottom: 20px;
                                }
                                
                                .invoice-box table tr.item td {
                                    border-bottom: 1px solid #eee;
                                }
                                
                                .invoice-box table tr.item.last td {
                                    border-bottom: none;
                                }
                                
                                .invoice-box table tr.total td:nth-child(2) {
                                    border-top: 2px solid #eee;
                                    font-weight: bold;
                                }
                                
                                @media only screen and (max-width: 600px) {
                                    .invoice-box table tr.top table td {
                                        width: 100%;
                                        display: block;
                                        text-align: center;
                                    }
                                    .invoice-box table tr.information table td {
                                        width: 100%;
                                        display: block;
                                        text-align: center;
                                    }
                                }
                                /** RTL **/
                                
                                .rtl {
                                    direction: rtl;
                                    font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                                }
                                
                                .rtl table {
                                    text-align: right;
                                }
                                
                                .rtl table tr td:nth-child(2) {
                                    text-align: left;
                                }

                                .tbl11 th{
                                    text-align:center;
                                }
                                .tbl11 td{
                                    border : 1px solid #000;
                                    line-height:30px;
                                }
                                
                                @media print {
                                    #printbtn {
                                        display: none;
                                    }
                                }
                            </style>
                        </head>

                        <body>
                            <div class="invoice-box" style="margin-top:10px;">
                                <table style="width:100%;padding-top:35px;">
                                    <tr>
                                        <td colspan="3"><img id="barcode" src="http://dailywale.com/dailywaleAdmin//assets/img/logo.png.png" width="70" height="70" /></td>

                                        <td colspan="3" style="float:right;"><b> Tax Invoice/Bill of Supply/Cash Memo </b> <br> Triplicate For  Supplier</td>

                                    </tr>
                                </table>';
                foreach ($result as $res) {

                    $message .= '
                        <table style="width:100%;padding:15px;margin-top:30px; border:solid 1px #888;">
                            <tr>
                            <tr>
                                <td colspan="3"><b>Sold By:</b> '.$res->name.' <br> '.$res->address.'</td>
                                <td colspan="3" style="float:right;"><b>Billing Address: </b> <br> '.$results->address.' <br> '.$results->zone_name.' <br> '.$results->subzone_name.' <br> '.$results->city_name.' - '.$results->pincode.' <br> '.$results->state_name.'</td>
                            </tr>

                            <tr>
                                <td colspan="3"><b>PAN NO: </b>
                                    <br> <b> GST Registration No : </b> '.$res->gst_no.'</td>
                                <td colspan="3" style="float:right;"><b>Shipping Address: </b> <br>  '.$results->fname.' '.$results->lname.'    <br> '.$results->address.' <br> '.$results->zone_name.' <br> '.$results->subzone_name.' <br> '.$results->city_name.' - '.$results->pincode.' <br> '.$results->state_name.' </td>
                            </tr>

                            <tr>
                                <td colspan="3"><b>Order Number : </b> '.$res->user_id.'-'.$res->cart_id.'-'.$res->id.'
                                    <br> Order Date: '.$res->date_time.' </td>
                                <td colspan="3" style="float:right;"><b>Invoice Number :</b> '.$res->id.'-'.$res->cart_id.'
                                    <br> <b>Invoice Details : </b> dvffsd
                                    <br> <b>Invoice date : </b> 10-10-2018 </td>
                            </tr>

                        </table>
                        <table class="tbl11" style="width:100%;border:1px solid #000;padding:5px;">
                            <tr style="background:black;color:#fff;height:35px;">
                                <th>S.No</th>
                                <th>Description</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Total Amount</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td> '.$res->item_name.' - '.$res->item_desc.'</td>
                                <td>'.$res->item_price.'</td>
                                <td>'.$res->quanity.'</td>
                                <td>'.$res->item_price * $res->quanity.'</td>
                            </tr>
                            <tr>
                                <td colspan="4">Total Price</td>
                                <td>  </td>
                            </tr>
                            <tr>
                                <td colspan="5">Amount In Words</td>
                            </tr>
                            <tr>
                                <td colspan="5" style="height:90px;">Authorized Signatory</td>
                            </tr></table>';
                        
                }

                $message .= '
                        </div>
                    </body>
                </html>';

                if(mail($to, $subject, $message, $headers)){
                    $data_result['result'] ='true';
                    $data_result['msg'] ='Invoice is sent to your email';
                }else{
                    $data_result['result'] ='false';
                    $data_result['msg'] = "Oops! Something went wrong please try later.";
                }
            }else{
              $data_result['result']  = 'false';
              $data_result['msg']     = 'Invoice details not available';
            }
        }else{
           $data_result['result']  = 'false';
           $data_result['msg']     = 'details not available'; 
        }
        echo json_encode($data_result);
    }

    public function notification(){

        $post       = file_get_contents('php://input');
        $val        = json_decode($post);
        $user_id    = $val->user_id;
        $where      = array("user_id" => $user_id);
        $results    = $this->Model->selectnotification('notification',$where);
        if ($results) {
            foreach ($results as $key) {
                $post_date = strtotime($key['date_time']);
                $now = time();
                $datetimago= timespan($post_date, $now) . ' ago';
                $data[] = array(
                    "not_id"        => $key['not_id'],
                    "user_id"       => $key['user_id'],
                    "title"         => $key['title'],
                    "message"       => $key['message'],
                    "date_time"     => $key['date_time'],
                    "read_status"   => $key['read_status'],
                );
            }  
            $data_result['result'] = 'true';
            $data_result['data']   = $data ;
            $data_result['msg']    = 'notification details available';
        }else{
            $data_result['result'] = 'false';
            $data_result['msg']    = 'notification details not available';
        }   
        echo json_encode($data_result);
    }

    //The argument $time_ago is in timestamp (Y-m-d H:i:s)format.

//Function definition

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}



    public function getCartandUserDetails(){
        $cart_id  = $this->input->get('cart_id');
        // $mulorder_idss    = $this->input->get('mulorder_idss');
        // if (!$cart_id == '') {
        //     $whereItem  = array("cart_id" => $cart_id);
        //     $results    = $this->Model->selectAllById('cart',$whereItem);
        //     if ($results) {
        //         $wherecartItem= array (
        //             "item_id" =>$results->item_id
        //         );
        //         $ItemRes= $this->Model->selectItem('item', $wherecartItem);
        //         if($ItemRes){
        //             $whereUser = $results->user_id;
        //             $UserRes= $this->Model->selectuserdata($whereUser);
        //             if($UserRes){
        //                 $whereVendor= array (
        //                  "id" =>$ItemRes[0]['vendor_id']
        //                 );
        //                 $VendorRes= $this->Model->selectvendor('vendor', $whereVendor);
        //                 if($VendorRes){
        //                     $data_result['result']      = true;
        //                     $data_result['cart']        = $results;
        //                     $data_result['item']        = $ItemRes;
        //                     $data_result['user']        = $UserRes;
        //                     $data_result['vender']      = $VendorRes;
        //                 }else{
        //                     $data_result['result']     = false;
        //                     $data_result['msg']        = 'user not found';
        //                 }
        //             }else{
        //                 $data_result['result']     = false;
        //                 $data_result['msg']        = 'user not found';
        //             } 
        //         }else{
        //             $data_result['result']     = false;
        //             $data_result['msg']        = 'item not found';
        //         }
        //     }else{
        //         $data_result['result']     = false;
        //         $data_result['msg']        = 'user not available';
        //     }
        // }else{
        //     $arr = explode(',', $mulorder_idss);
        //     foreach ($arr as $ids_cart) {
        //         //print_r($ids_cart);  
        //         $whereItem  = array("cart_id" => $ids_cart);
        //         $results    = $this->Model->selectAllById('cart',$whereItem);
        //         if ($results) {
        //             $wherecartItem= array (
        //                 "item_id" =>$results->item_id
        //             );
        //             $ItemRes= $this->Model->selectItem('item', $wherecartItem);
        //             if($ItemRes){
        //                 $whereUser = $results->user_id;
        //                 $UserRes= $this->Model->selectuserdata($whereUser);
        //                 if($UserRes){
        //                     $whereVendor= array (
        //                      "id" =>$ItemRes[0]['vendor_id']
        //                     );
        //                     $VendorRes= $this->Model->selectvendor('vendor', $whereVendor);
        //                     if($VendorRes){
        //                         $data_result['result'][]      = true;
        //                         $data_result['cart'][]        = $results;
        //                         $data_result['item'][]        = $ItemRes;
        //                         $data_result['user'][]        = $UserRes;
        //                         $data_result['vender'][]      = $VendorRes;
        //                     }else{
        //                         $data_result['result']     = false;
        //                         $data_result['msg']        = 'user not found';
        //                     }
        //                 }else{
        //                     $data_result['result']     = false;
        //                     $data_result['msg']        = 'user not found';
        //                 } 
        //             }else{
        //                 $data_result['result']     = false;
        //                 $data_result['msg']        = 'item not found';
        //             }
        //         }else{
        //             $data_result['result']     = false;
        //             $data_result['msg']        = 'user not available';
        //         }  
        //     }


        

        // }


        $whereItem  = array("cart_id" => $cart_id);
        $results    = $this->Model->selectAllById('cart',$whereItem);
        if ($results) {
            $wherecartItem= array (
                "item_id" =>$results->item_id
            );
            $ItemRes= $this->Model->selectItem('item', $wherecartItem);
            if($ItemRes){
               // $whereUser= array (
               //      "user_id" =>$results->user_id
               //  );
               //  $UserRes= $this->Model->selectuser('user', $whereUser);
                $whereUser = $results->user_id;
                $UserRes= $this->Model->selectuserdata($whereUser);
                if($UserRes){
                    $whereVendor= array (
                     "id" =>$ItemRes[0]['vendor_id']
                    );
                    $VendorRes= $this->Model->selectvendor('vendor', $whereVendor);
                    if($VendorRes){
                        $data_result['result']      = true;
                        $data_result['cart']        = $results;
                        $data_result['item']        = $ItemRes;
                        $data_result['user']        = $UserRes;
                        $data_result['vender']      = $VendorRes;
                    }else{
                        $data_result['result']     = false;
                        $data_result['msg']        = 'user not found';
                    }
                }else{
                    $data_result['result']     = false;
                    $data_result['msg']        = 'user not found';
                } 
            }else{
                $data_result['result']     = false;
                $data_result['msg']        = 'item not found';
            }
        }else{
            $data_result['result']     = false;
            $data_result['msg']        = 'user not available';
        }
       
        echo json_encode($data_result);
    }

    public function orderDeliverCurl($cart_id){
        $data_result = array();
        date_default_timezone_set('Asia/Calcutta'); 
        $date      = date('Y-m-d');
        $where_device = array(
            'cart_id' => $cart_id
        );
        

        $results_cart    = $this->Model->selectAllById('cart',$where_device);
        if($results_cart->cart_status!='5'){

                    $device_data = array(
                    'cart_status' => 4
                    );
                 $res  = $this->Model->update($where_device,'cart',$device_data);
                if($res){

                        $results_cart    = $this->Model->selectAllById('cart',$where_device);
                        if($results_cart){
                            // print_r($results_cart);
                            $user_id = $results_cart->user_id;
                            $where_user_id= array(
                                "user_id"   => $user_id,
                            );
                            $results_user_data    = $this->Model->selectAllById('user',$where_user_id);
                            // print_r($results_user_data);exit;
                            $msgdel="Your Order Deliver Successfully!! (Order ID : ".$cart_id.")";
                            $dataNotification =array(
                                "user_id"   => $user_id,
                                "date_time" => $date,
                                "title"     => "Order Deliver",
                                "message"   => $msgdel,
                                "read_status"=> '0'
                            );
                            $createNotification = $this->Model->insert('notification',$dataNotification);
                            if ($results_user_data) {
                                if($results_user_data->device_type=='android'){
                                    $a= $this->sendPushAndroid($results_user_data->device_token,'Message Alert',$msgdel,$user_id,'0');
                                }
                                $data_result['result']     = true;
                                $data_result['msg']     = 'Order Deliver';
                            }else{
                                $data_result['result']     = false;
                                $data_result['msg']     = 'notification not created';
                            }
                        }else{
                            $data_result['result']     = false;
                        }

                }else{
                    $data_result['result']     = false;
                }


        }else{

                    $results_cart    = $this->Model->selectAllById('cart',$where_device);
                        if($results_cart){
                            // print_r($results_cart);
                            $user_id = $results_cart->user_id;
                            $where_user_id= array(
                                "user_id"   => $user_id,
                            );
                            $results_user_data    = $this->Model->selectAllById('user',$where_user_id);
                            // print_r($results_user_data);exit;
                            $msgdel="Your Order Return Successfully!! ( Order ID : ".$cart_id.")";
                            $dataNotification =array(
                                "user_id"   => $user_id,
                                "date_time" => $date,
                                "title"     => "Order Return",
                                "message"   => $msgdel,
                                "read_status"=> '0'
                            );
                            $createNotification = $this->Model->insert('notification',$dataNotification);
                            if ($results_user_data) {
                                if($results_user_data->device_type=='android'){
                                    $a= $this->sendPushAndroid($results_user_data->device_token,'Message Alert',$msgdel,$user_id,'0');
                                }
                                $data_result['result']     = true;
                                $data_result['msg']     = 'Order Return';
                            }else{
                                $data_result['result']     = false;
                                $data_result['msg']     = 'notification not created';
                            }
                        }else{
                            $data_result['result']     = false;
                        }

        }

       

        echo json_encode($data_result);
    }

    function sendPushAndroid($reg_id, $title, $desc,$user_id,$isCall){
        $msg  = array(
            'message'    => $desc,
            'title'      => $title,
            'user_id'   => $user_id,
        );
        $fields            = array(
            // 'registration_ids' => array('cr3EHxJs-Ks:APA91bGvmNRAJy2Vb5-JwYH9zHa8-yKzAUFNzq-NAcOQ4YPi25j9CPKwjgVHv2oVwkiBxPUVgiBJy-d0SkefUUqeFnzxgvFqZxXYbFBKIxYoRkq9rZECMQK-qJc8fjsoPVbYK72x1dfj'),
            'registration_ids' => array($reg_id),
            'data'             => $msg
        );
        //print_r($fields);exit;
        $headers = array(       
            'Authorization: key=AIzaSyAjqK2eEz1EO3weNVNUVkuE2hrHDVwCkKo',
            'Content-Type: application/json'
        );
        $ch      = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);
         //print_r($fields);exit;
        curl_close($ch);
         // print_r($result);exit;
    }

    public function walletOnline(){
        $user_id = $_REQUEST['user_id'];
        $amount = $_REQUEST['amount'];

        $datatext = array();
        $data = array(
            'user_id' => $user_id, 
            'walletAmount' => $amount, 
            'created_at' => date('Y-m-d H:i:s'),
            'add_by'    => 'PayTm',
            'walletStatus' => 'NULL'
        );
        $insert_id = $this->Model->insert('wallet',$data);
        $datatext['wallet_id'] = $insert_id;
        echo json_encode($datatext);
    }

    public function walletOnlineConfirm(){
        $user_id = $_REQUEST['user_id'];
        $wallet_id =  $_REQUEST['wallet_id'];
        $wallet_amount = $_REQUEST['wallet_amount'];

        $wallet_id =  $_REQUEST['wallet_id'];
        $select_where = array(
            "wallet_id" => $wallet_id
        );
        $checkUpdatedWallet = $this->Model->selectAllById("wallet", $select_where);
        if($checkUpdatedWallet->walletStatus=='NULL'){

            $checksum = $this->Model->selectWalletChecksum($wallet_id);

            $datatext = array();

            $curl = curl_init();

            $fields = array(
                "MID" => "DAILYN32258608646493",
                "ORDERID" => $wallet_id,
                "CHECKSUMHASH" => $checksum->checksum,
            );

            $headers = array(
              'Content-Type: application/json',
              'Accept: application/json'
            );

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://securegw.paytm.in/merchant-status/getTxnStatus",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST=> 0,
                CURLOPT_SSL_VERIFYPEER=> 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode( $fields ),
                CURLOPT_HTTPHEADER => $headers
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                $datatext['result'] = false;
                $datatext['error'] = "cURL Error #:" . $err;
                echo json_encode($datatext);
                exit();
            } else {
                $parsed = array();
                $parsed = json_decode($response, true);
                if($parsed['STATUS']=="TXN_SUCCESS"){
                    $wheredata = array(
                        'user_id' => $user_id, 
                        'wallet_id' => $wallet_id
                    );
                    $data = array(
                        'walletStatus' => 'credit'
                    );
                    $this->Model->update($wheredata, 'wallet', $data);
                    $this->Model->updateWallet($user_id, $wallet_amount);

                    $data_wallet = array(
                        'user_id'   => $user_id, 
                        'amount'    => $wallet_amount, 
                        'wallet_id' => $wallet_id,
                        'detail'    => 'Credit',
                        'date_time' => date('Y-m-d H:i:s'),
                        'pay_by'    => 'PayTm'
                    );
                    $insert_id = $this->Model->insert('transaction',$data_wallet);

                    $datatext['result'] = true;
                    echo json_encode($datatext);
                }else{
                    $datatext['result'] = false;
                    $datatext['error'] = "Transaction failed, if something went wrong please contact us with the Order Id: "+$wallet_id ;
                    echo json_encode($datatext);
                }
            }
        }else{
            $datatext['result'] = true;
            $datatext['error'] = "Amount Already Added.";
            echo json_encode($datatext);
        }

    }

    public function wallectConfirmTest(){
        $wallet_id =  $_REQUEST['wallet_id'];
        $select_where = array(
            "wallet_id" => $wallet_id
        );
        $checkUpdatedWallet = $this->Model->selectAllById("wallet", $select_where);
        //echo $checkUpdatedWallet->walletStatus;
        if($checkUpdatedWallet->walletStatus=='NULL'){
            echo "Go On";
        }else{
            echo "NO ON";
        }
        //print_r($checkUpdatedWallet);
        // foreach ($checkUpdatedWallet as $res) {
            
        // }
    }



    public function getResponceViaMonthAndYear(){
        $post  = file_get_contents('php://input');
        $val   = json_decode($post);        
        $userId  = $val->userId;
        $month   = $val->year;
        $year    = $val->month;
        $checkdate = $year.'-'.$month;

        $data_result = array();

        $whereItem  = array("user_id" => $userId);
        $results    = $this->Model->selectuserdata($userId);
        if(isset($month) && isset($year) && !empty($month) && !empty($year)) {
            $vendor = $this->Model->select('vendor');
            if ($vendor) {
                $user = $this->db->query('SELECT * FROM `user` JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id JOIN city ON user.city_id = city.city_id JOIN state ON user.state_id = state.state_id WHERE user_id = "'.$userId.'"')->result_array();

                $to = $results->email;
                $subject = 'Invoice (dailywale.com)';
                $headers = "From: " . strip_tags('noreply@dailywale.com') . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                $message = '<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset="utf-8">
                            <title>Print</title>

                            <style>
                                .invoice-box {
                                    max-width: 800px;
                                    margin: auto;
                                    padding: 30px;
                                    /* border: 1px solid #eee;*/
                                    /* box-shadow: 0 0 10px rgba(0, 0, 0, .15); */
                                    font-size: 16px;
                                    line-height: 24px;
                                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                                    color: #555;
                                }
                                
                                .invoice-box table {
                                    width: 100%;
                                    line-height: inherit;
                                    text-align: left;
                                }
                                
                                .invoice-box table td {
                                    /* padding: 5px;*/
                                    vertical-align: top;
                                }
                                
                                .invoice-box table tr td:nth-child(2) {
                                    text-align: right;
                                }
                                
                                .invoice-box table tr.top table td {
                                    padding-bottom: 20px;
                                }
                                
                                .invoice-box table tr.top table td.title {
                                    font-size: 45px;
                                    line-height: 45px;
                                    color: #333;
                                }
                                
                                .invoice-box table tr.information table td {
                                    padding-bottom: 40px;
                                }
                                
                                .invoice-box table tr.heading td {
                                    background: #eee;
                                    border-bottom: 1px solid #ddd;
                                    font-weight: bold;
                                }
                                
                                .invoice-box table tr.details td {
                                    padding-bottom: 20px;
                                }
                                
                                .invoice-box table tr.item td {
                                    border-bottom: 1px solid #eee;
                                }
                                
                                .invoice-box table tr.item.last td {
                                    border-bottom: none;
                                }
                                
                                .invoice-box table tr.total td:nth-child(2) {
                                    border-top: 2px solid #eee;
                                    font-weight: bold;
                                }
                                
                                @media only screen and (max-width: 600px) {
                                    .invoice-box table tr.top table td {
                                        width: 100%;
                                        display: block;
                                        text-align: center;
                                    }
                                    .invoice-box table tr.information table td {
                                        width: 100%;
                                        display: block;
                                        text-align: center;
                                    }
                                }
                                /** RTL **/
                                
                                .rtl {
                                    direction: rtl;
                                    font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                                }
                                
                                .rtl table {
                                    text-align: right;
                                }
                                
                                .rtl table tr td:nth-child(2) {
                                    text-align: left;
                                }

                                .tbl11 th{
                                    text-align:center;
                                }
                                .tbl11 td{
                                    border : 1px solid #000;
                                    line-height:30px;
                                }
                                
                                @media print {
                                    #printbtn {
                                        display: none;
                                    }
                                }
                            </style>
                        </head>

                        <body>
                            <div class="invoice-box" style="margin-top:10px;">
                                <table style="width:100%;padding-top:35px;">
                                    <tr>
                                        <td colspan="3"><img id="barcode" src="http://dailywale.com/dailywaleAdmin/assets/img/logo.png.png" width="70" height="70" /></td>

                                        <td colspan="3" style="float:right;"><b> Tax Invoice/Bill of Supply/Cash Memo </b> <br> Triplicate For  Supplier</td>

                                    </tr>
                                </table>';


                foreach ($vendor as $v) {
                    $itemdata = $this->Model->getSellerData($v['id'], $checkdate, $userId);
                    if (!empty($itemdata)) {
                         

                    $message .= '
                        <table style="width:100%;padding:15px;margin-top:30px; border:solid 1px #888;">
                            <tr>
                            <tr>
                                <td colspan="6"><b>Sold By:</b> '.$v["name"].' <br> '.$v["address"].'</td>
                                <td><b>Billing Address: </b> <br> '.$user[0]["address"].', '.$user[0]["zone_name"].', '.$user[0]["subzone_name"].' <br> '.$user[0]["city_name"].' - '.$user[0]["pincode"].', '.$user[0]["state_name"].'</td>
                            </tr>

                            <tr>
                                <td colspan="6"><b>PAN NO: </b>
                                    <br> <b> GST Registration No : </b> '.$v["gst_no"].'</td>
                                <td><b>Shipping Address: </b> <br>  '.$user[0]["fname"].' '.$user[0]["lname"].'    <br> '.$user[0]["address"].', '.$user[0]["zone_name"].', '.$user[0]["subzone_name"].' <br> '.$user[0]["city_name"].' - '.$user[0]["pincode"].', '.$user[0]["state_name"].' </td>
                            </tr>

                            <tr>
                                <td colspan="6"><b>Order Number : </b> '.$v["id"].'-'.$user[0]["user_id"].'-'.date('m').'
                                </td>
                                <td><b>Invoice Number :</b> '.$v["id"].'-'.$user[0]["user_id"].'-'.date('m').'
                                    <br> <b>Invoice Details : </b>' .date('D/Y').'  
                                    <br> <b>Invoice date : </b>' .date('Y-m-d'). '</td>
                            </tr>

                        </table>
                        <table class="tbl11" style="width:100%;border:1px solid #000;padding:5px;">
                            <tr style="background:black;color:#fff;height:35px;">
                                <th>S.No</th>
                                <th>Description</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Total Amount</th>
                            </tr>';
                            $sumOfAll = '0';
                        foreach ($itemdata as $item) {
                              $itemname       = $item["item_name"];
                              $itemprice      = $item["total_price"];
                              $itemquantity   = $item["total"];
                              $totalItemPrice = $item["total_price"] * $item["total"];

                              $sumOfAll += $totalItemPrice;

                               $number = $sumOfAll;
                               $no = round($number);
                               $point = round($number - $no, 2) * 100;
                               $hundred = null;
                               $digits_1 = strlen($no);
                               $i = 0;
                               $str = array();
                               $words = array('0' => '', '1' => 'One', '2' => 'Two',
                                '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
                                '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
                                '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
                                '13' => 'Thirteen', '14' => 'Fourteen',
                                '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
                                '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
                                '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
                                '60' => 'Sixty', '70' => 'Seventy',
                                '80' => 'Eighty', '90' => 'Ninety');
                               $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
                               while ($i < $digits_1) {
                                 $divider = ($i == 2) ? 10 : 100;
                                 $number = floor($no % $divider);
                                 $no = floor($no / $divider);
                                 $i += ($divider == 10) ? 1 : 2;
                                 if ($number) {
                                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                    $str [] = ($number < 21) ? $words[$number] .
                                        " " . $digits[$counter] . $plural . " " . $hundred
                                        :
                                        $words[floor($number / 10) * 10]
                                        . " " . $words[$number % 10] . " "
                                        . $digits[$counter] . $plural . " " . $hundred;
                                 } else $str[] = null;
                              }
                              $str = array_reverse($str);
                              $result = implode('', $str);
                              $points = ($point) ?
                                "." . $words[$point / 10] . " " . 
                                      $words[$point = $point % 10] : '';
                              $words_Amount = $result . "Rupees  " . $points . " Paise";

                $message .= '<tr>
                                <td style="padding-left:15px;">1</td>
                                <td style="padding-left:15px;">' .$itemname.'</td>
                                <td style="padding-left:15px;">' .$itemprice.'</td>
                                <td style="padding-left:15px;">' .$itemquantity.'</td>
                                <td style="padding-left:15px;">' .$totalItemPrice.'</td>
                            </tr>';
                            }

                $message .='<tr>
                                <td colspan="4" style="padding-left:15px;"><b>Total Price</b></td>
                                <td style="padding-left:15px;">'.$sumOfAll.'</td>
                            </tr>
                            <tr>
                                <td colspan="5" style="padding-left:15px;"><b>Amount In Words : </b>'. $words_Amount.'</td>

                            </tr>
                            <tr>
                                <td colspan="5" style="height:90px;padding-left:15px;">Authorized Signatory</td>
                            </tr></table>
                        </div>
                    </body>
                </html>';

                    }  
                }  
                if(mail($to, $subject, $message, $headers)){
                  $data_result['result'] ='true';
                  $data_result['msg'] ='Invoice Sent on Email.';
                }else{
                  $data_result['result'] ='false';
                  $data_result['msg'] ="Emailexist.";
                }
            }else{
              $data_result['result']  = 'false';
              $data_result['msg']     = 'Invoice details not available';
          }
        }else{
           $data_result['result']  = 'false';
           $data_result['msg']     = 'details not available'; 
        }

        echo json_encode($data_result);
    }



    // Last 28 days Order History
    public function orderHistoryLast28Days(){
        $post             = file_get_contents('php://input');
        $val              = json_decode($post);
        $user_id          = $val->user_id;

        if(!(isset($val->user_id))){
            $resultSend = array();
            $resultSend['results']     = 'false';
            $resultSend['msg']      = 'User Not Found';
            echo json_encode($resultSend);
            exit();
        }

       // $results    = $this->db->query(" SELECT *, DATE_FORMAT(date_time, '%Y-%m-%d') as create_date_formatted FROM cart WHERE cart_status = '4' AND date_time BETWEEN (CURDATE() - INTERVAL 28 DAY) AND CURDATE() ORDER BY cart_id DESC")->result_array();
 

        //delivery 
        
        $results = $this->db->query(" SELECT *, DATE_FORMAT(date_time, '%Y-%m-%d') as create_date_formatted
FROM cart
WHERE cart_status = '4' AND date_time BETWEEN (CURDATE() - INTERVAL 28 DAY) AND CURDATE() ORDER BY cart_id DESC")->result_array();
       // print_r($results);die;
        if ($results) {
            foreach ($results as $key){
                $item_id = $key['item_id'];
                $whereData1 = array(
                    "item_id" => $item_id
                );
                $itemResult  = $this->Model->selectdata('item',$whereData1);
                $item = array();
                if ($itemResult) {
                    $item = array();
                    foreach ($itemResult as $key1) {
                        $total1     = (int)$key['quanity']*(float)$key['price'];
                        $taxTotal1 = $total1+(float)$key1['tax']+(float)$key1['packaging']+(float)$key1['delivery'];
                        $taxTotal    = number_format($taxTotal1, 2);
                        $total       = number_format($total1, 2);
                        $item = array(
                            "itemId"            => $key1['item_id'],
                            "item_name"         => $key1['item_name'],
                            "item_images"       => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key1['item_images'],
                            "item_desc"         => $key1['item_desc'],
                            "item_price"        => number_format($key1['item_price'], 2),
                            "item_unit"         => $key1['item_unit'],
                            "is_out_of_stock"   => $key1['is_out_of_stock'],
                            "tax"               => $key1['tax'],
                            "is_online"         => $key1['is_online']
                        );

                        $order_id = $this->Model->getOrderIdbyCartId($key['cart_id']);

                        $cartData3[] = array(
                            "cart_id"           => $key['cart_id'],
                            "order_id"          => $order_id,
                            "quanity"           => $key['quanity'],
                            "price"             => $key['price'],
                            "total_price"       => $key['total_price'],
                            "date_time"       => $key['date_time'],
                            "scheduleOn"        => $key['scheduleOn'],
                            "scheduleType"      => $key['scheduleType'],
                            "Item"              => $item,
                            "qtyPriceTotal"      => $total,
                            "taxTotal"           => $taxTotal,
                        );
                    }
                }
            }
            $orderDeliverData[]    = array(
                "cartData"         => $cartData3
            );
        }else{
            $orderDeliverData = array();
        }

        $data_result['result']     = 'true';
        $data_result['Deliver']    = $orderDeliverData;
        $data_result['msg']        = 'Order History show Successfully';
        echo json_encode($data_result);
    }
                                    
    public function applyCouponCode(){
        $coupon_code = $_GET['coupon'];
		$user_id = $_GET['user_id'];
		$amount = $_GET['amount'];

		$datatext = array();

		$wheredata = array(
		    'coupon_code' => $coupon_code
		);
		$result = $this->Model->selectAllById('coupon_code', $wheredata);
		if ($result) {

			if($result->min_cart_amount<$amount){

			    $is_one_time = $result->is_one_time;
			    if ($is_one_time == "1") {
			        $wherecheck = array(
			            'coupon_code' => $coupon_code,
			            'user_id' => $user_id
			        );
			        $orderCount = $this->Model->selectAllById('order', $wherecheck);
			        if ($orderCount) {
			            $data_result['result'] = 'false';
			            $data_result['msg'] = 'You have already use this coupon';
			        } else {

			        	$discount = 0;

			        	if($result->is_rand==0){
				            $per = $result->percentage;
				            $discount = (($amount * $per) / 100);
				            if ($discount > $result->max_amount) {
				                $discount = $result->max_amount;
				            }
			        	}else{
			        		$rand = $result->is_rand;
			        		if($rand>$amount){
			        			$rand = $amount;
			        		}
			        		$discount =  rand(1, $rand);
			        	}

			            $data_result['result'] = 'true';
			            $data_result['msg'] = 'Coupon Code is successfully applied';
			            $data_result['discount'] = $discount;
			        }
			    }else{
			    	$discount = 0;
		        	if($result->is_rand==0){
			            $per = $result->percentage;
			            $discount = (($amount * $per) / 100);
			            if ($discount > $result->max_amount) {
			                $discount = $result->max_amount;
			            }
		        	}else{
		        		$rand = $result->is_rand;
		        		if($rand>$amount){
		        			$rand = $amount;
		        		}
		        		$discount =  rand(1, $rand);
		        	}

		            $data_result['result'] = 'true';
		            $data_result['msg'] = 'Coupon Code is successfully applied';
		            $data_result['discount'] = $discount;
			    }
			}else{
				$data_result['result'] = 'false';
		    	$data_result['msg'] = 'Cart amount should be greater than Rs.'.$result->min_cart_amount;
			}

		} else {
		    $data_result['result'] = 'false';
		    $data_result['msg'] = 'Coupon Code is invalid';
		}
		$json = json_encode($data_result);
		echo $json;
    }


    //Search item 
    public function Search()
    {
        $post  = file_get_contents('php://input');
        $val   = json_decode($post);        
        $search = $val->search;
        
        $results = $this->db->query("SELECT i.*,s.sub_cat_name FROM item as i JOIN sub_cat as s ON s.sub_cat_id = i.sub_cat_id  WHERE item_name like '%".$search."%' AND is_online = 'yes' AND is_out_of_stock = '0' ")->result_array();
        if ($results) {
            foreach ($results as $key) {
                $res[] = array( 
                    'item_id'          => $key['item_id'],
                    'sub_cat_name'     => $key['sub_cat_name'],
                    'vendor_id'        => $key['vendor_id'],
                    'item_type'        => $key['item_type'],
                    'item_name'        => $key['item_name'],
                    'item_images'      => 'http://dailywale.com/dailywaleAdmin/uploads/user/'.$key['item_images'],
                    'item_desc'        => $key['item_desc'],
                    'item_quantity_desc' => $key['item_quantity_desc'],
                    'item_price'       => $key['item_price'],
                    'item_discount'    => $key['item_discount'],
                    'item_unit'        => $key['item_unit'],
                    'is_out_of_stock'  => $key['is_out_of_stock'],
                    'tax'              => $key['tax'],
                    'packaging'        => $key['packaging'],
                    'delivery'         => $key['delivery'],
                    'is_schedule'      => $key['is_schedule'],
                    'is_online'        => $key['is_online'],
                    'discountPrice'   => (float)$key['item_price']-(float)$key['item_discount'],
                    'discount'        => $key['item_discount'],
                    'actualPrice'     => number_format((float)$key['item_price'], 2),
                    'is_available_six_to_twl' => $key['is_available_six_to_twl']
                );
            }
            $data_result['result'] = 'true';
            $data_result['msg'] = 'item details';
            $data_result['data'] = $res;
        }else{
            $data_result['result'] = 'false';
            $data_result['msg'] = 'data not found';
        }
        echo json_encode($data_result);
    }



    // //add item in Rasan
    public function addToRasan() {
        $post   = file_get_contents('php://input');
        $val    = json_decode($post);
        $user_id   = $val->user_id;
        $cart      = $val->cart; 
        date_default_timezone_set('Asia/Calcutta'); 
        $date      = date('Y-m-d');
        
        foreach ($cart as $key) {
            $wheredata = array(
                'item_id' => $key->item_id
            );
            $result = $this->Model->selectAllById('item', $wheredata);
            if ($result) {
                $pkg = $result->packaging;
                $tax = $result->tax;
                $dlv = $result->delivery;
            }else{
                $pkg = 0;
                $tax = 0;
                $dlv = 0;
            }

            $quantity = $key->qty;
            $price    = $result->item_price;
            $scheduleType = "ScheduleDate";
            $ScheduleOn   = date('Y-m-d',strtotime("+1 day"));
            $datee        = date('Y-m-d',strtotime("+1 day"));
            $total_amount1 = (int)$quantity*(float)$price;
            $total_amount  = (( (float)$pkg + (float)$tax + (float)$dlv) * $quantity) + $total_amount1;
            
            $data = array(
                'item_id'      => $result->item_id,
                'user_id'      => $user_id,
                'quanity'      => $key->qty,
                'price'        => $price,
                'total_price'  => $total_amount,
                'scheduleOn'   => $ScheduleOn,
                'scheduleType' => $scheduleType,
                'date_time'    => $datee
            );
             
            $cartInsert = $this->Model->insert('cart',$data);
            if($cartInsert){
                $lastId = $this->db->insert_id();
                $wheredata = array("cart_id" => $lastId);
                $cart   = $this->Model->selectAllById('cart',$wheredata);
                if($cart){
                    $data_result['results']    = true;
                   // $data_result['cartData']   = $cart;
                    $data_result['msg']        = "Product add Successfully";
                }else{
                    $data_result['results']    = false;
                    $data_result['msg']        = "Product not show Successfully";
                }
            }else{
                $data_result['results']        = false;
                $data_result['msg']            = "Product not add Successfully";
            }
        }
        echo json_encode($data_result);
    }


    public function sendMonthOpeningBalance(){
        $where = array(
            "user_status" => '1'
        );
        $results = $this->Model->selectdata('user', $where);
        if ($results) {
            foreach ($results as $key) {
                $trans = array(
                    'user_id'   => $key['user_id'], 
                    'amount'    => $key['wallet_amount'], 
                    'wallet_id' => '0',
                    'detail'    => 'Opening',
                    'date_time' => date('Y-m-d H:i:s'),
                    'pay_by'    => 'Balance'
                );
                $insert_id = $this->Model->insert('transaction',$trans);
            }
        }
    }

                                    
    
}
?>
