<?php

function verifyUsers () {

if (!isset($_POST['uname']) or !isset($_POST['pwd'])) {
    return;  // <-- return null;
}

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

include('includes/db_conn.php');
$sql = "SELECT logindetails.LoginDetailsUsername, employee.EmployeeFirstName, employee.EmployeeID FROM logindetails
                        inner join employee on (employee.LoginDetailsID=logindetails.LoginDetailsID)
                        WHERE LoginDetailsUsername='$uname' AND LoginDetailsPassword='$pwd'";

$result = mysqli_query($conn, $sql);

$arrayResult = [];
while ($row = $result->fetch_assoc()) { 

    $arrayResult[] = $row; 
}
return $arrayResult;
}
