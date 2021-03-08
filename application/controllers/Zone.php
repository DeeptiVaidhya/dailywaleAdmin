<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zone extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ***************company details*****************
     public function zone()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['zone'] = $this->Model->getCityName();
            // print_r($data);exit;
            $this->load->view('admin/zone/zone', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *****************edit company details**********************
      public function ZoneAdd()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['city'] = $this->Model->select('city');
            $this->load->view('admin/zone/addzone',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Zone');
        }
    }


      public Function addZone()
        {
            if ($this->session->userdata('userinfo')) {  
                $date=date('d-m-Y');
             
                $data = array(
                    'city_id'   => $this->input->post('city_name'),
                    'zone_name'   => $this->input->post('zone_name'),
                    'is_status'   => $this->input->post('is_status'),
                    'created_at' =>$date
                );
                $result = $this->Model->insert('zone', $data);
                if ($result) {
                    $this->session->set_flashdata('Zone', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Zone/zone');
                    
                } else {
                    
                    $this->session->set_flashdata('Zone', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Zone/zone');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }

    public function user_active($id){
        $Data = array(
            'zone_id' => $id
        );
        $data = array(
          'is_status'  => 'Offline'
        );
        $result = $this->Model->updateData('zone',$data,$Data);

        if ( $result) {
          redirect('Zone/zone');  
        }else{
          redirect('admin/zone/zone');
        }
    }

    public function user_deactive($id){
            $Data1 = array(
                  'zone_id' => $id
                );
                $data11 = array(
                  'is_status'  => 'Online'
                );
                //print_r(expression)
                $resul = $this->Model->updateData('zone',$data11,$Data1);
                // print_r($result);exit;
                if ($resul) {
                  redirect('Zone/zone');  
                }else{
                  redirect('admin/zone/zone');
                }
        }
    //**************************company edit details***********  
        public function editzone($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('zone_id' => $id );
            $data['records'] = $this->Model->selectAllById('zone', $wheredata);
            $data['city'] = $this->Model->select('city');
            $this->load->view('admin/zone/editzone',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function zoneEdit()
    {
        if ($this->session->userdata('userinfo')) {
            $date=date('d-m-Y');
           $wheredata = array(
                'zone_id' => $this->input->post('id')
            );
            
            $data = array(
                'city_id' => $this->input->post('city_name'),
                'zone_name'    => $this->input->post('zone_name'),
                'updated_at' =>$date
            );
             $result = $this->Model->update($wheredata, 'zone', $data);
             if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Zone/zone');
            
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                
                 redirect('Zone/zone');
                
            }
        } else {
            redirect('Welcome');
        }
    }       
 public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'zone_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Zone/' . $rd);
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