<?php 
	//export.php

	include './vendor/autoload.php';

	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Spreadsheet;

	$arrayData = [
	    [NULL, 2010, 2011, 2012],
	    ['Q1',   12,   15,   21],
	    ['Q2',   56,   73,   86],
	    ['Q3',   52,   61,   69],
	    ['Q4',   30,   32,    0],
	];

$spreadSheet = new Spreadsheet();

// Set details for the formula that we want to evaluate, together with any data on which it depends
$spreadSheet->getActiveSheet()->fromArray(
    $arrayData,
    null,
    'A1'
);

//Ver una celda:
$cellC1 = $spreadSheet->getActiveSheet()->getCell('C1');
echo 'Value: ', $cellC1->getValue(), '; Address: ', $cellC1->getCoordinate(), PHP_EOL;

//Dibujar el excel en html:
  $writerHtml = IOFactory::createWriter($spreadSheet, 'Html');
  $message = $writerHtml->save('php://output');

//Descargar el archivo.

	$writerXLsx = IOFactory::createWriter($spreadSheet, 'Xls');
	$filename = './downloads/'.time() . '.xls';
	$writerXLsx->save($filename);

 header('Content-Type: application/vnd.ms-excel');
 header('Content-Transfer-Encoding: Binary');
 header("Content-disposition: attachment; filename=\"".$filename."\"");

 readfile($filename);


?>