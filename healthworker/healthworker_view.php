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
                <input type="hidden" name="person_id" value="<?php echo $screenData['person_id']?>">
                <!--<input type="hidden" name="facility_id" value="<?php /*echo $screenData['facility_id']*/?>">-->
                <div class="form-group">
                    <label for="schedule_date">
                        <strong>Choose Schedule Date</strong>
                    </label>
                    <input type="text" name="schedule_date" class="form-control" id="schedule_date" placeholder="dd-mm-yyyy">
                </div>
                <div class="form-group">
                    <label for="facility_name">
                        Choose Public Health Center
                    </label>
                    <select name="facility_name" id="facility_name" >
                        <?php echo getPublicHealthCenters();
                        ?>
                    </select>
                </div>
            </form>

            <button form="new_schedule" type="submit" class="btn btn-primary" name="create_new_schedule">Add New Schedule</button>

            <hr>

            <br>

            <h4 style="text-transform: uppercase">
            <span class="badge badge-light">
                Work Schedules of <?php
                @$name = @$screenData['first_name']." ".@$screenData['last_name'];
                echo @$name?></span>
            </h4>
            <table class="table">
                <?php
                $q = $_GET['person_id'];
                $QueryToRun="SELECT * FROM healthworker_det_schedule_view WHERE person_id='$q'";
                $screenData=getBulkData($QueryToRun);
                $table_name = $screenData['screenName']."_view";
                displaySchedules($table_name);
                ?>
            </table>
        </div>


</body>
</html>

