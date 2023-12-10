<?php

require_once '..\controllers\ControllerAuth.php';
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/fonts/icomoon/style.css">
  <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <!-- Style -->
  <link rel="stylesheet" href="../../assets/css/login.css">
  <link rel="stylesheet" href="../../assets/scss/style.scss">


  <title>Login </title>
  <link rel="icon" href="../../assets/images/icon.png" type="image/x-icon" />

</head>

<body>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('../../assets/images/login.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">

        <div class="row align-items-center justify-content-center">

          <div class="col-md-7">
            <div id="logo-wrapper">
              <img src="../../assets/images/logo.png" alt="logo">
            </div>

            <form action="login.php" method="post">
            <input type="hidden" name="form_source" value="login">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="your-email@gmail.com" id="username" name="username"
                  required value="<?php if (isset($_COOKIE['username'])) {
                    echo $_COOKIE['username'];
                  } ?>">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Your Password" id="password" name="password"
                  required value="<?php if (isset($_COOKIE['password'])) {
                    echo $_COOKIE['password'];
                  } ?>">
              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" id="remember" name="remember" />
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
              </div>
              <input type="submit" value="Log In" class="btn btn-block">
              <div class="d-flex mb-4 align-items-center">
                <div class="error-message">
                  <?php echo $loginError; ?>
                </div> <!-- Message d'erreur en anglais -->
              </div>
              <span class="ml-auto"> New to MyBook ? <a href="signup.php" class="ml-auto">Create an account</a></span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../assets/js/jquery-3.3.1.min.js"></script>
  <script src="../../assets/js/popper.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>
  <script src="../../assets/js/login.js"></script>
</body>

</html>