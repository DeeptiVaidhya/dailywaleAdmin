<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('cookie');
            
        }
      public function transaction()
        {
            if ($this->session->userdata('userinfo')) {
                $this->load->view('admin/assets/header');
                $this->load->view('admin/assets/sidebar');
                // $data['wallet'] = $this->Model->getuserName();
                $data['transaction'] = $this->Model->select('transaction');
                $this->load->view('admin/orders/order_transaction', $data);
                $this->load->view('admin/assets/footer');
            } else {
                redirect('welcome');
            }
            
        }
    
    
    }
    ?>