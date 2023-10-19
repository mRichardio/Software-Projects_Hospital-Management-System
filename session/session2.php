<?php

function checkSession ($path) {

    $expireAfter = 5; //this value is in minutes

    //Check the interval since "last action" session
    if(isset($_SESSION['last_action'])){
        
        //Figure out how many seconds have passed
        //since the user was last active.
        $secondsInactive = time() - $_SESSION['last_action'];

        $expireAfterSeconds = $expireAfter * 300;
        
        if($secondsInactive >= $expireAfterSeconds){
            //User has been inactive for too long.
            //Kill their session.
            session_unset();
            session_destroy();
            header("Location:".$path);//return to the login page
        }
    }
    $_SESSION['last_action'] = time(); //this variable is set for the very first time upon login
    $url=$_SERVER['REQUEST_URI'];//to obtain the current page
    // $timeOut = ($expireAfter*10)+1; //1 second after the max session allowed. 
    // header("Refresh: $timeOut; URL=$url"); //refresh the screen
}
?>