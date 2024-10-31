<?= session()->getFlashdata("validation") ?>
<div class="row">
  <div class="col-lg-4 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <div class="mb-4">
          <h5 class="card-title fw-semibold">History Submission</h5>
        </div>
        <ul class="timeline-widget mb-0 position-relative mb-n5">
          <?php foreach($showTableJoin as $i => $iex): ?>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end"><?= date("Y-m-d H:i", strtotime($iex['created_at'])) ?></div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark fw-semibold">
                <a href="javascript:void(0)" class="text-primary">
                  <?= $iex['brand'] ?> - <?= $iex['type'] ?>
                  <br>
                  <span class="fw-normal"><?= $iex['assignee'] ?></span>    
                </a>
              </div>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-8 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <h5 class="card-title fw-semibold">Data Table Inventory</h5>
        <div class="table-responsive">
          <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
              <tr>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">No</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Inventory</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Name</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Assignee</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Division</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Description</h6>
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
              <?php foreach($showTableJoin as $i => $iex): ?>
              <tr>
                <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                <td class="border-bottom-0">
                  <h6 class="fw-semibold mb-1"><?= $iex['brand'] ?></h6>
                  <span class="fw-normal"><?= $iex['type'] ?></span>                          
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $iex['fullname'] ?></p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $iex['assignee'] ?></p>
                </td>
                <td class="border-bottom-0">
                  <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary rounded-3 fw-semibold"><?= $iex['division'] ?></span>
                  </div>
                </td>
                <td class="border-bottom-0">
                  <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-danger rounded-3 fw-semibold"><?= $iex['status'] ?></span>
                  </div>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal"><?= $iex['descriptions'] ?></p>
                </td>
                <td class="border-bottom-0">
                  <h6 class="fw-semibold mb-0 fs-4">
                    <a href="#!" class="btn btn-sm btn-warning">Edit</a>
                    <a href="#!" class="btn btn-sm btn-danger">Delete</a>
                  </h6>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <h5 class="fw-semibold mb-4">Data Inventory</h5>
  </div>
      <?php foreach($showDataInventory as $index => $item): ?>
          <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <a href="javascript:void(0)"><img src="<?= base_url('assets/imageInventory/'.$item['image']) ?>" class="card-img-top p-4 rounded-0" alt="Image Inventory"></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>                      </div>
                <div class="card-body pt-3 p-4">
                  <h6 class="fw-semibold fs-4"><?= $item['brand'] ?> - <?= $item['type'] ?></h6>
                  <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-normal fs-2 mb-0 w-100">Initial Stock: <?= $item['stock'] ?>
                      <br>
                      <?php foreach($showTableJoin as $idx => $val): ?>
                        <?php if($val['id_inventory'] == $item['id_inventory']): ?>
                          <span class="fw-normal text-muted fs-2">
                            Borrower: <del><?= $val['a_lot'] ?></del>
                          </span>
                          <br>
                          <hr class="w-100">
                          <span class="fw-semibold mt-3 fs-4">Stockpile: <?= $item['stock'] - $val['a_lot'] ?></span>
                        <?php endif ?>
                      <?php endforeach; ?>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
      
    <?php endforeach; ?>
  </div>
</div>