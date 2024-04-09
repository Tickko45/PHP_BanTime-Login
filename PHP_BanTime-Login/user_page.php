<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}
	
	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "banTime-login";

	$objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$strSQL = "SELECT * FROM member WHERE UserID = '".$_SESSION['UserID']."' ";
	$objQuery = mysqli_query($objCon,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
?>
<html>
<head>
<title>ThaiCreate.Com Tutorials</title>
</head>
<body>
  Welcome to Page! <br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td width="87"> &nbsp;Username</td>
        <td width="197"><?php echo $objResult["Username"];?>
        </td>
      </tr>
      <tr>
        <td> &nbsp;Name</td>
        <td><?php echo $objResult["Name"];?></td>
      </tr>
    </tbody>
  </table>
  <a href="logout.php">Logout</a>
</body>
</html>
<?php
	mysqli_close($objCon);
?>