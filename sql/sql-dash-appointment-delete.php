<?php

include_once("../includes/db_conn.php");
$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$getAppID = $_GET["appID"];

$stmt = $conn->prepare("DELETE FROM appointment WHERE AppointmentID ='$getAppID'");
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

header('dashboard.php');

?>

<link rel="stylesheet" href="../css/main.css" />
<div class="form-done">
    <h2>Success</h2>
    <h4>Appointment has been successfully removed from the system.</h4>
    <h4><a class="done-button" href="../dashboard.php">Done</a></h4>
</div>