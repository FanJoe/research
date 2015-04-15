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
    $randval = mt_rand(1,475); //取得範圍為1~xxx亂數
    if (in_array($randval, $Rand)) 
    { //如果已產生過迴圈重跑
        $i--;
    }
    else
    {
        $Rand[] = $randval; //若無重復則 將亂數塞入陣列
    }
}

$a = $Rand[0];
$b = $Rand[1];
$c = $Rand[2];
$d = $Rand[3];


$sql="select * from TOEFL_IS_600 where id = '$a' AND lala_incorrect > lala_correct";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data= $result -> fetch_row())
{
$title = $data['2'];
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

$sql="select * from TOEFL_IS_600 where id = '$a'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());

if($data=$result -> fetch_row())
{
$ca = $data['6'];
}

$sql="select * from TOEFL_IS_600 where id = '$b'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$cb = $data['6'];
}

$sql="select * from TOEFL_IS_600 where id = '$c'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$cc = $data['6'];
}

$sql="select * from TOEFL_IS_600 where id = '$d'";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
if($data=$result -> fetch_row())
{
$cd = $data['6'];
}
?>
</legend>
<form method="post">
<input type="button" value="A.<?php echo $ca; ?>" onClick="this.form.action='exam_600.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $a; ?>" name="choice" >
</form>
<form method="post">
<input type="button" value="B.<?php echo $cb; ?>" onClick="this.form.action='exam_600.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $b; ?>" name="choice" >
</form>
<form method="post">
<input type="button" value="C.<?php echo $cc; ?>" onClick="this.form.action='exam_600.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $c; ?>" name="choice" >
</form>
<form method="post">
<input type="button" value="D.<?php echo $cd; ?>" onClick="this.form.action='exam_600.php';this.form.submit();"> 
<input type="hidden" value="<?php echo $d; ?>" name="choice" >
</form>
</fieldset>

<?php

if($_POST[choice] != null)
{
	if($_POST[choice] == $cor)
	{
        echo '<br><br>回答正確！<br>';
        $sql="select * from `joefan`.`TOEFL_IS_600` where id = '$cor'";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        if($data=$result -> fetch_row())
        {
            $title = $data['2'];
        }
        
		$sql = "insert into exam_600_record (id, english, correct_time, false_time, time, user) values ( '".$cor."','".$title."', '', '', now(), '".$username."'  )";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error()); 

        $sql = "update exam_600_record SET correct_time = correct_time +1 where english =   '$title'";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error()); 

        echo "累計正確次數：";
		$sql="SELECT correct_time as C1 FROM exam_600_record WHERE `id`=$cor";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        $row=$result -> fetch_array();
		echo $row['C1'];
		echo "次，錯誤次數：";
		$sql="SELECT false_time AS C2 FROM exam_600_record WHERE `id`=$cor";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        $row=$result -> fetch_array();
		echo $row['C2'];
		echo "次。<br>";
        
        $sql = "Update TOEFL_IS_600 SET lala_incorrect = lala_incorrect +1 where english = '$title'";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        
	}
	else if($_POST[choice] != $cor)
	{
		echo '<br><br>回答錯誤！<br>';
        $sql="select * from `joefan`.`TOEFL_IS_600` where id = '$cor'";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        if($data=$result -> fetch_row())
        {
            $title = $data['2'];
        }
        
		$sql = "insert into exam_600_record (id, english, correct_time, false_time, time , user) values ( '".$cor."','".$title."', '', '', now(), '".$username."' )";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        $sql = "update exam_600_record SET false_time = false_time +1 where english = '$title'";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error()); 
		echo "累計正確次數：";
		$sql="SELECT correct_time AS C1 FROM exam_600_record WHERE `id`=$cor";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        $row=$result -> fetch_array();
		echo $row['C1'];
		echo "次，錯誤次數：";
		$sql="SELECT false_time AS C2 FROM exam_600_record WHERE `id`=$cor";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
        $row=$result -> fetch_array();
		echo $row['C2'];
		echo "次。";
		echo '<br>';
        
        $sql = "Update TOEFL_IS_600 SET lala_incorrect = lala_incorrect +1 where english = '$title'";
        $result = $mysqli -> query($sql) or die("無法執行：".mysql_error());
	}

$sql="select * from TOEFL_IS_600 where id = '$cor'";
//$result = mysql_query($sql) or die("無法執行：".mysql_error());
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());

//while($row=mysql_fetch_assoc($result))
while($row = $result -> fetch_row()){
echo " - English：" . $row["2"]. "<br>- Pronunciation：[".$row["3"]. "]<br>- Meaning：".$row["4"]." " . $row["6"]. "";
}
}
?>
</body>
</html>