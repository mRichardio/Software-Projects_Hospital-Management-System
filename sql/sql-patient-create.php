<?php

include_once("../includes/db_conn.php");

$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$stmt = $conn->prepare("INSERT INTO patient (PatientFirstName, PatientLastName, PatientDoB, GenderID, PatientContactNumber, PatientAddress, WardID) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssssisi',$pat_first_name, $pat_last_name, $pat_birth_date, $pat_gender_id, $pat_phone_number, $pat_address, $ward_id);

// set parameters and execute
$pat_first_name = $_POST['pat_first_name'];
$pat_last_name = $_POST['pat_last_name'];
$pat_birth_date = $_POST['pat_birth_date'];
$pat_gender_id = $_POST['gender_id'];
$pat_phone_number = $_POST['pat_phone_number'];
$pat_address = $_POST['pat_address'];
$ward_id = $_POST['ward_id'];
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
    <h4>Patient has been created.</h4>
    <h4><a class="done-button" href="../patient-list.php">Done</a></h4>
</div>