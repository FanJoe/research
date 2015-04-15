<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");

if($_SESSION['username'] != null)
{
        //將$_SESSION['username']丟給$id
        //這樣在下SQL語法時才可以給搜尋的值
        $id = $_SESSION['username'];
        //若以下$id直接用$_SESSION['username']將無法使用
        $sql = "SELECT * FROM user where username='$id'";
        //$result = mysql_query($sql);
        $result = $mysqli -> query($sql) ;
        //$row = mysql_fetch_row($result);
        $row = $result -> fetch_row();
    
        echo "<form name=\"form\" method=\"post\" action=\"update_finish.php\">";
		echo "真實姓名：$row[1]<br>";
        echo "帳號：$row[2]<br>";
        echo "密碼：<input type=\"password\" name=\"pw\" value=\"$row[3]\" /> <br>";
        echo "再一次輸入密碼：<input type=\"password\" name=\"pw2\" value=\"$row[3]\"/><br>";
        echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
        echo "</form>";
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>