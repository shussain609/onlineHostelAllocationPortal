<?php
    require 'db.php';
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        session_start();
        if(isset($_SESSION['user'])&&$_SESSION['user']!="")
        {
            $username=$_SESSION['user'];
            $con=mysqli_connect($server,$db_username,$db_password,$db_name);
            if(mysqli_error($con))
            {
                session_destroy();
                $_SESSION=array();
                echo "-1";
                exit();
            }
            $wh=-1;
            $sql="SELECT * FROM whereTo WHERE username='".$username."'";
            $result=mysqli_query($con, $sql);        
            if(mysqli_error($con)||mysqli_num_rows($result)==0)
            {
                session_destroy();
                $_SESSION=array();
                echo "-1";
                exit();
            }
            $row=mysqli_fetch_assoc($result);
            echo "".$row['loc'];
            exit();
        }
        else
        {
            echo "-1";
            exit();
        }
    }

