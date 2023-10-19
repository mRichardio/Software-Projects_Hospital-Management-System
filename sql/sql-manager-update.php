<?php

include_once("../includes/db_conn.php");
$created = false; //this variable is used to indicate the creation is successfull or not

// prepare and bind
$getEmployeeID = $_POST["emp_id"];
$first_name = $_POST['emp_first_name'];
$last_name = $_POST['emp_last_name'];
$role_id = $_POST['role_id'];
$speciality_id = $_POST['speciality_id'];
$birth_date = $_POST['birth_date'];
$gender_id = $_POST['gender_id'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$address = $_POST['emp_address'];
$hire_date = $_POST['hire_date'];

$stmt = $conn->prepare("UPDATE employee SET EmployeeFirstName='$first_name', EmployeeLastName='$last_name', RoleID='$role_id', SpecialityID='$speciality_id', EmployeeDoB='$birth_date', GenderID='$gender_id', EmployeeContactNumber='$phone_number', EmployeeEmail='$email', EmployeeAddress='$address', EmployeeHireDate='$hire_date' WHERE EmployeeID ='$getEmployeeID'");
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

header('manager-list.php');

?>
<link rel="stylesheet" href="../css/main.css" />
<div class="form-done">
    <h2>Success</h2>
    <h4>Update Successful!</h4>
    <h4><a class="done-button" href="../manager-list.php">Done</a></h4>
</div>