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
        $room=$_POST['room'];
        $sql="SELECT * FROM rooms where room=".$room.";";
        $result=mysqli_query($con,$sql);
        $result=mysqli_fetch_assoc($result);
        if($result["status"]==1)
        {
            echo "This room is already occupied.";
            exit();
        }
        $sql="UPDATE roommate set room=".$room." where username='".$username."' or partner='".$username."';";
        mysqli_query($con,$sql);
        $sql="UPDATE rooms set status=1 where room=".$room.";";
        mysqli_query($con,$sql);
        echo "1";
        exit();
    }