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
    width: 27%;
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
        <div style="text-align:center"> your profile<br><br></div>
        <div style="border-radius:8px;background-color:#CB8AFF;padding:40px;width:80%"> 
            <form action="Logout.php" method="post">

            <label style="background-color:#8f00ff;color:#ffffff;" ><?php echo $msg; ?> </label>

                <label style="color:#8f00ff;float:center;"><?php echo "username : $username_val"; ?><br></label>

                <label style="color:#8f00ff;"><?php echo "Name : $firstname_val  $lastname_val"; ?><br></label>
                <label style="color:#8f00ff;"><?php echo "Birthday : $birthday_val"; ?><br></label>
                <label style="color:#8f00ff;"><?php echo "Gender : $gender_val"; ?><br></label>
                
             <input style="float:right" type="submit" value="Log Out"> </input>
                
        </div>
        
    </body>
  
</html>
