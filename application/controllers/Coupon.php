<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends CI_Controller {

   public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');

    }

   public function ViewCoupon()
   {
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['coupon_list'] = $this->Model->select('coupon_code');
            $this->load->view('admin/coupon/coupon_list', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }

    }
    
    public function CreateCoupon()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/coupon/addcoupon');
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Coupon');
        }
    }


    public Function InsertCoupon()
    {
            if ($this->session->userdata('userinfo')) {  
                // $date=date('d-m-Y');

                $couponcode  = ucwords($this->input->post('coupon_code'));
                //print_r($couponcode);die;

                $data = array(
                    'coupon_code'        => $this->input->post('coupon_code'),
                    'is_one_time'        => $this->input->post('is_one_time'),
                    'no_of_user'         => $this->input->post('no_of_user'),
                    'started_at'         => $this->input->post('started_at'),
                    'valid_at'           => $this->input->post('valid_at'),
                    'percentage'         => $this->input->post('percentage'),
                    'max_amount'         => $this->input->post('max_amount'),
                    'is_rand'            => $this->input->post('is_rand'),
                    'min_cart_amount'    => $this->input->post('min_cart_amount')

                );

                $result = $this->Model->insert('coupon_code', $data);
                if ($result) {
                    $this->session->set_flashdata('ViewCoupon', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Coupon Add Sucessfully!!</strong>.
                    </div>');

                    redirect('Coupon/ViewCoupon');

                } else {

                    $this->session->set_flashdata('ViewCoupon', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Coupon Not Add!!</strong>.
                    </div>');

                    redirect('Coupon/ViewCoupon');

                }

            } else {
                redirect('Welcome', 'refresh');
            }

        }


    
    public function editCoupon($id)
    {

        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('coupon_id' => $id );
            $data['records'] = $this->Model->selectAllById('coupon_code', $wheredata);
            // $whereItem  = array('vendor_id' => $id );
            // $data['item_list'] = $this->Model->selectdata('item', $whereItem);
            $this->load->view('admin/coupon/editcoupon',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }

    }

    public function updateCoupon()
    {
        if ($this->session->userdata('userinfo')) {
             // $date=date('d-m-Y');
           $wheredata = array(
                'coupon_id' => $this->input->post('coupon_id')

            );

            $data = array(
                'coupon_code'        => $this->input->post('coupon_code'),
                'is_one_time'        => $this->input->post('is_one_time'),
                'no_of_user'         => $this->input->post('no_of_user'),
                'started_at'         => $this->input->post('started_at'),
                'valid_at'           => $this->input->post('valid_at'),
                'percentage'         => $this->input->post('percentage'),
                'max_amount'         => $this->input->post('max_amount'),
                'is_rand'            => $this->input->post('is_rand'),
                'min_cart_amount'    => $this->input->post('min_cart_amount')

            );
            
             $result = $this->Model->update($wheredata, 'coupon_code', $data);
             if ($result) {
                $this->session->set_flashdata('ViewCoupon', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');

                redirect('Coupon/ViewCoupon');

                $this->session->set_flashdata('ViewCoupon', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');

                redirect('Coupon/ViewCoupon');

            }
        } else {
            redirect('Welcome');
        }
    }   




//     public function deleterecord($id, $tbl, $rd)
//     {
//         if ($this->session->userdata('userinfo')) {

//             $wheredata    = array(
//                 'id' => $id
//             );
//             $data['test'] = $this->Model->deleterec($wheredata, $tbl);
//             $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
//                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
//                 <strong>state Record Delete Sucessfully!!</strong>.
//                 </div>');
//             redirect('Vendorinfo/' . $rd);
//         } else {
//                    $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
//                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
//                 <strong>state Record Not Delete!!</strong>.
//                 </div>');
//             redirect('Welcome', 'refresh');
//         }
//     }






}
?>