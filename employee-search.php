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
        <title>HMS | Employee Search</title>
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
                    require_once( "includes/db_conn.php" );
                    // search value
                    $searchQuery = $_GET[ 'q' ] ?? null;
                    if ( is_null( $searchQuery ) || empty( $searchQuery ) ) {
                    $validSearch = false;
                    } else {
                    $validSearch = true;
                    $searchQuery = "%" . $searchQuery . "%";
                    // query
                    $stmt = $conn->prepare( "SELECT * FROM employee WHERE EmployeeFirstName LIKE ?" );
                    $stmt->bind_param( 's', $searchQuery );
                    $stmt->execute();
                    $result = $stmt->get_result();

                    }
                ?>
                <link rel="stylesheet" href="css/main.css" />
                <div class="col-9">
                    <div class="main-content">
                        <div class="dash-header">
                            <h2>Employee Search</h2>
                        </div>
                        <div class="dash-content">
                            <div class="search-page">
                                <div class="search-form">
                                    <form>
                                        <div>
                                            <label for="q">Search:</label>
                                            <input class="search" type="text" name="q">
                                        </div>
                                        <div>
                                            <input class="button" type="submit" value="Search for an employee">
                                        </div>
                                    </form>
                                </div>
                                <div class="results">
                                    <?php
                                        if ( $validSearch ) {
                                            echo "<p>Your search found {$result->num_rows} result(s)";
                                            while ( $obj = $result->fetch_object() ) {
                                                echo "<h3>{$obj->EmployeeFirstName} {$obj->EmployeeLastName}</h3>";
                                                echo "<p><a href=\"employee-details.php?empID={$obj->EmployeeID}\">More Details</a></p>";
                                            }
                                        } else {
                                            echo "<p>Search for an employee.</p>";
                                        }
                                    ?>
                                </div>
                                <div>
                                    <a href="employee-list.php">Back</a>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>