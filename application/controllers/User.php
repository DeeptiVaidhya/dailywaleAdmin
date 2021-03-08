<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // public function user()
    // {
        
    //     if ($this->session->userdata('userinfo')) {
    //         $this->load->view('admin/assets/header');
    //         $this->load->view('admin/assets/sidebar');
    //         // $data['user'] = $this->Model->getuserName();
    //         $data['user'] = $this->Model->getUserInfo();
    //         $this->load->view('admin/user/user', $data);
    //         $this->load->view('admin/assets/footer');
    //     } else {
    //         redirect('welcome');
    //     }
        
    // }

    public function user(){
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['user'] = $this->Model->select('user', 'subzone_id asc');
            $zone = $data['user'];
                foreach ($zone as $value) {
                    $subZoneId[] = $value['subzone_id'];
                    $ZoneId[]    = $value['zone_id'];
                    $CityId[]    = $value['city_id'];
                }
                $wheresubzone = array(
                    'subzone_id'=>$subZoneId
                );

                $wherezone = array(
                    'zone_id'=>$ZoneId
                );

                $wherecity = array(
                    'city_id'=>$CityId
                );

                $data['City'] = $this->Model->selectAllUserCityName('city', $wherecity);
                $data['subzone'] = $this->Model->selectAllUsersubzone('subzone', $wheresubzone);
                $data['zone'] = $this->Model->selectAllUserZone('zone', $wherezone);

                //print_r($data);exit;

            $this->load->view('admin/user/user', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }

    
    public function userAdd(){ 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['state'] = $this->Model->select('state');
            $data['city'] = $this->Model->select('city');
            $this->load->view('admin/user/adduser',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('User');
        }
    }


    public Function addUser(){
        if ($this->session->userdata('userinfo')) {  
            $date=date('d-m-Y');     
            $data = array(
                'fname'        => $this->input->post('fname'),
                'lname'        => $this->input->post('lname'),
                'email'        => $this->input->post('email'),
                'pwd'          => $this->input->post('pwd'),
                'user_mobile'  => $this->input->post('user_mobile'),
                'gender'       => $this->input->post('gender'),
                'dob'          => $this->input->post('dob'),
                'city_id'      => $this->input->post('city_name'),
                'pincode'      => $this->input->post('pincode'),
                'address'      => $this->input->post('address'),
                // 'wallet_amount'=> $this->input->post('wallet_amount'),
                'created_at'   => $date,
                'updated_at'   => $date
            );
            $result = $this->Model->insert('user', $data);
            if ($result) {
                $this->session->set_flashdata('User', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>State Add Sucessfully!!</strong>.
                </div>');
                
                redirect('User/user');
            }else{   
                $this->session->set_flashdata('User', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Customers Not Add!!</strong>.
                </div>');
                
                redirect('User/user');
            }
        } else {
            redirect('Welcome', 'refresh');
        }
            
    }

    public function edituser($id){
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('user_id' => $id );
            $data['records'] = $this->Model->selectAllById('user', $wheredata);
            $data['zone'] = $this->Model->select('zone');
            $data['subzone'] = $this->Model->select('subzone');
            $data['city'] = $this->Model->select('city');
            $data['state'] = $this->Model->select('state');
            $this->load->view('admin/user/edituser',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
    }
    public function userEdit(){
        if ($this->session->userdata('userinfo')) {
             $date=date('d-m-Y');
           $wheredata = array(
                'user_id' => $this->input->post('id')
            );
            $data = array(
                'fname'        => $this->input->post('fname'),
                'lname'        => $this->input->post('lname'),
                'email'        => $this->input->post('email'),
                'pwd'          => $this->input->post('pwd'),
                'user_mobile'  => $this->input->post('user_mobile'),
                'gender'       => $this->input->post('gender'),
                'dob'          => $this->input->post('dob'),
                'state_id'     => $this->input->post('state_name'),
                'city_id'      => $this->input->post('city_name'),
                'zone_id'      => $this->input->post('zone_name'),
                'subzone_id'   => $this->input->post('subzone_name'),
                'pincode'      => $this->input->post('pincode'),
                'address'      => $this->input->post('address'),
                // 'wallet_amount'=> $this->input->post('wallet_amount'),
                'created_at'   => $date,
                'updated_at'   => $date
            );
             $result = $this->Model->update($wheredata, 'user', $data);
             if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('User/user');
            
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                
                 redirect('User/user');  
            }
        } else {
            redirect('Welcome');
        }
    }   

    public function viewrecord($id){ 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('user_id' => $id );
            $data['userdata']  = $this->Model->getUserData($wheredata);
            $data['lastOrder'] = $this->Model->getLastOrder($id);
            $data['allnotification'] = $this->Model->getNotificationDetail($id);
            //$data['allnotification'] = $this->Model->selectdata('notification' ,$wheredata);
            //$data['records'] = $this->Model->selectAllById('user', $wheredata);
            $data['upcoming_order'] = $this->Model->getOrderHistory_upcoming($id);
            $data['wallet_amount'] = $this->Model->getWalletHistory($id);
            //$data['past_order_date'] = $this->Model->getOrderHistory($id);
            $data['past_order'] = $this->Model->getOrderHistory_past($id);
            $this->load->view('admin/user/viewrecord',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
    }   

    public function deleterecord($id, $tbl, $rd){
        if ($this->session->userdata('userinfo')) {
            $wheredata    = array(
                'user_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('User' . $rd);
        } else {
                   $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }


    function getCity($level1){
       $city   = $level1;   
       $result = $this->db->query('SELECT * FROM `city` WHERE state_id = "'.$city.'"')->result_array();
       echo json_encode($result);
    }

    function getzone($cityId){
       $cityId   = $cityId;   
       $result = $this->db->query('SELECT * FROM `zone` WHERE city_id = "'.$cityId.'"')->result_array();
       echo json_encode($result);      
    }

    function getSubzone($zoneId){
       $zoneId   = $zoneId;   
       $result = $this->db->query('SELECT * FROM `subzone` WHERE zone_id = "'.$zoneId.'"')->result_array();
       echo json_encode($result); 
    }

    public function UserLastOrder(){     
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['user'] = $this->Model->select('user', 'subzone_id asc');
            $this->load->view('admin/user/lastorder', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
    }



 }
 ?>   
