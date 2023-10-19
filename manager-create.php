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
        <h2>New Manager Form</h2><br>
    </main>
</div>
<div class="row">
    <div class="col-6">
        <form method="post" action="sql/sql-manager-create.php">
            <div class="form-group col-md-6">
                <label class="control-label labelFont">First Name</label>
                <input class="form-control" type="text" name="emp_first_name" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Last Name</label>
                <input class="form-control" type="text" name="emp_last_name" required>
            </div>

            <div class="form-group col-md-4">
                <?php include_once('dd_list/role-manager.php'); ?>
            </div>

            <div class="form-group col-md-4">
                <?php include_once('dd_list/speciality.php'); ?>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Date of Birth</label>
                <input class="form-control" type="date" name="birth_date" required>
            </div>

            <div class="form-group col-md-4">
                <?php include_once('dd_list/gender.php'); ?>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Phone Number</label>
                <input class="form-control" type="text" name="phone_number" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Email</label>
                <input class="form-control" type="email" name="email" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Address</label>
                <input class="form-control" type="text" name="emp_address" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Hire Date</label>
                <input class="form-control" type="date" name="hire_date" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Login Username</label>
                <input class="form-control" type="text" name="login_username" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label labelFont">Login Password</label>
                <input class="form-control" type="text" name="login_password" required>
            </div>

            <div class="form-group col-md-4">
                <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                <a href="employee-list.php">Cancel</a>
            </div>
        </form>
    </div>
</div>
</main>