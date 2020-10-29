<?php

    require('dbAdmin.php');
    $db_link=mysqli_connect($host,$user,$password,$db_name) or die('could not connect to server');
    if(array_key_exists('delete',$_POST))
    {
        if(!mysqli_query($db_link,"delete from ".$table_name." where username='".$_COOKIE['username']."'"))
        {
            echo "something went wrong";
        }
    }
    setcookie('user_logged_in','',time()-3600,"/");
    setcookie('username','',time()-3600,"/");
    setcookie('password','',time()-3600,"/");
    header('Location:index.php');
    
?>