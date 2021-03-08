<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }

    public function viewReport(){     
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['state'] = $this->Model->select('state');
            $data['city'] = $this->Model->select('city');
            $data['zone'] = $this->Model->select('zone');
            $data['subzone'] = $this->Model->select('subzone');
            $this->load->view('admin/report/viewreport', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
    }


    public function Search(){
        $state      = $this->input->get('state');
        $city       = $this->input->get('city');
        $zone       = $this->input->get('zone'); 
        $subzone    = $this->input->get('subzone');
        $datefilter = $this->input->get('datefilter');
        $date_arr = explode('-', $datefilter);
        $date_start = $date_arr[0];
        $date_end = $date_arr[1];
        //$date_start1 = date("Y-m-d", strtotime($date_start));
        //$date_end1   = date("Y-m-d", strtotime($date_end));
       


        if (!$state == '' || $city == '' || $zone == '' || $subzone == '' ) {
           $User = $this->db->query('SELECT * FROM user WHERE state_id = "'.$state.'" ')->result_array();

            if ($User) {
                foreach ($User as $u) {
                  $checkCart_Order = $this->db->query('SELECT * FROM cart WHERE cart_status="4" AND user_id = "'.$u['user_id'].'"')->num_rows();    
                  if($checkCart_Order > 0){

                    $result = $this->db->query('SELECT * FROM cart JOIN item ON item.item_id = cart.item_id WHERE cart_status="4" AND cart.user_id = "'.$u['user_id'].'" AND cart.date_time BETWEEN "'. date('Y-m-d', strtotime($date_start)). '" and "'. date('Y-m-d', strtotime($date_end)).'" ')->result_array();
                      
                    $arrayName[] = array(
                        'fname'    => $u['fname'],
                        'lname'    => $u['lname'],
                        'email'    => $u['email'],
                        'mobile'   => $u['user_mobile'],
                        'cartData' => $result,
                    );    
                  }
                }
            }
        }
        if(!$city == '' || $zone == '' || $subzone == '' || $state == '' ) {
            $User = $this->db->query('SELECT * FROM user WHERE city_id = "'.$city.'" ')->result_array();

            if ($User) {
                foreach ($User as $u) {
                  $checkCart_Order = $this->db->query('SELECT * FROM cart WHERE cart_status="4" AND user_id = "'.$u['user_id'].'" ')->num_rows();    
                  if($checkCart_Order > 0){

                    $result = $this->db->query('SELECT * FROM cart JOIN item ON item.item_id = cart.item_id WHERE cart_status="4" AND cart.user_id = "'.$u['user_id'].'" AND cart.date_time BETWEEN "'. date('Y-m-d', strtotime($date_start)). '" and "'. date('Y-m-d', strtotime($date_end)).'" ')->result_array();
                      
                    $arrayName[] = array(
                        'fname'    => $u['fname'],
                        'lname'    => $u['lname'],
                        'email'    => $u['email'],
                        'mobile'   => $u['user_mobile'],
                        'cartData' => $result,
                    );    
                  }
                }
            }
        }
        if(!$zone == '' || $subzone == '' || $city == '' || $state == '' ) {
            $User = $this->db->query('SELECT * FROM user WHERE zone_id = "'.$zone.'" ')->result_array();

            if ($User) {
                foreach ($User as $u) {
                  $checkCart_Order = $this->db->query('SELECT * FROM cart WHERE cart_status="4" AND user_id = "'.$u['user_id'].'" ')->num_rows();    
                  if($checkCart_Order > 0){

                    $result = $this->db->query('SELECT * FROM cart JOIN item ON item.item_id = cart.item_id WHERE cart_status="4" AND cart.user_id = "'.$u['user_id'].'" AND cart.date_time BETWEEN "'. date('Y-m-d', strtotime($date_start)). '" and "'. date('Y-m-d', strtotime($date_end)).'"')->result_array();
                      
                    $arrayName[] = array(
                        'fname'    => $u['fname'],
                        'lname'    => $u['lname'],
                        'email'    => $u['email'],
                        'mobile'   => $u['user_mobile'],
                        'cartData' => $result,
                    );    
                  }
                }
            }
        }

        if(!$subzone == '' || $subzone == '' || $city == '' || $state == '') {
            $User = $this->db->query('SELECT * FROM user WHERE subzone_id = "'.$subzone.'" ')->result_array();

            if ($User) {
                foreach ($User as $u) {
                  $checkCart_Order = $this->db->query('SELECT * FROM cart WHERE cart_status="4" AND user_id = "'.$u['user_id'].'" ')->num_rows();    
                  if($checkCart_Order > 0){

                    $result = $this->db->query('SELECT * FROM cart JOIN item ON item.item_id = cart.item_id WHERE cart_status="4" AND cart.user_id = "'.$u['user_id'].'" AND cart.date_time BETWEEN "'. date('Y-m-d', strtotime($date_start)). '" and "'. date('Y-m-d', strtotime($date_end)).'" ')->result_array();
                      
                    $arrayName[] = array(
                        'fname'    => $u['fname'],
                        'lname'    => $u['lname'],
                        'email'    => $u['email'],
                        'mobile'   => $u['user_mobile'],
                        'cartData' => $result,
                    );    
                  }
                }
            }
        }


        echo json_encode($arrayName);
    }


 }
 ?>   
