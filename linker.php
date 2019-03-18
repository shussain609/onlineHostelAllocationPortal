<?php
    require 'db.php';
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        session_start();
        if((!isset($_SESSION['user']))||$_SESSION["user"]=="")
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        $username=$_SESSION["user"];
        $con=mysqli_connect($server,$db_username,$db_password,$db_name);
        if(mysqli_error($con))
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        $otp=$_POST['otp'];
        require_once  'validate.php';
        $result=validate($username,$otp);
        if(!$result['valid'])
        {
            echo "Invalid OTP";
            exit();
        }
        $rmate=$result['partner'];
        $sql="START TRANSACTION;";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        $sql="UPDATE roommate set hasroommate=1,partner='".$rmate."' where username='".$username."';";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        $sql="UPDATE roommate set hasroommate=1,partner='".$username."' where username='".$rmate."';";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        $sql="COMMIT;";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        echo "1";
        exit();
        
    }
    