		function id(_id){
			return document.getElementById(_id);
		}

		function getClass(_class){
			return document.getElementsByClassName(_class);
		}

		function ajaxSendMessage(idownerinshaALLAH, idotherinshaALLAH, messageinshaALLAH, change){
			let xmlHttpinshaALLAH = "";
			if (window.XMLHttpRequest)
				xmlHttpinshaALLAH = new XMLHttpRequest();
			else xmlHttpinshaALLAH = new ActiveXObject("Microsoft.XMLHTTP");

			xmlHttpinshaALLAH.onreadystatechange = function(){
				if(this.readyState === 4 && this.status === 200)
					if(this.responseText == "success inshaALLAH")
						console.log("success inshaALLAH");
					else if(this.responseText == "failure")
						console.log("failure");
			}

			xmlHttpinshaALLAH.open("POST", "../../chatController/activeUsers/ajax/sendMessage.php", true);
			
			xmlHttpinshaALLAH.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
			xmlHttpinshaALLAH.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			
			xmlHttpinshaALLAH.send(encodeURIComponent("idownerinshaALLAH")+"="+encodeURIComponent(idownerinshaALLAH) + "&" + encodeURIComponent("idotherinshaALLAH") + "=" 
				+ encodeURIComponent(idotherinshaALLAH) + "&" + encodeURIComponent("messageinshaALLAH") + "=" + encodeURIComponent(messageinshaALLAH) + "&" + encodeURIComponent("change")+
				"=" + encodeURIComponent(change));
		}

		function ajaxReadMessage(idownerinshaALLAH, idotherinshaALLAH, change){
			let xmlHttpinshaALLAH = "";
			if (window.XMLHttpRequest)
				xmlHttpinshaALLAH = new XMLHttpRequest();
			else xmlHttpinshaALLAH = new ActiveXObject("Microsoft.XMLHTTP");

			xmlHttpinshaALLAH.onreadystatechange = function(){
				if(this.readyState === 4 && this.status === 200){
					let messagesinshaALLAH = JSON.parse(this.responseText);;
					for(let i = 0; i < messagesinshaALLAH.length ; i++)
						sendmessageotherinshaALLAH("", messagesinshaALLAH[i]);
				}
			}

			xmlHttpinshaALLAH.open("POST", "../../chatController/activeUsers/ajax/readMessage.php", true);
			
			xmlHttpinshaALLAH.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
			xmlHttpinshaALLAH.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			
			xmlHttpinshaALLAH.send(encodeURIComponent("idownerinshaALLAH")+"="+encodeURIComponent(idownerinshaALLAH) + "&" + encodeURIComponent("idotherinshaALLAH") + "=" 
				+ encodeURIComponent(idotherinshaALLAH) + "&" + encodeURIComponent("change") + "=" + encodeURIComponent(change));
		}