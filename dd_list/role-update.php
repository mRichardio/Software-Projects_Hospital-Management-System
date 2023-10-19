<?php
include("includes/db_conn.php");
?>
    <?php
        $getEmployeeID = $_GET["empID"];
        $stmt = $conn->prepare( "SELECT employee.RoleID, role.RoleTitle FROM employee
                                INNER JOIN role ON (employee.RoleID=role.RoleID) WHERE EmployeeID=$getEmployeeID" );
        $stmt->execute();
        $result = $stmt->get_result();
        $obj = $result->fetch_object();
        $emp_role = $obj->RoleID;
        $emp_roleTitle = $obj->RoleTitle;
    ?>
<label class="control-label labelFont">Role</label>
<select name="role_id" class="form-control">
    <option value="<?php echo $emp_role; ?>"><?php echo $emp_roleTitle; ?> </option>
    <?php
    $query = "SELECT RoleID, RoleTitle FROM role";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($optionData = $result->fetch_assoc()) {
            $option = $optionData['RoleTitle'];
            $id = $optionData['RoleID'];
    ?>
            <option value="<?php echo $id; ?>"><?php echo $option; ?> </option>
    <?php
        }
    }
    ?>
</select>