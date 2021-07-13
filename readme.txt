tutorial : https://www.webslesson.info/2020/03/phpspreadsheet-beginner-tutorial.html
	Excel to Mysql
	
	
array to Xls:

//convertir array en XLS
	toXls($usuariosGlobal);

	function toXLS($usuariosGlobal){
		borrarXls();
		$spreadSheet = new Spreadsheet();

		$spreadSheet->getActiveSheet()->fromArray($usuariosGlobal,null,'A1');

			$writerXLsx = IOFactory::createWriter($spreadSheet, 'Xls');
			$filename = time() . '.xls';
			$writerXLsx->save('./downloads/'.$filename);

			echo json_encode($filename,JSON_INVALID_UTF8_IGNORE);
	}

//Borrar archivos antiguos de la carpeta
	function borrarXls(){
		$dirFiles = "./downloads/";
		$dir_open=opendir($dirFiles);
		$files = array();

		  while ($current = readdir($dir_open)){
		    if( $current != "." && $current != "..") {
		      if(!is_dir($dirFiles.$current)) {
	                $ext = new SplFileInfo($current);
			        if ($ext->getExtension() == 'xls') {
			        	unlink($dirFiles.$current);
			        }
		      }
		    }
		  }
	}

	
