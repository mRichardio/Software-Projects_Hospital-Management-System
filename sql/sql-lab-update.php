<?php

include_once("../includes/db_conn.php");
$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$pat_id = $_GET["patID"];
$getAppointmentID = $_POST["lab_id"];
$result_date = $_POST["result_date"];
$result_id = $_POST["labtype_id"];

$stmt = $conn->prepare("UPDATE labresultpatientemployeelink SET ResultDate='$result_date', LabResultID='$result_id' WHERE LabResultPatientEmployeeLinkID='$getAppointmentID'");
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
    <?php echo "<h4><a class=\"done-button\" href=\"../lab-list.php?patID={$pat_id}\">Done</a></h4>" ?>
</div>