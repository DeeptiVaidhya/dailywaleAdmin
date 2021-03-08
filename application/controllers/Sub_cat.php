<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_cat extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ********************************
     public function sub_cat()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['sub_cat'] = $this->Model->getsubcatName();
            $this->load->view('admin/sub_cat/sub_cat',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // ***************************************
      public function sub_cat_Add()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['sub_cat'] = $this->Model->select('sub_cat');
            $data['cat'] = $this->Model->select('cat');
            $this->load->view('admin/sub_cat/add_sub_cat',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Sub_cat');
        }
    }


      public Function add_sub_cat()
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
            // echo $this->input->post('cat_name');
            // echo $this->input->post('sub_cat_name');exit;
           
                $data = array(
                    'cat_id'   => $this->input->post('cat_name'),
                    'sub_cat_name'   => $this->input->post('sub_cat_name'),
                    'is_status'   => $this->input->post('is_status'),
                    'icon'   => $picture
                );
                $result = $this->Model->insert('sub_cat', $data);
                if ($result) {
                    $this->session->set_flashdata('Sub_cat', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Sub_cat/sub_cat');
                    
                } else {
                    
                    $this->session->set_flashdata('Sub_cat', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Sub_cat/sub_cat');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }

    public function user_active($id){
        $Data = array(
            'sub_cat_id' => $id
        );
        $data = array(
          'is_status'  => 'Offline'
        );
        $result = $this->Model->updateData('sub_cat',$data,$Data);

        if ( $result) {
          redirect('Sub_cat/sub_cat');  
        }else{
          redirect('admin/sub_cat/sub_cat');
        }
    }

    public function user_deactive($id){
            $Data1 = array(
                  'sub_cat_id' => $id
                );
                $data11 = array(
                  'is_status'  => 'Online'
                );
                //print_r(expression)
                $resul = $this->Model->updateData('sub_cat',$data11,$Data1);
                // print_r($result);exit;
                if ($resul) {
                  redirect('Sub_cat/sub_cat');  
                }else{
                  redirect('admin/sub_cat/sub_cat');
                }
        }
    //*************************************  
        public function edit_sub_cat($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('sub_cat_id' => $id );
            $data['records'] = $this->Model->selectAllById('sub_cat', $wheredata);
            $data['cat'] = $this->Model->select('cat');
            $this->load->view('admin/sub_cat/edit_sub_cat',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function sub_cat_Edit()
    {
        if ($this->session->userdata('userinfo')) {
             $wheredata = array(
                    'sub_cat_id' => $this->input->post('id')
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
                    'cat_id'       =>$this->input->post('cat_name'),
                    'sub_cat_name'  => $this->input->post('sub_cat_name'),
                    'icon' => $picture               
                    );
                } else {
                    $picture = '';
                    $data = array(
                        'cat_id'       =>$this->input->post('cat_name'),
                        'sub_cat_name'    => $this->input->post('sub_cat_name')
                    );
                }
            } else {
                $picture = '';
                $data = array(
                    'cat_id'       =>$this->input->post('cat_name'),
                    'sub_cat_name'    => $this->input->post('sub_cat_name')
                );         
            }       
            $result = $this->Model->update($wheredata, 'sub_cat', $data);
            if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Sub_cat/sub_cat');
            } else {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                 redirect('Sub_cat/sub_cat');
            }
        } else {
            redirect('Welcome');
        }
    }
     public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'sub_cat_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Sub_cat/' . $rd);
        } else {
                   $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }




    public function top_subcategory()
    {
       $data = $this->input->post();
       $position = $data['position'];
       $i=1;
       foreach($position as $k=>$v){
           $query=$this->db->query('Update sub_cat SET position_order="'.$i.'" WHERE sub_cat_id="'.$v.'"');
           $i++;
        }
         echo json_encode($query);
    }



}
?>