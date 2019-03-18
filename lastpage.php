<?php
    require 'db.php';
	
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $res=new stdClass();
        $res->ret=-2;
        $res->roommatename="";
        $res->name="";
        $res->roomno="";
        session_start();
        if(isset($_SESSION['user'])&&$_SESSION["user"]!="")
        {
            
            $username=$_SESSION["user"];
            $con=mysqli_connect($server,$db_username,$db_password,$db_name);
            if(mysqli_error($con))
            {
                $res->ret=-2;
                $res->sql_err=mysqli_error($con);
                goto a;
            }
            $sql="SELECt * from user where username='".$username."';";
            $result=mysqli_query($con,$sql);
            $result=mysqli_fetch_assoc($result);
            $res->name=$result['name'];
            $sql="SELECT * FROM roommate WHERE username  = '".$username."';";
            $result = mysqli_query($con,$sql);
            $result = mysqli_fetch_assoc($result);
            $res->roomno="".$result["room"];
            $part=$result["partner"];
            $sql="SELECt * from user where username='".$part."';";
            $result=mysqli_query($con,$sql);
            $result=mysqli_fetch_assoc($result);
            $res->roommatename=$result['name'];
            $res->ret=1;
            
        }    
        a:
        echo json_encode($res);
    }
?>