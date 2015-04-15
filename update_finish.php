<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");

$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];


//紅色字體為判斷密碼是否填寫正確
if($_SESSION['username'] != null && $pw != null && $pw2 != null && $pw == $pw2)
{
        $id = $_SESSION['username'];
    
        //更新資料庫資料語法
        $sql = "update user set password='$pw' where username='$id'";
        if($mysqli -> query($sql))
        {
            echo "<script>alert('修改成功！'); location.href = 'member.php';</script>";
        }
        else
        {
			echo "<script>alert('修改失敗！'); location.href = 'member.php';</script>";		
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>