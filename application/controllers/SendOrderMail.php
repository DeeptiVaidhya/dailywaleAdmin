<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendOrderMail extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('email');        
    }
    // ********************************
     

    // Download Daily Orders CSV file on Server
    function downloadDailyOrdersCSV_next_day(){
        //$date = date('d-m-Y',  strtotime("+1 days"));
        $export_from_delivery = date('d-m-Y', strtotime("+1 days")); //'25-01-2019'; 
        $export_to_delivery   = date('d-m-Y', strtotime("+1 days")); //'25-01-2019'; 
        //date('d-m-Y');
        $filename = 'Dailywale_Orders_'.date('d-m-Y_H_i_s').'.csv'; 
        $users_delivery_Data = $this->Model->get_Delivery_Data($export_from_delivery, $export_to_delivery);
        $file = fopen('php://output', 'w');
        $delimiter = ",";
        $csv = "First Name,Last Name,Address,Zone,Subzone,City,State,Item,Unit \n";
        foreach ($users_delivery_Data as $line){ 
            $csv .= $line['fname'] . ',' . $line['lname']. ',' . $line['address']. ',' . $line['zone_name']. ',' . $line['subzone_name']. ',' . $line['city_name']. ',' . $line['state_name']. ',' . $line['item_name']. ',' . $line['quanity'] . "\n";
        }
        fwrite($file, $csv); 
        $path=$_SERVER["DOCUMENT_ROOT"];
        file_put_contents($path."/dailywaleAdmin/download_csv/daily_order/" . $filename, $csv);
        fclose($file);
    }



    // Download Orders Summary CSV file on Server
    function downloadOrdersSummaryCSV_next_day(){
        $export_from = date('d-m-Y', strtotime("+1 days")); //'25-01-2019'; 
        $export_to   = date('d-m-Y', strtotime("+1 days")); //'25-01-2019'; 
        //date('d-m-Y');
        $filename = 'Dailywale_Summary_'.date('d-m-Y_H_i_s').'.csv'; 
        $usersData = $this->Model->getUserDetailsData($export_from, $export_to);
        $file = fopen('php://output', 'w');
        $delimiter = ",";
        $csv = "Item Name,Quanity,Item Quantity Desc \n";
        foreach ($usersData as $line){ 
            $csv .= $line['item_name'] . ',' . $line['total']. ',' . $line['item_quantity_desc']. ',' . "\n";
        }
        fwrite($file, $csv); 
        $path=$_SERVER["DOCUMENT_ROOT"];
        file_put_contents($path."/dailywaleAdmin/download_csv/order_summary/" . $filename, $csv);
        fclose($file);

    }


    function sendDailyOrderMail_next_day()
    {

        $config=array(
          'mailpath' => '/usr/sbin/sendmail',
          'protocol'=>'smtp',
          'smtp_host'=>'ssl://smtp.gmail.com',
          'smtp_port'=>465,
          'smtp_user'=>'sensanjay42@gmail.com',
          'smtp_pass'=>'atulLALIT',
          'mailtype'  => 'html', 
          'charset'   => 'iso-8859-1'
        );

        $this->load->library("email",$config);

        $this->email->set_newline("\r\n");
        $this->email->from('From Mail', 'From Sanjay Sen');
        $this->email->to('sanjay.sen@engineermaster.in');
        $this->email->cc('khandaite@gmail.com');
        $this->email->subject('Notification for Daily Order');
        $this->email->message('Please find this attachment'); 
        
        $path=$_SERVER["DOCUMENT_ROOT"];
        
        $file=$path."/dailywaleAdmin/download_csv/daily_order/Dailywale_Orders_".date('d-m-Y_H_i_s').".csv";

        $this->email->attach($file);

        if($this->email->send())
        {
            echo "Mail send successfully with attachement!";
        }else{
            show_error($this->email->print_debugger());
        }
    }


    function sendOrderSummaryMail_next_day()
    {

        $config=array(
          'mailpath' => '/usr/sbin/sendmail',
          'protocol'=>'smtp',
          'smtp_host'=>'ssl://smtp.gmail.com',
          'smtp_port'=>465,
          'smtp_user'=>'sensanjay42@gmail.com',
          'smtp_pass'=>'atulLALIT',
          'mailtype'  => 'html', 
          'charset'   => 'iso-8859-1'
        );

        $this->load->library("email",$config);

        $this->email->set_newline("\r\n");
        $this->email->from('From Mail', 'From Sanjay Sen');
        $this->email->to('sanjay.sen@engineermaster.in');
        $this->email->cc('khandaite@gmail.com');
        $this->email->subject('Notification for Order Summary');
        $this->email->message('Please find this attachment.'); 
        
        $path=$_SERVER["DOCUMENT_ROOT"];
        
        $file=$path."/dailywaleAdmin/download_csv/order_summary/Dailywale_Summary_".date('d-m-Y_H_i_s').".csv";

        $this->email->attach($file);

        if($this->email->send())
        {
            echo "Mail send successfully with attachement!";
        }else{
            show_error($this->email->print_debugger());
        }
    }
        

}
?>