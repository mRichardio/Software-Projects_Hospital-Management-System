<?php
include("includes/db_conn.php");
?>
    <?php
        $getAppID = $_GET["appID"];
        $stmt = $conn->prepare( "SELECT appointment.WardID, ward.WardName FROM appointment
                                INNER JOIN ward ON (appointment.WardID=ward.WardID) WHERE AppointmentID=$getAppID" );
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