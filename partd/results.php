
<html>
<head>
<title>Assignment1</title>
</head>
<body >
<?php

  require 'db.php';
	require_once ("MiniTemplator.class.php");

	$t = new MiniTemplator;
	$ok = $t->readTemplateFromFile("minitemplate.html");

  function showerror() {
     die("Error " . mysql_errno() . " : " . mysql_error());
  }
	
	
	

 

  // Connect to the MySQL server
  if (!($connection = @ mysql_connect(DB_HOST, DB_USER, DB_PW))) {
    die("Could not connect");
  }
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
	die("Could not connect");
	}
	
	// yearrr ............
	
	if($minYear > $maxYear){
	echo "!! the minYear is grater than maxyear!!!";
	echo "try again.Click on the Link below.
	<br>: <a href='table.php'>to main page </a>";
                   }
				   
	 // cost ............
	if($minCost > $maxCost){
	echo "!! the minYear is grater than maxcost please try again!!!";
	echo "try again.Click on the Link below.
	<br>: <a href='table.php'>to return to the main page </a>";
                   }

  if (!mysql_select_db(DB_NAME, $connection)) {
    showerror();
  }

  // Start a query ...
  $query = "SELECT wine.wine_id, wine_name, region_name, year, winery_name, variety,cost, on_hand
FROM winery, region, wine, wine_variety, grape_variety , inventory
WHERE winery.region_id = region.region_id
AND wine.winery_id = winery.winery_id
AND wine_variety.variety_id = grape_variety.variety_id
AND wine.wine_id = wine_variety.wine_id
AND wine.wine_id= inventory.wine_id";



  if (isset($wineName) && $wineName != NULL ) {
    $query .= " AND wine_name = '{$wineName}'";
  }
   if (isset($wineryName)&& $wineryName != NULL ) {
    $query .= " AND winery_name = '{$wineryName}'";
  }
   if (isset($minYear)&& $minYear != NULL ) {
    $query .= " AND year >= '{$minYear}'";
  }
  if (isset($maxYear)&& $maxYear != NULL ) {
    $query .= " AND year <='{$maxYear}'";
  }
   if (isset($minCost)&& $minCost != NULL ) {
    $query .= " AND cost > '{$minCost}'";
  }
  if (isset($maxCost)&& $maxCost != NULL ) {
    $query .= " AND cost <'{$maxCost}'";
  }
   if (isset($region) && $region != "All") {
    $query .= " AND region_name = '{$region}'";
  }
    if (isset($grape) && $grape != "All") {
     $query .= " AND variety = '{$grape}'";
  }
  
  
$request1=mysql_query($query);
 
 while($row=mysql_fetch_row($request1))
  { 
 
$t->setVariable("wineid",$row[0]);

$t->setVariable("winename",$row[1]);
$t->setVariable("year",$row[2]);
$t->setVariable("wineryname",$row[3]);
$t->setVariable("grape",$row[4]);
$t->setVariable("region",$row[5]);
$t->setVariable("cost",$row[6]);
$t->setVariable("available",$row[7]);

$t->addBlock("data");


}
$t->generateOutput();


?>
</body>
</html>


