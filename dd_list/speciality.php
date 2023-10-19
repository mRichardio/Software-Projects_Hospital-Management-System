<?php
include("includes/db_conn.php");
?>
<label class="control-label labelFont">Speciality</label>
<select name="speciality_id" class="form-control">
    <option value="">- Select one -</option>
    <?php
    $query = "select SpecialityID, SpecialityTitle from speciality";
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