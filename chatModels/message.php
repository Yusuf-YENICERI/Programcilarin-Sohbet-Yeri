<?php
	
	require 'id1_id2_oto.php';

	class Message extends id1_id2_oto{
		function Message($idSender, $messsage, $idGetter){
			id1_id2_oto::id1_id2_oto($idSender, $messsage, "", $idGetter);
		}

		function addMessage(){
			return $this->addDatas();
		}
	}
?>