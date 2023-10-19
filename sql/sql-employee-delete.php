<?php

include_once("../includes/db_conn.php");
$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$getEmployeeID = $_GET["empID"];

$stmt = $conn->prepare("DELETE FROM employee WHERE EmployeeID ='$getEmployeeID'");
// set parameters and execute
$stmt->execute();

//the logic
if ($stmt) {
    $created = true;
}
else{
    echo "<p>Error</p>";
}

$stmt->close();
$conn->close();

header('employee-list.php');

?>

<link rel="stylesheet" href="../css/main.css" />
<div class="form-done">
    <h2>Success</h2>
    <h4>Employee has been successfully removed from the system.</h4>
    <h4><a class="done-button" href="../employee-list.php">Done</a></h4>
</div>