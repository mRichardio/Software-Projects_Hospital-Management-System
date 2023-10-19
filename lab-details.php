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
    <title>HMS | Lab Result Details</title>
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
                    <div class="dash-header">
                        <h2>Lab Result Details</h2>
                    </div>
                    <div class="dash-content">
                        <?php
                            require_once("includes/db_conn.php");
                            $getLabID = $_GET["labID"];
                            $stmt = $conn->prepare( "SELECT * FROM labresult 
                                                        INNER JOIN labresultpatientemployeelink ON (labresult.LabResultID=labresultpatientemployeelink.LabResultID)
                                                        INNER JOIN patient ON (labresultpatientemployeelink.PatientID=patient.PatientID)
                                                        INNER JOIN gender ON (patient.GenderID=gender.GenderID)
                                                        INNER JOIN ward ON (patient.WardID=ward.WardID)
                                                        WHERE labresultpatientemployeelink.LabResultPatientEmployeeLinkID =  ?" );
                            $stmt->bind_param( 'i', $getLabID );
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $obj = $result->fetch_object();
                        ?>
                        <?php
                            echo "<div class=\"patient-container\">";
                            echo "<h2>{$obj->PatientFirstName} {$obj->PatientLastName}</h2>";
                            echo "<div class=\"patient-details\">";
                            echo "<h5>Patient Details</h5>";
                            echo "<h6>ID Number: {$obj->PatientID}</h6>";
                            echo "<h6>Date of Birth: {$obj->PatientDoB}</h6>";
                            echo "<h6>Gender: {$obj->GenderTitle}</h6>";
                            echo "<h6>Ward: {$obj->WardName}</h6>";
                            echo "</div>";
                            echo "<div class=\"patient-personal-details\">";
                            echo "<h5>Lab Results</h5>";
                            echo "<h6>Result: {$obj->ResultType}</h6>";
                            echo "<h6>Date: {$obj->ResultDate}</h6>";
                            echo "<h6>Details:</h6> <p>{$obj->ResultDetails}</p>";
                            echo "</div>";
                            echo "<div class=\"patient-buttons\">";
                            echo "<a class=\"lab\" href=\"patient-details.php?patID={$obj->PatientID}\">Back</a>";
                            echo "</div>";
                            echo "</div>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>