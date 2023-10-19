<?php
include("includes/db_conn.php");
?>
    <?php
        $getEmployeeID = $_GET["empID"];
        $stmt = $conn->prepare( "SELECT sup.EmployeeID, CONCAT(sup.EmployeeFirstName,' ',sup.EmployeeLastName,' - ', spec.SpecialityTitle, ' Department ') AS Manager
                                    FROM employee sub
                                    JOIN employee sup ON sub.ManagerID = sup.EmployeeID
                                    JOIN speciality spec ON spec.SpecialityID = sup.SpecialityID
                                    WHERE sub.EmployeeID = '$getEmployeeID'
                                    GROUP BY sup.EmployeeID, sup.EmployeeFirstName, sup.EmployeeLastName, spec.SpecialityTitle" );
        $stmt->execute();
        $result = $stmt->get_result();
        $obj = $result->fetch_object();
        $emp_manager = $obj->EmployeeID;
        $emp_managerDetails = $obj->Manager;
    ?>
<label class="control-label labelFont">Manager / Speciality</label>
<select name="manager_id" class="form-control" style="width: 50px !important; min-width: 450px; max-width: 450px;">
    <option value="<?php echo $emp_manager; ?>"><?php echo $emp_managerDetails; ?> </option>
    <?php

    // to view manager's names with their associated department.
    $query2 = "SELECT sup.EmployeeID, CONCAT(sup.EmployeeFirstName,' ',sup.EmployeeLastName,' - ', spec.SpecialityTitle, ' Department ') AS Manager
                FROM employee sub
                JOIN employee sup ON sub.ManagerID = sup.EmployeeID
                JOIN speciality spec ON spec.SpecialityID = sup.SpecialityID
                GROUP BY sup.EmployeeID, sup.EmployeeFirstName, sup.EmployeeLastName, spec.SpecialityTitle";

    $result = $conn->query($query2);
    if ($result->num_rows > 0) {
        while ($optionData = $result->fetch_assoc()) {
            $option = $optionData['Manager'];
            $id = $optionData['EmployeeID'];
    ?>
            <option value="<?php echo $id; ?>"><?php echo $option; ?> </option>
    <?php
        }
    }
    ?>
</select>