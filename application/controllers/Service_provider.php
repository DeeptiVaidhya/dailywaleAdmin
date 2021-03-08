<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_provider extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // *******************************
     public function service_provider()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            // $data['service_pro'] = $this->Model->select('service_provider');
            // $data['item'] = $this->Model->select('item');
            $data['service_pro'] = $this->Model->getserviceName();
            $this->load->view('admin/service_provider/service_provider',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // ***************************************
      public function services_Add()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['service_pro'] = $this->Model->select('service_provider');
            $data['item'] = $this->Model->select('item');
            $data['vendor'] = $this->Model->select('vendor');
            
            $this->load->view('admin/service_provider/add_services',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Service_provider');
        }
    }


      public Function add_services()
        {
        if ($this->session->userdata('userinfo')) {  
           $date=date('Y-m-d H:i:s');
            // echo $this->input->post('sub_cat_name');exit;
           
                $data = array(
                    'provider_id'       =>$this->input->post('item_name'),
                    'vendor_id'       =>$this->input->post('name'),
                    'description'      => $this->input->post('description'),
                    'title'             => $this->input->post('title'),
                    'pre_booking_price'  => $this->input->post('pre_booking_price'),
                   ' created_at'        => $date,
                   ' updated_at'       => $date
                );
                $result = $this->Model->insert('service_provider', $data);
                if ($result) {
                    $this->session->set_flashdata('Service_provider', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Service_provider/service_provider');
                    
                } else {
                    
                    $this->session->set_flashdata('Service_provider', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Service_provider/service_provider');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }
    //*************************************  
        public function edit_services($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('service_id' => $id );
            $data['records'] = $this->Model->selectAllById('service_provider', $wheredata);
            $data['item'] = $this->Model->select('item');
             $data['vendor'] = $this->Model->select('vendor');
            $this->load->view('admin/service_provider/edit_service',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function services_Edit()
    {
        if ($this->session->userdata('userinfo')) {
            $date=date('Y-m-d');
             $wheredata = array(
                    'service_id' => $this->input->post('id')
                    );       
                    $data = array(
                     'vendor_id'       =>$this->input->post('name'), 
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
                
                redirect('Service_provider/service_provider');
            } else {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                 redirect('Service_provider/service_provider');
            }
        } else {
            redirect('Welcome');
        }
    }
     public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'service_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Service_provider/' . $rd);
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