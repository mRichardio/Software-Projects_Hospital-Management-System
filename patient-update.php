<?php
include("session\session2.php");

 $path = "login.php"; //this path is to pass to checkSession function from session.php 
     
 session_start(); //must start a session in order to use session in this page.

 if (!isset($_SESSION['EmpName'])){
     session_unset();
     session_destroy();
     header("Location:".$path);//return to the login page
 }

 $user = $_SESSION['EmpName']; //this value is obtained from the login page when the user is verified
 $userID = $_SESSION['EmpID']; //this value is obtained from the login page when the user is verified
 checkSession ($path); //calling the function from session.php

?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php
include("includes/db_conn.php");
?>
<?php
        $getPatientID = $_GET["patID"];
        $stmt = $conn->prepare( "SELECT * FROM patient WHERE PatientID=$getPatientID" );
        $stmt->execute();
        $result = $stmt->get_result();
        $obj = $result->fetch_object();

        $pat_id = $obj->PatientID;
        $pat_firstname = $obj->PatientFirstName;
        $pat_lastname = $obj->PatientLastName;
        $pat_dob = $obj->PatientDoB;
        $pat_contact = $obj->PatientContactNumber;
        $pat_address = $obj->PatientAddress;
    ?>
<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Update Patient: <?php echo $pat_firstname;?> <?php echo $pat_lastname; ?></h2><br>
    </main>
</div>
<div class="row">
    <div class="col-6">
        <form method="post" action="sql/sql-patient-update.php">
            <div class="form-group col-md-6">
                <label class="control-label labelFont">ID</label>
                <input class="form-control" type="text" name="pat_id" required value="<?php echo $pat_id; ?>" readonly>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">First Name</label>
                <input class="form-control" type="text" name="pat_first_name" required value="<?php echo $pat_firstname; ?>">
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Last Name</label>
                <input class="form-control" type="text" name="pat_last_name" required value="<?php echo $pat_lastname; ?>">
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Date of Birth</label>
                <input class="form-control" type="date" name="pat_birth_date" required value="<?php echo $pat_dob; ?>">
            </div>

            <div class="form-group col-md-4">
                <?php include_once('dd_list/patient-gender-update.php'); ?>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Phone Number</label>
                <input class="form-control" type="text" name="pat_phone_number" required value="<?php echo $pat_contact; ?>">
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Address</label>
                <input class="form-control" type="text" name="pat_address" required value="<?php echo $pat_address; ?>">
            </div>

            <div class="form-group col-md-4">
                <?php include_once('dd_list/patient-ward-update.php'); ?>
            </div>

            <div class="form-group col-md-4">
                <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                <a href="patient-list.php">Cancel</a>
            </div>
        </form>
    </div>
</div>
</main>