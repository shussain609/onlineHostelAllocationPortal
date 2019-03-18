<?php
$mobile="7294953113";
$message="test message";
$json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=Message=".urlencode($message)."&To=".urlencode($mobile)."&Key=hosteTEyKQM1JZiePvLdqVwg") ,true);
if ($json["status"]==="success") {
    echo "sent";
    //your code when send success
}else{
    echo "not sent";
    //your code when not send
}
?>