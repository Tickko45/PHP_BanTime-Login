<html>
<head>
<title>PHP_BanTime-Login</title>
</head>
<body>
<form name="form1" method="post" action="check_login.php">
  Login<br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td> &nbsp;Username</td>
        <td>
          <input name="txtUsername" type="text" id="txtUsername">
        </td>
      </tr>
      <tr>
        <td> &nbsp;Password</td>
        <td><input name="txtPassword" type="password" id="txtPassword">
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <input type="submit" name="Submit" value="Login">
</form>

<br>

<h1>User Test</h1>
<br>
<p>Username : test</p>
<p>Password : 1234</p>
<br>
<p>Username : admin</p>
<p>Password : 1234</p>
<br>
<b>หากกรอกรหัสผิดเกินจำนวณ 3 ครั้ง Username จะโดน Lock เป็นเวลา 1 นาที</b>

<p>ต้นฉบับ : https://www.thaicreate.com/community/php-mysqli-login-invalid-lock.html</p>
</body>
</html>