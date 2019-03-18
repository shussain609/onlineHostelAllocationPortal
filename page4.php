<?php
    require 'db.php';
    
    $con=mysqli_connect($server,$db_username,$db_password,$db_name);
    $result=new stdClass();
    $result->error=0;
    $result->status=array(53);
    for($i=0;$i<53;$i++)
    {
        $result->status[$i]=0;
    }
    
    if(mysqli_error($con))
    {
        $result->error=1;
        echo json_encode($result);
        exit();
    }
   
    $sql="SELECT * from rooms;";
    $res= mysqli_query($con, $sql);
    if((!res)||mysqli_num_rows($res)<52)
    {
        $result->error=1;
        echo json_encode($result);
        exit();
    }
     
    $row;
    while(($row= mysqli_fetch_assoc($res)))
    {
        
        $result->status[$row['room']]=$row['status'];    
    }
    session_start();
    $username=$_SESSION['user'];
    $sql="SELECT * from user where username='".$username."';";
    $row= mysqli_query($con, $sql);
    $row=mysqli_fetch_assoc($row);
    $result->name=$row["name"];
    $result->uname=$username;
    echo json_encode($result);
    exit();


