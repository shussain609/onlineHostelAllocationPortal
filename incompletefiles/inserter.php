<?php

require 'db.php';
$con=mysqli_connect($server,$db_username,$db_password,$db_name);
if(mysqli_error($con))
{
            echo 'An error occured. Please try again. '. mysqli_error($con);
            exit();
}
$sql="delete from login;";
mysqli_query($con, $sql);
$sql="delete from file;";
mysqli_query($con,$sql);
$sql="delete from user;";
mysqli_query($con, $sql);

$sql="delete from roommate;";
mysqli_query($con, $sql);

$sql="delete from otptable;";
mysqli_query($con, $sql);


$sql="update rooms set status=0;";
mysqli_query($con, $sql);


$sql="update rooms set status=1 where room<20 and room>10;";
mysqli_query($con, $sql);

$sql="INSERT INTO login values('16je002235','".md5("123")."');";
mysqli_query($con, $sql);

$sql="INSERT INTO login values('16je002494','".md5("123")."');";
mysqli_query($con, $sql);

$sql="INSERT INTO login values('16je002562','".md5("123")."');";
mysqli_query($con, $sql);

$sql="INSERT INTO login values('16je002278','".md5("123")."');";
mysqli_query($con, $sql);

$sql="Insert into user values('16je002235','Ankur Dua','ankurdua15@gmail.com');";
mysqli_query($con, $sql);

$sql="Insert into user values('16je002494','Shadab Hussain','shussain609@gmail.com');";
mysqli_query($con, $sql);

$sql="Insert into user values('16je002562','Khobaib Alam','khobaib222@gmail.com');";
mysqli_query($con, $sql);

$sql="Insert into user values('16je002278','Ashutosh Shekhar','ashutosh78@gmail.com');";
mysqli_query($con, $sql);

$sql="Insert into roommate values('16je002235',0,'',0);";
mysqli_query($con, $sql);


$sql="Insert into roommate values('16je002494',0,'',0);";
mysqli_query($con, $sql);


$sql="Insert into roommate values('16je002562',0,'',0);";
mysqli_query($con, $sql);


$sql="Insert into roommate values('16je002278',0,'',0);";
mysqli_query($con, $sql);

echo 'successful';
?>