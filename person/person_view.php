<?php
include '../UICommon/template.php' ;
include 'person_functions.php' ;
$q = $_GET['person_id'];
//echo $q;
$QueryToRun="SELECT * FROM person_det_view WHERE person_id='$q'";

//echo $QueryToRun;
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

        <div class="col-md-4">
            <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button type="submit" class="btn btn-primary" name="add_new_person">
                    add new person
                </button>

                <div class="form-group">
                    <label for="person_id">
                        Person No
                    </label>
                    <input type="text" class="form-control" id="person_id"  name="person_id"  value="<?php echo $screenData['person_id']?>" readonly/>
                </div>

                <div class="form-group">
                    <label for="first_name">
                        First Name
                    </label>
                    <input type="text" class="form-control" id="first_name"  name ="first_name" value="<?php echo $screenData['first_name']?>"/>
                </div>
                <div class="form-group">
                    <label for="last_name">
                        Last Name
                    </label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $screenData['last_name']?>"/>
                </div>
                <div class="form-group">
                    <label for="DOB">
                        Date of Birth
                    </label>
                    <input type="date" class="form-control" id="DOB" name ="dob" value="<?php echo $screenData['dob']?>"/>
                </div>
                <div class="form-group">
                    <label for="medicare_number">
                        Medicare Number
                    </label>
                    <input type="text" class="form-control" id="medicare_number" name ="medicare_number" value="<?php echo $screenData['medicare_number']?>"/>
                </div>

                <div class="form-group">
                    <label for="is_health_worker">
                        Health Worker??
                    </label>
                    <input type="text" class="form-control" id="is_health_worker" name ="is_health_worker" value="<?php echo $screenData['is_health_worker']?>"/>
                </div>


                <div class="form-group">
                    <label for="related_person_no">
                        Related Person No
                    </label>
                    <select name="related_person_no" id="related_person_no">
                        <?php echo $allpersons=getRelatedPerson();
                        ?>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary" name="update_person_btn" >
                    Save Person
                </button>
                <button type="submit" class="btn btn-primary" name="delete_person">
                    Delete Person
                </button>
        </div>
        <!-- Second column-->
        <div class="col-md-4">



            <div class="form-group">
                <label for="email_address">
                    Email address
                </label>
                <input type="email" class="form-control" id="email_address" name="email_address" value="<?php echo $screenData['email_address']?>"/>
            </div>
            <div class="form-group">
                <label for="phone_number">
                    Phone Number
                </label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $screenData['phone_number']?>"/>
            </div>
            <div class="form-group">
                <label for="street_address">
                    Street Address
                </label>
                <input type="text" class="form-control" id="street_address" name="street_address"  value="<?php echo $screenData['street_address']?>"/>
            </div>
            <div class="form-group">
                <label for="province">
                    Province
                </label>
                <input type="text" class="form-control" id="province" name="province" value="<?php echo $screenData['province']?>"/>
            </div>
        </div>

        </form>



        <div class="col-md-12">
            <span class="badge badge-default">RELATED PERSONS</span>
            <table class="table">
                <?php
                //echo "<b>Related Persons</b>";
                $table_name = "persons_view where related_person_no='$screenData[person_id]'";
                displayTable($table_name);
                ?>

            </table>
        </div>


        <div class="col-md-12">
            <span class="badge badge-default">TEST HISTORY</span>
            <table class="table">
                <?php
                //echo "<b>Test History</b>";
                $table_name = "diagnostic where person_id='$screenData[person_id]'";
                displayTable($table_name);
                ?>

            </table>
        </div>


        <div class="col-md-12">
            <span class="badge badge-default">MESSAGES HISTORY</span>
            <table class="table">
                <?php
                //echo "<b>Message History</b>";
                $table_name = "MESSAGES WHERE PERSON_ID='$screenData[person_id]'";
                displayTable($table_name);
                ?>

            </table>
        </div>

    </div>


</body>

</html>

