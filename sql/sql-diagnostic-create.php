<?php

include_once("../includes/db_conn.php");

$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$stmt = $conn->prepare("INSERT INTO diagnosticpatientemployeelink (DiagnosticDate, DiagnosticTreatmentType, EmployeeID, DiagnosticID, PatientID, DiagnosticNotes) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssiiis',$diag_date, $treat_type, $emp_id, $diag_id, $pat_id, $diag_notes);

// set parameters and execute
$diag_date = $_POST['diag_date'];
$treat_type = $_POST['treat_type'];
$emp_id = $_POST['emp_id'];
$diag_id = $_POST['diag_id'];
$pat_id = $_POST['pat_id'];
$diag_notes = $_POST['diag_notes'];
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

header('lab-list.php');

?>

<link rel="stylesheet" href="../css/main.css" />
<div class="form-done">
    <h2>Success</h2>
    <h4>Diagnostic has been successfully added to the patient.</h4>
    <?php echo "<h4><a class=\"done-button\" href=\"../diagnostic-list.php?patID={$pat_id}\">Done</a></h4>" ?>
</div>