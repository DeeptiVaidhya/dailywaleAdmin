<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VendorOrder extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('Model');
        
    }
    // ********************************
    public function pending(){           
       if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $vendorId=$this->session->userdata('vendorId');
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $data['pending'] = $this->Model->getOreder($vendorId , '1');
           // echo '<pre>'; print_r($data['pending']);exit;
            $this->load->view('vendor/orders/pending',$data);
            // $this->load->view('vendor/assets/footer');
        } else {
            redirect('VendorOrder/pending');
        }
        
    }
    public function dispatch(){           
       if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $vendorId=$this->session->userdata('vendorId');
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $data['dispatch'] = $this->Model->getOreder($vendorId , '6');
           // echo '<pre>'; print_r($data['pending']);exit;
            $this->load->view('vendor/orders/dispatch',$data);
            // $this->load->view('vendor/assets/footer');
        } else {
            redirect('VendorOrder/dispatch');
        }
        
    }

    public function confirmed() {    
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $vendorId=$this->session->userdata('vendorId');
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $data['comfirmed'] = $this->Model->getOreder($vendorId, '3');
             // print_r($data);exit;
            $this->load->view('vendor/orders/confirm',$data);
            // $this->load->view('vendor/assets/footer');
        }else{
            redirect('VendorOrder/confirmed');
        }
    }
    public function delivered(){   
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $vendorId=$this->session->userdata('vendorId');
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $data['delivered'] = $this->Model->getOreder($vendorId, '4');
            $this->load->view('vendor/orders/delivered',$data);
            // $this->load->view('vendor/assets/footer');
        }else{
            redirect('VendorOrder/delivered');
        }
    }
    public function refund(){    
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $vendorId=$this->session->userdata('vendorId');
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $data['refund'] = $this->Model->getOreder($vendorId, '5');
            // print_r($data);exit;
            $this->load->view('vendor/orders/refund',$data);
            // $this->load->view('vendor/assets/footer');
        }else{
            redirect('VendorOrder/refund');
        }
    }
    public function cancelled(){    
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $vendorId=$this->session->userdata('vendorId'); 
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $data['cancelled'] = $this->Model->getOreder($vendorId, '2');
            // print_r($data);exit;
            $this->load->view('vendor/orders/cancelled',$data);
            // $this->load->view('vendor/assets/footer');
        } else {
            redirect('VendorOrder/cancelled');
        }
    }

    public function pendingdata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }

        $vendorId=$_SESSION['vendor_id'];
        $qur = "SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id WHERE cart_status='1' and item.vendor_id='$vendorId' and `date_time` BETWEEN '". date('Y-m-d', strtotime($fromm)). "' and '". date('Y-m-d', strtotime($too))."'";
        $result = $this->db->query($qur)->result_array();
        echo json_encode($result);
    }

    public function confirmdata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }

        $vendorId=$_SESSION['vendor_id'];
        $qur = "SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id  WHERE cart_status='3' and item.vendor_id='$vendorId' and `date_time` BETWEEN '". date('Y-m-d', strtotime($fromm)). "' and '". date('Y-m-d', strtotime($too))."'";
        $result = $this->db->query($qur)->result_array();

        echo json_encode($result);
    }

    public function delivereddata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }
        

        $vendorId=$_SESSION['vendor_id'];
        $qur = "SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id  WHERE cart_status='4' and item.vendor_id='$vendorId' and `date_time` BETWEEN '". date('Y-m-d', strtotime($fromm)). "' and '". date('Y-m-d', strtotime($too))."'";
        $result = $this->db->query($qur)->result_array();

        echo json_encode($result);
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
        
        $vendorId=$_SESSION['vendor_id'];
        $qur = "SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id  WHERE cart_status='5' and item.vendor_id='$vendorId' and `date_time` BETWEEN '". date('Y-m-d', strtotime($fromm)). "' and '". date('Y-m-d', strtotime($too))."'";
        $result = $this->db->query($qur)->result_array();


        echo json_encode($result);
    }

    public function cancelleddata(){
        $from  = $this->input->get('from');
        $to    = $this->input->get('to');

        if($from=="" || $to==""){
            $fromm = date('Y-m-d');
            $too = date('Y-m-d');
        }else{
            $fromm = date("Y-m-d", strtotime($from));
            $too   = date("Y-m-d", strtotime($to));
        }
        
        $vendorId=$_SESSION['vendor_id'];
        $qur = "SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id WHERE cart_status='2' and item.vendor_id='$vendorId' and `date_time` BETWEEN '". date('Y-m-d', strtotime($fromm)). "' and '". date('Y-m-d', strtotime($too))."'";
        $result = $this->db->query($qur)->result_array();


        echo json_encode($result);
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

        $vendorId=$_SESSION['vendor_id'];
        $qur = "SELECT * FROM cart JOIN user ON cart.user_id = user.user_id JOIN item ON item.item_id = cart.item_id JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id WHERE cart_status='6' and item.vendor_id='$vendorId' and `date_time` BETWEEN '". date('Y-m-d', strtotime($fromm)). "' and '". date('Y-m-d', strtotime($too))."'";
        $result = $this->db->query($qur)->result_array();

        echo json_encode($result);
    }
}
?>