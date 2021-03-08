<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }

     function Existemail(){
        $email = $this->input->get('email');
        $query = $this->db->query("select * from customer where email='$email'");
        if ($query->num_rows() > 0){
            echo 1;
        }else{
            echo 0;
        }
    }
   /*************user details*************/
    public function country()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            
            $data['country'] = $this->Model->select('country');
            $this->load->view('admin/country', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *****************edit user details**********************
    public function editcountry($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('country_id' => $id );
            $data['records'] = $this->Model->selectAllById('country', $wheredata);
            $this->load->view('admin/country/editcountry',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function countryEdit()
    {
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
           
        
            $wheredata = array(
                'country_id' => $this->input->post('id')
            );
            
          
                $data = array(
                'name'    => $this->input->post('name'),   
                );
                
            $result = $this->Model->update($wheredata, 'country', $data);
            if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Country/country');
                
            } else {
                
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                
                 redirect('Country/country');
                
            }
        } else {
            redirect('Welcome');
        }
        
    }

     public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'country_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deleteuser', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>User Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Country/' . $rd);
        } else {
                   $this->session->set_flashdata('deleteuser', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>User Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }
    
     public function addcountry()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/country/addcountry');
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Country');
        }
    }

      public Function addcountrydetail()
        {
            if ($this->session->userdata('userinfo')) {  
                // echo  $this->input->post('name');exit;
            
                $data = array(
                    'name'    => $this->input->post('name'),
    
                );

                $result = $this->Model->insert('country', $data);
                if ($result) {
                    $this->session->set_flashdata('Country', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customer Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Country/country');
                    
                } else {
                    
                    $this->session->set_flashdata('Country', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Country/country');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }
       


}
?>
