<?php
			$CWID = $_POST["CWID"];
			$password = $_POST["password"];
			$repassword = $_POST["password2"];
			$firstName = $_POST["firstName"];
			$lastName = $_POST["lastName"];
			$country = $_POST["country"];
			$age = $_POST["age"];
			$phone = $_POST["phone"];
			$status = $_POST["status"];
			$major = $_POST["major"];
			$level = $_POST["level"];
			
			// echo $CWID;
			
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
			while ($row = mysqli_fetch_array($CWIDSearchResult)) 
			{
				if($row[CWID] != NULL)
				{
					$error = "CWID you typed already exist";
					echo '<script type="text/JavaScript"> alert("CWID duplicate"); </script>';
					echo "<a href='javascript:history.back(1);'>Go back to previous page</a>";
					echo "<br>";
					echo "<br>";
					die($error);
					die($error);
				}
			}

			$query = "INSERT INTO renter (CWID, password, firstName, lastName, country, age, phoneNum) VALUES ('$CWID', '$password', '$firstName', '$lastName', '$country', $age, '$phone');";
			mysqli_query($db_link, $query);
			
			if($status == "student")
			{
				$queryStd = "INSERT INTO student (CWID, major, level) VALUES ('$CWID', '$major', '$level');";
				mysqli_query($db_link, $queryStd);
			}
			else if($status == "staff")
			{
				$queryStf = "INSERT INTO staff (CWID) VALUES ('$CWID');";
				mysqli_query($db_link, $queryStf);
			}
			
			
			// echo 'Connection done';
			mysqli_close($db_link);
			echo '<script type="text/JavaScript"> alert("Your account is successfully created!"); </script>';
			echo "<script> window.close();</script>";
?>