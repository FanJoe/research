<?php session_start(); error_reporting(0); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
$eng = $_POST['eng'];
$username = $_SESSION['username'];
include("mysql_connect.inc.php");

$sql="select * from `joefan`.`TOEFL_IS_600` where `english` = '$eng'";
$result = $mysqli -> query($sql) ;
//$row = @mysql_fetch_row($result);
$row=$result -> fetch_row();
//$result = mysql_query($sql) or die('MySQL query error');
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	
if($eng !=null)
{
	//while($row = mysql_fetch_row($result))
    while ($search = $result -> fetch_row())
    {
		echo "$row[1] - English：$row[2] <br><br> Chinese：$row[6]<br>";
		$m=$row["1"];
		$e=$row["2"];
		$c=$row["6"];
		echo "曾查詢此單字:";
		$sql="SELECT COUNT(*) FROM `search_record` WHERE `english`= '$eng' && `user`='$username'";
		//$result = mysql_query($sql) or die("無法執行：".mysql_error());
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
		//$row=mysql_fetch_array($result);
        $row=$result -> fetch_row();
		echo $row['0'];
		echo "次";
		$sql="INSERT INTO `joefan`.`search_record` (`master_id`, `english`, `chinese`, `time`, `user`) VALUES ( '" . $m. "','" . $e. "', '" . $c. "',now(), '".$username."' );";
		//$result = mysql_query($sql) or die("無法執行：".mysql_error());
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
		echo '<br>';
	}
}
else
{
	echo "找不到此單字!";
}

?>

<br><input type ="button" onclick="javascript:location.href='searchwords.php'" value="繼續查詢"></input></br>
