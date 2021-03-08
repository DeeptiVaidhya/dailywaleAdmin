    <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pop_services extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ***************company details*****************
     public function pop_services()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['pop_services'] = $this->Model->selectItem_boost('popular_services');
             $data['service'] = $this->Model->select('service_provider');
            $this->load->view('admin/popular_service/pop_services', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *****************edit company details**********************
      public function pop_ser_Add()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['pop_services'] = $this->Model->select('popular_services');
            $data['service_id'] = $this->Model->select('service_provider');
            $this->load->view('admin/popular_service/add_pop_services',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Pop_services');
        }
    }


      public Function add_pop_services()
        {
            if ($this->session->userdata('userinfo')) {  
                $data = array(
                    'service_id'   => $this->input->post('service_id'),
                    'valid_date'   => $this->input->post('valid_date'),
                    'created_at'   => date('d-m-Y')
                );
                $result = $this->Model->insert('popular_services', $data);
                if ($result) {
                    $this->session->set_flashdata('pincode', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Pop_services/pop_services');       
                    
                } else {
                    
                    $this->session->set_flashdata('', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Pop_services/pop_services');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }
    //**************************company edit details***********  
    public function edit_pop_services($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('pop_ser_id' => $id );
            $data['records'] = $this->Model->selectAllById('popular_services', $wheredata);
            $data['service'] = $this->Model->select('service_provider');
            $this->load->view('admin/popular_service/edit_pop_services',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function boost_item_pop_services($id)
    {
        if ($this->session->userdata('userinfo')) {
            $wheredata  = array('pop_ser_id' => $id );
            $params = array('boost_status' => '1',  'boost_datetime' => date("Y-m-d H:i:s") );
            $result = $this->Model->update($wheredata, 'popular_services', $params);
                if ($result) {
                    $this->session->set_flashdata('pincode', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Item Boost Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Pop_services/pop_services');       
                    
                } else {
                    
                    $this->session->set_flashdata('', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Item Not Boost!!</strong>.
                    </div>');
                    
                    redirect('Pop_services/pop_services');
                    
                }

        } else {
            redirect('Welcome');
        }
    }

    public function pop_ser_Edit()
    {
        if ($this->session->userdata('userinfo')) {
            
           $wheredata = array(
                'pop_ser_id' => $this->input->post('id')

            );
            
            $data = array(
                'service_id'   => $this->input->post('title'),
                
            );
             $result = $this->Model->update($wheredata, 'popular_services', $data);
             if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Pop_services/pop_services');
            
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                
                 redirect('Pop_services/pop_services');
                
            }
        } else {
            redirect('Welcome');
        }
    }       
 public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'pop_ser_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Pop_services/' . $rd);
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