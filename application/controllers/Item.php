<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
    // ********************************
     public function item()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
          
            $data['item'] = $this->Model->getitemName(0);
            $data['item_count'] = $this->Model->record_count('item');
            $data['item_count'] = intval($data['item_count']/500);
            // print_r($data);
            $this->load->view('admin/item/item',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }

    public function itemPagination($number)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
          
            $data['item'] = $this->Model->getitemName($number);
            $data['item_count'] = $this->Model->record_count('item');
            $data['item_count'] = intval($data['item_count']/500);
            // print_r($data);
            $this->load->view('admin/item/item',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
     // *****************edit item details**********************
      public function item_Add($id="")
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['item'] = $this->Model->select('item');
            $data['sub_cat'] = $this->Model->joinCatSubCat();
            $data['vendor'] = $this->Model->select('vendor');

            if($id!=""){
                $wheredata  = array('item_id' => $id );
                $data['records'] = $this->Model->selectAllById('item', $wheredata);
            }
            

            $this->load->view('admin/item/additem',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Item');
        }
    }


      public Function add_item()
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
                    'item_name'                 => $this->input->post('item_name'),
                    'vendor_id'                 => $this->input->post('name'),
                    'sub_cat_id'                => $this->input->post('sub_cat_name'),
                    'item_images'               => $picture,
                    'item_desc'                 => $this->input->post('item_desc'),
                    'item_price'                => $this->input->post('item_price'),
                    'item_quantity_desc'        => $this->input->post('item_quantity_desc'),
                    'item_discount'             => $this->input->post('item_discount'),
                    'packaging'                 => $this->input->post('packaging'),
                    'delivery'                  => $this->input->post('delivery'),
                    'is_schedule'               => $this->input->post('is_schedule'),
                    'item_unit'                 => $this->input->post('item_unit'),
                    'is_out_of_stock'           => $this->input->post('is_out_of_stock'),
                    'tax'                       => $this->input->post('tax'),
                    'is_online'                 => $this->input->post('is_online'),
                    'is_available_six_to_twl'   => $this->input->post('is_available_six_to_twl'),
                    'seller_packaging'          => $this->input->post('seller_packaging'),
                    'seller_delivery'           => $this->input->post('seller_delivery'),
                    'cgstin'                    => $this->input->post('cgstin'),
                    'sgstin'                    => $this->input->post('sgstin'),
                    'remark'                    => $this->input->post('remark'),
                    'delivery_days'                    => $this->input->post('delivery_days')
                );
                $result = $this->Model->insert('item', $data);
                if ($result) {
                    $this->session->set_flashdata('Item', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Item/item');
                    
                } else {
                    
                    $this->session->set_flashdata('Item', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');
                    
                    redirect('Item/item');
                    
                }
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }

    public function user_active($id){
        $Data = array(
            'item_id' => $id
        );
        $data = array(
          'is_online'  => 'no'
        );
        $result = $this->Model->updateData('item',$data,$Data);

        if ( $result) {
          redirect('Item/item');  
        }else{
          redirect('admin/item/item');
        }
    }

    public function user_deactive($id){
            $Data1 = array(
                  'item_id' => $id
                );
                $data11 = array(
                  'is_online'  => 'yes'
                );
                $resul = $this->Model->updateData('item',$data11,$Data1);
                if ($resul) {
                  redirect('Item/item');  
                }else{
                  redirect('admin/item/item');
                }
    }
    
    //**************************company edit details***********  
        public function edit_item($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('item_id' => $id );
            $data['records'] = $this->Model->selectAllById('item', $wheredata);
            $data['sub_cat'] = $this->Model->joinCatSubCat();
            $data['vendor'] = $this->Model->select('vendor');
            $this->load->view('admin/item/edititem',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }

    public function item_Edit()
    {
        if ($this->session->userdata('userinfo')) {
           
             $wheredata = array(
                    'item_id' => $this->input->post('id')
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
                    'item_name'                 => $this->input->post('item_name'),
                    'vendor_id'                 => $this->input->post('name'),
                    'sub_cat_id'                => $this->input->post('sub_cat_name'),
                    'item_images'               => $picture,
                    'item_desc'                 => $this->input->post('item_desc'),
                    'item_quantity_desc'        => $this->input->post('item_quantity_desc'),
                    'item_price'                => $this->input->post('item_price'),
                    'item_discount'             => $this->input->post('item_discount'),
                    'packaging'                 => $this->input->post('packaging'),
                    'delivery'                  => $this->input->post('delivery'),
                    'is_schedule'               => $this->input->post('is_schedule'),
                    'item_unit'                 => $this->input->post('item_unit'),
                    'is_out_of_stock'           => $this->input->post('is_out_of_stock'),
                    'tax'                       => $this->input->post('tax'),
                    'is_online'                 => $this->input->post('is_online'),
                    'is_available_six_to_twl'   => $this->input->post('is_available_six_to_twl'),
                    'seller_packaging'          => $this->input->post('seller_packaging'),
                    'seller_delivery'           => $this->input->post('seller_delivery'),
                    'cgstin'                    => $this->input->post('cgstin'),
                    'sgstin'                    => $this->input->post('sgstin'),
                    'remark'                    => $this->input->post('remark'),
                    'delivery_days'             => $this->input->post('delivery_days')
                              
                    );
                   
                } else {
                    $picture = '';
                    $data = array(
                    'item_name'      => $this->input->post('item_name'),
                    'vendor_id'      => $this->input->post('name'),
                    'sub_cat_id'     => $this->input->post('sub_cat_name'),
                    'item_desc'      => $this->input->post('item_desc'),
                    'item_quantity_desc'=> $this->input->post('item_quantity_desc'),
                    'item_price'     => $this->input->post('item_price'),
                    'item_discount'  => $this->input->post('item_discount'),
                    'packaging'      => $this->input->post('packaging'),
                    'delivery'       => $this->input->post('delivery'),
                    'is_schedule'    => $this->input->post('is_schedule'),
                    'item_unit'      => $this->input->post('item_unit'),
                    'is_out_of_stock'=> $this->input->post('is_out_of_stock'),
                    'tax'            => $this->input->post('tax'),
                    'is_online'      => $this->input->post('is_online'),
                    'is_available_six_to_twl'   => $this->input->post('is_available_six_to_twl'),
                    'seller_packaging'  => $this->input->post('seller_packaging'),
                    'seller_delivery'   => $this->input->post('seller_delivery'),
                    'cgstin'            => $this->input->post('cgstin'),
                    'sgstin'            => $this->input->post('sgstin'),
                    'remark'            => $this->input->post('remark'),
                    'delivery_days'     => $this->input->post('delivery_days')
                     
                    
                     );
                }
            } else {
                $picture = '';
                $data = array(
                   'item_name'         => $this->input->post('item_name'),
                   'vendor_id'         => $this->input->post('name'),
                    'sub_cat_id'       => $this->input->post('sub_cat_name'),
                    'item_desc'        => $this->input->post('item_desc'),
                    'item_quantity_desc'=> $this->input->post('item_quantity_desc'),
                    'item_price'       => $this->input->post('item_price'),
                    'item_discount'    => $this->input->post('item_discount'),
                    'packaging'        => $this->input->post('packaging'),
                    'delivery'         => $this->input->post('delivery'),
                    'is_schedule'      => $this->input->post('is_schedule'),
                    'item_unit'        => $this->input->post('item_unit'),
                    'is_out_of_stock'  => $this->input->post('is_out_of_stock'),
                    'tax'              => $this->input->post('tax'),
                    'is_online'        => $this->input->post('is_online'),
                    'is_available_six_to_twl'   => $this->input->post('is_available_six_to_twl'),
                    'seller_packaging' => $this->input->post('seller_packaging'),
                    'seller_delivery'  => $this->input->post('seller_delivery'),
                    'cgstin'           => $this->input->post('cgstin'),
                    'sgstin'           => $this->input->post('sgstin'),
                    'remark'           => $this->input->post('remark'),
                    'delivery_days'     => $this->input->post('delivery_days')
                      
                    
                );         
            }  
            $result = $this->Model->update($wheredata, 'item', $data);
            if ($result) {
                $this->session->set_flashdata('sucessitem', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Item/item');
            } else {
                $this->session->set_flashdata('failed', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                 redirect('Item/item');
            }
        } else {
            redirect('Welcome');
        }
    }
     public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {
            
            $wheredata    = array(
                'item_id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Item/' . $rd);
        } else {
                   $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }



    public function Add_SingleImage()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/item/addimage');
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Item');
        }
    }


      public Function upload_single_image()
        {
            if ($this->session->userdata('userinfo')) { 
            
             if (!empty($_FILES['picture']['name'])) {
                $config['upload_path']   = 'uploads/pramotion';
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
                    'item_images' => 'http://dailywale.com/dailywaleAdmin/uploads/pramotion/'.$picture
                    
                );
                print_r($data);
                if ($data) {
                    $this->session->set_flashdata('Item', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Item/Add_SingleImage/?url=http://dailywale.com/dailywaleAdmin/uploads/pramotion/'.$picture);
                    
                } 
                
            } else {
                redirect('Welcome', 'refresh');
            }
            
        }


}
?>