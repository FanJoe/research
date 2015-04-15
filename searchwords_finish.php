<?php session_start(); error_reporting(0); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<br><input type ="button" onclick="javascript:location.href='searchwords.php'" value="繼續查詢"></input></br>    

<?php
$eng = $_POST['eng'];
$username = $_SESSION['username'];
include("mysql_connect.inc.php");

$sql="select * from `joefan`.`pydict` where `english` = '$eng'";
$result = $mysqli -> query($sql) ;
$row=$result -> fetch_row();
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	
if($eng !=null)
{
    while ($search = $result -> fetch_row())
     {
		echo "$row[0] - English：$row[1] <br><br> Chinese：$row[2]<br>";
		$m=$row["0"];
		$e=$row["1"];
		$c=$row["2"];
		echo "曾查詢此單字:";
		$sql="SELECT COUNT(*) FROM `search_record` WHERE `english`= '$eng' && `user`='$username'";
		$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
		$row=$result -> fetch_array();
		echo $row['COUNT(*)'];
		echo "次";
		$sql="INSERT INTO `joefan`.`search_record` (`master_id`, `english`, `chinese`, `time`, `user`) VALUES ( '" . $m. "','" . $e. "', '" . $c. "',now(), '".$username."' );";
		$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
		echo '<br>';
	}
}
else
{
	echo "找不到此單字!";
}
?>


</html>