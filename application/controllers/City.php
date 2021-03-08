<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ***************company details*****************
     public function city()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['city'] = $this->Model->getStateName();
            // print_r($data);exit;
            $this->load->view('admin/city/city', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *****************edit company details**********************
      public function CityAdd()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['state'] = $this->Model->select('state');
            $this->load->view('admin/city/addcity',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('City');
        }
    }


      public Function addCity()
        {
            if ($this->session->userdata('userinfo')) {  
             
                $data = array(
                    'state_id'   => $this->input->post('state_name'),
                    'city_name'   => $this->input->post('city_name'),
                    'is_status'   => $this->input->post('is_status')
                );
                $result = $this->Model->insert('city', $data);
                if ($result) {
                    $this->session->set_flashdata('City', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('City/city');
                    
                } else {
                    
                    $this->session->set_flashdata('City', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('City/city');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }
        
    public function user_active($id){
        $Data = array(
            'city_id' => $id
        );
        $data = array(
          'is_status'  => 'Offline'
        );
        $result = $this->Model->updateData('city',$data,$Data);

        if ( $result) {
          redirect('City/city');  
        }else{
          redirect('admin/city/city');
        }
    }

    public function user_deactive($id){
            $Data1 = array(
                  'city_id' => $id
                );
                $data11 = array(
                  'is_status'  => 'Online'
                );
                //print_r(expression)
                $resul = $this->Model->updateData('city',$data11,$Data1);
                // print_r($result);exit;
                if ($resul) {
                  redirect('City/city');  
                }else{
                  redirect('admin/city/city');
                }
        }
    //**************************company edit details***********  
        public function editcity($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('city_id' => $id );
            $data['records'] = $this->Model->selectAllById('city', $wheredata);
            $data['state'] = $this->Model->select('state');
            $this->load->view('admin/city/editcity',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function cityEdit()
    {
        if ($this->session->userdata('userinfo')) {
           $wheredata = array(
                'city_id' => $this->input->post('id')
            );
            
            $data = array(
                'state_id' => $this->input->post('state_name'),
                'city_name'    => $this->input->post('city_name')
            );
             $result = $this->Model->update($wheredata, 'city', $data);
             if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('City/city');
            
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                
                 redirect('City/city');
                
            }
        } else {
            redirect('Welcome');
        }
    }       
 public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'city_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('City/' . $rd);
        } else {
                   $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }



}      
   
?>