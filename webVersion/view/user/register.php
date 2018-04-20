<?php
require(File::build_path(array("view","head.php")));
?>
</head>

<body class="backgroundPhoto">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form id="register" method=<?php echo $postOrGet?> action="index.php">
        <input type='hidden' name='controller' value='user'>
        <input type='hidden' name='action' value='created'>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="fName_id">First name</label>
                <input class="form-control" id="fName_id" type="text" aria-describedby="nameHelp" placeholder="Enter first name" name="fName">
              </div>
              <div class="col-md-6">
                <label for="lName_id">Last name</label>
                <input class="form-control" id="lName_id" type="text" aria-describedby="nameHelp" placeholder="Enter last name" name="lName">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="email_id">Email address</label>
            <input class="form-control" id="email_id" type="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
            <div id="confEmail"></div>
          </div>
          <div class="form-group">
            <label for="bd_id">Birthdate</label>
            <input class="form-control col-md-4" id="bd_id" type="date" name="birthdate" aria-describedby="datelHelp" min="1900-01-01" max=<?php echo $today; ?> >
          </div>
          <div class="form-group">
            <label for="profession_id">Profession</label>
            <select id="profession_id" class="form-control col-md-6" name="profession">
              <?php
                foreach($professionTab as $profession){?>
                  <option value="<?php echo $profession->get('id');?> "><?php echo $profession->get('description'); ?> </option>
                <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="password_id">Password</label>
                <input class="form-control" id="password_id" type="password" placeholder="Password" name="password">
              </div>
              <div class="col-md-6">
                <label for="confPassword_id">Confirm password</label>
                <input class="form-control" id="confPassword_id" type="password" placeholder="Confirm password" name="confPassword">
              </div>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Register">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Login page</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="./vendor/jquery/jquery.min.js"></script>
  <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="./js/sb-admin.min.js"></script>
  <script src="./js/jquery.validate.min.js"></script>
  <script src="./js/register.js"></script>
</body>
</html>