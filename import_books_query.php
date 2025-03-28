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
	// //Import uploaded file to Database
	// $handle = fopen($_FILES['filename']['tmp_name'], "r");
    // $count = 0;
	// while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	// 	if($count == 0){
	// 		$count++;
	// 		continue;
	// 	}
    //     $query = mysqli_query($con,"SELECT * FROM `barcode` ORDER BY mid_barcode DESC ") or die (mysqli_error());
    //     $fetch = mysqli_fetch_array($query);
    //     $mid_barcode = $fetch['mid_barcode'];
    //     $new_barcode =  $mid_barcode + 1;
    //     $pre_barcode = "RMSML";
    //     $suf_barcode = "LMS";
        
    //     mysqli_query($con, "INSERT INTO barcode (pre_barcode,mid_barcode,suf_barcode) VALUES ('$pre_barcode','$new_barcode','$suf_barcode')") or die(mysqli_error($con));
    //     $generate_barcode = $pre_barcode . $new_barcode . $suf_barcode;
	// 	mysqli_query($con,"INSERT into book (book_title, category_id ,author, book_copies, book_pub, publisher_name, isbn, copyright_year, status, book_barcode,remarks, date_added)
	// 	values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$generate_barcode','$data[9]',NOW())");
		
	// 	}

	// fclose($handle);
		$dest= 'upload/excel/';
        $error_ext=0;
        if(!empty($_FILES['doc']['name'])){
            $exc= basename($_FILES['doc']['name']);
            $exc=explode('.',$exc);
            $ext1=$exc[1];
            if($ext1=='php' || $ext1!='xlsx'){
                $error_ext++;
            } else {
                $filename1='import_book_fmt.'.$ext1;
                if(move_uploaded_file($_FILES["doc"]['tmp_name'], $dest.'/'.$filename1)){
					$objPHPExcel = new Spreadsheet();
					$inputFileName ='upload/excel/import_book_fmt.xlsx';
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
						$book_title = $objPHPExcel->getActiveSheet()->getCell('A'.$x)->getFormattedValue();
						if($book_title!="" || !empty($book_title)){
							$category_id = $objPHPExcel->getActiveSheet()->getCell('B'.$x)->getFormattedValue();
							$author = $objPHPExcel->getActiveSheet()->getCell('C'.$x)->getFormattedValue();
							$book_copies = $objPHPExcel->getActiveSheet()->getCell('D'.$x)->getFormattedValue();
							$publication = $objPHPExcel->getActiveSheet()->getCell('E'.$x)->getFormattedValue();
							$publisher = $objPHPExcel->getActiveSheet()->getCell('F'.$x)->getFormattedValue();
							$isbn = $objPHPExcel->getActiveSheet()->getCell('G'.$x)->getFormattedValue();
							$copyright = $objPHPExcel->getActiveSheet()->getCell('H'.$x)->getFormattedValue();
							$status = $objPHPExcel->getActiveSheet()->getCell('I'.$x)->getFormattedValue();
							$remarks = $objPHPExcel->getActiveSheet()->getCell('J'.$x)->getFormattedValue();
							include('include/dbcon.php');
							$query = mysqli_query($con,"SELECT * FROM `barcode` ORDER BY mid_barcode DESC ") or die (mysqli_error());
							$fetch = mysqli_fetch_array($query);
							$mid_barcode = $fetch['mid_barcode'];
							$new_barcode =  $mid_barcode + 1;
							$pre_barcode = "RMSML";
							$suf_barcode = "LMS";
							mysqli_query($con, "INSERT INTO barcode (pre_barcode,mid_barcode,suf_barcode) VALUES ('$pre_barcode','$new_barcode','$suf_barcode')") or die(mysqli_error($con));
							$generate_barcode = $pre_barcode . $new_barcode . $suf_barcode;
							mysqli_query($con,"INSERT into book (book_title, category_id ,author, book_copies, book_pub, publisher_name, isbn, copyright_year, status, book_barcode,remarks, date_added)
							values('$book_title','$category_id','$author','$book_copies','$publication','$publisher','$isbn','$copyright','$status','$generate_barcode','$remarks',NOW())");
						}
					}
				}
			}
		}

	//print "Import done";
	// echo "<script type='text/javascript'>alert('Successfully imported a CSV file!');</script>";
	// echo "<script>document.location='book.php'</script>";
	//view upload form
// }

?>