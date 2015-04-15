<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
echo '<a href="logout.php">登出</a>  <br><br>';

//此判斷為判定觀看此頁有沒有權限
//若是是路人或不相關的使用者要排除

if($_SESSION['username'] != null)
{
	  echo '<a href="register.php">新增</a>&nbsp';
      echo '<a href="update1.php">修改</a>&nbsp';
      echo '<a href="delete.php">刪除</a><br><br>';
    
      //將資料庫裡的所有會員資料顯示在畫面上
      $sql = "SELECT * FROM user";
      $result = mysql_query($sql);
      while($row = mysql_fetch_row($result))
      {
		echo "$row[0] - 真實姓名：$row[1], 帳號：$row[2], 密碼：$row[3]<br>";
      }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>