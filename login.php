<?php
require 'config.php';
require_once("auth.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $email = $_POST["email"];
  // Check user if Exist
  $sql = "SELECT * FROM `user` where `email` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    // If user data exist
    $details = $result->fetch_assoc();
    // verify given password
    $password_verify = password_verify($_POST['password'], $details['password']);
    if ($password_verify) {
      $_SESSION['id'] = $details['id'];
      // Save user details on session
      // foreach ($details as $k => $v) {
      //   $_SESSION[$k] = $v;
      // }
      header('location: index.php');
    } else {
      // If Password does not match
      $err = "Invalid email and or password";
    }
  } else {
    // If User details does not exist
    $err = "Invalid email and or password";
  }

}

?>



<?php include("components/top.php") ?>

<h2>Login</h2>
<div class="form-container">
  <h3> <span>Technos</span> Systems</h3>
  <div class="body">
    <p>Sign in to start your session</p>
    <form class="row g-3" novalidate method="post" action="">
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
        <input type="password" placeholder="Password" name="password" class="form-control" id="password"
          aria-describedby="inputGroupPrepend" required>
        <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock" aria-hidden="true"></i>
        </span>
        <div class="invalid-feedback">
          Please enter password
        </div>
      </div>
      <div class="remember">
        <div>
          <input class="form-check-input-no" type="checkbox" value="" id="rememberCheck">
          <label class="form-check-label" for="rememberCheck">
            Remember Me
          </label>
        </div>
        <button class="btn btn-primary" name="submit" type="submit">Sign In</button>
      </div>
      <a href="register.php">
        <p>Register a new membership</p>
      </a>
      <?php if (isset($err) && !empty($err)): ?>
      <div class="alert alert-danger">
        <?= $err ?>
      </div>
      <?php endif; ?>
    </form>
  </div>
</div>

<?php include("components/bot.php") ?>