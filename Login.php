<?php
    $msg='';
    require('dbAdmin.php');
    $db_link=mysqli_connect($host,$user,$password,$db_name) or die('could not connect to server');
   if(isset($_COOKIE['user_logged_in']) and $_COOKIE['user_logged_in']==true )
    { 

            $current_username=$_COOKIE['username'];
            $current_password=$_COOKIE['password'];
        
            $result=mysqli_query($db_link,"select * from ".$table_name." where username='".$current_username."' and pass='".$current_password."'") ;
            if(mysqli_num_rows($result)==1)
            {
                    header('Location:Profile.php');
            }
            else
            {
                    $msg="something wrong happened";
            }
     }
     else if(array_key_exists('username',$_POST) and array_key_exists('password',$_POST))
     {
        $current_username=$_POST['username'];
        $current_password=$_POST['password'];
        $result=mysqli_query($db_link,"select pass from ".$table_name." where username='".$current_username."'") ;
        if($result!=false and mysqli_num_rows($result)==1)
        {
            $hash=mysqli_fetch_array($result,MYSQLI_ASSOC) ;
            if(password_verify($current_password,$hash['pass']))
            {
            setcookie('user_logged_in',true,time()+(86400 * 30),"/");
            setcookie('username',$current_username,time()+(86400 * 30),"/");
            setcookie('password',$hash['pass'],time()+(86400 * 30),"/");
          header('Location:Profile.php');
            }
            else
            {
                $msg="wrong password<br>";
            }
        }
        else
        {
            $msg='wrong username or password';
        }
     }
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"> 
      </head>
    <body >
    <h1 style="text-align:center;"> <?php echo $site_name?> <br></h1>
        <div style="text-align:center;"> Log in to your account<br><br></div>
        <div style="margin:auto;border-radius:8px;background-color:#CB8AFF;padding:2%;width:20%"> 
            <form action="" method="post">
            <label style="background-color:#8f00ff;color:#ffffff;" ><?php echo $msg; ?> </label><br>
                <label style="color:#8f00ff;">Username<br></label>
                <input style="width:100%" type="text" name="username" placeholder="Enter your Username"><br></input>
                <label style="color:#8f00ff;">Password<br></label>
                <input style="width:100%" type="password" name="password" placeholder="Enter your Passsword"><br><br></input>  
                <input style="float:right" type="submit" value="Log In"> </input>    
        </div><br>
        <div style="text-align:center;"><a style="color:white;  text-decoration: none;" href="SignUp.php">Don't have an account? Sign Up here</a></div>
    </body>
</html>