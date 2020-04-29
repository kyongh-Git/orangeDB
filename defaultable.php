<?php
			$db_host = 'localhost';
			$db_name = 'orangeDB';
			$db_user = 'root';
			$db_pass = 'kimdyd123';
			// echo 'Connection on';
			$db_link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("Could not connect to database server"); 
			mysqli_select_db($db_link, $db_name) or die("Could not select database");
			// var_dump($db_link);
			$CWIDSearchResult = mysqli_query($db_link, "SELECT * FROM living;");
			echo "<table>
			<tr>
			<th>livingID</th>
			<th>name</th>
			<th>price</th>
			<th>address</th>
			<th>zipcode</th>
			</tr>";
			while($row = mysqli_fetch_array($CWIDSearchResult)) {
				echo "<tr>";
				echo "<td>" . $row['livingID'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['price'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				echo "<td>" . $row['zipcode'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
			// mysqli_query($db_link, $query);
			// echo 'Connection done';
			mysqli_close($db_link);
		?>

