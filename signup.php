<?php
    require 'db.php';
    $fname=$lname=$username=$password=$cpassword="";
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $fname=$_POST["fname"];
        $lname=$_POST["lname"];
        $username=$_POST["username"];
        $password=$_POST["password"];
        $cpassword=$_POST["cpassword"];
        if(!preg_match("/^[a-zA-Z0-9 ]*$/",$fname))
        {
            echo "Only alphanumeric characters andspaces are allowed in First Nmae.";
            exit;
        }
        elseif(strlen(trim($fname))==0)
        {
            echo "First Name cannot be empty.";
            exit;
        }
        else 
        {
            $fname=trim($fname);
        }
        if(!preg_match("/^[a-zA-Z0-9 ]*$/",$lname))
        {
            echo "Only alphanumeric characters andspaces are allowed in Last Nmae.";
            exit;
        }
        elseif(strlen(trim($lname))==0)
        {
            echo "Last Name cannot be empty.";
            exit;
        }
        else 
        {
            $lname=trim($lname);
        }
        if(strlen(trim($username))==0)
        {
            echo "Username can't be empty.";
            exit;
        }
        else {
            $username=trim($username);
        }
        
        if(!preg_match("/^[a-zA-Z0-9.@#]*$/",$password))
        {
            echo "Only alphanumeric characters and . @ # are allowed in password.";
            exit;
        }
        if($cpassword!==$password)
        {
            echo "Entered passwords do not match.";
            exit;
        }
        $con= mysqli_connect($server,$db_username,$db_password);
        if(!$con)
        {
            echo "Connection failed ".mysqli_connect_error();
            exit;
        }
        mysqli_select_db($con, $db_name);
        $sql="SELECT * FROM login where username='".$username."'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result)==1)
        {
            echo "Username already exists.";
            exit;
        }
        $sql1="INSERT INTO login VALUES('".$username."','".md5($password)."')";
        $sql2="INSERT INTO user VALUES('".$username."','".$fname."','".$lname."')";
        if(mysqli_query($con,$sql1) && mysqli_query($con,$sql2))
        {
                echo "1";
                session_start();
                $_SESSION["user"]=$username;
        }
        else {
            echo "error ".mysqli_error($con);
            exit;
        }
        
    }
?>