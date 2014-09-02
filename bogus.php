<html>
<head>
<title>That's a bogus page</title>
</head>

<body>

<?php
  $age = 22;  
	$inUSA = true; 
	if ($age < 21 and $inUSA) {     
	  echo "Sorry, you can't drink in the US.<br>";    
		echo "How about a trip to Europe?";   
	}
	else {
	   echo "go ahead! drink up.";
	}
	?>
</body>
</html>
