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
    require_once("includes/db_conn.php");
    $queryEmployee = "SELECT * FROM employee
                        INNER JOIN role on (employee.RoleID=role.RoleID)
                        INNER JOIN speciality on (employee.SpecialityID=speciality.SpecialityID)
                        WHERE employee.RoleID = 5
                        ORDER BY employeeID ASC LIMIT 0,100";
    $resultEmployee = $conn->query( $queryEmployee );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS | Manager List</title>
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
                        <h2>Manager List</h2>
                    </div>
                    <div class="staff-content">
                        <div class="list-toolbar">
                            <a class="new-employee" href="manager-create.php">New Manager</a>
                            <a href="manager-search.php">Search</a>
                        </div>
                        <div class ="listing">
                            <table>
                                <tr>
                                    <th></th>
                                    <th>Employee ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Role</th>
                                    <th>Speciality</th>
                                    <th>Action</th>
                                </tr>
                            <?php
                                while ($obj = $resultEmployee -> fetch_object()) {
                                    echo "<tr>";
                                    echo "<td><a class=\"go\" href=\"manager-details.php?empID={$obj->EmployeeID}\">Select</a></td>";
                                    echo "<td>{$obj->EmployeeID}</a></td>";
                                    echo "<td>{$obj->EmployeeFirstName}</td>";
                                    echo "<td>{$obj->EmployeeLastName}</td>";
                                    echo "<td>{$obj->RoleTitle}</td>";
                                    echo "<td>{$obj->SpecialityTitle}</td>";
                                    echo "<td><a class=\"update\" href=\"manager-update.php?empID={$obj->EmployeeID}\">Update</a><br><a class=\"delete\" href=\"sql/sql-employee-delete.php?empID={$obj->EmployeeID}\">Delete</a></td>";
                                    echo "</tr>";
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