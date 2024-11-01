<!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="<?= base_url('admin') ?>" class="text-nowrap logo-img">
            <img src="<?= $images['logo'][0] ?>" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Menu</span>
            </li>
            <?php for($i = 0; $i <= count($aside); $i++): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= $aside['links'][$i] ?>" aria-expanded="false">
                <span>
                  <i class="<?= $aside['icons'][$i] ?>"></i>
                </span>
                <span class="hide-menu"><?= $aside['menu'][$i] ?></span>
              </a>
            </li>
            <?php endfor ?>
          </ul>
        </nav>
      </div>
    </aside>