<?php

	require '../../chatModels/users.php';

	require 'login.php';

	$signUpError = "Location: http://localhost:8080/chat/chatView/login/sign_up.html?error";
	$activeUsersGo = "Location: http://localhost:8080/chat/chatController/activeUsers/activeUsers2.php";

	$isim = "";
	$soyisim = "";
	$email = "";
	$age = "";
	$languages = "";
	$technologies = "";
	$ip_address = "";
	$port = "";
		
	$isim = gapp($_POST, 'isim', $isim);
	$soyisim = gapp($_POST, 'soyisim', $soyisim);
	$email = gapp($_POST, 'email', $email);
	$age = intval(gapp($_POST, 'yas', $age));
	$languages = gapp($_POST, 'languages', $languages);
	$technologies = gapp($_POST, 'technologies', $technologies);
	$ip_address = gapp($_SERVER, 'REMOTE_ADDR', $ip_address);
	$port = intval(gapp($_SERVER, 'REMOTE_PORT', $port));
	
	if(!isFail($isim, $soyisim, $email, $age, $languages, $technologies, $ip_address, $port)){
		$login = new Login($isim, $soyisim, $email, $age, $languages, $technologies, $ip_address, $port);
		if($login->addUser() === "success")
			if($login->startSession() === "success")
				header($activeUsersGo);
			else
				echo "inşaALLAH sign_up da hata oluştu: startSession failed";
		else
				echo "inşaALLAH sign_up da hata oluştu: addUser failed";
	}else{
				header($signUpError);
	}

?>