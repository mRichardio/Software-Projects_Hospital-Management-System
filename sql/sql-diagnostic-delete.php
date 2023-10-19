<?php

include_once("../includes/db_conn.php");
$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$getDiagID = $_GET['diagID'];
$getPatientID = $_GET['patID'];

$stmt = $conn->prepare("DELETE FROM diagnosticpatientemployeelink WHERE DiagnosticPatientEmployeeLinkID ='$getDiagID'");
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
    <h4>Diagnostic has been successfully removed from the patient's records.</h4>
    <?php echo "<h4><a class=\"done-button\" href=\"../diagnostic-list.php?patID={$getPatientID}\">Done</a></h4>";?>
</div>