<?php 

if (!function_exists("menus")) {
	function menus($file_dir, $contents){
		$menu = [
			'images' => [
				'logo' => [
					base_url().'/assets/Rorojongrang/template_admin/images/logos/dark-logo.svg' // place your logo in here
				],
				'profile' => [
					base_url().'/assets/Rorojongrang/template_admin/images/profile/user-1.jpg' // place your profile in index 0 to set a profile header
				]
			],
			'aside' => [
				'menu' => [
	                "Dashboard",
	                "Data Inventory",
	                "Data Users",
	                "Logout"
	            ],
	            'links' => [
	                base_url("dashboard/administrator"),
	                base_url("dashboard/administrator/inventory"),
	                base_url("dashboard/administrator/users"),
	                base_url("auth/logout"),
	            ],
	            'icons' => [
	                "ti ti-layout-dashboard",
	                "ti ti-garden-cart",
	                "ti ti-users",
	                "ti ti-logout",
	            ],
			],

			'header' => [
				'menu' => [
	                "My Profile",
	                "My Task",
	            ],
	            'links' => [
	                base_url("dashboard/administrator"),
	                base_url("dashboard/dataProduct"),
	            ],
	            'icons' => [
	                "ti ti-user fs-6",
	                "ti ti-list-check fs-6",
	            ],
			],

			'content' => [
				'content' => view($file_dir, $contents)
			]
		];

		return $menu;
	}
}

if(!function_exists("alert_success")){
	function alert_success($content){
		session()->setFlashdata("message_success", $content);
	}
}

if(!function_exists("alert_failed")){
	function alert_failed($content){
		session()->setFlashdata("message_failed", $content, 1);
	}
}

if(!function_exists("alert_warning")){
	function alert_warning($content){
		session()->setFlashdata("message_warning", $content);
	}
}