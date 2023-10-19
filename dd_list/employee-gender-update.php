<?php
include("includes/db_conn.php");
?>
    <?php
        $getEmployeeID = $_GET["empID"];
        $stmt = $conn->prepare( "SELECT employee.GenderID, gender.GenderTitle FROM employee
                                INNER JOIN gender ON (employee.GenderID=gender.GenderID) WHERE EmployeeID=$getEmployeeID" );
        $stmt->execute();
        $result = $stmt->get_result();
        $obj = $result->fetch_object();
        $emp_gender = $obj->GenderID;
        $emp_genderTitle = $obj->GenderTitle;
    ?>
<label class="control-label labelFont">Gender</label>
<select name="gender_id" class="form-control">
    <option value="<?php echo $emp_gender; ?>"><?php echo $emp_genderTitle; ?> </option>
    <?php
    $query = "SELECT GenderID, GenderTitle FROM gender";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($optionData = $result->fetch_assoc()) {
            $option = $optionData['GenderTitle'];
            $id = $optionData['GenderID'];
    ?>
            <option value="<?php echo $id; ?>"><?php echo $option; ?> </option>
    <?php
        }
    }
    ?>
</select>