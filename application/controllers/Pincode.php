<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pincode extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ***************company details*****************
     public function pincode()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['pincode'] = $this->Model->select('pincode');
            $data['subzone'] = $this->Model->select('subzone');
            $this->load->view('admin/pincode/pincode', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *****************edit company details**********************
      public function pincode_Add()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['pincode'] = $this->Model->select('pincode');
            $data['pincodeID'] = $this->Model->select('subzone');
            $this->load->view('admin/pincode/addpincode',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Pincode');
        }
    }


      public Function add_pincode()
        {
            if ($this->session->userdata('userinfo')) {  
                $date=date('d-m-Y');
             
                $data = array(
                    
                    'sub_zone_id'   => $this->input->post('sub_zone_id'),
                    'pincode_no'    =>$this->input->post('pincode_no'),
                    'created_at'    => $date,
                    'updated_at'    => $date
                );
                $result = $this->Model->insert('pincode', $data);
                if ($result) {
                    $this->session->set_flashdata('pincode', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Pincode/pincode');       
                    
                } else {
                    
                    $this->session->set_flashdata('', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Pincode/pincode');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }
    //**************************company edit details***********  
        public function edit_pincode($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('pincodeID' => $id );
            $data['records'] = $this->Model->selectAllById('pincode', $wheredata);
            $data['pincodeID'] = $this->Model->select('subzone');
            $this->load->view('admin/pincode/editpincode',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function pincode_Edit()
    {
        if ($this->session->userdata('userinfo')) {
             $date=date('d-m-Y');
           $wheredata = array(
                'pincodeID' => $this->input->post('id')

            );
            
            $data = array(
                    'sub_zone_id'   => $this->input->post('sub_zone_id'),
                    'pincode_no'    =>$this->input->post('pincode_no'),
                    'created_at'    => $date,
                    'updated_at'    => $date
            );
             $result = $this->Model->update($wheredata, 'pincode', $data);
             if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Pincode/pincode');
            
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                
                 redirect('Pincode/pincode');
                
            }
        } else {
            redirect('Welcome');
        }
    }       
 public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'pincodeID' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Pincode/' . $rd);
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