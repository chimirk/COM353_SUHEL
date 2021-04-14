<?php

include($_SERVER['DOCUMENT_ROOT']."\\log_reg_follow_up_func.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Main Sign-in Page</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

    <div class="jumbotron text-left">
    <h1>Thank you.</h1>
    <p>The data has been successfully saved</p>
    <p>Please press the button to logout</p>
    </div>
    <form id="thankyou" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <div>
            <button class="btn btn-outline-primary" type="submit" form="thankyou" name="logout">Logout</button>
        </div>
    </form>



<footer style="margin-bottom: 0px; text-align: center">
    <hr>
    <p>
        @Covid Tracking App 2021
    </p>
</footer>
</body>
</html>
