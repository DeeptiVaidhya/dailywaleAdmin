<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('email');        
    }
    // ********************************
    
    public function SellerInvoice()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['vendor'] = $this->Model->select('vendor');
            
            // $resultVendor = $this->Model->select('vendor');
            // foreach ($resultVendor as $v) {
            //     $item[] = $this->Model->getSellerData($v['id']);

            //   $vendor[] = array(
            //     'id'               => $v['id'],
            //     'name'             => $v['name'],
            //     'address'          => $v['address'],
            //     'email'            => $v['email'],
            //     'phone'            => $v['phone'],
            //     'profile'          => $v['profile'],
            //     'company_name'     => $v['company_name'],
            //     'company_address'  => $v['company_address'],
            //     'company_phone_no' => $v['company_phone_no'],
            //     'gst_no'           => $v['gst_no'],
            //     'active_status'    => $v['active_status'],
            //     'item_details'     => $item
            //   );
            // }
            
            // echo '<pre>'; print_r($item);die;
            // foreach ($resultVendor as $ven) {
            //     $where = array('vendor_id' => $ven['id'] );
            //     $data['item'][] = $this->Model->getSellerData($ven['id']);
            // }
            // $data = array(
            //     'vendor' => $resultVendor,
            //     );
            // echo '<pre>'; print_r($data['item']);
            // die;
           // echo '<pre>';print_r($data['cart']);die;
            $this->load->view('admin/invoice/seller_invoice', $data);
        } else {
            redirect('welcome');
        }
        
    }       

    public function SearchInvoice(){
       if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['user'] = $this->Model->select('user');
            $this->load->view('admin/invoice/customer_invoice', $data);
        } else {
            redirect('welcome');
        }
    }

    // public function CustomerInvoice()
    // {
        
    //     if ($this->session->userdata('userinfo')) {
    //         $this->load->view('admin/assets/header');
    //         $this->load->view('admin/assets/sidebar');
    //         $data['user'] = $this->Model->select('user');
    //         //echo '<pre>'; print_r($data['user']);die;
    //         $this->load->view('admin/invoice/customer_invoice', $data);
    //     } else {
    //         redirect('welcome');
    //     }
        
    // }


    public function Search()
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $id = $this->input->post('user_name');
            $data['userId'] = $this->input->post('user_name');
            $data['month'] = $this->input->post('month');
            
            $data['user'] = $this->db->query('SELECT * FROM `user` JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id JOIN city ON user.city_id = city.city_id JOIN state ON user.state_id = state.state_id WHERE user_id = "'.$id.'"')->result_array();

            $data['vendor'] = $this->Model->select('vendor');
            $this->load->view('admin/invoice/customer_invoice_details', $data);
        } else {
            redirect('welcome');
        }
        
    }


    public function getUserItemData($userId)
    {
         $userId   = $userId;   
         $result = $this->db->query('SELECT * FROM `user` JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id JOIN city ON user.city_id = city.city_id JOIN state ON user.state_id = state.state_id WHERE user_id = "'.$userId.'"')->result_array();
         echo json_encode($result);            
    }




    public function fetchdata(){
        $month  = $this->input->get('month');
        $userId = $this->input->get('userId');

        $vendor = $this->Model->select('vendor');
        if ($vendor) {
            $user = $this->db->query('SELECT * FROM `user` JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id JOIN city ON user.city_id = city.city_id JOIN state ON user.state_id = state.state_id WHERE user_id = "'.$userId.'"')->result_array();


            foreach ($vendor as $v) {
                $itemdata = $this->Model->getSellerData($v['id'], $month, $userId);
                if (!empty($itemdata)) {
                    $arrayVendor[] = array(
                        'id'        => $v['id'],
                        'name'      => $v['name'],
                        'address'   => $v['address'],
                        'email'     => $v['email'],
                        'phone'     => $v['phone'],
                        'company_name' => $v['company_name'],
                        'gst_no'    => $v['gst_no'],
                        'itemArray' => $itemdata,
                        'userArray'=> $user
                    ); 
                }  
            }  
        }
        echo json_encode($arrayVendor);
    }


    public function fetchSellerData(){
        $month  = $this->input->get('month');
        $sellerId = $this->input->get('seller_id');

        $vend = $this->db->query('SELECT * FROM `vendor` WHERE id = "'.$sellerId.'"')->result_array();
        if ($vend) {
        	$sell_item = $this->Model->getSellerItemDetails($month, $sellerId);
        	if ($sell_item) {
        		$dataItem[0] = array(
        			'vendor_id'     => $vend[0]['id'],
        			'name'     		=> $vend[0]['name'],
        			'address'       => $vend[0]['address'],
        			'email'      	=> $vend[0]['email'],
        			'phone'      	=> $vend[0]['phone'],
        			'company_name'  => $vend[0]['company_name'],
        			'gst_no'      	=> $vend[0]['gst_no'],
        			'ItemDetails' 	=> $sell_item,
        		);
        	}
        }
        echo json_encode($dataItem);
    }


    public function SendMailOnUserMail(){

        $month  = $this->input->post('month');
        $userId  = $this->input->post('userid');

        $user = $this->db->query('SELECT * FROM `user` JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id JOIN city ON user.city_id = city.city_id JOIN state ON user.state_id = state.state_id WHERE user_id = "'.$userId.'"')->result_array();

        $message = '';
        $to = $user[0]['email'];
        $subject = 'Invoice (dailywale.com)';
        $headers = "From: " . strip_tags('noreply@dailywale.com') . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
      
        $message .= '<!doctype html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Print</title>
            
            <style>
            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, .15); 
                background-color: #fff;
                font-size: 16px;
                line-height: 24px;
                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                color: #555;
            }
            
            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }
            
            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }
            
            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }
            
            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }
            
            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }
            
            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }
            
            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }
            
            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }
            
            .invoice-box table tr.item td{
                border-bottom: 1px solid #eee;
            }
            
            .invoice-box table tr.item.last td {
                border-bottom: none;
            }
            
            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }

            #product_details tr th{
                border: 1px solid #000;
                background-color: #5e3ba0eb;
                color: #fff ;
                padding:4px;
            }
            #product_details tr td{
                border: 1px solid #000;
                font-size: 13px;
            }
            
            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
                
                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }
            
            /** RTL **/
            .rtl {
                direction: rtl;
                font-family: Tahoma, "Helvetica Neue", 
                "Helvetica", Helvetica, Arial, sans-serif;
            }
            
            .rtl table {
                text-align: right;
            }
            
            .rtl table tr td:nth-child(2) {
                text-align: left;
            }

            @media print {
            #printbtn {
                display :  none;
            }
        }
        .invoice-box { page-break-before: always; } /* page-break-after works, as well */
            </style>
        </head>

        <body>';


        $vendor =  $this->db->query('SELECT * FROM `vendor`')->result_array();
        foreach($vendor as $v)
        { 
          $itemdata = $this->Model->getSellerData($v['id'], $month, $userId);
          if (!empty($itemdata)) {

        
        $message .= '<div class="invoice-box" style="margin-top:100px;">
              <div id="part_1">
                <center><img src="http://dailywale.com/dailywaleAdmin//assets/img/logo.png.png" alt="dailywale" width="12%"></center>
                <table style="width:100%;padding-top:35px;" >
                  <tr>
                    <td colspan="3"><b>Seller : <span style="color:#625db1;">' .$v['name']; 
                   // if (!$v['company_name'] == '') {  echo '('  .$v['company_name']. ')' } 
                   $message .= '</span> </b></td>
                    <td colspan="3"><!-- <b style="color:red;">Total - &#8377; 10,080.00</b> --></td>
                  </tr>
                  <tr>
                    <td>GSTIN</td>
                    <td>:</td>
                    <td>Nill</td>
                  </tr>
                  <tr>
                    <td>Invoice Date</td>
                    <td>:</td>
                    <td>' .date('d-M-Y'). '</td>
                  </tr>
                  <tr>
                    <td>PAN</td>
                    <td>:</td>
                    <td>Nil</td>
                  </tr> 
                  <tr>
                    <td>Invoice No.</td>
                    <td>:</td>
                    <td> DW-00</td>
                  </tr>
                  <tr>
                    <td>State</td>
                    <td>:</td>
                    <td>Madhya Pradesh</td>
                  </tr>
                  <tr>
                   <td colspan="6" style="font-size: 22px;">---------  TAX INVOICE  ---------</td>
                  <tr>';
                  $user = $this->db->query('SELECT * FROM `user` JOIN zone ON user.zone_id = zone.zone_id JOIN subzone ON user.subzone_id = subzone.subzone_id JOIN city ON user.city_id = city.city_id JOIN state ON user.state_id = state.state_id WHERE user_id = "'.$userId.'"')->result_array();
                  foreach ($user as $value) {} 
                $message .= '<tr>
                    <td><b>Customer</b></td>
                    <td>:</td>
                    <td><b><span style="color:red;">' .$value["fname"].  ' ' .$value["lname"]. '</span></b></td>
                  </tr>
                  
                  <tr>
                    <td>PAN</td>
                    <td>:</td>
                    <td>Nil</td>
                  </tr> 
                  <tr>
                    <td>State</td>
                    <td>:</td>
                    <td>' .$value["state_name"]. '</td>
                  </tr>
                  <tr>
                    <td><b>Billing Address</b></td>
                    <td>:</td>
                    <td> </td>
                  </tr> 
                  <tr>
                    <td colspan="3">' .$value["zone_name"]. ','  .$value["city_name"]. ',' .$value["state_name"]. '</td>
                  </tr>
                  <tr>  
                  <tr colspan="6"></tr>
                  <tr colspan="6"></tr>
                  <tr colspan="6"></tr>
                  <tr colspan="6"></tr>
                  <tr colspan="6"></tr>
                  <tr colspan="6"></tr>
                </table>
              </div>  
                <table id="product_details" style="width:100%;" >
                  <tr>
                    <th>SN</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>*Price</th>
                    <th>Amount</th>
                  </tr><tr>
                    <td colspan="9"></td>
                  </tr>';  
                $i=1;
                $TaxableAmount = '0';
                foreach ($itemdata as $item) {    
                $message .=  '<tr>
                    <td>' .$i. '</td>
                    <td style="text-align: center;">' .$item["item_name"]. '+ Delivery Charges</td>
                    <td>' .$item["total"]. '</td>';
                    $calcu_price = $item["price"] + $item["delivery"];
                $message .=  '<td>&#8377;' .$calcu_price. '</td>
                    <td>' .$amount = $item["total"] * $calcu_price. '</td>
                </tr>';
                  $i++; }
                $message .=  '<tr>
                    <td></td>
                    <td>GSTIN</td>
                    <td>0%</td>
                    <td></td>
                    <td>&#8377; -</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;font-weight: bold;">Invoice Total</td>
                    <td></td>
                    <td></td>
                    <td style="color:red;font-weight: bold;">&#8377; ' .$TaxableAmount. '</td>
                  </tr>
                  <tr>
                    <td colspan="9">*Note : Price is product final price of per unit including & exluding all tax, charges & discounts.<br>*Computer generated invoice.</td>
                  </tr>
                  <tr>
                    <td colspan="9" rowspan="3"><h4 style="float: right;color:red;">Thank You, We look forword to serve you again.</h4></td>
                  </tr>
                </table>


                <div style="margin-top: 30px;">
                    <p style="width:85%;float: left;"><span style="color:red;">*</span>Scan the QR Code to check the invoice details of dailywale online Or visit : Our Site </p>
                     <img id="barcode" 
                    src="https://api.qrserver.com/v1/create-qr-code/?data=Sanjay&amp;size=100x100" 
                    alt="" 
                    title="Qr" 
                    width="70" 
                    height="70" />
                </div>

            </div>';

           }
        } 

        '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript">
            
        </script>
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

        </body>
        </html>';

        if(mail($to, $subject, $message, $headers)){
            $data_result['result'] ='true';
            $data_result['msg'] ='Invoice is sent to your email';
        }else{
            $data_result['result'] ='false';
            $data_result['msg'] = "Oops! Something went wrong please try later.";
        }

       echo json_encode($data_result); 
    }

    
}
?>