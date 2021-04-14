<?php

include('functions.php');
//echo $_SESSION['msg'];

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Main Sign-in Page</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
<!-- notification message -->
<?php if (isset($_SESSION['msg'])) : ?>
    <div class="error success" >
        <h4>
            <?php
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            ?>
        </h4>
    </div>
<?php endif ?>
<div class="jumbotron text-center">
    <h1 style="text-transform: uppercase">Welcome to COVID-19 Tracking App Login Page</h1>
    <hr>
    <p style="font-size: large">To continue please enter your username and password</p>
</div>
<form class="form-horizontal" method="post" id="main-sign-in" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="alert alert-warning" role="alert">
        <?php echo display_error(); ?>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="username">Username (patients sign-in with medicare number)*</label>
        <div class="col-sm-3">
            <input class="form-control" id="username" type="text" name="username" placeholder="Ex: ABCD123456">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="password">Password (date of birth)*</label>
        <div class="inputContainer" style="max-width: 360px; margin-left: 10px">
            <i class="far fa-eye" id="togglePassword" style="cursor: pointer; position: absolute; margin: 15px; margin-left: 320px"></i>
            <input type="password" name="password" class="form-control" id="password" placeholder="Ex: ddmmyyyy">
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn" name="login_btn">Login</button>
        </div>
    </div>
    <p class="col-sm-offset-2 col-sm-10">
        Not yet a member? <a href="register.php">Sign up</a>
    </p>
</form>

<hr>
<footer class="container">
    <p style="display: block; text-align: center; margin-block-start: 1em; margin-block-end: 1em; margin-inline-start: 0px; margin-inline-end: 0px;">@ Covid Tracking App 2021</p>
</footer>
</body>
</html>
