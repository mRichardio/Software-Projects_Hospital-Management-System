<?php

include_once("../includes/db_conn.php");

$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$stmt = $conn->prepare("INSERT INTO appointment (AppointmentTime, AppointmentDate, PatientID, WardID) VALUES (?, ?, ?, ?)");
$stmt->bind_param('ssii',$appointment_time, $appointment_date, $pat_id, $ward_id);

// set parameters and execute
$appointment_time = $_POST['appointment_time'];
$appointment_date = $_POST['appointment_date'];
$emp_id = $_POST['emp_id'];
$pat_id = $_POST['pat_id'];
$ward_id = $_POST['ward_id'];
$stmt->execute();

$stmt = $conn->prepare( "SELECT AppointmentID FROM appointment where AppointmentTime='$appointment_time' AND AppointmentDate='$appointment_date' AND appointment.PatientID='$pat_id' AND appointment.WardID='$ward_id' " );
$stmt->execute();
$result = $stmt->get_result();
$obj = $result->fetch_object();
$app_id = $obj->AppointmentID;

$stmt = $conn->prepare("INSERT INTO appointmentemployeelink (AppointmentID, EmployeeID) VALUES (?, ?)");
$stmt->bind_param('ii',$app_id, $emp_id);

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
    <h4>Appointment has been successfully added to the system.</h4>
    <h4><a class="done-button" href="../patient-list.php">Done</a></h4>
</div>
