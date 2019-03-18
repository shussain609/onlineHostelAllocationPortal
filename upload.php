<?php
    require 'db.php';
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        session_start();
        if((!isset($_SESSION['user']))||($_SESSION['user']==""))
        {
            echo '<script type=text/javascript>alert("An error occured. Please try again");</script>';
            exit();
        }
        $file=$_FILES["file"];
        $target_dir=dirname(__FILE__)."/uploads/".$_SESSION['user'].".jpg";
        if ($file['error'] > 0) 
        {
            echo '<script type=text/javascript>alert("An error occured. Please try again");</script>';
            exit();  
        }
		
		//
		
		//checking image file type.
		$directory=dirname(__FILE__)."/uploads/";
		$target_file=$directory. basename($file["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if($imageFileType != "jpg" && $imageFileType != "jpeg") 
		{
             echo '<script type=text/javascript>alert("You are allowed to upload only jpg and jpeg images");</script>';
             exit();
        }
		//checking image size.
		if ($file["size"] > 1000000) 
		{
            echo '<script type=text/javascript>alert("Image size should be less then 1MB");</script>';
            exit();
        }
	//
	
        $status=  move_uploaded_file($file["tmp_name"], $target_dir);
        if(!$status)
        {
            echo '<script type=text/javascript>alert("An error occured. Please try again");</script>';
            exit();
        }
        else
        {
            $con=mysqli_connect($server,$db_username,$db_password,$db_name);
            if(mysqli_error($con))
            {
                echo '<script type=text/javascript>alert("An error occured. Please try again");</script>';
                exit();
            
            }
            mysqli_select_db($con, $db_name);
            $sql="INSERT INTO file VALUES('".$_SESSION['user']."');";

            if(!mysqli_query($con, $sql))
            {
                echo '<script type=text/javascript>alert("An error occured. Please try again");</script>';
                exit();
            
            }
            echo '<script type=text/javascript>window.location="page3.html";</script>';
            exit();
            
        }
    }
    

