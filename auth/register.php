<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Registration</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- <link rel="icon" href="assets/img/logos.png" type="image/*" /> -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
  <link rel="stylesheet" href="assets/css/ready.css">
  <link rel="stylesheet" href="assets/css/demo.css">
  <link rel="stylesheet" href="../../rsms.me/inter/inter.css">
  <script type="text/javascript">
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
  body {
    font-family: 'Inter', sans-serif;
    background: #f2f3f8 !important;
  }

  a {
    text-decoration: none !important;
  }

  .card {
    border-radius: 5px !important;
  }
</style>

<body>
  <div class="container">

    <section class="h-100 ">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-12">
                  <div class="card-body p-md-5 mx-md-4">

                    <div class="text-center">
                      <!-- <img src="assets/img/logos.png" style="width: 185px;" alt="logo"> -->
                      <h6 class="mt-1 mb-4 pb-1">UPI QR Code Based Automation Gateway</h6>
                    </div>


                    <?php
                    include "config.php";
                    if (isset($_POST['create'])) {

                      $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
                      $email = mysqli_real_escape_string($conn, $_POST['email']);

                      $checkMobileQuery = "SELECT * FROM `users` WHERE `mobile` = '$mobile'";
                      $checkMobileResult = mysqli_query($conn, $checkMobileQuery);

                      $checkEmailQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
                      $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

                      if (mysqli_num_rows($checkMobileResult) > 0) {
                        echo '
                            <script>
                                Swal.fire({
                                    title: "Opps! Sorry Mobile Number Already Exist. Please use a different number",
                                    text: "Please Click Ok Button!!",
                                    confirmButtonText: "Ok",
                                    icon: "error"
                                })
                            </script>
                        ';
                        exit;
                      } elseif (mysqli_num_rows($checkEmailResult) > 0) {
                        // The email already exists, display an error message
                        echo '
                          <script>
                              Swal.fire({
                                  title: "Opps! Sorry Mobile Number Already Exist. Please use a different email",
                                  text: "Please Click Ok Button!!",
                                  confirmButtonText: "Ok",
                                  icon: "error"
                              })
                          </script>
                      ';
                        exit;
                      } else {
                        // Proceed with user registration
                        $password = mysqli_real_escape_string($conn, $_POST['password']);
                        $name = mysqli_real_escape_string($conn, $_POST['name']);
                        $company = mysqli_real_escape_string($conn, $_POST['company']);
                        $pin = mysqli_real_escape_string($conn, $_POST['pin']);


                        $location = mysqli_real_escape_string($conn, $_POST['location']);
                        $key = md5(rand(00000000, 99999999));
                        $pass = password_hash($password, PASSWORD_BCRYPT);
                        $today = date("Y-m-d", strtotime("+3 days"));

                        $register = "INSERT INTO `users`(`name`, `mobile`, `role`, `password`, `email`, `company`, `pin`, `location`, `user_token`, `expiry`) VALUES ('$name','$mobile','User','$pass','$email','$company','$pin','$location','$key','$today')";
                        $result = mysqli_query($conn, $register);

                        $msg = "Dear $name thanks For Registering Us
        Your Username = $mobile
        Your Password = $password
        Thanks & Regards
        UPB TEAM";
                        $encodedMsg = urlencode($msg);

                        if ($result) {
                          file_get_contents("https://server.aisensy.in/api/send?number=91$mobile&type=text&message=$encodedMsg&instance_id=6555EB274DF7F&access_token=64de19ca0114c");
                          echo '
                              <script>
                                  Swal.fire({
                                      title: "Registration Successfull!!",
                                      text: "Please Click Ok Button!!",
                                      confirmButtonText: "Ok",
                                      icon: "success"
                                  }).then((result) => {
                                      if (result.isConfirmed) {
                                          window.location.href = "index"; // Replace with your desired redirect URL
                                      }
                                  });
                              </script>
                          ';
                          exit;
                        } else {
                          echo '
                              <script>
                                  Swal.fire({
                                      title: "Rgistration Failed!!",
                                      text: "Please Click Ok Button!!",
                                      confirmButtonText: "Ok",
                                      icon: "error"
                                  })
                              </script>
                          ';
                          exit;
                        }
                      }
                    }
                    ?>




                    <form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                      <div class="col-md-6 mb-2">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" placeholder="Enter Mobile Number" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required />
                      </div>

                      <div class="col-md-6 mb-2"><label>Password</label> <input type="password" name="password" placeholder="Enter Password" class="form-control" required="" /></div>

                      <div class="col-md-6 mb-2">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Enter Email Address" class="form-control" required />
                      </div>

                      <div class="col-md-6 mb-2"><label>Name</label> <input type="text" name="name" placeholder="Enter Name" class="form-control" required="" /></div>
                      <div class="col-md-6 mb-2"><label>Company</label> <input type="text" name="company" placeholder="Enter Company" class="form-control" required="" /></div>

                      <div class="col-md-6 mb-2">
                        <label>Area Pin</label>
                        <input type="text" name="pin" placeholder="Area Pin" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);" required />
                      </div>
                      <div class="col-md-12 mb-2">
                        <label>Location</label>
                        <input type="text" name="location" placeholder="Enter Location" class="form-control" required="" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')" />
                      </div>

                      <div class="col-md-12 mb-2 mt-2">
                        <button type="submit" name="create" class="btn btn-primary btn-sm btn-block">Register</button>
                        <a class="btn btn-secondary btn-block fa-lg gradient-custom-2 mb-3" href="../">Cancel</a>
                      </div>
                      <div class="col-md-12 mb-2">
                        <div class="d-flex align-items-center justify-content-center mt-2">
                          <p class="mb-0 mr-2">Already have an account?</p>
                          <a href='index' class="btn btn-outline-danger btn-sm">Login</a>
                        </div>
                      </div>
                    </form>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>




  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">
    <div class="container-fluid container">
      <a class="nav-item text-light" href="#" style="text-decoration: auto;">@ All Copyright Reeved By MUNMUN</a>

      <div class="d-flex" style="gap: 10px;">
        <a class="nav-item text-light" href="#" style="text-decoration: auto;">T & C</a>
        <p class="text-light">/</p>
        <a class="nav-item text-light" href="#" style="text-decoration: auto;">Privacy Policy</a>
      </div>
    </div>
  </nav>






</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script>
  $(document).ready(function() {
    $('#disclaimer').modal({
      backdrop: 'static',
      keyboard: false
    })
    $("#disclaimer").modal("show");
  });
</script>

<!-- Mirrored from upigetway.com/auth/register by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 17:52:40 GMT -->

</html>