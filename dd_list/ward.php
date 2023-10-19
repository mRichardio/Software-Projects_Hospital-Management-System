<?php
include("includes/db_conn.php");
?>
<label class="control-label labelFont">Ward</label>
<select name="ward_id" class="form-control">
    <option value="">- Select one -</option>
    <?php
    $query = "select WardID, WardName from ward";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($optionData = $result->fetch_assoc()) {
            $option = $optionData['WardName'];
            $id = $optionData['WardID'];
    ?>
            <option value="<?php echo $id; ?>"><?php echo $option; ?> </option>
    <?php
        }
    }
    ?>
</select>