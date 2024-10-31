<?= session()->getFlashdata("validation") ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 d-flex align-items-stretch">
			<div class="card w-100">
				<div class="card-body p-4">
					<div class="mb-4 d-flex justify-content-between">
						<h5 class="card-title fw-semibold">Add User</h5>
						<span class="badge bg-primary fw-semibold" id="tambahPengguna">Clear</span>
					</div>
					<div class="mb-4">
						<p class="text-muted">*Note: Kosongkan foto jika tidak akan merubah foto produk</p>
						<hr>
					</div>
					<form action="<?= base_url('admin/addProducts') ?>" method="post" id="form" enctype="multipart/form-data">
						<input type="text" name="fullname" class="form-control" id="fullname" readonly hidden>
						<label class="mb-2" for="fullname">Fullname</label>
						<input type="text" id="fullname" name="fullname" class="form-control mb-3" placeholder="Fullname" required>

						<label class="mb-2" for="entryCode">Entry Code</label>
						<input type="text" id="entryCode" name="entryCode" class="form-control mb-3" placeholder="Entry Code" required>

						<label class="mb-2" for="division">Division</label>
						<input type="text" id="division" name="division" class="form-control mb-3" placeholder="Division" required>


						<button class="btn btn-success w-100" id="btnTrigger">Add User</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-8 d-flex align-items-stretch">
			<div class="card w-100">
				<div class="card-body p-4">
					<h5 class="card-title fw-semibold mb-4">List Data Users</h5>
					<div class="table-responsive">
						<table class="table text-nowrap mb-0 align-middle">
							<thead class="text-dark fs-4">
								<tr>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">No</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Fullname</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Entry Code</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Division</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Action</h6>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($showData as $indexing => $item){ ?>
								<tr>
									<td class="border-bottom-0 align-middle"><h6 class="fw-semibold mb-0"><?= $indexing+1 ?></h6></td>
									<td class="border-bottom-0 align-middle">
										<h5 class="fw-bolder mb-1"><?= $item['fullname'] ?></h5>
									</td>
									<td class="border-bottom-0 align-middle">
										<h6 class="badge bg-success fw-normal mb-1"><?= $item['entryCode'] ?></h6>
									</td>
									<td class="border-bottom-0 align-middle">
										<div class="d-flex align-items-center gap-2">
											<span class="mb-0 fw-normal"><?= $item['division'] ?></span>
										</div>
									</td>
									<td class="border-bottom-0 align-middle">
										<button type="button" class="btn btn-sm btn-warning" id="ubahData" data-id_products="/*id_product*/" data-fullname="/*product_name*/" data-price_product="/*price*/" data-category="/*Category*/" data-stok="/*Stock_Product*/">Ubah</button>
										<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus/*id_product*/">Hapus</button>
									</td>
								</tr>
								<div class="modal fade" id="modalHapus/*id_product*/" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Confirm your deleted data users</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<h3>Yakin ingin menghapus <b>/*PRODUCT NAME*/</b> ?</h3>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
												<a href="<?= base_url('admin/deleteProducts/'/*.ID_PRODUCT*/) ?>" type="button" class="btn btn-danger">Ya, Hapus!</a>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>                      
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	let ubahData = document.querySelectorAll("#ubahData")
	
	document.querySelector("#file").onchange = e => {
		const [file] = document.querySelector("#file").files
		if(file){
			document.querySelector("#previewImg").removeAttribute("hidden")
			document.querySelector("#previewImg").src = URL.createObjectURL(file)
		}
	}

	document.querySelector("#tambahPengguna").addEventListener('click', () => {
		document.querySelector("#fullname").value = ""
		document.querySelector("#entryCode").value = ""
		document.querySelector("#division").value = ""
		// document.querySelector("#selectCat").value = "makanan"
		// document.querySelector("#stok").value = ""
		document.querySelector("#form").action = "<?= base_url('admin/addProducts') ?>"
		document.querySelector("#btnTrigger").innerHTML = "Add User"
		document.querySelector("#btnTrigger").setAttribute("class", "btn btn-success w-100")
		// document.querySelector("#file").setAttribute("required", "true")
	})

	ubahData.forEach(n => {
		n.addEventListener('click', () => {
			// document.querySelector("#id_product").value = n.getAttribute("data-id_products")
			document.querySelector("#fullname").value = n.getAttribute("data-fullname")
			document.querySelector("#entryCode").value = n.getAttribute("data-entryCode")
			document.querySelector("#division").value = n.getAttribute("data-division")
			// document.querySelector("#stok").value = n.getAttribute("data-stok")
			document.querySelector("#form").action = "<?= base_url('admin/editProducts') ?>"
			document.querySelector("#btnTrigger").innerHTML = "Edit User"
			document.querySelector("#btnTrigger").setAttribute("class", "btn btn-warning w-100")
			// document.querySelector("#file").removeAttribute("required")
		})
	})
</script>