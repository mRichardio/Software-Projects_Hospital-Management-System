<?php

include_once("../includes/db_conn.php");

$created = false; //this variable is used to indicate the creation is successfull or not

// set parameters and execute
$getPatientID = $_POST["pat_id"];
$pat_first_name = $_POST['pat_first_name'];
$pat_last_name = $_POST['pat_last_name'];
$pat_birth_date = $_POST['pat_birth_date'];
$pat_gender_id = $_POST['gender_id'];
$pat_phone_number = $_POST['pat_phone_number'];
$pat_address = $_POST['pat_address'];
$ward_id = $_POST['ward_id'];

// prepare and bind
$stmt = $conn->prepare("UPDATE patient SET PatientFirstName='$pat_first_name', PatientLastName='$pat_last_name', PatientDoB='$pat_birth_date', GenderID='$pat_gender_id', PatientContactNumber='$pat_phone_number', PatientAddress='$pat_address', WardID='$ward_id' WHERE PatientID ='$getPatientID'");

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

header('patient-list.php');

?>
<link rel="stylesheet" href="../css/main.css" />
<div class="form-done">
    <h2>Success</h2>
    <h4>Update Successful!</h4>
    <h4><a class="done-button" href="../patient-list.php">Done</a></h4>
</div>