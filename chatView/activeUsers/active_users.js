		function id(_id){
			return document.getElementById(_id);
		}

		function getClass(_class){
			return document.getElementsByClassName(_class);
		}

		function changeTheClass(_className, _attr, _prop, _index = -1){
			if(_index === -1)
				for(let i = 0; i < _className.length; i++)
					_className[i].style[_attr] = _prop;
			else
				_className[_index].style[_attr] = _prop;
		}

		function addEventListenerToClass(_className, _eventName, _func){
			for (let i = 0; i < _className.length; i++) {
				_className[i].addEventListener(_eventName, _func);
			}
		}

		function getIdFromAllClass(_className){
			const arr = [];
			for(let i = 0; i < _className.length; i++)
				arr.append(_className[i].childNodes[3].lastChild.id);
			return childNodes[3].lastChild.id;
		}

		function getIdFromClass(){
			return this.id;
		}
		let _window = this;

		/*function rootToOtherLocation(){
			this.getIdFromClass = getIdFromClass;
			let id = this.getIdFromClass();
			_window.location.href = "http://localhost:8080/chat/chatView/login/sign_in.html?id="+id;
			
			let idOwner = "<?php echo $_SESSION['id'] ?>";

			let userSectionClass = getClass("userSection");
			userSection = userSectionClass[0];

			userSection.innerHTML += '<form action="../../chatController/chatScreen/chatScreen.php" method="post" name="senddatainshaALLAH"><input type="hidden" name="id1" value='+ id +'"><input type="hidden" name="id2" value="' + idOwner + '"></form>'

			document.senddatainshaALLAH.submit();
		}*/

		function increaseScale(_id, _w, _h, sW = 1, sH = 1, func, ...arr){
			let w = sW;
			let h = sH;
			const objInterval = {_interval : 0};
			objInterval._interval = 
			window.setInterval(increase, 20);
				function increase(){
						if(w < _w && h < _h)
							id(_id).style.transform = "scale("+w.toString() + "," + h.toString() + ")";
						else{
							window.clearInterval(objInterval._interval);
							objInterval._interval = 0;
							func(...arr);
						}
					w+=0.1;
					h+=0.1;
				}
			return objInterval;
		}

		function decreaseScale(_id, _w, _h){
			let w = _w;
			let h = _h;
			const objInterval = {_interval : 0};
			objInterval._interval = 
			window.setInterval(decrease, 20);
				function decrease(){
						if(w > 1 && h > 1)
							id(_id).style.transform = "scale("+w.toString() + "," + h.toString() + ")";
						else{
							window.clearInterval(objInterval._interval);
							objInterval._interval = 0;
						}
					w-=0.1;
					h-=0.1;
				}
			return objInterval;
		}

		function changeRotate(_id){
			let rotaLeft = 0;
			let rotaRight = 0;
			const objInterval = {_interval: window.setInterval(change, 10)};
				function change(){
						if(rotaLeft < 10){
							id(_id).style.transform = "rotate(" + (rotaLeft>5?10-rotaLeft:rotaLeft) + "deg) scale(1.15,1.15)";
							rotaLeft++;
						}else if(rotaRight < 15){
							id(_id).style.transform = "rotate(" + (rotaRight>7?rotaRight-15:-rotaRight) + "deg) scale(1.15,1.15)";
							rotaRight++;
						}else{
							id(_id).style.transform = "rotate(0deg) scale(1.15, 1.15)";
							rotaLeft = rotaRight = 0;
							window.clearInterval(objInterval._interval);
							objInterval._interval = 0;
							setTimeout(()=>(objInterval._interval = window.setInterval(change, 10)), 2000);
						}
				}

			return objInterval;
		}

		function checkStatusRunFunction(checkObj, func, ...arr){
			let objInterval = {_interval : 0};
			objInterval._interval = window.setInterval(run, 20);
				
				function run(){
					//debugger;
					if(checkObj._interval == 0){
						func(...arr);
						window.clearInterval(objInterval._interval);
					}
				}

			return objInterval; 
		}

		function changeColor(_class, _color, _func){
			let classes = getClass(_class);

			for (let i = 0; i < classes.length; i++) {
				_func(classes[i], _color);
			}
		}

		function addPadding(){
			let usrClmn = getClass("userOnline");
			let hdrCls = getClass("headerClass");

			// if(usrClmn.length > 5)
				//hdrCls[0].style.paddingBottom = 
				//usrClmn.length/2.1 + "%";
		}

		function animateText(_class){
			let textClasses = getClass(_class);
			function increase(_element ,_prop, _limOld, _limNew, _pre = "", _post = ""){
				
				let i = _limOld;
				
				function proc(){
					//debugger;
					if(i > _limNew){
						window.clearInterval(objInterval._interval);
						objInterval._interval = 0;
					}else{
						let build = _pre + i + _post;
						_element.style[_prop] = build;
						i+=0.1;
					}
				}

				const objInterval = {_interval : 0};
				objInterval._interval = window.setInterval(proc, 15);

				return objInterval;
			}

			function decrease2(_element ,_prop, _limOld, _limNew, _pre = "", _post = ""){
				
				let i = _limOld;
				function proc2(){

					//debugger;
					if(i < _limNew){
						window.clearInterval(objInterval._interval);
						objInterval._interval = 0;
					}
					else{
						let build = _pre + i + _post;
						_element.style[_prop] = build;
						i-=0.1;
					}
				}

				const objInterval = {_interval : 0};
				objInterval._interval = window.setInterval(proc2, 15);

				return objInterval;
			}

			let delay = 0;
			for (let i = 0; i < textClasses.length; i++, delay += 20) {
				setTimeout(()=>{let objInterval = increase(textClasses[i], "transform", 1, 2, "scale(" , ")");
				checkStatusRunFunction(objInterval, decrease2, textClasses[i], "transform", 2, 1, "scale(" , ")");},delay); 
			}
		}