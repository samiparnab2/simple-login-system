<?php
    $msg='';
    require('dbAdmin.php');
    $db_link=mysqli_connect($host,$user,$password,$db_name) or die('could not connect to server');
    if(!array_key_exists("submit",$_POST))
    {
        if(isset($_COOKIE['user_logged_in']) and $_COOKIE['user_logged_in']==true)
        { 
            $current_username=$_COOKIE["username"];
            $current_password=$_COOKIE["password"];
            $result=mysqli_query($db_link,"select * from ".$table_name." where username='".$current_username."' and pass='".$current_password."'") ;
            if(mysqli_num_rows($result)==1)
            {
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC) ;
                $ip_username=$row['username'];
                $ip_password=$row['pass'];
                $ip_firstname=$row['firstname'];
                $ip_lastname=$row['lastname'];
                $ip_birthday=$row['birthday'];
                $ip_gender=$row['gender'];
            }
            else
            {
                    $msg="something wrong happned";
            }
        }
        else
        {
            $msg="something went wrong";
        }
    }
    else
    {
    $ip_birthday='';
    $ip_firstname='';
    $ip_gender='';
    $ip_lastname='';
    $ip_username='';
    $ip_new_password='';
    $ip_cur_password='';
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
    if(array_key_exists("current-password", $_POST))
        $ip_cur_password=$_POST["current-password"];
    if(array_key_exists("current-password", $_POST))
        $ip_cur_password=password_hash($_POST["current-password"],PASSWORD_DEFAULT);
    if(array_key_exists("new-password", $_POST))
        $ip_new_password=password_hash($_POST["new-password"],PASSWORD_DEFAULT);
    


    $current_username=$_COOKIE["username"];
    $current_password=$_COOKIE['password'];
    $result=mysqli_query($db_link,"select * from ".$table_name." where username='".$current_username."'") ;
    if($result!=false)
    {
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC) ;
        if($ip_new_password=='' and  $ip_username==$row['username'] and $ip_firstname==$row['firstname'] and $ip_lastname==$row['lastname'] and $ip_birthday==$row['birthday'] and $ip_gender==$row['gender'])
            $changed=false;
        else
            $changed=true;
    }
    else
    {
        $msg="something went wrong";
    }

    if($changed==true)
    { 
        if($_POST['current-password']=='')
        {
            $msg="Enter password ";
        }
        else
        {

        if($ip_username!='')
        {
            if($_POST['firstname']!='' and $_POST['lastname']!='')
            {
            
            if($ip_username==$_COOKIE['username'] or (mysqli_num_rows(mysqli_query($db_link,"select * from ".$table_name." where username='".$ip_username."'"))==0 and $ip_username!=$_COOKIE['username']))
            {
                if(password_verify($_POST['current-password'],$row['pass']) and $_POST['new-password']=='')
                {
                    if(!mysqli_query($db_link,"update ".$table_name." set username='".$_POST['username']."',firstname='".$_POST['firstname']."',lastname='".$_POST['lastname']."',birthday='".$_POST['birthday']."',gender='".$_POST['gender']."' where username='".$_COOKIE['username']."'"))
                    {
                        $msg='fill all the fields properly';
                    }
                    else
                    {
                        setcookie('user_logged_in',true,time()+(86400 * 30),"/");
                        setcookie('username',$_POST['username'],time()+(86400 * 30),"/");
                        setcookie('password',$_COOKIE['password'],time()+(86400 * 30),"/");
                        header('Location:Login.php');
                    }
                }
                else if(password_verify($_POST['current-password'],$row['pass']) and $_POST['new-password']!='')
                {
                    if(!mysqli_query($db_link,"update ".$table_name." set pass='".$ip_new_password."',username='".$_POST['username']."',firstname='".$_POST['firstname']."',lastname='".$_POST['lastname']."',birthday='".$_POST['birthday']."',gender='".$_POST['gender']."' where username='".$_COOKIE['username']."'"))
                    {
                        $msg='fill all the fields properly';
                    }
                    else
                    {
                        setcookie('user_logged_in',true,time()+(86400 * 30),"/");
                        setcookie('username',$ip_username,time()+(86400 * 30),"/");
                        setcookie('password',$ip_new_password,time()+(86400 * 30),"/");
                        header('Location:Login.php');
                    }
                }
                else
                {
                    $msg="enter current password correctly";
                }
            }
            else
            {
                    $msg="username already exists";
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
     }
     else 
        {   
           header('Location:Profile.php');
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
        <div style="text-align:center;font-size:30px">Edit Profile<br></div>
        <div style="margin:auto;border-radius:8px;background-color:#CB8AFF;padding:2%;width:37%"> 
            <form action="EditProfile.php" method="post">
                <a href="Profile.php">
                <img style="float:right;border-radius:10px;width:30px" src="img/close.png"></img><br>
                </a>
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
                <label style="color:#8f00ff;">Current Passsword<br></label>
                <input style="width:100%" type="password" name="current-password" placeholder="Enter current passsword to save changes"><br></input>
                <label style="color:#8f00ff;">New Password<br></label>
                <input style="width:100%" type="password" name="new-password" placeholder="Enter new passsword if you want to change it"><br><br></input>
                <label style="background-color:#8f00ff;color:#ffffff;" ><?php echo $msg; ?> </label>
                <input style="float:right" type="submit" value="Submit" name="submit" > </input>               
                </form>
        </div><br>
       
    </body>
</html>