<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendorinfo extends CI_Controller {

   public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');

    }

 public function vendor()
    {

        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            // $data['vendor'] = $this->Model->getuserName();
            $data['vendor'] = $this->Model->select('vendor');
            $this->load->view('admin/vendor/vendor', $data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }

    }
       public function vendorAdd()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            // $data['city'] = $this->Model->select('city');
            $this->load->view('admin/vendor/addvendor');
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Vendorinfo');
        }
    }
     public Function addVendor()
        {
            if ($this->session->userdata('userinfo')) {  
                // $date=date('d-m-Y');

                $data = array(
                    'name'               => $this->input->post('name'),
                    'address'            => $this->input->post('address'),
                    'email'              => $this->input->post('email'),
                    'pwd'                => $this->input->post('pwd'),
                    'phone'              => $this->input->post('phone'),
                    'account_name'       => $this->input->post('account_name'),
                    'account_no'         => $this->input->post('account_no'),
                    'account_type'       => $this->input->post('account_type'),
                    'ifsc_code'          => $this->input->post('ifsc_code'),
                    'company_name'       => $this->input->post('company_name'),
                    'company_address'    => $this->input->post('company_address'),
                    'company_phone_no'   => $this->input->post('company_phone_no'),
                    'gst_no'             =>$this->input->post('gst_no')

                );
                $result = $this->Model->insert('vendor', $data);
                if ($result) {
                    $this->session->set_flashdata('Vendor', '<div class="alert alert-success ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>State Add Sucessfully!!</strong>.
                    </div>');

                    redirect('Vendorinfo/vendor');

                } else {

                    $this->session->set_flashdata('Vendor', '<div class="alert alert-danger ">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Customers Not Add!!</strong>.
                    </div>');

                    redirect('Vendorinfo/vendor');

                }

            } else {
                redirect('Welcome', 'refresh');
            }

        }
    
    public function editvendor($id)
    {

        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('id' => $id );
            $data['records'] = $this->Model->selectAllById('vendor', $wheredata);
            $whereItem  = array('vendor_id' => $id );
            $data['item_list'] = $this->Model->selectdata('item', $whereItem);
            $this->load->view('admin/vendor/editvendor',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }

    }
    public function vendorEdit()
    {
        if ($this->session->userdata('userinfo')) {
             // $date=date('d-m-Y');
           $wheredata = array(
                'id' => $this->input->post('id')

            );

            $data = array(
                'name'            => $this->input->post('name'),
                'address'         => $this->input->post('address'),
                'email'           => $this->input->post('email'),
                'pwd'             => $this->input->post('pwd'),
                'phone'           => $this->input->post('phone'),
                'account_name'    => $this->input->post('account_name'),
                'account_no'      => $this->input->post('account_no'),
                'account_type'    => $this->input->post('account_type'),
                'ifsc_code'       => $this->input->post('ifsc_code'),
                'company_name'    => $this->input->post('company_name'),
                'company_address' => $this->input->post('company_address'),
                'company_phone_no'=> $this->input->post('company_phone_no'),
                'gst_no'          =>$this->input->post('gst_no')
            );
            
             $result = $this->Model->update($wheredata, 'vendor', $data);
             if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');

                redirect('Vendorinfo/vendor');

                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');

                    redirect('Vendorinfo/vendor');

            }
        } else {
            redirect('Welcome');
        }
    }     
    public function deleterecord($id, $tbl, $rd)
    {
        if ($this->session->userdata('userinfo')) {

            $wheredata    = array(
                'id' => $id
            );
            $data['test'] = $this->Model->deleterec($wheredata, $tbl);
            $this->session->set_flashdata('deletestate', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Delete Sucessfully!!</strong>.
                </div>');
            redirect('Vendorinfo/' . $rd);
        } else {
                   $this->session->set_flashdata('deletestate', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>state Record Not Delete!!</strong>.
                </div>');
            redirect('Welcome', 'refresh');
        }
    }

    public function wallet_crdr($id)
    {
         //print_r( $this->session->userdata('userinfo'));die;
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $data['wallet'] = $this->Model->select_amount($id);
           // echo "<pre>";  print_r( $data['wallet']);die;
            $this->load->view('admin/vendor/walletcredit_debit',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('welcome');
        }

    }

    public function credit_debit()
    {
        if ($this->session->userdata('userinfo')) {
           $date = date('Y-m-d');
           $ids  = $this->input->post('id');
           $wheredata = array(
                'id' => $ids

            );
            $check_paymentStatus = $this->input->post('status');  
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
            $result = $this->Model->update($wheredata, 'vendor', $data);
            if ($result) {
                $dataTranction =array(
                    "vendor_id"=> $this->input->post('id'),
                    "amount"=> $this->input->post('amt'),
                    "discription"=>   $check_paymentStatus,
                    // "date_time" => $date
                );
                $create = $this->Model->insert('wallet_history',$dataTranction);

                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Update Sucessfully!!</strong>.
                </div>');

                redirect('Vendorinfo/wallet_crdr/'.$ids);

                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Drivers Record Not Update !!</strong>.
                </div>');

                 redirect('Vendorinfo/wallet_crdr/'.$ids);

            }
        } else {
            redirect('Welcome');
        }
    }



    public function vendorProfile($id){ 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('id' => $id );
            $data['vendordata']  = $this->Model->selectdata('vendor', $wheredata);
           // $data['lastOrder'] = $this->Model->getLastOrder($id);
           // $data['allnotification'] = $this->Model->selectdata('notification' ,$wheredata);
            //$data['records'] = $this->Model->selectAllById('user', $wheredata);
           $data['upcoming_order'] = $this->Model->getVendor_upcomingOrder($id);
          //  $data['wallet_amount'] = $this->Model->getWalletHistory($id);
            //$data['past_order_date'] = $this->Model->getOrderHistory($id);
            $data['PrivousDayOrder'] = $this->Model->vendorPastOrder($id);
            $this->load->view('admin/vendor/vendorprofile',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Welcome');
        }
    }   


    public function fetchSellerInvoiceForMonth(){
        $month  = $this->input->get('month');
        $sellerId = $this->input->get('vendorId');
        $vend = $this->db->query('SELECT * FROM `vendor` WHERE id = "'.$sellerId.'"')->result_array();
        if ($vend) {
            $sell_item = $this->Model->getSellerItemDetails($month, $sellerId);
           //echo '<pre>'; print_r($sell_item);die;
            if ($sell_item) {
                $WhereCheck = array('invoice_month' => $month, 'vendor_id' => $sellerId );
                $result = $this->Model->selectdata('seller_invoice_item', $WhereCheck);
                if ($result) {
                     $invCheck = array('month' => $month, 'vendor_id' => $sellerId );
                     $seller_result = $this->Model->selectdata('seller_invoice', $invCheck);

                    $dataItem[0] = array(
                        'vendor_id'     => $vend[0]['id'],
                        'name'          => $vend[0]['name'],
                        'address'       => $vend[0]['address'],
                        'email'         => $vend[0]['email'],
                        'phone'         => $vend[0]['phone'],
                        'company_name'  => $vend[0]['company_name'],
                        'gst_no'        => $vend[0]['gst_no'],
                        'invoice_no'    => $seller_result[0]['invoice_no'],
                        'ItemDetails'   => $result,
                    );
                        
                }else{

                    foreach ($sell_item as $key) {
                    $total_item_price      = $key['total'] * $key['item_price'];
                    $total_delivery_charge = $key['total'] * $key['seller_delivery'];
                    $total_item_discount   = $key['total'] * $key['item_discount'];
                    $dataInvoice = array(
                        'item_id'                   => $key['item_id'],
                        'item_name'                 => $key['item_name'],
                        'item_price'                => $key['item_price'],
                        'total_item_unit'           => $key['total'],
                        'item_discount'             => $key['item_discount'],
                        'seller_delivery'           => $key['seller_delivery'],
                        'seller_packaging_charge'   => $key['seller_packaging'],
                        'total_item_discount'       => $total_item_discount,
                        'total_delivery_charge'     => $total_delivery_charge,
                        'total_item_price'          => $total_item_price,
                        'cgstin'                    => $key['cgstin'],
                        'sgstin'                    => $key['sgstin'],
                        'remark'                    => $key['remark'],
                        'vendor_id'                 => $key['vendor_id'],
                        'invoice_month'             => $month
                    );

                    $invoice_item = $this->Model->insert('seller_invoice_item', $dataInvoice);

                    $inv_ids[] = $invoice_item;
                    }

                    $CheckInvoice = array('month' => $month, 'vendor_id' => $sellerId );
                    $result = $this->Model->selectdata('seller_invoice', $CheckInvoice);
                    if ($result) {
                        $invCheck = array('month' => $month, 'vendor_id' => $sellerId );
                        $seller_result = $this->Model->selectdata('seller_invoice', $invCheck);
                    }else{

                        $Invoice = 'D/'.$sellerId.'/'.$month;

                        $itemID = implode(',', $inv_ids);
                        $arraydata = array(
                            'vendor_id'     => $sellerId,
                            'month'         => $month,
                            'invoice_row_id'=> $itemID,
                            'invoice_no'    => $Invoice
                        );
                        $this->Model->insert('seller_invoice', $arraydata); 

                        $invCheck = array('month' => $month, 'vendor_id' => $sellerId );
                        $seller_result = $this->Model->selectdata('seller_invoice', $invCheck);   
                    }

                    $WhereCheck = array('invoice_month' => $month, 'vendor_id' => $sellerId );
                    $result = $this->Model->selectdata('seller_invoice_item', $WhereCheck);

                    $dataItem[0] = array(
                        'vendor_id'     => $vend[0]['id'],
                        'name'          => $vend[0]['name'],
                        'address'       => $vend[0]['address'],
                        'email'         => $vend[0]['email'],
                        'phone'         => $vend[0]['phone'],
                        'company_name'  => $vend[0]['company_name'],
                        'gst_no'        => $vend[0]['gst_no'],
                        'invoice_no'    => $seller_result[0]['invoice_no'],
                        'ItemDetails'   => $result,
                    );

                }
                
            }
        }
        echo json_encode($dataItem);
    }



    public function sendVendorInvoice(){
        $month  = $this->input->get('month');
        $sellerId = $this->input->get('vendorId');
        $vend = $this->db->query('SELECT * FROM `vendor` WHERE id = "'.$sellerId.'"')->result_array();
        if ($vend) {
            $sell_item = $this->Model->getSellerItemDetails($month, $sellerId);
            if ($sell_item) {
                $WhereCheck = array('invoice_month' => $month, 'vendor_id' => $sellerId );
                $result = $this->Model->selectdata('seller_invoice_item', $WhereCheck);
                if ($result) {
                     $invCheck = array('month' => $month, 'vendor_id' => $sellerId );
                     $seller_result = $this->Model->selectdata('seller_invoice', $invCheck);

                    $dataItem[0] = array(
                        'vendor_id'     => $vend[0]['id'],
                        'name'          => $vend[0]['name'],
                        'address'       => $vend[0]['address'],
                        'email'         => $vend[0]['email'],
                        'phone'         => $vend[0]['phone'],
                        'company_name'  => $vend[0]['company_name'],
                        'gst_no'        => $vend[0]['gst_no'],
                        'invoice_no'    => $seller_result[0]['invoice_no'],
                        'ItemDetails'   => $result,
                    );
                        
                }
                //print_r($dataItem);
                $curentDate = date('d/m/Y');
                $to = $vend[0]['email'];
                $subject = 'Invoice Send on email account....';
                $headers = "From: " . strip_tags('noreply@dailywale.com') . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $message = '';
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
        font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
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

<body>


    <div class="invoice-box" style="margin-top:100px;">
      <div id="part_1">
        <center><img src="http://dailywale.com/dailywaleAdmin//assets/img/logo.png.png" alt="dailywale" width="12%"></center>
            <table style="width:100%;padding-top:35px;" >
            <tr>
             <td colspan="3"><b><span style="color:#625db1;">Daily Needs And Activities</span> </b></td>
             <td colspan="3"><!-- <b style="color:red;">Total - &#8377; 10,080.00</b> --></td>
            </tr>
            <tr>
             <td>GSTIN</td>
             <td>:</td>
             <td>Nil</td>
             <td>Invoice Date</td>
             <td>:</td>
             <td>'.$curentDate.'</td>
            </tr>
            <tr>
             <td>PAN</td>
             <td>:</td>
             <td>Nil</td>
             <td>Invoice No.</td>
             <td>:</td>
             <td>'.$seller_result[0]['invoice_no'].'</td>
            </tr>
            <tr>
             <td>State</td>
             <td>:</td>
             <td>Madhya Pradesh</td>
             <td></td>
             <td></td>
             <td></td>
            </tr>
            <tr style="line-height:80px">
             <td colspan="6" style="font-size: 22px;">----------------------------------  BANK SETTELMENT  ----------------------------------</td>
            </tr>
            <tr>
             <td><b>Seller</b></td>
             <td>:</td>
             <td><b><span style="color:red;">'.$vend[0]["name"].'('.$vend[0]["company_name"].')</span></b></td>
             <td colspan="3"><b style="color:red;float: right;">Billing Address</b></td>
            </tr>
            <tr>
             <td>GSTIN</td><td>:</td><td>'.$vend[0]["gst_no"].'</td>
            <tr>
             <td>PAN</td>
             <td>:</td>
             <td>Nil</td>
             <td colspan="3">'.$vend[0]["address"].'</td>
            </tr>
            <tr>
             <td>State</td>
             <td>:</td>
             <td>Madhya Pradesh</td>
             <td colspan="3"></td>
            </tr>
            <tr colspan="6"></tr>
            <tr colspan="6"></tr>
            <tr colspan="6"></tr>
            <tr colspan="6"></tr>
            <tr colspan="6"></tr>
            <tr colspan="6"></tr>
            </table></div>
            
            <table id="product_details" style="width:100%;" >
              <tr>
               <th>SN</th>
               <th>Product</th>
               <th>Unit</th>
               <th>Selling Price</th>
               <th>Unit Amount</th>
               <th>Delivery Charges</th>
               <th>Delivery Total</th>
               <th>Amount</th>
               <th>Remarks</th>
              </tr>';
              $i=1;
              $sum_total_unit = '0';
              $sum_total_item_price = '0';
              $sum_total_delvry = '0';
              $sum_total = '0';
              foreach ($result as $itemData) {
                $Totalamount = $itemData["total_item_price"] - $itemData["total_delivery_charge"];

                $sum_total_unit += $itemData["total_item_unit"];
                $sum_total_item_price += $itemData["total_item_price"];
                $sum_total_delvry += $itemData["total_delivery_charge"];
                $sum_total += $Totalamount;
                $payment_gateway = $sum_total * 2.97 / 100;
                $invoice_total = $sum_total - $payment_gateway;

            $message .=  '<tr>
                <td>'.$i.'</td>
                <td style="text-align: center;">'.$itemData["item_name"].'</td>
                <td>'.$itemData["total_item_unit"].'</td>
                <td>&#8377;' .$itemData["item_price"].'</td>
                <td>'.$itemData["total_item_price"].'</td>
                <td>&#8377; '.$itemData["seller_delivery"].'</td>
                <td>&#8377; '.$itemData["total_delivery_charge"].'</td>
                <td>&#8377; '.$Totalamount.'</td>
                <td>&#8377; '.$itemData["remark"].'</td>
              </tr>';

              $i++;  }

            $message .= '<tr>
                <td colspan="9"></td>
              </tr>
              <tr>
                <td></td>
                <td><b>Total</b></td>
                <td><b>'.$sum_total_unit.'</b></td>
                <td></td>
                <td><b>&#8377; '.$sum_total_item_price.'</b></td>
                <td></td>
                <td><b>&#8377; '.$sum_total_delvry.'</b></td>
                <td><b>&#8377; '.$sum_total.'</b></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td colspan="2">Taxable Amount</td>
                <td></td>
                <td></td>
                <td></td>
                <td>&#8377; '.$sum_total.'</td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td colspan="2">CGSTIN 2.5%</td>
                <td></td>
                <td></td>
                <td></td>
                <td>&#8377;  0</td>
                <td>0.00%</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td colspan="2">SGSTIN 2.5%</td>
                <td></td>
                <td></td>
                <td></td>
                <td>&#8377;  0</td>
                <td>0.00%</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td style="color:red;font-weight: bold;" colspan="3">Payment Gateway</td>
                <td></td>
                <td></td>
                <td style="color:red;font-weight: bold;">&#8377; - '.$payment_gateway.'</td>
                <td>2.97%</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td colspan="2"><b>Invoice Total</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td>&#8377; '.$invoice_total.'</td><td></td></tr><tr><td colspan="9" rowspan="3"><h4 style="float: right;color:red;">Thank You, We look forword to serve you again.</h4></td>
              </tr>
              </table>
              <div style="margin-top: 30px;"><p style="width:85%;float: left;"><span style="color:red;">*</span>Scan the QR Code to check the invoice details of dailywale online Or visit : Our Site </p></div>
          </div>
        </body>
        </html>';
              
               if(mail($to, $subject, $message, $headers)){
                   $data_result['result'] ='true';
                   $data_result['msg']    ='Invoice sucessfully sent on '.$vend[0]["email"].' mail.';
               }else{
                   $data_result['result'] ='false';
                   $data_result['msg'] ="Email not send.";
               }
                
            }
        }
        echo json_encode($data_result);
    }




}
?>