<?php
include '../UICommon/template.php' ;
include 'healthworker_functions.php' ;
$q = $_GET['person_id'];
$QueryToRun="SELECT * FROM healthworker_basicinfo_view WHERE person_id='$q'";
$screenData=getBulkData($QueryToRun);

?>

<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <?php
            include '../admin/admin_menu.php' ;
            ?>

        </div>
        <div>
            <form id="new_schedule" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="person_id"> <!--person id--></label>
                <input type="hidden" name="person_id" id="person_id" value="<?php echo $q?>">
                <label for="facility_id"> <!--facility id--></label>
                <input type="hidden" name="facility_id" id="facility_id" value="<?php echo $screenData['facility_id'];?>"/>
                <div class="form-group">
                    <label for="schedule_date">
                        <strong>Choose Schedule Date</strong>
                    </label>
                    <input type="date" name="schedule_date" class="form-control" id="schedule_date" placeholder="dd-mm-yyyy">
                </div>

                <div class="form-group">
                    <label for="schedule_start_time">
                        Schedule Start Time
                    </label>
                    <input type="time" class="form-control" id="schedule_start_time" name ="schedule_start_time"
                           required/>
                </div>
                <div class="form-group">
                    <label for="schedule_end_time">
                        Schedule End Time
                    </label>
                    <input type="time" class="form-control" id="schedule_end_time" name ="schedule_end_time" required/>
                </div>
                <div class="form-group">
                    <label for="facility_name">
                        Facility Name
                    </label>
                    <input type="text" class="form-control" id="facility_name" name ="facility_name"  value=
                    "<?php
                    $facility_name= $screenData['facility_name'];
                    echo $facility_name;
                    ?>
                        " required readonly/>
                </div>
                <!--<div class="form-group">
                    <label for="facility_name">
                        Choose Public Health Center
                    </label>
                    <input type="text" class="form-control" id="facility_name">
                    <select name="facility_name" id="facility_name" >
                        <?php /*echo @getPublicHealthCenters();
                        */?>
                    </select>
                </div>-->
            </form>

            <button form="new_schedule" type="submit" class="btn btn-primary" name="create_new_schedule">Add New Schedule</button>

            <hr>

            <br>

            <h4 style="text-transform: uppercase">
            <span class="badge badge-light">
                Work Schedules of <?php
                if(isset($screenData['first_name']) AND isset($screenData['last_name'])) {
                    $name = $screenData['first_name'] . " " . $screenData['last_name'];
                    echo $name;
                }
                ?></span>

            </h4>
            <table class="table">
                <?php
                $table_name = 'healthworker_det_schedule_view';
                displaySchedules($table_name, $q);
                ?>
            </table>
        </div>





</body>
</html>
