<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("mysql_connect.inc.php");
$id = $_POST['id'];
$pw = $_POST['pw'];

//搜尋資料庫資料
$sql = "SELECT * FROM user where username = '$id'";
//$result = mysql_query($sql);
//$row = @mysql_fetch_row($result);
$result = $mysqli -> query($sql);
$row = $result -> fetch_row();

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員


if($_POST['imgCode']==$_SESSION['seccode'])
{

	if($id != null && $pw != null && $row[2] == $id && $row[3] == $pw && $row[4]=="admin")
	{
		//將帳號寫入session，方便驗證使用者身份
		$_SESSION['username'] = $id;
		echo "<script>alert('歡迎管理者！'); location.href = 'member1.php';</script>";
	}
	else if($id != null && $pw != null && $row[2] == $id && $row[3] == $pw && $row[4] == "1")
	{
		//將帳號寫入session，方便驗證使用者身份
		$_SESSION['username'] = $id;
		echo "<script>alert('登入成功！'); location.href = 'member.php';</script>";
	}
	else if($row[4] != "1")
	{
		echo "<script>alert('尚未驗證/驗證失敗！'); location.href = 'index.php';</script>";
	}
    else
    {
        echo "<script>alert('登入失敗！'); location.href = 'index.php';</script>";
    }
}
else
{
	echo "<script>alert('驗證碼錯誤！'); location.href = 'index.php';</script>";

}
?>