<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body>
<form name="form1" method="post" action="connect.php">
帳號：<input type="text" name="id" /> <br>
密碼：<input type="password" name="pw" /> <br>

驗證碼：(點擊圖片可刷新)<br><input name="imgCode" type="text">
<!--<br><br><img name="img" src="image.php" />-->
<img onclick="this.src='image.php?rand='+Math.random()" src="image.php" title="點擊更換驗證碼" height="30" width="60"/>
<!--<a href="JavaScript:reloadImage();">刷新</a>-->
<br><input type="submit" value="登入"><a href="register.php">註冊?</a>

</form>
</body>
</html>