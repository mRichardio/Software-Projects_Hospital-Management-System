<?php
include("includes/db_conn.php");
?>
<label class="control-label labelFont">Gender</label>
<select name="gender_id" class="form-control">
    <option value="">- Select one -</option>
    <?php
    $query = "select GenderID, GenderTitle from gender";
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