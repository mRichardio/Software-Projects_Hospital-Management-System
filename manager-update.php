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
        $getEmployeeID = $_GET["empID"];
        $stmt = $conn->prepare( "SELECT * FROM employee WHERE EmployeeID=$getEmployeeID" );
        $stmt->execute();
        $result = $stmt->get_result();
        $obj = $result->fetch_object();
        
        $emp_id = $obj->EmployeeID;
        $emp_firstname = $obj->EmployeeFirstName;
        $emp_lastname = $obj->EmployeeLastName;
        $emp_dob = $obj->EmployeeDoB;
        $emp_contact = $obj->EmployeeContactNumber;
        $emp_email = $obj->EmployeeEmail;
        $emp_address = $obj->EmployeeAddress;
        $emp_hiredate = $obj->EmployeeHireDate;
    ?>
<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Update Manager: <?php echo $emp_firstname;?> <?php echo $emp_lastname; ?></h2><br>
    </main>
</div>
<div class="row">
    <div class="col-6">
        <form method="post" action="sql/sql-manager-update.php">
            <div class="form-group col-md-6">
                <label class="control-label labelFont">ID</label>
                <input class="form-control" type="text" name="emp_id" required value="<?php echo $emp_id; ?>" readonly>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">First Name</label>
                <input class="form-control" type="text" name="emp_first_name" required value="<?php echo $emp_firstname; ?>">
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Last Name</label>
                <input class="form-control" type="text" name="emp_last_name" required value="<?php echo $emp_lastname; ?>">
            </div>

            <div class="form-group col-md-4">
                <?php include_once('dd_list/role-manager-update.php'); ?>
            </div>

            <div class="form-group col-md-4">
                <?php include_once('dd_list/speciality-update.php'); ?>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Date of Birth</label>
                <input class="form-control" type="date" name="birth_date" required value="<?php echo $emp_dob; ?>">
            </div>

            <div class="form-group col-md-4">
                <?php include_once('dd_list/employee-gender-update.php'); ?>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Phone Number</label>
                <input class="form-control" type="text" name="phone_number" required value="<?php echo $emp_contact; ?>">
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Email</label>
                <input class="form-control" type="email" name="email" required value="<?php echo $emp_email; ?>">
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Address</label>
                <input class="form-control" type="text" name="emp_address" required value="<?php echo $emp_address; ?>">
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Hire Date</label>
                <input class="form-control" type="date" name="hire_date" required value="<?php echo $emp_hiredate; ?>">
            </div>

            <div class="form-group col-md-4">
                <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                <a href="employee-list.php">Cancel</a>
            </div>
        </form>
    </div>
</div>
</main>