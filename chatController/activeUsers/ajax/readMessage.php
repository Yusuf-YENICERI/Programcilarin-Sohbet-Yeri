<?php
	
	require '../../../chatModels/id1_id2_oto.php';

	//echo "BİSMİLLAHİRRAHMANİRAHİM";

	
	$idownerinshaALLAH = "";
	$idotherinshaALLAH = "";

	if(isset($_POST['idownerinshaALLAH']) && isset($_POST['idotherinshaALLAH'])){
		$idownerinshaALLAH = intval($_POST['idownerinshaALLAH']);
		$idotherinshaALLAH = intval($_POST['idotherinshaALLAH']);
	}

	if(intval($_POST['change']) == 1){
			$keep = $idownerinshaALLAH;
			$idownerinshaALLAH = $idotherinshaALLAH;
			$idotherinshaALLAH = $keep;
	}

	$o = new id1_id2_oto($idownerinshaALLAH, '', '', $idotherinshaALLAH);
	$o_table = new oto_table($idownerinshaALLAH, $idotherinshaALLAH);

	$basearrinshaALLAH = $o->getAllDatas();

	if(intval($_POST['change']) == 1){
			$keep = $idownerinshaALLAH;
			$idownerinshaALLAH = $idotherinshaALLAH;
			$idotherinshaALLAH = $keep;
	}


	$messagesinshaALLAH = array();
	foreach ($basearrinshaALLAH as $k => $v) {
		$messageidinshaALLAH = -1;
		$idSender = -1;
		$message = "";
		$readinshaALLAH = 0;
		
		foreach ($v as $ke => $val) {
			foreach ($val as $key => $value) {
				switch ($key) {
					case 'oto_id':
						$messageidinshaALLAH = $value;
						break;
					case 'idSender':
						$idSender = $value;
						break;
					case 'message':
						$message = $value;
						break;
					case 'readinshaALLAH':
						$readinshaALLAH = $value;
						break;
				}
			}
		}

		if($idSender == intval($idotherinshaALLAH)){
			$messagesinshaALLAH[] = $message;
			if($readinshaALLAH !== strval(1))
				$o->messagereadinshaALLAH($messageidinshaALLAH, $idotherinshaALLAH);
			else
				array_pop($messagesinshaALLAH);
		}
	}

	echo json_encode($messagesinshaALLAH);

?>