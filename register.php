<?php
require 'config.php';
if (!empty($_SESSION["id"])) {
  header("Location: index.php");
}
if (isset($_POST["submit"])) {
  $full_name = $_POST["full_name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $duplicate = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");
  if (mysqli_num_rows($duplicate) > 0) {
    echo
      "<script> alert('Username or Email Has Already Taken'); </script>";
  } else {
    if ($password == $confirmpassword) {
      $query = "INSERT INTO user VALUES('','$full_name','$email','$password')";
      mysqli_query($conn, $query);
      echo
        "<script> alert('Registration Successful'); </script>";
    } else {
      echo
        "<script> alert('Password Does Not Match'); </script>";
    }
  }
}
?>

<?php include("components/top.php") ?>

<h2>Registration</h2>
<div class="form-container-register">
  <h3> <span>Technos</span> Systems</h3>
  <div class="body">
    <p>Register a new membership</p>
    <form class="row g-3 needs-validation" novalidate method="post" action="">
      <div class="input-group has-validation">
        <input type="text" placeholder="Full name" name="full_name" class="form-control" id="full_name"
          aria-describedby="inputGroupPrepend" required>
        <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user" aria-hidden="true"></i>
        </span>
        <div class="invalid-feedback">
          Please enter Full name.
        </div>
      </div>
      <div class="input-group has-validation">
        <input type="text" placeholder="Email" name="email" class="form-control" id="email"
          aria-describedby="inputGroupPrepend" required>
        <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-envelope" aria-hidden="true"></i>
        </span>
        <div class="invalid-feedback">
          Please enter email.
        </div>
      </div>
      <div class="input-group has-validation">
        <input type="text" placeholder="Password" name="password" class="form-control" id="password"
          aria-describedby="inputGroupPrepend" required>
        <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock" aria-hidden="true"></i>
        </span>
        <div class="invalid-feedback">
          Please enter password
        </div>
      </div>
      <div class="input-group has-validation">
        <input type="text" placeholder="Retype password" name="confirmpassword" class="form-control"
          id="confirmpassword" aria-describedby="inputGroupPrepend" required>
        <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock" aria-hidden="true"></i>
        </span>
        <div class="invalid-feedback">
          Please Retype your password.
        </div>
      </div>
      <div class="remember">
        <div class="form-check">
          <input required class="form-check-input" type="checkbox" value="" id="agreeCheck">
          <label class="form-check-label" for="agreeCheck">
            I agree to the <a href="#">terms</a>
          </label>
          <div class="invalid-feedback">
            You must agree before submitting.
          </div>
        </div>
        <button class="btn btn-primary" name="submit" type="submit">Register</button>
      </div>
      <a href="login.php">
        <p class="p">I already have a membership</p>
      </a>
    </form>
  </div>
</div>

<?php include("components/bot.php") ?>