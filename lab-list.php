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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS | Lab Results List</title>
    <?php include("includes/bootstrap.php");?>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
    <div class="container-fluid h-100 w-100">
        <div class="row h-100">
            <div class="col-3 g-0 m-0 p-0">
                <div class="sidebar h-100">
                    <?php include("includes/navbar.php");?>
                </div>
            </div>
            <?php
                $getPatientID = $_GET['patID'];
                require_once("includes/db_conn.php");
                $queryEmployee = "SELECT * FROM labresult
                                    INNER JOIN labresultpatientemployeelink ON (labresultpatientemployeelink.LabResultID=labresult.LabResultID)
                                    INNER JOIN patient ON (labresultpatientemployeelink.PatientID=patient.PatientID)
                                    INNER JOIN employee ON (labresultpatientemployeelink.EmployeeID=employee.EmployeeID)
                                    WHERE labresultpatientemployeelink.PatientID='$getPatientID'
                                    ORDER BY labresult.LabResultID ASC LIMIT 0,100";
                $resultEmployee = $conn->query( $queryEmployee );
            ?>
            <div class="col-9">
                <div class="main-content">
                    <div class="staff-header">
                        <h2>Lab Results List</h2>
                    </div>
                    <div class="staff-content">
                        <div class="list-toolbar">
                            <?php if($userRole == 1 || $userRole == 6) {
                                    echo "<a class=\"new-employee\" href=\"lab-create.php?patID={$getPatientID}\">New Lab Result</a>";
                            } else {
                            } 
                        ?>
                        </div>
                        <div class ="listing">
                            <table>
                                <tr>
                                    <th></th>
                                    <th>Result Type</th>
                                    <th>Result Date</th>
                                    <th>Employee</th>
                                    <th>Action</th>
                                </tr>
                            <?php if($userRole == 1 || $userRole == 6 || $userRole == 4) {
                                while ($obj = $resultEmployee -> fetch_object()) {
                                    echo "<tr>";
                                    echo "<td><a class=\"go\" href=\"lab-details.php?labID={$obj->LabResultPatientEmployeeLinkID}\">Details</a></td>";
                                    echo "<td>{$obj->ResultType}</a></td>";
                                    echo "<td>{$obj->ResultDate}</td>";
                                    echo "<td>{$obj->EmployeeFirstName} {$obj->EmployeeLastName}</td>";
                                    echo "<td><a class=\"update\" href=\"lab-update.php?labID={$obj->LabResultPatientEmployeeLinkID}\">Update</a><br><a class=\"delete\" href=\"sql/sql-lab-delete.php?labID={$obj->LabResultPatientEmployeeLinkID}&patID={$getPatientID}\">Delete</a></td>";
                                    echo "</tr>";
                                }
                                } else {
                                    while ($obj = $resultEmployee -> fetch_object()) {
                                        echo "<tr>";
                                        echo "<td><a class=\"go\" href=\"lab-details.php?labID={$obj->LabResultPatientEmployeeLinkID}\">Details</a></td>";
                                        echo "<td>{$obj->ResultType}</a></td>";
                                        echo "<td>{$obj->ResultDate}</td>";
                                        echo "<td>{$obj->EmployeeFirstName} {$obj->EmployeeLastName}</td>";
                                        echo "<td></td>";
                                        echo "</tr>";
                                    }
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>