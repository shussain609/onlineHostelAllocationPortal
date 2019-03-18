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
        $eml=$_POST['email'];
        $sql="UPDATE user set email='".$eml."';";
        if(!mysqli_query($con, $sql))
        {
           echo 'An error occured. Please try again.';
        }
        else
            echo "Email changed Successfully";
        exit();
    }

