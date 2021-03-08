<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ***************company details*****************
     public function banner()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['banner'] = $this->Model->getbannerName();
            $this->load->view('admin/banner/banner',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *****************edit company details**********************
      public function banner_Add()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['banner'] = $this->Model->select('banners');
            $data['item'] = $this->Model->select('item');
            $data['subcat'] = $this->Model->select('sub_cat');
            $this->load->view('admin/banner/add_banner',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Banner');
        }
    }


      public Function add_banner()
        {
            if ($this->session->userdata('userinfo')) { 
            
             if (!empty($_FILES['picture']['name'])) {
                $config['upload_path']   = 'uploads/user';
                $config['allowed_types'] = 'img|jpg|jpeg|png|gif';
                $config['file_name']     = time().rand(10000,99999).".jpg";
                
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture    = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            } else {
                $picture = '';
            }
           
                $data = array(
                    'banner_type'       => $this->input->post('banner_type'),
                    'application_type'  => $this->input->post('application_type'),
                    'sub_cat_id'        => $this->input->post('sub_cat'),
                    'item_id'           => $this->input->post('item_name'),
                    'image'             => $picture
                    
                );
                $result = $this->Model->insert('banners', $data);
                if ($result) {
                    $this->session->set_flashdata('Item', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Banner/banner');
                    
                } else {
                    
                    $this->session->set_flashdata('Banners', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Banner/banner');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }
    //**************************company edit details***********  
        public function edit_banner($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('banner_id' => $id );
            $data['records'] = $this->Model->selectAllById('banners', $wheredata);
            $data['item'] = $this->Model->select('item');
            $data['subcat'] = $this->Model->select('sub_cat');
            $this->load->view('admin/banner/edit_banner',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function banner_Edit()
    {
       if ($this->session->userdata('userinfo')) {
            
             $wheredata = array(
                    'banner_id' => $this->input->post('id')
                    );
              if (!empty($_FILES['picture']['name'])) {
                $config['upload_path']   = 'uploads/user/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name']     = time().rand(10000,99999).".jpg";
                
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture    = $uploadData['file_name'];
                     
                    $data = array(
                    'banner_type'       => $this->input->post('banner_type'),
                    'application_type'  => $this->input->post('application_type'),
                    'sub_cat_id'        => $this->input->post('sub_cat'),
                    'item_id'           => $this->input->post('item_name'),
                    'image'             => $picture
                                
                    );
                } else {
                    
                    $picture = '';
                    $data = array(
                      'banner_type'      => $this->input->post('banner_type'),
                      'application_type' => $this->input->post('application_type'),
                      'sub_cat_id'       => $this->input->post('sub_cat'),
                      'item_id'          => $this->input->post('item_name'),
                    
                     );
                }
            } else {
                $picture = '';
                $data = array(
                    'banner_type'       => $this->input->post('banner_type'),
                    'application_type'  => $this->input->post('application_type'),
                    'sub_cat_id'        => $this->input->post('sub_cat'),
                    'item_id'           => $this->input->post('item_name'),
                );         
            }  
     
            $result = $this->Model->update($wheredata, 'banners', $data);
            if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Banner/banner');
            } else {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                 redirect('Banner/banner');
            }
        } else {
            redirect('Welcome');
        }
    }
     public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'banner_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Banner/' . $rd);
        } else {
                   $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }



    public function top_banner()
    {
       $data = $this->input->post();
       $position = $data['position'];
       $i=1;
       foreach($position as $k=>$v){
           $query=$this->db->query('Update banners SET position_order="'.$i.'" WHERE banner_id="'.$v.'"');
           $i++;
        }
         echo json_encode($query);
    }


    function getSubCat($level)
    {
        $category   = $level;   
        $result = $this->db->query('SELECT * FROM `sub_cat` WHERE cat_id = "'.$category.'"')->result_array();
        echo json_encode($result);
        
    }


}
?>