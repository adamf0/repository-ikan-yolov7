<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content='Klasifikasi Ikan; Kecerdasan Buatan; AI; Image Processing; Object Detection; Ikan Laut dan Ikan Tawar; Perairan Indonesia;' name='Keywords' />
  <meta content='Situs klasifikasi ikan berbasis kecerdasan buatan ini memudahkan Anda mengenali semua ikan laut dan tawar di perairan Indonesia.' name='deskripsi' />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" /> -->
  <title>Fishiden</title>
  <link href="{{ \App\Helper\Utility::loadAsset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ \App\Helper\Utility::loadAsset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ \App\Helper\Utility::loadAsset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
  <link rel="stylesheet" href="{{ \App\Helper\Utility::loadAsset('assets/css/yearpicker.css') }}" />
  <link rel="stylesheet" href="{{ \App\Helper\Utility::loadAsset('assets/css/datepicker.css') }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <style>
    .offset-x {
      margin-left: 3.33333333%;
      margin-top: 1%;
    }

    .select2-container {
      width: 100% !important;
    }
  </style>
  <style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 0 !important;
    }

    .dataTables_wrapper .dataTables_filter {
      margin-right: 0.8em !important
    }

    table.dataTable {
      width: 100% !important;
    }

    .input-disabled {
      background-color: #e9ecef;
      opacity: 1;
    }

    .input-disabled:focus {
      color: #212529;
      background-color: #e9ecef;
      opacity: 1;
      border-color: #ced4da;
      outline: 0;
      box-shadow: 0 0 0 0.25rem transparent;
    }

    .circle-tab-container {
      display: flex;
      align-items: center;
    }

    .circle-tab-container-box {
      display: flex;
      align-items: center;
      flex-direction: column;
    }

    .circle-tab {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      text-align: center;
      padding-top: 8px;
      margin-right: 10px;
      font-weight: bold;
      border: 2px solid #ccc;
      background-color: #fff;
      color: #000;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .circle-tab,
    .step-label {
      display: block;
      text-align: center;
      font-size: 12px;
    }

    .circle-tab.active {
      background-color: #007bff;
      color: #fff;
      border-color: #007bff;
    }

    .line {
      flex: 1;
      border-top: 2px solid #ccc;
    }

    .btn-draf {
      --bs-btn-color: #000;
      --bs-btn-bg: white;
      --bs-btn-border-color: #000;
      --bs-btn-hover-color: #000;
      --bs-btn-hover-bg: white;
      --bs-btn-hover-border-color: white;
      --bs-btn-focus-shadow-rgb: 130, 138, 145;
      --bs-btn-active-color: #000;
      --bs-btn-active-bg: white;
      --bs-btn-active-border-color: #000;
      --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
      --bs-btn-disabled-color: #fff;
      --bs-btn-disabled-bg: white;
      --bs-btn-disabled-border-color: white;
    }
  </style>
</head>

<body>
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('dashboard.index')}}" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Fishiden</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <!-- <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li> -->
        <!-- <x-top-nav-menu-dropdown></x-top-nav-menu-dropdown> -->
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ \App\Helper\Utility::loadAsset('img/logo.svg') }}" alt="" />
            <span class="d-none d-md-block dropdown-toggle ps-2">{{\App\Helper\Utility::getName()}}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{\App\Helper\Utility::getName()}}</h6>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('profile.index')}}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
              </a>
            </li>
            {{-- <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li> --}}
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('login.logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <x-sidebar-item-menu title="Dashboard" icon="bi bi-menu-button-wide" link="{{route('dashboard.index')}}" :active="\App\Helper\Utility::stateMenu(['dashboard'],request())" />
      @if (\App\Helper\Utility::hasAdmin())
      <x-sidebar-item-menu title="Katalog Ikan" icon="bi bi-menu-button-wide" link="{{route('katalog_ikan.index')}}" :active="\App\Helper\Utility::stateMenu(['katalog_ikan'],request())" />
      @else
      <x-sidebar-item-menu title="Project" icon="bi bi-menu-button-wide" link="{{route('project.index')}}" :active="\App\Helper\Utility::stateMenu(['project'],request())" />
      @endif
      <!-- <li class="nav-heading">Form Pengajuan</li> -->
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    @yield('page-title')
    <section class="section dashboard">
      @yield('content')
    </section>
  </main>

  <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.0.0/index.global.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.45/moment-timezone-with-data.min.js"></script>

  <script src="{{ \App\Helper\Utility::loadAsset('assets/js/main.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="{{ \App\Helper\Utility::loadAsset('assets/js/yearpicker.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script type="text/javascript" src="{{ \App\Helper\Utility::loadAsset('jquery.redirect.js') }}"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
  @stack('scripts')
  <script>
    $(".yearpicker").yearpicker();
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlidht: true,
      orientation: 'top'
    }).on('show', function(e) {
      // Mengatur posisi popover Datepicker ke center (middle).
      var $input = $(e.currentTarget);
      var $datepicker = $input.data('datepicker').picker;
      var $parent = $input.parent();
      var top = ($parent.offset().top - $datepicker.outerHeight()) + $parent.outerHeight();
      $datepicker.css({
        top: top,
        left: $parent.offset().left
      });
    });

    $('.datepicker-bottom').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlidht: true,
      orientation: 'bottom'
    }).on('show', function(e) {
      // Mengatur posisi popover Datepicker ke center (middle).
      var $input = $(e.currentTarget);
      var $datepicker = $input.data('datepicker').picker;
      var $parent = $input.parent();
      var bottom = ($parent.offset().bottom - $datepicker.outerHeight()) + $parent.outerHeight();
      $datepicker.css({
        bottom: bottom,
        left: $parent.offset().left
      });
    });
  </script>
  <script>
    function getCountry() {
      const language = navigator.language || navigator.userLanguage;
      if (language.includes('id')) {
        return 'Indonesia';
      } else {
        return 'Other';
      }
    }

    function setMetaTags() {
      const country = getCountry();

      let keywords = '';
      let description = '';

      if (country === 'Indonesia') {
        keywords = 'Klasifikasi Ikan; Kecerdasan Buatan; AI; Image Processing; Object Detection; Ikan Laut dan Ikan Tawar; Perairan Indonesia;';
        description = 'Situs klasifikasi ikan berbasis kecerdasan buatan ini memudahkan Anda mengenali semua ikan laut dan tawar di perairan Indonesia.';
      } else {
        keywords = 'Fish classification; Artificial intelligence; AI; Image Processing; Object Detection; Sea Fish and Freshwater Fish;';
        description = 'This AI-based fish classification site makes it easy for you to recognize all sea and freshwater fish.';
      }

      const keywordsMeta = document.createElement('meta');
      keywordsMeta.name = 'Keywords';
      keywordsMeta.content = keywords;
      document.head.appendChild(keywordsMeta);

      const descriptionMeta = document.createElement('meta');
      descriptionMeta.name = 'description';
      descriptionMeta.content = description;
      document.head.appendChild(descriptionMeta);
    }

    // Panggil fungsi untuk mengatur meta tag setelah halaman dimuat
    document.addEventListener('DOMContentLoaded', setMetaTags);
  </script>
</body>

</html>