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
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Lato&display=swap" rel="stylesheet">
 
    <style>
    @font-face{
        font-family:'lato thinitalic';
        src: url('fonts/Lato/Lato-LightItalic.ttf');
    }
    @font-face{
        font-family:'lato italic';
        src: url('fonts/Lato/Lato-BoldItalic.ttf');
    }
    
    h1 {
        font-family: 'dancing script';
        font-weight: normal;
        color: #ffffff;
        font-size: 50px;
       
    }  
    body {background-color:#8f00ff;
        background-image: linear-gradient(to bottom right,#8f00ff, #00000A);
        font-family: 'Lato thinitalic';
        font-size: 20px;
        color: #ffffff;
    }
    input[type=text] {
    width: 23%;
    margin: 8px 0;
    padding: 12px 20px;
    border: 2px ;
     border-radius: 10px;
    }
    input[type=password] {
    width: 23%;
    margin: 8px 0;

    padding: 12px 20px;
    border: 2px ;
     border-radius: 10px;
    }

    input[type=submit] {
    width: 23%;
    padding: 12px 20px;
    border: none ;
    display: inline-block;
    text-align:center;
    font-family: 'Lato italic';
    color: #8f00ff;
     border-radius: 200px;
    }
    label{
        font-size:25px;
    }
    </style>

   <h1 style="text-align:center;"> <?php echo $site_name?> <br></h1>
    </head>
    <body style="padding:10px 600px">
        <div style="text-align:center"> Log in to your account<br><br></div>
        <div style="border-radius:8px;background-color:#CB8AFF;padding:40px;width:80%"> 
            <form action="" method="post">

            <label style="background-color:#8f00ff;color:#ffffff;" ><?php echo $msg; ?> </label>

                <label style="color:#8f00ff;">Username<br></label>
                <input style="width:100%" type="text" name="username" placeholder="Enter your Username"><br></input>

                <label style="color:#8f00ff;">Password<br></label>
                <input style="width:100%" type="password" name="password" placeholder="Enter your Passsword"><br><br></input>
                
                <a href="find.php" style="color:#7f00ff;font-size:18px;text-decoration: none;">Forgot Password</a>
                <input style="float:right" type="submit" value="Log In"> </input>
                
        </div>
        <div style="text-align:center;"><a style="color:white;  text-decoration: none;" href="SignUp.php">Don't have an account? Sign Up here</a></div>
    </body>
  
</html>
