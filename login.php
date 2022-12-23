<?php
require 'config.php';
if (!empty($_SESSION["id"])) {
  header("Location: index.php");
}
if (isset($_POST["submit"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
  $row = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) > 0) {
    if ($password == $row['password']) {
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: index.php");
      echo $_SESSION;
    } else {
      echo
        "<script> alert('Email or password is incorrect'); </script>";
    }
  } else {
    echo
      "<script> alert('Email or password is incorrect'); </script>";

  }
}
?>

<?php include("components/top.php") ?>

<h2>Login</h2>
<div class="form-container">
  <h3> <span>Technos</span> Systems</h3>
  <div class="body">
    <p>Sign in to start your session</p>
    <form class="row g-3 needs-validation" novalidate method="post" action="">
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
    </form>
  </div>
</div>

<?php include("components/bot.php") ?>