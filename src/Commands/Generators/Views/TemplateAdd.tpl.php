<?= session()->getFlashdata("validation") ?>
<?php 
                if(session()->getFlashdata("message_failed")){
                    echo '<div class="alert alert-danger w-100 pt-4">'.session()->getFlashdata("message_failed") .'</div>';
                }else if(session()->getFlashdata("message_success")){
                    echo '<div class="alert alert-success w-100 pt-3">'.session()->getFlashdata("message_success").'</div>';
                }else if(session()->getFlashdata("message_warning")){
                    echo '<div class="alert alert-warning w-100 pt-3">'.session()->getFlashdata("message_warning").'</div>';
                }
                
            ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 d-flex align-items-stretch">
			<div class="card w-100">
				<div class="card-body p-4">
					<div class="mb-4 d-flex justify-content-between">
						<h5 class="card-title fw-semibold">Add Data Inventory</h5>
						<span class="badge bg-primary fw-semibold" id="tambahPengguna">Clear</span>
					</div>
					<div class="mb-4">
						<p class="text-muted">*Note: Kosongkan foto jika tidak akan merubah foto produk</p>
						<hr>
					</div>
					<form action="<?= base_url('dashboard/administrator/addInventory') ?>" method="post" id="form" enctype="multipart/form-data">
						<input type="text" id="inventory" name="id_inventory" hidden>

						<label class="mb-2" for="type">Type</label>
						<input type="text" id="type" name="type" class="form-control mb-3" placeholder="Type" required>

						<label class="mb-2" for="brand">Brand</label>
						<input type="text" id="brand" name="brand" class="form-control mb-3" placeholder="Brand" required>

						<label class="mb-2" for="stock">Stock</label>
						<input type="text" id="stock" name="stock" class="form-control mb-3" placeholder="Stock" required>

						<label class="mb-2" for="file">Product Photo</label>
						<input type="file" id="file" name="file" class="form-control mb-3" placeholder="file" required>
						<img src="" alt="img products" id="previewImg" class="w-100 mb-3 rounded border border-4 border-info" hidden>

						<label class="mb-2" for="status">Status</label>
						<select class="form-select mb-3" id="status" name="status">
							<option value="makanan">Makanan</option>
							<option value="minuman">Minuman</option>
						</select>

						<button class="btn btn-success w-100" id="btnTrigger">Add Data Inventory</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-8 d-flex align-items-stretch">
			<div class="card w-100">
				<div class="card-body p-4">
					<h5 class="card-title fw-semibold mb-4">List Data Inventory</h5>
					<div class="table-responsive">
						<table class="table text-nowrap mb-0 align-middle">
							<thead class="text-dark fs-4">
								<tr>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">No</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Type</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Brand</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Stock</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Image</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Status</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Action</h6>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($showData as $indexing => $product){ ?>
								<tr>
									<td class="border-bottom-0 align-middle"><h6 class="fw-semibold mb-0"><?= $indexing+1 ?></h6></td>
									<td class="border-bottom-0 align-middle">
										<h5 class="fw-bolder mb-1"><?= $product['type'] ?></h5>
									</td>
									<td class="border-bottom-0 align-middle">
										<h6 class="fw-normal mb-1"><?= $product['brand'] ?></h6>
									</td>
									<td class="border-bottom-0 align-middle">
										<div class="d-flex align-items-center gap-2">
											<span class="mb-0 fw-normal"><?= $product['stock'] ?></span>
										</div>
									</td>
									<td class="border-bottom-0 align-middle">
										<div class="d-flex align-items-center gap-2">
											<img src="<?= base_url('assets/imageInventory/'.$product['image']) ?>" class="m-0 img-fluid" alt="Image Product">
										</div>
									</td>
									<td class="border-bottom-0 align-middle">
										<div class="d-flex align-items-center gap-2">
											<span class="mb-0 fw-normal"><?= $product['status'] ?></span>
										</div>
									</td>
									<td class="border-bottom-0 align-middle">
										<button type="button" class="btn btn-sm btn-warning" id="ubahData" data-id_inventory="<?= $product['id_inventory'] ?>" data-type="<?= $product['type'] ?>" data-brand="<?= $product['brand'] ?>" data-stock="<?= $product['stock'] ?>" data-status="<?= $product['status'] ?>">Ubah</button>
										<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $product['id_inventory'] ?>">Hapus</button>
									</td>
								</tr>
								<div class="modal fade" id="modalHapus<?= $product['id_inventory'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Confirm your deleted data inventory</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<h3>Yakin ingin menghapus <b><?= $product['type'] ?> - <?= $product['brand'] ?></b> ?</h3>
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
		document.querySelector("#inventory").value = ""
		document.querySelector("#type").value = ""
		document.querySelector("#brand").value = ""
		document.querySelector("#stock").value = ""
		document.querySelector("#status").value = "makanan"
		document.querySelector("#form").action = "<?= base_url('dashboard/administrator/addInventory') ?>"
		document.querySelector("#btnTrigger").innerHTML = "Add User"
		document.querySelector("#btnTrigger").setAttribute("class", "btn btn-success w-100")
	})

	ubahData.forEach(n => {
		n.addEventListener('click', () => {
			document.querySelector("#inventory").value = n.getAttribute("data-id_inventory")
			document.querySelector("#type").value = n.getAttribute("data-type")
			document.querySelector("#brand").value = n.getAttribute("data-brand")
			document.querySelector("#stock").value = n.getAttribute("data-stock")
			document.querySelector("#status").value = n.getAttribute("data-status")
			document.querySelector("#form").action = "<?= base_url('dashboard/administrator/editInventory') ?>"
			document.querySelector("#btnTrigger").innerHTML = "Edit User"
			document.querySelector("#btnTrigger").setAttribute("class", "btn btn-warning w-100")
		})
	})
</script>