<?php
	
	require 'base.php';
	require 'db.php';

	class oto_table extends Base{
		function oto_table($idFrom, $idTo, $date = "", $oto_big_id = 0, $readinshaALLAH = 0){
			$this->idFrom = $idFrom;
			$this->idTo = $idTo;
			$this->date = $date;
			$this->oto_big_id = $oto_big_id;
			$this->readinshaALLAH = $readinshaALLAH;

			$this->addValuesToArr();
			$this->format = array('integer','integer','string', 'integer');

			$this->db = new Db("chat");

			$this->db->checkValues($this->arr, $this->format);

			$this->filterInputs();			
		}

		function addValuesToArr(){
			$this->arr = array('idFrom'=>$this->idFrom, 'idTo'=>$this->idTo, 'date'=>$this->date, 'readinshaALLAH'=>$this->readinshaALLAH);
		}

		function filterInputs(){
			$this->db->map($this->db->getFilterFunc(), $this->oto_big_id, $this->idFrom, $this->idTo, $this->date, $this->readinshaALLAH);

			$this->addValuesToArr();
		}

		function addDatas($arrValues = array(), $tableName = "oto_table", $arrColumns = array()){

			if($arrValues === array())
				$arrValues = array("$this->idFrom, $this->idTo");

			if($arrColumns === array())
				$arrColumns = array('idFrom','idTo');

			return $this->db->insertDatas($tableName, $arrValues, $arrColumns);
		}

		function addreadinshaALLAHData($tableName = "oto_table"){

			return $this->db->updateTable($tableName, array("readinshaALLAH"=>"1"), "idFrom=$this->idFrom and idTo=$this->idTo");

		}

		function getAllDatas($arrColumns = array(),  $arrCondition = array(), $tableName = "oto_table"){
			if($arrColumns === array())
				$arrColumns = array('oto_big_id','idFrom','idTo','date','readinshaALLAH');

			return $this->db->printTable($arrColumns, $tableName, $arrCondition);
		}
	}



	//echo (new oto_table(40, 41))->addreadinshaALLAHData();

?>