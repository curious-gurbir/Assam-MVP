<?php
    $q = $_REQUEST["q"];
    if($q=="get_nsid"){
        require 'sql_data.php';
        $link = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if($link === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        
        $sql = "SELECT * FROM admin WHERE sr_no=(SELECT MAX(sr_no) FROM admin)";
        if ($result = mysqli_query($link, $sql)){
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $last_sid = $row['station_id'];
                $last_srno = (int)$row['sr_no'];
                $snum = (int)substr($last_sid, 2);
                $nsid = '#S'.(string)++$snum;
                echo ++$last_srno.",".$nsid;
            }else{
                echo 'failed';
            }
		}else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
		// Close connection
		mysqli_close($link);
    }
?>