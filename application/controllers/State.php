<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ***************company details*****************
     public function state()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['state'] = $this->Model->getCountryName();
            // print_r($data);exit;
            $this->load->view('admin/state/state', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *****************edit company details**********************
      public function StateAdd()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['country'] = $this->Model->select('country');
            $this->load->view('admin/state/addstate',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('State');
        }
    }


      public Function addState()
        {
            if ($this->session->userdata('userinfo')) {  
             
                $data = array(
                    'country_id'   => $this->input->post('country_name'),
                    'state_name'   => $this->input->post('state_name'),
                    'is_status'   => $this->input->post('is_status')
                );
                $result = $this->Model->insert('state', $data);
                if ($result) {
                    $this->session->set_flashdata('State', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('State/state');
                    
                } else {
                    
                    $this->session->set_flashdata('State', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('State/state');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }


    public function user_active($id){
        $Data = array(
            'state_id' => $id
        );
        $data = array(
          'is_status'  => 'Offline'
        );
        $result = $this->Model->updateData('state',$data,$Data);

        if ( $result) {
          redirect('State/state');  
        }else{
          redirect('admin/state/state');
        }
    }
    

    public function user_deactive($id){
            $Data1 = array(
                  'state_id' => $id
                );
                $data11 = array(
                  'is_status'  => 'Online'
                );
                $resul = $this->Model->updateData('state',$data11,$Data1);
                // print_r($result);exit;
                if ($resul) {
                  redirect('State/state');  
                }else{
                  redirect('admin/state/state');
                }
        }
    //**************************company edit details***********  
        public function editstate($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('state_id' => $id );
            $data['records'] = $this->Model->selectAllById('state', $wheredata);
            $data['country'] = $this->Model->select('country');
            $this->load->view('admin/state/editstatedetails',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function stateEdit()
    {
        if ($this->session->userdata('userinfo')) {
            $wheredata = array(
                'state_id' => $this->input->post('id')
            );
            $data = array(
                'country_id' => $this->input->post('country_name'),
                'state_name'    => $this->input->post('state_name')
            );         
            $result = $this->Model->update($wheredata, 'state', $data);
            if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('State/state');
            } else {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                 redirect('State/state');
            }
        } else {
            redirect('Welcome');
        }
    }
     public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'state_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('State/' . $rd);
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