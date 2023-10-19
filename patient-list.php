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
    <title>HMS | Patient List</title>
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
            <div class="col-9">
                <div class="main-content">
                    <div class="patient-header">
                        <h2>Patient List</h2>
                    </div>
                    <div class="patient-content">
                        <div class="list-toolbar">
                        <?php if($userRole == 4 || $userRole == 5) {
                                    echo "<a class=\"new-employee\" href=\"patient-create.php\">New Patient</a>";
                                    echo "<a href=\"patient-search.php\">Search</a>";
                            } else if($userRole == 3) {
                                        echo "<a class=\"new-employee\" href=\"patient-create.php\">New Patient</a>";
                                        echo "<a href=\"patient-search.php\">Search</a>";    
                            } else {
                                echo "<a href=\"patient-search.php\">Search</a>";
                            } 
                        ?>
                        </div>
                        <div class ="listing">
                            <table>
                                <tr>
                                    <th></th>
                                    <th>Patient ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Contact Number</th>
                                    <th>Ward</th>
                                    <th>Action</th>
                                </tr>
                            <?php
                                require_once("includes/db_conn.php");
                                $queryPatients = "SELECT patient.PatientID, patient.PatientFirstName, patient.PatientLastName, patient.PatientContactNumber, patient.WardID, ward.WardName FROM patient
                                                INNER JOIN ward ON (patient.WardID=ward.WardID) ORDER BY PatientID DESC LIMIT 0,100";
                                $resultPatients = $conn->query( $queryPatients );
                            ?>
                            <?php if($userRole == 4 || $userRole == 5) {
                                while ($obj = $resultPatients -> fetch_object()) {
                                    echo "<tr>";
                                    echo "<td><a class=\"go\" href=\"patient-details.php?patID={$obj->PatientID}\">Select</a></td>";
                                    echo "<td>{$obj->PatientID}</a></td>";
                                    echo "<td>{$obj->PatientFirstName}</td>";
                                    echo "<td>{$obj->PatientLastName}</td>";
                                    echo "<td>{$obj->PatientContactNumber}</td>";
                                    echo "<td>{$obj->WardName}</td>";
                                    echo "<td><a class=\"update\" href=\"patient-update.php?patID={$obj->PatientID}\">Update</a><br><a class=\"delete\" href=\"sql/sql-patient-delete.php?patID={$obj->PatientID}\">Delete</a></td>";
                                    echo "</tr>";
                                }
                            } else if($userRole == 2) {
                                while ($obj = $resultPatients -> fetch_object()) {
                                    echo "<tr>";
                                    echo "<td><a class=\"go\" href=\"patient-details.php?patID={$obj->PatientID}\">Select</a></td>";
                                    echo "<td>{$obj->PatientID}</a></td>";
                                    echo "<td>{$obj->PatientFirstName}</td>";
                                    echo "<td>{$obj->PatientLastName}</td>";
                                    echo "<td>{$obj->PatientContactNumber}</td>";
                                    echo "<td>{$obj->WardName}</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                    }
                            } else if($userRole == 1 || $userRole == 6) {
                                while ($obj = $resultPatients -> fetch_object()) {
                                    echo "<tr>";
                                    echo "<td><a class=\"go\" href=\"patient-details.php?patID={$obj->PatientID}\">Select</a></td>";
                                    echo "<td>{$obj->PatientID}</a></td>";
                                    echo "<td>{$obj->PatientFirstName}</td>";
                                    echo "<td>{$obj->PatientLastName}</td>";
                                    echo "<td>{$obj->PatientContactNumber}</td>";
                                    echo "<td>{$obj->WardName}</td>";
                                    echo "<td><a class=\"update\" href=\"patient-update.php?patID={$obj->PatientID}\">Update</a></td>";
                                    echo "</tr>";
                                    }
                            } else if($userRole == 3) {
                                while ($obj = $resultPatients -> fetch_object()) {
                                    echo "<tr>";
                                    echo "<td><a class=\"go\" href=\"patient-details.php?patID={$obj->PatientID}\">Select</a></td>";
                                    echo "<td>{$obj->PatientID}</a></td>";
                                    echo "<td>{$obj->PatientFirstName}</td>";
                                    echo "<td>{$obj->PatientLastName}</td>";
                                    echo "<td>{$obj->PatientContactNumber}</td>";
                                    echo "<td>{$obj->WardName}</td>";
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