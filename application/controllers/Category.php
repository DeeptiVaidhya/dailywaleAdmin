<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // *******************************
     public function category()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $orderBy  = "position_order asc";
            $data['category'] = $this->Model->select('cat', $orderBy);
            $this->load->view('admin/category/category',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *************************************
      public function categoryAdd()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');            
            $this->load->view('admin/category/addcat');
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Category');
        }
    }


      public Function addcategory()
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
                    'cat_name'   => $this->input->post('cat_name'),
                    'icon'   => $picture,
                    'type'     => $this->input->post('type'),
                    'is_status'     => $this->input->post('is_status')
                );
                $result = $this->Model->insert('cat', $data);
                if ($result) {
                    $this->session->set_flashdata('Category', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Category/category');
                    
                } else {
                    
                    $this->session->set_flashdata('Category', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Category/category');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }

     public function user_active($id){
        $Data = array(
            'cat_id' => $id
        );
        $data = array(
          'is_status'  => 'Offline'
        );
        $result = $this->Model->updateData('cat',$data,$Data);

        if ( $result) {
          redirect('Category/category');  
        }else{
          redirect('admin/category/category');
        }
    }

    public function user_deactive($id){
            $Data1 = array(
                  'cat_id' => $id
                );
                $data11 = array(
                  'is_status'  => 'Online'
                );
                //print_r(expression)
                $resul = $this->Model->updateData('cat',$data11,$Data1);
                // print_r($result);exit;
                if ($resul) {
                  redirect('Category/category');  
                }else{
                  redirect('admin/category/category');
                }
        }
    //*************************************  
        public function editcategory($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('cat_id' => $id );
            $data['records'] = $this->Model->selectAllById('cat', $wheredata);
            $this->load->view('admin/category/editcat',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function categoryEdit()
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata = array(
                'cat_id' => $this->input->post('id')
            );
             if (!empty($_FILES['picture']['name'])) {
                $config['upload_path']   = 'uploads/user/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name']     =  time().rand(10000,99999).".jpg";
                
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture    = $uploadData['file_name'];
                    $data = array(
                    'cat_name'    => $this->input->post('cat_name'),
                    'icon' => $picture ,
                    'type'     => $this->input->post('type')            
                );
                } else {
                    
                    $picture = '';
                    $data = array(
                    'cat_name'    => $this->input->post('cat_name'),
                    'type'     => $this->input->post('type')
                    
                );
                }
            } else {
                $picture = '';
                $data = array(
                    'cat_name'    => $this->input->post('cat_name'),
                    'type'     => $this->input->post('type')
                    
                );         
            }    
            $result = $this->Model->update($wheredata, 'cat', $data);
            if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Category/category');
            } else {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                 redirect('Category/category');
            }
        } else {
            redirect('Welcome');
        }
    }
     public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'cat_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Category/' . $rd);
        } else {
                   $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }


    public function top_category()
    {
       $data = $this->input->post();
       $position = $data['position'];
       $i=1;
       foreach($position as $k=>$v){
           $query=$this->db->query('Update cat SET position_order="'.$i.'" WHERE cat_id="'.$v.'"');
           $i++;
        }
         echo json_encode($query);
    }

}
?>