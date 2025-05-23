    <!-- Favicon icon-->
    <link rel="icon" href="<?= base_url(); ?>/public/Backend-Assets/images/favicon.png" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?= base_url(); ?>/public/Backend-Assets/images/favicon.png" type="image/x-icon"/>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin=""/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;display=swap" rel="stylesheet"/>
    <!-- Flag icon css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/vendors/flag-icon.css"/>
    <!-- iconly-icon-->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/iconly-icon.css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/bulk-style.css"/>
    <!-- iconly-icon-->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/themify.css"/>
    <!--fontawesome-->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/fontawesome-min.css"/>
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/public/Backend-Assets/css/vendors/weather-icons/weather-icons.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/public/Backend-Assets/css/vendors/scrollbar.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/public/Backend-Assets/css/vendors/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/public/Backend-Assets/css/vendors/slick-theme.css"/>    
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/public/Backend-Assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/public/Backend-Assets/css/vendors/datatable-extension.css">
    <!-- App css -->
    <link id="color" rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/color-1.css" media="screen"/>
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/style.css"/>

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- OR Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

  </head>
  <body>
    <!-- page-wrapper Start-->
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    <!-- loader-->
    <div class="loader-wrapper">
      <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper"> 
      <header class="page-header row">
        <div class="logo-wrapper d-flex align-items-center col-auto"><a href="<?= base_url();?>adminDashboard"><img class="light-logo img-fluid text-center" src="<?= base_url(); ?>/public/Backend-Assets/images/zp_logo.png" alt="logo"  style="max-height:50px;max-width:50px;"/><img class="dark-logo img-fluid" src="<?= base_url(); ?>/public/Backend-Assets/images/zp_logo.png" alt="logo"/></a><a class="close-btn toggle-sidebar" href="javascript:void(0)">
            <svg class="svg-color">
              <use href="https://admin.pixelstrap.net/admiro/assets/svg/iconly-sprite.svg#Category"></use>
            </svg></a></div>
        <div class="page-main-header col">
          <div class="header-left">
            
          </div>
          <div class="nav-right">
            <ul class="header-right"> 
				<li class="profile-nav custom-dropdown">
                <div class="user-wrap">
                  <div class="user-img"><img src="<?= base_url(); ?>/public/Backend-Assets/images/user_profile.png" alt="user"/></div>
                  <div class="user-content">
                    <h6><?= $_SESSION['name']; ?></h6>
                    <p class="mb-0"><?php if($_SESSION['user_type']=='1'){ echo "Admin";} else if($_SESSION['user_type']=='2'){ echo "..";}?><i class="fa-solid fa-chevron-down"></i></p>
                  </div>
                </div>
                <div class="custom-menu overflow-hidden">
                  <ul class="profile-body">
                    <li class="d-flex"> 
                      <svg class="svg-color">
                        <use href="#"></use>
                      </svg><a class="ms-2" href="<?= base_url();?>logout">Log Out</a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </header>

	        <div class="page-body-wrapper"> 
        <!-- Page sidebar start-->
        <aside class="page-sidebar"> 
          <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
          <div class="main-sidebar" id="main-sidebar">
            <ul class="sidebar-menu" id="simple-bar">
              <li class="pin-title sidebar-main-title">  
                <div> 
                  <h5 class="sidebar-title f-w-700">Pinned</h5>
                </div>
              </li>
              <li class="sidebar-main-title">
                <div>
                  <h5 class="lan-1 f-w-700 sidebar-title">डॅशबोर्ड</h5>
                </div>
              </li>
              <li class="sidebar-list"><a class="sidebar-link" href="<?= base_url(); ?>adminDashboard"> 
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/admiro/assets/svg/iconly-sprite.svg#Home-dashboard"></use>
                  </svg>
                 <h6>डॅशबोर्ड</h6></a>
              </li>
              
              <li class="sidebar-main-title">
                <div>
                  <h5 class="f-w-700 sidebar-title pt-3">मास्टर</h5>
                </div>
              </li>
              
              <li class="sidebar-list"><a class="sidebar-link" href="<?= base_url();?>Taluka">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/admiro/assets/svg/iconly-sprite.svg#Paper"></use>
                  </svg>
                  <h6 class="f-w-600">तालुका </h6></a>
			        </li>
              <li class="sidebar-list"><a class="sidebar-link" href="<?= base_url();?>officeTypeList">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/admiro/assets/svg/iconly-sprite.svg#Paper"></use>
                  </svg>
                  <h6 class="f-w-600">कार्यालय प्रकार  </h6></a>
			        </li>
              <li class="sidebar-list"><a class="sidebar-link" href="<?= base_url();?>officeList">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/admiro/assets/svg/iconly-sprite.svg#Paper"></use>
                  </svg>
                  <h6 class="f-w-600">कार्यालय </h6></a>
			        </li>
              <li class="sidebar-list"><a class="sidebar-link" href="<?= base_url();?>Officer">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/admiro/assets/svg/iconly-sprite.svg#Paper"></use>
                  </svg>
                  <h6 class="f-w-600">अधिकारी </h6></a>
			        </li>

              <li class="sidebar-main-title">
                <div>
                  <h5 class="f-w-700 sidebar-title pt-3">प्रश्न संच</h5>
                </div>
              </li>
              
              <li class="sidebar-list"><a class="sidebar-link" href="<?= base_url();?>Questionset">
                  <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/admiro/assets/svg/iconly-sprite.svg#Paper"></use>
                  </svg>
                  <h6 class="f-w-600">प्रश्न संच </h6></a>
			        </li>

            </ul>
          </div>
          <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </aside>
        <!-- Page sidebar end-->