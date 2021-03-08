<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

    public function index()
    {
        $this->load->view('vendor/login');
    }

    public function dashboard(){
        if($this->session->userdata('vendorinfo')){
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');     
            $wheredata = array(
                'vendor_id' => $_SESSION['vendor_id']
            );
            $data['items']=$this->Model->record_count('item', $wheredata);
            $data['service_pros'] = $this->Model->record_count('service_provider', $wheredata);
            $this->load->view('vendor/index',$data);
            $this->load->view('vendor/assets/footer');
        }else{
            redirect('Vendor');
        }
    }

    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $rem      = $this->input->post('rem');
        
        if($rem){
            setcookie("name", $username, time() + (86400 * 30), "/");
            setcookie("pass", $password, time() + (86400 * 30), "/");
            setcookie("rem", $rem, time() + (86400 * 30), "/");
        }else{
            setcookie("name", "", time() - (100), "/");
            setcookie("pass", "", time() - (100), "/");
            setcookie("rem", "", time() - (100), "/");
        }
        $wheredata=array(
            'email'=>$username,
            'pwd'=>$password,
        );
        $result = $this->Model->login($wheredata,'vendor');
        // echo count($result);exit;
        if ($result) {
            $ses = array(
                'vendorinfo' => $result->email,
                'name' => $result->name,
                'vendorId' => $result->id
            );

            $_SESSION['vendor_id'] = $result->id;
           // print_r($_SESSION['vendor_id'] );die;
            $this->session->set_userdata($ses);
            $this->session->set_flashdata('Successmessage', '<div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Welcome!</strong>' . $username . ' .
            </div>');
            redirect('Vendor/dashboard');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable">
            <strong>Sorry!</strong> Incorrect Email And Password.
            </div>');
            redirect('Vendor');
        }
    }
       //for logout
    
    public function logout()
    {  
       // print_r('expression');die;
        $this->session->unset_userdata('vendorinfo');
        session_destroy();
        redirect('Vendor');
    }
    public function item()
    { 
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $wheredata = array(
                'vendor_id' => $_SESSION['vendor_id']
            );
            $data['item'] = $this->Model->getitemNameWhere($wheredata);
            //$data['item'] = $this->Model->getitemName();
            $this->load->view('vendor/item/item',$data);
            $this->load->view('vendor/assets/footer');
        } else {
            redirect('welcome');
        }
    }
    public function item_Add()
    { 
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $data['item'] = $this->Model->select('item');
            $data['sub_cat'] = $this->Model->joinCatSubCat();
            $data['vendor'] = $this->Model->select('vendor');
            $this->load->view('vendor/item/additem',$data);
            $this->load->view('vendor/assets/footer');
        } else {
            redirect('Vendor');
        }
    }
    public Function add_item(){
        if ($this->session->userdata('vendorinfo')) { 
        $date=date('d-m-Y');
        if (!empty($_FILES['picture']['name'])) {
            $config['upload_path']   = 'uploads/user';
            $config['allowed_types'] = 'img|jpg|jpeg|png|gif';
            $config['file_name']     = $_FILES['picture']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('picture')) {
                $uploadData = $this->upload->data();
                $picture    = $uploadData['file_name'];
            } else {
                $picture = '';
            }
        } else {
            $picture = '';
        }
       
            $data = array(
                'item_name'      => $this->input->post('item_name'),
                'vendor_id'     => $_SESSION['vendor_id'],
                'sub_cat_id'   => $this->input->post('sub_cat_name'),
                'item_images'  => $picture,
                'item_desc'     => $this->input->post('item_desc'),
                'item_price'     => $this->input->post('item_price'),
                'item_unit'       => $this->input->post('item_unit'),
                'is_out_of_stock'   => $this->input->post('is_out_of_stock'),
                'tax'            => $this->input->post('tax'),
                'is_online'    => $this->input->post('is_online'),
                'created_at'    => $date
            );
            $result = $this->Model->insert('item', $data);
            if ($result) {
                $this->session->set_flashdata('Vendor', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>State Add Sucessfully!!</strong>.
                </div>');
                
                redirect('Vendor/item');
                
            }else{
                
                $this->session->set_flashdata('Vendor', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Customers Not Add!!</strong>.
                </div>');
                
                redirect('Vendor/item');    
            }
            
        } else {
            redirect('Welcome', 'refresh');
        }
        
    }
    
    public function edit_item($id)
    {
        
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $wheredata  = array('item_id' => $id );
            $data['records'] = $this->Model->selectAllById('item', $wheredata);
            $data['sub_cat'] = $this->Model->joinCatSubCat();
            $data['vendor'] = $this->Model->select('vendor');
            $this->load->view('vendor/item/edititem',$data);
            $this->load->view('vendor/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function item_Edit()
    {
        if ($this->session->userdata('vendor_id')) {
            $date=date('d-m-Y');
             $wheredata = array(
                    'item_id' => $this->input->post('id')
                    );
              if (!empty($_FILES['picture']['name'])) {
                $config['upload_path']   = 'uploads/user/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name']     = $_FILES['picture']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture    = $uploadData['file_name'];
                     
                    $data = array(
                    'item_name'   => $this->input->post('item_name'),
                    'vendor_id'   =>  $_SESSION['vendor_id'],
                    'sub_cat_id'   => $this->input->post('sub_cat_name'),
                    'item_images'  => $picture,
                    'item_desc'     => $this->input->post('item_desc'),
                    'item_price'     => $this->input->post('item_price'),
                    'item_unit'       => $this->input->post('item_unit'),
                    'is_out_of_stock'   => $this->input->post('is_out_of_stock'),
                    'tax'            => $this->input->post('tax'),
                    'is_online'    => $this->input->post('is_online'),
                    'updated_at'    => $date            
                    );
                } else {
                    
                    $picture = '';
                    $data = array(
                    'item_name'   => $this->input->post('item_name'),
                    'vendor_id'   => $_SESSION['vendor_id'],
                    'sub_cat_id'   => $this->input->post('sub_cat_name'),
         
                    'item_desc'     => $this->input->post('item_desc'),
                    'item_price'     => $this->input->post('item_price'),
                    'item_unit'       => $this->input->post('item_unit'),
                    'is_out_of_stock'   => $this->input->post('is_out_of_stock'),
                    'tax'            => $this->input->post('tax'),
                    'is_online'    => $this->input->post('is_online'),
                    'updated_at'    => $date  
                    
                     );
                }
            } else {
                $picture = '';
                $data = array(
                   'item_name'   => $this->input->post('item_name'),
                   'vendor_id'   =>$_SESSION['vendor_id'],
                    'sub_cat_id'   => $this->input->post('sub_cat_name'),
                  
                    'item_desc'     => $this->input->post('item_desc'),
                    'item_price'     => $this->input->post('item_price'),
                    'item_unit'       => $this->input->post('item_unit'),
                    'is_out_of_stock'   => $this->input->post('is_out_of_stock'),
                    'tax'            => $this->input->post('tax'),
                    'is_online'    => $this->input->post('is_online'),
                    'updated_at'    => $date  
                    
                );         
            }  
     
            $result = $this->Model->update($wheredata, 'item', $data);
            if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Vendor/item');
            } else {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                 redirect('Vendor/item');
            }
        } else {
            redirect('Welcome');
        }
    }
    public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('vendorinfo')) {
            
            $wheredata    = array(
                'item_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Vendor/' . $rd);
        } else {
                   $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }

    public function service_provider()
    {
        
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            // $data['service_pro'] = $this->Model->select('service_provider');
            // $data['item'] = $this->Model->select('item');
            $data['service_pro'] = $this->Model->getserviceName();
            $this->load->view('vendor/services/service_provider',$data);
            $this->load->view('vendor/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
    
    public function services_Add()
    { 
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $data['service_pro'] = $this->Model->select('service_provider');
            $data['item'] = $this->Model->select('item');
            $data['vendor'] = $this->Model->select('vendor');
            
            $this->load->view('vendor/services/add_services',$data);
            $this->load->view('vendor/assets/footer');
        } else {
            redirect('Vendor');
        }
    }


    public Function add_services()
    {
        if ($this->session->userdata('vendorinfo')) {

        $date=date('Y-m-d');
        // echo $this->input->post('sub_cat_name');exit;
       
            $data = array(
                'provider_id'       =>$this->input->post('item_name'),
                'vendor_id'       =>$_SESSION['vendor_id'],
                'description'      => $this->input->post('description'),
                'title'             => $this->input->post('title'),
                'pre_booking_price'  => $this->input->post('pre_booking_price'),
               ' created_at'        => $date,
               ' updated_at'       => $date
            );
            $result = $this->Model->insert('service_provider', $data);
            if ($result) {
                $this->session->set_flashdata('Vendor', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>State Add Sucessfully!!</strong>.
                </div>');
                
                redirect('Vendor/service_provider');
                
            } else {
                
                $this->session->set_flashdata('Service_provider', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Customers Not Add!!</strong>.
                </div>');
                
                redirect('Vendor/service_provider');
                
            }
            
        }else{
            redirect('Welcome', 'refresh');
        }
        
    }
    
    public function edit_services($id)
    {
        
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $this->load->view('vendor/assets/header',$data);
            $this->load->view('vendor/assets/sidebar');
            $wheredata  = array('service_id' => $id );
            $data['records'] = $this->Model->selectAllById('service_provider', $wheredata);
            $data['item'] = $this->Model->select('item');
             $data['vendor'] = $this->Model->select('vendor');
            $this->load->view('vendor/services/edit_service',$data);
            $this->load->view('vendor/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function services_Edit()
    {
        if ($this->session->userdata('vendorinfo')) {
            $date=date('Y-m-d');
             $wheredata = array(
                    'service_id' => $this->input->post('id')
                );       
                $data = array(
                 'vendor_id'       =>$_SESSION['vendor_id'],
                 'provider_id'       =>$this->input->post('item_name'),   
                'description'      =>$this->input->post('description'),
                'title'             => $this->input->post('title'),
                'pre_booking_price'  => $this->input->post('pre_booking_price'), 
                ' created_at'        => $date,
                ' updated_at'       => $date            
                );     
                $result = $this->Model->update($wheredata, 'service_provider', $data);
                if ($result) {
                 $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Vendor/service_provider');
            } else {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                 redirect('Vendor/service_provider');
            }
        } else {
            redirect('Welcome');
        }
    }
    public function deleterecordservices($id, $tbl, $rd)
    {
        if ($this->session->userdata('vendorinfo')) {
            
            $wheredata    = array(
                'service_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Vendor/' . $rd);
        } else {
                $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }

   public function user_profile(){
       // print_r($_SESSION) ;die;
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
  
            $this->load->view('vendor/assets/header', $data);
            $this->load->view('vendor/assets/sidebar');
            $this->load->view('vendor/profile', $data); 
            $this->load->view('vendor/assets/footer');   
        } else {
            redirect('Vendor');
        }
        
    }
    

    public function uploadProfile(){
        //print_r($this->session->userdata('vendor_id'));die;
        $Id=$this->session->userdata('vendor_id'); 
        $resfalse= $this->Model->show_pro_profile($Id);
        $picture = $this->input->post('picture1');
        date_default_timezone_set('Asia/Calcutta');
        $date=date('Y-m-d H:i:s');
        $config['upload_path']   = 'assets/img/'; 
        $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
        $config['max_size']      = 10000; 
        $config['max_width']     = 1024; 
        $config['max_height']    = 768;
        $config['file_name']     =time().rand(10000,99999).".jpg";  
        $this->load->library('upload', $config);
        $path='';
         //print_r($_FILES['picture']);exit;

        if (empty($_FILES['picture']['name'])) {
            $wheredata = array(
                'id'=>$Id
            );
            $data = array(
                'name'                         =>$this->input->post('name'),
                'address'                      =>$this->input->post('address'),
                'email'                        =>$this->input->post('email'),
                'phone'                        =>$this->input->post('phone'),
                'pwd'                          =>$this->input->post('pwd'),
                'profile'                      =>$picture
                
            );

            $result2=$this->Model->update($wheredata,'vendor',$data);
                if ($result2) {
                    $this->session->set_flashdata('msg','<div id="msg" class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Profile Updated Sucessfully!!</strong>.
                        </div>');
                    $this->load->view('vendor/assets/header');
                    redirect ("Vendor/user_profile");  
                }else{
                    $this->load->view('vendor/assets/header');
                    redirect ("Vendor/user_profile");  
                }

            }else{
              
            if (!$this->upload->do_upload('picture')) {
                $picture=$_FILES['picture'];
                $config['upload_path']   = 'assets/img/'; 
                $data = array('upload_data' => $this->upload->data()); 
                $path= 'assets/img/'.$data['upload_data']['file_name'];
                $picture1= 'assets/img/'.$picture['name'];
                //$picture1= 'assets/img/'.$data['upload_data']['file_name'];
         
            $where_data = array(
                'id'=>$Id
            );
            $data = array(
                'name'                         =>$this->input->post('name'),
                'address'                      =>$this->input->post('address'),
                'email'                        =>$this->input->post('email'),
                'phone'                        =>$this->input->post('phone'),
                'pwd'                          =>$this->input->post('pwd'),
                'profile'                       =>$picture1
            );

          //  print_r($data);die;
            $result2=$this->Model->update($where_data,'vendor',$data);
            if ($result2) {
                $this->session->set_flashdata('msg','<div id="msg" class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Profile Update Sucessfully!!</strong>.
                          </div>');
                $this->load->view('vendor/assets/header');
                redirect ("Vendor/user_profile");  
            }else{
                $this->load->view('vendor/assets/header');
                redirect ("Vendor/user_profile");  
            }
        }
    }

}

    public function payment_history(){
        $VanderIds =  $_SESSION['vendor_id'];
        if ($this->session->userdata('vendor_id')) {
            $Id=$this->session->userdata('vendor_id');
            $data['vendorDetail']= $this->Model->show_pro_profile($Id);
            $data['payment'] = $this->Model->selectHistory($VanderIds);
            $this->load->view('vendor/assets/header', $data);
            $this->load->view('vendor/assets/sidebar');
            $this->load->view('vendor/payment_history', $data); 
            $this->load->view('vendor/assets/footer');   
        } else {
            redirect('Vendor');
        }

    }
}
?>