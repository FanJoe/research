<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
$username = $_SESSION['username'];
echo "Hi，";
echo $username;
echo "<br>";
echo '<a href="logout.php">登出</a>  <br><br>';

//此判斷為判定觀看此頁有沒有權限
//若是是路人或不相關的使用者要排除

if($_SESSION['username'] != null)
{
    echo '<a href="update.php">修改資料</a><br><br>';
    echo '<a href="searchwords.php">查詢單字(pydict)</a><br><br>';
    echo '<a href="searchwords_600.php">查詢單字(TOEFL)</a><br><br>';
    echo '<a href="searchwords_7000.php">查詢單字(MOE)</a><br><br>';
	echo '<a href="exam.php">pydict測驗</a><br><br>';
    echo '<a href="exam_7000.php">7000單測驗</a><br><br>';
    echo '<a href="exam_600.php">TOEFL測驗</a>';

    
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>