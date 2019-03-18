<?php
    require 'db.php';
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $res=new stdClass();
        $res->ret=-1;
        $res->fname="";
        $res->lname="";
        $res->sql_err="";
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
            
            $sql="SELECT * FROM user WHERE email='".$username."'";
            $result=mysqli_query($con, $sql);
            if(mysqli_error($con)||mysqli_num_rows($result)==0)
            {
                $res->ret=-2;
                $res->sql_err=mysqli_error($con);
                goto a;
            }
            
            
            $res->fname=$row["first_name"];
            $res->lname=$row["last_name"];
            $res->user=$username;
            $res->ret=0;
        }
        a:
        echo json_encode($res);

    }
?>