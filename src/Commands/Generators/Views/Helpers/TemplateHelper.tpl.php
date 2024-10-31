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

if(!function_exists("alerts_error")){
	function alerts_error($error){
		$message = "
				<div class='modal fade' id='myModal' tabindex='-1' aria-labelledby='myModalLabel' aria-hidden='true'>
				  <div class='modal-dialog'>
				    <div class='modal-content' style='border: 2px solid red'>
				      <div class='modal-header'>
				        <h3 class='modal-title' id='myModalLabel' style='color: red'>Whoops!!</h3>
				        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
				        <hr>
				      </div>
				      <div class='modal-body'>
					      <table>
					      	<tr>
					      		<th>
					      			<h5 style='text-align: justify'>Double check each field whether there is data or not.</h5>
					      		</th>
					      	</tr>
					      	<tr>
					      		<td style='color: red'>Data not filled in:</td>
					      	</tr>
					      	<tr>
					      		<td style='text-indent: .5rem; color: orange'>".$error."</td>
					      	</tr>
					      </table>
				      </div>
				      <div class='modal-footer'>
				        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
				      </div>
				    </div>
				  </div>
				</div>
				<script>
				    document.addEventListener('DOMContentLoaded', function () {
				        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
				            keyboard: false
				        });
				        myModal.show();
				    });
				</script>
			";
		session()->setFlashdata("validation", $message, 300);
	}
}

if(!function_exists("alerts_success")){
	function alerts_success($msg){
		$message = "
				<div class='modal fade' id='myModal' tabindex='-1' aria-labelledby='myModalLabel' aria-hidden='true'>
				  <div class='modal-dialog'>
				    <div class='modal-content' style='border: 2px solid lightgreen'>
				      <div class='modal-header'>
				        <h3 class='modal-title' id='myModalLabel' style='color: lightgreen'>Hoorayy!!</h3>
				        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
				        <hr>
				      </div>
				      <div class='modal-body'>
					      <table>
					      	<tr>
					      		<th>
					      			<h5 style='text-align: justify'>".$msg."</h5>
					      		</th>
					      	</tr>
					      </table>
				      </div>
				      <div class='modal-footer'>
				        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
				      </div>
				    </div>
				  </div>
				</div>
				<script>
				    document.addEventListener('DOMContentLoaded', function () {
				        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
				            keyboard: false
				        });
				        myModal.show();
				    });
				</script>
			";
		session()->setFlashdata("validation", $message, 300);
	}
}