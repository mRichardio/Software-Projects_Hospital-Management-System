<?php

function checkSession ($path) {
  
    
    $sessionMax = 300; //this is a parameteised variable for the maximum length of the session.
    $_SESSION['expire'] = time() + 1*10;
    // To check if session is started.
    if(isset($_SESSION["EmpName"]))
    {
        if(time()-$_SESSION['login_time_stamp']>$sessionMax)
        {
            session_unset();
            session_destroy();
            header("Location:".$path);//return to the login page
        }
    }
    else
    {
        header("Location:".$path); //if there is no session, the user will be rerouted to the login page. This is to avoid accessing the page via url.
    }
    $url=$_SERVER['REQUEST_URI'];//to obtain the current page 
    // $timeOut = $sessionMax+300; //1 second after the max session allowed. 
    // header("Refresh: $timeOut; URL=$url"); //refresh the screen // Disabled because was no longer needed
    $_SESSION["login_time_stamp"] = time();

    $expireAfter = 40; //this value is in minutes

    if(isset($_SESSION['last_action'])){
        
        //Figure out how many seconds have passed
        //since the user was last active.
        $secondsInactive = time() - $_SESSION['last_action'];
        
        $expireAfterSeconds = $expireAfter * 60;
        
        if($secondsInactive >= $expireAfterSeconds){
            //User has been inactive for too long.
            //Kill their session.
            session_unset();
            session_destroy();
            header("Location:".$path);//return to the login page

        }
        
    }
    
    $_SESSION['last_action'] = time();
    $url=$_SERVER['REQUEST_URI'];//to obtain the current page
    $timeOut = ($expireAfter*60)+1; //1 second after the max session allowed. 
    header("Refresh: $timeOut; URL=$url"); //refresh the screen
    //Assign the current timestamp as the user's
    //latest activity
    $_SESSION["login_time_stamp"] = time();
}
?>