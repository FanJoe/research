<?php // error_reporting(0);?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
include ("mysql_connect.inc.php");
             
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    // Verify data
    $email = mysqli_escape_string($mysqli,$_GET['email']); // Set email variable
    $hash = mysqli_escape_string($mysqli,$_GET['hash']); // Set hash variable
                 
    $search = mysqli_query($mysqli, "SELECT username, level, hash  FROM user WHERE username='$email' AND hash='$hash' AND level='0'") or die(mysql_error()); 
    $match  = mysqli_num_rows($search);
                 
    if($match > 0)
    {
        // We have a match, activate the account
        mysqli_query($mysqli, "UPDATE user SET level='1' WHERE username='$email' AND hash='$hash' AND level='0'") or die(mysql_error());
        echo "<script>alert('帳號已啟用，可登入！'); location.href = 'index.php';</script>";
    }
    else
    {
        // No match -> invalid url or account has already been activated.
       echo "<script>alert('無效連結/帳號已啟用'); location.href = 'index.php';</script>";
    }
                 
}
else
{
    // Invalid approach
    echo "<script>alert('帳號啟用失敗！'); location.href = 'index.php';</script>";
}


?>