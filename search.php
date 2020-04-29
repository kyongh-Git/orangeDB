<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>OrangeLiving.net: Apartment and dorm for Rent </title>
		<link rel="stylesheet" type="text/css" href="searchStyle.css"/>
	</head>
	<body>
		<div class="mainWrapper">
			<header class="menubar">
				<div id="i1" class="item1">
					<a href="http://orangedatabase.ddns.net:8080" target="_self" title="logo"><img width="150" height="50" src="orange_logo.png"/></a>
				</div>
				<div id="i3" class="item3">
					<p style="font-size:15px;" id="myID"></p>
				</div>
			</header>
			
			<div class="body-container">
				<div id="map" class="left-part"></div>
				<div id="headPicture" class="right-part">
					<div id="sortFilter" class="sortFilterClass">
						<div id="sorting" class="sortClass">
							<button type="button" class="sortbtn" onclick="buttonClose()">Sort</button>
							<button type="button" id="defBTN" class="default" onclick="openDefault()">Default</button>
							<button type="button" id="lhBTN" class="lowtohigh" onclick="orderDESC()">Low to High</button>
							<button type="button" id="hlBTN" class="hightolow" onclick="orderASC()">High to Low</button>
						</div>
						<div id="filtering" class="filterClass">
							<button type="button" class="filterbtn" onclick="filterButtonClose()">Filter</button>
						</div>
					</div>
					<div id="livingTable" class="rightTable">
						<div id="tb" class="table">
							<table>
							<tr>
								<th>Name</th>
								<th>Price</th>
								<th>Room Type</th>
								<th>Address</th>
								<th>Contact</th>
								<th>Website</th>
							</tr>
							<?php
								$livingID = [];
								$name = [];
								$price = [];
								$address = [];
								$city = [];
								$state = [];
								$zipcode = [];
								$roomtype = [];
								$age = [];
								$contact = [];
								$website = [];
								
								$pricemin;
								$pricemax;
								$major;
								$level;
								$bed;
								$country;
								
								$db_host = 'localhost';
								$db_name = 'orangeDB';
								$db_user = 'root';
								$db_pass = 'kimdyd123';
								
								$db_link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("Could not connect to database server"); 
								mysqli_select_db($db_link, $db_name) or die("Could not select database");
								
								$link .= $_SERVER['REQUEST_URI']; 
								$zeropieces = explode("?", $link);
								$firstpieces = explode("=", $zeropieces[1]);
								if($firstpieces[0] == "id")
								{
									$secondpieces = explode("=", $zeropieces[2]);
									$thirdpieces = explode("=", $zeropieces[3]);
									
									$fourthpieces = explode("=", $zeropieces[4]);
									$fourP = 0;
									$fifthpieces = explode("=", $zeropieces[5]);
									$fiveP = 0;
									$sixthpieces = explode("=", $zeropieces[6]);
									$sixP = 0;
									$seventhpieces = explode("=", $zeropieces[7]);
									$sevenP = 0;
									$eightthpieces = explode("=", $zeropieces[8]);
									$eightP = 0;
									$ninethpieces = explode("=", $zeropieces[9]);
									$nineP = 0;
								}
								else{
									$secondpieces = explode("=", $zeropieces[1]);
									$thirdpieces = explode("=", $zeropieces[2]);
									
									$fourthpieces = explode("=", $zeropieces[3]);
									$fourP = 0;
									$fifthpieces = explode("=", $zeropieces[4]);
									$fiveP = 0;
									$sixthpieces = explode("=", $zeropieces[5]);
									$sixP = 0;
									$seventhpieces = explode("=", $zeropieces[6]);
									$sevenP = 0;
									$eightthpieces = explode("=", $zeropieces[7]);
									$eightP = 0;
									$ninethpieces = explode("=", $zeropieces[8]);
									$nineP = 0;
								}
								
								
								
								if($fourthpieces[1] != NULL)
								{
									$fourP = 1;
									$pricemin = $fourthpieces[1];
								}
								else
								{
									$pricemin = 0;
								}
								
								if($fifthpieces[1] != NULL)
								{
									$fiveP = 1;
									$pricemax = $fifthpieces[1];
								}
								else
								{
									$pricemax = 3000;
								}
								
								if($sixthpieces[1] != "none" && $sixthpieces[1] != NULL)
								{
									$sixP = 1;
									if(strpos($sixthpieces[1], "%20") !== false){
										$major = str_replace("%20", " ", $sixthpieces[1]);
									}
									else
									{
										$major = $sixthpieces[1];
									}
									
								}
								else
								{
									$major = $sixthpieces[1];
								}
								
								if($seventhpieces[1] != "none" && $seventhpieces[1] != NULL)
								{
									$sevenP = 1;
									$level = $seventhpieces[1];
								}
								else
								{
									$level = $seventhpieces[1];
								}
								
								if($eightthpieces[1] != "none" && $eightthpieces[1] != NULL)
								{
									$eightP = 1;
									$bed = $eightthpieces[1];
								}
								else
								{
									$bed = $eightthpieces[1];
								}
								
								if($ninethpieces[1] != "none" && $ninethpieces[1] != NULL)
								{
									$nineP = 1;
									// $country = $ninethpieces[1];
									if(strpos($ninethpieces[1], "%20") !== false){
										$country = str_replace("%20", " ", $ninethpieces[1]);
									}
									else
									{
										$country = $ninethpieces[1];
									}
								}
								else
								{
									$country = $ninethpieces[1];
								}
								
								$filterON = $fourP + $fiveP + $sixP + $sevenP + $eightP + $nineP;
								
								$sql='SELECT * FROM living';
								if($filterON == 0)
								{
									$sql .=';';
								}
								else
								{
									$sql .=' WHERE';
									$sql .=' price >= ' . $pricemin . ' AND price <= ' .  $pricemax . ' ';
									
									if($eightP == 1)
									{
										$sql .='AND roomtype = "' . $bed . '" ';
									}
									
									if($sixP == 1 || $sevenP == 1 || $nineP == 1)
									{
										$sql .='AND livingID in (SELECT livingID FROM rent WHERE renterID in (';
										if($nineP == 1)
										{
											$sql .='SELECT CWID FROM renter WHERE country = "' . $country . '" ' ;
											if($sixP == 1 || $sevenP == 1)
											{
												$sql .= 'AND CWID in (SELECT CWID FROM student WHERE ';
												if($sixP == 1 && $sevenP == 1)
												{
													$sql .= 'major = "' . $major . '" AND level = "' . $level . '")))';
												}
												else if($sixP == 1 && $sevenP == 0)
												{
													$sql .= 'major = "' . $major . '")))';
												}
												else if($sixP == 0 && $sevenP == 1)
												{
													$sql .= 'level = "' . $level . '")))';
												}
											}
											else
											{
												$sql .= '))';
											}
											
										}
										else if($nineP == 0)
										{
											if($sixP == 1 || $sevenP == 1)
											{
												$sql .='SELECT CWID FROM student WHERE ' ;
												if($sixP == 1 && $sevenP == 1)
												{
													$sql .= 'major = "' . $major . '" AND level = "' . $level . '"))';
												}
												else if($sixP == 1 && $sevenP == 0)
												{
													$sql .= 'major = "' . $major . '"))';
												}
												else if($sixP == 0 && $sevenP == 1)
												{
													$sql .= 'level = "' . $level . '"))';
												}
											}
											// else
											// {
												// $sql .= '))';
											// }
											
										}
										

									}
									
								}
								// echo "<h3>" . $sql . "</h3>";
								// echo "<h3> test" . $fourP . "," . $fiveP . "," . $sixP . "," . $sevenP . "," . $eightP . "</h3>"; 
								// echo "<h3>" . $sql . "</h3>";
								$results_per_page = 15;
								
								if($filterON > 0)
								{
									$pagenationResult = mysqli_query($db_link, $sql);
								}
								else if($filterON == 0)
								{
									$pagenationResult = mysqli_query($db_link, "SELECT * FROM living;");
								}
								
								
								$number_of_results = mysqli_num_rows($pagenationResult);					
								
								$number_of_pages = ceil($number_of_results/$results_per_page);
								$page = $thirdpieces[1];
								
								$this_page_first_result = ($page-1)*$results_per_page;

								$sqld='SELECT * FROM living LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
								$sqlas='SELECT * FROM living ORDER BY price asc LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
								$sqlde='SELECT * FROM living ORDER BY price desc LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
								
								$sqldft=$sql . 'LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
								$sqlasft=$sql . 'ORDER BY price asc LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
								$sqldeft=$sql . 'ORDER BY price desc LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
								
								
								$Result = NULL;

								if($secondpieces[1] == "d")
								{
									if($filterON > 0)
									{
										$Result = mysqli_query($db_link, $sqldft);
									}
									else
									{
										$Result = mysqli_query($db_link, $sqld);
									}
								}
								else if($secondpieces[1] == "as")
								{
									if($filterON > 0)
									{
										$Result = mysqli_query($db_link, $sqlasft);
									}
									else
									{
										$Result = mysqli_query($db_link, $sqlas);
									}
								}
								else if($secondpieces[1] == "de")
								{
									if($filterON > 0)
									{
										$Result = mysqli_query($db_link, $sqldeft);
									}
									else
									{
										$Result = mysqli_query($db_link, $sqlde);
									}
								}
								while($row = mysqli_fetch_array($Result)) {
									array_push($livingID, $row['livingID']);
									array_push($name, $row['name']);
									array_push($price, $row['price']);
									array_push($address, $row['address']);
									array_push($city, $row['city']);
									array_push($state, $row['state']);
									array_push($zipcode, $row['zipcode']);
									array_push($roomtype, $row['roomtype']);
									array_push($age, $row['agelimit']);
									array_push($contact, $row['contact']);
									array_push($website, $row['website']);
									
									echo "<tr id='r". $row['livingID'] . "'>";
									echo "<td>" . $row['name'] . "</td>";
									echo "<td>$" . $row['price'] . "</td>";
									echo "<td>" . $row['roomtype'] . "</td>";
									echo "<td>" . $row['address'] . "</td>";
									echo "<td>" . $row['contact'] . "</td>";
									echo '<td> <a href="' . $row['website'] . '">' . $row['website'] . '</a></td>';
									// echo '<td>' . $row['website'] . '</td>';
									echo "</tr>";

									echo "<script> document.getElementById('r" . $row['livingID']. "').addEventListener('click', function() {contractPage(this.id);}); </script>";
								}
								echo "</table>";

								for ($page=1;$page<=$number_of_pages;$page++) {
									if($filterON > 0)
									{
										if($firstpieces[0] == "id")
										{
											echo '<a href="search.php?id=' . $firstpieces[1] . '?sr='.$secondpieces[1].'?page=' . $page . '?min=' . $pricemin . '?max=' . $pricemax . '?mj=' . $major . '?lv=' . $level . '?bd=' . $bed . '?ct=' . $country . '">' . $page . '</a> ';
										}
										else
										{
											echo '<a href="search.php?sr='.$secondpieces[1].'?page=' . $page . '?min=' . $pricemin . '?max=' . $pricemax . '?mj=' . $major . '?lv=' . $level . '?bd=' . $bed . '?ct=' . $country . '">' . $page . '</a> ';
										}
										
									}
									else
									{
										if($firstpieces[0] == "id")
										{
											echo '<a href="search.php?id=' . $firstpieces[1] . '?sr='.$secondpieces[1].'?page=' . $page . '">' . $page . '</a> ';
										}
										else
										{
											echo '<a href="search.php?sr='.$secondpieces[1].'?page=' . $page . '">' . $page . '</a> ';
										}
										
									}
								}
								mysqli_close($db_link);
							?>
						</div>		
						
						<div id="ft" class="left-box">
							<h3> Choose filters to apply </h3>
							<form id="formS" name="renter" method="post">	
								<p>Price:</p>
								<input type="number" id="priceMin" name="priceMin" placeholder="Min" min="1" max="499" />
								<input type="number" id="priceMax" name="priceMax" placeholder="Max" min="500" max="15000" />
								<p>Major:</p>
								<select id="major" name="major" required>
									<option value="none" selected disabled hidden>
										Major 
									</option>
								   <option value="Agricultural Economics">Agricultural Economics</option>
								   <option value="American Studies">American Studies</option>
								   <option value="Animal Science">Animal Science</option>
								   <option value="Architecture">Architecture</option>
								   <option value="Biochemistry and Molecular Biology">Biochemistry and Molecular Biology</option>
								   <option value="Chemistry">Chemistry</option>
								   <option value="Chemical Engineering">Chemical Engineering</option>
								   <option value="Civil Engineering">Civil Engineering</option>
								   <option value="Computer Science">Computer Science</option>
								   <option value="Economics">Economics</option>
								   <option value="English">English</option>
								   <option value="Entomology">Entomology</option>
								   <option value="Environmental Science">Environmental Science</option>
								   <option value="Food Science">Food Science</option>
								   <option value="French">French</option>
								   <option value="General Business">General Business</option>
								   <option value="Geology">Geology</option>
								   <option value="German">German</option>
								   <option value="Global Studies">Global Studies</option>
								   <option value="Health Education and Promotion">Health Education and Promotion</option>
								   <option value="History">History</option>
								   <option value="Horticulture">Horticulture</option>
								   <option value="Industrial Engineering and Management">Industrial Engineering and Management</option>
								   <option value="Management">Management</option>
								   <option value="Mathematics">Mathematics</option>
								</select>
								<p>Level:</p>
								<select id="level" name="level" required>
									<option value="none" selected disabled hidden>
										Level 
									</option>
								   <option value="UG">Undergraduate</option>
								   <option value="GR">Graduate</option>
								</select>

								<p>Beds:</p>
								<select id="beds" name="beds" required>
									<option value="none" selected disabled hidden>
										Beds / Baths 
									</option>
								   <option value="1BR/1BATH">1Bed/1Bath</option>
								   <option value="1BR/CBATH">1Bed/Common Bath</option>
								   <option value="2BR/1BATH">2Bed/1Bath</option>
								   <option value="2BR/1BATH/Kitchen">2Bed/1Bath/Common Kitchen</option>
								   <option value="2BR/2BATH">2Bed/2Bath</option>
								   <option value="2BR/CBATH">2Bed/Common Bath</option>
								   <option value="3BR/3BATH">3Bed/3Bath</option>
								   <option value="4BR/2BATH/Kitchen">4Bed/2Bath/Common Kitchen</option>
								   <option value="4BR/4BATH">4Bed/4Bath</option>
								</select>
								
								<p>Countries:</p>
								<select id="countries" name="countries" required>
									<option value="none" selected disabled hidden>
										Countries
									</option>
								    <option value="Afganistan">Afghanistan</option>
									<option value="Albania">Albania</option>
									<option value="Algeria">Algeria</option>
									<option value="American Samoa">American Samoa</option>
									<option value="Andorra">Andorra</option>
									<option value="Angola">Angola</option>
									<option value="Anguilla">Anguilla</option>
									<option value="Antigua & Barbuda">Antigua & Barbuda</option>
									<option value="Argentina">Argentina</option>
									<option value="Armenia">Armenia</option>
									<option value="Aruba">Aruba</option>
									<option value="Australia">Australia</option>
									<option value="Austria">Austria</option>
									<option value="Azerbaijan">Azerbaijan</option>
									<option value="Bahamas">Bahamas</option>
									<option value="Bahrain">Bahrain</option>
									<option value="Bangladesh">Bangladesh</option>
									<option value="Barbados">Barbados</option>
									<option value="Belarus">Belarus</option>
									<option value="Belgium">Belgium</option>
									<option value="Belize">Belize</option>
									<option value="Benin">Benin</option>
									<option value="Bermuda">Bermuda</option>
									<option value="Bhutan">Bhutan</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Bonaire">Bonaire</option>
									<option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
									<option value="Botswana">Botswana</option>
									<option value="Brazil">Brazil</option>
									<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
									<option value="Brunei">Brunei</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Burkina Faso">Burkina Faso</option>
									<option value="Burundi">Burundi</option>
									<option value="Cambodia">Cambodia</option>
									<option value="Cameroon">Cameroon</option>
									<option value="Canada">Canada</option>
									<option value="Canary Islands">Canary Islands</option>
									<option value="Cape Verde">Cape Verde</option>
									<option value="Cayman Islands">Cayman Islands</option>
									<option value="Central African Republic">Central African Republic</option>
									<option value="Chad">Chad</option>
									<option value="Channel Islands">Channel Islands</option>
									<option value="Chile">Chile</option>
									<option value="China">China</option>
									<option value="Christmas Island">Christmas Island</option>
									<option value="Cocos Island">Cocos Island</option>
									<option value="Colombia">Colombia</option>
									<option value="Comoros">Comoros</option>
									<option value="Congo">Congo</option>
									<option value="Cook Islands">Cook Islands</option>
									<option value="Costa Rica">Costa Rica</option>
									<option value="Cote DIvoire">Cote DIvoire</option>
									<option value="Croatia">Croatia</option>
									<option value="Cuba">Cuba</option>
									<option value="Curacao">Curacao</option>
									<option value="Cyprus">Cyprus</option>
									<option value="Czech Republic">Czech Republic</option>
									<option value="Denmark">Denmark</option>
									<option value="Djibouti">Djibouti</option>
									<option value="Dominica">Dominica</option>
									<option value="Dominican Republic">Dominican Republic</option>
									<option value="East Timor">East Timor</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Egypt">Egypt</option>
									<option value="El Salvador">El Salvador</option>
									<option value="Equatorial Guinea">Equatorial Guinea</option>
									<option value="Eritrea">Eritrea</option>
									<option value="Estonia">Estonia</option>
									<option value="Ethiopia">Ethiopia</option>
									<option value="Falkland Islands">Falkland Islands</option>
									<option value="Faroe Islands">Faroe Islands</option>
									<option value="Fiji">Fiji</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="French Guiana">French Guiana</option>
									<option value="French Polynesia">French Polynesia</option>
									<option value="French Southern Ter">French Southern Ter</option>
									<option value="Gabon">Gabon</option>
									<option value="Gambia">Gambia</option>
									<option value="Georgia">Georgia</option>
									<option value="Germany">Germany</option>
									<option value="Ghana">Ghana</option>
									<option value="Gibraltar">Gibraltar</option>
									<option value="Great Britain">Great Britain</option>
									<option value="Greece">Greece</option>
									<option value="Greenland">Greenland</option>
									<option value="Grenada">Grenada</option>
									<option value="Guadeloupe">Guadeloupe</option>
									<option value="Guam">Guam</option>
									<option value="Guatemala">Guatemala</option>
									<option value="Guinea">Guinea</option>
									<option value="Guyana">Guyana</option>
									<option value="Haiti">Haiti</option>
									<option value="Hawaii">Hawaii</option>
									<option value="Honduras">Honduras</option>
									<option value="Hong Kong">Hong Kong</option>
									<option value="Hungary">Hungary</option>
									<option value="Iceland">Iceland</option>
									<option value="Indonesia">Indonesia</option>
									<option value="India">India</option>
									<option value="Iran">Iran</option>
									<option value="Iraq">Iraq</option>
									<option value="Ireland">Ireland</option>
									<option value="Isle of Man">Isle of Man</option>
									<option value="Israel">Israel</option>
									<option value="Italy">Italy</option>
									<option value="Jamaica">Jamaica</option>
									<option value="Japan">Japan</option>
									<option value="Jordan">Jordan</option>
									<option value="Kazakhstan">Kazakhstan</option>
									<option value="Kenya">Kenya</option>
									<option value="Kiribati">Kiribati</option>
									<option value="Korea North">Korea North</option>
									<option value="Korea South">Korea South</option>
									<option value="Kuwait">Kuwait</option>
									<option value="Kyrgyzstan">Kyrgyzstan</option>
									<option value="Laos">Laos</option>
									<option value="Latvia">Latvia</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Lesotho">Lesotho</option>
									<option value="Liberia">Liberia</option>
									<option value="Libya">Libya</option>
									<option value="Liechtenstein">Liechtenstein</option>
									<option value="Lithuania">Lithuania</option>
									<option value="Luxembourg">Luxembourg</option>
									<option value="Macau">Macau</option>
									<option value="Macedonia">Macedonia</option>
									<option value="Madagascar">Madagascar</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Malawi">Malawi</option>
									<option value="Maldives">Maldives</option>
									<option value="Mali">Mali</option>
									<option value="Malta">Malta</option>
									<option value="Marshall Islands">Marshall Islands</option>
									<option value="Martinique">Martinique</option>
									<option value="Mauritania">Mauritania</option>
									<option value="Mauritius">Mauritius</option>
									<option value="Mayotte">Mayotte</option>
									<option value="Mexico">Mexico</option>
									<option value="Midway Islands">Midway Islands</option>
									<option value="Moldova">Moldova</option>
									<option value="Monaco">Monaco</option>
									<option value="Mongolia">Mongolia</option>
									<option value="Montserrat">Montserrat</option>
									<option value="Morocco">Morocco</option>
									<option value="Mozambique">Mozambique</option>
									<option value="Myanmar">Myanmar</option>
									<option value="Nambia">Nambia</option>
									<option value="Nauru">Nauru</option>
									<option value="Nepal">Nepal</option>
									<option value="Netherland Antilles">Netherland Antilles</option>
									<option value="Netherlands">Netherlands (Holland, Europe)</option>
									<option value="Nevis">Nevis</option>
									<option value="New Caledonia">New Caledonia</option>
									<option value="New Zealand">New Zealand</option>
									<option value="Nicaragua">Nicaragua</option>
									<option value="Niger">Niger</option>
									<option value="Nigeria">Nigeria</option>
									<option value="Niue">Niue</option>
									<option value="Norfolk Island">Norfolk Island</option>
									<option value="Norway">Norway</option>
									<option value="Oman">Oman</option>
									<option value="Pakistan">Pakistan</option>
									<option value="Palau Island">Palau Island</option>
									<option value="Palestine">Palestine</option>
									<option value="Panama">Panama</option>
									<option value="Papua New Guinea">Papua New Guinea</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Peru">Peru</option>
									<option value="Philippines">Philippines</option>
									<option value="Pitcairn Island">Pitcairn Island</option>
									<option value="Poland">Poland</option>
									<option value="Portugal">Portugal</option>
									<option value="Puerto Rico">Puerto Rico</option>
									<option value="Qatar">Qatar</option>
									<option value="Republic of Montenegro">Republic of Montenegro</option>
									<option value="Republic of Serbia">Republic of Serbia</option>
									<option value="Reunion">Reunion</option>
									<option value="Romania">Romania</option>
									<option value="Russia">Russia</option>
									<option value="Rwanda">Rwanda</option>
									<option value="St Barthelemy">St Barthelemy</option>
									<option value="St Eustatius">St Eustatius</option>
									<option value="St Helena">St Helena</option>
									<option value="St Kitts-Nevis">St Kitts-Nevis</option>
									<option value="St Lucia">St Lucia</option>
									<option value="St Maarten">St Maarten</option>
									<option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
									<option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
									<option value="Saipan">Saipan</option>
									<option value="Samoa">Samoa</option>
									<option value="Samoa American">Samoa American</option>
									<option value="San Marino">San Marino</option>
									<option value="Sao Tome & Principe">Sao Tome & Principe</option>
									<option value="Saudi Arabia">Saudi Arabia</option>
									<option value="Senegal">Senegal</option>
									<option value="Seychelles">Seychelles</option>
									<option value="Sierra Leone">Sierra Leone</option>
									<option value="Singapore">Singapore</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Solomon Islands">Solomon Islands</option>
									<option value="Somalia">Somalia</option>
									<option value="South Africa">South Africa</option>
									<option value="Spain">Spain</option>
									<option value="Sri Lanka">Sri Lanka</option>
									<option value="Sudan">Sudan</option>
									<option value="Suriname">Suriname</option>
									<option value="Swaziland">Swaziland</option>
									<option value="Sweden">Sweden</option>
									<option value="Switzerland">Switzerland</option>
									<option value="Syria">Syria</option>
									<option value="Tahiti">Tahiti</option>
									<option value="Taiwan">Taiwan</option>
									<option value="Tajikistan">Tajikistan</option>
									<option value="Tanzania">Tanzania</option>
									<option value="Thailand">Thailand</option>
									<option value="Togo">Togo</option>
									<option value="Tokelau">Tokelau</option>
									<option value="Tonga">Tonga</option>
									<option value="Trinidad & Tobago">Trinidad & Tobago</option>
									<option value="Tunisia">Tunisia</option>
									<option value="Turkey">Turkey</option>
									<option value="Turkmenistan">Turkmenistan</option>
									<option value="Turks & Caicos Is">Turks & Caicos Is</option>
									<option value="Tuvalu">Tuvalu</option>
									<option value="Uganda">Uganda</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="Ukraine">Ukraine</option>
									<option value="United Arab Erimates">United Arab Emirates</option>
									<option value="United States of America">United States of America</option>
									<option value="Uraguay">Uruguay</option>
									<option value="Uzbekistan">Uzbekistan</option>
									<option value="Vanuatu">Vanuatu</option>
									<option value="Vatican City State">Vatican City State</option>
									<option value="Venezuela">Venezuela</option>
									<option value="Vietnam">Vietnam</option>
									<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
									<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
									<option value="Wake Island">Wake Island</option>
									<option value="Wallis & Futana Is">Wallis & Futana Is</option>
									<option value="Yemen">Yemen</option>
									<option value="Zaire">Zaire</option>
									<option value="Zambia">Zambia</option>
									<option value="Zimbabwe">Zimbabwe</option>
								</select>
								<br>
								<input type="reset" value="Reset"/>
								<input type="button" onclick="testFN()" value="Submit"/>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script>
		function initMap() {
			// The location of stillwater
			var stillwater = {lat: 36.145507, lng: -97.068966};
			// The map, centered at stillwater
			var map = new google.maps.Map(
			document.getElementById('map'), {zoom: 13, center: stillwater});
			// The marker, positioned at stillwater
			<!-- var marker = new google.maps.Marker({position: stillwater, map: map}); -->
			var liveID = [];
			var latt = [];
			var logi = [];
			var namePlace = [];
			var addPlace = [];
			var sqlTest = "";
			<?php
				$pricemin;
				$pricemax;
				$major;
				$level;
				$bed;
				$country;
				
				$filterON = 0;
								
				$db_host = 'localhost';
				$db_name = 'orangeDB';
				$db_user = 'root';
				$db_pass = 'kimdyd123';
						
				$db_link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("Could not connect to database server"); 
				mysqli_select_db($db_link, $db_name) or die("Could not select database");
				
				// $link .= $_SERVER['REQUEST_URI']; 
				// echo 'var sqlTest = '.json_encode($link).';';
				// $firstpieces = explode("?", $link);
				// $secondpieces = explode("=", $firstpieces[1]);
				// $thirdpieces = explode("=", $firstpieces[2]);
				
				// $fourthpieces = explode("=", $firstpieces[3]);
				// $fourP = 0;
				// $fifthpieces = explode("=", $firstpieces[4]);
				// $fiveP = 0;
				// $sixthpieces = explode("=", $firstpieces[5]);
				// $sixP = 0;
				// $seventhpieces = explode("=", $firstpieces[6]);
				// $sevenP = 0;
				// $eightthpieces = explode("=", $firstpieces[7]);
				// $eightP = 0;
				// $ninethpieces = explode("=", $firstpieces[8]);
				// $nineP = 0;
				
				
				$link .= $_SERVER['REQUEST_URI']; 
				$zeropieces = explode("?", $link);
				$firstpieces = explode("=", $zeropieces[1]);
				
				if($firstpieces[0] == "id")
				{
					$secondpieces = explode("=", $zeropieces[2]);
					$thirdpieces = explode("=", $zeropieces[3]);
					
					$fourthpieces = explode("=", $zeropieces[4]);

					$fourP = 0;
					$fifthpieces = explode("=", $zeropieces[5]);
					$fiveP = 0;
					$sixthpieces = explode("=", $zeropieces[6]);
					$sixP = 0;
					$seventhpieces = explode("=", $zeropieces[7]);
					$sevenP = 0;
					$eightthpieces = explode("=", $zeropieces[8]);
					$eightP = 0;
					$ninethpieces = explode("=", $zeropieces[9]);
					$nineP = 0;
				}
				else{
					$secondpieces = explode("=", $zeropieces[1]);
					$thirdpieces = explode("=", $zeropieces[2]);
					
					$fourthpieces = explode("=", $zeropieces[3]);
					$fourP = 0;
					$fifthpieces = explode("=", $zeropieces[4]);
					$fiveP = 0;
					$sixthpieces = explode("=", $zeropieces[5]);
					$sixP = 0;
					$seventhpieces = explode("=", $zeropieces[6]);
					$sevenP = 0;
					$eightthpieces = explode("=", $zeropieces[7]);
					$eightP = 0;
					$ninethpieces = explode("=", $zeropieces[8]);
					$nineP = 0;
				}
				// echo 'var sqlTest = '.json_encode($sixthpieces[0]).';';
				if($fourthpieces[1] != NULL)
				{
					$fourP = 1;
					$pricemin = $fourthpieces[1];
					if($fourthpieces[1] == "d" || $fourthpieces[1] == "as" || $fourthpieces[1] == "de")
					{
						$fourP = 0;
						$pricemin = 0;
					}
					if($fourthpieces[0] == "id")
					{
						$fourP = 0;
						$pricemin = 0;
					}
				}
				else
				{
					$pricemin = 0;
				}
				
				if($fifthpieces[1] != NULL)
				{
					$fiveP = 1;
					$pricemax = $fifthpieces[1];
					if($fifthpieces[0] == "page" || $fifthpieces[0] == "sr")
					{
						$fiveP = 0;
						$pricemax = 3000;
					}
					
				}
				else
				{
					$pricemax = 3000;
				}
				
				if($sixthpieces[1] != "none" && $sixthpieces[1] != NULL)
				{
					$sixP = 1;
					if($sixthpieces[0] == "page")
					{
						$sixP = 0;
						$major = "none";
					}
					else
					{
						if(strpos($sixthpieces[1], "%20") !== false)
						{
							$major = str_replace("%20", " ", $sixthpieces[1]);
						}
						else
						{
							$major = $sixthpieces[1];
						}
					}
				}
				else
				{
					$major = $sixthpieces[1];
				}
				
				// echo 'var sqlTest = '.json_encode($major).';';
				
				if($seventhpieces[1] != "none" && $seventhpieces[1] != NULL)
				{
					$sevenP = 1;
					$level = str_replace("/search.php", "", $seventhpieces[1]);
					if($level == "none")
					{
						$sevenP = 0;
						$level = "";
					}
					// $level = $seventhpieces[1];
				}
				else
				{
					$level = $seventhpieces[1];
				}
				
				if($eightthpieces[1] != "none" && $eightthpieces[1] != NULL)
				{
					$eightP = 1;
					$bed = str_replace("/search.php", "", $eightthpieces[1]);
					if($bed == "none")
					{
						$eightP = 0;
						$bed = "";
					}
					// $bed = $eightthpieces[1];
				}
				else
				{
					$bed = "";
				}
				
				if($ninethpieces[1] != "none" && $ninethpieces[1] != NULL)
				{
					$nineP = 1;
					$country = str_replace("/search.php", "", $ninethpieces[1]);
					$country = str_replace("%20", " ", $country);
					if($country == "none")
					{
						$nineP = 0;
						$country = "";
					}
					// $country = $ninethpieces[1];
				}
				else
				{
					$country = "";
				}
				// echo 'var sqlTest = '.json_encode($bed).';';
				
				$filterON = $fourP + $fiveP + $sixP + $sevenP + $eightP + $nineP;
				$sql='SELECT * FROM living';
				if($filterON == 0)
				{
					$sql .=';';
				}
				else
				{
					$sql .=' WHERE';
					$sql .=' price >= ' . $pricemin . ' AND price <= ' .  $pricemax . ' ';
					
					if($eightP == 1)
					{
						$sql .='AND roomtype = "' . $bed . '" ';
					}
					
					if($sixP == 1 || $sevenP == 1 || $nineP == 1)
					{
						$sql .='AND livingID in (SELECT livingID FROM rent WHERE renterID in (';
						if($nineP == 1)
						{
							$sql .='SELECT CWID FROM renter WHERE country = "' . $country . '" ' ;
							if($sixP == 1 || $sevenP == 1)
							{
								$sql .= 'AND CWID in (SELECT CWID FROM student WHERE ';
								if($sixP == 1 && $sevenP == 1)
								{
									$sql .= 'major = "' . $major . '" AND level = "' . $level . '")))';
								}
								else if($sixP == 1 && $sevenP == 0)
								{
									$sql .= 'major = "' . $major . '")))';
								}
								else if($sixP == 0 && $sevenP == 1)
								{
									$sql .= 'level = "' . $level . '")))';
								}
							}
							else
							{
								$sql .= '))';
							}
							
						}
						else if($nineP == 0)
						{
							if($sixP == 1 || $sevenP == 1)
							{
								$sql .='SELECT CWID FROM student WHERE ' ;
								if($sixP == 1 && $sevenP == 1)
								{
									$sql .= 'major = "' . $major . '" AND level = "' . $level . '"))';
								}
								else if($sixP == 1 && $sevenP == 0)
								{
									$sql .= 'major = "' . $major . '"))';
								}
								else if($sixP == 0 && $sevenP == 1)
								{
									$sql .= 'level = "' . $level . '"))';
								}
							}
							// else
							// {
								// $sql .= '))';
							// }
							
						}
						

					}
					
				}
				// echo 'var sqlTest = '.json_encode($sql).';';
				// $Result = mysqli_query($db_link, "SELECT livingID, latitude, longitude, name, address FROM living;");
				// $Result = mysqli_query($db_link, "SELECT * FROM living;");
				// echo 'var sqlTest = '.json_encode($sql).';';
				$Result = mysqli_query($db_link, $sql);
				
				// $Result = NULL;
				// if($filterON > 0)
				// {
					// $Result = mysqli_query($db_link, $sql);
				// }
				// else if($filterON == 0)
				// {
					// $Result = mysqli_query($db_link, "SELECT * FROM living;");
				// }
				
				$lvID = [];
				$latArr = [];
				$logArr = [];
				$nameOfPlace = [];
				$addressOfPlace = [];
				while($row = mysqli_fetch_array($Result)) {
					array_push($lvID, $row['livingID']);
					array_push($latArr, $row['latitude']);
					array_push($logArr, $row['longitude']);
					array_push($nameOfPlace, $row['name']);
					array_push($addressOfPlace, $row['address']);
					// echo $row['latitude'];
				}
				echo 'var liveID = '.json_encode($lvID).';';
				echo 'var latt = '.json_encode($latArr).';';
				echo 'var logi = '.json_encode($logArr).';';
				echo 'var namePlace = '.json_encode($nameOfPlace).';';
				echo 'var addPlace = '.json_encode($addressOfPlace).';';
				
				mysqli_close($db_link);
			?>
			console.log(sqlTest);
			var markers = [];
			for(var i = 0; i < latt.length; i++)
			{
				var temp1 = parseFloat(latt[i]);
				
				var temp2 = parseFloat(logi[i]);
				markers[i] = {lat: temp1, lng: temp2};
				// console.log(temp1);
			}
			
			
			for(var i = 0; i< markers.length; i++)
			{
				addMarker(markers[i], namePlace[i], addPlace[i]);
				
			}		
			
			function addMarker(coords, nm, addr)
			{
				var marker = new google.maps.Marker({position: coords, map: map});
				
				var infowindow = new google.maps.InfoWindow({content: '<b>' + nm + '</b>' + '<br>'+addr});
				// infowindow.open(map, marker);
				
				google.maps.event.addListener(marker, 'click', function() {infowindow.open(map,marker);});
				// google.maps.event.addListener(marker, 'click', function() {infowindow.open(map,marker);});
			}
			
			function makeMakerMove(livingid)
			{
				console.log(livingid);
				// var mark = new google.maps.Marker({position:markers[markerIndex], animation:google.maps.Animation.BOUNCE, map:map});
			}
		}
		</script>
		
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
		</script>

		<script>
			function buttonClose() {
				if(document.getElementById("defBTN").style.display == "none")
				{
					document.getElementById("defBTN").style.display = "block";
				}
				else
				{
					document.getElementById("defBTN").style.display = "none";
				}
				
				if(document.getElementById("lhBTN").style.display == "none")
				{
					document.getElementById("lhBTN").style.display = "block";
				}
				else
				{
					document.getElementById("lhBTN").style.display = "none";
				}
				
				if(document.getElementById("hlBTN").style.display == "none")
				{
					document.getElementById("hlBTN").style.display = "block";
				}
				else
				{
					document.getElementById("hlBTN").style.display = "none";
				}
				
			}
		</script>
		
		<script>
			var defaultPage;
			function openDefault() {
				var sPageURL = window.location.search.substring(1);
				var sParameterName = sPageURL.split('=');
				if(sParameterName[0] == "id")
				{
					var cwid = sParameterName[1].split('?');
					location.replace("http://orangedatabase.ddns.net:8080/search.php?id=" + cwid[0] + "?sr=d?page=1");
				}
				else
				{
					location.replace("http://orangedatabase.ddns.net:8080/search.php?sr=d?page=1");
				}
				
				// defaultPage.blur();
			}
		</script>
		
		<script>
			function orderASC() {
				var sPageURL = window.location.search.substring(1);
				var sParameterName = sPageURL.split('=');
				if(sParameterName[0] == "id")
				{
					var cwid = sParameterName[1].split('?');
					location.replace("http://orangedatabase.ddns.net:8080/search.php?id=" + cwid[0] + "?sr=de?page=1");
				}
				else
				{
					location.replace("http://orangedatabase.ddns.net:8080/search.php?sr=de?page=1");
				}
				
			}
		</script>
		
		<script>
			function orderDESC() {
				var sPageURL = window.location.search.substring(1);
				var sParameterName = sPageURL.split('=');
				if(sParameterName[0] == "id")
				{
					var cwid = sParameterName[1].split('?');
					location.replace("http://orangedatabase.ddns.net:8080/search.php?id=" + cwid[0] + "?sr=as?page=1");	
				}
				else
				{
					location.replace("http://orangedatabase.ddns.net:8080/search.php?sr=as?page=1");	
				}
						
			}
		</script>
		
		<script>
			function filterButtonClose() {
				if(document.getElementById("ft").style.display == "none")
				{
					document.getElementById("tb").style.display = "none";
					document.getElementById("ft").style.display = "block";
				}
				else
				{
					document.getElementById("ft").style.display = "none";
					document.getElementById("tb").style.display = "block";
				}

			}
		</script>
		
		<script>
			function testFN() {
				filterButtonClose();
				var elements = document.getElementById("formS").elements;
				var obj ={};
				for(var i = 0 ; i < elements.length ; i++){
					var item = elements.item(i);
					obj[item.name] = item.value;
				}
				// alert(obj["priceMin"]);
				// alert(obj["priceMax"]);
				// alert(obj["major"]);
				// alert(obj["level"]);
				// alert(obj["beds"]);
				// ct=' . $country
				var sPageURL = window.location.search.substring(1);
				var sParameterName = sPageURL.split('=');

				if(sParameterName[0] == "id")
				{
					var sSort = sParameterName[2].split('?');
					var cwid = sParameterName[1].split('?');
					// alert(cwid[0]);
					if (sSort[0] == "d") 
					{
						location.replace("http://orangedatabase.ddns.net:8080/search.php?id=" + cwid[0] + "?sr=d?page=1?min=" + obj["priceMin"] + "?max=" + obj["priceMax"] + "?mj=" + obj["major"] + "?lv=" + obj["level"] + "?bd=" + obj["beds"] + "?ct=" + obj["countries"]);	
					
					}
					else if(sSort[0] == "as")
					{
						location.replace("http://orangedatabase.ddns.net:8080/search.php?id=" + cwid[0] + "?sr=as?page=1?min=" + obj["priceMin"] + "?max=" + obj["priceMax"] + "?mj=" + obj["major"] + "?lv=" + obj["level"] + "?bd=" + obj["beds"] + "?ct=" + obj["countries"]);	
					
					}
					else if(sSort[0] == "de")
					{
						location.replace("http://orangedatabase.ddns.net:8080/search.php?id=" + cwid[0] + "?sr=de?page=1?min=" + obj["priceMin"] + "?max=" + obj["priceMax"] + "?mj=" + obj["major"] + "?lv=" + obj["level"] + "?bd=" + obj["beds"] + "?ct=" + obj["countries"]);	
					}
				}
				else
				{
					var sSort = sParameterName[1].split('?');
					if (sSort[0] == "d") 
					{
						location.replace("http://orangedatabase.ddns.net:8080/search.php?sr=d?page=1?min=" + obj["priceMin"] + "?max=" + obj["priceMax"] + "?mj=" + obj["major"] + "?lv=" + obj["level"] + "?bd=" + obj["beds"] + "?ct=" + obj["countries"]);	
					
					}
					else if(sSort[0] == "as")
					{
						location.replace("http://orangedatabase.ddns.net:8080/search.php?sr=as?page=1?min=" + obj["priceMin"] + "?max=" + obj["priceMax"] + "?mj=" + obj["major"] + "?lv=" + obj["level"] + "?bd=" + obj["beds"] + "?ct=" + obj["countries"]);	
					
					}
					else if(sSort[0] == "de")
					{
						location.replace("http://orangedatabase.ddns.net:8080/search.php?sr=de?page=1?min=" + obj["priceMin"] + "?max=" + obj["priceMax"] + "?mj=" + obj["major"] + "?lv=" + obj["level"] + "?bd=" + obj["beds"] + "?ct=" + obj["countries"]);	
					}
				}
				
				
				
				// location.replace("http://orangedatabase.ddns.net:8080/search.php?sr=d?page=1?min=" + obj["priceMin"] + "?max=" + obj["priceMax"] + "?mj=" + obj["major"] + "?lv=" + obj["level"] + "?bd=" + obj["beds"]);	
				// var x = document.getElementById("formS").elements[0].value;
				// var y = document.getElementById("formS").elements[1].value;
				// var z = document.getElementById("formS").elements[3].value;
				// alert(x);
				// alert(y);
				// alert(z);
			}
		</script>
		<script>
			function myID() {
				var sPageURL = window.location.search.substring(1);
				var sParameterName = sPageURL.split('id=');
				return sParameterName[1];
			}
		</script>
		<script>
			function contractPage(id) {
				id = id.substring(1); //living ID
				// console.log(id);
				var sPageURL = window.location.search.substring(1);
				
				var sParameterName = sPageURL.split('id=');
				// console.log(sParameterName[1]);
				if(sParameterName[1] != null)
				{
					var cwid = sParameterName[1].split('?');
					console.log(cwid[0]); //cwid
					location.replace("http://orangedatabase.ddns.net:8080/rent.php?cid=" + cwid[0] + "?lvid=" + id);
				}
				
				
				// return sParameterName[1];
			}
		</script>
	</body>
</html>
