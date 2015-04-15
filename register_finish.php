<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
require_once ("Mail.php");

$name = $_POST['name'];
$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$num = $_POST['num'];
$hash = md5( rand(0,1000) );

if($id != null && $pw != null && $pw2 != null && $pw == $pw2 && preg_match('/^([.0-9a-z]+)@([0-9a-z]+).([.0-9a-z]+)$/i',$id) == true && preg_match("/09[0-9]{2}[0-9]{6}/", $num) == true && $_POST['imgCode'] == $_SESSION['seccode'])
{
	//新增資料進資料庫語法
	$sql = "insert into user (realname, username, password, level, phone, hash) values ('$name', '$id', '$pw', '0', '$num', '$hash')";
	if(mysqli_query($mysqli,$sql))
	{
        $from = '<s10144101040709@gmail.com>';
        $to = "<$id>";
        $subject = '帳號驗證信';
        $body = "
        ".$name."您好。
        恭喜您已經加入會員，請點擊以下連結來啟用帳號。
        
        驗證連結：
        http://www.polochen.com/joefan/verify.php?email=$id&hash=$hash 
        ";
        
        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );
        
        $smtp = Mail::factory('smtp', array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 's10144101040709@gmail.com',
            'password' => 'poloissohandsome'
        ));
        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) 
        {
            echo('<p>' . $mail->getMessage() . '</p>');
        } 
        else 
        {
            echo "<script>alert('註冊成功！ 驗證信已寄出'); location.href = 'index.php';</script>";
        }       
        
		//echo "<script>alert('註冊成功！ 註冊信已寄出'); location.href = 'index.php';</script>";

	}
	else
	{
		echo "<script>alert('註冊失敗！'); location.href = 'index.php';</script>";
	}
}
else if ($name == null)
{
	echo "<script>alert('請輸入姓名！'); location.href = 'register.php';</script>";
}
else if (preg_match('/^([.0-9a-z]+)@([0-9a-z]+).([.0-9a-z]+)$/i',$id) != true) 
{
    echo "<script>alert('Email格式不符！'); location.href = 'register.php';</script>"; 
}
else if ($pw == null)
{
	echo "<script>alert('請輸入密碼！'); location.href = 'register.php';</script>"; 
}
else if ($pw2 == null)
{
	echo "<script>alert('請再次輸入密碼！'); location.href = 'register.php';</script>"; 
}
else if ($num == null)
{
	echo "<script>alert('請輸入手機號碼！'); location.href = 'register.php';</script>"; 
}
else if(preg_match("/09[0-9]{2}[0-9]{6}/", $num) != true)
{
    echo "<script>alert('手機號碼格式錯誤！'); location.href = 'register.php';</script>"; 
}
else if ($_POST['imgCode'] != $_SESSION['seccode'])
{
	echo "<script>alert('驗證碼錯誤！'); location.href = 'register.php';</script>";
}



?>