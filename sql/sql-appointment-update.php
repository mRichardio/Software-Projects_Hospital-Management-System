<?php

include_once("../includes/db_conn.php");
$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$getAppointmentID = $_POST["app_id"];
$app_time = $_POST["appointment_time"];
$app_date = $_POST["appointment_date"];
$ward_id = $_POST["ward_id"];

$stmt = $conn->prepare("UPDATE appointment SET AppointmentTime='$app_time', AppointmentDate='$app_date', WardID='$ward_id' WHERE AppointmentID='$getAppointmentID'");
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

header('appointment-list.php');

?>

<link rel="stylesheet" href="../css/main.css" />
<div class="form-done">
    <h2>Success</h2>
    <h4>Update Successful!</h4>
    <h4><a class="done-button" href="../patient-list.php">Done</a></h4>
</div>