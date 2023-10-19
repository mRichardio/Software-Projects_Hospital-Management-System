<?php
include("includes/db_conn.php");
?>
    <?php
        $getPatientID = $_GET["patID"];
        $stmt = $conn->prepare( "SELECT patient.GenderID, gender.GenderTitle FROM patient
                                INNER JOIN gender ON (patient.GenderID=gender.GenderID) WHERE PatientID=$getPatientID" );
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