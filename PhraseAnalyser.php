<head>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/index.css">
</head>
<div style="margin-top: 100px; margin-bottom: 10px" class="container">
	<div id="centerenCols" class="form-group">
		<form method="POST">

			<?php				
				//the alfabet and a array
				$alfabet = range('a', 'z');
				$values = array_fill(0, 26, 0);
				
				//combine the values with the alfabet
				$freq = array_combine($alfabet, $values);
				
				echo 'Please insert a word or sentence: (not more then 255 characters)</br>';
				echo '<textarea name="thestring" rows="4" cols="50" maxlength="255" class="cardColor" id="thestring"></textarea></br></br>';
				
				echo 'Done? Press submit to see the character statistics!</br>';
				echo '<input type="submit" class="button" name="submit" value="submit" id="submit"></br></br>';
				
				if(isset($_POST['thestring']) && isset($_POST['submit'])) {
					
					//the word
					$string = $_POST['thestring'];
					
					//strip the whitespaces
					$string = str_replace(' ', '', $string);
						
					if(!empty($string)) {
						
						//returns the length of the word
						$len = mb_strlen($string, 'utf8');
						
						//loop through the word
						for ($i = 0; $i < $len; $i++) {
							
							$letter = strtolower($string[$i]);
							
							//if the letter is in the array then ++
							if (array_key_exists($letter, $freq)) {
								$freq[$letter]++;
							}
						}

						//create a table
						echo "<table>";
							echo "<tr>";
								echo "	<th>The letter</th>
										<th>Times it occurs</th>
										<th>The letter that comes before</th>
										<th>The letter that comes after</th>
									";
							echo "</tr>";
							
							for ($i = 0; $i < $len; $i++) {
								
								$before = $i;
								$after = $i;
								
								if(--$after === -1) {
									
									echo "<tr>";
										echo "<td>". $string[$i] ."</td>";
										echo "<td>". $freq[$string[$i]] ."</td>";
										echo "<td>". $string[++$before] ."</td>";
										echo "<td> no letter</td>";
									echo "</tr>";
									
								} else if(empty($string[++$before])) {
									
									//reset the after
									$after = $i;
									
									echo "<tr>";
										echo "<td>" . $string[$i] ."</td>";
										echo "<td>". $freq[$string[$i]] ."</td>";
										echo "<td> no letter </td>";
										echo "<td>". $string[--$after] ."</td>";
									echo "</tr>";	
									
								} else {
									//reset the before and after
									$before = $i;
									$after = $i;
									
									echo "<tr>";
										echo "<td>". $string[$i] ."</td>";
										echo "<td>". $freq[$string[$i]] ."</td>"; 
										echo "<td>". $string[++$before] ."</td>"; 
										echo "<td>". $string[--$after] ."</td>";
									echo "</tr>";
								}
							}
						echo "</table>";
					} else {
						echo "No empty word/sentence please";
					}
				}
			?>			
		</form>
	</div>
</div>