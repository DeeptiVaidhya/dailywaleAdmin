<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function dashboard()
	{
        if($this->session->userdata('userinfo')){
		$this->load->view('admin/assets/header');
		$this->load->view('admin/assets/sidebar');
        $data['user']=$this->Model->record_count('country');
        $data['state']=$this->Model->record_count('state');
        $data['city']=$this->Model->record_count('city');
        $data['zone']=$this->Model->record_count('zone');
        $data['subzone']=$this->Model->record_count('subzone');
        $data['category']=$this->Model->record_count('cat');
        $data['sub_cat']=$this->Model->record_count('sub_cat');
        $data['item']=$this->Model->record_count('item');
        $data['banner']=$this->Model->record_count('banners');
        $data['pop_items']=$this->Model->record_count('popular_items');
        // print_r($data);exit;
		$this->load->view('admin/index',$data);
		$this->load->view('admin/assets/footer');
    }else{
        redirect('Welcome');
    }
    
	}



	public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $rem      = $this->input->post('rem');
        
        if ($rem) {
           
            // exit;
            setcookie("name", $username, time() + (86400 * 30), "/");
            setcookie("pass", $password, time() + (86400 * 30), "/");
            setcookie("rem", $rem, time() + (86400 * 30), "/");
        } else {
            
            setcookie("name", "", time() - (100), "/");
            setcookie("pass", "", time() - (100), "/");
            setcookie("rem", "", time() - (100), "/");
        }
        $wheredata=array('email'=>$username,
                         'password'=>$password,
        );
        $result = $this->Model->login($wheredata,'admin');
        
        if ($result) {
            //echo $result->user_type;exit;
            
            $this->session->set_userdata('userinfo',$result);
            $_SESSION['userType'] =$result->user_type;
            $this->session->set_flashdata('Sucessmessage', '<div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Welcome!</strong>' . $username . ' .
            </div>');
                                          
            redirect('welcome/dashboard');
            
        } else {
            
            $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable">
            
            <strong>Sorry!</strong> Incorrect Email And Password.
            </div>');
            redirect('Welcome');
            
        }
	}
       //for logout
    
    public function logout()
    {
        
        $this->session->unset_userdata('userinfo');
        session_destroy();
        redirect(base_url(), 'refresh');
    }
 	
}
?>
