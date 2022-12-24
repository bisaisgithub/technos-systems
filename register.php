<?php
require 'config.php';
require_once("auth.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $full_name = $_POST['full_name'];
  $email = $_POST["email"];
  $confirmpassword = $_POST["confirmpassword"];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  // Check username duplication

  if ($password == $confirmpassword) {
    $err = "Username is already taken!";
  } else {
    $check = $conn->query("SELECT id FROM `user` where `email` = '{$email}'")->num_rows;
    if ($check > 0) {
      $err = "Username is already taken!";
    } else {
      $sql = "INSERT INTO `user` (`full_name`, `email`, `password`) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $full_name, $email, $password);
      $stmt->execute();
      if ($stmt->affected_rows > 0) {
        $success = "Account has been created succesfully. <a href='login.php'>Login Now!</a>";
        $_SESSION['success_msg'] = $success;
        header('location: register.php');
        unset($_POST);
        exit;
      } else {
        $err = "Creating your account has been failed for some reason!";
      }
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
      <?php if (isset($_SESSION['success_msg']) && !empty($_SESSION['success_msg'])): ?>
      <div class="alert alert-success">
        <?= $_SESSION['success_msg'] ?>
      </div>
      <?php unset($_SESSION['success_msg']); ?>
      <?php else: ?>
      <?php endif; ?>
      <?php if (isset($err) && !empty($err)): ?>
      <div class="alert alert-danger">
        <?= $err ?>
      </div>
      <?php endif; ?>
    </form>
  </div>
</div>

<?php include("components/bot.php") ?>