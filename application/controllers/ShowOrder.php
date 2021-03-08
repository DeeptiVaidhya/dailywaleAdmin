<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShowOrder extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ********************************
     public function showAllOrder()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
          
            $data['showOrder'] = $this->Model->select('order');
            // print_r($data);
            $this->load->view('admin/showOrder',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
    public function updateStatus($status,$id){
     if ($this->session->userdata('userinfo')) {
   
          
         $wheredata=array(  
                 'order_id'    => $id
              );
        $data=array(
                 'status'    => $status
              );
        $result=$this->Model->update($wheredata,'order',$data);
        if ( $result) {
           redirect('ShowOrder/showAllOrder');
        }
  
        } else {
            redirect('ShowOrder/showAllOrder');
        }
           
    }


}
?>