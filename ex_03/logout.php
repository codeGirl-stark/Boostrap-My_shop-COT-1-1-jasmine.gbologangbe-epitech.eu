<?php

    session_start();

    session_unset();
    session_destroy();

    if(empty($_SESSION)){
        header("Location:login.php");
        //exit(0);
    }

?>