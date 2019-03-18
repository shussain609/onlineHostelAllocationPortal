<?php

function validate($username,$otp)
{ 
    $server="mysql";
    $db_username="abc";
    $db_password="123";
    $db_name="db";
    $conn=mysqli_connect($server,$db_username,$db_password,$db_name);
    if(!$conn) 
    {
        return array("valid" => false,"partner" => "0");
    }
    $sql="SELECT * FROM otptable WHERE username='".$username."';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) 
    {
        $row = mysqli_fetch_assoc($result);
        if($row["otp"]==$otp)
            return array("valid" => true,"partner" => $row["roommatename"]);
        else 
            return array("valid" => false,"partner" => "");
    } 
    else 
    {
        return array("valid" => false,"partner" => "0");
    }

}

