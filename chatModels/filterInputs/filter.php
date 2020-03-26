<?php

	class Filter{
		function filter($data){
			$count = count($arr);

			for ($i=0; $i < $count ; $i++) { 
				if ($arr[$i] == '"') {
					$arr[$i] = "\"";
				}
			}

			return $data;
		}
	}
?>