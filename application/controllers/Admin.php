<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		 parent::__construct();
        $this->load->helper('cookie');
	}
	    public function profile()
    {
        
        if ($this->session->userdata('userinfo')) {
            // print_r($this->session->userdata('userinfo')->id);
            $admin_id = $this->session->userdata('userinfo')->id;
            $wheredata = array("id"=>$admin_id);
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['records'] = $this->Model->selectAllById('admin',$wheredata);
            $this->load->view('admin/admin_profile',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
	 public function edit_profile($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $admin_id = $this->session->userdata('userinfo')->id;
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array("id" => $admin_id);
            $data['records'] = $this->Model->selectAllById('admin', $wheredata);
            $this->load->view('admin/admin_profile',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }
    public function profile_Edit()
    {
        if ($this->session->userdata('userinfo')) {
             $admin_id = $this->session->userdata('userinfo')->id;
             $picture = $this->input->post('picture1');
             $wheredata = array(
                    'id' => $admin_id
                    );
              if (!empty($_FILES['picture']['name'])) {
                $config['upload_path']   = 'uploads/user/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name']     =time().rand(10000,99999).".jpg";
                
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               
                if ($this->upload->do_upload('picture')) {
                    // echo "string";
                    $uploadData = $this->upload->data();
                    $picture    = $uploadData['file_name'];
                     
                    $data = array(
                    	'profile'  => $picture, 
                    );
                } else { 
                     $data = array(
                        'profile'  => $picture, 
                    );
                }
            } else {
            	  $data = array(
                        'profile'  => $picture, 
                    );
           		 }
           	
     
            $result = $this->Model->update($wheredata, 'admin', $data);
            if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Admin/profile');
            } else {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                 redirect('Admin/profile');
            }
        }else {
            redirect('Welcome');
        }
    }
    

}
?>