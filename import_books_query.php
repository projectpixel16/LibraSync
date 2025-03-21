<?php
if (isset($_POST['submit'])) 
{
include('include/dbcon.php');
// add if needed to preview
//	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
//		echo "<h1>" . "File ". $_FILES['filename']['name'] ." Uploaded successfully." . "</h1>";
//		echo "<h2>Displaying contents:</h2>";
//		readfile($_FILES['filename']['tmp_name']);
//	}

	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r");
    $count = 0;
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		if($count == 0){
			$count++;
			continue;
		}
        $query = mysqli_query($con,"SELECT * FROM `barcode` ORDER BY mid_barcode DESC ") or die (mysqli_error());
        $fetch = mysqli_fetch_array($query);
        $mid_barcode = $fetch['mid_barcode'];
        $new_barcode =  $mid_barcode + 1;
        $pre_barcode = "RMSML";
        $suf_barcode = "LMS";
        
        mysqli_query($con, "INSERT INTO barcode (pre_barcode,mid_barcode,suf_barcode) VALUES ('$pre_barcode','$new_barcode','$suf_barcode')") or die(mysqli_error($con));
        $generate_barcode = $pre_barcode . $new_barcode . $suf_barcode;
		mysqli_query($con,"INSERT into book (book_title, category_id ,author, book_copies, book_pub, publisher_name, isbn, copyright_year, status, book_barcode,remarks, date_added)
		values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$generate_barcode','$data[9]',NOW())");
		
		}

	fclose($handle);

	//print "Import done";
	echo "<script type='text/javascript'>alert('Successfully imported a CSV file!');</script>";
	echo "<script>document.location='book.php'</script>";
	//view upload form
}

?>