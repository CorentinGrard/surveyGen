<?php
require(File::build_path(array("view","head.php")));
?>
</head>

<body class="backgroundPhoto">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <form id="forgotPass" method=<?php echo $postOrGet?> action="index.php">
          <input type='hidden' name='controller' value='user'>
          <input type='hidden' name='action' value='resetPassword'>
          <div class="form-group">
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email address">
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Reset Password">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="?controller=user&action=create">Register an Account</a>
          <a class="d-block small" href="?">Login Page</a>
        </div>
      </div>
    </div>
  </div>
  <?php
require(File::build_path(array("view","endFile.php")));
?>
