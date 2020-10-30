<?php
    $msg='';
    $ip_birthday='';
    $ip_firstname='';
    $ip_gender='';
    $ip_lastname='';
    $ip_username='';
    if(array_key_exists("username", $_POST))
        $ip_username=$_POST['username'];
    if(array_key_exists("firstname", $_POST))
        $ip_firstname=$_POST['firstname'];
    if(array_key_exists("lastname", $_POST))
        $ip_lastname=$_POST['lastname'];
    if(array_key_exists("birthday", $_POST))
        $ip_birthday=$_POST['birthday'];
    if(array_key_exists("gender", $_POST))
        $ip_gender=$_POST['gender'];

    require('dbAdmin.php');
    $db_link=mysqli_connect($host,$user,$password,$db_name) or die('could not connect to server');
    
    if(array_key_exists("username", $_POST))
    { 
            $current_username=$_POST["username"];
            $current_password=password_hash($_POST['password'],PASSWORD_DEFAULT);
        if($current_username!='')
        {
            if($_POST['firstname']!='' and $_POST['lastname']!='')
            {
            $result=mysqli_query($db_link,"select * from ".$table_name." where username='".$current_username."'") ;
            if(mysqli_num_rows($result)==0 )
            {
                if($_POST['password']==$_POST['re-password'])
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
                    $msg="retype password correctly";
                }
            }
            else
            {
                    $msg="username already exixts";
            }
            }
            else{
                $msg="enter your name properly";
            }
        }
        else
        {
            $msg="username can not be blank";
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
        <div style="text-align:center;font-size:30px">Create New Account<br></div>
        <div style="margin:auto;border-radius:8px;background-color:#CB8AFF;padding:2%;width:37%"> 
            <form action="SignUp.php" method="post">
                <div style="width:47%;float:left;">
                    <label style="color:#8f00ff;">First Name</label>
                    <input style="width:100%" type="text" name="firstname" value="<?php echo $ip_firstname?>" placeholder="Enter your First Name" ></input>
                    <label style="color:#8f00ff;">Birthday<br></label>
                     <input style="width:100%;" type="date"  id="birthday" value="<?php echo $ip_birthday?>"  name="birthday">
                </div>
                <div style="width:47%;float:right;">
                    <label style="color:#8f00ff;">Last Name</label>
                    <input style="width:100%" type="text" name="lastname"  value="<?php echo $ip_lastname?>" placeholder="Enter your Last Name"></input>
                    <label style="color:#8f00ff;">Gender<br></label>
                    <select style="width:100%;" name="gender" id="gender" >
                    <option value="null"  <?php if($ip_gender=='null')echo "selected"?> >Select</option>
                    <option value="male" <?php if($ip_gender=='male')echo "selected"?> >Male</option>
                    <option value="female" <?php if($ip_gender=='female')echo "selected"?> >Female</option>
                    <option value="trans" <?php if($ip_gender=='trans')echo "selected"?> >Trans</option>
                    </select><br><br>
                </div>
                <label style="color:#8f00ff;">Username<br></label>
                <input style="width:100%;" type="text" name="username" value="<?php echo $ip_username?>"   placeholder="Create a Username" ><br></input>
                <label style="color:#8f00ff;">Password<br></label>
                <input style="width:100%" type="password" name="password" placeholder="Create a Passsword"><br></input>
                <label style="color:#8f00ff;">Re-type Password<br></label>
                <input style="width:100%" type="password" name="re-password" placeholder="Re-type your Passsword"><br><br></input>
                <label style="background-color:#8f00ff;color:#ffffff;" ><?php echo $msg; ?> </label>
                <input style="float:right" type="submit" value="Sign Up"  > </input>               
                </form>
        </div><br>
        <div style="text-align:center;"><a style="color:white;  text-decoration: none;" href="index.php">Already have an account? Log in here</a></div>
    </body>
</html>