<?php
    $msg='';
    $username_val='';
    $password_val='';
    $firstname_val='';
    $lastname_val='';
    $birthday_val='';
    $gender_val='';
    require('dbAdmin.php');
    $db_link=mysqli_connect($host,$user,$password,$db_name) or die('could not connect to server');
    if(isset($_COOKIE['user_logged_in']) and $_COOKIE['user_logged_in']==true)
    { 
            $current_username=$_COOKIE["username"];
            $current_password=$_COOKIE["password"];
            $result=mysqli_query($db_link,"select * from ".$table_name." where username='".$current_username."' and pass='".$current_password."'") ;
            if(mysqli_num_rows($result)==1)
            {
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC) ;
                $username_val=$row['username'];
                $password_val=$row['pass'];
                $firstname_val=$row['firstname'];
                $lastname_val=$row['lastname'];
                $birthday_val=$row['birthday'];
                $gender_val=$row['gender'];
            }
            else
            {
                    $msg="something wrong happned";
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
         <div style="text-align:center"> your profile<br><br></div>
        <div style="margin:auto;border-radius:8px;background-color:#CB8AFF;padding:40px;width:20%"> 
            <form  action="LgoutOrDlt.php" method="post">
                <label style="background-color:#8f00ff;color:#ffffff;" ><?php echo $msg; ?></label><br>
                <label style="color:#8f00ff;float:center;"><?php echo "username : $username_val"; ?><br></label>
                <label style="color:#8f00ff;"><?php echo "Name : $firstname_val  $lastname_val"; ?><br></label>
                <label style="color:#8f00ff;"><?php echo "Birthday : $birthday_val"; ?><br></label>
                <label style="color:#8f00ff;"><?php echo "Gender : $gender_val"; ?><br><br></label>
                <div style="margin:0% 5%;">
             
                
                <input style="margin:5% 5%;" type="submit" name="logout" value="Log Out"> </input> 
                <input style="margin:5% 5%;color:#CA0B00" type="submit" name="delete"  value="Delete Account"> </input> 
                </div>
             </form>
        </div>
    </body>
</html>

