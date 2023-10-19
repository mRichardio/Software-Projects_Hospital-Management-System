<?php

include_once("../includes/db_conn.php");

$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$stmt = $conn->prepare("INSERT INTO labresultpatientemployeelink (ResultDate, PatientID, EmployeeID, LabResultID) VALUES (?, ?, ?, ?)");
$stmt->bind_param('siii',$result_date, $pat_id, $emp_id, $lab_id);

// set parameters and execute
$result_date = $_POST['result_date'];
$pat_id = $_POST['pat_id'];
$emp_id = $_POST['emp_id'];
$lab_id = $_POST['lab_id'];
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
    <h4>Lab Result has been successfully added to the patient.</h4>
    <?php echo "<h4><a class=\"done-button\" href=\"../lab-list.php?patID={$pat_id}\">Done</a></h4>" ?>
</div>