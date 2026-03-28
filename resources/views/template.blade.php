<!DOCTYPE html>
<html lang="en">


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Inventory & POS</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset("otika-assets/css/app.min.css")}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset("otika-assets/css/style.css")}}">
  <link rel="stylesheet" href="{{asset("otika-assets/css/components.css")}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset("otika-assets/css/custom.css")}}">
  <link rel='shortcut icon' type='image/x-icon' href='{{asset("otika-assets/img/favicon.ico")}}' />
  <style>
    .actions-cell {
    position: relative;
    padding-right: 80px; /* ruang aman */
    }

    .actions-space {
        position: relative;
        z-index: 1;
    }

    .actions-button {
      position: absolute;
      top: 50%;
      right: 8px;
      transform: translateY(-50%);
      display: flex;
      gap: 6px;

      opacity: 0;
      pointer-events: none;
      transition: all 0.25s ease;

      /* background: rgba(255, 255, 255, 0.55); */
      backdrop-filter: blur(6px);
      border-radius: 8px;
      padding: 4px 6px;
    }

    /* Muncul saat hover row */
    tr:hover .actions-button {
        opacity: 1;
        pointer-events: auto;
    }

    /* Tombol */
    .custom-btn-action {
        border: none;
        background: transparent;
        cursor: pointer;
        padding: 4px;
        border-radius: 6px;
        color: #555;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .custom-btn-action:hover {
        background: rgba(64, 36, 190, 0.08);
    }

    /* .custom-btn-action.detail:hover { color: #0d6efd; }
    .custom-btn-action.edit:hover   { color: #ffc107; }
    .custom-btn-action.delete:hover { color: #dc3545; } */
  </style>
  @yield('css')
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>

          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
              <span class="badge headerBadge1">
                6 </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="{{asset("otika-assets/img/users/user-1.png")}}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">John
                      Deo</span>
                    <span class="time messege-text">Please check your mail !!</span>
                    <span class="time">2 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{asset("otika-assets/img/users/user-2.png")}}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Request for leave
                      application</span>
                    <span class="time">5 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{asset("otika-assets/img/users/user-5.png")}}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob
                      Ryan</span> <span class="time messege-text">Your payment invoice is
                      generated.</span> <span class="time">12 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{asset("otika-assets/img/users/user-4.png")}}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Lina
                      Smith</span> <span class="time messege-text">hii John, I have upload
                      doc
                      related to task.</span> <span class="time">30
                      Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{asset("otika-assets/img/users/user-3.png")}}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa
                      Joshi</span> <span class="time messege-text">Please do as specify.
                      Let me
                      know if you have any query.</span> <span class="time">1
                      Days Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{asset("otika-assets/img/users/user-2.png")}}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Client Requirements</span>
                    <span class="time">2 Days Ago</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread"> <span
                    class="dropdown-item-icon bg-primary text-white"> <i class="fas
												fa-code"></i>
                  </span> <span class="dropdown-item-desc"> Template update is
                    available now! <span class="time">2 Min
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far
												fa-user"></i>
                  </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                      Sugiharto</b> are now friends <span class="time">10 Hours
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-success text-white"> <i
                      class="fas
												fa-check"></i>
                  </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                    moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                      Hours
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-danger text-white"> <i
                      class="fas fa-exclamation-triangle"></i>
                  </span> <span class="dropdown-item-desc"> Low disk space. Let's
                    clean it! <span class="time">17 Hours Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas
												fa-bell"></i>
                  </span> <span class="dropdown-item-desc"> Welcome to Otika
                    template! <span class="time">Yesterday</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{asset("otika-assets/img/user.png")}}"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello Sarah Smith</div>
              <a href="{{route("profile")}}" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profil
              </a> <a href="{{route("aktivitasakun")}}" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Aktifitas Akun
              </a> <a href="{{route("pengaturan")}}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Pengaturan
              </a>
              <div class="dropdown-divider"></div>
              <a href="auth-login.html" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Keluar
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{route("dashboard")}}"> <img alt="image" src="{{asset("otika-assets/img/logo.png")}}" class="header-logo" /> <span
                class="logo-name">InPOS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown {{ Route::is('dashboard') || Route::is('dashboard.*') ? 'active' : '' }}">
              <a href="{{route("dashboard")}}" class="nav-link"><i data-feather="codesandbox"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown {{ Route::is('penjualan') || Route::is('penjualan.*') ? 'active' : '' }}">
              <a href="{{route("penjualan.index")}}" class="nav-link"><i data-feather="shopping-cart"></i><span>Penjualan</span></a>
            </li>
            <li class="dropdown {{ Route::is('updatestok') || Route::is('updatestok.*') ? 'active' : '' }}">
              <a href="{{route("updatestok")}}" class="nav-link"><i data-feather="plus-square"></i><span>Update Stok ( + )</span></a>
            </li>
            <li class="dropdown {{ Route::is('marketplace') || Route::is('marketplace.*') ? 'active' : '' }}">
              <a href="{{route("marketplace")}}" class="nav-link"><i data-feather="shopping-bag"></i><span>Marketplace</span></a>
            </li>
            <li class="dropdown {{ Route::is('kondisiinventaris') || Route::is('kondisiinventaris.*') ? 'active' : '' }}">
              <a href="{{route("kondisiinventaris")}}" class="nav-link"><i data-feather="clipboard"></i><span>Kondisi Inventaris</span></a>
            </li>
            <li class="menu-header">Master Data</li>
            <li class="dropdown {{ Route::is('produk') || Route::is('produk.*') ? 'active' : '' }}">
              <a href="{{route("produk.index")}}" class="nav-link"><i data-feather="package"></i><span>Produk</span></a>
            </li>
            <li class="dropdown {{ Route::is('kategoriproduk') || Route::is('kategoriproduk.*') ? 'active' : '' }}">
              <a href="{{route("kategoriproduk.index")}}" class="nav-link"><i data-feather="tag"></i><span>Kategori Produk</span></a>
            </li>
            <li class="dropdown {{ Route::is('inventaris') || Route::is('inventaris.*') ? 'active' : '' }}">
              <a href="{{route("inventaris.index")}}" class="nav-link"><i data-feather="layers"></i><span>Inventaris Toko</span></a>
            </li>
            <li class="dropdown {{ Route::is('kategoriinv') || Route::is('kategoriinv.*') ? 'active' : '' }}">
              <a href="{{route("kategoriinv.index")}}" class="nav-link"><i data-feather="tag"></i><span>Kategori Inventaris</span></a>
            </li>
            <li class="menu-header">Laporan</li>
            <li class="dropdown {{ Route::is('lappenjualan') || Route::is('lappenjualan.*') ? 'active' : '' }}">
              <a href="{{route("lappenjualan")}}" class="nav-link"><i data-feather="bar-chart"></i><span>Penjualan</span></a>
            </li>
            <li class="dropdown {{ Route::is('lapbrgmasuk') || Route::is('lapbrgmasuk.*') ? 'active' : '' }}">
              <a href="{{route("lapbrgmasuk")}}" class="nav-link"><i data-feather="download"></i><span>Produk Masuk</span></a>
            </li>
            <li class="dropdown {{ Route::is('lapkondisiinv') || Route::is('lapkondisiinv.*') ? 'active' : '' }}">
              <a href="{{route("lapkondisiinv")}}" class="nav-link"><i data-feather="clipboard"></i><span>Kondisi Inventaris</span></a>
            </li>
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
            @yield('content')
          </div>
        </section>
        @yield('content2')
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          <a href="templateshub.net">Templateshub</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{asset("otika-assets/js/app.min.js")}}"></script>
  <script src="{{asset("otika-assets/bundles/jquery-ui/jquery-ui.min.js")}}"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="{{asset("otika-assets/js/scripts.js")}}"></script>
  <!-- Custom JS File -->
  @yield('javascript')
</body>


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>
