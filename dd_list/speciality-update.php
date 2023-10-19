<?php
include("includes/db_conn.php");
?>
    <?php
        $getEmployeeID = $_GET["empID"];
        $stmt = $conn->prepare( "SELECT employee.SpecialityID, speciality.SpecialityTitle FROM employee
                                INNER JOIN speciality ON (employee.SpecialityID=speciality.SpecialityID) WHERE EmployeeID='$getEmployeeID'" );
        $stmt->execute();
        $result = $stmt->get_result();
        $obj = $result->fetch_object();
        $emp_speciality = $obj->SpecialityID;
        $emp_specialityTitle = $obj->SpecialityTitle;
    ?>
<label class="control-label labelFont">Speciality</label>
<select name="speciality_id" class="form-control">
    <option value="<?php echo $emp_speciality; ?>"><?php echo $emp_specialityTitle; ?> </option>
    <?php
    $query = "SELECT SpecialityID, SpecialityTitle FROM speciality";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($optionData = $result->fetch_assoc()) {
            $option = $optionData['SpecialityTitle'];
            $id = $optionData['SpecialityID'];
    ?>
            <option value="<?php echo $id; ?>"><?php echo $option; ?> </option>
    <?php
        }
    }
    ?>
</select>