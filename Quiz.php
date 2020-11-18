<!-- Ex from pages 362-364 -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP Form Quiz</title>
</head>
<body>
	<h2>PHP Form Quiz</h2>
	<hr/>
	<?php
		//associative array of the questions and answers
		$StateCapitals = array(
			"Connecticut" => "Hartford", 
			"Maine" => "Augusta", 
			"Massachusetts" => "Boston", 
			"New Hampshire" => "Concord", 
			"Rhode Island" => "Providence", 
			"Vermont" => "Montpelier");

		//determine if the submit button was clicked
		if(isset($_POST["submit"])) {
			//create an array out of the array of the user-submitted data
			$Answers = $_POST["answers"];
			//Score accumulator
			$Score = 0;
			//variable storing how many questions are are
			$Questions = count($Answers);
			if(is_array($Answers)) {
				//checked $Answers and IS an array
				foreach($Answers as $State => $Response) {
					$Response = stripslashes($Response);
					//check to see if $response wasleft empty
					if(strlen($Response) > 0) {
						if(strcasecmp($StateCapitals[$State], $Response) == 0) {
							echo "<p>Correct! The capital of $State is ", $StateCapitals[$State], ".</p>\n";
							++$Score;
						}
						else {
							echo "<p>Sorry, the capital of $State is not $Response.</p>\n";
						}
					}
					else {
						//answer empty
						echo "<p>You did not enter an answer for the capital of $State!</p>\n";
					}
				}
			}
			$Percent = $Score / $Questions * 100;
			echo "<p style='color:red;'>You got a score of $Score out of $Questions! That's a $Percent%!</p>";
			echo "<p><a href='Quiz.php'>Try Again?</a></p>\n";
		}
		else {
			echo "<form action='Quiz.php' method='POST'>\n";
			foreach($StateCapitals as $State => $Response) {
				echo "The capital of $State is: <input type='text' name='answers[", $State, "]' /><br/><br/>\n";
			}
			echo "<input type='submit' name='submit' value='Check Answers' />&nbsp";
			echo "<input type='reset' name='reset' value='Reset Form' />\n";
			echo "</form>\n";
		}
	?>
</body>
</html>