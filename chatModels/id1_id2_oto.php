<?php

require 'oto_table.php';

class id1_id2_oto extends Base{

	function id1_id2_oto($idSender, $message = "", $date = "", $idGetter = 0, $oto_id = 0){
		$this->oto_id = $oto_id;
		$this->idSender = $idSender;
		$this->idGetter = $idGetter;
		$this->date = $date;
		$this->message = $message;

		$this->db = new Db('chat');

		$this->addValuesToArr();

		$this->format = array('integer','integer','string','string');

		$this->db->checkValues($this->arr, $this->format);
		$this->filterInputs();
	}

	function addValuesToArr(){
		$this->arr = array('idSender'=>$this->idSender,'idGetter'=>$this->idGetter,'date'=>$this->date,'message'=>$this->message);
	}

	function filterInputs(){
		$this->db->map($this->db->getFilterFunc(), $this->oto_id, $this->idSender, $this->idGetter, $this->date, $this->message);

		$this->addValuesToArr();
	}

	function makeTable($tableName = "", $arrColumns = array()){
		if($tableName === "")
			$tableName = $this->idSender."_".$this->idGetter."_oto";

		$otherTableName = $this->idGetter."_".$this->idSender."_oto";
		$tableNamesArr = $this->db->getTables();

		$makeinshaALLAH = 1;
		foreach ($tableNamesArr as $key => $value) {
			if($value === $otherTableName)
				$makeinshaALLAH = 0;
		}

		if($makeinshaALLAH == 1){
		
			if($arrColumns === array())
				$arrColumns = array('oto_id int primary key auto_increment not null','idSender int not null','date timestamp not null','message text default \'\'', 'readinshaALLAH bool default 0');

			return $this->db->makeTable($tableName, $arrColumns);
		
		}

		return "exist inshaALLAH";
	}

	function addConstraint($tableName = "", $constraintName = "", $foreignKey = ""){
		if($tableName === "")
			$tableName = $this->idSender."_".$this->idGetter."_oto";

		if($constraintName === "")
			$constraintName = $tableName . "_users";

		if($foreignKey === "")
			$foreignKey = "idSender";

		return $this->db->addConstraint($tableName, $constraintName, $foreignKey, "users", "id");
	}

	function makeTableAddConstraint(){
		$result =  $this->makeTable();
		$this->addConstraint();
		if(!($result === "exist inshaALLAH")){
			$this->o_table = new oto_table($this->idSender, $this->idGetter);
			$this->o_table->addDatas();
			$this->o_table->addreadinshaALLAHData();
		}
		return $result;
	}

	function addDatas($idSender = 0, $arrValues = array(), $tableName = "", $arrColumns = array()){

		if($idSender === 0)
			$idSender = $this->idSender;

		if($tableName === "")
			$tableName = $this->idSender."_".$this->idGetter."_oto";

		if($arrValues === array()){
			$arrValues = array("$idSender,'$this->message'");
			if($arrColumns === array())
				$arrColumns = array('idSender','message');
		}

		if ($arrColumns === array()) {
			$arrColumns = array('idSender','message');
		}

		return $this->db->insertDatas($tableName, $arrValues, $arrColumns);
	}

	function getAllDatas($arrColumns = array(), $tableName = "", $arrCondition = array()){
		if($arrColumns === array())
			$arrColumns = array('oto_id','idSender','message','date','readinshaALLAH');

		if($tableName === "")
			$tableName = $tableName = $this->idSender."_".$this->idGetter."_oto";

		return $this->db->printTable($arrColumns, $tableName, $arrCondition);
	}

	function messagereadinshaALLAH($messageIdinshaALLAH, $idGetter = 0){
		if($idGetter === 0)
			$idGetter = $this->idGetter;

		$tablenameinshaALLAH = $this->idSender . "_" . $this->idGetter . "_oto";

		$this->db->updateTable($tablenameinshaALLAH, array('readinshaALLAH'=>'1'), "oto_id=$messageIdinshaALLAH and idSender=$idGetter");		
	}
}

//$o1 = new id1_id2_oto(40, 'naber kanka', '', 41);

//$o2 = new id1_id2_oto(47, '', '', 2);

//echo $o2->makeTableAddConstraint();

//$o1->printTable();
//echo $o1->addDatas(41);
//echo $o1->addConstraint();

//$o = new id1_id2_oto(52, 'BİSMİLLAH', '', 53);

//$o->makeTableAddConstraint();*/

//$o->addDatas(52);

//$o->messageReadinshaALLAH(1, 52);
?>