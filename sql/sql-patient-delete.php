<?php

include_once("../includes/db_conn.php");
$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$getPatientID = $_GET["patID"];

$stmt = $conn->prepare("DELETE FROM patient WHERE PatientID ='$getPatientID'");
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
    <h4>Patient has been successfully removed from the system.</h4>
    <h4><a class="done-button" href="../patient-list.php">Done</a></h4>
</div>