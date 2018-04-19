<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
  </head>
  <body>
    <?php
    $filepath = File::build_path($view);
    require $filepath;
    ?>
    <footer>
    </footer>
  </body>
</html>
