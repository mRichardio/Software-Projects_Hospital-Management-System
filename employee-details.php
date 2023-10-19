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
    <title>HMS | Employee Details</title>
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
                        <h2>Employee Details</h2>
                    </div>
                    <div class="dash-content">
                        <?php
                            require_once("includes/db_conn.php");
                            $getEmployeeID = $_GET["empID"];
                            $stmt = $conn->prepare( "SELECT * FROM employee
                                                        INNER JOIN role on (employee.RoleID = role.RoleID)
                                                        INNER JOIN gender ON (employee.GenderID=gender.GenderID)
                                                        INNER JOIN speciality on (employee.SpecialityID = speciality.SpecialityID)
                                                        WHERE EmployeeID = ?" );
                            $stmt->bind_param( 'i', $getEmployeeID );
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $obj = $result->fetch_object();
                        ?>
                        <?php
                            echo "<div class=\"user-container\">";
                            echo "<h2>{$obj->EmployeeFirstName} {$obj->EmployeeLastName}</h2>";
                            echo "<div class=\"user-details\">";
                            echo "<h5>Employee Details</h5>";
                            echo "<h6>ID Number: {$obj->EmployeeID}</h6>";
                            echo "<h6>Role: {$obj->RoleTitle}</h6>";
                            echo "<h6>Speciality: {$obj->SpecialityTitle}</h6>";
                            echo "<h6>Assigned Manager ID: {$obj->ManagerID}</h6>";
                            echo "<h6>Hire Date: {$obj->EmployeeHireDate}</h6>";
                            echo "<h6>Salary: £{$obj->RoleSalary}</h6>";
                            echo "</div>";
                            echo "<div class=\"user-personal-details\">";
                            echo "<h5>Personal Details</h5>";
                            echo "<h6>Gender: {$obj->GenderTitle}</h6>";
                            echo "<h6>Date of Birth: {$obj->EmployeeDoB}</h6>";
                            echo "<h6>Contact Number: {$obj->EmployeeContactNumber}</h6>";
                            echo "<h6>Email: {$obj->EmployeeEmail}</h6>";
                            echo "<h6>Address: {$obj->EmployeeAddress}</h6>";
                            echo "</div>";
                            echo "<div class=\"user-buttons\">";
                            echo "<a class=\"lab\" href=\"employee-list.php\">Home</a>";
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