<?php
    require_once("includes/db_conn.php");
    $queryEmployee = "SELECT * FROM appointment
                        INNER JOIN patient ON (appointment.PatientID=patient.PatientID)
                        INNER JOIN appointmentemployeelink ON (appointment.AppointmentID=appointmentemployeelink.AppointmentID)
                        INNER JOIN employee ON (appointmentemployeelink.EmployeeID=employee.EmployeeID)
                        WHERE employee.EmployeeID = '$userID'
                        ORDER BY appointment.AppointmentID ASC LIMIT 0,100";
    $resultEmployee = $conn->query( $queryEmployee );
?>
                    <div class="appointment-title">
                        <h2>Appointments</h2>
                    </div>
                    <div class="staff-content">
                        <div class="list-toolbar">
                            <a class="new-appointment" href="dash-appointment-create.php">New Appointment</a>
                        </div>
                        <div class ="listing">
                            <table>
                                <tr>
                                    <th>Patient</th>
                                    <th>Appointment Time</th>
                                    <th>Appointment Date</th>
                                    <th>Employee</th>
                                    <th>Action</th>
                                </tr>
                            <?php
                                while ($obj = $resultEmployee -> fetch_object()) {
                                    echo "<tr>";
                                    echo "<td>{$obj->PatientFirstName} {$obj->PatientLastName}</td>";
                                    echo "<td>{$obj->AppointmentTime}</td>";
                                    echo "<td>{$obj->AppointmentDate}</td>";
                                    echo "<td>{$obj->EmployeeFirstName} {$obj->EmployeeLastName}</td>";
                                    echo "<td><a class=\"update\" href=\"dash-appointment-update.php?appID={$obj->AppointmentID}\">Update</a><br><a class=\"delete\" href=\"sql/sql-dash-appointment-delete.php?appID={$obj->AppointmentID}\">Delete</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>