<?php
			$CWID = $_POST["CWID"];
			$password = $_POST["password"];
			$count = 0;
			
			$db_host = 'localhost';
			$db_name = 'orangeDB';
			$db_user = 'root';
			$db_pass = 'kimdyd123';
			// echo 'Connection on';
			$db_link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("Could not connect to database server"); 
			mysqli_select_db($db_link, $db_name) or die("Could not select database");
			// var_dump($db_link);
			$CWIDSearchResult = mysqli_query($db_link, "SELECT CWID FROM renter WHERE CWID = '$CWID';");
			// while ($row = mysqli_fetch_array($CWIDSearchResult)) {
				// $count++;
				// print("$row[CWID]<br>");
			// }
			while ($CWIDrow = mysqli_fetch_array($CWIDSearchResult)) 
			{
				if($CWIDrow[CWID] != NULL)
				{
					$count = $count + 1;
				}
			}

			if($count == 0)
			{
				$error = "CWID you typed doesn't exist";	
				die($error);
			}
			
			$passCount = 0;
			$passMatch = mysqli_query($db_link, "SELECT password FROM renter WHERE CWID = '$CWID';");
			// while ($row = mysqli_fetch_array($CWIDSearchResult)) {
				// $count++;
				// print("$row[CWID]<br>");
			// }
			while ($Passrow = mysqli_fetch_array($passMatch)) 
			{
				if($Passrow[password] != NULL)
				{
					$passCount = $passCount + 1;
				}
			}	

			if($passCount == 0)
			{
				$error = "Password you typed doesn't match";	
				die($error);
			}			
			
			$query = "DELETE FROM renter WHERE CWID = '$CWID';";
			mysqli_query($db_link, $query);
			// echo 'Connection done';
			mysqli_close($db_link);

			
?>