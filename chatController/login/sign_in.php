<?php

	require '../../chatModels/users.php';

	require 'login.php';

	$signInError = "Location: http://localhost:8080/chat/chatView/login/sign_in.html?error";
	$activeUsersGo = "Location: http://localhost:8080/chat/chatController/activeUsers/activeUsers2.php";

	$isim = "";
	$soyisim = "";
	$email = "";

	$isim = gapp($_POST, 'isim', $isim);
	$soyisim = gapp($_POST, 'soyisim', $soyisim);
	$email = gapp($_POST, 'email', $email);

	if(!isFail($isim, $soyisim, $email)){
		$login = new Login($isim, $soyisim, $email);
		if($login->checkUser() === "success"){
			if($login->startSession() === "success"){
				if($login->makeOnline() === "success")
					header($activeUsersGo);
				else
					echo "an error occured in sign_in.php inşaALLAH: makeOnline failed";
			}else
				echo "an error occured in sign_in.php inşaALLAH: startSession failed";
		}else
			//echo "an error occured in sign_in.php inşaALLAH: checkUser failed";
			header($signInError);
	}else{
		header($signInError);
	}

?>