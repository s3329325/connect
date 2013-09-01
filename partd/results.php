
<html>
<head>
<title>Assignment1</title>
</head>
<body >
<?php

  require 'db.php';
 
  // get the user data
	  $wineName = $_GET['wineName'];
      $wineryName = $_GET['wineryName'];
	  $minYear = $_GET['minYear'];
	  $maxYear = $_GET['maxYear'];
	  $minCost = $_GET['minCost'];
	  $maxCost = $_GET['maxCost'];
	  $region = $_GET['region'];
	  $grape = $_GET['grape'];
	 
	//validatio .............
	if ($wineName==""&& $wineryName==""&& $minYear==""&&
	$maxYear==""&& $minCost==""&& $maxCost==""&& 
	$region=="All"&& $grape=="")
	{
	echo "please select an input Thanks.<br>";
	echo "try again.Click on the Link below.
	<br>: <a href='table.php'>to main page </a>";
	die(" ");
	}
		// yearrr ............
	
	if($minYear > $maxYear){
	echo "!! the minYear is grater than maxyear!!!";
	echo "try again.Click on the Link below.
	<br>: <a href='table.php'>to main page </a>";
		die(" ");
                   }
				   
	 // cost ............
	if($minCost > $maxCost){
	echo "!! the minYear is grater than maxcost please try again!!!";
	echo "try again.Click on the Link below.
	<br>: <a href='table.php'>to return to the main page </a>";
		die(" ");
                   }

require_once ("pdo.php");


?>
</body>
</html>


