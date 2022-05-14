<?php

$serverName = "sql204.epizy.com";
$dBUsername = "epiz_28267572";
$dBPassword = "nyXfm0j5ybkj4";
$dBName = "epiz_28267572_joyfulpaws";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName, 3306);

if (!$conn)
{
    die("Connection failed: ". mysqli_connect_error());
}