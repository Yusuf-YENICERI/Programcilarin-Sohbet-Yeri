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
	<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy|Poiret+One|Bangers|Orbitron|Turret+Road|Saira+Stencil+One&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="../../chatView/activeUsers/active_users2.css">
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
			
			let objInterval = increaseScale("userSectionWrapper", 1.1, 1.1, 0.1, 0.1);
			checkStatusRunFunction(objInterval, changeRotate, "userSectionWrapper");

			changeColor("userOnline", "red", function(_class, _color){if(_class.innerText == "Offline")
						_class.style.backgroundColor = _color;});

			addPadding();

			window.setInterval(()=>{animateText("moveinshaALLAH")}, 6000);
			window.setInterval(getusernumbersinshaALLAH, 1000);
		}

	</script>
</head>
<body>

	<section class="userSection">
		<section class="userSectionWrapper">
			<header class="headerClass"><span class="moveinshaALLAH">A</span><span class="moveinshaALLAH">k</span><span class="moveinshaALLAH">t</span><span class="moveinshaALLAH">i</span><span class="moveinshaALLAH">f</span> <span class="moveinshaALLAH">K</span><span class="moveinshaALLAH">u</span><span class="moveinshaALLAH">l</span><span class="moveinshaALLAH">l</span><span class="moveinshaALLAH">a</span><span class="moveinshaALLAH">n</span><span class="moveinshaALLAH">ı</span><span class="moveinshaALLAH">c</span><span class="moveinshaALLAH">ı</span><span class="moveinshaALLAH">l</span><span class="moveinshaALLAH">a</span><span class="moveinshaALLAH">r</span></header>
		</section>


<?php		

	
	$user = new Users();

	$arrUser = $user->getAllDatas();
	$nameSurname = "";
	$online = "Online";
	$id = -1;
	$technologies = "";
	$languages = "";

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
								$online = "Aktif";
							else
								$online = "Offline";
						break;
					case 'technologies':
							$technologies = $value;
					break;
					case 'languages':
							$languages = $value;
					break;
				}
			}
		}
		if($id !== $_SESSION['id'])
			echo '<section class="userSectionWrapper" id="'.$id.'">
			<section class="userSectionItem">
				<section class="userRow">
					<section class="userRowItem" style="flex:.1"></section>
					<section class="userRowItem" style="flex:1; align-self: center;">
						<img  class="userPhoto" src="sil.jpg">
					</section>
					<section class="userRowItem" style="flex: .1"></section>
					<section class="userRowItem" style="flex:2">
						<section class="userColumn">
							<p class="userName">'.$nameSurname.'</p>
							<p class="userOnline">'.$online.'</p>
						</section>
					</section>
					<section class="userRowItem" style="flex:5"></section>
					<section class="userRowItem" style="flex:1">
						<p class="userLangHeader">Bildiği Diller:</p>
					</section>
					<section class="userRowItem" style="flex:4;">
						<section class="userLang"><p>'.$languages.'</p></section>
					</section>
					<section class="userRowItem" style="flex:2"></section>
				</section>
				<section class="userRow">
					<section class="userRowItem" style="flex:.1"></section>
					<section class="userRowItem" style="flex:13">
						<section class="userRow" style="align-items: center;">
							<section class="userRowItem" style="flex: 8">
								<p class="userTech">Bildiği teknolojiler: '.$technologies.'</p>
							</section>
							<section class="userRowItem" style="flex: 5">
								<button class="userChat">Mesaj Gönder</button>
							</section>
						</section>
					</section>
				</section>
			</section>
		</section>';

		$nameSurname = "";
		$online = "";
		$id = -1;
	}
	?>

		<!-- <section class="userSectionWrapper">
			<section class="userSectionItem">
				<section class="userRow">
					<section class="userRowItem" style="flex:.1"></section>
					<section class="userRowItem" style="flex:1; align-self: center;">
						<img  class="userPhoto" src="sil.jpg">
					</section>
					<section class="userRowItem" style="flex: .1"></section>
					<section class="userRowItem" style="flex:2">
						<section class="userColumn">
							<p class="userName">Mehmet Kaya</p>
							<p class="userOnline">Aktif</p>
						</section>
					</section>
					<section class="userRowItem" style="flex:5"></section>
					<section class="userRowItem" style="flex:1">
						<p class="userLangHeader">Bildiği Diller:</p>
					</section>
					<section class="userRowItem" style="flex:4;">
						<section class="userLang"><p>C, C++, C#, Pyton, Java, Ruby, Rust, Go, Sql</p></section>
					</section>
					<section class="userRowItem" style="flex:2"></section>
				</section>
				<section class="userRow">
					<section class="userRowItem" style="flex:.1"></section>
					<section class="userRowItem" style="flex:13">
						<section class="userRow" style="align-items: center;">
							<section class="userRowItem" style="flex: 8">
								<p class="userTech">Bildiği teknolojiler: React, React Native, Redux inşaALLAH ...</p>
							</section>
							<section class="userRowItem" style="flex: 5">
								<button class="userChat">Mesaj Gönder</button>
							</section>
						</section>
					</section>
				</section>
			</section>
		</section>

		<section class="userSectionWrapper">
			<section class="userSectionItem">
				<section class="userRow">
					<section class="userRowItem" style="flex:.1"></section>
					<section class="userRowItem" style="flex:1; align-self: center;">
						<img  class="userPhoto" src="sil.jpg">
					</section>
					<section class="userRowItem" style="flex: .1"></section>
					<section class="userRowItem" style="flex:2">
						<section class="userColumn">
							<p class="userName">Mehmet Kaya</p>
							<p class="userOnline">Aktif</p>
						</section>
					</section>
					<section class="userRowItem" style="flex:5"></section>
					<section class="userRowItem" style="flex:1">
						<p class="userLangHeader">Bildiği Diller:</p>
					</section>
					<section class="userRowItem" style="flex:4;">
						<section class="userLang"><p>C, C++, C#, Pyton, Java, Ruby, Rust, Go, Sql</p></section>
					</section>
					<section class="userRowItem" style="flex:2"></section>
				</section>
				<section class="userRow">
					<section class="userRowItem" style="flex:.1"></section>
					<section class="userRowItem" style="flex:13">
						<section class="userRow" style="align-items: center;">
							<section class="userRowItem" style="flex: 8">
								<p class="userTech">Bildiği teknolojiler: React, React Native, Redux inşaALLAH ...</p>
							</section>
							<section class="userRowItem" style="flex: 5">
								<button class="userChat">Mesaj Gönder</button>
							</section>
						</section>
					</section>
				</section>
			</section>
		</section>

		<section class="userSectionWrapper">
			<section class="userSectionItem">
				<section class="userRow">
					<section class="userRowItem" style="flex:.1"></section>
					<section class="userRowItem" style="flex:1; align-self: center;">
						<img  class="userPhoto" src="sil.jpg">
					</section>
					<section class="userRowItem" style="flex: .1"></section>
					<section class="userRowItem" style="flex:2">
						<section class="userColumn">
							<p class="userName">Mehmet Kaya</p>
							<p class="userOnline">Aktif</p>
						</section>
					</section>
					<section class="userRowItem" style="flex:5"></section>
					<section class="userRowItem" style="flex:1">
						<p class="userLangHeader">Bildiği Diller:</p>
					</section>
					<section class="userRowItem" style="flex:4;">
						<section class="userLang"><p>C, C++, C#, Pyton, Java, Ruby, Rust, Go, Sql</p></section>
					</section>
					<section class="userRowItem" style="flex:2"></section>
				</section>
				<section class="userRow">
					<section class="userRowItem" style="flex:.1"></section>
					<section class="userRowItem" style="flex:13">
						<section class="userRow" style="align-items: center;">
							<section class="userRowItem" style="flex: 8">
								<p class="userTech">Bildiği teknolojiler: React, React Native, Redux inşaALLAH ...</p>
							</section>
							<section class="userRowItem" style="flex: 5">
								<button class="userChat">Mesaj Gönder</button>
							</section>
						</section>
					</section>
				</section>
			</section>
		</section>

		<section class="userSectionWrapper">
			<section class="userSectionItem">
				<section class="userRow">
					<section class="userRowItem" style="flex:.1"></section>
					<section class="userRowItem" style="flex:1; align-self: center;">
						<img  class="userPhoto" src="sil.jpg">
					</section>
					<section class="userRowItem" style="flex: .1"></section>
					<section class="userRowItem" style="flex:2">
						<section class="userColumn">
							<p class="userName">Mehmet Kaya</p>
							<p class="userOnline">Aktif</p>
						</section>
					</section>
					<section class="userRowItem" style="flex:5"></section>
					<section class="userRowItem" style="flex:1">
						<p class="userLangHeader">Bildiği Diller:</p>
					</section>
					<section class="userRowItem" style="flex:4;">
						<section class="userLang"><p>C, C++, C#, Pyton, Java, Ruby, Rust, Go, Sql</p></section>
					</section>
					<section class="userRowItem" style="flex:2"></section>
				</section>
				<section class="userRow">
					<section class="userRowItem" style="flex:.1"></section>
					<section class="userRowItem" style="flex:13">
						<section class="userRow" style="align-items: center;">
							<section class="userRowItem" style="flex: 8">
								<p class="userTech">Bildiği teknolojiler: React, React Native, Redux inşaALLAH ...</p>
							</section>
							<section class="userRowItem" style="flex: 5">
								<button class="userChat">Mesaj Gönder</button>
							</section>
						</section>
					</section>
				</section>
			</section>
		</section> -->
	</section>
</body>
</html>