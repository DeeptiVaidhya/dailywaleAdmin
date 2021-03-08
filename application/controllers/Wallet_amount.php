<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet_amount extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        
    }
      public function wallet_amount()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            // $data['wallet'] = $this->Model->getuserName();
            $data['wallet'] = $this->Model->select('user');
            $this->load->view('admin/wallet/wallet', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }
        
    }
    public function walletAdd($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('user_id' => $id );
            $data['records'] = $this->Model->selectAllById('user', $wheredata);
            // $data['city'] = $this->Model->select('city');
            // print_r($data);exit;
            $this->load->view('admin/wallet/addwallet',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
        
    }
    public Function addwallet()
    {
        if ($this->session->userdata('userinfo')) {
            $date=date('Y-m-d');
            $check_paymentStatus = $this->input->post('status'); 
            
            $wheredata = array(
                'user_id' => $this->input->post('id')
            );

            if ($check_paymentStatus == 'credit') {
               $amt = $this->input->post('wallet_amount')+$this->input->post('amt');
            } elseif ($check_paymentStatus == 'debit') {
               $amt = $this->input->post('wallet_amount')-$this->input->post('amt');
            } else{
                echo "Error";
            }

            $data = array(
                'wallet_amount'=> $amt
            );
            $result = $this->Model->update($wheredata, 'user', $data);
            if ($result) {
                $dataTranction =array(
                    "user_id"=> $this->input->post('id'),
                    "amount"=> $this->input->post('amt'),
                    "pay_by" => "Admin",
                    "detail" => $check_paymentStatus,
                    "date_time" => $date
                );
                $create = $this->Model->insert('transaction',$dataTranction);
                $dataNotification =array(
                    "user_id"   =>$this->input->post('id'),
                    "date_time" => $date,
                    "title"     => "Admin!!",
                    "message"   => "Welcome to 'Dailywale' admin!!",
                    "read_status"=> '0'
                );
                $createNotification = $this->Model->insert('notification',$dataNotification);
            
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Wallet_amount/wallet_amount');
            
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');
                
                 redirect('Wallet_amount/wallet_amount');
                
            }
        } else {
            redirect('Welcome');
        }
    }
      
        

    }
    ?>