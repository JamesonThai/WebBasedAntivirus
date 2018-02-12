<?php
/* Reads the file in input per bytes and, if it is a putative infected file, searches within the file for one of the strings stored in the database
If it's 0 then there's no matching pattern, if 1 there's a mattching pattern and returns the name of the malware if there's anything

*/
	function breakDown($input){
		require_once 'login.php';
		$query = "SELECT * FROM knownMalware";
		$result = $connection -> query($query);
		if (!$result) die ($connection ->error);
		elseif ($result->num_rows)	{
			$foundValue = 0;
			$ending = "";
			while (($row = $result->fetch_array(MYSQLI_NUM)) && ($foundValue === 0)){
				$temp = $row[2];
				$pattern = "/$row[2]/";
				$foundValue = preg_match($pattern, $input);
				if ($foundValue == 1) {
					$ending = $row[1];
				}
			}
			$result->close();
			return $ending; 
		}
		else{
				header('WWW-Authenticate: Basic realm="Restricted Section“');
				header('HTTP/1.0 401 Unauthorized');
				die ("Unauthorized access");
		}
	}
	
/*
Reads the file in input per bytes and, if is a surely infected one, store the sequence of bytes, say, the first 20 bytes (signature) of the file, in a database
*/

	function storeReadInput($input){
		require 'login.php';
		$subquery = "INSERT INTO knownMalware VALUES (NULL, 'NewlyDiscovered', '$input', CURRENT_TIMESTAMP)";
		$subresult = $connection -> query($subquery);
		if (!$subresult) die ($connection->error);
	}
?>