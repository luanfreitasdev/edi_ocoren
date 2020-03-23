<?php

require('src\EDI\interpreter.php');
require('src\EDI\Versions\LayoutV3.php');

$file     = __DIR__ . '\\OCORREN020320082635.880.txt';
//$file     = 'C:\202003180900_Ocoren_Meridional_ES_2.txt';
$edi      = new \PHPProceda\EDI\Interpreter();

$edi->setFile($file);
$edi->setLayout(3);
$result   = $edi->json();

echo json_encode($result);