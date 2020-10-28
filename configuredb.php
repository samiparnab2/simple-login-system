<?php

    require_once('dbAdmin.php');
    $db_link=mysqli_connect($host,$user,$password) or die('could not connect to server');

    if(($result=mysqli_query($db_link,"create database $db_name"))==true)
    {
        if(($result=mysqli_query($db_link,"use $db_name"))==true)
        {
            if(($result=mysqli_query($db_link,"create table $table_name(username varchar(20) primary key,firstname varchar(40),lastname varchar(40),birthday date,gender varchar(10) check(gender in('Male','Female','Trans')),pass varchar(300))"))==true)
            {
                echo "successfully craeted database";
                setcookie('user_logged_in','',time()-3600,"/");
                setcookie('username','',time()-3600,"/");
                setcookie('password','',time()-3600,"/");
            }
            else
            {
                echo "table already exists(check manually in terminal)";
            }
        }
        else
        {
            echo "can not use database ";
        }
    }
    else
    {
        echo "something wrong happened....create database named $db_name and create a table named $table_name manually or the database might exists with this name";
    }

?>