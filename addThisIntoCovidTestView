<?php
include '../UICommon/template.php' ;
include 'covidtest_functions.php' ;
$q = $_GET['test_id'];
//echo $q;
$QueryToRun="SELECT * FROM diagnostic_det_view WHERE test_id=$q";
//echo $QueryToRun;
$screenData=getBulkData($QueryToRun);
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Main Sign-in Page</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>


<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <!-- First Columns is always the menu starts-->
    <div class="container-fluid">
        <div class="row">

            <!-- First Columns is always the menu ends-->
            <div class="col-md-2">
                <?php
                include '../admin/admin_menu.php';
                ?>
            </div>
            <!-- First Columns is always the menu ends-->

            <div class="form-group">
                <label for="test_id">
                    <!-- Test Id-->
                </label>
                <input type="hidden" class="form-control" id="test_id"  name="test_id"  value="<?php echo $screenData['test_id']?>" readonly/>
            </div>

            <!-- Second Columns starts-->
            <div class="col-md-4">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" style="text-transform: uppercase">Person Details</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Person ID</th>
                        <td><?php echo (isset($screenData['person_id'])) ? $screenData['person_id'] : null ?></td>
                    </tr>
                    <tr>
                        <th scope="row">First Name</th>
                        <td><?php echo (isset($screenData['first_name'])) ? $screenData['first_name'] : null ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Last Name</th>
                        <td><?php echo (isset($screenData['last_name'])) ? $screenData['last_name'] : null ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Date Of Birth</th>
                        <td><?php echo (isset($screenData['DOB'])) ? $screenData['DOB'] : null ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Medicare Number</th>
                        <td><?php echo (isset($screenData['medicare_number'])) ? $screenData['medicare_number'] : null ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Street Address</th>
                        <td><?php echo (isset($screenData['street_address'])) ? $screenData['street_address'] : null ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Province</th>
                        <td><?php echo (isset($screenData['province'])) ? $screenData['province'] : null ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Postal Code</th>
                        <td><?php echo (isset($screenData['postal_code'])) ? $screenData['postal_code'] : null ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td><?php echo (isset($screenData['ph_phone_number'])) ? $screenData['ph_phone_number'] : null ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?php echo (isset($screenData['email_address'])) ? $screenData['email_address'] : null ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Region Name</th>
                        <td><?php echo (isset($screenData['region_name'])) ? $screenData['region_name'] : null ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- Second Columns ends-->

            <!-- Third column starts-->
            <div class="col-md-4"">
            <table class="table">
                <tr>
                    <th style="text-transform: uppercase">Test Center Details</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Test Center Id</td>
                    <td><?php echo (isset($screenData['facility_id'])) ? $screenData['facility_id'] : null ?></td>
                </tr>
                <tr>
                    <td>Facility Name</td>
                    <td><?php echo (isset($screenData['facility_name'])) ? $screenData['facility_name'] : null ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo (isset($screenData['address'])) ? $screenData['address'] : null ?></td>
                </tr>
                <tr>
                    <td>Website</td>
                    <td><?php echo (isset($screenData['web_address'])) ? $screenData['web_address'] : null ?></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><?php echo (isset($screenData['ph_phone_number'])) ? $screenData['ph_phone_number'] : null ?></td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td><?php echo (isset($screenData['type'])) ? $screenData['type'] : null ?></td>
                </tr>
                <tr>
                    <td>Method of Acceptance</td>
                    <td><?php echo (isset($screenData['method_of_acceptance'])) ? $screenData['method_of_acceptance'] : null ?></td>
                </tr>
                <tr>
                    <td>Drive Through? </td>
                    <td><?php echo (isset($screenData['has_drive_through'])) ? $screenData['has_drive_through'] : null ?></td>
                </tr>
            </table>

            <table class="table">
                <tr>
                    <th style="text-transform: uppercase">Covid test Details</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Test Id</td>
                    <td><?php echo (isset($screenData['person_id'])) ? $screenData['test_id'] : null ?></td>
                </tr>
                <tr>
                    <td>Testing Date</td>
                    <td><?php echo (isset($screenData['test_date'])) ? $screenData['test_date'] : null ?></td>
                </tr>
                <tr>
                    <td>Tested By Person ID</td>
                    <td><?php echo (isset($screenData['tested_by'])) ? $screenData['tested_by'] : null ?></td>
                </tr>
                <tr>
                    <td>Tested By Person Name</td>
                    <td><?php echo (isset($screenData['tested_by'])) ? getHealthWorkerNameById($screenData['tested_by']) : null ?></td>
                </tr>
                <tr>
                    <td>Result Date</td>
                    <td><?php echo (isset($screenData['result_date'])) ? $screenData['result_date'] : null ?></td>
                </tr>
                <tr>
                    <td>Result</td>
                    <td><?php echo (isset($screenData['result'])) ? $screenData['result'] : null ?></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary" name="edit_covidtest_report">
                Edit this Report
            </button>
        </div>
        <!-- Third column ends-->
    </div>
</form>

<hr>
<div style="margin-top: 30px">
    <h4>
        Reported Symptoms during 14 days follow up period.
    </h4>
    <table class="table">
        <?php
        $patient_id = $screenData['person_id'];
        $table_name = 'symptoms_det_table_view';
        displaysSymptoms($table_name, $patient_id);
        ?>
    </table>
</div>

</body>

</html>
