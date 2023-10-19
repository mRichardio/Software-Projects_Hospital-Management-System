<?php

include_once("../includes/db_conn.php");
$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$getDiagID = $_GET["diagID"];
$diag_date = $_POST["diag_date"];
$treat_type = $_POST["treat_type"];
$diag_id = $_POST["diag_id"];
$diag_notes = $_POST["diag_notes"];
$pat_id = $_POST["pat_id"];

$stmt = $conn->prepare("UPDATE diagnosticpatientemployeelink SET DiagnosticDate='$diag_date', DiagnosticTreatmentType='$treat_type', DiagnosticID='$diag_id', DiagnosticNotes='$diag_notes' WHERE DiagnosticPatientEmployeeLinkID='$getDiagID'");
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
    <?php echo "<h4><a class=\"done-button\" href=\"../diagnostic-list.php?patID={$pat_id}\">Done</a></h4>" ?>
</div>