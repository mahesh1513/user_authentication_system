<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="<?php echo $csrf_token; ?>">
    <title>User Authentication System - Login</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <style>
      .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
    </style>
  </head>
  <body>
    <!-- Start your project here-->
    <section class="vh-100">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="images/draw2.webp"
              class="img-fluid" alt="Sample image">
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form id="login_form">
              <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                <p class="lead fw-normal mb-0 me-3">Sign In</p>
              </div>
    
              <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0"></p>
              </div>

              <div class="form-outline mb-4"><span style="color:red;" id="error_message"></span></div>
    
              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="email" class="form-control form-control-lg"
                  placeholder="Enter a valid Username / Email" />
                <label class="form-label" for="email">Username / Email</label>
              </div>
    
              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-3">
                <input type="password" id="password" class="form-control form-control-lg"
                  placeholder="Enter password" />
                <label class="form-label" for="password">Password</label>
              </div>


              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0">
                  <input class="form-check-input me-2" type="checkbox" value="1" id="remember_me"/>
                  <label class="form-check-label" for="remember_me">
                    Remember me
                  </label>
                </div>
                <!-- <a href="#!" class="text-body">Forgot password?</a> -->
              </div>
    
              <div class="d-flex justify-content-between align-items-center">
      
                <!-- <a href="#!" class="text-body">Forgot password?</a> -->
              </div>
              <div class="text-center text-lg-start mt-4 pt-2">
                <button  type="submit" data-mdb-ripple-init class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="index.php?url=register"
                    class="link-danger">Register</a></p>
              </div>
    
            </form>
          </div>
        </div>
      </div>
      <div
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0 text-center" style="width: 100%;">
          Copyright © 2024. All rights reserved.
        </div>
      </div>
    </section>
    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.umd.min.js"></script>
    <!-- Custom scripts -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
  </body>
</html>
