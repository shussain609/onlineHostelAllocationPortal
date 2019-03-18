<?php
    require 'db.php';
    require 'page.php';
    require 'test2/mail.php';
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
        $rmate=$_POST['rmate'];
        $sql="SELECT * FROM roommate where username='".$username."';";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        $result= mysqli_fetch_assoc($result);
        if($result['partner']!="")
        {
            echo 'You have already been alloted a room with '.$result['partner'];
            exit();
        }
        $sql="SELECT * FROM roommate where username='".$rmate."';";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        
        $result= mysqli_fetch_assoc($result);
        if($result['partner']!="")
        {
            echo 'The username you entered has already been alloted a room';
            exit();
        }

        $sql="SELECT * FROM file where username='".$rmate."';";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        
        if(mysqli_num_rows($result)==0)
        {
            echo 'Error.The username entered by you has not submitted his fee receipt.';
            exit();
        }
        
        $result=genOTP($username,$rmate);
        $otp=$result['otp'];
        if($result['valid']==False)
        {
            if($result['otp']!="")
            {
                echo "You already have a pending request for ".$result['otp'].". Please "
                    . "wait for this request to expire before making a new request";
            }
            else 
            {
                echo 'An error occured. Please try again.';
            
            }
            exit();
        }
        
        $sql="SELECT email from user where username='".$rmate."';";
        $result= mysqli_query($con, $sql);
        if((!$result)|| mysqli_num_rows($result)==0)
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        $email= mysqli_fetch_assoc($result)['email'];
        $sql="SELECT name from user where username='".$username."';";
        $result= mysqli_query($con, $sql);
        if((!$result)|| mysqli_num_rows($result)==0)
        {
            echo 'An error occured. Please try again.';
            exit();
        }
        $name= mysqli_fetch_assoc($result)['name'];
        
        $result= sendMail($email, $name, $otp,$rmate);
        if(!result)
        {
            echo 'An error occured. Please try again.';
            deleteEntryByUsername($username);
            exit();
        }
        echo '1';
        exit();
        
        
    }
