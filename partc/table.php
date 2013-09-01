<html>
<head>
    <title>Assignment1 </title>
</head>
<body >
  <form action="results.php" method="GET">
	<!--Winer name -->   
   <label >Entre Wine name  </label>
    <input type="text" name="wineName"  >
	 <br>	
	<label >Entre Winery name</label>
    <input type="text" name="wineryName">
	 <br> 
	 <label >Select Region</label><select name="region">
	<?php
	$con = mysql_connect("localhost","webadmin","mohammad");
	if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
		mysql_select_db("winestore", $con);
	$request1=mysql_query("select * from region");
	while($row=mysql_fetch_row($request1)){
	
	echo "<option value=$row[1]> $row[1]</option>";
	}
	?>
	</select>
		<br>
	
	 <label >Select grape variety</label><select name="grape">
	<?php
	$con = mysql_connect("localhost","webadmin","mohammad");
	if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
		mysql_select_db("winestore", $con);
	$request1=mysql_query("select * from grape_variety");
	while($row=mysql_fetch_row($request1)){

	echo "<option value=$row[1]> $row[1]</option>";
	}
	?>
	</select> 
	<br> 
	<label >Entre min year   </label>
	<select name="minYear">
	<?php
	$con = mysql_connect("localhost","webadmin","mohammad");
	if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("winestore", $con);
	$request1=mysql_query("select * from wine");
	while($row=mysql_fetch_row($request1)){
	echo "<option value=''></option>";
	echo "<option value=$row[3]> $row[3]</option>";
	}
	?>
	</select> 
   
	 <br>
	<label >Entre max year   </label>
	<select name="maxYear">
	<?php
	$con = mysql_connect("localhost","webadmin","mohammad");
	if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("winestore", $con);
	$request1=mysql_query("select * from wine");
	while($row=mysql_fetch_row($request1)){
	echo "<option value=''></option>";
	echo "<option value=$row[3]> $row[3]</option>";
	}
	?>
	</select> 
  
	 <br>
	<label >Entre min Cost   </label>
    <input type="text" name="minCost">
	 <br>
	<label >Entre max Cost   </label>
    <input type="text" name="maxCost">	
	 <br>
	 
   <input type="submit" value="Submit">
   
   
   
  </form>
 
</body>
</html>