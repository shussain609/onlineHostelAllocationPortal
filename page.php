<?php
function genOTP($username, $roommatename ) 
{
    $arr = array();
    $arr['valid'] = True;
    $arr['otp'] = "";
    require 'db.php';
    $con=mysqli_connect($server,$db_username,$db_password,$db_name);
    if(mysqli_error($con))
    {
	$arr['valid']=False;
        return $arr;
    }
			
    //1.delete all the entries in the table of before 10 minutes.
    $sql="DELETE from otptable where time1< (now()-INTERVAL 10 MINUTE);";
    $result=mysqli_query($con, $sql);
    if (!$result) 
    {
        $arr['valid']=False;
        return $arr;
    }
    //1.completed.	
    $sql="SELECT * FROM otptable WHERE username='".$username."';";
    $result=mysqli_query($con, $sql);
    if (!$result) 
    {
        $arr['valid']=False;
        return $arr;
    }
            
    //qyery to check if username is previously present in the table.
    //if it is return false.
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
	$arr['valid']=False;
	$arr['otp']=$row['roommatename'];
        return $arr;
    }
				
				
    //if it is not, assign in the table.	
    else
    {
	$otp= "".rand(pow(10, 8-1), pow(10, 8)-1);
	$sql="INSERT INTO otptable VALUES ('".$username."','".$roommatename."','".$otp."',now());";
	$result=mysqli_query($con, $sql);
        if (!$result) 
        {
            $arr['valid']=False;
            return $arr;
        }
	$arr['valid']=True;
	$arr['otp']=$otp;
	return $arr;
    }
}
