<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Field Visit - Login</title>
    <!-- Favicon icon-->
    <link rel="icon" href="<?= base_url(); ?>/public/Backend-Assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url(); ?>/public/Backend-Assets/images/favicon.png" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;display=swap" rel="stylesheet">
    <!-- Flag icon css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/vendors/flag-icon.css">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/iconly-icon.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/bulk-style.css">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/themify.css">
    <!--fontawesome-->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/fontawesome-min.css">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/public/Backend-Assets/css/vendors/weather-icons/weather-icons.min.css">
    <!-- App css -->
    <link id="color" rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/color-1.css" media="screen">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/Backend-Assets/css/style.css">
  </head>
  <body>
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    <!-- loader-->
    <div class="loader-wrapper">
      <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card login-dark">
            <div>
              <div><a class="logo" href="#"><img class="img-fluid for-light m-auto" src="<?= base_url(); ?>/public/Backend-Assets/images/zp_logo.png" alt="looginpage"><img class="img-fluid for-dark" src="<?= base_url(); ?>/public/Backend-Assets/images/zp_logo.png" alt="logo"  style="height:120px;width:120px;"></a></div>
              <div class="login-main"> 
				<?php echo form_open_multipart('/signIn', array('autocomplete' => 'off','class' => 'p-0 theme-form')); ?>
                <h2 class="text-center">Sign in to account</h2>
                <p class="text-center">Enter your username &amp; password to login</p>
				<div style="font-size: 15px;color: #ff0000;text-align:center;">
					<?php error_reporting(0); echo $_SESSION['invalidLoginD'];?>
				</div> 
                  <div class="form-group">
                    <label class="col-form-label">Username <span class="mandatory">*</span></label>
                    <input class="form-control" type="text" name="username" placeholder="Enter username">
					<?php  if(isset($validation)) { ?>
						<div class="text-danger" style="text-align: left;margin-left: 5px;color: #ec536c!important;">
						<?= $validation->getError('username'); ?>
						</div>
					<?php } ?>  
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password <span class="mandatory">*</span></label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" placeholder="Enter password">
                      <div class="show-hide"><span class="show"> </span></div> 
                    </div>
                  </div>
                  <div class="form-group mb-0 checkbox-checked">
                    <a class="link" href="#">Forgot password?</a>
                    <div class="text-end mt-3">
                      <button class="btn btn-primary btn-block w-100" type="submit">Sign in                 </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- jquery-->
      <script src="<?= base_url(); ?>/public/Backend-Assets/js/vendors/jquery/jquery.min.js"></script>
      <!-- bootstrap js-->
      <script src="<?= base_url(); ?>/public/Backend-Assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" defer=""></script>
      <script src="<?= base_url(); ?>/public/Backend-Assets/js/vendors/bootstrap/dist/js/popper.min.js" defer=""></script>
      <!--fontawesome-->
      <script src="<?= base_url(); ?>/public/Backend-Assets/js/vendors/font-awesome/fontawesome-min.js"></script>
      <!-- password_show-->
      <script src="<?= base_url(); ?>/public/Backend-Assets/js/password.js"></script>
      <!-- custom script -->
      <script src="<?= base_url(); ?>/public/Backend-Assets/js/script.js"></script>
    </div>
  </body>

<!-- Mirrored from admin.pixelstrap.net/admiro/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 May 2025 04:28:59 GMT -->
</html>