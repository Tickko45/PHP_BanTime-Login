<?php

	$LimitTime = 3; // Count Password Lock
	$BanTime = 1; // Minute Lock

	session_start();

	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "banTime-login";

	$objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	
	// Reset Ban
	$strSQL = "UPDATE member  SET LoginCount = 0 , FlagLock = 'No' WHERE BanExpire <= NOW()  AND LoginCount = '".$LimitTime."' ";
	$objQuery = mysqli_query($objCon,$strSQL);

	// Check Login
	$strSQL = "SELECT * FROM member WHERE Username = '".mysqli_real_escape_string($objCon,$_POST['txtUsername'])."' ";
	$objQuery = mysqli_query($objCon,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
	if(!$objResult)
	{
			echo "Not Found User!";
			exit();
	}
	else
	{
		if($objResult["FlagLock"] == "Yes")
		{
			echo "This user account is lock!";
			exit();
		}

		if($objResult["Password"] != $_POST["txtPassword"])
		{
			echo "Password Incorrect!";
			
			// Update Login Failed
			$strSQL = "UPDATE member  SET LoginCount = LoginCount + 1 WHERE Username = '".mysqli_real_escape_string($objCon,$_POST['txtUsername'])."' ";
			$objQuery = mysqli_query($objCon,$strSQL);

			// If more than limit time auto lock account
			if($objResult["LoginCount"] + 1 >= $LimitTime)
			{
				$strSQL = "UPDATE member  SET FlagLock = 'Yes' , BanExpire = DATE_ADD(NOW(),INTERVAL $BanTime MINUTE)  WHERE Username = '".mysqli_real_escape_string($objCon,$_POST['txtUsername'])."' ";
				$objQuery = mysqli_query($objCon,$strSQL);
			}

			exit();
		}
		else
		{
			// Login Success
			$_SESSION["UserID"] = $objResult["UserID"];

			session_write_close();
			
			// Reset LoginCount
			$strSQL = "UPDATE member  SET LoginCount = 0 WHERE Username = '".mysqli_real_escape_string($objCon,$_POST['txtUsername'])."' ";
			$objQuery = mysqli_query($objCon,$strSQL);
			
			header("location:user_page.php");
		}
	}
	mysqli_close($objCon);
?>
