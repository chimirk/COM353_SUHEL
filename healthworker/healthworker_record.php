<?php
include 'healthworker_functions.php' ;
include '../UICommon/template.php' ;
?>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <?php
            include '../admin/admin_menu.php' ;
            ?>
        </div>
        <div id="list_workers_by_facility" class="col-md-4">
            <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <div class="form-group">
                    <label for="facility_name">
                        Choose Public Health Center
                    </label>
                    <select name="facility_name" id="facility_name" >
                        <?php
                        echo "<option></option>";
                        echo getPublicHealthCenters();
                        ?>
                    </select>
                    <button type="submit" class="btn btn-primary" name="get_list_workers_by_facility">Display Workers By Facility</button>
            </form>
            <?php
                    $table_name = "healthworker_rec_view";
                    displayWorkersByFacility($table_name);
            ?>
            <?php
            /*$table_name = "healthworker_rec_view";
            displayWorkers($table_name);*/
            ?>
        </div>
    </div>
</div>


</body>
</html>
