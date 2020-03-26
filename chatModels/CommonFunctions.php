<?php
	
	//require 'filterInputs\filter.php';


	class CommonFunctions{

		function CommonFunctions(){
		}

		
		function getFilterFunc(){
			$filter = function (&$data, $chr = '"'){
				if(gettype($data) !== "string")
					return $data;

				$yeni = "";

				$count = strlen($data);
				for ($i=0; $i < $count; $i++) {
					if($data[$i] == $chr && $data[$i-1] != '\\'){
						$yeni .= '\\'.$chr;
						continue;
					}
					
					$yeni .= $data[$i];
				}
				$data = $yeni;
			};
			return $filter;
		}

		function map($func, &...$args){
			foreach ($args as &$value) {
				$func($value);
			}
		}

		function append2ArrayElementsWithComma($arr){
			$filter = $this->getFilterFunc();
			$newString = "";
			$counter = 0;
			foreach ($arr as $key => $value) {
				if($counter !== 0) $newString .= ",";
				$this->map($filter, $key, $value);
				$newString .= "$key=$value";
				$counter++;
			}

			return $newString;
		}

		function appendArrayElementsWithComma($arr){
			$filter = $this->getFilterFunc();
			$newString = "";
			$counter = 0;
			foreach ($arr as $value) {
				if($counter !== 0) $newString .= ",";
				$filter($value);				
				$newString .= "$value";
				$counter++;
			}

			return $newString;	
		}

		function checkValues($arr, $arr2){
			try {
				$counter = 0;
				//print_r($arr)."<br>".print_r($arr2);
				foreach ($arr as $key => $value) {
					if(gettype($value) !== $arr2[$counter])
						throw new Exception($key . " should be " . $arr2[$counter]);
					$counter++;
				}
			} catch (Exception $e) {
				echo "exception in CommonFunctions: " . $e->getMessage() . " inşaALLAH <br>" ;
				exit();
			}
		}

		function appendArrayElements($arr){
			$allColumns = "";
			$count = count($arr);

				for ($i=0; $i < $count; $i++) { 
					if($i == $count - 1)
						$allColumns .= $arr[$i];
					else
						$allColumns .= $arr[$i] . ", ";
				}

			return $allColumns;
		}
	}

	//echo ($pos = strpos('Ahmet"', '"'));
?>