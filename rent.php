<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>OrangeLiving.net: Apartment and dorm for Rent </title>
		<link rel="stylesheet" type="text/css" href="rent.css"/>
	</head>
	<body>
		<div class="mainWrapper">
			<header class="menubar">
				<div id="i1" class="item1">
					<a href="http://orangedatabase.ddns.net:8080" target="_self" title="logo"><img width="150" height="50" src="orange_logo.png"/></a>
				</div>
			</header>
			<div class="body-container">
				<h1 style="text-align:left"> Application </h1>
				<div class="bodycontainer" style="background-color: #FFA500">
					<h2 style="text-align:center"> Lease Summary </h2>
					<div class="houseone">
						<?php
							$livingID;
						
							$name;
							$price;
							$address;
							$city;
							$state;
							$zipcode;
							$roomtype;
							$age;
							$contact;
							$website;
							
							$staff;
							
							$db_host = 'localhost';
							$db_name = 'orangeDB';
							$db_user = 'root';
							$db_pass = 'kimdyd123';
							
							$db_link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("Could not connect to database server"); 
							mysqli_select_db($db_link, $db_name) or die("Could not select database");
							
							$link .= $_SERVER['REQUEST_URI']; 
							$zeropieces = explode("?", $link);
							$firstpieces = explode("=", $zeropieces[1]);//cwid
							$secondpieces = explode("=", $zeropieces[2]);//livingID
							$CWID = $firstpieces[1];
							$livingID = $secondpieces[1];
							
							$sql='SELECT * FROM living WHERE livingID = ';
							$sql.=$livingID;

							$Result = mysqli_query($db_link, $sql);
							
							while($row = mysqli_fetch_array($Result)) {
								$name = $row['name'];
								$price = $row['price'];
								$address = $row['address'];
								$city = $row['city'];
								$state = $row['state'];
								$zipcode = $row['zipcode'];
								$roomtype = $row['roomtype'];
								$age = $row['agelimit'];
								$contact = $row['contact'];
								$website = $row['website'];
							}
							echo "<h4> Property Name: " . $name . "</h4>";
							// echo "<br>";
							echo "<h4> Address: " . $address . ",  " . $city . ", " . $state . " " . $zipcode . "</h4>";
							
							echo "<h4> Price: $ " . $price . " 	     #Price for each month and each room</h4>";
							
							echo "<h4> Room Type: " . $roomtype . "</h4>";
							
							echo "<h4> Age Limit: " . $age . "</h4>";
							
							echo "<h4> Contact: " . $contact . "</h4>";
							
							echo "<h4> Official Website: " . $website . "</h4>";
							
							$sql='SELECT * FROM oncam WHERE livingID = ';
							$sql.=$livingID;
							$Result = mysqli_query($db_link, $sql);
							
							while($row = mysqli_fetch_array($Result)) {
								$staff = $row['staffavailable'];
							}
							
							if($staff == 1)
							{
								echo "<h4> Staff Available </h4>";
							}
							
							
							mysqli_close($db_link);
						?>
					</div>
						
					<div class="housetwo">
						<?php
							// $CWID;
							$livingID;
							
							$pool;
							$gym;
							$laundary;
							$parking;
							
							$db_host = 'localhost';
							$db_name = 'orangeDB';
							$db_user = 'root';
							$db_pass = 'kimdyd123';
							
							$db_link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("Could not connect to database server"); 
							mysqli_select_db($db_link, $db_name) or die("Could not select database");
							
							$link .= $_SERVER['REQUEST_URI']; 
							$zeropieces = explode("?", $link);
							$firstpieces = explode("=", $zeropieces[1]);//cwid
							$secondpieces = explode("=", $zeropieces[2]);//livingID
							$thirdpieces = explode("/", $secondpieces[1]);//livingID
							$CWID = $firstpieces[1];
							$livingID = $thirdpieces[0];
							
							$sql='SELECT * FROM offcam WHERE livingID = ';
							$sql.=$livingID;
							
							$Result = mysqli_query($db_link, $sql);

							while($row = mysqli_fetch_array($Result)) {
								$pool = $row['pool'];
								$gym = $row['gym'];
								$laundary = $row['laundary'];
								$parking = $row['parking'];
							}
							echo "<h3> Amenities: </h3>";
							if($pool == 1)
							{
								echo "<h4> Pool </h4>";
							}
							if($gym == 1)
							{
								echo "<h4> Gym </h4>";
							}
							if($laundary == 1)
							{
								echo "<h4> Laundary Place </h4>";
							}
							if($parking == 1)
							{
								echo "<h4> Parking Lot </h4>";
							}
							mysqli_close($db_link);
						?>
					</div>
					
				</div>
				<div class="contractor" style="background-color: lightgray">
					<h2 style="text-align:center"> Contractor Summary </h2>
					<?php
						$CWID;
					
						$firstName;
						$lastName;
						$country;
						$age;
						$phoneNum;
								
						$db_host = 'localhost';
						$db_name = 'orangeDB';
						$db_user = 'root';
						$db_pass = 'kimdyd123';
						
						$db_link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("Could not connect to database server"); 
						mysqli_select_db($db_link, $db_name) or die("Could not select database");
						
						$link .= $_SERVER['REQUEST_URI']; 
						$zeropieces = explode("?", $link);
						$firstpieces = explode("=", $zeropieces[1]);//cwid
						$CWID = $firstpieces[1];
						
						$sql='SELECT * FROM renter WHERE CWID = "';
						$sql.=$CWID;
						$sql.='";';
						
						// echo "<h3>" . $sql . "</h3>";
						$Result = mysqli_query($db_link, $sql);
						
						while($row = mysqli_fetch_array($Result)) {
							$firstName = $row['firstName'];
							$lastName = $row['lastName'];
							$country = $row['country'];
							$age = $row['age'];
							$phoneNum = $row['phoneNum'];
						}
						
						
						
						echo "<h4> Name: " . $firstName . " " . $lastName . "</h4>";
						// echo "<br>";
						echo "<h4> Country: " . $country . "</h4>";
						
						echo "<h4> Age: " . $age . "</h4>";
						
						echo "<h4> Contact: " . $phoneNum . "</h4>";
						
						// echo "<h3>" . $CWID . "</h3>";
						mysqli_close($db_link);
					?>
				</div>
				<input type="text" id="sig" autocomplete="off" placeholder="Signature" size="30">	
					<br><br>
					<input type="button" name="Submit-button" value="Submit" onclick="contract()"/>		
			</div>
		</div>

		<script>
			function contract() {

				var empCheck = document.getElementById("sig").value;
				if(empCheck == "")
				{
					alert("Please enter your signature.");
					return false;
				}
				var reject;
				
				<?php
						$CWID;
						$livingID;
						
						$age; //
						$houseAgeLimit;
						
						$staffChk; //
						$houseStaffAva;//
						
						$db_host = 'localhost';
						$db_name = 'orangeDB';
						$db_user = 'root';
						$db_pass = 'kimdyd123';
						
						$db_link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("Could not connect to database server"); 
						mysqli_select_db($db_link, $db_name) or die("Could not select database");
						
						$link .= $_SERVER['REQUEST_URI']; 
						$zeropieces = explode("?", $link);
						$firstpieces = explode("=", $zeropieces[1]);//cwid
						$secondpieces = explode("=", $zeropieces[2]);//livingID
						$thirdpieces = explode("/", $secondpieces[1]);//livingID
						$CWID = $firstpieces[1];
						$livingID = $thirdpieces[0];
						
						$sql='SELECT * FROM renter WHERE CWID = "';
						$sql.=$CWID;
						$sql.='";';
						// echo 'var sqlTest = '.json_encode($livingID).';';
						// echo "<h3>" . $sql . "</h3>";
						$Result = mysqli_query($db_link, $sql);
						
						while($row = mysqli_fetch_array($Result)) {
							$age = $row['age'];
						}
						
						$sql='SELECT COUNT(CWID) FROM staff WHERE CWID = "';
						$sql.=$CWID;
						$sql.='";';
						
						// echo "<h3>" . $sql . "</h3>";
						$Result = mysqli_query($db_link, $sql);
						
						$num_rows = mysqli_num_rows($Result);
						
						if($num_rows == 1)
						{
							$staffChk = 1;
						}
						else
						{
							$staffChk = 0;
						}
						
						
						$sql='SELECT staffavailable FROM oncam WHERE livingID = "';
						$sql.=$livingID;
						$sql.='";';
						// echo 'var sqlTest = '.json_encode($livingID).';';
						// echo "<h3>" . $sql . "</h3>";
						$Result = mysqli_query($db_link, $sql);
						
						while($row = mysqli_fetch_array($Result)) {
							$houseStaffAva = $row['staffavailable'];
						}
						
						if($houseStaffAva == null)
						{
							 $houseStaffAva = 1;
						}
						
						
						$sql='SELECT agelimit FROM living WHERE livingID = "';
						$sql.=$livingID;
						$sql.='";';
						// echo 'var sqlTest = '.json_encode($livingID).';';
						// echo "<h3>" . $sql . "</h3>";
						$Result = mysqli_query($db_link, $sql);
						
						while($row = mysqli_fetch_array($Result)) {
							$houseAgeLimit = $row['agelimit'];
						}
						
						$rj = "none";
						
						if($age >= $houseAgeLimit)
						{
							if($staffChk == 0)
							{
								$rj = "pass";
							}
							if($staffChk == 1 && $houseStaffAva == 1)
							{
								$rj = "pass";
							}
							else if($staffChk == 1 && $houseStaffAva == 0)
							{
								$rj = "hsa";
							}						
						}
						else
						{
							$rj = "age";
						}
						//you already own a same house
						
						if($rj == "pass")
						{
							$sql='INSERT INTO rent (renterID, livingID) VALUES ("';
							$sql.=$CWID;
							$sql.='", ';
							$sql.=$livingID;
							$sql.=');';
							// echo 'var sqlTest = '.json_encode($livingID).';';
							// echo "<h3>" . $sql . "</h3>";
							mysqli_query($db_link, $sql);
						}

						
						// echo 'var sqlTest = '.json_encode($houseStaffAva).';';
						echo 'reject = '.json_encode($rj).';';

						mysqli_close($db_link);
					?>
					var sPageURL = window.location.search.substring(1);
					var sParameterName = sPageURL.split('id=');
					var cwid = sParameterName[1].split('?');
					
					if(reject == "pass")
					{
						alert("Welcome to your new house. \n\nYour lease contract successfully finished. \nGoing back to the main page");
						// alert(cwid[0]);
						location.replace("http://orangedatabase.ddns.net:8080/index.html?id=" + cwid[0]);
					}
					else if(reject == "hsa")
					{
						alert("Your lease has rejected due to: \n\nThis house is not available to a staff. \nGoing back to the main page");
						location.replace("http://orangedatabase.ddns.net:8080/index.html?id=" + cwid[0]);
					}
					else if(reject == "age")
					{
						alert("Your lease has rejected due to: \n\nAge restriction. \nGoing back to the main page");
						location.replace("http://orangedatabase.ddns.net:8080/index.html?id=" + cwid[0]);
					}
			}
		</script>
	</body>
</html>
