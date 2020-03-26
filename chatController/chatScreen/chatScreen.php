<?php
	
	require '../../chatModels/id1_id2_oto.php';

	$errorPage = "Location: http://localhost:8080/chat/chatView/login/sign_in.html";

	session_start();

	if(!isset($_SESSION['firstName']) || !isset($_SESSION['lastName']) || !isset($_SESSION['id'])){
		header($errorPage);
	}

	$profileName = $_SESSION['firstName']." ".$_SESSION['lastName'];


	
	$idotherinshaALLAH = "";
	$idownerinshaALLAH = intval($_SESSION['id']);
	$namesurnameinshaALLAH = "";

	if(isset($_POST['id1']) && isset($_POST['id3'])){
		$idotherinshaALLAH = intval($_POST['id1']);
		$namesurnameinshaALLAH = $_POST['id3'];
	}else
		header($errorPage);

	$o = new id1_id2_oto($idownerinshaALLAH, '', '', $idotherinshaALLAH);

	$result = $o->makeTableAddConstraint();
	if($result === "exist inshaALLAH")
	{
		$change = 1;
	}else
		$change = 0;
?>

<!DOCTYPE html>
<html>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>Sohbet Ekranı</title>
	<link rel="stylesheet" type="text/css" href="../../chatView/chatScreen/chatScreen.css">
	<script src="../../chatView/chatScreen/chatScreen.js" ></script>
	<script type="text/javascript">
		
		window.onload = function(){
			window.setInterval(()=>{let idownerinshaALLAH = "<?php echo $idownerinshaALLAH ?>";
				let idotherinshaALLAH = "<?php echo $idotherinshaALLAH ?>";
				let change = "<?php echo $change ?>";
				ajaxReadMessage(idownerinshaALLAH, idotherinshaALLAH, change);},500);
		}	

		function sendMessageOwnerinshaALLAH(event, text){
			if(event.keyCode === 13){
				event.preventDefault();
				
				id("messageinputinshaALLAH").value = "";

				let messageScreenClass = getClass("messageScreen");
				let messageScreen = messageScreenClass[0];
				
				let profileName = "<?php echo $profileName ?>";
				let message = '<section class="messageText"><table class="alignToRight"><tr><td><section class="profileMessageRight">' + text + '<section></td><td class="profileColumn"><section class="profilePhotoNameContainerRight"><table><tr><td align="right"><img class="profilePhoto" src="sil2.jpg"></td></tr><tr><td><span class="profileName">' + profileName + '</span></td></tr></table></section></td></tr></table></section>';

				messageScreen.innerHTML += message;

				let messageTextClass = getClass('messageText');
				if(messageTextClass.length>1)
					messageTextClass[messageTextClass.length-2].style.animation = "";
				messageTextClass[messageTextClass.length-1].style.animation = "smoothtransitioninshaALLAH 3s"; 

				window.scrollTo(0, messageScreen.clientHeight);

				let idownerinshaALLAH = "<?php echo $idownerinshaALLAH ?>";
				let idotherinshaALLAH = "<?php echo $idotherinshaALLAH ?>";
				let textinshaALLAH = text;
				let change = "<?php echo $change ?>";

				ajaxSendMessage(idownerinshaALLAH, idotherinshaALLAH, textinshaALLAH, change);

			}
		}

		function sendmessageotherinshaALLAH(event = "", text){
			if(event.keyCode === 13 || event === ""){
				if(event !== "")
					event.preventDefault();
				
				id("messageinputinshaALLAH").value = "";

				let messageScreenClass = getClass("messageScreen");
				let messageScreen = messageScreenClass[0];
				
				let profileName = "<?php echo $namesurnameinshaALLAH ?>";
				let message = '<section class="messageText"><table class="alignToLeft"><tr><td class="profileColumn"><section class="profilePhotoNameContainer"><table><tr><td align="right"><img class="profilePhoto" src="sil.jpg"></td></tr><tr><td><span class="profileName">' + profileName + '</span></td></tr></table></section></td><td><section class="profileMessage">' + text + '<section></td></tr></table></section>';
				
				messageScreen.innerHTML += message;

				let messageTextClass = getClass('messageText');
				if(messageTextClass.length>1)
					messageTextClass[messageTextClass.length-2].style.animation = "";
				messageTextClass[messageTextClass.length-1].style.animation = "smoothtransitioninshaALLAH 3s";

				window.scrollTo(0, messageScreen.clientHeight);
			}	
		}
	</script>
</head>
<body>
	<section>
		<section class="messageScreen">
		<!--	<section class="messageText">
				<table class="alignToRight">
					<tr>
							<td>
							<section class="profileMessageRight">
								Selamunaleyküm kardeşim
								<section>
						</td>
						<td class="profileColumn">
							<section class="profilePhotoNameContainerRight">
								<table>
									<tr>
										<td align="right"><img class="profilePhoto" src="sil2.jpg"></td>
									</tr>
									<tr>
										<td><span class="profileName">Can Duran</span></td>
									</tr>
								</table>
							</section>
						</td>
					
					</tr>

				</table>
			</section>
			<section class="messageText">
				<table class="alignToLeft">
					<tr>
						<td class="profileColumn">
							<section class="profilePhotoNameContainer">
								<table>
									<tr>
										<td align="right"><img class="profilePhoto" src="sil.jpg"></td>
									</tr>
									<tr>
										<td><span class="profileName">Ahmet</span></td>
									</tr>
								</table>
							</section>
						</td>
						<td>
							<section class="profileMessage">Aleykümselam kardeşim<section>
						</td>
					</tr>

				</table>
			</section>
			<section class="messageText">
				<table class="alignToLeft">
					<tr>
						<td class="profileColumn">
							<section class="profilePhotoNameContainer">
								<table>
									<tr>
										<td><img class="profilePhoto" src="sil.jpg"></td>
									</tr>
									<tr>
										<td><span class="profileName">Ahmet</span></td>
									</tr>
								</table>
							</section>
						</td>
						<td>
							<section class="profileMessage">Nasılsın, iyisin inşaALLAH?</section>
						</td>
					</tr>

				</table>
			</section>
			<section class="messageText">
				<table class="alignToRight">
					<tr>
						<td>
							<section class="profileMessageRight">Elhamdülillah, iyiyim kardeşim. Sen nasılsın?</section>
						</td>

						<td class="profileColumn">
							<section class="profilePhotoNameContainerRight">
								<table>
									<tr>
										<td><img class="profilePhoto" src="sil2.jpg"></td>
									</tr>
									<tr>
										<td><span class="profileName">Ahmet</span></td>
									</tr>
								</table>
							</section>
						</td>
					</tr>

				</table>
			</section>-->
		</section>
		<section class="messageContainer"><input id="messageinputinshaALLAH" onkeyup="sendMessageOwnerinshaALLAH(event, this.value)" type="text" name="" class="message"></section>
	</section>
</body>
</html>