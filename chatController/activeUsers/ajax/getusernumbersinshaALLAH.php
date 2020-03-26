<?php
	
	require '../../../chatModels/oto_table.php';

	function changearrinshaALLAH(&$value, $key)
	{
		if(isset($value[$key]))
			$value[$key] += 1;
		else
			$value[$key] = 1;
	}

	session_start();

	$o_table = new oto_table(0, 0);

	$id = intval($_SESSION['id']);
	$arrOtos = $o_table->getAllDatas();

	$otoArr = array();
	foreach ($arrOtos as $k => $v) {
		$idFrom = -1;
		$idTo = -1;
		$readinshaALLAH = 2;
	 	foreach ($v as $ke => $val) {
	 		foreach ($val as $key => $value) {
	 			switch ($key) {
	 				case 'idFrom':
	 					$idFrom = intval($value);
	 					break;
	 				case 'idTo':
	 					$idTo = intval($value);
	 					break;
	 				case 'readinshaALLAH':
	 					$readinshaALLAH = intval($value);
	 					break;
	 			}
	 		}
	 	}
	 	if($readinshaALLAH !== 1)
	 		if($idFrom === $id)
	 			changearrinshaALLAH($otoArr, $idTo);
	 		else if($idTo === $id)
	 			changearrinshaALLAH($otoArr, $idFrom);
	 }

	 echo json_encode($otoArr);

?>