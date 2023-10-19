<?php
  // session_start();
?>

<div class="nav-header">
  <?php 
    require_once("db_conn.php");

    $getUserID = $userID;
    $stmt = $conn->prepare( "SELECT * FROM employee WHERE EmployeeID = ?" );
    $stmt->bind_param( 'i', $getUserID );
    $stmt->execute();
    $result = $stmt->get_result();
    $obj = $result->fetch_object();
    ?>
  <h4>Hello, <a href="userProfile.php"><?php echo $obj->EmployeeFirstName." ".$obj->EmployeeLastName?></a></h4>
  <h2>Navigation</h2>
</div>
<?php 
  $getUserID = $userID;
  $stmt = $conn->prepare( "SELECT RoleID FROM employee WHERE EmployeeID = ?" );
  $stmt->bind_param( 'i', $getUserID );
  $stmt->execute();
  $result = $stmt->get_result();
  $obj = $result->fetch_object();
  $userRole = $obj->RoleID;
?>
<link rel="javascript" href="css/nav.css">
<?php if($userRole == 4 || $userRole == 5){
    echo "<div class=\"nav-content\">";
    echo "<div class=\"nav-buttons\">";
      echo "<a href=\"dashboard.php\">Dashboard</a>";
      echo "<a href=\"patient-list.php\">Patients List</a>";
      echo "<a href=\"employee-list.php\">Employee List</a>";
      echo "<a href=\"manager-list.php\">Manager List</a>";
      echo "<div class=\"logout-button\">";
        echo "<a href=\"login.php\">Logout</a>";
      echo "</div>";
    echo "</div>";
  echo "</div>";
  } else {
      echo "<div class=\"nav-content\">";
      echo "<div class=\"nav-buttons\">";
        echo "<a href=\"dashboard.php\">Dashboard</a>";
        echo "<a href=\"patient-list.php\">Patients List</a>";
        echo "<div class=\"logout-button\">";
          echo "<a href=\"login.php\">Logout</a>";
        echo "</div>";
      echo "</div>";
    echo "</div>";
  } 
?>
<script src="javascript/currentNavHighlight.js"></script>
