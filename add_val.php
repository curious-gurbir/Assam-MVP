<?php
    require 'sql_data.php';

    $srno=(int)$_REQUEST['srno'];
    $sid=$_REQUEST['nsid'];
    $sname=$_REQUEST['nsname'];
    $spass=$_REQUEST['nspass'];
    $slocation=$_REQUEST['nslocation'];
    $sadmin=$_REQUEST['nsadmin'];

    $link = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
        
    // Attempt select query execution
    $sql = "INSERT INTO admin (sr_no,station_id,station_name, password, location, admin)
    VALUES (".$srno.",'".$sid."','".$sname."', '".$spass."', '".$slocation."', '".$sadmin."')";

    if (mysqli_query($link, $sql)) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
        echo "failed";
    }
                
    // Close connection
    mysqli_close($link);
?>