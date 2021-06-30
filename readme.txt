tutorial : https://www.webslesson.info/2020/03/phpspreadsheet-beginner-tutorial.html
	Excel to Mysql
	
-------------------------------------------------------------------------------------------------------------------------
Devolver un excel como un array:
<?php

//Subir archivo y devolver los registros leidos

include '../plugins/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

if($_FILES["select_excel"]["name"] != '')
{
 $allowed_extension = array('xls', 'xlsx');
 $file_array = explode(".", $_FILES['select_excel']['name']);
 $file_extension = end($file_array);
 if(in_array($file_extension, $allowed_extension))
 {
  $reader = IOFactory::createReader('Xlsx');
  $spreadsheet = $reader->load($_FILES['select_excel']['tmp_name']);
 	$worksheet = $spreadsheet->getActiveSheet();
	$rows = [];
	foreach ($worksheet->getRowIterator() AS $row) {
	    $cellIterator = $row->getCellIterator();
	    $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
	    $cells = [];
	    foreach ($cellIterator as $cell) {
	        $cells[] = $cell->getValue();
	    }
	    $rows[] = $cells;
	}
 }
 else
 {
  $message = '<div class="alert alert-danger">Only .xls or .xlsx file allowed</div>';
 }
}
else
{
 $message = '<div class="alert alert-danger">Please Select File</div>';
}

print_r($rows);

?>
-------------------------------------------------------------------------------------------------------------------------

Tambien
-------------------------------------------------------------------------------------------------------------------------
<?php

//Subir archivo y devolver los registros leidos

include '../plugins/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

if($_FILES["select_excel"]["name"] != '')
{
 $allowed_extension = array('xls', 'xlsx');
 $file_array = explode(".", $_FILES['select_excel']['name']);
 $file_extension = end($file_array);
 if(in_array($file_extension, $allowed_extension))
 {
  $reader = IOFactory::createReader('Xlsx');
  $spreadsheet = $reader->load($_FILES['select_excel']['tmp_name']);
		$worksheet = $spreadsheet->getActiveSheet();
		$rows = $worksheet->toArray();
 }
 else
 {
  $message = '<div class="alert alert-danger">Only .xls or .xlsx file allowed</div>';
 }
}
else
{
 $message = '<div class="alert alert-danger">Please Select File</div>';
}

print_r($rows);

?>
	
