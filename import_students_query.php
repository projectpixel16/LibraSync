<?php
	require 'vendor\autoload.php';
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx as writerxlsx;
	use PhpOffice\PhpSpreadsheet\Reader\Csv;
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx as readerxlsx;
	use PhpOffice\PhpSpreadsheet\Worksheet\Drawing as drawing; // Instead PHPExcel_Worksheet_Drawing
	use PhpOffice\PhpSpreadsheet\Style\Alignment as alignment; // Instead alignment
	use PhpOffice\PhpSpreadsheet\Style\Border as border;
	use PhpOffice\PhpSpreadsheet\Style\NumberFormat as number_format;
	use PhpOffice\PhpSpreadsheet\Style\Fill as fill; // Instead fill
	use PhpOffice\PhpSpreadsheet\Style\Color as color; //Instead PHPExcel_Style_Color
	use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup as pagesetup; // Instead PHPExcel_Worksheet_PageSetup
	use PhpOffice\PhpSpreadsheet\IOFactory as io_factory; // Instead PHPExcel_IOFactory
	// if (isset($_POST['submit'])) 
	// {
	// include('include/dbcon.php');
		//Import uploaded file to Database
	// 	$handle = fopen($_FILES['filename']['tmp_name'], "r");
	// $count = 0;
	// 	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	// 		if($count == 0){
	// 			$count++;
	// 			continue;
	// 		}
	// 		mysqli_query($con,"INSERT into user (school_number, firstname ,middlename, lastname, contact, gender, address, type, status, user_added)
	// 		values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]',NOW())");
			
	// 		}

	// 	fclose($handle);
	$dest= 'upload/excel/';
	$error_ext=0;
	if(!empty($_FILES['doc']['name'])){
		$exc= basename($_FILES['doc']['name']);
		$exc=explode('.',$exc);
		$ext1=$exc[1];
		if($ext1=='php' || $ext1!='xlsx'){
			$error_ext++;
		} else {
			$filename1='import_student_fmt.'.$ext1;
			if(move_uploaded_file($_FILES["doc"]['tmp_name'], $dest.'/'.$filename1)){
				$objPHPExcel = new Spreadsheet();
				$inputFileName ='upload/excel/import_student_fmt.xlsx';
				try {
					$inputFileType = io_factory::identify($inputFileName);
					$objReader = io_factory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
				} 
				catch(Exception $e) {
					die('Error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
				}
				$objPHPExcel->setActiveSheetIndex(0);
				$highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); 
				for($x=2;$x<$highestRow;$x++){
					$school_id = $objPHPExcel->getActiveSheet()->getCell('A'.$x)->getFormattedValue();
					if($school_id!="" || !empty($school_id)){
						$firstname = $objPHPExcel->getActiveSheet()->getCell('B'.$x)->getFormattedValue();
						$middlename = $objPHPExcel->getActiveSheet()->getCell('C'.$x)->getFormattedValue();
						$lastname = $objPHPExcel->getActiveSheet()->getCell('D'.$x)->getFormattedValue();
						$contact_no = $objPHPExcel->getActiveSheet()->getCell('E'.$x)->getFormattedValue();
						$gender = $objPHPExcel->getActiveSheet()->getCell('F'.$x)->getFormattedValue();
						$address = $objPHPExcel->getActiveSheet()->getCell('G'.$x)->getFormattedValue();
						$type = $objPHPExcel->getActiveSheet()->getCell('H'.$x)->getFormattedValue();
						$status = $objPHPExcel->getActiveSheet()->getCell('I'.$x)->getFormattedValue();
						include('include/dbcon.php');
						mysqli_query($con,"INSERT into user (school_number, firstname ,middlename, lastname, contact, gender, address, type, status, user_added)values('$school_id','$firstname','$middlename','$lastname','$contact_no','$gender','$address','$type','$status',NOW())");
					}
				}
			}
		}
	}
	//print "Import done";
	// echo "<script type='text/javascript'>alert('Successfully imported a CSV file!');</script>";
	// echo "<script>document.location='user.php'</script>";
	//view upload form
// }

?>