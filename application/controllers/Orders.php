<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('email');        
    }
    // ********************************
     public function pending()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/pending');
        } else {
            redirect('welcome');
        }
        
    }
    public function deliveryBoyOrder()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/deliveryBoyOrder');
        } else {
            redirect('welcome');
        }
        
    }
    public function deliveryBoySummary()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/deliveryBoySummary');
        } else {
            redirect('welcome');
        }
        
    }
    public function pendingview($id){ 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            // $cartArray = array();
            $wheredata = array(
                'order_id'=>$id
            );
            $order=$this->Model->selectAllById('order',$wheredata);
            // print_r($order->cart_id);exit;
            $cartArray1 = explode(',', $order->cart_id);
            // echo count($cartArray1);
            for ($i=0; $i < count($cartArray1); $i++) { 
                $whereCart = array(
                    'cart_id'=>$cartArray1[$i]
                );  
                // print_r($whereCart);
                $cart = $this->Model->selectdata('cart',$whereCart);
                if ($cart) {
                    foreach ($cart as $key) {
                        $whereItem = array(
                            'item_id'=>$key['item_id']
                        ); 
                        $item = $this->Model->selectdata('item',$whereItem);
                        if ($item) {
                            foreach ($item as $value) {
                                $itemArray = array();
                                $itemArray = array(
                                    "item_id"       => $value['item_id'],
                                    "item_name"     => $value['item_name'],
                                    "item_images"   => $value['item_images'],
                                    "item_desc"     => $value['item_desc']
                                );
                            }
                            $cartArray[] = array(
                                "cart_id"       => $key['cart_id'],
                                "quanity"       => $key['quanity'],
                                "price"         => $key['price'],
                                "total_price"   => $key['total_price'],
                                "scheduleOn"    => $key['scheduleOn'],
                                "scheduleType"  => $key['scheduleType'],
                                "date_time"     => $key['date_time'],
                                "item"          => $itemArray
                            );
                        }else{
                            $cartArray[] = array(
                                "cart_id"       => $key['cart_id'],
                                "quanity"       => $key['quanity'],
                                "price"         => $key['price'],
                                "total_price"   => $key['total_price'],
                                "scheduleOn"    => $key['scheduleOn'],
                                "scheduleType"  => $key['scheduleType'],
                                "date_time"     => $key['date_time'],
                                "item"          => array()
                            );
                        }
                        $result['arr']  =   $cartArray;
                    }             
                }else{
                    $result['arr']  = '';
                } 
            }
            // print_r($result['arr']);
            $this->load->view('admin/pendingview', $result);
            $this->load->view('admin/assets/footer');
        }else {
            redirect('welcome');
        }
    }

    public function updateStatus(){
        if ($this->session->userdata('userinfo')) {
            date_default_timezone_set('Asia/Calcutta'); 
            $dd_driver  = $this->input->get('dd_driver');
            $order_idss    = $this->input->get('cart_id');

            $date                = date('d-m-Y');
            $wheredata=array(  
                'cart_id'    => $order_idss
            );
            $data=array(
                'cart_status'    => '4',
                'driver_id'    => $dd_driver
            );
            $result=$this->Model->update($wheredata,'cart',$data);
            if ($result) {
                redirect('Orders/pending');
            } else {
                redirect('Orders/pending');
            }
        }
    }  

    public function updateStatusAPI(){
        date_default_timezone_set('Asia/Calcutta'); 
        $dd_driver      = $this->input->get('dd_driver');
        $order_idss     = $this->input->get('cart_id');
        $dd_driver_name = $this->input->get('dd_driver_name');
        //$mulorder_idss = $this->input->get('mulorder_idss');
               
        // if (!$order_idss == '') {
        //   $date                = date('d-m-Y');
        //   $wheredata=array(  
        //       'cart_id'    => $order_idss
        //   );
        //   $data=array(
        //       'cart_status'   => '6',
        //       'driver_id'     => $dd_driver,
        //       'driver_name'   => $dd_driver_name
        //   );

        //   $result=$this->Model->update($wheredata,'cart',$data);
        //   if ($result) {
        //      $data_result['result']     = true;
        //   }else{
        //       $data_result['result']     = false;
        //   }
        // }
        // if(!$mulorder_idss == ''){
        //    $arrdata = explode(',', $mulorder_idss);
        //    foreach ($arrdata as $ar) {
        //       $date                = date('d-m-Y');
        //       $wheredata=array(  
        //           'cart_id'    => $ar
        //       );
        //       $data=array(
        //           'cart_status'   => '6',
        //           'driver_id'     => $dd_driver,
        //           'driver_name'   => $dd_driver_name
        //       );

        //       $result=$this->Model->update($wheredata,'cart',$data);
        //       if ($result) {
        //          $data_result['result']     = true;
        //       }else{
        //           $data_result['result']     = false;
        //       }
        //    }
        // }
       // die;
        $date                = date('d-m-Y');
        $wheredata=array(  
            'cart_id'    => $order_idss
        );
        $data=array(
            'cart_status'   => '6',
            'driver_id'     => $dd_driver,
            'driver_name'   => $dd_driver_name
        );

        $result=$this->Model->update($wheredata,'cart',$data);
        if ($result) {
           $data_result['result']     = true;
        }else{
            $data_result['result']     = false;
        }
        echo json_encode($data_result);
    }

  //   public function updateStatus($status,$id){
  //    if ($this->session->userdata('userinfo')) {
  //       date_default_timezone_set('Asia/Calcutta'); 
  //       $date                = date('d-m-Y');
  //       $wheredata=array(  
  //           'cart_id'    => $id
  //       );
  //       $data=array(
  //           'cart_status'    => $status
  //       );

  //       $result=$this->Model->update($wheredata,'cart',$data);
  //       if ($result) {
  //           // $wheredata=array(  
  //           //     'cart_id'    => $id
  //           // );
  //           // $result1=$this->Model->selectAllById1('cart',$wheredata);
  //           // $user_id = $result1->user_id;
  //           // $total_amount = $result1->total_price;
  //           // $whereUser=array(  
  //           //     'user_id'    => $user_id
  //           // );
  //           // $result2=$this->Model->selectAllById1('user',$whereUser);
  //           // if ( $result2) {
  //           //     $wal = $result2->wallet_amount;
  //           //     $amt = (int)$total_amount+(int)$wal;
  //           //     $dataAmt = array(
  //           //         'wallet_amount'    => $amt
  //           //     );
  //           //     $result3=$this->Model->update($whereUser,'user',$dataAmt);
  //           //     if ($result3) {
  //           //         $insertWallet = array(
  //           //             "user_id"      => $user_id,
  //           //             "walletAmount" => $total_amount,
  //           //             "created_at" => $date,
  //           //             "walletStatus" => 'Credited'
  //           //         );
  //           //         $result4=$this->Model->insert('wallet',$insertWallet);
  //           //         if ($result4) {
  //           //             redirect('Orders/pending');
  //           //         }else{
  //           //             redirect('Orders/pending');
  //           //         }
  //           //     }else{
  //           //         redirect('Orders/pending');
  //           //     }
  //           // }else{
  //           //     redirect('Orders/pending');
  //           // }
  //           redirect('Orders/pending');
  //       } else {
  //           redirect('Orders/pending');
  //       }
  //   }     
  // }


    public function updateStatusCenc($status,$id){
     if ($this->session->userdata('userinfo')) {
        date_default_timezone_set('Asia/Calcutta'); 
        $date                = date('d-m-Y');
        $wheredata=array(  
            'cart_id'    => $id
        );
        $data=array(
            'cart_status'    => $status
        );

        $result=$this->Model->update($wheredata,'cart',$data);
        if ($result) {
            $wheredata=array(  
                'cart_id'    => $id
            );
            $result1=$this->Model->selectAllById1('cart',$wheredata);
            $user_id = $result1->user_id;
            $total_amount = $result1->total_price;
            $whereUser=array(  
                'user_id'    => $user_id
            );
            $result2=$this->Model->selectAllById1('user',$whereUser);
            if ( $result2) {
                $wal = $result2->wallet_amount;
                $amt = (float)$total_amount+(float)$wal;
                $dataAmt = array(
                    'wallet_amount'    => $amt
                );
                $result3=$this->Model->update($whereUser,'user',$dataAmt);
                if ($result3) {
                    $insertWallet = array(
                        "user_id"      => $user_id,
                        "walletAmount" => $total_amount,
                        "created_at" => $date,
                        "walletStatus" => 'Credited'
                    );
                    $result4=$this->Model->insert('wallet',$insertWallet);
                    if ($result4) {
                        redirect('Orders/pending');
                    }else{
                        redirect('Orders/pending');
                    }
                }else{
                    redirect('Orders/pending');
                }
            }else{
                redirect('Orders/pending');
            }
            redirect('Orders/pending');
        } else {
            redirect('Orders/pending');
        }
    }     
  }


    public function fetchdata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }

        // 'order_date BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" and status=0'
        $result = $this->db->query('SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id JOIN city ON user.city_id = city.city_id JOIN state ON user.state_id = state.state_id  WHERE cart_status="1" and `date_time` BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" ORDER BY zone.zone_id DESC,subzone.subzone_id DESC,user.address ASC ')->result_array();
        // $result=$this->Model->selectdata('order',$wheredataa);

        echo json_encode($result);
    }
   
    public function accept(){
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/accept');
        } else {
            redirect('welcome');
        }
        
    }
    public function updateStatusAccepted($status,$id){
         if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
              
             $wheredata=array(  
                         'order_id'    => $id
                      );
                $data=array(
                         'status'    => $status
                      );
                $result['showOrder']=$this->Model->update($wheredata,'order',$data);
                if ( $result) {
             redirect('Orders/accept');
            }
          
            } else {
              redirect('Orders/accept');
            }
               
        }
    public function fetchdata1(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }
        // 'order_date BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" and status=0'
        $result = $this->db->query('SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id WHERE cart_status="4" and `date_time` BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'"')->result_array();
        // $result=$this->Model->selectdata('order',$wheredataa);
        echo json_encode($result);
    }
   
    public function cancelOrders(){
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/cancelOrder');
        } else {
            redirect('welcome');
        }
        
    }
    public function updateStatusCancal($status,$id){
      if ($this->session->userdata('userinfo')) {
   
          
         $wheredata=array(  
                 'order_id'    => $id
              );
        $data=array(
                 'status'    => $status
              );
        $result=$this->Model->update($wheredata,'order',$data);
        if ( $result) {
           redirect('Orders/cancelOrders');
        }
  
        } else {
            redirect('Orders/cancelOrders');
        }
           
    }
    public function canceldata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }
        // 'order_date BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" and status=0'
        $result = $this->db->query('SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id WHERE cart_status="2" and `date_time` BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'"')->result_array();
        // $result=$this->Model->selectdata('order',$wheredataa);
        echo json_encode($result);
    }
   
     public function deliverdOrder()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/deliverdOrder');
        } else {
            redirect('welcome');
        }
        
    }
     public function updateDeliveryOrder($status,$id){
      if ($this->session->userdata('userinfo')) {
   
          
         $wheredata=array(  
                 'cart_id'    => $id
              );
        $data=array(
                 'cart_status'    => $status
              );
        $result=$this->Model->update($wheredata,'cart',$data);
        if ( $result) {
            /*  -----  */

            // $wheredata=array(  
            //     'cart_id'    => $id
            // );
            // $result1=$this->Model->selectAllById1('cart',$wheredata);
            // $user_id = $result1->user_id;
            // $total_amount = $result1->total_price;
            // $whereUser=array(  
            //     'user_id'    => $user_id
            // );
            // $result2=$this->Model->selectAllById1('user',$whereUser);
            // if ( $result2) {
            //     $wal = $result2->wallet_amount;
            //     $amt = (int)$total_amount+(int)$wal;
            //     $dataAmt = array(
            //         'wallet_amount'    => $amt
            //     );
            //     $result3=$this->Model->update($whereUser,'user',$dataAmt);
            //     if ($result3) {
            //         $insertWallet = array(
            //             "user_id"      => $user_id,
            //             "walletAmount" => $total_amount,
            //             "created_at" => $date,
            //             "walletStatus" => 'Credited'
            //         );
            //         $result4=$this->Model->insert('wallet',$insertWallet);
            //         if ($result4) {
            //             redirect('Orders/deliverdOrder');
            //         }else{
            //             redirect('Orders/deliverdOrder');
            //         }
            //     }else{
            //         redirect('Orders/deliverdOrder');
            //     }
            // }else{
            //     redirect('Orders/deliverdOrder');
            // }
            /* ----- */
           redirect('Orders/deliverdOrder');
        }
  
        } else {
            redirect('Orders/deliverdOrder');
        }
           
    }
    public function deliverddata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }
        // 'order_date BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" and status=0'
        $result = $this->db->query('SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id WHERE cart_status="4" and `date_time` BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'"')->result_array();
        // $result=$this->Model->selectdata('order',$wheredataa);
        echo json_encode($result);
    }
     public function closedOrder()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/closedOrder');
        } else {
            redirect('welcome');
        }
        
    }
     public function closedata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }
        // 'order_date BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" and status=0'
        $result = $this->db->query('SELECT * FROM `order` WHERE status="5" and `order_date` BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'"')->result_array();
        // $result=$this->Model->selectdata('order',$wheredataa);
        echo json_encode($result);
    }
     public function returnOrder()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/return');
        } else {
            redirect('welcome');
        }
        
    }
     
     public function updateReturnOrder(){
     //public function updateReturnOrder($status,$id){
       date_default_timezone_set('Asia/Calcutta'); 
        $dd_driver  = $this->input->get('dd_driver');
        $order_idss    = $this->input->get('cart_id');
        $date                = date('d-m-Y');
        $date_trans          = date('Y-m-d h:i:s');
        $wheredata=array(  
            'cart_id'    => $order_idss
        );
        $data=array(
            'cart_status'    => '5',
            'driver_id'    => $dd_driver
        );

      if ($this->session->userdata('userinfo')) {
    
          
        //  $wheredata=array(  
        //          'cart_id'    => $id
        //       );
        // $data=array(
        //          'cart_status'    => $status
        //       );
        $result=$this->Model->update($wheredata,'cart',$data);
        if ($result) {
           /*  -----  */

            $wheredata=array(  
                //'cart_id'    => $id
                'cart_id'    => $order_idss
            );
            $result1=$this->Model->selectAllById1('cart',$wheredata);
            $user_id = $result1->user_id;
            $total_amount = $result1->total_price;
            $whereUser=array(  
                'user_id'    => $user_id
            );
            $result2=$this->Model->selectAllById1('user',$whereUser);
            if ( $result2) {
                $wal = $result2->wallet_amount;
                $amt = (float)$total_amount+(float)$wal;
                $dataAmt = array(
                    'wallet_amount'    => $amt
                );
                $result3=$this->Model->update($whereUser,'user',$dataAmt);
                if ($result3) {
                    $insertWallet = array(
                        "user_id"      => $user_id,
                        "walletAmount" => $total_amount,
                        "created_at" => $date,
                        "walletStatus" => 'Credited'
                    );
                    $result4=$this->Model->insert('wallet',$insertWallet);
                    $insertTrans = array(
                        "user_id"      => $user_id,
                        "amount" => $total_amount,
                        "date_time" => $date_trans,
                        "detail" => 'credit',
                        "pay_by" => 'order return',
                        "cart_id" => $order_idss
                    );
                    $resultTran=$this->Model->insert('transaction',$insertTrans);

                    if ($result4) {
                      //  redirect('Orders/returnOrder');
                    }else{
                      //  redirect('Orders/returnOrder');
                    }
                     $data_result['result']     = true;
                }else{
                  //  redirect('Orders/returnOrder');
                }
            }else{
               // redirect('Orders/returnOrder');
            }
            /* ----- */ 
         //  redirect('Orders/returnOrder');
        }
  
        } else {
          //  redirect('Orders/returnOrder');
        }
        echo json_encode($data_result);
           
    }
     public function returndata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }
        // 'order_date BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" and status=0'
        $result = $this->db->query('SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id WHERE cart_status="3" and `date_time` BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'"')->result_array();
        // $result=$this->Model->selectdata('order',$wheredataa);
        echo json_encode($result);
    }
    public function refundOrder()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/refundOrder');
        } else {
            redirect('welcome');
        }
        
    } 
    public function updateRefundOrder($status,$id){
      if ($this->session->userdata('userinfo')) {
   
          
         $wheredata=array(  
                 'cart_id'    => $id
              );
        $data=array(
                 'cart_status'    => $status
              );
        $result=$this->Model->update($wheredata,'cart',$data);
        if ( $result) {
           redirect('Orders/refundOrder');
        }
  
        } else {
            redirect('Orders/refundOrder');
        }
           
    }
    public function refunddata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }
        // 'order_date BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" and status=0'
        $result = $this->db->query('SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id WHERE cart_status="5" and `date_time` BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'"')->result_array();
        // $result=$this->Model->selectdata('order',$wheredataa);
        echo json_encode($result);
    }
     public function userCancelOrder()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/userCancelOrder');
        } else {
            redirect('welcome');
        }
        
        
    }
    public function updateUserCancelOrder($status,$id){
    if ($this->session->userdata('userinfo')) {
         $wheredata=array(  
                 'order_id'    => $id
              );
        $data=array(
                 'status'    => $status
              );
        $result=$this->Model->update($wheredata,'order',$data);
          if ( $result) {
            $wheredata=array(  
                'order_id'    => $id
            );
            $result1=$this->Model->selectAllById1('order',$wheredata);
            $user_id = $result1->user_id;
            $total_amount = $result1->total_amount;
            $whereUser=array(  
                'user_id'    => $user_id
            );
            $result2=$this->Model->selectAllById1('user',$whereUser);
            if ( $result2) {
                $wal = $result2->wallet_amount;
                $amt = (int)$total_amount+(int)$wal;
                $dataAmt = array(
                    'wallet_amount'    => $amt
                );
                $result3=$this->Model->update($whereUser,'user',$dataAmt);
                if ($result3) {
                    $insertWallet = array(
                        "user_id"      => $user_id,
                        "walletAmount" => $total_amount,
                        "created_at" => $date,
                        "walletStatus" => 'Credited'
                    );
                    $result4=$this->Model->insert('wallet',$insertWallet);
                    if ($result4) {
                        redirect('Orders/userCancelOrder');
                    }else{
                        redirect('Orders/userCancelOrder');
                    }
                }else{
                    redirect('Orders/userCancelOrder');
                }
            }else{
                redirect('Orders/userCancelOrder');
            }
        } else {
            redirect('Orders/userCancelOrder');
        }
    }     
  }
   public function userfetchdata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }
        // 'order_date BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" and status=0'
        $result = $this->db->query('SELECT * FROM `order` WHERE status="2" and `order_date` BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'"')->result_array();
        // $result=$this->Model->selectdata('order',$wheredataa);
        echo json_encode($result);
    }

   
    public function dispatch()
    {
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/dispatch');
        } else {
            redirect('welcome');
        }
        
    }   
    public function dispatchdata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }
        // 'order_date BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" and status=0'
        $result = $this->db->query('SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id WHERE cart_status="6" and `date_time` BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'"')->result_array();
        // $result=$this->Model->selectdata('order',$wheredataa);
        echo json_encode($result);
    }

    public function all_order(){
       
      if ($this->session->userdata('userinfo')) {
                      
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/orders/allneworder');
          
          } else {
          
            redirect('welcome');
        }
      }

      public function all_orderview($id){ 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            // $cartArray = array();
            $wheredata = array(
                'order_id'=>$id
            );
            $order=$this->Model->selectAllById('order',$wheredata);
            // print_r($order->cart_id);exit;
            $cartArray1 = explode(',', $order->cart_id);
             //echo count($cartArray1);
            for ($i=0; $i < count($cartArray1); $i++) { 
                $whereCart = array(
                    'cart_id'=>$cartArray1[$i]
                );  
                //print_r($whereCart);
                $cart = $this->Model->selectdata('cart',$whereCart);
                if ($cart) {
                    foreach ($cart as $key) {
                        $whereItem = array(
                            'item_id'=>$key['item_id']
                        ); 
                        $item = $this->Model->selectdata('item',$whereItem);
                        if ($item) {
                            foreach ($item as $value) {
                                $itemArray = array();
                                $itemArray = array(
                                    "item_id"       => $value['item_id'],
                                    "item_name"     => $value['item_name'],
                                    "item_images"   => $value['item_images'],
                                    "item_desc"     => $value['item_desc']
                                );
                            }
                            $cartArray[] = array(
                                "cart_id"       => $key['cart_id'],
                                "quanity"       => $key['quanity'],
                                "price"         => $key['price'],
                                "total_price"   => $key['total_price'],
                                "scheduleOn"    => $key['scheduleOn'],
                                "scheduleType"  => $key['scheduleType'],
                                "date_time"     => $key['date_time'],
                                "item"          => $itemArray
                            );
                        }else{
                            $cartArray[] = array(
                                "cart_id"       => $key['cart_id'],
                                "quanity"       => $key['quanity'],
                                "price"         => $key['price'],
                                "total_price"   => $key['total_price'],
                                "scheduleOn"    => $key['scheduleOn'],
                                "scheduleType"  => $key['scheduleType'],
                                "date_time"     => $key['date_time'],
                                "item"          => array()
                            );
                        }
                        $result['arr']  =   $cartArray;
                    }             
                }else{
                    $result['arr']  = '';
                } 
            }
            // print_r($result['arr']);
            $this->load->view('admin/all_orderview', $result);
            $this->load->view('admin/assets/footer');
        }else {
            redirect('welcome');
        }
    }

    public function fetchorderdata(){
        $from  = $this->input->get('from');
       

        if($from==""){
            $fromm = date('Y-m-d');
            
        }else{
            $fromm = date("Y-m-d", strtotime($from));
           
        }
        // 'order_date BETWEEN "'. date('Y-m-d', strtotime($fromm)). '" and "'. date('Y-m-d', strtotime($too)).'" and status=0'
        $result = $this->db->query('SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id  WHERE  `date_time` =  "'. date('Y-m-d', strtotime($fromm)). '" ')->result_array();
        // $result=$this->Model->selectdata('order',$wheredataa);

        echo json_encode($result);
    }  


   // Export Orders in CSV format 
    public function ExportData()
    {
       $export_from  = $this->input->post('export_from');
       $export_to    = $this->input->post('export_to');

       $filename = 'Dailywale_Summary_'.date('d-m-Y').'.csv'; 
       header("Content-Description: File Transfer"); 
       header("Content-Disposition: attachment; filename=$filename"); 
       header("Content-Type: application/csv; ");
       
       $usersData = $this->Model->getUserDetailsData1($export_from, $export_to);
   
       $file = fopen('php://output', 'w');
     
       $header = array("Item Name","Quanity","Item Quantity Desc","Seller Name"); 
       fputcsv($file, $header);
       foreach ($usersData as $key=>$line){ 
         fputcsv($file,$line); 
       }
       fclose($file); 
       exit; 
        
    }


    public function deliveryBoySummaryData()
    {
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }

        
        $result = $this->Model->getUserDetailsData1($fromm, $too);

        echo json_encode($result);

        
    }


    // Export Orders in CSV format 
    public function Export_Delivery_Data()
    {
       $export_from_delivery  = $this->input->post('export_from_delivery');
       $export_to_delivery    = $this->input->post('export_to_delivery');
       $filename = 'Dailywale_Orders_'.date('d-m-Y').'.csv'; 
       header("Content-Description: File Transfer"); 
       header("Content-Disposition: attachment; filename=$filename"); 
       header("Content-Type: application/csv; ");
       
       $users_delivery_Data = $this->Model->get_Delivery_Data1($export_from_delivery, $export_to_delivery);

       $file = fopen('php://output', 'w');
     
       $header = array("Subzone","Address","Item","Unit","Item Quantity Desc","First Name","Last Name","Zone","City","State"); 
       fputcsv($file, $header);
       foreach ($users_delivery_Data as $key1=>$line1){ 
         fputcsv($file,$line1); 
       }
       fclose($file); 
       exit; 
        
    }

    // Download Daily Orders CSV file on Server
    function downloadDailyOrdersCSV(){
        $export_from_delivery = date('d-m-Y'); //'25-01-2019'; 
        $export_to_delivery   = date('d-m-Y'); //'25-01-2019'; 

        //$export_from_delivery = '2-07-2019'; 
        //$export_to_delivery   = '2-07-2019'; 

        //date('d-m-Y');
        $SubZoneData = $this->Model->getSubZoneData();
        //print_r($SubZoneData);
        //exit;
        foreach ($SubZoneData as $SubData){  
                        $subzone_id=$SubData['subzone_id'];

            $filename = 'Dailywale_Orders_'.date('d-m-Y').'_'.$subzone_id.'.csv'; 
            $users_delivery_Data = $this->Model->get_Delivery_Data($export_from_delivery, $export_to_delivery,$subzone_id);

            $countNumber=count($users_delivery_Data);
            if($countNumber!=0){

                $file = fopen('php://output', 'w');
                $delimiter = ",";
                $csv = "Subzone,Address,Item,Unit,Item Quantity Desc,First Name,Last Name,Zone,City,State \n";
                foreach ($users_delivery_Data as $line){ 
                    $csv .= $line['subzone_name']. ',' . $line['address']. ',' . $line['item_name']. ',' . $line['quanity'] . ',' . $line['item_quantity_desc'] . ','  .$line['fname'] . ',' . $line['lname']. ',' . $line['zone_name']. ',' . $line['city_name']. ',' . $line['state_name'] . "\n";
                }
                fwrite($file, $csv); 
                $path=$_SERVER["DOCUMENT_ROOT"];
                file_put_contents($path."/dailywaleAdmin/download_csv/daily_order/" . $filename, $csv);
                fclose($file);


                $this->sendDailyOrderMail($subzone_id,$filename);
            }


            



        }
        
        
    }



    // Download Orders Summary CSV file on Server
    function downloadOrdersSummaryCSV(){
        $export_from = date('d-m-Y'); //'25-01-2019'; 
        $export_to   = date('d-m-Y'); //'25-01-2019'; 
        //date('d-m-Y');

        //$export_from = '2-07-2019'; 
        //$export_to   = '2-07-2019'; 

        $VendorData = $this->Model->getVendorData();
        foreach ($VendorData as $VenData){  
                        $vendor_id=$VenData['id'];

                $filename = 'Dailywale_Summary_'.date('d-m-Y')."_".$vendor_id.'.csv'; 
                $usersData = $this->Model->getUserDetailsData($export_from, $export_to,$vendor_id);

                $countNumber=count($usersData);
                if($countNumber!=0){

                        $file = fopen('php://output', 'w');
                        $delimiter = ",";
                        $csv = "Item Name,Quanity,Item Quantity Desc,Seller Name \n";
                        foreach ($usersData as $line){ 
                            $csv .= $line['item_name'] . ',' . $line['total']. ',' . $line['item_quantity_desc']. ',' . $line['name']. ',' . "\n";
                        }
                        fwrite($file, $csv); 
                        $path=$_SERVER["DOCUMENT_ROOT"];
                        file_put_contents($path."/dailywaleAdmin/download_csv/order_summary/" . $filename, $csv);
                        fclose($file);

                        $this->sendOrderSummaryMail($vendor_id,$filename);
                }
            }

    }


    function sendDailyOrderMail($subzone_id,$filename)
    {

        $config=array(
          'mailpath' => '/usr/sbin/sendmail',
          'protocol'=>'smtp',
          'smtp_host'=>'ssl://smtp.gmail.com',
          'smtp_port'=>465,
          'smtp_user'=>'sensanjay42@gmail.com',
          'smtp_pass'=>'atulLALIT',
          'mailtype'  => 'html', 
          'charset'   => 'iso-8859-1'
        );

        $this->load->library("email",$config);

        $this->email->set_newline("\r\n");
        $this->email->from('From Mail', 'From Sanjay Sen');
        $this->email->to('cakshaychouhan@gmail.com,dailywaleindia@gmail.com');
        $this->email->cc('khandaite@gmail.com');
        $this->email->subject('Notification for Daily Order');
        $this->email->message('Please find this attachment'); 
        
        $path=$_SERVER["DOCUMENT_ROOT"];
        
        $file=$path."/dailywaleAdmin/download_csv/daily_order/".$filename;

        $this->email->attach($file);

        if($this->email->send())
        {
            echo "Mail send successfully with attachement!";
        }else{
            show_error($this->email->print_debugger());
        }
    }


    function sendOrderSummaryMail($vendor_id,$filename)
    {

        $config=array(
          'mailpath' => '/usr/sbin/sendmail',
          'protocol'=>'smtp',
          'smtp_host'=>'ssl://smtp.gmail.com',
          'smtp_port'=>465,
          'smtp_user'=>'sensanjay42@gmail.com',
          'smtp_pass'=>'atulLALIT',
          'mailtype'  => 'html', 
          'charset'   => 'iso-8859-1'
        );

        $this->load->library("email",$config);

        $this->email->set_newline("\r\n");
        $this->email->from('From Mail', 'From Sanjay Sen');
        $this->email->to('cakshaychouhan@gmail.com,dailywaleindia@gmail.com');
        $this->email->cc('khandaite@gmail.com');
        $this->email->subject('Notification for Order Summary');
        $this->email->message('Please find this attachment.'); 
        
        $path=$_SERVER["DOCUMENT_ROOT"];
        
        $file=$path."/dailywaleAdmin/download_csv/order_summary/".$filename;

        $this->email->attach($file);

        if($this->email->send())
        {
            echo "Mail send successfully with attachement!";
        }else{
            show_error($this->email->print_debugger());
        }
    }
        

}
?>