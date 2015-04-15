<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form name="form" method="post" action="register_finish.php">
姓名：<input type="text" name="name"/><br>
帳號(請輸入email)：<input type="text" name="id"/><br>
密碼：<input type="password" name="pw"/><br>
再一次輸入密碼：<input type="password" name="pw2"/><br>
<!--Email：<input type="text" name="email"><br>-->
手機號碼：<input type="text" name="num"><br>

驗證碼：(點擊圖片可刷新)<br><input name="imgCode" type="text">
<img onclick="this.src='image.php?rand='+Math.random()" src="image.php" title="點擊更換驗證碼" height="30" width="60"/><br>
<input type="submit" name="button" value="送出"/>
</form>