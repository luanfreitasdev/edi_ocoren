<?php

require('transformer.php');

//$file     = __DIR__ . '\\202003180900_Ocoren_Meridional_ES_2.txt';
$file     = 'C:\202003180900_Ocoren_Meridional_ES_2.txt';
$edi      = new \EDI($file);
$result   = $edi->convertV3ToJSON();

echo json_encode($result);