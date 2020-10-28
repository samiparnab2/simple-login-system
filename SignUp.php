
<?php
    $msg='';
    require('dbAdmin.php');
    $db_link=mysqli_connect($host,$user,$password,$db_name) or die('could not connect to server');
    
    if(array_key_exists("username", $_POST))
    { 
            $current_username=$_POST["username"];
            $current_password=password_hash($_POST['password'],PASSWORD_DEFAULT);
            $result=mysqli_query($db_link,"select * from ".$table_name." where username='".$current_username."'") ;
            if(mysqli_num_rows($result)==0)
            {
                if(!mysqli_query($db_link,"insert into ".$table_name." values('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['birthday']."','".$_POST['gender']."','".$current_password."')"))
                {
                    $msg='fill all the fields properly';
                }
                else
                {
                    setcookie('user_logged_in',true,time()+(86400 * 30),"/");
                    setcookie('username',$current_username,time()+(86400 * 30),"/");
                    setcookie('password',$current_password,time()+(86400 * 30),"/");
                    header('Location:Login.php');
                }
            }
            else
            {
                    $msg="username already exixts";
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
    input[type=date] {
    margin: 8px 0;
    padding: 9px 20px;
    border: 2px ;
     border-radius: 10px;
     color:#505050;
    }
    select{
    margin: 8px 0;
    padding: 9px 20px;
    border: 2px ;
     border-radius: 10px;
     background-color:#ffffff;
    }
    
    option{
    margin: 8px 0;
    padding: 9px 20px;
    border: 2px ;
     border-radius: 10px;
     
    }
    label{
        font-size:25px;
    }
    </style>

   <h1 style="text-align:center;"> <?php echo $site_name?></h1>
    </head>
    <body style="padding:10px 500px">
        <div style="text-align:center;font-size:30px">Create New Account<br><br></div>
        <div style="border-radius:8px;background-color:#CB8AFF;padding:40px;width:90%"> 
        
            <form action="SignUp.php" method="post">

            

                <div style="width:47%;float:left;">
                    <label style="color:#8f00ff;">First Name</label>
                    <input style="width:100%" type="text" name="firstname" placeholder="Enter your First Name"></input>

                    <label style="color:#8f00ff;">Birthday<br></label>
                     <input style="width:100%;" type="date"  id="birthday" name="birthday">
                </div>
                
                <div style="width:47%;float:right;">
                    <label style="color:#8f00ff;">Last Name</label>
                    <input style="width:100%" type="text" name="lastname" placeholder="Enter your Last Name"></input>
                    
                    <label style="color:#8f00ff;">Gender<br></label>
                    <select style="width:100%;" name="gender" id="gender">
                    <option value="null"></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="trans">Trans</option>
                    </select><br><br>
                </div>

                

                <label style="color:#8f00ff;">Username<br></label>
                <input style="width:100%" type="text" name="username"  placeholder="Create a Username" ><br></input>

                <label style="color:#8f00ff;">Password<br></label>
                <input style="width:100%" type="password" name="password" placeholder="Create a Passsword"><br></input>
                
                <label style="color:#8f00ff;">Re-type Password<br></label>
                <input style="width:100%" type="password" name="re-password" placeholder="Re-type your Passsword"><br><br></input>

                <label style="background-color:#8f00ff;color:#ffffff;" ><?php echo $msg; ?> </label>

                <input style="float:right" type="submit" value="Sign Up"  > </input>
               
                </form>
        </div>
        <div style="text-align:center;"><a style="color:white;  text-decoration: none;" href="index.php">Already have an account? Log in here</a></div>
    </body>
  
</html>
