<?php
	
	require 'base.php';
	require 'db.php';

	class Users extends Base{

		function Users($id = 0, $first_name = "", $last_name = "", $age = 0,
		$email = "",  $reg_date = "", $ip_address = "", $port = 0, $technologies = "", $languages = "", $online = 1){
			$this->id = $id;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->age = $age;
			$this->email = $email;
			$this->reg_date = $reg_date;
			$this->ip_address = $ip_address;
			$this->port = $port;
			$this->online = $online;
			$this->technologies = $technologies;
			$this->languages = $languages;
			
			$this->addValuesToArr();
			$this->format = array('string','string','integer','string',  'string','string','integer','integer', 'string', 'string',);

			$this->db = new Db("chat");

			$this->db->checkValues($this->arr, $this->format);

			$this->filterInputs();
		}

		function addValuesToArr(){
			$this->arr = array('first_name' => $this->first_name, 'last_name' => $this->last_name, 'age' => $this->age, 'email' => $this->email,
			 'reg_date' => $this->reg_date, 'ip_address' => $this->ip_address, 'port' => $this->port, 'online' => $this->online,'technologies' => $this->technologies, 'languages' => $this->languages);
		}

		function filterInputs(){
			$this->db->map($this->db->getFilterFunc(), $this->id, $this->first_name, $this->last_name, $this->age,
						$this->email, $this->reg_date, $this->ip_address, $this->port, $this->online,$this->technologies, $this->languages);

			$newFunc = function(&$data){
				$filterFunc = $this->db->getFilterFunc();
				$filterFunc($data, "'");
			};

			$this->db->map($newFunc, $this->id, $this->first_name, $this->last_name, $this->age,
						$this->email, $this->reg_date, $this->ip_address, $this->port, $this->online, $this->technologies, $this->languages);
			
			$this->addValuesToArr();
		}

		function extractInsertingData(){
			$query = "";

			$counter = 0;
			$count = count($this->arr) - 1;

			foreach ($this->arr as $key => $value) {
				if(gettype($value) === "string")
					if($counter === $count)
						$query .= "'$value'";
					else
						$query .= "'$value',";
				else
					if($counter === $count)
						$query .= "$value";
					else
						$query .= "$value,";
				$counter++;
			}

			return $query;
		}

		function getAllDatas($condition = array()){
			return $this->db->printTable(array('id', 'first_name','last_name','age','email','reg_date','ip_address','port','online', 'technologies', 'languages'), 'users', $condition);
		}

		function addNewUser($arr = array(), $tableName = 'users'){
			
			if($arr === array()){
				$arr = $this->arr;
			}
				
			$new_arr = array();
			foreach ($arr as $key => $value) {
				$new_arr[] = $key;
			}

			return $this->db->insertDatas($tableName, array($this->extractInsertingData()), $new_arr);
		}


		function deleteUsers($condition, $tableName = 'users'){
			return $this->db->deleteData($tableName, $condition);
		}

		function updateUsers($arrSetThing, $arrCondition, $tableName = 'users'){
			return $this->db->updateTable($tableName, $arrSetThing, $arrCondition);
		}
	}

	//$u1 = new Users(1, 'Can', "Dan", 21, "abol@gmail.com", "1998-09-12 23:44:01", "192.168.1.218", 920, 0);
//" ' " -> ' " '
	//echo $u1->printTable();
//	echo "<br>";
//	echo $u1->deleteUsers('age=21');

	/*$f = 'Ahmet"';
	$f = '\'' . $f . '\'';

	$l = 'Bo';
	$l = '\'' . $l . '\'';
	echo $u1->updateUsers(array('first_name'=>$f, 'last_name'=>$l),array('age=21'));*/
?>