			function id(_id){
			return document.getElementById(_id);
		}

		function getClass(_class){
			return document.getElementsByClassName(_class);
		}


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
							id(_id).style.transform = "rotate(" + (rotaLeft>5?10-rotaLeft:rotaLeft) + "deg) scale(2,2)";
							rotaLeft++;
						}else if(rotaRight < 15){
							id(_id).style.transform = "rotate(" + (rotaRight>7?rotaRight-15:-rotaRight) + "deg) scale(2,2)";
							rotaRight++;
						}else{
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
					if(checkObj._interval == 0){
						func(...arr);
						window.clearInterval(objInterval._interval);
					}
				}

			return objInterval; 
		}

		function getUrlParams(){
			let url = window.location.href;
			let start = 0;
			let query = "";
			for(let i = 0; i < url.length; i++){
				if(start)
					query += url[i];
				if(url[i] == "?")
					start = 1;
			}

				/*function removeElements(_id){
					id(_id).parentNode.removeChild(_id);
				}

				function addElements(_id){

				}*/

			return query;
		}

		function stringToArray(_str){
			let arr = [];
			for(let i = 0; i < _str.length; i++)
				arr.push(Number(_str[i]));

			return arr;
		}

		function changeTheClass(_className, _attr, _prop, _index = -1){
			console.log(_index);
			if(_index === -1)
				for(let i = 0; i < _className.length; i++)
					_className[i].style[_attr] = _prop;
			else
				_className[_index].style[_attr] = _prop;
		}

		function checkEmail(_text){
			if(_text.match(/[A-Za-z1-9\.]+\@[A-Za-z1-9]+\.[A-Za-z1-9]+/i) == _text)
			{
				changeTheClass(getClass("popup"), "visibility", "hidden", 1);
			}else{
				changeTheClass(getClass("popup"), "visibility", "visible", 1);
				changeTheClass(getClass("popup"), "animation", "toUp 1s", 1);
			}
		}


		function checkAge(_text){
			if(Number(_text.match(/[1-9]+/i)) == Number(_text))
			{
				changeTheClass(getClass("popup"), "visibility", "hidden", 0);
			}else{
				changeTheClass(getClass("popup"), "visibility", "visible", 0);
				changeTheClass(getClass("popup"), "animation", "toUp 1s", 0);
			}	
		}