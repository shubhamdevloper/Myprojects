<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "dbms project";

$conn = new mysqli($host,$user,$pass,$db) or die("unable to connect");

echo "Great work";

?>