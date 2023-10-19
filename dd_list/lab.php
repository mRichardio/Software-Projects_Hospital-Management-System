<?php
include("includes/db_conn.php");
?>
<label class="control-label labelFont">Result Type</label>
<select name="lab_id" class="form-control">
    <option value="">- Select one -</option>
    <?php
    $query = "select LabResultID, ResultType from labresult";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($optionData = $result->fetch_assoc()) {
            $option = $optionData['ResultType'];
            $id = $optionData['LabResultID'];
    ?>
            <option value="<?php echo $id; ?>"><?php echo $option; ?> </option>
    <?php
        }
    }
    ?>
</select>