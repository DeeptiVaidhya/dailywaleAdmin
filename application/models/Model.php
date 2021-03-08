<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model{

	public function login($wheredata,$table){

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($wheredata);
		$query=$this->db->get();
    return $query->row();
	}


	function insert($table,$data)
	{ 
		$this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
      /*  echo $this->db->last_query();exit();*/
		return  $insert_id;
	    
	}

  public function selectDrag($table,$order=""){ 
        
     $this->db->select('*');
     $this->db->from($table);
     $this->db->order_by('position_order', 'ASC');
     $query = $this->db->get();
     return $query->result_array();
 }

    public function selectAllUserCityName($tbl,$whereCity){
      $this ->db-> select('*');
      $this ->db-> from($tbl);
      $this ->db-> where_in($whereCity);

      $query = $this->db-> get();
      // echo $this->db->last_query();exit();
      return $query->result_array();

    }
    public function selectAllUsersubzone($tbl,$wheresubzone){
      $this ->db-> select('*');
      $this ->db-> from($tbl);
      $this ->db-> where_in($wheresubzone);

      $query = $this->db-> get();
      // echo $this->db->last_query();exit();
      return $query->result_array();

    }
    public function selectAllUserZone($tbl,$wherezone){
      $this ->db-> select('*');
      $this ->db-> from($tbl);
      $this ->db-> where_in($wherezone);

      $query = $this->db-> get();
    // echo $this->db->last_query();exit();
    return $query->result_array();

    }

    public function selectAllUserType($tbl,$wheredata="",$order=""){
           $this->db-> select('*');
           $this->db->order_by($order);
           $this->db->from($tbl);
           $this->db->where($wheredata);
         
           $query = $this ->db->get();
           return $query->result_array();
           
  }

    

   public function getUserData($wheredata){
      $this->db->select("*");
      $this->db->from('user');
      $this->db->where($wheredata);
      $query = $this->db->get();
       //echo $this->db->last_query();exit();
      return $query->result_array();
      // $this->db->select("user.*,city.city_name,state.state_name,zone.zone_name,subzone.subzone_name");
      // $this->db->from('user');
      // $this->db->join('city', 'city.city_id = user.city_id');
      // $this->db->join('zone', 'zone.zone_id = user.zone_id');
      // $this->db->join('subzone', 'subzone.subzone_id = user.subzone_id');
      // $this->db->join('state', 'state.state_id = user.state_id');
      // $this->db->where($wheredata);
      // $query = $this->db->get();
      //  //echo $this->db->last_query();exit();
      // return $query->result_array();
     }

    function getUserInfo(){
        $this->db->select("user.*,city.city_name,state.state_name,zone.zone_name,subzone.subzone_name");
        $this->db->from('user');
        $this->db->join('city', 'city.city_id = user.city_id');
        $this->db->join('zone', 'zone.zone_id = user.zone_id');
        $this->db->join('subzone', 'subzone.subzone_id = user.subzone_id');
        $this->db->join('state', 'state.state_id = user.state_id');
        $query = $this->db->get();
        return $query->result_array();
       }   

	public function select($table,$order=""){ 
        
     $this->db->select('*');
     $this->db->order_by($order);
     $this->db->from($table);
     $query = $this->db->get();
     return $query->result_array();
     }

  public function select_amount($id)
    {     
       $this->db->select('*');  
       $this->db->from('vendor');
       $this->db->where('id', $id);
       $query = $this->db->get();
       return $query->result_array();
     }
  public function selectdata($table,$wheredata,$order=""){ 
        $this->db->select('*');
        $this->db->order_by($order);
        $this->db->from($table);
        $this->db->where($wheredata);
        $query = $this->db->get();
        return $query->result_array();
      }

  public function selectuser($table,$wheredata,$order=""){ 
        $this->db->select('fname,lname,email,user_mobile,city_id,zone_id,subzone_id,pincode,address,state_id');
        $this->db->order_by($order);
        $this->db->from($table);
        $this->db->where($wheredata);
        $query = $this->db->get();
        return $query->row();
      }

  public function selectvendor($table,$wheredata,$order=""){ 
      $this->db->select('*');
      $this->db->order_by($order);
      $this->db->from($table);
      $this->db->where($wheredata);
      $query = $this->db->get();
      return $query->row();
    }    

  public function selectdataOrderCancel($table, $user_id, $date){
        $query = $this->db->query("SELECT * from $table where user_id = '$user_id' and date_time = '$date' and (cart_status='3' or cart_status='5')");
        return $query->result_array();
      }

  public function selectReturn($where_cart_id)
     { 
       $this->db->select('*');
       $this->db->from('cart');
       $this->db->where('cart_id' , $where_cart_id);
       $query = $this->db->get();
      return $query->result_array();
     }

  public function selectWallet($get_user_id)
     {
       $this->db->select('wallet_amount');
       $this->db->from('user');
       $this->db->where('user_id' , $get_user_id);
       $query = $this->db->get();
       return $query->result_array();
     }

  public function updateReturn($user_id, $getAmount)
     {
        $query = $this->db->set('wallet_amount', $getAmount);
        $query = $this->db->where('user_id', $user_id);
        $query = $this->db->update('user');
        return $query;

     }
     public function updateData($table,$data,$where_data){
    
    $this->db->where($where_data);
    $insertData=$this->db->update($table,$data);
    if($insertData){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  public function updateWallet($user_id, $amount){
    $query = $this->db->query("update user set wallet_amount=wallet_amount+'$amount' where user_id='$user_id'");
    return $query;
  }

  public function selectDataWhereNotInCondition($table,$wheredata,$order=""){ 
        
     $this->db->select('*');
     $this->db->order_by($order);
     $this->db->from($table);
     $this->db->where($wheredata);
     $this->db->where('status != ',6,FALSE);
     $query = $this ->db-> get();
     return $query->result_array();
     }


	public function deleterec($wheredata,$tbl){
		$query = $this->db->where($wheredata);
		$query = $this->db->delete($tbl);
		return $query;	
	}


	public function selectAllById($tbl,$wheredata="",$order=""){
           $this -> db -> select('*');
           $this-> db ->order_by($order);
           $this -> db -> from($tbl);
           $this -> db -> where($wheredata);
         
           $query = $this -> db -> get();
             // echo $this->db->last_query();exit();
           return $query->row();
           
  }
  public function selectAllById1($tbl,$wheredata=""){
  		   $this -> db -> select('*');
             $this -> db -> from($tbl);
             $this -> db -> where($wheredata);
             $query = $this -> db -> get();
             //echo $this->db->last_query();exit();
             return $query->row();
             
  	}

 public function selectAllByIdarray($tbl,$wheredata){
         $this -> db -> select('*');
             $this -> db -> from($tbl);
             $this -> db -> where($wheredata);
             $query = $this -> db -> get();
             //echo $this->db->last_query();exit();
             return $query->result_array();
             
    }


	public function selectAllByIdwherenot($tbl,$wheredata=""){
		   $this -> db -> select('*');
           $this -> db -> from($tbl);
           $this -> db -> where($wheredata);
           $this -> db ->where('status != ',0,FALSE);
           $query = $this -> db -> get();
           //echo $this->db->last_query();exit();
           return $query->result_array();
           
	}

	public function update($wheredata,$table,$data){
		$query = $this->db->where($wheredata);
		$query = $this->db->update($table,$data);
   // echo $this->db->last_query();exit();
		return $query;
	
	}


  public function record_count($table,$data='')
 	{
 	if(!empty($data))
 	{
     	$this->db->where($data);
     	}
     $this->db->from($table);
     return $this->db->count_all_results();
 	}


  public function merchantrecord_count($table,$wheredata)
 	{
 	$this->db->where($wheredata);
    return $this->db->count_all_results($table);
 	}


  public function Add_User($data_user){
      $this->db->insert('orders', $data_user);
       }

      function getOrderHistory_upcoming($id){
        $curr_date = date('Y-m-d');
       $this->db->select("user.fname,user.lname,item.item_name,cart.cart_id,cart.quanity,cart.cart_status,cart.driver_name,cart.date_time");
        $this->db->from('cart');
        $this->db->join('item', 'item.item_id = cart.item_id');
        $this->db->join('user', 'cart.user_id = user.user_id');
        $this->db->where('cart.user_id',$id);
        $this->db->where('cart.date_time >', $curr_date ); 
        $this->db->order_by('cart.date_time', 'asc');
        $query = $this->db->get();
        return $query->result_array();
       }

       function getOrderHistory_past($id){
        $curr_date = date('Y-m-d');
        $this->db->select("user.fname,user.lname,item.item_name,cart.cart_id,cart.quanity,cart.cart_status,cart.driver_name,cart.date_time");
        $this->db->from('cart');
        $this->db->join('item', 'item.item_id = cart.item_id');
        $this->db->join('user', 'cart.user_id = user.user_id');
        $this->db->where('cart.user_id',$id);
        $this->db->where('cart.date_time <=', $curr_date ); 
        $this->db->order_by('cart.date_time', 'desc');
        $query = $this->db->get();
        return $query->result_array();
       }


       function getOrderHistory($id){
        $curr_date = date('Y-m-d');
        $this->db->select("user.fname,user.lname,item.item_name,cart.quanity,cart.date_time");
        $this->db->from('cart');
        $this->db->join('item', 'item.item_id = cart.item_id');
        $this->db->join('user', 'cart.user_id = user.user_id');
        $this->db->where('cart.user_id',$id);
        $this->db->group_by('cart.date_time'); 
        $this->db->order_by('cart.date_time', 'desc');
        $query = $this->db->get();
        return $query->result_array();
       }

       function getVendor_upcomingOrder($id){
          $curr_date = date('Y-m-d');
         $this->db->select("user.fname,user.lname,item.item_name,cart.cart_id,cart.quanity,cart.cart_status,cart.driver_name,cart.date_time");
          $this->db->from('cart');
          $this->db->join('item', 'item.item_id = cart.item_id');
          $this->db->join('user', 'cart.user_id = user.user_id');
          $this->db->where('item.vendor_id',$id);
          $this->db->where('cart.date_time >', $curr_date ); 
          $this->db->order_by('cart.date_time', 'asc');
          $query = $this->db->get();
          return $query->result_array();
       }


       function getWalletHistory($id){
        //$curr_date = date('Y-m-d');
        $this->db->select("a.amount,a.wallet_id,a.trans_id,a.cart_id,a.pay_by,a.coupon_code,a.detail,a.date_time");
        $this->db->from('transaction as a');
        $this->db->join('user as b','a.user_id = b.user_id');
        $this->db->where('a.user_id',$id);
        //$this->db->where('cart.date_time <', $curr_date ); 
        $this->db->order_by('a.date_time', 'desc');
        $query = $this->db->get();
        return $query->result_array();
       }

       function getNotificationDetail($id){
        //$curr_date = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('notification');
        $this->db->where('user_id',$id);
        //$this->db->where('cart.date_time <', $curr_date ); 
        $this->db->order_by('not_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
       }

       
       function getCountryName(){
        $this->db->select("state.*,country.name");
        $this->db->from('state');
        $this->db->join('country', 'country.country_id = state.country_id');
        $query = $this->db->get();
        return $query->result_array();
       }

      function getStateName(){
        $this->db->select("city.*,state.state_name");
        $this->db->from('city');
        $this->db->join('state', 'state.state_id = city.state_id');
        $query = $this->db->get();
        return $query->result_array();
       }

       function getCityName(){
        $this->db->select("zone.*,city.city_name");
        $this->db->from('zone');
        $this->db->join('city', 'city.city_id = zone.city_id');
        $query = $this->db->get();
        return $query->result_array();
       }
       function getzoneName(){
        $this->db->select("subzone.*,zone.zone_name");
        $this->db->from('subzone');
        $this->db->join('zone', 'zone.zone_id = subzone.zone_id');
        $query = $this->db->get();
        return $query->result_array();
       }
       function getsubcatName(){
        $this->db->select("sub_cat.*,cat.cat_name");
        $this->db->from('sub_cat');
        $this->db->join('cat', 'cat.cat_id = sub_cat.cat_id');
        $this->db->order_by('sub_cat.position_order','ASC');
        $query = $this->db->get();
         //echo $this->db->last_query();exit();
        return $query->result_array();
       }
       function getitemName($number){
        $this->db->from('item');
        $this->db->join('sub_cat', 'sub_cat.sub_cat_id = item.sub_cat_id');
        $this->db->join('vendor', 'vendor.id = item.vendor_id');
        $this->db->limit(500, $number);
        $query = $this->db->get();
        return $query->result_array();
       }
       function getitemNameWhere($wheredata){
        $this->db->from('item');
        $this->db->join('sub_cat', 'sub_cat.sub_cat_id = item.sub_cat_id');
        $this->db->join('vendor', 'vendor.id = item.vendor_id');
        $this->db->where($wheredata);
        $query = $this->db->get();
        // echo $this->db->last_query();exit();
        return $query->result_array();
       }
       
       function getbannerName(){
        $this->db->select("banners.*,item.item_name,sub_cat.sub_cat_name");
        $this->db->from('banners');
        //$this->db->order_by('banner_id desc');
        $this->db->join('item', 'item.item_id = banners.item_id');
        $this->db->join('sub_cat','sub_cat.sub_cat_id = banners.sub_cat_id');
        $this->db->order_by('banners.position_order','ASC');
        $query = $this->db->get();
         //echo $this->db->last_query();exit();
        return $query->result_array();
       }
      function getpopitemName(){
        $this->db->select("popular_items.*,item.item_name");
        $this->db->from('popular_items');
        $this->db->join('item', 'item.item_id = popular_items.item_id');
        $this->db->order_by('popular_items.position_order','ASC');
        $query = $this->db->get();
         //echo $this->db->last_query();exit();
        return $query->result_array();
       }
        function getserviceName(){
         $this->db->select("service_provider.*,vendor.name,item.item_name");
         $this->db->order_by("service_id",'desc');
         $this->db->from('service_provider');
         $this->db->join('vendor', 'vendor.id = service_provider.vendor_id');
         $this->db->join('item', 'item.item_id = service_provider.provider_id');
         $query = $this->db->get();
          //echo $this->db->last_query();exit();
        return $query->result_array();
       }
      function getuserName(){
        $this->db->select("user.*,city.city_name");
        $this->db->from('user');
        $this->db->join('city', 'city.city_id = user.city_id');
        $query = $this->db->get();
         //echo $this->db->last_query();exit();
        return $query->result_array();
       }

      function getOrderIdbyCartId($cart_id){
        $query = $this->db->query("SELECT order_id, order_date from `order` where FIND_IN_SET('$cart_id', cart_id)");
        return $query->row();
      }
      
      function getOreder($vendor_id,$status){
        $query = $this->db->query("select c.cart_id, c.quanity, c.date_time, t.item_name, u.fname, u.lname from cart c inner join item t on c.item_id=t.item_id inner join user u on u.user_id=c.user_id where t.vendor_id='$vendor_id' and c.cart_status='$status'");
          return $query->result();
      }


      function joinCatSubCat(){
        $query = $this->db->query("select * from cat c inner join sub_cat sc on c.cat_id=sc.cat_id");
          return $query->result();
      }

  public function getallorder()
        {
             $this->db->select('*');
             $this->db->from('cart');
             $this->db->join('user', 'cart.user_id = user.user_id');
             $query = $this ->db-> get();
             return $query->result_array();
        }

        public function show_pro_profile($id)
        {
            $this->db->select('*');
            $this->db->from('vendor');
            $this->db->where('id',$id);
            $query = $this->db->get();
             return $query->result_array();
        }

      public function selectnotification($table,$wheredata){ 
        $this->db->select('*');
        $this->db->order_by('date_time', 'DESC');
        $this->db->from($table);
        $this->db->where($wheredata);
        $query = $this->db->get();
        return $query->result_array();
      }


  public function selectItem($table,$wheredata,$order=""){ 
        $this->db->select('*');
        $this->db->order_by($order);
        $this->db->from($table);
        $this->db->where($wheredata);
        $query = $this->db->get();
        return $query->result_array();
      }

    public function selectHistory($VanderIds)
      {
        $this->db->select('*');
        $this->db->order_by('wallet_id', 'DESC');
        $this->db->from('wallet_history');
        $this->db->where('vendor_id', $VanderIds);
        $query = $this->db->get();
        return $query->result_array();
      }  


    public function selectItem_boost($table)
    {     
       $this->db->select('*');
       $this->db->order_by('boost_datetime', 'DESC');
       $this->db->from($table);
       $query = $this->db->get();
       return $query->result_array();
    }  

    public function selectUserDetail($ids, $checkdate, $year="", $month="")
    {
        $this->db->select("a.*,SUM(a.quanity) as total_item_qty,b.*,c.*");
        $this->db->from('cart as a');
        $this->db->group_by('b.item_name');
        $this->db->join('item as b', 'a.item_id = b.item_id');
        $this->db->join('vendor as c', 'b.vendor_id = c.id');
        $this->db->where('a.user_id', $ids);
        $this->db->where('a.cart_status', '4');
        if($month!=""){

          $startdate = $year.'-'.$month.'-01';
          $enddate = $year.'-'.$month.'-31';
          $this->db->where('a.date_time BETWEEN "'. $startdate. '" and "'. $enddate.'"');
        }
        //$this->db->like('a.date_time', $this->db->escape($checkdate)); 
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        return $query->result();
    }


    public function selectuserdata($wheredata,$order="")
    { 
       $this->db->select('a.fname,a.lname,a.email,a.user_mobile,a.pincode,a.address,b.zone_name,c.subzone_name,d.city_name,s.state_name');
       $this->db->from('user as a');
       $this->db->join('zone as b', 'a.zone_id = b.zone_id');
       $this->db->join('subzone as c', 'a.subzone_id = c.subzone_id');
       $this->db->join('city as d', 'a.city_id = d.city_id');
       $this->db->join('state as s', 'a.state_id = s.state_id');
       $this->db->where('a.user_id', $wheredata);
       $this->db->order_by($order);
       $query = $this->db->get();  
       return $query->row();
    }

    public function selectWalletOrderBy($user_id){
      $query = $this->db->query("SELECT * from transaction where user_id='$user_id' order by trans_id desc");
      return $query->result();
    }

    public function selectWalletChecksum($wallet_id){
      $query = $this->db->query("SELECT * from wallet where wallet_id='$wallet_id' limit 1");
      return $query->row();
    }

    public function getUserDetailsData1($export_from, $export_to){
      $from_date = date('Y-m-d', strtotime($export_from));
      $to_date = date('Y-m-d', strtotime($export_to));
      
      $response = array();

      $this->db->select('b.item_name, SUM(a.quanity) as total, b.item_quantity_desc, c.name,a.date_time');
      $this->db->group_by('b.item_name');
      $this->db->from('cart as a');
      $this->db->join('item as b', 'a.item_id = b.item_id');
      $this->db->join('vendor as c', 'c.id = b.vendor_id');
      $this->db->where('a.cart_status', '1');
      $this->db->where('a.date_time BETWEEN "'. $from_date. '" and "'. $to_date.'"');
      $query = $this->db->get();
      $response = $query->result_array();
   
      return $response;
    }

    public function getUserDetailsData($export_from, $export_to,$vendor_id){
      $from_date = date('Y-m-d', strtotime($export_from));
      $to_date = date('Y-m-d', strtotime($export_to));
      
      $response = array();

      $this->db->select('b.item_name, SUM(a.quanity) as total, b.item_quantity_desc, c.name');
      $this->db->group_by('b.item_name');
      $this->db->from('cart as a');
      $this->db->join('item as b', 'a.item_id = b.item_id');
      $this->db->join('vendor as c', 'c.id = b.vendor_id');
      $this->db->where('a.cart_status', '1');
      $this->db->where('c.id', $vendor_id);
      $this->db->where('a.date_time BETWEEN "'. $from_date. '" and "'. $to_date.'"');
      $query = $this->db->get();
      $response = $query->result_array();
   
      return $response;
    }

    public function getSubZoneData(){
      
      $response = array();

      $this->db->select('*');
      $this->db->from('subzone');
      $query = $this->db->get();
      $response = $query->result_array();
   
      return $response;
    }

    public function getVendorData(){
      
      $response = array();

      $this->db->select('*');
      $this->db->from('vendor');
      $query = $this->db->get();
      $response = $query->result_array();
   
      return $response;
    }


    public function get_Delivery_Data1($export_from_delivery, $export_to_delivery){
      $export_from_delivery = date('Y-m-d', strtotime($export_from_delivery));
      $export_to_delivery = date('Y-m-d', strtotime($export_to_delivery));

      $response = array();

      $this->db->select('f.subzone_name, c.address, b.item_name, a.quanity, b.item_quantity_desc, c.fname, c.lname, d.zone_name, g.city_name, h.state_name');
      $this->db->from('cart as a');
      $this->db->join('item as b', 'a.item_id = b.item_id');
      $this->db->join('user as c', 'a.user_id = c.user_id');
      $this->db->join('zone as d', 'c.zone_id = d.zone_id');
      $this->db->join('subzone as f', 'c.subzone_id = f.subzone_id');
      $this->db->join('city as g', 'c.city_id = g.city_id');
      $this->db->join('state as h', 'c.state_id = h.state_id');
      $this->db->where('a.cart_status', '1');
      $this->db->where('a.date_time BETWEEN "'. $export_from_delivery. '" and "'. $export_to_delivery.'"');
      $this->db->order_by('f.subzone_id', 'ASC');
      $this->db->order_by('c.address', 'ASC');
      $query = $this->db->get();
      $response = $query->result_array();
   
      return $response;
    }




    public function get_Delivery_Data($export_from_delivery, $export_to_delivery,$subzone_id){
      $export_from_delivery = date('Y-m-d', strtotime($export_from_delivery));
      $export_to_delivery = date('Y-m-d', strtotime($export_to_delivery));

      $response = array();

      $this->db->select('f.subzone_name, c.address, b.item_name, a.quanity, b.item_quantity_desc, c.fname, c.lname, d.zone_name, g.city_name, h.state_name');
      $this->db->from('cart as a');
      $this->db->join('item as b', 'a.item_id = b.item_id');
      $this->db->join('user as c', 'a.user_id = c.user_id');
      $this->db->join('zone as d', 'c.zone_id = d.zone_id');
      $this->db->join('subzone as f', 'c.subzone_id = f.subzone_id');
      $this->db->join('city as g', 'c.city_id = g.city_id');
      $this->db->join('state as h', 'c.state_id = h.state_id');
      $this->db->where('a.cart_status', '1');
      $this->db->where('c.subzone_id', $subzone_id);
      $this->db->where('a.date_time BETWEEN "'. $export_from_delivery. '" and "'. $export_to_delivery.'"');
      $this->db->order_by('f.subzone_id', 'ASC');
      $this->db->order_by('c.address', 'ASC');
      $query = $this->db->get();
      $response = $query->result_array();
   
      return $response;
    }
 
    
    public function getSellerData($vendor_id, $month, $userId){
      // $this->db->select("*");
      // $this->db->from('item as i');
      // $this->db->join('cart as c', 'i.item_id = c.item_id');
      // $this->db->where('c.cart_status', '4');
      // $this->db->where('i.vendor_id', $vendor_id);
      // $this->db->order_by('c.date_time', 'ASC');
      // $query = $this->db->get();
      // return $query->result_array();


      // $from_date = '2018-08-20';
      // $to_date   = '2018-12-30';
      

      $this->db->select('b.item_name, b.delivery, SUM(a.quanity) as total, a.user_id, a.price, a.total_price, a.date_time, c.id, c.name');
      $this->db->group_by('b.item_name');
      $this->db->from('cart as a');
      $this->db->join('item as b', 'a.item_id = b.item_id');
      $this->db->join('vendor as c', 'c.id = b.vendor_id');
      $this->db->where('a.cart_status', '4');
      $this->db->where('a.user_id', $userId);
      $this->db->where('b.vendor_id', $vendor_id);
      $this->db->like('a.date_time', $month);
      //$this->db->where('a.date_time BETWEEN "'. $from_date. '" and "'. $to_date.'"');
      $query = $this->db->get();
      return $query->result_array();




    //   // $this->db->select("*");
    //   // $this->db->from('cart as c');
    //   // $this->db->join('item as i', 'c.item_id = i.item_id');
    //   // $this->db->join('vendor as v', 'i.vendor_id = v.id');
    //   // $this->db->where('c.cart_status', '4');
    //   // $query = $this->db->get();
    //   // return $query->result_array();
    //   $this->db->select("*");
    //   $this->db->from('vendor as v');
    //   $this->db->join('item as i', 'v.id = i.vendor_id');
    //   $this->db->join('cart as c', 'i.item_id = c.item_id');
    //   $this->db->where('c.cart_status', '4');
    //   $this->db->order_by('v.id', 'ASC');
    //   $query = $this->db->get();
    //   return $query->result_array();
      }




  public function getLastOrder($user_id)
  {      
     $this->db->select('*');
     $this->db->from('cart as c');
     $this->db->join('item as i', 'c.item_id = i.item_id');
     $this->db->where('user_id', $user_id);
     $this->db->order_by('date_time', 'DESC');
     $this->db->limit('1');
     $query = $this->db->get();
     return $query->result_array();
  }   


  public function getSellerItemDetails($month, $sellerId){
      $this->db->select('b.vendor_id,b.item_price,b.tax,b.item_id,b.item_name,b.item_discount,b.seller_packaging,b.seller_delivery,b.cgstin,b.sgstin,b.remark, b.delivery, SUM(a.quanity) as total');
      $this->db->group_by('b.item_name');
      $this->db->from('cart as a');
      $this->db->join('item as b', 'a.item_id = b.item_id');
      $this->db->where('a.cart_status', '4');
      $this->db->where('b.vendor_id', $sellerId);
      $this->db->like('a.date_time', $month);
      $query = $this->db->get();
      $response = $query->result_array();
      return $response;
  }



  public function vendorPastOrder($id){
      $curr_date = date('Y-m-d');
      $this->db->select("*");
      $this->db->from('cart');
      $this->db->join('item', 'item.item_id = cart.item_id');
      $this->db->where('item.vendor_id',$id);
      $this->db->where('cart.date_time <=', $curr_date ); 
      $this->db->order_by('cart.date_time', 'desc');
      $query = $this->db->get();
      return $query->result_array();
  }


  // public function userWithLastTransaction($user_id){
  //     $this->db->select("*");
  //     $this->db->from('user as u');
  //     $this->db->join('transaction as t', 't.user_id = u.user_id');
  //     $this->db->where('u.user_id',$user_id);
  //     $this->db->limit('u.user_id', '1');
  //     $this->db->order_by('u.user_id', 'asc');
  //     $query = $this->db->get();
  //     return $query->result_array();
  // }


}
?>