<?php
require 'db.php';
session_start();
if((!isset($_SESSION['user']))||$_SESSION["user"]=="")
{
    echo 'Error';
    exit();
}
$username=$_SESSION["user"];
$con=mysqli_connect($server,$db_username,$db_password,$db_name);
if(mysqli_error($con))
{
    echo 'Error';
    exit();
}
$sql="SELECT * from user where username='".$username."';";
$result= mysqli_query($con, $sql);
$result=mysqli_fetch_assoc($result);
echo $result['name'];
exit();
