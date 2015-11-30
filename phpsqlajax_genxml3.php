<?php

require("phpsqlajax_dbinfo.php");
header('Content-type: text/html; charset=utf-8');

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server
$connection=mysql_connect ('localhost', $username, $password);
//mysql_set_charset('utf8',$connection);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
//mysql_set_charset('utf8');
$query = "SELECT * FROM tab WHERE 1";
mysql_query("SET NAMES utf8");    //ново
mysql_query("SET CHARACTER SET utf8");//ново
mb_language('uni');//ново
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",utf8_encode($row['name']));
  $newnode->setAttribute("address", utf8_encode($row['address']));
  $newnode->setAttribute("latitude", utf8_encode($row['latitude']));
  $newnode->setAttribute("longditude",utf8_encode($row['longditude']));
}

echo $dom->saveXML();

?>