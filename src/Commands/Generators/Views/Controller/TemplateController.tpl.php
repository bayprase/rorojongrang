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

    public function {{templateName}}(){
        $this->template->createDashboard(menus("{{templateName}}", [
            'showDataUsers'     => $this->crud->readData(model('M_Users')),
            'showDataInventory' => $this->crud->readData(model('M_Inventory')),
            'showTableJoin'     => $this->crud->joinTable(
                model("M_Distribution"),
                [
                    /* You can use dynamic join tables with rules like this */
                    ['table' => 'distribution',],
                    [
                        'tableJoin' => [
                            'join0' => 'inventory',
                            'join1' => 'users',
                        ],

                        'condition' => [
                            'on_condition_0' => 'inventory.id_inventory = distribution.id_inventory',
                            'on_condition_1' => 'users.id_users = distribution.id_users'
                        ]
                    ]
                ],
            )
        ]));
    }

    function users(){
        $this->template->createDashboard(menus("users", [
            /* This is to read data in database dynamically, you can get all data or specified data. */
            'showData' => $this->crud->readData(model('M_Users')) 
        ]));
    }

    function inventory(){
        $this->template->createDashboard(menus("inventory", [
            'showData' => $this->crud->readData(model('M_Inventory')),
        ]));
    }

    function addInventory(){
        if(!$this->validate($this->crud->validateData(['type', 'brand', 'stock', 'status']))){
            return redirect()->to(base_url('dashboard/administrator/inventory', alerts_error(\Config\Services::validation()->listErrors()))); 
        }else{
            $file = $this->request->getFile("file");

            if($file->getSize() != 0){
                $newName = $file->getRandomName();
                $file->move(ROOTPATH.'/public/assets/imageInventory/', $newName);

                $data = [
                    'type' => $this->request->getVar('type'),
                    'brand' => $this->request->getVar('brand'),
                    'image' => $newName,
                    'stock' => $this->request->getVar('stock'),
                    'status' => $this->request->getVar('status'),
                    'created_at' => date("Y-m-d H-i-s"),
                    'updated_at' => date("Y-m-d H-i-s"),
                ];

                if(model("M_Inventory")->insert($data)){
                    return redirect()->to(base_url('dashboard/administrator/inventory', alerts_success("Data has been added.")));
                }else{
                    return redirect()->to(base_url('dashboard/administrator/inventory', alerts_error("Something wen't wrong.")));
                }
            }else{
                return redirect()->to(base_url('dashboard/administrator/inventory', alerts_error("Something wen't wrong.")));
            }
        }
    }

}