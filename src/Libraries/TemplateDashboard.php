<?php namespace Rorojongrang\Libraries;

use App\Controllers\BaseController;

class TemplateDashboard extends BaseController{

	public function createDashboard($data){
		echo view('..\..\vendor\rorojongrang\bayu-prasetyo\src\Views\templates\head');
		echo view('..\..\vendor\rorojongrang\bayu-prasetyo\src\Views\templates\aside', $data);
		echo view('..\..\vendor\rorojongrang\bayu-prasetyo\src\Views\templates\header', $data);
		echo view('..\..\vendor\rorojongrang\bayu-prasetyo\src\Views\contents', $data);
		echo view('..\..\vendor\rorojongrang\bayu-prasetyo\src\Views\templates\footer');
	}

}