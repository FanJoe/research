<?php session_start(); error_reporting(0);  ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<body>



<?php
include("mysql_connect.inc.php");
$cor = $_SESSION['cor'];
$username = $_SESSION['username'];
echo "Hi，";
echo $username;
echo "<br>";

echo '<a href="logout.php">登出</a><br>';
echo '<a href="searchwords.php">查詢單字</a><br>';
echo '<a href="member.php">回上頁</a><br><br>';
?>

<fieldset>
<legend>

<?php
mt_srand((double)microtime()*1000000);  //以時間當亂數種子
$Rand = Array(); //定義為陣列
$count = 4; //共產生幾筆
for ($i = 1; $i <= $count; $i++) {
    $randval = mt_rand(1,177841); //取得範圍為1~177841亂數
     if (in_array($randval, $Rand)) { //如果已產生過迴圈重跑
        $i--;
    }else{
        $Rand[] = $randval; //若無重復則 將亂數塞入陣列
    }
}
$a = $Rand[0];
$b = $Rand[1];
$c = $Rand[2];
$d = $Rand[3];


$sql="select * from `joefan`.`pydict` where master_id = '$a'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data= $result -> fetch_row())
{
$title = $data['1'];
echo "English：";
echo $title;
echo '<br><br>';
}

$_SESSION['cor'] = $a;

shuffle($Rand);
$a = $Rand[0];
$b = $Rand[1];
$c = $Rand[2];
$d = $Rand[3];

$sql="select * from `joefan`.`pydict` where master_id = '$a'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$ca = $data['2'];
}

$sql="select * from `joefan`.`pydict` where master_id = '$b'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$cb = $data['2'];
}

$sql="select * from `joefan`.`pydict` where master_id = '$c'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$cc = $data['2'];
}

$sql="select * from `joefan`.`pydict` where master_id = '$d'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$cd = $data['2'];
}

?>
</legend>
<form method="post">
<input type="button" value="A.<?php echo $ca; ?>" onClick="this.form.action='exam.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $a; ?>" name="choice" >
</form>
<form method="post">
<input type="button" value="B.<?php echo $cb; ?>" onClick="this.form.action='exam.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $b; ?>" name="choice" >
</form>
<form method="post">
<input type="button" value="C.<?php echo $cc; ?>" onClick="this.form.action='exam.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $c; ?>" name="choice" >
</form>
<form method="post">
<input type="button" value="D.<?php echo $cd; ?>" onClick="this.form.action='exam.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $d; ?>" name="choice" >
</form>
</fieldset>

<?php

if($_POST[choice] != null)
{
	if($_POST[choice] == $cor)
	{
		echo '<br><br>回答正確！<br>';
        $sql="select * from `joefan`.`pydict` where master_id = '$cor'";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        if($data=$result -> fetch_row())
        {
            $title = $data['1'];
        }
        
		$sql = "insert into exam_record (master_id, english, correct_time, false_time, time, user) values ( '".$cor."','".$title."', '1', '', now(), '".$username."'  )";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        /*$sql = "update exam_record SET correct_time =correct_time +1 where english = '$title'";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());*/
		echo "累計正確次數：";
		$sql="SELECT COUNT(*) AS C1 FROM exam_record WHERE `master_id`=$cor AND `correct_time`=1";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        $row=$result -> fetch_array();
		echo $row['C1'];
		echo "次，錯誤次數：";
		$sql="SELECT COUNT(*) AS C2 FROM exam_record WHERE `master_id`=$cor AND `false_time`=1";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        $row=$result -> fetch_array();
		echo $row['C2'];
		echo "次。<br>";
	}
	else if($_POST[choice] != $cor)
	{
		echo '<br><br>回答錯誤！<br>';
        $sql="select * from `joefan`.`pydict` where master_id = '$cor'";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        if($data=$result -> fetch_row())
        {
            $title = $data['1'];
        }
        
		$sql = "insert into exam_record (master_id, english, correct_time, false_time, time , user) values ( '".$cor."','".$title."', '', '1', now(), '".$username."' )";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        /*$sql = "update exam_record SET false_time = false_time +1 where english = '$title'";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());*/
		echo "累計正確次數：";
		$sql="SELECT COUNT(*) AS C1 FROM exam_record WHERE `master_id`=$cor AND `correct_time`=1";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        $row=$result -> fetch_array();
		echo $row['C1'];
		echo "次，錯誤次數：";
		$sql="SELECT COUNT(*) AS C2 FROM exam_record WHERE `master_id`=$cor AND `false_time`=1";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        $row=$result -> fetch_array();
		echo $row['C2'];
		echo "次。";
		echo '<br>';
	}

$sql="select * from `joefan`.`pydict` where master_id = '$cor'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());

while($row = $result -> fetch_row()){
echo " - English：" . $row["1"]. " <br>- Chinese：".$row["2"]." <br><br>";
}
$sql="select * from `exam_record` where `correct_time`='1' group by `english`";
$result = $mysqli -> query($sql);
if ($result -> fetch_row())
  {
    $rowcount=mysqli_num_rows($result);
  }
echo '完成率：';
echo $rowcount;
echo '/177841';

}
?>
</body>
</html>