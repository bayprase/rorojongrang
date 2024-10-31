<?php namespace App\Controllers;

use Rorojongrang\Libraries\CrudLibrary;
use Rorojongrang\Libraries\TemplateDashboard;

date_default_timezone_set('Asia/Jakarta');
class {{templateName}} extends BaseController{

    protected $crud, $template;

    function __construct(){
        $this->crud = new CrudLibrary();
        $this->template = new TemplateDashboard();
    }

    function {{templateName}}(){
        $this->template->createDashboard(menus("{{templateName}}", [
            /* This is to read data in database dynamically, you can get all data or specified data. */
            'showData' => $this->crud->readData(model('M_Users')) 
        ]));
    }

}