<?php namespace Rorojongrang\Libraries;

/**
 * This library for making fast a CRUD in Codeigniter 4
 * Version 0.1
 */

use CodeIgniter\Model;

class CrudLibrary{

	public function validateData(array $data = []){
		if(!empty($data)){
			foreach($data as $index => $item){
				$datas[$item] = [
					'label' => ucfirst($item),
					'rules' => "required|"
							   .(($item == "password" ? 'min_length[8]|' : ""))
							   .(($item == "password_verify" ? 'matches[password]|' : ""))
							   .(($item == "email" ? 'is_unique[users.email]|' : ""))
							   .(($item == "username" ? 'is_unique[users.username]|' : ""))
							   .(($item == "gender" || $item == "jk" || $item == "category" || $item == "status" || $item == "role" ? 'not_in_list[null]|' : ""))
				];
			}
		}

		return $datas;
	}

	public function readData($model, $id = null){
		if($id === null){
			return $model->findAll();
		}
		return $model->first($id);
	}

	public function joinTable(model $model, array $data){

		$query = $model->select("*,".$data[0]['table'].'.created_at as created_at, '.$data[0]['table'].'.updated_at as updated_at, '.$data[0]['table'].'.status as status');

		for($i = 0; $i < count($data[1]); $i++){
			for($j = 0; $j < count($data[1]['tableJoin']); $j++){
				for($k = 0; $k < count($data[1]['condition']); $k++){
					$query->join($data[1]['tableJoin']['join'.$i], $data[1]['condition']['on_condition_'.$i]);
					break;
				}
				break;
			}
		}
      	
      	return $query->orderBy($data[0]['table'].".created_at DESC")->findAll();
	}
}