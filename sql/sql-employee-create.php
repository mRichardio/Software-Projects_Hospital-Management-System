<?php

include_once("../includes/db_conn.php");

$created = false; //this variable is used to indicate the creation is successfull or not

$stmt = $conn->prepare("INSERT INTO logindetails (LoginDetailsUsername, LoginDetailsPassword) VALUES (?, ?)");
$stmt->bind_param('ss',$login_username, $login_password);

// set parameters and execute
$login_username = $_POST['login_username'];
$login_password= $_POST['login_password'];
$stmt->execute();

$stmt = $conn->prepare( "SELECT LoginDetailsID from logindetails where LoginDetailsUsername = '$login_username' AND LoginDetailsPassword = ?" );
$stmt->bind_param('i', $login_password);
$stmt->execute();
$result = $stmt->get_result();
$obj = $result->fetch_object();
$login_id = $obj->LoginDetailsID;

// prepare and bind
$stmt = $conn->prepare("INSERT INTO employee (EmployeeFirstName, EmployeeLastName, RoleID, SpecialityID, EmployeeDoB, GenderID, EmployeeContactNumber, EmployeeEmail, EmployeeAddress, EmployeeHireDate, LoginDetailsID, ManagerID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssiississssi',$first_name, $last_name, $role_id, $speciality_id, $birth_date, $gender_id, $phone_number, $email, $address, $hire_date, $login_id, $manager_id);

// set parameters and execute
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
$manager_id = $_POST['manager_id'];
$stmt->execute();

// set parameters and execute
$login_id = $obj->LoginDetailsID;

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
    <h4>Employee has been successfully added to the system.</h4>
    <h4><a lass="done-button" href="../employee-list.php">Done</a></h4>
</div>