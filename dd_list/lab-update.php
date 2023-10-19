<?php
include("includes/db_conn.php");
?>
    <?php
    $getLabID = $_GET["labID"];
    $stmt = $conn->prepare ("SELECT DISTINCT labresult.LabResultID, labresult.ResultType FROM labresult
                INNER JOIN labresultpatientemployeelink on (labresult.LabResultID=labresultpatientemployeelink.LabResultID)
                where labresult.LabResultID ='$lab_type'");
        $stmt->execute();
        $result = $stmt->get_result();
        $obj = $result->fetch_object();
    $lab_id = $obj->LabResultID;
    $lab_type = $obj->ResultType;
?>
<label class="control-label labelFont">Result Type</label>
<select name="labtype_id" class="form-control">
            <option value="<?php echo $lab_id; ?>"><?php echo $lab_type; ?> </option>
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