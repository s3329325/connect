
<html>
<head>
<title>Assignment1</title>
</head>
<body >
<?php

  function showerror() {
     die("Error " . mysql_errno() . " : " . mysql_error());
  }

  require 'db.php';

  // Show all wines in a region in a <table>
  function displayWinesList($connection, $query, $wineName) {
    // Run the query on the server
    if (!($result = @ mysql_query ($query, $connection))) {
      showerror();
    }
    // Find out how many rows are available
    $rowsFound = @ mysql_num_rows($result);
	
    if ($rowsFound > 0) {
   
      print "Wines of $wineName<br>";

      // and start a <table>.
      print "\n<table>\n<tr>" .
          "\n\t<th>Wine ID</th>" .
          "\n\t<th>Wine Name</th>" .
          "\n\t<th>Year</th>" .
          "\n\t<th>Winery</th>" .
		   "\n\t<th>variety</th>" .
		  "\n\t<th>region_name</th>" .
          "\n\t<th>cost</th>". 
		  "\n\t<th>on_hand</th>\n</tr>";
					
      // Fetch each of the query rows
      while ($row = @ mysql_fetch_array($result)) {
        // Print one row of results
        print "\n<tr>\n\t<td>{$row["wine_id"]}</td>" .
            "\n\t<td>{$row["wine_name"]}</td>" .
            "\n\t<td>{$row["year"]}</td>" .
            "\n\t<td>{$row["winery_name"]}</td>" .
			 "\n\t<td>{$row["variety"]}</td>" .
			  "\n\t<td>{$row["region_name"]}</td>" .
            "\n\t<td>{$row["cost"]}</td>" .
			 "\n\t<td>{$row["on_hand"]}</td>\n</tr>";
      } 
      print "\n</table>";
    } 
	  print "{$rowsFound} records found matching your criteria<br>";
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
    $query .= " AND year > '{$minYear}'";
  }
  if (isset($maxYear)&& $maxYear != NULL ) {
    $query .= " AND year <'{$maxYear}'";
  }
  
  
 
  // run the query and show the results
  displayWinesList($connection, $query, $wineName);
?>
</body>
</html>


