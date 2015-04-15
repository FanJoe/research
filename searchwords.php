<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
$username = $_SESSION['username'];

echo "Hi，";
echo $username;
echo "<br>";
?>
<html>
<body>
<form method="post" action="searchwords_finish.php">
	<br>查詢單字：<input type="text" name="eng"/></br>
	<input type="submit" value="查詢">&nbsp;&nbsp;
	<input type ="button" onclick="javascript:location.href='member.php'" value="回上頁"></input>
</form>
</body>
<p align="middle">
<?php
echo '<br>';
echo "-近期查詢-";
echo '<br>';
$sql="select `english` as `English`, MAX(`time`) as `Latest time`, COUNT(`english`) as `Times` from search_record where `user`='$username' group by `english`order by searchnum DESC limit 0, 10";
$result = $mysqli -> query($sql) or die("無法執行：".mysql_error());

echo "<table border=1><tr>";
while($field=$result->fetch_field())
{
    echo "<th>{$field->name}</th>";
}
echo "</tr>";

while($row=$result->fetch_row())
{
    echo "<tr>";
    foreach($row as $value)
    {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

$result->free();


/*while ($search = $result -> fetch_row())
{
echo $search['a'];
echo "-";
echo $search['b'];
echo '-';
echo $search['c'];    
echo '<br>';
}*/

?>
</p>
</html>