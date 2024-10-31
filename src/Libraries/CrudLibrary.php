<?php namespace Rorojongrang\Libraries;

/**
 * This library for making fast a CRUD in Codeigniter 4
 * Version 0.1
 */

use CodeIgniter\Model;

class CrudLibrary{

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