<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {


     
    public function index()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cookie');
	}

    public function push_notification()
    { 
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $this->load->view('admin/notification/edit_notification');
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Notification');
        }
        
    }

     public function sendPushNotification() {
    if ($this ->session->userdata('userinfo')) {
        $id   = $this->input->post('id');
        $type = $this->input->post('type');
        $title   = $this->input->post('title');
        $message = $this->input->post('message');
        
        if ($id == '0' && $type == 'android') {

            $where1 = array(
                'device_type' => $type
            );

            $records = $this->Model->selectAllUserType('user', $where1);
            if ($records) {
                 foreach ($records as $key) {

                    $msg  = array(
                        'message'    => $message,
                        'title'      => $title,
                        'user_id'   => $key['user_id'],
                    );
                    $fields            = array(
                        'registration_ids' => array($key['device_token']),
                        'data'             => $msg
                    );
                    
                    $headers = array(       
                        'Authorization: key=AIzaSyAjqK2eEz1EO3weNVNUVkuE2hrHDVwCkKo',
                        'Content-Type: application/json'
                    );
                    $ch      = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    
                    $result = curl_exec($ch);
                    curl_close($ch);



                 }
             }
        }else{
            //echo "string";
            $where11  = array(
                 'user_id' => $id,
                 'device_type' => $type
                 );
             $records = $this->Model->selectAllUserType('user', $where11);
             if ($records) {
                 foreach ($records as $key) {
                   

                    $msg  = array(
                        'message'    => $message,
                        'title'      => $title,
                        'user_id'   => $key['user_id'],
                    );
                    $fields            = array(
                       
                        'registration_ids' => array($key['device_token']),
                        'data'             => $msg
                    );
                    
                    $headers = array(       
                        'Authorization: key=AIzaSyAjqK2eEz1EO3weNVNUVkuE2hrHDVwCkKo',
                        'Content-Type: application/json'
                    );
                    $ch      = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    
                    $result = curl_exec($ch);
                    curl_close($ch);

                    $this->session->set_flashdata('User', '<div class="alert alert-info " style="width: 44%;
                    margin: 17px 22px 21px 295px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Notification  Send Sucessfully!!</strong>.
                    </div>');
                    
                    redirect('Notification/push_notification');
                 }
             }

        }
    } else {
        redirect('Notification');
    }

}


//     public function sendPushNotification() {
//     if ($this ->session->userdata('userinfo')) {
//         $id   = $this->input->post('id');
//         $type = $this->input->post('type');
//         $title   = $this->input->post('title');
//         $message = $this->input->post('message');
            
//         if ($id == '0' || $type == 'android') {

//             $where1 = array(
//                 'device_type' => $type
//             );

//             $records = $this->Model->selectAllUserType('user', $where1);
//             if ($records) {
//                  foreach ($records as $key) {

//                     $msg  = array(
//                         'message'    => $message,
//                         'title'      => $title,
//                         'user_id'   => $key['user_id'],
//                     );
//                     $fields            = array(
//                         'registration_ids' => array($key['device_token']),
//                         'data'             => $msg
//                     );
                    
//                     $headers = array(       
//                         'Authorization: key=AIzaSyAjqK2eEz1EO3weNVNUVkuE2hrHDVwCkKo',
//                         'Content-Type: application/json'
//                     );
//                     $ch      = curl_init();
//                     curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
//                     curl_setopt($ch, CURLOPT_POST, true);
//                     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//                     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//                     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    
//                     $result = curl_exec($ch);
//                     curl_close($ch);

//                  }
//              }

//         }elseif($id == '0' || $type == 'ios') {

//                 $where2 = array(
//                     'device_type' => $type
//                 );
//                 $records = $this ->Model-> selectAllUserType('user', $where2);
//         } else if ($id == '0' && $type == 'both') {

//                 $data['both'] = $this ->Model-> select('user1', 'user_id asc');
//                 //print_r($data['both']);
//         } else {

//             //echo "string";
//                  $where1  = array(
//                  'user_id' => $id,
//                  'device_type' => $type
//                  );
//              $records = $this->Model->selectAllUserType('user', $where1);
//              //print_r($records);die;
//              if ($records) {
//                  foreach ($records as $key) {
//                     // echo $key['user_id'];
//                     // echo $key['device_token'];

//                     $msg  = array(
//                         'message'    => $message,
//                         'title'      => $title,
//                         'user_id'   => $id,
//                     );
//                     $fields            = array(
//                         'registration_ids' => array($key['device_token']),
//                         'data'             => $msg
//                     );
                    
//                     $headers = array(       
//                         'Authorization: key=AIzaSyAjqK2eEz1EO3weNVNUVkuE2hrHDVwCkKo',
//                         'Content-Type: application/json'
//                     );
//                     $ch      = curl_init();
//                     curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
//                     curl_setopt($ch, CURLOPT_POST, true);
//                     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//                     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//                     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    
//                     $result = curl_exec($ch);
//                     curl_close($ch);

//                  }
//              }
        
//             }

//             //  if ($id == '0' || $type == 'both' ) {
//             //     $where1  = array(
//             //      'device_type' => $type
//             //      );
//             //     $data['records'] = $this->Model->selectAllUserType('user', $where1);
//             //     echo"<pre>"; print_r($data['records']);die;
//             //  }else{
//             //      $where1  = array(
//             //      'user_id' => $id,
//             //      'device_type' => $type
//             //      );
//             //      $data['records'] = $this->Model->selectAllUserType('user', $where1);
//             //      echo"<pre>"; print_r($data['records']);die;
//             //  }

//             //  $where1  = array(
//             //      'user_id' => $id,
//             //      'device_type' => $type
//             //      );
//             //  //print_r($where1);die;
//             //  $data['records'] = $this->Model->selectAllUserType('user', $where1);
//             // echo"<pre>"; print_r($data['records']);die;

//             // if ($id == '0' || $type == 'android') {
//             //      $where2  = array(
//             //      'device_type' => 'android'
//             //      );
//             //      $data['android'] = $this->Model->selectAllUserType('user', $where2);
//             // echo"<pre>"; print_r($data['android']);die;

//             // }elseif ($id == '0' || $type == 'ios') {
//             //    print_r('dfds');die;
//             //     $where3  = array(
//             //     'device_type' => 'ios'
//             //     );
//             //     $data['ios'] = $this->Model->selectAllUserType('user', $where3);

//             //     echo"<pre>"; print_r($data['ios']);die;
//             // }elseif ($id == '0' || $type == 'both') {
//             //     echo "both";
//             //     $data['both'] = $this->Model->select('user','user_id asc');
//             // }else{
//             //     echo "string";

//             // }else{
//             //     print_r('sada');die;
//             // }

//     } else {
//         redirect('Notification');
//     }

// }


	 // public function push_notification()
  //   {
        // $where1  = array(
        //          'user_id' => $id,
        //          'device_type' => $type
        //          );
        //      $records = $this->Model->selectAllUserType('user', $where1);
        //      if ($records) {
        //          foreach ($records as $key) {
        //             echo $key['user_id'];
        //             echo $key['device_token'];

        //             $msg  = array(
        //                 'message'    => $message,
        //                 'title'      => $title,
        //                 'user_id'   => $key['user_id'],
        //             );
        //             $fields            = array(
        //                 // 'registration_ids' => array('cr3EHxJs-Ks:APA91bGvmNRAJy2Vb5-JwYH9zHa8-yKzAUFNzq-NAcOQ4YPi25j9CPKwjgVHv2oVwkiBxPUVgiBJy-d0SkefUUqeFnzxgvFqZxXYbFBKIxYoRkq9rZECMQK-qJc8fjsoPVbYK72x1dfj'),
        //                 'registration_ids' => array($key['device_token']),
        //                 'data'             => $msg
        //             );
                    
        //             $headers = array(       
        //                 'Authorization: key=AIzaSyAjqK2eEz1EO3weNVNUVkuE2hrHDVwCkKo',
        //                 'Content-Type: application/json'
        //             );
        //             $ch      = curl_init();
        //             curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        //             curl_setopt($ch, CURLOPT_POST, true);
        //             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //             curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    
        //             $result = curl_exec($ch);
        //             curl_close($ch);

        //          }
        //      }
  //       if ($this->session->userdata('userinfo')) {

  //           $this->load->view('admin/assets/header');
  //           $this->load->view('admin/assets/sidebar');
  //           $data['users'] = $this->Model->select('push_notification', 'id desc');
  //          //print_r($data['records']);die;
  //            $this->load->view('admin/notification/notification',$data);
  //           $this->load->view('admin/assets/footer');
  //       } else {
  //           redirect('Notification');
  //       }
        
  //   }

    public function editnotification($id)
    {
        
        if ($this->session->userdata('userinfo')) {
            $this->load->view('admin/assets/header');
            $this->load->view('admin/assets/sidebar');
            $wheredata  = array('id' => $id );
            $data['records'] = $this->Model->selectAllById('push_notification', $wheredata);
            //print_r( $data['records']);die;
            $this->load->view('admin/notification/edit_notification',$data);
            $this->load->view('admin/assets/footer');
        } else {
            redirect('Notification');
        }
        
    }

    public function Edit()
    {
        if ($this->session->userdata('userinfo')) {

            $data = array(
                'message'        => $this->input->post('message')
            );

             $wheredata11 = array(
                'id' => $this->input->post('id')

            );
            $result = $this->Model->update($wheredata11, 'push_notification', $data);
            if ($result) {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-success ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Update Sucessfully!!</strong>.
                </div>');
                
                redirect('Notification/push_notification');
            } else {
                $this->session->set_flashdata('updatedrivers', '<div class="alert alert-danger ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong> Not Update !!</strong>.
                </div>');
                 redirect('Notification/editnotification');
            }
        }else {
            redirect('Welcome');
        }
    }
    

}
?>