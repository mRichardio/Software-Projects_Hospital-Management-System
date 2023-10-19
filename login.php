<?php 
require_once("includes/db_conn.php");
require_once("checkUserLogin.php");

$nameErr = $pwderr = $invalidMesg = "";

if (isset($_POST['login'])) {

    if ($_POST["uname"]=="") {
        $nameErr = "Username is required";
      } 
      
      if ($_POST["pwd"]==null) {
        $pwderr = "Password is required";
      }

    if($_POST['uname'] != null && $_POST["pwd"] !=null)
    {
        $array_user = verifyUsers();
        
        if ($array_user != null) {
                session_start();
                $_SESSION['EmpName'] = $array_user[0]['EmployeeFirstName'];
                $_SESSION["login_time_stamp"] = time();
                $_SESSION['EmpID'] = $array_user[0]['EmployeeID'];     
                header("Location: dashboard.php"); 
                exit();
        }
        else{
            $invalidMesg = "Invalid username and password!";
        }
    }
}
?>
<?php include("includes/bootstrap.php");?>
<link rel="stylesheet" href="css/main.css" />
<div class="login-container">
	<div class="login-form">
        <h1>Login</h1>
        <main role="main" class = "login-main">
            <div>
                <div">
                    <form method = "post">
                        <div class="form-group">
                            <label class="control-label">Username</label>
                            <input class="form-control" type="text" name = "uname">
                            <span class="text-danger"><?php echo $nameErr;?></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <input class="form-control" type="password" name = "pwd">
                            <span class="text-danger"><?php echo $pwderr;?></span>
                        </div>
                        <br>
                        <div>
                            <input type="submit" value="Login" name = "login" class="btn btn-primary">
                        </div>
                    
                    </form>
                    <div class="text-danger">
                        <?php echo $invalidMesg; ?>
                    </div>
                </div>
            </div>

		</main>
	</div>
</div>