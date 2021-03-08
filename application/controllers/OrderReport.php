<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderReport extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
      public function zoneorder()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['zone'] = $this->Model->select('zone');
            $this->load->view('admin/zoneOrder/zoneOrder',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
    }

    public function fetchdata(){
        $zone_id=$this->input->post('value1');
        $wheredata=array('zone'=>$zone_id);
        $result['data']=$this->Model->selectdata('order',$wheredata);
        $this->load->view('admin/zoneOrder/zonefetchOrder',$result);
    }

      public function vendororder()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['vendor'] = $this->Model->select('vendor');
            $this->load->view('admin/vendorOrder/vendorOrder',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
    }

    public function fetchdata1(){
        $vendor_id=$this->input->post('value1');
        $wheredata=array('vendor_id'=>$vendor_id);
        $result['data']=$this->Model->selectdata('order',$wheredata);
        $this->load->view('admin/vendorOrder/vendorfetchorder',$result);
    }
      public function dailyorder()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            // $data['date'] = $this->Model->select('order');
            $this->load->view('admin/dailyOrder/dailyOrder');
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
    }
     public function fetchdata2(){
        $order_date=$this->input->post('value1');
        $newDate = date("Y-m-d", strtotime($order_date));
        $wheredata=array('order_date'=>$newDate);
        $result['data']=$this->Model->selectdata('order',$wheredata);
        $this->load->view('admin/dailyOrder/dailyfetchorder',$result);
    }


}
?>