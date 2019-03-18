<?php
    function deleteEntryByUsername($username){
       
        $conn = mysqli_connect($server,$db_username,$db_password,$db_name);
        if(! $conn ) 
        {
            return 0;
        }
        
        $sql = "DELETE FROM otptable WHERE username='".$username."';";
        if (mysqli_query($conn, $sql)) 
        {
            return 1;
        } 
        else 
        {
            return 0;
        }

        
    }
?>