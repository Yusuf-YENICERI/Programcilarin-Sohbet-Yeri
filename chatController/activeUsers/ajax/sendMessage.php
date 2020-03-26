<?php
	
	require '../../../chatModels/id1_id2_oto.php';

	$idownerinshaALLAH = "";
	$idotherinshaALLAH = "";
	$messageinshaALLAH = "";

	if(isset($_POST['idownerinshaALLAH']) && isset($_POST['idotherinshaALLAH']) && isset($_POST['messageinshaALLAH'])){
		$idownerinshaALLAH = intval($_POST['idownerinshaALLAH']);
		$idotherinshaALLAH = intval($_POST['idotherinshaALLAH']);
		$messageinshaALLAH = $_POST['messageinshaALLAH'];
	}else
		echo "failure";

	if(isset($_POST['change']))
		if(intval($_POST['change']) === 1)
		{
			$keep = $idownerinshaALLAH;
			$idownerinshaALLAH = $idotherinshaALLAH;
			$idotherinshaALLAH = $keep;
		}

	$o = new id1_id2_oto($idownerinshaALLAH, $messageinshaALLAH, '', $idotherinshaALLAH);
	$o_table = new oto_table($idownerinshaALLAH, $idotherinshaALLAH);

	if(isset($_POST['change']))
		if(intval($_POST['change']) === 1)
		{
			$keep = $idownerinshaALLAH;
			$idownerinshaALLAH = $idotherinshaALLAH;
			$idotherinshaALLAH = $keep;
		}
	
	$o->addDatas($idownerinshaALLAH);
	$o_table->addDatas();

	echo "success inshaALLAH";
?>