<?php
include("includes/db_conn.php");
?>
    <?php
        $getPatientID = $_GET["patID"];
        $stmt = $conn->prepare( "SELECT patient.WardID, ward.WardName FROM patient
                                INNER JOIN ward ON (patient.WardID=ward.WardID) WHERE PatientID=$getPatientID" );
        $stmt->execute();
        $result = $stmt->get_result();
        $obj = $result->fetch_object();
        $pat_ward = $obj->WardID;
        $pat_wardName = $obj->WardName;
    ?>
<label class="control-label labelFont">Ward</label>
<select name="ward_id" class="form-control">
    <option value="<?php echo $pat_ward; ?>"><?php echo $pat_wardName; ?> </option>
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