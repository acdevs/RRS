<?php
session_start();
include('assets/inc/config.php'); //get configuration file
if (isset($_POST['user_login'])) {
  $user_name = $_POST['user_name'];
  $user_pwd = sha1(md5($_POST['user_pwd'])); //double encrypt to increase security
  $stmt = $mysqli->prepare("SELECT username, password FROM USER WHERE username=? and password=? "); //sql to log in user
  $stmt->bind_param('ss', $user_name, $user_pwd); //bind fetched parameters
  $stmt->execute(); //execute bind
  $stmt->bind_result($username, $password); //bind result
  $rs = $stmt->fetch();
  $_SESSION['user_id'] = $username; //assaign session to passenger id

  if ($rs) { //if its sucessfull
    $host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="user-dashboard.php";
    if($host == 'localhost')
		  header("Location: user-dashboard.php");
    else
		  header("Location: http://$host$uri/$extra");
  } else {
    $error = "Invalid login credentials. Please try again";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="assets/img/favicon.ico">
  <title>Railway Reservation System</title>
  <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" />
  <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="assets/css/app.css" type="text/css" />
  <!--Trigger Sweet Alert-->
  <?php if (isset($error)) { ?>
    <!--This code for injecting an alert-->
    <script>
      setTimeout(function() {
          swal("Failed!", "<?php echo $error; ?>", "error");
        },
        100);
    </script>

  <?php } ?>
</head>

<body class="be-splash-screen">
  <div class="be-wrapper be-login">
    <div class="be-content">
      <div class="main-content container-fluid">
        <div class="splash-container">
          <div class="card card-border-color card-border-color-success">
            <div class="card-header"><img class="logo-img" src="assets/img/logo.png" alt="logo" height="20"><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">

              <!--Login Form-->
              <form method="POST">
                <div class="login-form ">

                  <div class="form-group">
                    <input class="form-control" name="user_name" type="text" placeholder="Username" required>
                  </div>

                  <div class="form-group">
                    <input class="form-control" name="user_pwd" type="password" placeholder="Password" required>
                  </div>

                  <div class="form-group row login-tools">
                    <div class="col-6 login-remember">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="check1">
                        <label class="custom-control-label" for="check1">Remember Me</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row login-submit">
                    <div class="col-6"><a class="btn btn-danger btn-xl" href="user-signup.php">Register</a></div>
                    <div class="col-6"><input type="submit" name="user_login" class="btn btn-success btn-xl" value="Log In"></div>
                  </div>

                </div>
              </form>
              <!--End Login-->
            </div>
          </div>
          <div class="splash-footer"><a href="/">Home</a></div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
  <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <script src="assets/js/app.js" type="text/javascript"></script>
  <script src="assets/js/swal.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      //-initialize the javascript
      App.init();
    });
  </script>
</body>

</html>