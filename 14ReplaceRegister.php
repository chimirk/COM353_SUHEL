<?php

include($_SERVER['DOCUMENT_ROOT']."\\functions.php");
include($_SERVER['DOCUMENT_ROOT']."\\log_reg_follow_up_func.php");

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);

}

?>

<html>
<head>
    <title>New User Registration</title>
    <meta charset="UTF-8">
    <title>Signed-in Page</title>
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
<div class="jumbotron text-center">
    <h1>COVID-19 Tracking App Registration Page</h1>
    <p>new patients should register with their Medicare Card Number and Date of Birth</p>
</div>
<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="alert alert-warning" role="alert">
        <?php echo display_error(); ?>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="username">Username (medicare number)*</label>
        <div class="col-sm-3">
            <input class="form-control" type="text" name="username" id="username"  placeholder="ABCD1234" value="<?php echo $username; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email</label>
        <div class="col-sm-3">
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $email; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="password1">Password (date of birth)*</label>
        <div class="col-sm-3">
            <i class="far fa-eye" id="togglePassword1" style="cursor: pointer; position: absolute; margin: 15px 15px 15px 320px;"></i>
            <input class="form-control" type="password" name="password_1" id="password1" placeholder="ddmmyyyy">
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword1');
        const password = document.querySelector('#password1');
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>

    <div class="form-group">
        <label class="control-label col-sm-2" for="password2">Confirm password</label>
        <div class="col-sm-3">
            <input class="form-control" type="password" id="password2" name="password_2">
        </div>
    </div>
    <script>
        const togglePassword2 = document.querySelector('#togglePassword2');
        const password2 = document.querySelector('#password2');
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
            password2.setAttribute('type', type);

        });
    </script>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_patient" name="is_patient" checked>
                <label class="form-check-label" >I am here for follow-up</label>
            </div>
        </div>

    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn" name="register_btn">Register</button>
        </div>
    </div>
    <p class="col-sm-3">
        Already a member? <a href="login.php">Sign in</a>
    </p>
</form>
</body>
</html>
