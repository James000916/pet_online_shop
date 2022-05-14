<?php

$mysql_host = "sql204.epizy.com";
$mysql_database = "epiz_28267572_joyfulpaws";
$mysql_user = "epiz_28267572";
$mysql_password = "nyXfm0j5ybkj4";

# MySQL with PDO_MYSQL  
$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

$query = file_get_contents("user.sql");

$stmt = $db->prepare($query);

if ($stmt->execute())
     echo "Success";
else 
     echo "Fail"


?>