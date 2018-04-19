<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SGS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/login.css" />
    <script src="./js/main.js"></script>
</head>
<body>
    <div class="sideBar">
        <img src="./img/logo.png" alt="Logo SGS" class="logo">
        <div class="title">Survey Generator System</div>
        <form method=<?php echo $postOrGet?> action="index.php">
            <input type='hidden' name='action' value='connected'>
            <input type='hidden' name='controller' value='user'>
            <input type="email" id="email_id" name="email" placeholder="Email" required>
            <br>
            <input type="password" class="form-control connect" id="pass_id" name="password" placeholder="Password" required>
            <br>
            <a href="./index.php?controller=user&action=forgotPassword">forgot password ?</a>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>