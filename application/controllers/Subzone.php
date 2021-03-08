<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subzone extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ***************company details*****************
     public function subzone()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['subzone'] = $this->Model->getzoneName();
            // print_r($data);exit;
            $this->load->view('admin/subzone/subzone', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *****************edit company details**********************
      public function subzoneAdd()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['zone'] = $this->Model->select('zone');
            $this->load->view('admin/subzone/addsubzone',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Subzone');
        }
    }


      public Function addSubzone()
        {
            if ($this->session->userdata('userinfo')) {  
                $date=date('d-m-Y');
             
                $data = array(
                    'zone_id'   => $this->input->post('zone_name'),
                    'subzone_name'   => $this->input->post('subzone_name'),
                    'is_status'   => $this->input->post('is_status'),
                    'created_at'    => $date
                );
                $result = $this->Model->insert('subzone', $data);
                if ($result) {
                    $this->session->set_flashdata('Subzone', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Subzone/subzone');
                    
                } else {
                    
                    $this->session->set_flashdata('Subzone', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Subzone/subzone');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }

    public function user_active($id){
        $Data = array(
            'subzone_id' => $id
        );
        $data = array(
          'is_status'  => 'Offline'
        );
        $result = $this->Model->updateData('subzone',$data,$Data);

        if ( $result) {
          redirect('Subzone/subzone');  
        }else{
          redirect('admin/subzone/subzone');
        }
    }

    public function user_deactive($id){
            $Data1 = array(
                  'subzone_id' => $id
                );
                $data11 = array(
                  'is_status'  => 'Online'
                );
                //print_r(expression)
                $resul = $this->Model->updateData('subzone',$data11,$Data1);
                // print_r($result);exit;
                if ($resul) {
                  redirect('Subzone/subzone');  
                }else{
                  redirect('admin/subzone/subzone');
                }
        }
    //**************************company edit details***********  
        public function editsubzone($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('subzone_id' => $id );
            $data['records'] = $this->Model->selectAllById('subzone', $wheredata);
            $data['zone'] = $this->Model->select('zone');
            $this->load->view('admin/subzone/editsubzone',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function subzoneEdit()
    {
        if ($this->session->userdata('userinfo')) {
             $date=date('d-m-Y');
           $wheredata = array(
                'subzone_id' => $this->input->post('id')

            );
            
            $data = array(
                'zone_id' => $this->input->post('zone_name'),
                'subzone_name'    => $this->input->post('subzone_name'),
                'updated_at'    => $date
            );
             $result = $this->Model->update($wheredata, 'subzone', $data);
             if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Subzone/subzone');
            
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                
                 redirect('Subzone/subzone');
                
            }
        } else {
            redirect('Welcome');
        }
    }       
 public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'subzone_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Subzone/' . $rd);
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