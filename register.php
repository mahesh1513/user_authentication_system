<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="<?php echo $csrf_token; ?>">
    <title>User Authentication System - Sing Up</title>
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
            <form id="registrationForm">
              <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                <p class="lead fw-normal mb-0 me-3">Sign Up Your Account</p>
              </div>
    
              <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0"></p>
              </div>

              <div class="form-outline mb-4"><span style="color:red;" id="error_message"></span></div>
              
                <!-- Username input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="username" class="form-control form-control-lg"
                    placeholder="Enter a valid Username" />
                <label class="form-label" for="username">Username</label>
                </div>
    
              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="email" class="form-control form-control-lg"
                  placeholder="Enter a valid email address" />
                <label class="form-label" for="email">Email address</label>
              </div>
              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-3">
                <input type="password" id="password" class="form-control form-control-lg"
                  placeholder="Enter password"/>
                <label class="form-label" for="password">Password</label>
              </div>
  
              <div class="text-center text-lg-start mt-4 pt-2">
                <button class="btn btn-primary btn-lg" id="register" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Have an account? <a href="index.php?url=login"
                  class="link-danger">Log in</a></p>
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
  </body>
  <!-- Custom scripts -->
  <script src="js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="js/register.js"></script>
  </script>
</html>
