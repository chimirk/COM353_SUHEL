<?php
include '../UICommon/template.php' ;
include 'healthworker_functions.php' ;
if(isset($_GET['person_id'])) {
    $q = $_GET['person_id'];
} elseif (isset($_POST['person_id'])) {
    $q = $_POST['person_id'];
}
if(isset($_GET['facility_id'])){
    $r = $_GET['facility_id'];
} elseif (isset($_POST['facility_id'])) {
    $r = $_POST['facility_id'];
}
if(isset($_GET['schedule_date'])){
    $t = $_GET['schedule_date'];
} elseif (isset($_POST['schedule_date'])) {
    $t = $_POST['schedule_date'];
}



//echo $q;
//echo $r;
$QueryToRun="SELECT * FROM healthworker_det_schedule_view WHERE person_id='$q' AND facility_id ='$r' AND schedule_date = '$t'";
$screenData=getBulkData($QueryToRun);

$QueryToRun2="SELECT * FROM healthworker_basicinfo_view WHERE person_id='$q'";
$screenData2=getBulkData($QueryToRun2);


?>

<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <?php
            include '../admin/admin_menu.php' ;
            ?>
        </div>

        <div class="col-md-4">
            <div class="form-horizontal">
                <hr>
                <h4 style="text-transform: uppercase">
            <span class="badge badge-light">
                Detailed Work Schedule of <?php
                $name = $screenData2['first_name']." ".$screenData2['last_name'];
                echo $name; ?></span>
                </h4>
            </div>

            <hr>

            <form id = "first" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="person_id">
                        <!--ID-->
                    </label>
                    <input type="hidden" class="form-control" id="person_id"  name="person_id"  value="<?php echo $screenData['person_id']?>" readonly/>
                </div>
                <div class="form-group">
                    <label for="facility_id">
                        <!--                        Facility ID
                        -->                    </label>
                    <input type="hidden" class="form-control" id="facility_id" name ="facility_id" value="<?php echo $screenData['facility_id']?>" readonly/>
                </div>
                <div class="form-group">
                    <label for="schedule_date">
                        Schedule Date
                    </label>
                    <input type="date" class="form-control" id="schedule_date" name ="schedule_date" value="<?php echo $screenData['schedule_date']?>" readonly/>
                </div>
                <div class="form-group">
                    <label for="schedule_start_time">
                        Schedule Start Time
                    </label>
                    <input type="time" class="form-control" id="schedule_start_time" name ="schedule_start_time"
                           value="<?php echo $screenData['schedule_start']?>" placeholder="hh:mm" required/>
                </div>
                <div class="form-group">
                    <label for="schedule_end_time">
                        Schedule End Time
                    </label>
                    <input type="time" class="form-control" id="schedule_end_time" name ="schedule_end_time"
                           value="<?php echo $screenData['schedule_end']?>" placeholder="hh:mm" required/>
                </div>
            </form>

            <button form="first" type="submit" class="btn btn-primary" name="update_schedule">Save</button>
            <button form = "second" type="submit" class="btn btn-primary" name="delete_schedule">Delete</button>

            <form id="second" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="person_id" value="<?php echo $screenData['person_id']?>">
                <input type="hidden" name="facility_id" value="<?php echo $screenData['facility_id']?>">
                <input type="hidden" name="schedule_date" value="<?php echo $screenData['schedule_date']?>">
            </form>

        </div>
    </div>

</body>
</html>
