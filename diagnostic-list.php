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
<?php
    $getPatientID = $_GET["patID"];
    require_once("includes/db_conn.php");
    $queryEmployee = "SELECT * FROM diagnostic
                    INNER JOIN diagnosticpatientemployeelink ON (diagnosticpatientemployeelink.DiagnosticID=diagnostic.DiagnosticID)
                    INNER JOIN employee ON (diagnosticpatientemployeelink.EmployeeID=employee.EmployeeID)  
                    WHERE PatientID ='$getPatientID'
                    ORDER BY diagnostic.DiagnosticID ASC LIMIT 0,100";
    $resultEmployee = $conn->query( $queryEmployee );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS | Diagnostic List</title>
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
                    <div class="staff-header">
                        <h2>Diagnostic List</h2>
                    </div>
                    <div class="staff-content">
                        <div class="list-toolbar">
                        <?php if($userRole == 1 || $userRole == 6) {
                                    echo "<a class=\"new-employee\" href=\"diagnostic-create.php?patID={$getPatientID}\">New Diagnostic</a>";   
                            } else {

                            } 
                        ?>
                        </div>
                        <div class ="listing">
                            <table>
                                <tr>
                                    <th></th>
                                    <th>Result</th>
                                    <th>Treatment</th>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Action</th>
                                </tr>
                            <?php if($userRole == 1 || $userRole == 6 || $userRole == 4) {
                                while ($obj = $resultEmployee -> fetch_object()) {
                                    echo "<tr>";
                                    echo "<td><a class=\"go\" href=\"diagnostic-details.php?diagID={$obj->DiagnosticPatientEmployeeLinkID}\">Details</a></td>";
                                    echo "<td>{$obj->DiagnosticResult}</a></td>";
                                    echo "<td>{$obj->DiagnosticTreatmentType}</td>";
                                    echo "<td>{$obj->DiagnosticDate}</td>";
                                    echo "<td>{$obj->EmployeeFirstName} {$obj->EmployeeLastName}</td>";
                                    echo "<td><a class=\"update\" href=\"diagnostic-update.php?diagID={$obj->DiagnosticPatientEmployeeLinkID}\">Update</a><br><a class=\"delete\" href=\"sql/sql-diagnostic-delete.php?diagID={$obj->DiagnosticPatientEmployeeLinkID}&patID={$getPatientID}\">Delete</a></td>";
                                    echo "</tr>";
                                }
                                } else {
                                    while ($obj = $resultEmployee -> fetch_object()) {
                                        echo "<tr>";
                                        echo "<td><a class=\"go\" href=\"diagnostic-details.php?diagID={$obj->DiagnosticPatientEmployeeLinkID}\">Details</a></td>";
                                        echo "<td>{$obj->DiagnosticResult}</a></td>";
                                        echo "<td>{$obj->DiagnosticTreatmentType}</td>";
                                        echo "<td>{$obj->DiagnosticDate}</td>";
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