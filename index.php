<?php
require 'config.php';
require_once("auth.php");
$id = $_SESSION["id"];
$result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
$row = mysqli_fetch_assoc($result);
?>

<?php include("components/top.php") ?>
<h1>Welcome </h1>
<div class="form-container-index">
  <h3> <span>Technos</span> Systems</h3>
  <div class="body">
    <h2>Welcome</h2>
    <h2><?php echo $row["full_name"]; ?></h2>
    <form class="row g-3 needs-validation" novalidate method="post" action="">
      <a href="logout.php">
        <p class="btn btn-primary p">Logout</p>
      </a>
    </form>
  </div>
</div>

<?php include("components/bot.php") ?>