<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', '{{templateName}}::{{templateName}}');

// You can custom this script 
$routes->group('dashboard', function($routes){
	$routes->get("administrator", "{{templateName}}::{{templateName}}");
	$routes->get("administrator/inventory", "{{templateName}}::inventory");
	$routes->get("administrator/users", "{{templateName}}::users");
	$routes->get("administrator/deleteInventory/(:any)", "{{templateName}}::addInventory/$1");
	$routes->post("administrator/addInventory", "{{templateName}}::addInventory");
	$routes->post("administrator/editInventory", "{{templateName}}::addInventory");
});

// Do not delete this script below!!!
$routes->get('bayu-prasetyo/(:any)', function($path) {
    $file = FCPATH . '../vendor/bayu-prasetyo/public/' . $path;
    if (is_file($file)) {
        header('Content-Type: ' . mime_content_type($file));
        readfile($file);
        exit;
    }
    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
});
