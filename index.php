<?php

require('src\EDI\interpreter.php');

//$file     = __DIR__ . '\\202003180900_Ocoren_Meridional_ES_2.txt';
$file     = 'C:\202003180900_Ocoren_Meridional_ES_2.txt';
$edi      = new \PHPProceda\EDI\Interpreter($file);
$result   = $edi->convertV3ToJSON();

echo json_encode($result);