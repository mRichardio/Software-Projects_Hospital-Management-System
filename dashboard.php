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
    <title>HMS | Dashboard</title>
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
                        <h2>Dashboard</h2>
                    </div>
                    <?php 
                        require_once("includes/db_conn.php");
                        $getUserID = $userID;
                        $stmt = $conn->prepare( "SELECT * FROM employee WHERE EmployeeID = ?" );
                        $stmt->bind_param( 'i', $getUserID );
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $obj = $result->fetch_object();
                        ?>
                    <div class="dash-content">
                        <h2>Welcome, <?php echo $obj->EmployeeFirstName." ".$obj->EmployeeLastName?></h2>
                        <p>This is your user dashboard, here you will be able to see all of the appointments that have been assigned to you.</p>
                        <?php include("includes/appointment-list.php");?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>