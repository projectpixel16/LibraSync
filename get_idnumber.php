<?php 
    require ('include/dbcon.php');
    if($_POST['type']==='Community Member'){
        // $min = 10000000000;
        // $max = 99999999999;
        // $generate_idnumber=mt_rand($min,$max);
        // echo $generate_idnumber;

        $year = date('y');
        $type = 'C'; // or 'S' for students
        // Get the latest serial number for this year and type
        $query = mysqli_query($con, "SELECT id_number FROM user_series WHERE year='$year' AND type='$type' ORDER BY id_number DESC LIMIT 1") or die(mysqli_error($con));
        if ($row = mysqli_fetch_assoc($query)) {
            $next_serial = $row['id_number'] + 1;
        } else {
            $next_serial = 1;
        }
        // Format the ID: C2025001 or S2025001
        $formatted_id = $type .'-'. $year .'-'. str_pad($next_serial, 3, '0', STR_PAD_LEFT);
        // $formatted_id = $type . $year . str_pad($next_serial, 3, '0', STR_PAD_LEFT);
        // Optional: Insert or update the serial number back to the database
        // mysqli_query($con, "INSERT INTO user_series (year, type, id_number) VALUES ('$year', '$type', $next_serial) ON DUPLICATE KEY UPDATE id_number = $next_serial AND type='C'") or die(mysqli_error($con));
        // Use $formatted_id as needed
        echo $formatted_id;
    }else{
        $year = date('y');
        $type = 'S'; // or 'S' for students
        // Get the latest serial number for this year and type
        $query = mysqli_query($con, "SELECT id_number FROM user_series WHERE year='$year' AND type='$type' ORDER BY id_number DESC LIMIT 1") or die(mysqli_error($con));
        if ($row = mysqli_fetch_assoc($query)) {
            $next_serial = $row['id_number'] + 1;
        } else {
            $next_serial = 1;
        }
        // Format the ID: C2025001 or S2025001
        $formatted_id = $type .'-'. $year .'-'. str_pad($next_serial, 3, '0', STR_PAD_LEFT);
        // Optional: Insert or update the serial number back to the database
        // mysqli_query($con, "INSERT INTO user_series (year, type, id_number) VALUES ('$year', '$type', $next_serial) ON DUPLICATE KEY UPDATE id_number = $next_serial AND type='S'") or die(mysqli_error($con));
        // Use $formatted_id as needed
        echo $formatted_id;
    }
?>