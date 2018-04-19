<?php
require(File::build_path(array("view","head.php")));
?>
    <link rel="stylesheet" type="text/css" media="screen" href="./css/login.css" />
</head>
<body>
    <div class="sideBar">
        <img src="./img/logo.png" alt="Logo SGS" class="logo">
        <div class="title">Survey Generator System</div>
        <form method=<?php echo $postOrGet?> action="index.php" class="log">
            <input type='hidden' name='action' value='connected'>
            <input type='hidden' name='controller' value='user'>
          <div class="form-group">
            <input class="form-control" id="email_id" type="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <input class="form-control" id="pass_id" name="password" type="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="rememberPass"> Remember Password</label>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="?action=create">Register an Account</a>
          <a class="d-block small" href="?action=forgotPassword">Forgot Password?</a>
        </div>

    </div>
<?php
require(File::build_path(array("view","endFile.php")));
?>