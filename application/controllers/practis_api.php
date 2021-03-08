<?php
    header('Access-Control-Allow-Headers: Content-Type'); // and this!
	//more code here
	defined('BASEPATH') OR exit('No direct script access allowed');

	class practis_api extends CI_Controler{
		public function_constrocter(){
		public::__construct();
		}
		pueblic function catAndSubCat(){
		$result=$this->Model->select('cat');
		if($result) {
			foreach ($result as $key){
				$catID=$key['cat_id'];
				$wheredata=array(
					"cat_id"=$catID
				)
				$data=array();
				$subCatResult=$this->Model->selectdata('sub_cat',$wheredata);
				if($subCatResult){
					foreach ($subCatResult as $value) {
						$data[]=array(
							"$subCategoryId"   =>$value['sub_cat_id'],
							"$subCategoryName" =>$value['sub_cat_name'],
							"$subCatIcon"       =>'http://jokingfriend.com/DailyWale/uploads/user/'.$value['icon']
						);
					}

					$catdata[]=array(
						"$categoryId"=>$catId,
						"categoryName"=>$key['cat_name'],
						"categoryIcon"=>'http://jokingfriend.com/DailyWale/uploads/user/'.$key['icon'],
						"subCategoryData"=> $data
					);
				}else{
					$catdata[]=$array(
						"categoryId"=>$catId,
						"categoryName"=>$key['cat_name'],
						"categoryIcon"    => 'http://jokingfriend.com/DailyWale/uploads/user/'.$key['icon'],
						"subCategoryData"=>"No data"
					);
				}
				$data_result['result']='true';
				$data_result['CatSubCat']=$catdata;
				$data_reslt['msg']='category show successully';
				}
			}else{
				$data_result['result'] = 'false';
				$data_result['msg']    = 'category not available!';
			}
			echo json_encode($data_result);
		}


		}





	}
 ?>