<?php

include('../config.php');

if (isset($_POST['add_new_person'])) {
    $person_id=add_person();
    echo "hello world".$person_id;
    $location ="/COM353/person/person_view.php?person_id=".$person_id;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);

}
if (isset($_POST['update_person_btn'])) {
    $person_id = e($_POST['person_id']);
    echo $person_id;
    $person_id = update_ui_person($person_id);
    header("Location: person_record.php");
}

if (isset($_POST['delete_person'])) {
    $person_id = e($_POST['person_id']);
    $person_id = delete_facility($person_id );
    echo "delete";
    header("Location: person_record.php");

}
function add_person()
{
    global $mysqli;
    $date = date_create();
    echo date_timestamp_get($date);
    //$facility_id=generateRandomString();
    $query = "INSERT INTO person(person_id)VALUES(null)";
    $mysqli->query($query);
    $person_id=$mysqli->insert_id;
    $query = "INSERT INTO Address(person_id)VALUES('$person_id')";
    $mysqli->query($query);

    $mysqli->close();
    return  $person_id;
}


function delete_facility($facility_id)
{
    global $mysqli;
    $facility_id = e($_POST['facility_id']);
    $query ="DELETE FROM `PUBLICHEALTHCENTER` WHERE `facility_id` = '$facility_id'";
    if ($mysqli->query($query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $query->error;
    }
    $mysqli->close();
    return $region_id;
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getRelatedPerson(){
    global $mysqli;
    $query = "SELECT Person_id,first_name,Last_name,phone_number,street_address from person_det_view";
    $result = mysqli_query($mysqli, $query);
    $numRows=mysqli_num_rows($result);
    $regions = array();
    while ($row = $result->fetch_row()) {
        echo  "<option value=$row[0] >$row[0] - $row[1] $row[2] </option>";
        $regions[]=$row;
    }

    return $regions;

}

function update_ui_person($person_id)
{
    echo " suhel updating";
    global $mysqli;
    //$person_id = e($_POST['person_id']);
    $first_name=e($_POST['first_name']);
    $last_name=e($_POST['last_name']);
    $dob=e($_POST['dob']);
    $is_health_worker=e($_POST['is_health_worker']);
    $related_person_no=e($_POST['related_person_no']);
    $query = "UPDATE `PERSON` SET `first_name` = '$first_name', `last_name` = '$last_name' ,`dob` = '$dob' ,`is_health_worker` = '$is_health_worker' ,`related_person_no` = '$related_person_no'   WHERE `Person`.`person_id` = '$person_id'";
    echo "one";
    if ($mysqli->query($query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $query->error;
    }
    $email_address = e($_POST['email_address']);
    $phone_number = e($_POST['phone_number']);
    $street_address = e($_POST['street_address']);
    $province = e($_POST['province']);
    $query = "UPDATE `ADDRESS` SET `email_address` = '$email_address', `phone_number` = '$phone_number' ,`street_address` = '$street_address' ,`is_health_worker` = '$is_health_worker' ,`province` = '$province'   WHERE `ADDRESS`.`person_id` = '$person_id'";
    if ($mysqli->query($query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $query->error;
    }
    $mysqli->close();
    return $person_id;
}






