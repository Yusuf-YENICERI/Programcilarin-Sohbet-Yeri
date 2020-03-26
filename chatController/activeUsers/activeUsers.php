<?php
	
	require '../../chatModels/users.php';

	$errorPage = "Location: http://localhost:8080/chat/chatView/login/sign_in.html";

	session_start();

	if(!isset($_SESSION['firstName']) || !isset($_SESSION['lastName'])){
		header($errorPage);
	}
?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>Aktif Kullanıcılar</title>
	<link rel="stylesheet" type="text/css" href="../../chatView/activeUsers/active_users.css">
	<script src="../../chatView/activeUsers/active_users.js"></script>
	<script type="text/javascript">

		function getNameFromClass(_this){
			return _this.childNodes[3].childNodes[0].innerText;
		}

		function rootToOtherLocation(){
			this.getIdFromClass = getIdFromClass;

			let id = this.getIdFromClass();
			let namesurnameinshaALLAH = getNameFromClass(this);
			//let idOwner = "php echo $_SESSION['id'] ?>";

			let userSectionClass = getClass("userSection");
			userSection = userSectionClass[0];

			userSection.innerHTML += '<form action="../../chatController/chatScreen/chatScreen.php" method="post" name="senddatainshaALLAH"><input type="hidden" name="id1" value="'+ id +'"><input type="hidden" name="id3" value="' + namesurnameinshaALLAH + '"></form>'

			document.senddatainshaALLAH.submit();
		}

		function isEmpty(obj){
			for(var i in obj)
				if(obj.hasOwnProperty(i))
					return false;
			return true;
		}

		/*function addusernumbersinshaALLAH(_id){
			let xmlHttpinshaALLAH = "";
			if (window.XMLHttpRequest)
				xmlHttpinshaALLAH = new XMLHttpRequest();
			else xmlHttpinshaALLAH = new ActiveXObject("Microsoft.XMLHTTP");

			xmlHttpinshaALLAH.onreadystatechange = function(){
				if(this.readyState === 4 && this.status === 200)
					console.log("ELHAMDÜLİLLAH, RABBİME ŞÜKÜRLER OLSUN.");
			}

			xmlHttpinshaALLAH.open("POST", "../../chatController/activeUsers/ajax/getusernumbersinshaALLAH.php", true);
			
			xmlHttpinshaALLAH.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
			xmlHttpinshaALLAH.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

			xmlHttpinshaALLAH.send(encodeURIComponent("id2")+"="+encodeURIComponent(_id));
			}*/

		function getusernumbersinshaALLAH(){
			let xmlHttpinshaALLAH = "";
			if (window.XMLHttpRequest)
				xmlHttpinshaALLAH = new XMLHttpRequest();
			else xmlHttpinshaALLAH = new ActiveXObject("Microsoft.XMLHTTP");

			xmlHttpinshaALLAH.onreadystatechange = function(){
				if(this.readyState === 4 && this.status === 200){
					const obj = JSON.parse(this.responseText);
					if(!isEmpty(obj)){
						let cls = getClass('userName');
						let cls2 = getClass('userRow');
						for(let i = 0; i < cls.length; i++){
							let id = cls[i]['id'];
							if(obj.hasOwnProperty(id))
								if(typeof(cls2[i].childNodes[7]) === "undefined"){
									cls2[i].innerHTML += '<td class="userColumn"><section class="notificationinshaALLAH">' + obj[id] + '</section></td>';
								}else
									cls2[i].childNodes[7].childNodes[0].innerText = obj[id];
						}
					}
				}
			}

			xmlHttpinshaALLAH.open("GET", "../../chatController/activeUsers/ajax/getusernumbersinshaALLAH.php", true);
			
			xmlHttpinshaALLAH.send();
		}

		window.onload = function() {
			addEventListenerToClass(getClass("userRow"), "click", rootToOtherLocation);
			
			let objInterval = increaseScale("activeUsers", 1.1, 1.1, 0.1, 0.1);
			checkStatusRunFunction(objInterval, changeRotate, "activeUsers");

			changeColor("userOnline", "red", function(_class, _color){if(_class.innerText == "Offline")
						_class.style.backgroundColor = _color;});

			addPadding();

			window.setInterval(()=>{animateText("moveinshaALLAH")}, 6000);
			window.setInterval(getusernumbersinshaALLAH, 1000);
		}

	</script>
</head>
<body>

	<header class="headerClass"><span class="moveinshaALLAH">A</span><span class="moveinshaALLAH">k</span><span class="moveinshaALLAH">t</span><span class="moveinshaALLAH">i</span><span class="moveinshaALLAH">f</span> <span class="moveinshaALLAH">K</span><span class="moveinshaALLAH">u</span><span class="moveinshaALLAH">l</span><span class="moveinshaALLAH">l</span><span class="moveinshaALLAH">a</span><span class="moveinshaALLAH">n</span><span class="moveinshaALLAH">ı</span><span class="moveinshaALLAH">c</span><span class="moveinshaALLAH">ı</span><span class="moveinshaALLAH">l</span><span class="moveinshaALLAH">a</span><span class="moveinshaALLAH">r</span></header>

	<section class="userSection">
		<table class="userTable" id="activeUsers">

			<?php

				$user = new Users();

				$arrUser = $user->getAllDatas();
				$nameSurname = "";
				$online = "Online";
				$id = -1;
				foreach ($arrUser as $k => $v) { //row
									foreach ($v as $ke => $val) { //0
										foreach ($val as $key => $value) { //first_name
											switch ($key) {
												case 'id':
														$id = $value;
														break;
												case 'first_name':
														$nameSurname .= $value;
													break;
												case 'last_name':
														$nameSurname .= " $value";
													break;
												case 'online':
														if($value === "1")
															$online = "Online";
														else
															$online = "Offline";
													break;
											}
										}
									}
									if($id !== $_SESSION['id'])
									echo '<tr class="userRow">
											<td class="userColumn"><img class="userPhoto" src="../../chatView/activeUsers/asd.jpg" alt="foto yok"></td>
											<td class="userColumn"><section id="'.$id.'" class="userName">'.$nameSurname.'</section></td>
											<td class="userColumn" style=""><section class="userOnline"><section class="userOnlineText">'.$online.'</section></section></td>
										</tr>
										<tr class="userRowSpace"><td class="userAddSpace"></td></tr>';

								$nameSurname = "";
								$online = "";
								$id = -1;
						}
			?>

			
			
			<tr class="userRow">
				<td class="userColumn"><img class="userPhoto" src="../../chatView/activeUsers/skype_user.png" alt="foto yok"></td>
				<td class="userColumn"><section id="5" class="userName">Mustafa</section></td>
				<td class="userColumn" style=""><section class="userOnline"><section class="userOnlineText">Online</section></section></td>
			</tr>
		</table>
	</section>
</body>
</html>