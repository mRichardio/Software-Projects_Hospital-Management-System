<?php
include("includes/db_conn.php");
?>
<label class="control-label labelFont">Role</label>
<select name="role_id" class="form-control">
    <option value="">- Select one -</option>
    <?php
    $query = "select RoleID, RoleTitle from role";
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