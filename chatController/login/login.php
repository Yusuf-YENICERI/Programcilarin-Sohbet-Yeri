<?php

	class Login{

		function Login($firstName, $lastName, $email, $age = 0, $languages="", $technologies="", $ip_address = "", $port = 0){
			$this->firstName = $firstName;
			$this->lastName = $lastName;
			$this->email = $email;
			$this->age = $age;
			$this->languages = $languages;
			$this->technologies = $technologies;
			$this->ip_address = $ip_address;
			$this->port = $port;

			$this->validateHSC($this->firstName, $this->lastName, $this->email, $this->languages, $this->technologies);
			echo "$this->firstName<br>$this->lastName<br>$this->email";
			$this->user = new Users(0, $this->firstName, $this->lastName, $this->age, $this->email, "", $this->ip_address, $this->port, $this->technologies, $this->languages);

			
		}

		/*
		/general validate
		*/

		function validate(&...$args){
			$newFunc = function(&$data){
				$filterFunc = $this->user->db->getFilterFunc();
				$filterFunc($data, "'");
			};

			$filterFunc = function(&$data){
				$filterFunc = $this->user->db->getFilterFunc();
				$filterFunc($data, '"');
			};

			foreach ($args as &$data) {
				$data = htmlspecialchars($data);

				$this->user->db->map($filterFunc, $data);
				$this->user->db->map($newFunc, $data);
			}
		}

		/*
		/validate html special chars
		*/

		function validateHSC(&...$args){
			foreach ($args as &$value) {
				$value = htmlspecialchars($value);
			}
		}

		function checkUser(){
			$arrUser = $this->user->getAllDatas();
			try{
				$userFound = function($arrUser){
						$check_arr = array(1,1,1);
						$check = 1;
						foreach ($arrUser as $k => $v) { //row
									foreach ($v as $ke => $val) { //0
										foreach ($val as $key => $value) { //first_name
											switch ($key) {
												case 'first_name':
													if($value == $this->firstName){
														$check_arr[0] = 0;
													}
													else
														$check_arr[0] = 1;

													break;
												case 'last_name':
													if($value == $this->lastName){
														$check_arr[1] = 0;
													}
													else
														$check_arr[1] = 1;
													break;
												case 'email':
													if($value == $this->email){
														$check_arr[2] = 0;
													}
													else
														$check_arr[2] = 1;
													break;
											}

											$check = $check_arr[0] || $check_arr[1] || $check_arr[2];
											if(!$check){
												$this->id = $v[0]['id'];
												return true;
											}
										}
									}
									$check_arr = array(1,1,1);
						}
						return false;
					};

				if(!$userFound($arrUser))
					//header($this->signInError);
					return "failure";
				else
					//header($this->activeUsersGo);
					return "success";				
			}catch(Exception $e){
				echo "Hata: " . $e->getMessage() . "<br>";
			}
		}

		function getIdinshaALLAH(){
			$result = $this->user->getAllDatas(array("first_name='$this->firstName' and last_name='$this->lastName' and age=$this->age and email='$this->email' and ip_address='$this->ip_address'"));
			return $result[0][0]['id'];
		}

		function addUser(){
			$result = $this->user->addNewUser(); //"success"
			$this->id = $this->getIdinshaALLAH();
			return $result;
		}

		function startSession(){
			try{
			session_start();
			$_SESSION['firstName'] = $this->firstName;
			$_SESSION['lastName'] = $this->lastName;
			$_SESSION['id'] = $this->id;
			return "success";
			}catch(Exception $e){
				echo "Exception in login.php: session can't be started inshaALLAH <br>";
				return "failure";
			}
		}

		function destroySession(){
			try {
				session_destroy();
				return "success";				
			} catch (Exception $e) {
				echo "Exception in login.php: session can't be destroyed inshaALLAH <br>";
				return "failure";		
			}
		}

		function makeOnline(){
			try {
				$_user = $this->user;
				if($this->user->updateUsers(array('online'=>'1'),"first_name='$_user->first_name' and last_name='$_user->last_name' and email='$_user->email'") == "success")
					return "success";
				else
					return "failure";
			} catch (Exception $e) {
				echo "Exception in login.php: session can't be destroyed inshaALLAH <br>";	
			}
		}

		function makeOffline(){
			try {
				if($this->user->updateUsers(array('online'=>'0'), "first_name='$this->user->firstName' and last_name='$this->user->lastName' and email='$this->user->email'") == "success")
					return "success";
				else
					return "failure";
			} catch (Exception $e) {
				echo "Exception in login.php: session can't be destroyed inshaALLAH <br>";	
			}
		}
	}

	/*
	/	Get All Post Parameters
	*/
	function gapp($glob, $name, $data){
		if(isset($glob[$name])){
			$data = $glob[$name];
			return $data;
		}else{
			return "fail";
		}
	}

	function isFail(...$args){
		foreach ($args as $value) {
			if($value == 'fail')
				return 1;
		}	
	}
?>