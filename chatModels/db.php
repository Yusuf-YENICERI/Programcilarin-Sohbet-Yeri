<?php
	
	$BİSMİLLAHİRRAHMANİRRAHİM = true;

	//error_reporting(0);
	
	/*class rror{
		function print($var, $varType, $wantedType){
			try{
				if(gettype($wantedType) != "string" || gettype($var) != "string")
					throw new Exception("wantedType and var should be string");

				if($varType != $wantedType)
					return new Exception($var . " should be " . $wantedType);
			}catch(Exception $e){
				echo "Exception: " . $e->getMessage() . " inşaALLAH <br>";
			}
		}
	}*/

	require 'CommonFunctions.php';

	class Db extends CommonFunctions{

		function Db($db_name, $server_name = "localhost", $user_name="root", $password=""){
				$this->server_name = $server_name;
				$this->user_name = $user_name;
				$this->password = $password;
				$this->db_name = $db_name;
				$this->con = $this->connectToDb();
		}

		function __destructor(){
			$this->con->close();
		}

		function connectToDb(){
			try{
				$con = new mysqli($this->server_name, $this->user_name,
					$this->password, $this->db_name);

				if($con->connect_error)
					throw new Exception("can't connect to db inshaALLAH <br>");

				return $con;
			
			}catch(Exception $e){
				echo "exception: " . $e->getMessage() . "inşaALLAH <br>";
			}
		}

		/*function appendArrayElements($arr){
			$allColumns = "";
			$count = count($arr);

				for ($i=0; $i < $count; $i++) { 
					if($i == $count - 1)
						$allColumns .= $arr[$i];
					else
						$allColumns .= $arr[$i] . ", ";
				}

			return $allColumns;
		}*/

		function insertDatas($tableName, $arrValues, $columns = array()){
			try{

				if(gettype($tableName) !==  "string")
					throw new Exception("tableName should be string");
				if(gettype($columns) !== "array")
					throw new Exception("columns should be array");
				if(gettype($arrValues) !== "array")
					throw new Exception("values should be array");
				
				$this->map($this->getFilterFunc(), $tableName);
					
				$allColumns = $this->appendArrayElementsWithComma($columns);

				$query = "";

				if($columns !== array()){
					foreach ($arrValues as $val) {
						$this->map($this->getFilterFunc(), $val);

						$query = "insert into " . $tableName . " (" . $allColumns . ") values( " . $val . ");";
						
						$result[] = $this->con->query($query) === true ? "success" : "failure";
					}
				}
				else{
					foreach ($arrValues as $val) {
						$this->map($this->getFilterFunc(), $val);

						$query .= "insert into " . $tableName . " values( " . $val . ");";

						$result[] = $this->con->query($query) === true ? "success" : "failure";	
					}
				}

				
				foreach ($result as $val) {
					if($val === "failure")
						throw new Exception('insert failed, ' . $this->con->error);
				}
				
				return "success";

			}catch(Exception $e){
				echo "exception " . $e->getMessage() . " inşaALLAH <br>";
			}
		}

		function printTable($columns, $tableName, $arrCondition = array()){
			try{
				if(gettype($columns) !== "array")
					throw new Exception("columns should be array");
				if(gettype($tableName) !== "string")
					throw new Exception("tableName should be string");
				if(gettype($arrCondition) !== "array")
					throw new Exception("condition should be array");

				$this->map($this->getFilterFunc(), $tableName);

				$allColumns = $this->appendArrayElementsWithComma($columns);
				
				$query =  "select " . $allColumns . " from " . $tableName;
				
				if($arrCondition !== array()){
					$allCondition = $this->appendArrayElementsWithComma($arrCondition);
					$query .=  " where " . $allCondition . ";";
				}

				$results = $this->con->query($query);

				if($results->num_rows > 0){
					$outerArray = array();
					while ($row = $results->fetch_assoc()) {
							$count = 0;
							$arrayName = [];
							foreach ($row as $value) {
								$arrayName[] = array($columns[$count] => $value );
								$count++;
							}
							$outerArray[] = $arrayName;
					}

					return $outerArray;
				}
				else
					throw new Exception('query wrong, ' . $this->con->error);

			}catch(Exception $e){
				echo "exception " . $e->getMessage() . " inşaALLAH <br>";
			}
		}

		function updateTable($tableName, $arrSetThing, $arrCondition = ""){
			try{
				if(gettype($tableName) !== "string")
					throw new Exception("arrTableName should be string");
				if(gettype($arrSetThing) !== "array")
					throw new Exception("arrSetThing should be array");
				if (gettype($arrCondition) !== "string")
					throw new Exception("arrCondition should be string");
				
				$this->map($this->getFilterFunc(), $tableName);

				$allSetThing = $this->append2ArrayElementsWithComma($arrSetThing);

				if($arrCondition !== "")
				{
					$query = "update " . $tableName . " set " . $allSetThing . " where " . $arrCondition . ";";
				}else{
					$query = "update " . $tableName . " set " . $allSetThing .";";
				}

				if($this->con->query($query) === true)	return "success";
				else return 'failure: ' . $this->con->error . " inshaALLAH <br>";
				
				
			}catch(Exception $e){
				echo "exception " . $e->getMessage() . " inşaALLAH <br>" ;
			}
		}

		function deleteData($tableName, $arrCondition = array()){
			try {
				if(gettype($tableName) !== 'string')
					throw new Exception("tableName should be string");
				if(gettype($arrCondition) !== 'array')
					throw new Exception("condition should be string");

				$this->map($this->getFilterFunc(), $tableName);
				
				if($arrCondition !== array())
					$allCondition = $this->appendArrayElementsWithComma($arrCondition);


				$query = "delete from " . $tableName . " where " . $allCondition . ";";

				if($this->con->query($query) === true)	return "success inşaALLAH";
				else return 'failure: ' . $this->con->error . " inshaALLAH <br>";

			} catch (Exception $e) {
				echo "exception " . $e->getMessage() . "inşaALLAH <br>";
			}
		}

		function makeTable($tableName, $arrColumns){
			try {
				if(gettype($tableName) !== "string")
					throw new Exception("tableName should be string");
				if(gettype($arrColumns) !== "array")
					throw new Exception("columns should be array");

				$this->map($this->getFilterFunc(), $tableName);
				
				$allColumns = $this->appendArrayElementsWithComma($arrColumns);

				$query = "create table " . $tableName . "( " . $allColumns . " );";
				if($this->con->query($query) === true)	return "success";
				else return 'failure: ' . $this->con->error . " inshaALLAH <br>";
					
			} catch (Exception $e) {
				echo "exception " .$e->getMessage() . " inşaALLAH <br>" ;
			}
		}

		function addConstraint($tableName, $constraintName, $foreignKey, $referencedTableName, $referencedPrimaryKey){
			try {
				if(gettype($tableName) !== "string")
					throw new Exception("tableName should be string");
				if(gettype($constraintName) !== "string")
					throw new Exception("columns should be string");
				if(gettype($foreignKey) !== "string")
					throw new Exception("foreignKey should be string");
				if(gettype($referencedTableName) !== "string")
					throw new Exception("referencedTableName should be string");
				if(gettype($referencedPrimaryKey) !== "string")
					throw new Exception("referencedPrimaryKey should be string");

				$this->map($this->getFilterFunc(), $tableName, $constraintName, $foreignKey, $referencedTableName, $referencedPrimaryKey);

				$query = "alter table " . $tableName . " add constraint " . $constraintName . " foreign key( " . $foreignKey . " ) references " . $referencedTableName . " ( " . $referencedPrimaryKey . " );";

				if($this->con->query($query) === true)	return "success";
				else return 'failure: ' . $this->con->error . " inshaALLAH <br>";
					
			} catch (Exception $e) {
				echo "exception " .$e->getMessage() . " inşaALLAH <br>" ;
			}
		}

		function getTables(){
			try {
			
			$results = $this->con->query('show tables');
				if($results->num_rows > 0){
					$outerArray = array();
					$counter = 0;
					while ($row = $results->fetch_assoc()) {
							$outerArray[$counter++] = $row['Tables_in_chat'];
					}

					return $outerArray;
				}
				else
					throw new Exception('query wrong, ' . $this->con->error);
			} catch (Exception $e) {
				
			}
		}
	}

	$db1 = new Db('chat');

	//$db1->addConstraint('users','2_1_oto','')

	//echo $db1->makeTable('sil',array('id int primary key','name nvarchar(50)','solike timestamp'));

	//echo $db1->deleteData('users',array('age=21'));

	//$db1->updateTable('users',array('first_name'=>'\'Can"\'','last_name'=>"'Dan'"),array('age=21'));

	//print_r($db1->printTable(array('first_name','last_name','age','email','reg_date','ip_address','port','online'), 'users',array('port>80')));

	//echo $db1->insertDatas('users',array("'Ahmet\"\"','Soy', 21, 'asoy@gmail.com', '1998-09-24 23:44:01', '192.168.1.100', 80, 1"), array('first_name','last_name','age','email','reg_date','ip_address','port','online'));

	//'Ahmet"', "Bol", 21, "abol@gmail.com", "1998-09-24 23:44:01", "192.168.1.1", 80, 1

	//echo $db1->addConstraint('deneme2','deneme2_deneme','id2','deneme1','id');

	//echo $db1->makeTable('deneme','id int, name varchar(50), timer timestamp');

	/*$data = $db1->printTable(array('id','first','last','email','reg_date'),'guests');
	foreach ($data as $key => $value) {
			echo $key . " || " . print_r($value) . "<br>";
	}*/

	/*echo $db1->insertData('users',array('id','name','age'),array("2, 'Can',19","5,'Mehmet',35"));*/

	//echo $db1->deleteData('users',"age=19");
	?>