<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popular_item extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ***************company details*****************
     public function popular_item()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['pop_items'] = $this->Model->getpopitemName();
            $this->load->view('admin/popular_item/popular_item',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *****************edit company details**********************
      public function pop_item_Add()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            // $data['banner'] = $this->Model->select('banners');
            $data['item'] = $this->Model->select('item');
            $this->load->view('admin/popular_item/add_pop_item',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Popular_item');
        }
    }


      public Function add_pop_item()
        {
            if ($this->session->userdata('userinfo')) {  
                
           
            // echo $this->input->post('sub_cat_name');exit;
           
                $data = array(
                   
                    'item_id'       => $this->input->post('item_name'),
                    
                );
                $result = $this->Model->insert('popular_items', $data);
                if ($result) {
                    $this->session->set_flashdata('Popular_item', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Popular_item/popular_item');
                    
                } else {
                    
                    $this->session->set_flashdata('Popular_item', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Popular_item/popular_item');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }
    //**************************company edit details***********  
        public function edit_pop_item($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('pop_pro_id' => $id );
            $data['records'] = $this->Model->selectAllById('popular_items', $wheredata,'pop_pro_id DESC');
            $data['item'] = $this->Model->select('item');
            $this->load->view('admin/popular_item/edit_pop_item',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function pop_item_Edit()
    {
        if ($this->session->userdata('userinfo')) {
           
             $wheredata = array(
                    'pop_pro_id' => $this->input->post('id')
                    );       
                    $data = array(
                    'item_id'     => $this->input->post('item_name'),
         
                    );     
                 $result = $this->Model->update($wheredata, 'popular_items', $data);
                if ($result) {
                 $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Popular_item/popular_item');
            } else {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                 redirect('Popular_item/popular_item');
            }
        } else {
            redirect('Welcome');
        }
    }
    
    public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'pop_pro_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Popular_item/' . $rd);
        } else {
                   $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }


    public function top_popular_item()
    {
       $data = $this->input->post();
       $position = $data['position'];
       $i=1;
       foreach($position as $k=>$v){
           $query=$this->db->query('Update popular_items SET position_order="'.$i.'" WHERE pop_pro_id="'.$v.'"');
           $i++;
        }
         echo json_encode($query);
    }



}
?>