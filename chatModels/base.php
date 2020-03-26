<?php

	/**
	 * 
	 */
	class Base
	{
		function printTable(){
			foreach ($this->getAllDatas() as $k => $v) {
					foreach ($v as $ke => $val) {
						foreach ($val as $key => $value) {
							echo "$key||$value<br>";
						}
					}
					echo "<br>";
				}
		}
	}

?>