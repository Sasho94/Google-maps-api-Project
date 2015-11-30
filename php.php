<?php


mysql_connect("localhost", "sasho", "secret") or die(mysql_error());
mysql_select_db("museum") or die(mysql_error());

$arr = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/place/textsearch/json?location=42.6959248,23.30452557&radius=10000&query=museum&key=AIzaSyATjO-mlr2-K91DPqA0WtT0Slb7JnqVokY"),true);
foreach($arr['results']as $item) {
    //print $item['name'];
	$name=$item['name'];
	//print $item['formatted_address'];
	$address=$item['formatted_address'];
	//print "<br>";
	//print "latitude ".$item['geometry']['location']['lat'];
	$latitude=$item['geometry']['location']['lat'];
	//print "<br>";
	//print "longditude".$item['geometry']['location']['lng'];
	$longditude=$item['geometry']['location']['lng'];
	/*print $item->geometry->location->lat;*/
	//print "<br>";
	mysql_query("SET NAMES UTF8");
	mysql_query("INSERT  IGNORE INTO tab (name, address, latitude,longditude)
 VALUES ('$name', '$address', '$latitude' , '$longditude'); ")or die(mysql_error());
 
	}

	
?>



 