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
<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>New Lab Result Form:</h2><br>
    </main>
</div>
<?php $getPatientID = $_GET['patID'];?>
<div class="row">
    <div class="col-6">
    <form method="post" action=<?php echo "\"sql/sql-lab-create.php?patID={$getPatientID}\"" ?>>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Patient ID</label>
                <input class="form-control" type="text" name="pat_id" required value="<?php echo $getPatientID;?>" readonly>
            </div>

            <div class="form-group col-md-4">
                <?php include_once('dd_list/lab.php'); ?>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Result Date</label>
                <input class="form-control" type="date" name="result_date" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Employee</label>
                <input class="form-control" type="text" name="emp_id" required value="<?php echo $userID;?>" readonly>
            </div>

            <div class="form-group col-md-4">
                <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                <?php echo "<a href=\"lab-list.php?patID={$getPatientID}\">Cancel</a>"?>
            </div>
        </form>
    </div>
</div>
</main>