<?php
    require 'sql_data.php';

    $link = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    // Attempt select query execution
    $sql = "SELECT * FROM admin";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            echo "<table id=\"stable\">\n";
            echo "\t<thead><tr>";               
            echo "<th>Sr No</th>";
            echo "<th>Station Name</th>";
            echo "<th>Station ID</th>";
            echo "<th>Items</th>";
            echo "<th>Location</th>";
            echo "<th>Admin</th>";
            echo "<th>Last Activity</th>";
            echo "</tr></thead><tbody>\n";
            while($row = mysqli_fetch_array($result)){
                $count=$row['sr_no'];
                echo "\t<tr id=\"row".$count."\" class=\"rows\">\n";
                echo "\t\t<td>".$row['sr_no']."</td>\n";
                echo "\t\t<td>".$row['station_name']."</td>\n";
                echo "\t\t<td>".$row['station_id']."</td>\n";
                echo "\t\t<td>" . $row['items'] . "</td>\n";
                echo "\t\t<td>" . $row['location'] . "</td>\n";
                echo "\t\t<td>" . $row['admin'] . "</td>\n";
                echo "\t\t<td>Today</td>\n";
            }
            // Free result set
            mysqli_free_result($result);
            echo "</tbody>
            </table>";
        } else{
            echo "<span class=\"no_result\">Seems like there's no station data to show!</span>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    // Close connection
    mysqli_close($link);			
?>