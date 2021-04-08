<?php

include('../config.php');


if (isset($_POST['create_new_schedule'])) {
    $person_id = e($_POST['person_id']);
    $facility_name = $_POST['facility_name'];
    $schedule_date = e($_POST['schedule_date']);

    $person_id = create_new_schedule($person_id, $facility_name, $schedule_date);
    $location ="/COM353_SUHEL/healthworker/healthworker_view.php?person_id=".$person_id;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
}

if (isset($_POST['delete_schedule'])) {
    $person_id = e($_POST['person_id']);
    $facility_id = e($_POST['facility_id']);
    $schedule_date = e($_POST['schedule_date']);

    $person_id = delete_schedule($person_id, $facility_id, $schedule_date);
    $location ="/COM353_SUHEL/healthworker/healthworker_view.php?person_id=".$person_id;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
}

if (isset($_POST['update_schedule'])) {
    $person_id = update_schedule();
    $location ="/COM353_SUHEL/healthworker/healthworker_view.php?person_id=".$person_id;
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
}

function update_schedule()
{
    echo "inside update";
    global $mysqli;
    $person_id = $_POST['person_id'];
    $facility_id = $_POST['facility_id'];
    $schedule_date = $_POST['schedule_date'];
    $schedule_start = $_POST['schedule_start_time'];
    //$schedule_start = date('H:i:s a', strtotime($_POST['schedule_start_time']));
    $schedule_end = $_POST['schedule_end_time'];
    //$schedule_end = date('H:i:s a', strtotime($_POST['schedule_end_time']));
    //echo $schedule_start;

    $query = "UPDATE `work_schedule` SET 
                         `schedule_start` = '$schedule_start',
                         `schedule_end` = '$schedule_end'
             WHERE person_id = '$person_id' AND `facility_id` = '$facility_id' AND `schedule_date` = '$schedule_date'
                         ";
    $mysqli->query($query);
    //$mysqli->close();

    return$person_id;
}


function delete_schedule($person_id, $facility_id, $schedule_date)
{
    global $mysqli;

    $query ="DELETE FROM `work_schedule` 
                WHERE `person_id` = '$person_id' AND 
                      `facility_id` = '$facility_id' AND
                      `schedule_date` = '$schedule_date'";
    $mysqli->query($query);

    $mysqli->close();
    return $person_id;
}

function create_new_schedule($person_id, $facility_name, $schedule_date)
{
    echo "inside create";
    global $mysqli;
    echo $facility_name;

    $query = "SELECT facility_id FROM publichealthcenter WHERE facility_name = '$facility_name'";
    $result = mysqli_query($mysqli, $query);
    if($result == false) {
        die("Error");
    }
    $result = $result->fetch_assoc();
    $facility_id = $result['facility_id'];

    $schedule_start = e($_POST['schedule_start_time']);
    $schedule_end = e($_POST['schedule_end_time']);

    $query = "INSERT INTO `work_schedule` (`person_id`, `facility_id`, `schedule_date`, `schedule_start`, `schedule_end`) 
                            VALUES ('$person_id', '$facility_id', '$schedule_date', '$schedule_start', '$schedule_end')";
    $mysqli->query($query);
    $mysqli->close();

    return$person_id;
}


function displaySchedules($table_name, $id){
    global $mysqli;

    $query = "SELECT COUNT(*) AS RowCnt FROM $table_name";
    $result = mysqli_query($mysqli, $query);

    if($result != false) {

        $query = "SELECT 
                    `schedule_date`     AS      `Shift Date`,
                    `schedule_start`    AS      `Shift START`,
                    `schedule_end`      AS      `Shift END`,
                    `facility_name`     AS      `Facility Name`,         
                    `person_id`, `facility_id`, `pkey1`, `pkey2`, `pkey3`, `screenName`
                FROM {$table_name} 
                WHERE `person_id` = '$id'";

        $result = mysqli_query($mysqli, $query);


        //$fields_num = mysqli_field_count($mysqli);

        while (($row = $result->fetch_assoc()) !== null) {
            $data[] = $row;
        }

        if (@$data !== null) {
            @$colNames = array_keys(reset($data));

            echo "<table class='table'>";
            echo "<thead>";

            foreach ($colNames as $colName) {
                if ($colName != "person_id") {
                    if ($colName != "facility_id") {
                        if ($colName != "pkey1") {
                            if ($colName != "pkey2") {
                                if ($colName != "pkey3") {
                                    if ($colName != "screenName") {
                                        echo "<th>$colName</th>";
                                    }
                                }
                            }
                        }
                    }
                }
            }

            echo "</thead>";
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($colNames as $colName) {
                    if ($colName != "person_id") {
                        if ($colName != "facility_id") {
                            if ($colName != "pkey1") {
                                if ($colName != "pkey2") {
                                    if ($colName != "pkey3") {
                                        if ($colName != "screenName") {
                                            echo "<td>" . $row[$colName] . "</td>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                echo "<td><a href=" . @$row['screenName'] . "_view.php?" . @$row['pkey1'] . "&" . $row['pkey2'] . "&" . @$row['pkey3'] . ">edit</a>";

                echo "</tr>";
            }
        }

        mysqli_free_result($result);
        $mysqli->close();
    }else{
        echo "Nothing to display";
    }
}

function displayWorkers($table_name){
    global $mysqli;
    $query = "SELECT COUNT(*) AS RowCnt FROM $table_name";
    $result = mysqli_query($mysqli, $query);

    if($result != false) {
        $query = "SELECT 
                `person_id`         AS  `ID`,
                `first_name`        AS  `First Name`, 
                `last_name`         AS  `Last Name`,
                `is_health_worker`  AS  `Is Health Worker`, 
                `pkey1`, `screenName`
FROM {$table_name}";

        $result = mysqli_query($mysqli, $query);

        while (($row = $result->fetch_assoc()) !== null) {
            $data[] = $row;
        }

        if ( @$data!==null) {
            @$colNames = array_keys(reset($data));

            echo "<table class=table>";
            echo "<thead>";

            foreach ($colNames as $colName) {
                if ($colName != "pkey1") {
                    if ($colName != "screenName") {
                        echo "<th>$colName</th>";
                    }
                }
            };
            echo "</thead>";
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($colNames as $colName) {
                    if ($colName != "pkey1") {
                        if ($colName != "screenName") {
                            echo "<td>" . $row[$colName] . "</td>";
                        }

                    }
                }
                echo "<td><a href=" . @$row['screenName'] . "_view.php?" . @$row['pkey1'] .">view</a>";


                echo "</tr>";
            }
        }

        mysqli_free_result($result);
        $mysqli->close();
    }
}

if(isset($_POST['get_list_workers_by_facility'])) {
    echo "Hellow World";
}

function displayWorkersByFacility($table_name){
    if(isset($_POST['facility_name'])) {
        $facility_name = $_POST['facility_name'];
        global $mysqli;
        $query = "SELECT COUNT(*) AS RowCnt FROM $table_name WHERE facility_name = '$facility_name'" ;
        $result = mysqli_query($mysqli, $query);

        if($result != false) {
            $query = "SELECT 
                `person_id`         AS  `ID`,
                `first_name`        AS  `First Name`, 
                `last_name`         AS  `Last Name`,
                `is_health_worker`  AS  `Is Health Worker`, 
                `pkey1`, `screenName`, `facility_name` AS `Facility Name`
FROM {$table_name} WHERE facility_name = '$facility_name'";

            $result = mysqli_query($mysqli, $query);

            while (($row = $result->fetch_assoc()) !== null) {
                $data[] = $row;
            }

            if ( @$data!==null) {
                @$colNames = array_keys(reset($data));

                echo "<table class=table>";
                echo "<thead>";

                foreach ($colNames as $colName) {
                    if ($colName != "pkey1") {
                        if ($colName != "screenName") {
                            echo "<th>$colName</th>";
                        }
                    }
                };
                echo "</thead>";
                foreach ($data as $row) {
                    echo "<tr>";
                    foreach ($colNames as $colName) {
                        if ($colName != "pkey1") {
                            if ($colName != "screenName") {
                                echo "<td>" . $row[$colName] . "</td>";
                            }
                        }
                    }
                    echo "<td><a href=" . @$row['screenName'] . "_view.php?" . @$row['pkey1'] .">view</a>";


                    echo "</tr>";
                }
            }

            mysqli_free_result($result);
            $mysqli->close();
        }
    }

}

function getPublicHealthCenters(){
    global $mysqli;
    $query = "SELECT facility_name from publichealthcenter";
    $result = mysqli_query($mysqli, $query);
    //$numRows=mysqli_num_rows($result);
    $public_health_centers = array();
    while ($row = $result->fetch_row()) {
        echo  "<option value='$row[0]'>$row[0]</option>";
        $public_health_centers[]=$row;
    }

    //$mysqli->close();

    return  $public_health_centers;
}
