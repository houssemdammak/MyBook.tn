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
  <title>Sign in </title>
  <link rel="icon" href="../../assets/images/icon.png" type="image/x-icon" />

</head>

<body>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('../../assets/images/login.jpg'); "></div>
    <div class="contents order-2 order-md-1">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div id="logo-wrapper">
              <img src="../../assets/images/logo.png" alt="logo">
            </div>
           
            

            <form action="signup.php" method="post">
            <input type="hidden" name="form_source" value="signup">
              <div class="form-group first">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" placeholder="Full Name" id="fullname" name="fullname" required
                  value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : $fullname; ?>">
                <span id="fullname-error" class="error-message">
                  <?php echo $fullnameError; ?>
                </span>
              </div>
              <div class="form-group first">
                <label for="email">Email</label>
                <input type="text" class="form-control" placeholder="your-email@gmail.com" id="email" name="email"
                  required value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : $email; ?>">
                <span id="email-error" class="error-message">
                  <?php echo $emailError; ?>
                </span>
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Your Password" id="password" name="password">
                <span id="password-error" class="error-message">
                  <?php echo $passwordError; ?>
                </span>
              </div>
              <div class="form-group last mb-3">
                <label for="Repassword">Confirm your Password</label>
                <input type="password" class="form-control" placeholder="Confirm Your Password" id="Repassword"
                  name="Repassword">
                <span id="Repassword-error" class="error-message">
                  <?php echo $RepasswordError; ?>
                </span>
              </div>

              <div class="form-group last mb-4">
                <input type="submit" value="Sign In" class="btn btn-block">
              </div>
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