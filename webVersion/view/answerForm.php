<?php
require(File::build_path(array("view","head.php")));
?>
</head>

<body class="backgroundPhoto">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Name of the survey</div>
      <div class="card-body">
        <form id="register" method=get action="index.php">
        <input type='hidden' name='controller' value='survey'>
        <input type='hidden' name='action' value='created'>
        <?php $block ?>
        </form>

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