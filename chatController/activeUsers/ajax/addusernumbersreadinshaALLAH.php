<?php

	require '../../../chatModels/oto_table.php';

	$errorPage = "../../../chatView/login/sign_in.html";

	$idownerinshaALLAH = intval($_SESSION['id']);
	$idotherinshaALLAH = 0;

	if(isset($_POST['id2'])){
		$idotherinshaALLAH = intval($_POST['id2']);
	}else
		header($errorPage);

	$o_table = new oto_table($idownerinshaALLAH, $idotherinshaALLAH);

	$o_table->addreadinshaALLAHData();
?>