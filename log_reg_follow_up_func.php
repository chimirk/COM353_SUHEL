<?php

//echo $_SERVER['DOCUMENT_ROOT'];


// variable declaration
$username = "";
$email    = "";
$errors   = array();

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
    register();
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
    login();
}

//call the followUp function if go-to-daily-form-btn button is clicked
if(isset($_POST['go-to-daily-form-btn']))   {
    header('Location: followUpForm.php');
}

//call the processFollowUp() function if send-follow-up-btn is clicked
if(isset($_POST['send-follow-up-btn']))  {
    processFollowUp();
}

//cancel the follow-up form if cancel-follow-up-form-btn is clicked
if(isset($_POST['cancel-follow-up-form-btn']))  {
    cancelFollowUpForm();
}

// log user out if logout button clicked
if (isset($_POST['logout'])) {
    session_destroy();
    session_unset();
    header('location: login.php');
}









// REGISTER USER
function register(){
    // call these variables with the global keyword to make them available in function
    global $db, $errors, $username, $email;

    // receive all input values from the form. Call the e() function
    // defined below to escape form values
    $username    =  e($_POST['username']);
    $email       =  e($_POST['email']);
    $password_1  =  e($_POST['password_1']);
    $password_2  =  e($_POST['password_2']);

    // form validation: ensure that the form is correctly filled
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    //--------------------ADD THIS INTO
    if(isset($_POST['is_patient'])) {
        $temp_day = substr($password_1, 0, 2);
        $temp_month = substr($password_1, 2, 2);
        $temp_year = substr($password_1, 4, 4);
        $temp_password = $temp_year."-".$temp_month."-".$temp_day;

        $query = "SELECT * FROM users_view WHERE medicare_number = '$username' AND DOB = '$temp_password'";
        $result = $db->query($query);
        if($result != false) {
            if($result->num_rows != 1) {   //user not found
                array_push($errors, "No such Medicare-Number or Date-of-Birth in database. Please verify entered data.");
            }
        }
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        if (isset($_POST['user_type'])) {
            $user_type = e($_POST['user_type']);
            $query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
            mysqli_query($db, $query);
            $_SESSION['msg']  = "New user successfully created!!";
            header('location: login.php');
        }else{
            $query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
            mysqli_query($db, $query);

            // get id of the created user
            $logged_in_user_id = mysqli_insert_id($db);
            //echo $logged_in_user_id;

            $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
            $_SESSION['msg']  = "New User Created Successfully. You are now logged-in!!";
            header('location: index.php');
        }
    }
}



// LOGIN USER
function login(){
    global $db, $username, $errors;

    // grap form values
    $username = e($_POST['username']);
    $password = e($_POST['password']);

    // make sure form is filled properly
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // attempt login if no errors on form
    if (count($errors) == 0) {
        $password = md5($password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) { // user found
            // check if user is admin or user
            $logged_in_user = mysqli_fetch_assoc($results);

            if($logged_in_user != false AND $logged_in_user['user_type'] == 'user') {
                $medicare_number = $logged_in_user['username'];

                $query = "SELECT * FROM persons_view WHERE medicare_number = '$medicare_number'";
                $result = $db->query($query);
                if($result != false) {
                    if($result->num_rows != 1) {
                        $_SESSION['msg'] = "unauthorised access. please contact the database administrator";
                        header('location: login.php');
                        exit();
                    }
                }
            }

            if ($logged_in_user['user_type'] == 'admin') {

                //$_SESSION['user'] = $logged_in_user;
                //$_SESSION['success']  = "You are now logged in";
                header('location: admin/admin_header.php');

            }else{

                //echo $_POST['username'];
                $_SESSION['username'] = $_POST['username'];

                $_SESSION['user'] = $logged_in_user;
                $_SESSION['msg']  = "You are now logged in";

                header('location: index.php');
                            }
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}


//PROCESS FOLLOW UP FORM
function processFollowUp()
{
    global $db, $errors, $medicare_number, $current_date, $current_time, $body_temperature, $symptoms;

    // receive all input values from the form. Call the e() function
    // defined below to escape form values
    $medicare_number = "";
    if(isset($_SESSION['user']['username'])){
        $medicare_number = e($_SESSION['user']['username']);
    }else {
        die("cannot get medicare number");
    }
    $current_date = e($_POST['current-date']);
    $current_time = e($_POST['current-time']);
    $body_temperature = e($_POST['body-temperature']);
    if (!empty($_POST['check-list'])) {
        $symptoms = $_POST['check-list'];
    }
    if(!empty($_POST['other-symptom'])) {
        $other_symptom = e($_POST['other-symptom']);
    }

    if (empty(($current_date))){
        array_push($errors, "current-date is required");
    }
    if (empty(($current_time))){
        array_push($errors, "current-time is required");
    }
    if (empty($body_temperature)) {
        array_push($errors, "body-temperature required");
    }
    if (empty($symptoms)) {
        array_push($errors, "at least one symptom must be selected");
    }

    // send data to the tables if there are no errors in the form
    if (count($errors) == 0) {

        $query = "SELECT person_id, medicare_number FROM person WHERE medicare_number = '$medicare_number'";
        $result = $db->query($query);

        $person_id = "";
        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $person_id = $row["person_id"];
            }

            //put data into FOLLOWUP DETAILS Table
            $result;
            foreach ($symptoms as $symptom) {
                $query = "INSERT INTO followup_details (person_id, date_reported, time_reported, symptoms) VALUES ('$person_id', '$current_date', '$current_time', '$symptom')";
                $result = $db->query($query);

            }
            if(isset($other_symptom)) {
                //echo $other_symptom;
                $query = "INSERT INTO followup_details (person_id, date_reported, time_reported, symptoms) VALUES ('$person_id', '$current_date', '$current_time', '$other_symptom')";
                $result = $db->query($query);

            }
            if($result == true) {
                echo "data-inserted into followup details table";
            } else {
                die("Error into inserting into followup details table");
            }

            //put data into Daily Follow-Up Table
            $query = "INSERT INTO daily_follow_up (person_id, date_reported, time_reported, body_temp) VALUES('$person_id', '$current_date', '$current_time', '$body_temperature')";
            $result = $db->query($query);
            if($result != false) {
                echo "data-inserted into daily followup table";
            } else {
                die("Error into inserting into daily followup table");
            }


            $db->close();
            header('Location: thankyou.php');
        }
    }
}


//cancel the follow up Form and return to main-user page
function cancelFollowUpForm()  {
    header('Location: index.php');
    exit();
}












// return user array from their id
function getUserById($id){
    global $db;
    $query = "SELECT * FROM users WHERE user_id='$id'";
    $result = mysqli_query($db, $query);

    $user = mysqli_fetch_assoc($result);
    return $user;
}





function display_error() {
    global $errors;

    if (count($errors) > 0){
        echo '<div class="error">';
        foreach ($errors as $error){
            echo $error .'<br>';
        }
        echo '</div>';
    }
}
