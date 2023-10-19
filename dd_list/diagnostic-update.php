<?php
include("includes/db_conn.php");
?>
    <?php
    $getDiagID = $_GET["diagID"];
    $stmt = $conn->prepare ("SELECT diagnostic.DiagnosticID, diagnostic.DiagnosticResult FROM diagnostic
                INNER JOIN diagnosticpatientemployeelink ON (diagnostic.DiagnosticID=diagnosticpatientemployeelink.DiagnosticID)
                where diagnostic.DiagnosticID ='$diag_id'");
        $stmt->execute();
        $result = $stmt->get_result();
        $obj = $result->fetch_object();
    $diag_id = $obj->DiagnosticID;
    $diag_result = $obj->DiagnosticResult;
?>
<label class="control-label labelFont">Result Type</label>
<select name="diag_id" class="form-control">
            <option value="<?php echo $diag_id; ?>"><?php echo $diag_result; ?> </option>
            <?php
    $query = "select DiagnosticID, DiagnosticResult from diagnostic";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($optionData = $result->fetch_assoc()) {
            $option = $optionData['DiagnosticResult'];
            $id = $optionData['DiagnosticID'];
    ?>
            <option value="<?php echo $id; ?>"><?php echo $option; ?> </option>
    <?php
        }
    }
    ?>
</select>