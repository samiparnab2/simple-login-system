<?php
    setcookie('user_logged_in','',time()-3600,"/");
    setcookie('username','',time()-3600,"/");
    setcookie('password','',time()-3600,"/");
    header('Location:index.php');
    
?>